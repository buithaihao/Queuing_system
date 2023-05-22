<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Mail;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Device;
use App\Models\Number;
use App\Models\Role;
use App\Models\Service;
use App\Models\Image;
use App\Models\Diary;

class myController extends Controller
{

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    protected $session;
    
    public function myMethod()
    {
        // Lưu trữ thông tin đăng nhập vào session
        $this->session->put('memberlogin', 'memberlogin');
        $this->session->put('password', 'password');
    
        // Truy xuất thông tin đăng nhập từ session
        $memberlogin = $this->session->get('memberlogin');
        $password = $this->session->get('password');
    
        // Xóa thông tin đăng nhập từ session
        $this->session->forget('memberlogin');
        $this->session->forget('password');
    }

    //Hiển thị trang đăng nhập
    public function showLogin()
    {
        $user = Session::get('user');
        return view('dangnhap', ['user' => $user]);
    }
    
    //Chức năng đăng nhập
    public function loginUser(Request $r) {
        $validator = Validator::make($r->all(), [
            'tendn' => 'required',
            'matkhau' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/dangnhap')->withErrors($validator)->withInput();
        }
    
        $credentials = [
            'memberlogin' => $r->tendn,
            'password' => $r->matkhau
        ];
    
        if (Auth::attempt($credentials, true)) {
            $user = Auth::user(); 
            $r->session()->put('user', $user); 
            return redirect('/taikhoancanhan');
        } else {
            return view('dangnhap', ['error'=>'Sai mật khẩu hoặc tên đăng nhập']);
        }
    }

    //Logout
    public function logoutUser()
    {
        if (Session::has('user')) {
            Session::forget('user');
        }
        Auth::logout();
        return redirect('/dangnhap');
    }

    //Hiển thị trang thông tin cá nhân
    public function profile() {
    $user = Member::user();
    $hinhanh = [];
    
    if ($user) {
        $hinhanh = Image::join('members', 'images.memberid', '=', 'members.memberid')
            ->where('members.memberid', '=', $user->memberid)
            ->select('images.image', 'images.imageid')
            ->get();
    }

    return view('taikhoancanhan', ['hinhanh' => $hinhanh]);
    }
    //Chức năng thêm hình ảnh
    public function Image(Request $r) {
        $member = Member::user(); 
        $messages = [
            'mimes' => 'Hình ảnh phải là định dạng JPG hoặc PNG.',
            'max' => 'Kích thước hình ảnh tối đa là 1024KB.',
        ];
        $validator = Validator::make($r->all(), [
            'hinh' => 'required|mimes:jpg,png|max:1024'
        ], $messages);
        if ($validator->fails()) {
            return redirect('/taikhoancanhan')->with('error');
        } else {
            $hinh = $r->file('hinh');
            $storePath = $hinh->move('public/Avatar/', $hinh->getClientOriginalName());
            $image = Image::where('memberid', $member->memberid)->first();
            if ($image) {
                $image->image = $storePath;
                $image->save();

                $updatingMember = Member::find($member->memberid);
        
                $diary = new Diary();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now = Carbon::now();
                $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                $diary->impacttime = $vn_time;
        
                if ($updatingMember) {
                    $diary->member()->associate($updatingMember);
                    $diary->memberid = $updatingMember->memberid;
                    $ipAddress = getHostByName(getHostName());
                    $diary->ipdone = $ipAddress;
                }
        
                $diary->thaotac = 'Tài khoản ' .  $updatingMember->memberlogin . ' cập nhật avatar thành công';
                $diary->save();

                return redirect('/taikhoancanhan')->with('success', 'Cập nhật avatar thành công.');
            } else {
                $image = new Image();
                $image->member()->associate($member);
                $image->memberid = $member->memberid; 
                $image->image = $storePath;
                $image->save();

                $updatingMember = Member::find($member->memberid);

                $diary = new Diary();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now = Carbon::now();
                $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                $diary->impacttime = $vn_time;
                
                if ($updatingMember) {
                    $diary->member()->associate($updatingMember);
                    $diary->memberid = $updatingMember->memberid;
                    $ipAddress = getHostByName(getHostName());
                    $diary->ipdone = $ipAddress;
                }
        
                $diary->thaotac = 'Tài khoản ' .  $updatingMember->memberlogin . ' thêm avatar thành công';
                $diary->save();

                return redirect('/taikhoancanhan')->with('success', 'Thêm avatar thành công.');
            }
        }
    }

    //Hiển thị trang quên mật khẩu
    public function showPass() {
        return view('quenmatkhau');
    }

    //Quên mật khẩu, gửi mail
    public function forgetPass(Request $r) {
        $data = $r->all();
        $now = Carbon::now('UTC')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu".' '.$now;
        
        // Find member by email
        $member = Member::where('email', '=', $data['email_quenmk'])->get();
    
        if ($member->isEmpty()) {
            // Member not found
            return redirect('/quenmatkhau')->with('error', 'Email chưa được đăng ký để khôi phục mật khẩu');
        } else {
            // Generate a random token and update member's token
            $token_random = Str::random();
            $memberid = $member[0]->memberid;
            $member = Member::find($memberid);
            $member->membertoken = $token_random;
            $member->save();
    
            //Send email
            $to_email = $data['email_quenmk'];
            $link_reset_pass = url('/datlaimatkhau?email='.$to_email.'&token='.$token_random);
            $data = array("name"=> $title_mail, "body"=> $link_reset_pass, "email"=> $to_email); // body of mail.blade.php
    
            Mail::send('/thongbaomk', ['data' => $data], function($message) use ($title_mail, $to_email) {
                $message->to($to_email)->subject($title_mail);
                $message->from(config('mail.from.address'), $title_mail);
            });
    
            // Redirect back with success message
            return redirect()->back()->with('message', 'Gửi mail thành công, vui lòng vào email để reset password');
        }
    }
    
    // Reset password function
    public function newPass(Request $r) {
        $data = $r->validate([
            'email' => 'required|email',
            'token' => 'required',
            'matkhaumoi' => 'required',
            'nlmatkhaumoi' => 'required|same:matkhaumoi',
        ]);
        $token_random = Str::random(59);
        
        // Find member by email and token
        $member = Member::where('email', $data['email'])
                        ->where('membertoken', $data['token'])
                        ->first();
        
        if (!$member) {
            // Member not found, or token has expired
            return redirect('/quenmatkhau')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn.');
        } else {
            // Update member's password and token
            $member->password = bcrypt($data['matkhaumoi']);
            $member->membertoken = $token_random;
            $member->save();
        
            // Redirect to password reset success page
            return view('datlaimatkhau', ['message' => 'Mật khẩu đã được cập nhật, mời bạn đăng nhập.']);
        }
    }

    //Hiển thị trang đặt lại mật khẩu
    public function showNewPass() {
        return view('datlaimatkhau');
    }
    
    //Hiển thị trang dashboard
    public function showDashboard(Request $r) {
        //Đếm số lượng số đã được cấp
        $numbers = Number::get();
        $numberCount = $numbers->count(); //Đếm số lượng numberid
        $numberCount_dangcho = $numbers->where('trangthai', 'Đang chờ')->count(); //Đếm số lượng numberid có trạng thái là "Đang chờ"
        $numberCount_dasudung = $numbers->where('trangthai', 'Đã sử dụng')->count();// Đếm số lượng numberid có trạng thái là "Đã sử dụng"
        $numberCount_boqua = $numbers->where('trangthai', 'Bỏ qua')->count(); //Đếm số lượng numberid có trạng thái là "Bỏ qua"
        $totalNumbers = $numberCount_dangcho + $numberCount_dasudung + $numberCount_boqua;
        //Tính phần trăm của cấp số được thêm vào. Kiểm tra nếu tổng số cấp số là 0
        if ($totalNumbers == 0) {
            $numberCount_dasudung_pt = 0;
            $numberCount_dangcho_pt = 0;
            $numberCount_boqua_pt = 0;
        } else {
            // Tính phần trăm dựa trên dữ liệu tổng số cấp số
            $numberCount_dasudung_pt = round(($numberCount_dasudung / $totalNumbers) * 100);
            $numberCount_dangcho_pt = round(($numberCount_dangcho / $totalNumbers) * 100);
            $numberCount_boqua_pt = round(($numberCount_boqua / $totalNumbers) * 100);
        }

        //Đếm số lượng thiết bị đã được đăng ký
        $devices = Device::get();
        $deviceCount = $devices->count(); //Đếm số lượng deviceid
        $deviceCount_hoatdong = $devices->where('tinhtrang', 'Hoạt động')->count(); //Đếm số lượng memberid có trạng thái là "Hoạt động"
        $deviceCount_ngunghoatdong = $devices->where('tinhtrang', 'Ngưng hoạt động')->count(); //Đếm số lượng memberid có trạng thái là "Ngưng hoạt động"

        $totalDevices = $deviceCount_hoatdong + $deviceCount_ngunghoatdong;
        //Tính phần trăm của thiết bị được thêm vào. Kiểm tra nếu tổng số thiết bị là 0
        if ($totalDevices == 0) {
            $deviceCount_hoatdong_pt = 0;
            $serviceCount_ngunghoatdong_pt = 0;
        } else {
            // Tính phần trăm dựa trên dữ liệu tổng số thiết bị
            $deviceCount_hoatdong_pt = round(($deviceCount_hoatdong / $totalDevices) * 100);
            $deviceCount_ngunghoatdong_pt = round(($deviceCount_ngunghoatdong / $totalDevices) * 100);
        } 

        //Đếm số lượng dịch vụ đã được thêm vào
        $services = Service::get();
        $serviceCount = $services->count(); //Đếm số lượng serviceid
        $serviceCount_hoatdong = $services->where('tinhtrang', 'Hoạt động')->count(); //Đếm số lượng serviceid có trạng thái là "Hoạt động"
        $serviceCount_ngunghoatdong = $services->where('tinhtrang', 'Ngưng hoạt động')->count(); //Đếm số lượng serviceid có trạng thái là "Ngưng hoạt động"
        $totalServices = $serviceCount_hoatdong + $serviceCount_ngunghoatdong;
        //Tính phần trăm của dịch vụ được thêm vào. Kiểm tra nếu tổng số dịch vụ là 0
        if ($totalServices == 0) {
            $serviceCount_hoatdong_pt = 0;
            $serviceCount_ngunghoatdong_pt = 0;
        } else {
            // Tính phần trăm dựa trên dữ liệu tổng số dịch vụ
            $serviceCount_hoatdong_pt = round(($serviceCount_hoatdong / $totalServices) * 100);
            $serviceCount_ngunghoatdong_pt = round(($serviceCount_ngunghoatdong / $totalServices) * 100);
        }

        // Lọc ngày, tháng và năm
        $ChonNgay = $r->input('filterDate');
        $currentMonth = date('m');
        $currentYear = date('Y');
        $SoNgay = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $labels = [];
        $counts = [];
        if ($ChonNgay == 'Tháng') {
            for ($month = 1; $month <= 12; $month++) {
                $startDate = date('Y-m-d', strtotime("$currentYear-$month-01"));
                $endDate = date('Y-m-t', strtotime("$currentYear-$month-01"));
                $ticketsOfMonth = Number::whereBetween('granttime', [$startDate, $endDate])->get();
                $count = count($ticketsOfMonth);
                $labels[] = date('M', strtotime($startDate));
                $counts[] = $count;
            }
        } elseif ($ChonNgay == 'Năm') {
            $startYear = $currentYear - 4;
            $endYear = $currentYear;
            for ($year = $startYear; $year <= $endYear; $year++) {
                $startDate = date('Y-m-d', strtotime("$year-01-01"));
                $endDate = date('Y-m-t', strtotime("$year-12-01"));
                $ticketsOfYear = Number::whereBetween('granttime', [$startDate, $endDate])->get();
                $count = count($ticketsOfYear);
                $labels[] = $year;
                $counts[] = $count;
            }
        } else {
            for ($day = 1; $day <= $SoNgay; $day++) {
                $date = sprintf('%d-%02d-%02d', $currentYear, $currentMonth, $day);
                $ticketsOfDay = Number::whereDate('granttime', $date)->get();
                $count = count($ticketsOfDay);
                $labels[] = sprintf('%02d', $day);
                $counts[] = $count;
            }
        }

        return view('Menu/dashboard', [
            'bieudo' => $numbers,
            //Cấp số
            'numberCount' => $numberCount, 
            'numberCount_dangcho' => $numberCount_dangcho,
            'numberCount_dasudung' => $numberCount_dasudung,
            'numberCount_boqua' => $numberCount_boqua,
            'numberCount_dasudung_pt' => $numberCount_dasudung_pt,
            'numberCount_dangcho_pt' => $numberCount_dangcho_pt,
            'numberCount_boqua_pt' => $numberCount_boqua_pt,
            //Thiết bị
            'deviceCount' => $deviceCount,
            'deviceCount_hoatdong' => $deviceCount_hoatdong,
            'deviceCount_ngunghoatdong' => $deviceCount_ngunghoatdong,
            'deviceCount_hoatdong_pt' => $deviceCount_hoatdong_pt,
            //Dịch vụ
            'serviceCount' => $serviceCount,
            'serviceCount_hoatdong' => $serviceCount_hoatdong,
            'serviceCount_ngunghoatdong' => $serviceCount_ngunghoatdong,
            'serviceCount_hoatdong_pt' => $serviceCount_hoatdong_pt,

            'labels' => $labels,
            'counts' => $counts,
            'currentDay' => date('d'),
            'currentMonth' => date('F'),
            'currentYear' => date('Y'),
        ]);
    }

    //Hiển thị trang thiết bị
    public function showThietbi() {
        $devices = Device::join('members', 'devices.memberid', '=', 'members.memberid')
            ->select('devices.*', 'members.tinhtrang')
            ->search()
            ->orderBy('devices.deviceid', 'asc');
        
        // Lọc theo trạng thái
        if ($tinhtrang = request()->tinhtrang) {
            $devices = $devices->where('devices.tinhtrang', $tinhtrang);
        }
        
        // Lọc theo kết nối
        if ($ketnoi = request()->ketnoi) {
            $devices = $devices->where('devices.ketnoi', $ketnoi);
        }
        
        foreach ($devices->get() as $device) {
            $status = Member::where('tinhtrang', $device->tinhtrang)->first();
            if ($status) {
                $trimmedStatus = substr($status->tinhtrang, 0, 255); // Truncate to fit the column's length
                DB::table('devices')->where('deviceid', $device->deviceid)->update(['tinhtrang' => $trimmedStatus]);
            }
        }
            

        $devices = $devices->paginate(9);
        
        return view('Menu/Thietbi/thietbi', ['thietbi' => $devices]);
    }

    public function showThemthietbi() {
        return view('Menu/Thietbi/themthietbi');
    }
    //Chức năng thêm thiết bị
    public function Themthietbi(Request $r) {
        $member = Member::user(); 
        $validator = Validator::make($r->all(), [
            'matb' => 'required',
            'loaitb' => 'required',
            'tentb' => 'required',
            'tendn' => 'required|unique:devices, "memberlogin"',
            'diachiip' => 'required',
            'matkhau' => 'required',
            'dichvusd' => 'required',
        ]);
    
        // Check if there are any validation errors
        if ($validator->fails()) {
            // If there are errors, redirect back to the add device page with error messages
            return redirect('/themthietbi')
                ->withErrors($validator)
                ->withInput();
        } else {
            // If there are no errors, get the input data and continue processing
            $matb = $r->input('matb');
            $loaitb = $r->input('loaitb');
            $tentb = $r->input('tentb');
            $tendn = $r->input('tendn');
            $diachiip = $r->input('diachiip');
            $matkhau = $r->input('matkhau');
            $dichvusd = $r->input('dichvusd');
    
            // Check if the login credentials are valid
            $credentials = [
                'memberlogin' => $tendn,
                'password' => $matkhau,
            ];
            if (Auth::attempt($credentials, true)) {
                $user = Auth::user();
            
                DB::table('devices')->updateOrInsert(
                    ['devicecode' => $matb],
                    [
                        'memberid' => $user->memberid,
                        'devicetype' => $loaitb,
                        'devicename' => $tentb,
                        'ipaddress' => $diachiip,
                        'service' => $dichvusd,
                        'tinhtrang' => $user->tinhtrang,
                        'ketnoi' => 'Mất kết nối',
                        'membername' => $user->membername,
                        'email' => $user->email,
                        'tel' => $user->tel,
                        'vaitro' => $user->vaitro,
                        'memberlogin' => $tendn,
                        'password' => $matkhau
                    ]
                );
            
                $updatingMember = Member::find($member->memberid);

                $diary = new Diary();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now = Carbon::now();
                $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                $diary->impacttime = $vn_time;
                
                if ($updatingMember) {
                    $diary->member()->associate($updatingMember);
                    $diary->memberid = $updatingMember->memberid;
                    $ipAddress = getHostByName(getHostName());
                    $diary->ipdone = $ipAddress;
                }
            
                $diary->thaotac = 'Thêm thiết bị ' . $matb;
                $diary->save();
            
                return redirect('/themthietbi')->with('success', 'Thêm thiết bị thành công.');
            } else {
                return redirect('/themthietbi')->with('error', 'Thêm thiết bị thất bại, vui lòng kiểm tra lại tên đăng nhập và mật khẩu!!!');
            }
        }
    }

    //Hiển thị trang chi tiết thiết bị
    public function showCTthietbi($deviceid) {
        $device = Device::where('devices.deviceid', '=', $deviceid)
            ->firstOrFail();
        return view('Menu/Thietbi/ctthietbi', ['device' => $device]);
    }

    //Hiển thị trang cập nhật thiết bị
    public function showCapnhatthietbi($deviceid) {
        $device = Device::where('devices.deviceid', '=', $deviceid)
            ->firstOrFail();
        return view('Menu/Thietbi/capnhatthietbi', ['device' => $device]);
    }
    //Chức năng cập nhật thiết bị
    public function Capnhatthietbi(Request $r) {
        $member = Member::user(); 
        $deviceid = $r['deviceid'];
        $device = Device::where('deviceid', $deviceid)->first();
        $messages=[];
        $validator= Validator::make($r->all(), [
            'matb' => 'required',
            'loaitb' => 'required',
            'tentb' => 'required',
            'diachiip' => 'required',
            'dichvusd' => 'required',
            'tendn' => [
                'required',
                Rule::unique('devices', 'memberlogin')->ignore($device->memberid, 'memberid'),
            ],
            'matkhau' => 'required',
        ],$messages);
    
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $device->devicename = $r->tentb;
            $device->devicecode = $r->matb;
            $device->devicetype = $r->loaitb;
            $device->ipaddress = $r->diachiip;
            $device->service = $r->dichvusd;
            $device->memberlogin = $r->tendn;
            $device->password = $r->matkhau;
    
            $credentials = ['memberlogin' => $r->tendn, 'password' => $r->matkhau];
    
            if (Auth::attempt($credentials, true)) {
                // Nếu tên đăng nhập và mật khẩu hợp lệ, lấy thông tin người dùng từ bảng members
                $user = Auth::user();
                //Lấy memberid từ bảng members và cập nhật vào device
                $device->memberid = $user->memberid;
                $device->membername = $user->membername;
                $device->email = $user->email;
                $device->tel = $user->tel;
                $device->vaitro = $user->vaitro;
                $device->tinhtrang = $user->tinhtrang;
                //Nếu có tài khoản trong bảng members thì sẽ save lại
                $device->save();

                $updatingMember = Member::find($member->memberid);

                $diary = new Diary();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now = Carbon::now();
                $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                $diary->impacttime = $vn_time;
                
                if ($updatingMember) {
                    $diary->member()->associate($updatingMember);
                    $diary->memberid = $updatingMember->memberid;
                    $ipAddress = getHostByName(getHostName());
                    $diary->ipdone = $ipAddress;
                }
        
                $diary->thaotac = 'Cập nhật thiết bị '. $device->devicecode;
                $diary->save();
                return redirect('/capnhatthietbi/'.$device->deviceid)->with('success', 'Thiết bị đã được cập nhật thành công.');
            } else {
                return redirect('/capnhatthietbi/'.$device->deviceid)->with('error', 'Cập nhật thất bại, vui lòng kiểm tra lại tên đăng nhập và mật khẩu!!!');
            }
           
        } 
    }

