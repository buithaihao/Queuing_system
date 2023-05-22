@extends("Template.templates")

@section('vaitro')
<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Member;

$user = session('user');
$user = Auth::user();

?>
<form action="" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
    @csrf
    <div class="container mt-4">

        <div class="row">
            <!-- Chia khung bên trái -->
            <div class="col-lg-4">
                <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt
                    hệ thống
                    <span style="font-size: 10px; position: absolute; top: 38px;"><i
                            class="fa-solid fa-chevron-right"></i></span>
                    <span style="color: orangered; padding-left: 10px;">Quản lý vai trò</span>
                </p>
            </div>
        </div>

        <div class="mt-3">
            <h5 style="color: orangered; font-size: 28px; margin-bottom: -40px;">Danh sách vai trò</h5>
            <div class="row" style="width: 1200px;">
                <!-- Danh sách thiết bị -->
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- code... -->
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
            <!--  -->
            <div class="content-device" style="display: flex;">
                <div class="table-list-device">
                    <table>
                        <thead>
                            <tr>
                                <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Tên vai trò</td>
                                <td class="border-table" style="color: #ffffff; font-size: 16px;">Số người dùng</td>
                                <td class="border-table" style="color: #ffffff; font-size: 16px;">Mô tả</td>
                                <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vaitro as $key => $role)
                            <tr class="color-tr-white">
                                <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">
                                    {{ $role->rolename }}
                                </td>
                                <?php
                                    $count = Member::where('vaitro', $role->rolename)->count();
                                    DB::table('roles')->where('roleid', $role->roleid)->update(['numberuser' => $count]);
                                ?>
                                <td class="border-table">{{ $role->numberuser }}</td>
                                <td class="border-table">{{ $role->describe }}</td>
                                <td class="{{ $loop->last ? 'th-border-bottom-right' : '' }}">
                                <?php
                                    $thanhvien = Session::get('user');
                                    if ($thanhvien) {
                                        $vaitro = $thanhvien->vaitro;
                                        $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                        $Cnvaitro = $role_vaitro->Cnvaitro;
                                    }
                                ?>
                                @if($thanhvien && $role_vaitro && $role_vaitro->Cnvaitro == 1)
                                    <a href="{{ url('/capnhatvaitro/' . $role->roleid) }}">Cập nhật</a>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- Button thêm thiết bị -->
                <?php
                    $thanhvien = Session::get('user');
                    if ($thanhvien) {
                        $vaitro = $thanhvien->vaitro;
                        $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                        $Cnvaitro = $role_vaitro->Cnvaitro;
                    }
                ?>
                @if($thanhvien && $role_vaitro)
                    @if($role_vaitro->Tvaitro == 1)
                        <div class="themthietbi">
                            <a href="{{ url('') }}/themvaitro" style="text-decoration: none; color: orangered;">
                                <div>
                                    <p><i class="fa-solid fa-square-plus"></i><br>
                                        Thêm <br> vai trò</p>
                                </div>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="themthietbi">
                        <a href="{{ url('') }}/themvaitro" style="text-decoration: none; color: orangered;">
                            <div>
                                <p><i class="fa-solid fa-square-plus"></i><br>
                                    Thêm <br> vai trò</p>
                            </div>
                        </a>
                    </div>
                @endif

            </div>
            <!--  -->
        </div>

        <!-- Phân trang -->
        <div class="phantrang">
            @if ($vaitro instanceof Illuminate\Pagination\LengthAwarePaginator && $vaitro->hasPages())
            <ul class="trang">
                @if ($vaitro->onFirstPage())
                <li>
                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                </li>
                @else
                <li>
                    <a href="{{ $vaitro->previousPageUrl() }}" style="font-size: 29px;"><i
                            class="fa-solid fa-caret-left"></i></a>
                </li>
                @endif

                <!-- Display first three pages -->
                @foreach ($vaitro->getUrlRange(1, min(3, $vaitro->lastPage())) as $page => $url)
                @if ($page == $vaitro->currentPage())
                <li class="modautrang"><a href="">{{ $page }}</a></li>
                @else
                <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach

                <!-- Display last page -->
                @if ($vaitro->lastPage() > 3)
                <li class="ellipsis"><span>...</span></li>
                @foreach ($vaitro->getUrlRange($vaitro->lastPage(), $vaitro->lastPage()) as $page => $url)
                @if ($page == $vaitro->currentPage())
                <li class="modautrang"><a href="">{{ $page }}</a></li>
                @else
                <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach
                @endif

                @if ($vaitro->hasMorePages())
                <li>
                    <a href="{{ $vaitro->nextPageUrl() }}" style="font-size: 29px;"><i
                            class="fa-solid fa-caret-right"></i></a>
                </li>
                @else
                <li>
                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
                </li>
                @endif
            </ul>
            @endif
        </div>

    </div>
</form>
@endsection