@extends("Template.templates")

@section('ctdichvu')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
    <form action="" style="width: 1220px; height: 840px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            @if($user = session('user'))
            <div class="container mt-4">

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Dịch vụ
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/dichvu" style="color: #848387; text-decoration: none;">Danh sách dịch vụ</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Chi tiết dịch vụ</span></p>
                    </div>
                </div>

                    <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
                    <div style="display: flex; margin-bottom: 30px;">
                
                    <div class="khung_themthietbi" style="height: 670px; width: 380px; padding-left: 10px;">
                        <div class="container">
                            <p style="padding-top: 10px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin dịch vụ</p>

                            <div class="row">

                                <div class="col-lg-6" style="width: 130px;"><p>Mã dịch vụ:</p></div>
                                <div class="col-lg-6" style="width: 130px; color: #848387;"><span>{{$service->servicecode}}</span></div>

                                <div class="col-lg-6" style="width: 130px;"><p>Tên dịch vụ:</p></div>
                                <div class="col-lg-6" style="width: 210px; color: #848387;"><span>{{$service->servicename}}</span></div>

                                <div class="col-lg-6" style="width: 130px;"><p>Mô tả:</p></div>
                                <div class="col-lg-6" style="width: 210px; color: #848387;"><span>{{$service->describe}}</span></div>
                                
                            </div>

                            <p style="font-size: 25px; font-weight: 500; color: orangered;">Quy tắc cấp số</p>

                            <div class="row">
                                @if($service->autoincrease==1)
                                <div class="col-lg-6" style="width: 170px;">
                                    <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Tăng tự động:</label>
                                </div>  
                                <div class="col-lg-6">
                                    <label><span class="tangtudong">
                                        <a href="#">0001</a></span> <span style="font-size: 18px; font-weight: 600;">đến</span> 
                                        <span class="tangtudong"><a href="#">9999</a></span></label>
                                </div>
                                @endif

                                @if($service->prefix==1)
                                <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
                                    <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Prefix:</label>
                                </div>
                                <div class="col-lg-6" style="margin-top: 20px;">
                                    <label><span class="tangtudong">
                                        <a href="#">0001</a></span></label>
                                </div>
                                @endif

                                @if($service->surfix==1)
                                <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
                                    <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Surfix:</label>
                                </div>
                                <div class="col-lg-6" style="margin-top: 20px;">
                                    <label><span class="tangtudong">
                                        <a href="#">0001</a></span></label>
                                </div>
                                @endif

                                @if($service->reset==1)
                                <div class="col-lg-6" style="width: 170px; margin-top: 20px;">
                                    <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Reset mỗi ngày</label>
                                </div>
                                @endif

                            </div>

                            <p style="font-size: 19px; font-weight: 400; line-height: 38px;">Ví dụ: 201-2001</p>

                        </div>
                    </div>

                    <div class="khung_themthietbi ms-4" style="height: 670px; width: 700px;">
                        <div class="container">
                            
                        <div class="row" style="width: 800px;">
                        <!-- Danh sách thiết bị -->
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <p style="font-weight: 600; line-height: 30px; margin-top: 11px;">Trạng thái <br>
                                            <span class="dropdown-icon_capso">
                                            <select name="hoatdong" class="dropd_capso" onchange="this.form.submit()">
                                                <option value="" {{ request('hoatdong') == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                                                <option value="Đang chờ" {{ request('hoatdong') == 'Đang chờ' ? 'selected' : '' }}>Đang chờ</option>
                                                <option value="Đã sử dụng" {{ request('hoatdong') == 'Đã sử dụng' ? 'selected' : '' }}>Đã sử dụng</option>
                                                <option value="Bỏ qua" {{ request('hoatdong') == 'Bỏ qua' ? 'selected' : '' }}>Bỏ qua</option>
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-lg-4" style="margin-left: 50px; width: 300px;">
                                        <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
                                        <p style="display: flex; align-items: center;">
                                            <input type="date" class="chonthoigian" name="thoigian_dau" onchange="this.form.submit()" value="{{ request()->thoigian_dau }}">
                                            <span style="font-size: 16px; margin: 0px 10px;"><i class="fa-solid fa-caret-right"></i></span>
                                            <input type="date" class="chonthoigian" name="thoigian_cuoi" onchange="this.form.submit()" value="{{ request()->thoigian_cuoi }}">
                                        </p>
                                    </div>
                                    <div class="col-lg-6" style="width: 185px;">
                                        <p style="font-weight: 600; line-height: 40px;">Từ khóa <br>
                                            <span class="dropdown-icon_search_ct">
                                                <input type="search" class="dropd_search" style="width: 180px;" name="timkiem" placeholder="Nhập từ khóa">
                                                <span class="icon_search"><i class="fa-solid fa-magnifying-glass"></i></span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <!--  -->
                        <div class="content-device">
                        <div class="table-list-device" style="width: 700px;">

                            <table style="width: 640px;">
                                <thead>
                                    <tr>
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Số thứ tự</td>
                                    <td class="border-table-left th-border-right" style="color: #ffffff; font-size: 16px;">Trạng thái</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Nếu tên dịch vụ bảng services bằng với tên dịch vụ ở bảng numbers thì hiện ra dữ liệu -->
                                <!-- Cùng tên dịch vụ -->
                                @foreach($number as $key => $num)
                                <tr class="color-tr-white">
                                    <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">
                                        {{ $num->numberid }}
                                    </td>   
                                    <td class="border-table-left {{ $loop->last ? 'th-border-bottom-right' : '' }}">
                                        <?php
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $now = \Carbon\Carbon::now();
                                        $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                                        $num->granttime = $vn_time;
                                        $num->expiry = $vn_time->copy()->addMinutes(30);
                                        ?>
                                        @if (now() >= Carbon\Carbon::parse($num->created_at)->addMinutes(30))
                                            <?php DB::table('numbers')->where('numberid', $num->numberid)->update(['trangthai' => 'Bỏ qua']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#E73F3F" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $num->trangthai }}
                                        @elseif(now() >= Carbon\Carbon::parse($num->created_at)->addMinutes(15))
                                            <?php DB::table('numbers')->where('numberid', $num->numberid)->update(['trangthai' => 'Đã sử dụng']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#7e7d88" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $num->trangthai }}
                                        @else 
                                            <?php DB::table('numbers')->where('numberid', $num->numberid)->update(['trangthai' => 'Đang chờ']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#4277ff" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $num->trangthai }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        </div>
                        <!--  -->

                        <!-- Phân trang -->
                        @if($user = session('user'))
                            <div class="phantrang" style="margin-left: 315px;">
                            @if ($number instanceof Illuminate\Pagination\LengthAwarePaginator && $number->hasPages())
                                <ul class="trang">
                                    @if ($number->onFirstPage())
                                        <li>
                                            <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $number->previousPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                        </li>
                                    @endif

                                    <!-- Display first three pages -->
                                    @foreach ($number->getUrlRange(1, min(3, $number->lastPage())) as $page => $url)
                                        @if ($page == $number->currentPage())
                                            <li class="modautrang"><a href="">{{ $page }}</a></li>
                                        @else
                                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    <!-- Display last page -->
                                    @if ($number->lastPage() > 3)
                                        <li class="ellipsis"><span>...</span></li>
                                        @foreach ($number->getUrlRange($number->lastPage(), $number->lastPage()) as $page => $url)
                                            @if ($page == $number->currentPage())
                                                <li class="modautrang"><a href="">{{ $page }}</a></li>
                                            @else 
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif

                                    @if ($number->hasMorePages())
                                        <li>
                                            <a href="{{ $number->nextPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                            </div>
                        @endif
                             
                        </div>
                    </div>
                    <!-- Button cập nhật thiết bị -->
                    <div>
                    <?php
                        $thanhvien = Session::get('user');
                        $vaitro = $thanhvien->vaitro;
                        $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                        $Cndichvu = $role_vaitro->Cndichvu;
                    ?>
                    @if($role_vaitro && $role_vaitro->Cndichvu == 1)
                    <div class="themthietbi" style="margin-left: 25px; margin-top: 25px; width: 90px; height: 90px; border-radius: 5px 5px 0 0;">
                        <a href="{{url('/capnhatdichvu/' . $service->serviceid)}}" style="text-decoration: none; color: orangered; display: block;">
                            <div style="text-align: center;">
                                <p><i class="fa-solid fa-square-pen"></i> <br>
                                Cập nhật danh sách</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="themthietbi" style="margin-top: 1px; padding-top: 12px; margin-left: 25px; width: 90px; height: 80px; border-radius: 0 0 5px 5px;">
                        <a href="{{url('')}}/dichvu" style="text-decoration: none; color: orangered;">
                            <div style="text-align: center;">
                                <p><i class="fa-solid fa-rotate-left"></i><br>
                                    Quay lại</p>
                            </div>
                        </a>
                    </div>
                    @else
                    <div class="themthietbi" style="margin-top: 25px; padding-top: 12px; margin-left: 25px; width: 90px; height: 80px; border-radius: 0 0 5px 5px;">
                        <a href="{{url('')}}/dichvu" style="text-decoration: none; color: orangered;">
                            <div style="text-align: center;">
                                <p><i class="fa-solid fa-square-pen"></i> <br>
                                Quay lại</p>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>

            </div>
            @endif
    </form>
    
@endsection