    //Hiển thị trang dịch vụ
    public function showDichvu() {
        $services = Service::join('devices', 'services.deviceid', '=', 'devices.deviceid')
            ->join('members as m', 'services.memberid', '=', 'm.memberid')
            ->select('services.*', 'm.tinhtrang')
            ->search()
            ->orderBy('services.serviceid', 'asc');

        //Lọc theo tình trạng
        if ($hoatdong = request()->hoatdong) {
            $services = $services->where('m.tinhtrang', $hoatdong);
        }

        //Lọc theo thời gian
        $thoigian_dau = request()->thoigian_dau;
        $thoigian_cuoi = request()->thoigian_cuoi;
        if ($thoigian_dau && $thoigian_cuoi) {
            $services = $services->whereBetween('services.granttime', [$thoigian_dau, $thoigian_cuoi]);
        }

        foreach ($services->get() as $service) {
            $status = Member::where('tinhtrang', $service->tinhtrang)->first();
            if ($status) {
                $trimmedStatus = substr($status->tinhtrang, 0, 255); // Truncate to fit the column's length
                DB::table('services')->where('serviceid', $service->serviceid)->update(['tinhtrang' => $trimmedStatus]);
            }
        }

        $services = $services->paginate(9);
    
        return view('Menu/Dichvu/dichvu', ['dichvu' => $services]);
    }
    //Hiển thị trang thêm dịch vụ
    public function showThemdichvu() {
        return view('Menu/Dichvu/themdichvu');
    }
    //Chức năng thêm dịch vụ
    public function Themdichvu(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'madv'  => 'required|unique:services,servicecode',
            'tendv' => 'required|unique:services,servicename',
            'mota'  => 'required'
        ]);
    
        // Check if there are any validation errors
        if ($validator->fails()) {
            return redirect('/themdichvu')
                ->withErrors($validator)
                ->withInput();
        } else {
            $madv = $r->input('madv');
            $tendv = $r->input('tendv');
            $mota = $r->input('mota');
            $tangtudong = $r->input('tangtudong')? 1 : 0; //checkbox tăng tự động
            $prefix = $r->input('prefix')? 1 : 0; //checkbox prefix
            $surfix = $r->input('surfix')? 1 : 0; //checkbox surfix
            $reset = $r->input('reset')? 1 : 0; //checkbox reset
    
            // Check if the service name exists in the devices table
            $device = Device::where('service', $tendv)
                ->where('vaitro', 'Superadmin')
                ->first();
    
            if (!$device) {
                return redirect('/themdichvu')->with('error', 'Thêm dịch vụ thất bại, thiết bị hoặc vai trò superadmin không tồn tại!!!');
            }
    
            // Get the member who registered the device
            $members = $member = DB::table('members')
                ->where('memberid', $device->memberid)
                ->first();
    
            // Insert the new service into the services table
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = Carbon::now();
            $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
            DB::table('services')->insert([
                'servicecode'   => $madv,
                'memberid'      => $device->memberid,
                'deviceid'      => $device->deviceid,
                'servicename'   => $tendv,
                'describe'      => $mota,
                'granttime'     => $vn_time,
                'tinhtrang'     => $device->tinhtrang,
                'autoincrease'  => $tangtudong,
                'prefix'        => $prefix,
                'surfix'        => $surfix,
                'reset'         => $reset,
            ]);

            $member = Member::user(); 
            $updatingMember = Member::find($member->memberid);

            $diary = new Diary();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = Carbon::now();
            $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
            $diary->impacttime = $vn_time;
            
            if ($updatingMember) {
                $diary->member()->associate($updatingMember);
                $diary->memberid = $updatingMember->memberid;
                $ipAddress = getHostByName(getHostName());
                $diary->ipdone = $ipAddress;
            }

                    $diary->thaotac = 'Thêm dịch vụ ' . $madv;
                    $diary->save();

            return redirect('/themdichvu')->with('success', 'Thêm dịch vụ thành công.');
        }
    }

    //Hiển thị trang chi tiết dịch vụ
    public function showCTdichvu($serviceid) {
        $service = Service::where('services.serviceid', '=', $serviceid)
            ->firstOrFail();
        $capso = Number::join('devices', 'numbers.deviceid', '=', 'devices.deviceid')
            ->join('members as m', 'numbers.memberid', '=', 'm.memberid')
            ->select('numbers.*', 'm.tinhtrang')
            ->search()
            ->orderBy('numbers.numberid', 'asc');
    
        //Lọc theo dịch vụ
        $capso = $capso->where('numbers.service', $service->servicename);
    
        //Lọc theo trạng thái
        if ($hoatdong = request()->hoatdong) {
            $capso = $capso->where('trangthai', $hoatdong);
        }
    
        //Lọc theo thời gian
        $thoigian_dau = request()->thoigian_dau;
        $thoigian_cuoi = request()->thoigian_cuoi;
        if ($thoigian_dau && $thoigian_cuoi) {
            $capso = $capso->whereBetween('numbers.granttime', [$thoigian_dau, $thoigian_cuoi]);
        }
    
        $capso = $capso->paginate(9);
        return view('Menu/Dichvu/ctdichvu', ['service' => $service, 'number' => $capso]);
    }

    //Hiển thị trang cập nhật dịch vụ
    public function showCapnhatdichvu($serviceid) {
        $service = Service::where('services.serviceid', '=', $serviceid)
            ->firstOrFail();
        return view('Menu/Dichvu/capnhatdichvu', ['service' => $service]);
    }
    //Chức năng cập nhật dịch vụ
    public function Capnhatdichvu(Request $r) {
        $serviceid = $r['serviceid'];
        $service = Service::where('serviceid', $serviceid)->first();
        $messages=[];
        $validator= Validator::make($r->all(), [
            'madv' => [
                'required',
                Rule::unique('services', 'servicecode')->ignore($service->serviceid, 'serviceid'),
            ],
            'tendv' => [
                'required',
                Rule::unique('services', 'servicename')->ignore($service->serviceid, 'serviceid'),
            ],
            'mota' => 'required',
        ], $messages);
    
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $device = Device::where('service', $r->tendv)
            ->where('vaitro', 'Superadmin')
            ->first();
            if (!$device) {
                return redirect('/themdichvu')->with('error', 'Cập nhật dịch vụ thất bại, thiết bị không tồn tại!!!');
            }

            $member = Member::find($device->memberid);

            $service->memberid = $member->memberid;
            $service->tinhtrang = $member->tinhtrang;
            $service->deviceid = $device->deviceid;
            $service->servicecode = $r->madv;
            $service->servicename = $r->tendv;
            $service->describe = $r->mota;
            $service->autoincrease = $r->has('tangtudong');
            $service->prefix = $r->has('prefix');
            $service->surfix = $r->has('surfix');
            $service->reset = $r->has('reset');

            $service->save();
    
            $member = Member::user(); 
            $updatingMember = Member::find($member->memberid);

            $diary = new Diary();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = Carbon::now();
            $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
            $diary->impacttime = $vn_time;
            
            if ($updatingMember) {
                $diary->member()->associate($updatingMember);
                $diary->memberid = $updatingMember->memberid;
                $ipAddress = getHostByName(getHostName());
                $diary->ipdone = $ipAddress;
            }
            
                    $diary->thaotac = 'Cập nhật dịch vụ ' . $service->servicecode;
                    $diary->save();

            return redirect('/capnhatdichvu/'.$service->serviceid)->with('success', 'Dịch vụ đã được cập nhật.');
        } 
    }

    //Hiển thị trang cấp số
    public function showCapso() {
        $numbers = Number::join('devices', 'numbers.deviceid', '=', 'devices.deviceid')
            ->join('members as m', 'numbers.memberid', '=', 'm.memberid')
            ->select('numbers.*', 'm.tinhtrang')
            ->search()
            ->orderBy('numbers.numberid', 'asc');
    
        //Lọc theo tên dịch vụ
        if ($tendv = request()->tendv) {
            $numbers = $numbers->where('numbers.service', $tendv);
        }
        //Lọc theo trạng thái
        if ($tinhtrang = request()->tinhtrang) {
            $numbers = $numbers->where('trangthai', $tinhtrang);
        }
        //Lọc theo nguồn cấp
        if ($nguoncap = request()->nguoncap) {
            $numbers = $numbers->where('devices.devicetype', $nguoncap);
        }
        //Lọc theo thời gian
        $thoigian_dau = request()->thoigian_dau;
        $thoigian_cuoi = request()->thoigian_cuoi;
        if ($thoigian_dau && $thoigian_cuoi) {
            $numbers = $numbers->whereBetween('numbers.granttime', [$thoigian_dau, $thoigian_cuoi]);
        }

        $numbers = $numbers->paginate(9);
    
        return view('Menu/Capso/capso', ['capso' => $numbers]);
    }
    //Hiển thị trang cấp số mới
    public function showCapsomoi() {
        return view('Menu/Capso/capsomoi');
    }

    //Chức năng cấp số
    public function Capsomoi(Request $r)
    {

        // Validate the input
        $validator = Validator::make($r->all(), [
            'chondichvu' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/capsomoi')
                ->withErrors($validator)
                ->withInput();
        }

        // Get the next available device for the selected service
        $devices = Device::where('service', $r->chondichvu)
                ->where('vaitro', '!=', 'superadmin') //Không cho thiết bị có vaitro superadmin cấp số
                ->whereNotIn('deviceid', Number::pluck('deviceid')->toArray())
                ->orderBy('deviceid', 'asc')
                ->get();

        if ($devices->count() === 0) {
            return redirect('/capsomoi')->with('error', 'Lấy số thất bại, không còn thiết bị đăng ký dịch vụ này!!!');
        }

        $device = $devices->first();

        // Check if the device already has a number assigned to it
        $existingNumber = Number::where('memberlogin', $device->memberlogin)->first();
        if ($existingNumber) {
            return redirect('/capsomoi')->with('error', 'Tài khoản này đã được cấp số.');
        }
    
        // Create a new number instance and associate it with the member and device
        $number = new Number();
    
        // Set the necessary fields for the number
        $number->service = $r->input('chondichvu');
    
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = Carbon::now();
        $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
        $number->granttime = $vn_time;
        $number->expiry = $vn_time->copy()->addMinutes(30); // hạn 30 phút
        // $number->expiry = now()->addDays(5); // hạn 5 ngày
        $number->trangthai = 'Đang chờ';
    
        if ($device) {
            $number->device()->associate($device);
            $number->membername = $device->membername;
            $number->email = $device->email;
            $number->tel = $device->tel;
            $number->memberlogin = $device->memberlogin;
            $number->password = bcrypt($device->password);
            $number->memberid = $device->memberid;
            $number->devicetype = $device->devicetype;
            $number->deviceid = $device->deviceid;
        }
    
        // Save the number to the database
        $number->save();

        $member = Member::user(); 
        $updatingMember = Member::find($member->memberid);

        $diary = new Diary();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = Carbon::now();
        $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
        $diary->impacttime = $vn_time;
        
        if ($updatingMember) {
            $diary->member()->associate($updatingMember);
            $diary->memberid = $updatingMember->memberid;
            $ipAddress = getHostByName(getHostName());
            $diary->ipdone = $ipAddress;
        }
            
        $diary->thaotac = 'Đã cấp số cho tài khoản ' . $number->membername;
        $diary->save();
       
        // Redirect to the capso page
        return redirect('/capsomoi')->with('capsomoi', $number);
    }

    //Hiển thị trang chi tiết cấp số
    public function showCTcapso($numberid) {
        $number = Number::where('numbers.numberid', '=', $numberid)->firstOrFail();
        return view('Menu/Capso/ctcapso', ['number' => $number]);
    }

    //Hiển thị trang báo cáo
    public function showBaocao(Request $r) {
        $orderBy = 'numbers.numberid';
        $orderType = 'asc';
        $numbers = Number::join('devices', 'numbers.deviceid', '=', 'devices.deviceid')
            ->join('members as m', 'numbers.memberid', '=', 'm.memberid')
            ->select('numbers.*', 'm.tinhtrang');
    
        // process sorting
        $sortBy = $r->input('sort-by');
        $sortType = $r->input('sort-type');
        if (!empty($sortBy) && in_array($sortBy, ['numberid', 'service', 'granttime', 'trangthai', 'devicetype'])) {
            $orderBy = $sortBy;
        }
    
        if (!empty($sortType) && in_array($sortType, ['asc', 'desc'])) {
            $orderType = $sortType;
            if($orderType=='desc') {
                $orderType = 'asc';
            }else{
                $orderType = 'desc';
            }
        }
    
        //Lọc thời gian
        $thoigian_dau = $r->input('thoigian_dau');
        $thoigian_cuoi = $r->input('thoigian_cuoi');
        if ($thoigian_dau && $thoigian_cuoi) {
            $numbers = $numbers->whereBetween('numbers.granttime', [$thoigian_dau, $thoigian_cuoi]);
        }
    
        $numbers = $numbers->orderBy($orderBy, $orderType)->paginate(9);
    
        return view('Menu/Baocao/baocao', [
            'capso' => $numbers,
            'sortType' => $orderType,
        ]);
    }
    //Chức năng tải dữ liệu về
    public function Export_csv(Request $r)
    {
        // Lấy dữ liệu từ cơ sở dữ liệu
        $data = Number::all();
    
        if ($data->isEmpty()) {
            return redirect('/')->with('error', 'Không có dữ liệu để tải về.');
        }

        //Lọc thời gian
        $thoigian_dau = $r->input('thoigian_dau');
        $thoigian_cuoi = $r->input('thoigian_cuoi');
        if ($thoigian_dau && $thoigian_cuoi) {
            $numbers = $numbers->whereBetween('numbers.granttime', [$thoigian_dau, $thoigian_cuoi]);
        }

        // Tạo nội dung dữ liệu
        $content = 'STT, Tên Dịch Vụ, Thời Gian Cấp, Tình Trạng, Nguồn Cấp' . "\n"; // Tên cột
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = Carbon::now();
        $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
        
        foreach ($data as $row) {
            if ($now >=Carbon::parse($row->created_at)->addMinutes(30)) {
                $trangthai = 'Bỏ qua';
            } else if ($now >= Carbon::parse($row->created_at)->addMinutes(15)) {
                $trangthai = 'Đã sử dụng';
            } else {
                $trangthai = 'Đang chờ';
            }
        
            $content .= $row->numberid . ',' . $row->service . ',' . $vn_time . ',' . $trangthai . ',' . $row->devicetype . "\n";
        }
    
        // Tạo tên tệp tin và đường dẫn lưu trữ
        $fileName = 'baocao.csv';
        $filePath = 'exports/' . $fileName;
    
        // Lưu nội dung vào tệp tin
        Storage::put($filePath, $content);
    
        // Tạo bản ghi nhật ký
        $member = Member::user(); 
        $updatingMember = Member::find($member->memberid);

        $diary = new Diary();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = Carbon::now();
        $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
        $diary->impacttime = $vn_time;
        
        if ($updatingMember) {
            $diary->member()->associate($updatingMember);
            $diary->memberid = $updatingMember->memberid;
            $ipAddress = getHostByName(getHostName());
            $diary->ipdone = $ipAddress;
        }
    
        $diary->thaotac = 'Tải báo cáo';
        $diary->save();
    
        // Trả về phản hồi để tải về tệp tin
        return response()->download(storage_path('app/' . $filePath), $fileName, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
            'Pragma' => 'public',
        ])->deleteFileAfterSend(true);
    }

    //Hiển thị trang quản lý vai trò
    public function showVaitro() {
        $roles = Role::search()->paginate(9);
        return view('Menu/Quanlyvaitro/quanlyvaitro', ['vaitro' => $roles]);
    }
    //Hiển thị trang thêm vaitro
    public function showThemvaitro() {
        return view('Menu/Quanlyvaitro/themvaitro');
    }

    //Chức năng thêm thiết bị
    public function Themvaitro(Request $r) {
        $validator = Validator::make($r->all(), [
            'tenvt' => 'required|unique:roles,rolename',
            'mota' => 'required',
        ]);
    
        // Check if there are any validation errors
        if ($validator->fails()) {
            // If there are errors, redirect back to the add device page with error messages
            return redirect('/themvaitro')
                ->withErrors($validator)
                ->withInput();
            } else {
                $user = Auth::user();
                if($user = session('user')) {
                    $tenvt = $r->input('tenvt');
                    $mota  = $r->input('mota');
                    $themthietbi = $r->input('themthietbi')? 1 : 0; 
                    $ctthietbi = $r->input('ctthietbi')? 1 : 0; 
                    $capnhatthietbi = $r->input('capnhatthietbi')? 1 : 0; 
                    $themdichvu = $r->input('themdichvu')? 1 : 0; 
                    $ctdichvu = $r->input('ctdichvu')? 1 : 0; 
                    $capnhatdichvu = $r->input('capnhatdichvu')? 1 : 0; 
                    $capso = $r->input('capso')? 1 : 0; 
                    $ctcapso = $r->input('ctcapso')? 1 : 0; 
                    $themvaitro = $r->input('themvaitro')? 1 : 0; 
                    $capnhatvaitro = $r->input('capnhatvaitro')? 1 : 0; 
                    $themtaikhoan = $r->input('themtaikhoan')? 1 : 0; 
                    $capnhattaikhoan = $r->input('capnhattaikhoan')? 1 : 0; 
            
                    // Count the number of users with the role in the members table
                    $count = Member::where('vaitro', $tenvt)->count();
            
                    // Insert the new role into the roles table
                    DB::table('roles')->insert([
                        'rolename' => $tenvt,
                        'numberuser' => $count,
                        'describe' => $mota,
                        'Tthietbi' => $themthietbi,
                        'Ctthietbi' => $ctthietbi,
                        'Cnthietbi' => $capnhatthietbi,
                        'Tdichvu' => $themdichvu,
                        'Ctdichvu' => $ctdichvu,
                        'Cndichvu' => $capnhatdichvu,
                        'Capso' => $capso,
                        'Ctcapso' => $ctcapso,
                        'Tvaitro' => $themvaitro,
                        'Cnvaitro' => $capnhatvaitro,
                        'Ttaikhoan' => $themtaikhoan,
                        'Cntaikhoan' => $capnhattaikhoan,
                    ]);
            
                    $member = Member::user(); 
                    $updatingMember = Member::find($member->memberid);
            
                    $diary = new Diary();
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $now = Carbon::now();
                    $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                    $diary->impacttime = $vn_time;
                    
                    if ($updatingMember) {
                        $diary->member()->associate($updatingMember);
                        $diary->memberid = $updatingMember->memberid;
                        $ipAddress = getHostByName(getHostName());
                        $diary->ipdone = $ipAddress;
                    }
            
                    $diary->thaotac = 'Thêm vai trò ' . $tenvt;
                    $diary->save();
        
                    return redirect('themvaitro')->with('success', 'Thêm vai trò thành công.');
                } else {
                    $tenvt = $r->input('tenvt');
                $mota  = $r->input('mota');
                $themthietbi = $r->input('themthietbi')? 1 : 0; 
                $ctthietbi = $r->input('ctthietbi')? 1 : 0; 
                $capnhatthietbi = $r->input('capnhatthietbi')? 1 : 0; 
                $themdichvu = $r->input('themdichvu')? 1 : 0; 
                $ctdichvu = $r->input('ctdichvu')? 1 : 0; 
                $capnhatdichvu = $r->input('capnhatdichvu')? 1 : 0; 
                $capso = $r->input('capso')? 1 : 0; 
                $ctcapso = $r->input('ctcapso')? 1 : 0; 
                $themvaitro = $r->input('themvaitro')? 1 : 0; 
                $capnhatvaitro = $r->input('capnhatvaitro')? 1 : 0; 
                $themtaikhoan = $r->input('themtaikhoan')? 1 : 0; 
                $capnhattaikhoan = $r->input('capnhattaikhoan')? 1 : 0; 
        
                // Count the number of users with the role in the members table
                $count = Member::where('vaitro', $tenvt)->count();
        
                // Insert the new role into the roles table
                DB::table('roles')->insert([
                    'rolename' => $tenvt,
                    'numberuser' => $count,
                    'describe' => $mota,
                    'Tthietbi' => $themthietbi,
                    'Ctthietbi' => $ctthietbi,
                    'Cnthietbi' => $capnhatthietbi,
                    'Tdichvu' => $themdichvu,
                    'Ctdichvu' => $ctdichvu,
                    'Cndichvu' => $capnhatdichvu,
                    'Capso' => $capso,
                    'Ctcapso' => $ctcapso,
                    'Tvaitro' => $themvaitro,
                    'Cnvaitro' => $capnhatvaitro,
                    'Ttaikhoan' => $themtaikhoan,
                    'Cntaikhoan' => $capnhattaikhoan,
                ]);
    
                return redirect('themvaitro')->with('success', 'Thêm vai trò thành công.');
                }
            }
    }

    //Hiển thị trang cập nhật vai trò
    public function showCapnhatvaitro($roleid) {
        $role = Role::findOrFail($roleid);
        return view('Menu/Quanlyvaitro/capnhatvaitro', ['role' => $role]);
    }
    //Chức năng cập nhật vai trò
    public function Capnhatvaitro(Request $r)
    {
        $roleid = $r['roleid'];
        $role = Role::where('roleid', $roleid)->first();
        $messages = [];
    
        $validator = Validator::make($r->all(), [
            'mota' => 'required',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = Member::user();
            if($user = session('user')) {
            $role->describe = $r->mota;
            $role->Tthietbi = $r->has('themthietbi');
            $role->Ctthietbi = $r->has('ctthietbi');
            $role->Cnthietbi = $r->has('capnhatthietbi');
            $role->Tdichvu = $r->has('themdichvu');
            $role->Ctdichvu = $r->has('ctdichvu');
            $role->Cndichvu = $r->has('capnhatdichvu');
            $role->Capso = $r->has('capso');
            $role->Ctcapso = $r->has('ctcapso');
            $role->Tvaitro = $r->has('themvaitro');
            $role->Cnvaitro = $r->has('capnhatvaitro');
            $role->Ttaikhoan = $r->has('themtaikhoan');
            $role->Cntaikhoan = $r->has('capnhattaikhoan');
            $role->save();
    
            // Get the updating member and the logged-in member
            $member = Member::user(); 
            $updatingMember = Member::find($member->memberid);
    
            $diary = new Diary();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = Carbon::now();
            $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
            $diary->impacttime = $vn_time;
            
            if ($updatingMember) {
                $diary->member()->associate($updatingMember);
                $diary->memberid = $updatingMember->memberid;
                $ipAddress = getHostByName(getHostName());
                $diary->ipdone = $ipAddress;
            }
    
            $diary->thaotac = 'Cập nhật vai trò ' . $role->rolename; 
            $diary->save();
    
            return redirect('/capnhatvaitro/'.$roleid)->with('success', 'Vai trò đã được cập nhật thành công.');
            } else {
            $role->describe = $r->mota;
            $role->Tthietbi = $r->has('themthietbi');
            $role->Ctthietbi = $r->has('ctthietbi');
            $role->Cnthietbi = $r->has('capnhatthietbi');
            $role->Tdichvu = $r->has('themdichvu');
            $role->Ctdichvu = $r->has('ctdichvu');
            $role->Cndichvu = $r->has('capnhatdichvu');
            $role->Capso = $r->has('capso');
            $role->Ctcapso = $r->has('ctcapso');
            $role->Tvaitro = $r->has('themvaitro');
            $role->Cnvaitro = $r->has('capnhatvaitro');
            $role->Ttaikhoan = $r->has('themtaikhoan');
            $role->Cntaikhoan = $r->has('capnhattaikhoan');
            $role->save();
    
            return redirect('/capnhatvaitro/'.$roleid)->with('success', 'Vai trò đã được cập nhật thành công.');
            }
        } 
    }

    //Hiển thị trang quản lý tài khoản
    public function showTaikhoan() {
        $members = Member::search()->orderby()->orderby('memberid', 'desc')->paginate(9);
        $roles = Role::get();
        return view('Menu/Quanlytaikhoan/quanlytaikhoan', ['taikhoan' => $members], ['vaitro' => $roles]);
    }
    //Hiển thị trang thêm tài khoản
    public function showThemtaikhoan() {
        $roles = Role::get();
        return view('Menu/Quanlytaikhoan/themtaikhoan', ['vaitro' => $roles]);
    }
    //Chức năng thêm tài khoản
    public function Themtaikhoan(Request $r) {
        $messages=[];
        $validator= validator::make($r->all(),[
            'tennd' => 'required',
            'tendn' => 'required|unique:members, "memberlogin"',
            'sdt' => 'required|unique:members, "tel"',
            'matkhau' => 'required',
            'email' => 'required|unique:members, "email"',
            'nlmatkhau' => 'required|same:matkhau',
            'tinhtrang' => 'required',
            'vaitro' => 'required',
        ],$messages);
        if($validator->fails())
            return redirect('/themtaikhoan')->withErrors($validator)->withInput();
        else {
            $user = Auth::user();
            if($user = session('user')) {
                $tennd     = $r->input('tennd');
                $tendn     = $r->input('tendn');
                $sdt       = $r->input('sdt');
                $matkhau = bcrypt($r->input('matkhau'));
                $email     = $r->input('email');
                $tinhtrang    = $r->input('tinhtrang');
                $vaitro    = $r->input('vaitro');
            
                DB::insert('insert into members (membername, memberlogin, tel, password, email, tinhtrang, vaitro)
                values (?, ?, ?, ?, ?, ?, ?)',[$tennd, $tendn, $sdt, $matkhau, $email, $tinhtrang, $vaitro]);
            
                $member = Member::user(); 
                $updatingMember = Member::find($member->memberid);
        
                $diary = new Diary();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now = Carbon::now();
                $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                $diary->impacttime = $vn_time;
                
                if ($updatingMember) {
                    $diary->member()->associate($updatingMember);
                    $diary->memberid = $updatingMember->memberid;
                    $ipAddress = getHostByName(getHostName());
                    $diary->ipdone = $ipAddress;
                }
        
                $diary->thaotac = 'Thêm tài khoản ' .  $tendn;
                $diary->save();

                return redirect('themtaikhoan')->with('success', 'Thêm tài khoản thành công.');
            } else {
                $tennd     = $r->input('tennd');
                $tendn     = $r->input('tendn');
                $sdt       = $r->input('sdt');
                $matkhau = bcrypt($r->input('matkhau'));
                $email     = $r->input('email');
                $tinhtrang    = $r->input('tinhtrang');
                $vaitro    = $r->input('vaitro');
            
                DB::insert('insert into members (membername, memberlogin, tel, password, email, tinhtrang, vaitro)
                values (?, ?, ?, ?, ?, ?, ?)',[$tennd, $tendn, $sdt, $matkhau, $email, $tinhtrang, $vaitro]);
                return redirect('themtaikhoan')->with('success', 'Thêm tài khoản thành công.');
            }
        }
    }
    //Hiển thị trang cập nhật tài khoản
    public function showCapnhattaikhoan($memberid) {
        $member = Member::findOrFail($memberid);
        $roles = Role::get();
    return view('Menu/Quanlytaikhoan/capnhattaikhoan', compact('member', 'roles'));
    }

    //Cập nhật tài khoản người dùng
    public function Capnhattaikhoan(Request $r) {
        $memberid = $r['memberid'];
        $updatingMember = Member::where('memberid', $memberid)->first();
        $loggedInMember = Member::user();
        $messages=[];
        $validator= Validator::make($r->all(), [
            'tennd' => 'required',
            'tendn' => [
                'required',
                Rule::unique('members', 'memberlogin')->ignore($updatingMember->memberid, 'memberid'),
            ],
            'sdt' => [
                'required',
                Rule::unique('members', 'tel')->ignore($updatingMember->memberid, 'memberid'),
            ],
            'email' => [
                'required',
                Rule::unique('members', 'email')->ignore($updatingMember->memberid, 'memberid'),
            ],
            'vaitro' => 'required',
            'tinhtrang' => 'required',
        ],$messages);
    
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $updatingMember->membername = $r->tennd;
            $updatingMember->memberlogin = $r->tendn;
            $updatingMember->tel = $r->sdt;
            $updatingMember->email = $r->email;
            $updatingMember->vaitro = $r->vaitro;
            $updatingMember->tinhtrang = $r->tinhtrang;
            $updatingMember->save();
    
            $diary = new Diary();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now = Carbon::now();
            $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
            $diary->impacttime = $vn_time;
            
            if ($loggedInMember) {
                $diary->member()->associate($loggedInMember);
                $diary->memberid = $loggedInMember->memberid;
                $ipAddress = getHostByName(getHostName());
                $diary->ipdone = $ipAddress;
            }

            $diary->thaotac = 'Cập nhật tài khoản '.$updatingMember->memberlogin;
            $diary->save();
    
            return redirect('/capnhattaikhoan/'.$updatingMember->memberid)->with('success', 'Tài khoản đã được cập nhật thành công.');
        } 
    }

    //Hiển thị trang nhật ký người dùng
    public function showNhatky() {                          
        $diarys = Diary::join('members', 'diarys.memberid', '=', 'members.memberid')
            ->select('diarys.*', 'members.memberlogin')
            ->orderBy('diaryid', 'asc')
            ->search();

        //Lọc theo thời gian
        $thoigian_dau = request()->thoigian_dau;
        $thoigian_cuoi = request()->thoigian_cuoi;
        if ($thoigian_dau && $thoigian_cuoi) {
            $diarys = $diarys->whereBetween('diarys.impacttime', [$thoigian_dau, $thoigian_cuoi]);
        }
        $diarys = $diarys->paginate(9);
        
        return view('Menu/nhatky', ['nhatky' => $diarys]);
    }

}