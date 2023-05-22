@extends("Template.templates")

@section('capso')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
@if($user = session('user'))
        <form action="" style="width: 1220px; height: 800px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cấp số
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Danh sách cấp số</span></p>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý cấp số</h5>
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                            <div class="col-lg-2">
                                <p style="font-weight: 600; line-height: 35px; margin-top: 5px;">Tên dịch vụ <br>
                                    <span class="dropdown-icon_capso">
                                    <select name="tendv" class="dropd_capso" onchange="this.form.submit()">
                                        <option value="" {{ request('tendv') == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                                        <option value="Khám sản - Phụ khoa" {{ request('tendv') == 'Khám sản - Phụ khoa' ? 'selected' : '' }}>Khám sản - Phụ khoa</option>
                                        <option value="Khám răng hàm mặt" {{ request('tendv') == 'Khám răng hàm mặt' ? 'selected' : '' }}>Khám răng hàm mặt</option>
                                        <option value="Khám tai mũi họng" {{ request('tendv') == 'Khám tai mũi họng' ? 'selected' : '' }}>Khám tai mũi họng</option>
                                        <option value="Khám tim mạch" {{ request('tendv') == 'Khám tim mạch' ? 'selected' : '' }}>Khám tim mạch</option>
                                        <option value="Khám hô hấp" {{ request('tendv') == 'Khám hô hấp' ? 'selected' : '' }}>Khám hô hấp</option>
                                        <option value="Khám tổng quát" {{ request('tendv') == 'Khám tổng quát' ? 'selected' : '' }}>Khám tổng quát</option>
                                    </select>
                                    <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-lg-2">
                                <p style="font-weight: 600; line-height: 35px; margin-top: 5px;">Tình trạng <br>
                                    <span class="dropdown-icon_capso">
                                    <select name="tinhtrang" class="dropd_capso" onchange="this.form.submit()">
                                        <option value="" {{ request('tinhtrang') == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                                        <option value="Đang chờ" {{ request('tinhtrang') == 'Đang chờ' ? 'selected' : '' }}>Đang chờ</option>
                                        <option value="Đã sử dụng" {{ request('tinhtrang') == 'Đã sử dụng' ? 'selected' : '' }}>Đã sử dụng</option>
                                        <option value="Bỏ qua" {{ request('tinhtrang') == 'Bỏ qua' ? 'selected' : '' }}>Bỏ qua</option>
                                    </select>
                                    <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-lg-2">
                                <p style="font-weight: 600; line-height: 35px; margin-top: 5px;">Nguồn cấp <br>
                                    <span class="dropdown-icon_capso">
                                    <select name="nguoncap" class="dropd_capso" onchange="this.form.submit()">
                                        <option value="" {{ request('nguoncap') == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                                        <option value="Kiosk" {{ request('nguoncap') == 'Kiosk' ? 'selected' : '' }}>Kiosk</option>
                                        <option value="Display counter" {{ request('nguoncap') == 'Display counter' ? 'selected' : '' }}>Display counter</option>
                                    </select>
                                    <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
                                <p style="display: flex; align-items: center;">
                                    <input type="date" class="chonthoigian" name="thoigian_dau" onchange="this.form.submit()" value="{{ request()->thoigian_dau }}">
                                    <span style="font-size: 16px; margin: 0px 10px;"><i class="fa-solid fa-caret-right"></i></span>
                                    <input type="date" class="chonthoigian" name="thoigian_cuoi" onchange="this.form.submit()" value="{{ request()->thoigian_cuoi }}">
                                </p>
                            </div>
                                <div class="col-lg-4" style="width: 150px;">
                                    <p style="font-weight: 600; line-height: 40px;">Từ khóa
                                        <span class="dropdown-icon_search">
                                            <input type="search" class="dropd_search" name="timkiem" placeholder="Nhập từ khóa">
                                            <span class="icon_search"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <!--  -->
                    <div class="content-device" style="display: flex;">
                        <div class="table-list-device">
                            <table>
                                <thead>
                                    <tr>
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">STT</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên khách hàng</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên dịch vụ</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Thời gian cấp</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Hạn sử dụng</td>
                                    <td style="color: #ffffff; font-size: 16px;">Trạng thái</td>
                                    <td class="border-table-right" style="color: #ffffff; font-size: 16px;">Nguồn cấp</td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($capso as $key => $number)
                                <tr class="color-tr-white">
                                    <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">
                                        {{ $number->numberid }}
                                    </td>
                                    <td class="border-table">{{ $number->membername }}</td>
                                    <td class="border-table">{{ $number->service }}</td>
                                    <td class="border-table">{{ $number->granttime }}</td>
                                    <td class="border-table">{{ $number->expiry }}</td>
                                    <td>
                                        <?php
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $now = \Carbon\Carbon::now();
                                        $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                                        $number->granttime = $vn_time;
                                        $number->expiry = $vn_time->copy()->addMinutes(30);
                                        ?>
                                        @if (now() >= Carbon\Carbon::parse($number->created_at)->addMinutes(30))
                                            <?php DB::table('numbers')->where('numberid', $number->numberid)->update(['trangthai' => 'Bỏ qua']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#E73F3F" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $number->trangthai }}
                                        @elseif(now() >= Carbon\Carbon::parse($number->created_at)->addMinutes(15))
                                            <?php DB::table('numbers')->where('numberid', $number->numberid)->update(['trangthai' => 'Đã sử dụng']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#7e7d88" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $number->trangthai }}
                                        @else 
                                            <?php DB::table('numbers')->where('numberid', $number->numberid)->update(['trangthai' => 'Đang chờ']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#4277ff" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $number->trangthai }}
                                        @endif
                                    </td>
                                    <td class="border-table-right">{{ $number->devicetype }}</td>
                                    <td class="{{ $loop->last ? 'th-border-bottom-right' : '' }}">
                                    <?php
                                        $thanhvien = Session::get('user');
                                        $vaitro = $thanhvien->vaitro;
                                        $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                        $Ctcapso = $role_vaitro->Ctcapso;
                                    ?>
                                    @if($role_vaitro && $role_vaitro->Ctcapso == 1)
                                        <a href="{{url('/ctcapso/' . $number->numberid)}}">Chi tiết</a>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>

                            <!-- Button thêm thiết bị -->
                            <?php
                                $thanhvien = Session::get('user');
                                $vaitro = $thanhvien->vaitro;
                                $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                $Capso = $role_vaitro->Capso; 
                            ?>
                            @if($role_vaitro && $role_vaitro->Capso == 1)
                            <div class="themthietbi">
                                <a href="{{url('')}}/capsomoi" style="text-decoration: none; color: orangered;">
                                    <div>
                                        <p><i class="fa-solid fa-square-plus"></i><br>
                                        Cấp <br> số mới</p>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                    <!--  -->
                </div>

                <!-- Phân trang -->
                @if($user = session('user'))
                <div class="phantrang">
                    @if ($capso instanceof Illuminate\Pagination\LengthAwarePaginator && $capso->hasPages())
                        <ul class="trang">
                            @if ($capso->onFirstPage())
                                <li>
                                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $capso->previousPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @endif

                            <!-- Display first three pages -->
                            @foreach ($capso->getUrlRange(1, min(3, $capso->lastPage())) as $page => $url)
                                @if ($page == $capso->currentPage())
                                    <li class="modautrang"><a href="">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <!-- Display last page -->
                            @if ($capso->lastPage() > 3)
                                <li class="ellipsis"><span>...</span></li>
                                @foreach ($capso->getUrlRange($capso->lastPage(), $capso->lastPage()) as $page => $url)
                                    @if ($page == $capso->currentPage())
                                        <li class="modautrang"><a href="">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif

                            @if ($capso->hasMorePages())
                                <li>
                                    <a href="{{ $capso->nextPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
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
        </form>
@endif
@endsection

