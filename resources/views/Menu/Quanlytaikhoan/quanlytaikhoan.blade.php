@extends("Template.templates")

@section('quanlytaikhoan')
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
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Quản lý tài khoản</span></p>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 style="color: orangered; font-size: 28px;">Danh sách tài khoản</h5>
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                            <div class="col-lg-4">
                                <p style="font-weight: 600; line-height: 40px;">Tên vai trò
                                    <span class="dropdown-icon">
                                    <select name="tenvaitro" class="dropd" onchange="this.form.submit()">
                                            <option value="" {{ request('tenvaitro') == '' ? 'selected' : '' }}>Tất cả</option>
                                        @foreach($vaitro as $key => $role)
                                            <option value="{{ $role->rolename }}" {{ request('tenvaitro') == $role->rolename ? 'selected' : '' }}>{{ $role->rolename }}</option>
                                        @endforeach
                                    </select>
                                        <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <!-- code... -->
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
                    @endif
                    <!--  -->
                    <div class="content-device" style="display: flex;">
                        @if($user = session('user'))
                        <div class="table-list-device">
                            
                            <table>
                                <thead>
                                    <tr>
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Tên đăng nhập</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Họ tên</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">Số điện thoại</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Email</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Vai trò</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">Trạng thái hoạt động</td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($taikhoan as $key => $member)
                                    <tr class="color-tr-white">
                                        <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">
                                            {{ $member->memberlogin }}
                                        </td>
                                        <td class="border-table">{{ $member->membername }}</td>
                                        <td class="border-table">{{ $member->tel }}</td>
                                        <td class="border-table">{{ $member->email }}</td>
                                        <td class="border-table">{{ $member->vaitro }}</td>
                                        <td>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="{{ $member->tinhtrang == 'Hoạt động' ? '#35c75a' : '#E73F3F' }}" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $member->tinhtrang }}
                                        </td>
                                        <td class="{{ $loop->last ? 'th-border-bottom-right' : '' }}">
                                            <?php
                                                $thanhvien = Session::get('user');
                                                if ($thanhvien) {
                                                    $vaitro = $thanhvien->vaitro;
                                                    $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                                    $Cntaikhoan = $role_vaitro->Cntaikhoan;
                                                }
                                            ?>
                                            @if($thanhvien && $role_vaitro && $role_vaitro ->Cntaikhoan==1)
                                                <a href="{{ url('/capnhattaikhoan/' . $member->memberid) }}">Cập nhật</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>
                            @endif

                            <!-- Button thêm thiết bị -->
                            <?php
                                  $thanhvien = Session::get('user');
                                  if ($thanhvien) {
                                      $vaitro = $thanhvien->vaitro;
                                      $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                      $Ttaikhoan = $role_vaitro->Ttaikhoan;
                                  }
                            ?>
                            @if($thanhvien && $role_vaitro)
                                @if($role_vaitro->Ttaikhoan == 1)
                                    <div class="themthietbi">
                                        <a href="{{ url('') }}/themtaikhoan" style="text-decoration: none; color: orangered;">
                                            <div>
                                                <p><i class="fa-solid fa-square-plus"></i><br>
                                                    Thêm <br> tài khoản</p>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="themthietbi">
                                    <a href="{{ url('') }}/themtaikhoan" style="text-decoration: none; color: orangered;">
                                        <div>
                                            <p><i class="fa-solid fa-square-plus"></i><br>
                                                Thêm <br> tài khoản</p>
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
                    @if ($taikhoan instanceof Illuminate\Pagination\LengthAwarePaginator && $taikhoan->hasPages())
                        <ul class="trang">
                            @if ($taikhoan->onFirstPage())
                                <li>
                                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $taikhoan->previousPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @endif

                            <!-- Display first three pages -->
                            @foreach ($taikhoan->getUrlRange(1, min(3, $taikhoan->lastPage())) as $page => $url)
                                @if ($page == $taikhoan->currentPage())
                                    <li class="modautrang"><a href="">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <!-- Display last page -->
                            @if ($taikhoan->lastPage() > 3)
                                <li class="ellipsis"><span>...</span></li>
                                @foreach ($taikhoan->getUrlRange($taikhoan->lastPage(), $taikhoan->lastPage()) as $page => $url)
                                    @if ($page == $taikhoan->currentPage())
                                        <li class="modautrang"><a href="">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif

                            @if ($taikhoan->hasMorePages())
                                <li>
                                    <a href="{{ $taikhoan->nextPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
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

@endsection

