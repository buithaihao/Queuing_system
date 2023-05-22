@extends("Template.templates")

@section('dichvu')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
@if($user = session('user'))
        <form action="" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Dịch vụ
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Danh sách dịch vụ</span></p>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                            <div class="col-lg-4">
                                <p style="font-weight: 600; line-height: 40px;">Trạng thái hoạt động
                                    <span class="dropdown-icon">
                                    <select name="hoatdong" class="dropd" onchange="this.form.submit()">
                                        <option value="" {{ request('hoatdong') == 'Tất cả' ? 'selected' : '' }}>Tất cả</option>
                                        <option value="Hoạt động" {{ request('hoatdong') == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                                        <option value="Ngừng hoạt động" {{ request('hoatdong') == 'Ngừng hoạt động' ? 'selected' : '' }}>Ngừng hoạt động</option>
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
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Mã dịch vụ</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Tên dịch vụ</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">Mô tả</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Trạng thái hoạt động</td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;"></td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dichvu as $key => $service)
                                    <tr class="color-tr-white">
                                        <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">{{$service-> servicecode}}</td>
                                        <td class="border-table">{{$service-> servicename}}</td>
                                        <td>{{$service-> describe}}</td>
                                        <td class="border-table">
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="{{ $service->tinhtrang == 'Hoạt động' ? '#35c75a' : '#E73F3F' }}" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4"/>
                                            </svg> {{$service-> tinhtrang}}</td>
                                        <td>
                                        <?php
                                            $thanhvien = Session::get('user');
                                            $vaitro = $thanhvien->vaitro;
                                            $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                                            $Ctdichvu = $role_vaitro->Ctdichvu;
                                            $Cndichvu = $role_vaitro->Cndichvu;
                                        ?>
                                        @if($role_vaitro && $role_vaitro->Ctdichvu == 1)
                                            <a href="{{url('/ctdichvu/' . $service->serviceid)}}">Chi tiết</a>
                                        @endif 
                                        </td>
                                        <td class="{{ $loop->last ? 'th-border-bottom-right ' : '' }}">
                                        @if($role_vaitro && $role_vaitro->Cndichvu == 1)
                                            <a href="{{url('/capnhatdichvu/' . $service->serviceid)}}">Cập nhật</a>
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
                                $Tdichvu = $role_vaitro->Tdichvu;
                            ?>
                            @if($role_vaitro && $role_vaitro->Tdichvu == 1)
                            <div class="themthietbi">
                                <a href="{{url('')}}/themdichvu" style="text-decoration: none; color: orangered;">
                                    <div>
                                        <p><i class="fa-solid fa-square-plus"></i><br>
                                        Thêm dịch vụ</p>
                                    </div>
                                </a>
                            </div>
                            @endif
                        </div>
                        <!--  -->
                        </div>

            </div>
        </form>
@endif
@endsection

