@extends("Template.templates")

@section('thietbi')
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
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Thiết bị
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Danh sách thiết bị</span></p>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 style="color: orangered; font-size: 28px;">Danh sách thiết bị</h5>
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p style="font-weight: 600; line-height: 40px;">Trạng thái hoạt động
                                        <span class="dropdown-icon">
                                            <select name="tinhtrang" class="dropd" onchange="this.form.submit()">
                                                <option value="" {{ in_array(request('tinhtrang'), ['Tất cả', null]) ? 'selected' : '' }}>Tất cả</option>
                                                <option value="Hoạt động" {{ request('tinhtrang') == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="Ngưng hoạt động" {{ request('tinhtrang') == 'Ngưng hoạt động' ? 'selected' : '' }}>Ngưng hoạt động</option>
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <p style="font-weight: 600; line-height: 40px;">Trạng thái kết nối
                                        <span class="dropdown-icon">
                                            <select name="ketnoi" class="dropd" onchange="this.form.submit()">
                                                <option value="" {{ in_array(request('ketnoi'), ['Tất cả', null]) ? 'selected' : '' }}>Tất cả</option>
                                                <option value="Kết nối" {{ request('ketnoi') == 'Kết nối' ? 'selected' : '' }}>Kết nối</option>
                                                <option value="Mất kết nối" {{ request('ketnoi') == 'Mất kết nối' ? 'selected' : '' }}>Mất kết nối</option>
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <p style="font-weight: 600; line-height: 40px; margin-left: 150px;">Từ khóa
                                        <span class="dropdown-icon">
                                            <input type="search" class="dropd" name="timkiem" placeholder="Nhập từ khóa">
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
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Mã thiết bị</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên thiết bị</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">Địa chỉ IP</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Trạng thái hoạt động</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Trạng thái kết nối</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Dịch vụ sử dụng</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;"></td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($thietbi as $key => $device)
                                    <!-- Dòng thứ nhất -->
                                    <tr class="color-tr-white">
                                        <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">
                                            {{ $device->devicecode }}
                                        </td>
                                        <td class="border-table">{{ $device->devicename }}</td>
                                        <td>{{ $device->ipaddress }}</td>
                                        <td class="border-table">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="{{ $device->tinhtrang == 'Hoạt động' ? '#35c75a' : '#E73F3F' }}" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $device->tinhtrang }}
                                            </td>
                                        <td class="border-table">
                                        @if ($device->memberid == $user->memberid)
                                            <?php DB::table('devices')->where('deviceid', $device->deviceid)->update(['ketnoi' => 'Kết nối']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#35c75a" />
                                            </svg> {{ $device->ketnoi }}
                                        @else
                                            <?php DB::table('devices')->where('deviceid', $device->deviceid)->update(['ketnoi' => 'Mất kết nối']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" fill="#E73F3F" />
                                            </svg> {{ $device->ketnoi }}
                                        @endif
                                        </td>
                                        <td>
                                            <p>{{ Str::limit($device->service, 23) }}
                                                @if(strlen($device->service) > 23)
                                                <br><br><a href="{{ url('/ctthietbi/' . $device->deviceid) }}">Xem thêm</a></p>
                                                @endif
                                        </td>
                                        <td>
                                        <?php
                                            $thanhvien = Session::get('user');
                                            $vaitro = $thanhvien->vaitro;
                                            $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                            $Ctthietbi = $role_vaitro->Ctthietbi;
                                            $Cnthietbi = $role_vaitro->Cnthietbi;
                                        ?>

                                        @if($role_vaitro && $role_vaitro->Ctthietbi == 1)
                                            <a href="{{ url('/ctthietbi/' . $device->deviceid) }}">Chi tiết</a>
                                        @endif
                                        </td>
                                        <td class="{{ $loop->last ? 'th-border-bottom-right' : '' }}">
                                        @if($role_vaitro && $role_vaitro->Cnthietbi == 1)
                                            <a href="{{url('/capnhatthietbi/' . $device->deviceid)}}">Cập nhật</a>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>

                            <?php
                                $thanhvien = Session::get('user');
                                $vaitro = $thanhvien->vaitro;
                                $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                $Tthietbi = $role_vaitro->Tthietbi;
                            ?>
                            <!-- Button thêm thiết bị -->
                            @if($role_vaitro && $role_vaitro->Tthietbi == 1)
                            <div class="themthietbi">
                                <a href="{{url('/')}}/themthietbi" style="text-decoration: none; color: orangered;">
                                    <div>
                                        <p><i class="fa-solid fa-square-plus"></i><br>
                                        Thêm thiết bị</p>
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
                    @if ($thietbi instanceof Illuminate\Pagination\LengthAwarePaginator && $thietbi->hasPages())
                        <ul class="trang">
                            @if ($thietbi->onFirstPage())
                                <li>
                                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $thietbi->previousPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @endif

                            <!-- Display first three pages -->
                            @foreach ($thietbi->getUrlRange(1, min(3, $thietbi->lastPage())) as $page => $url)
                                @if ($page == $thietbi->currentPage())
                                    <li class="modautrang"><a href="">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <!-- Display last page -->
                            @if ($thietbi->lastPage() > 3)
                                <li class="ellipsis"><span>...</span></li>
                                @foreach ($thietbi->getUrlRange($thietbi->lastPage(), $thietbi->lastPage()) as $page => $url)
                                    @if ($page == $thietbi->currentPage())
                                        <li class="modautrang"><a href="">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif

                            @if ($thietbi->hasMorePages())
                                <li>
                                    <a href="{{ $thietbi->nextPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
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

