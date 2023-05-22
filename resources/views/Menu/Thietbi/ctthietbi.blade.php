@extends("Template.templates")

@section('ctthietbi')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
        <!-- Hiện thông tin user -->
        
        <form action="" style="width: 1220px; height: 710px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            @if($user = session('user'))
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Thiết bị
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/thietbi" style="color: #848387; text-decoration: none;">Danh sách thiết bị</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Chi tiết thiết bị</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý thiết bị</h5>
                    <div style="display: flex">
                
                    <div class="khung_themthietbi" style="height: 500px;">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin thiết bị</p>
                            <div class="row">

                                <!--  -->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6" style="width: 130px;"><p>Mã thiết bị:</p></div>
                                        <div class="col-lg-6" style="width: 290px; color: #848387;"><span>{{ $device->devicecode }}</span></div>

                                        <div class="col-lg-6" style="width: 130px;"><p>Tên thiết bị:</p></div>
                                        <div class="col-lg-6" style="width: 290px; color: #848387;"><span>{{$device->devicename}}</span></div>

                                        <div class="col-lg-6" style="width: 130px;"><p>Địa chỉ IP:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$device->ipaddress}}</span></div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6" style="width: 140px;"><p>Loại thiết bị:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$device->devicetype}}</span></div>

                                        <div class="col-lg-6" style="width: 140px;"><p>Tên đăng nhập:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$device->memberlogin}}</span></div>

                                        <div class="col-lg-6" style="width: 140px;"><p>Mật khẩu:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{ Str::limit($device->password, 23) }}</div>
                                    </div>
                                </div>
                       
                                    <p>Dịch vụ sử dụng:</p>
                                    <span style="color: #848387; line-height: 10px;">
                                        {{$device->service}}</span>
                          
                            </div>
                      
                        </div>
                    </div>
                    <?php
                        $thanhvien = Session::get('user');
                        $vaitro = $thanhvien->vaitro;
                        $role_vaitro = \App\Models\Role::where('rolename', '=', $vaitro)->first();
                        $Cnthietbi = $role_vaitro->Cnthietbi;
                    ?>
                    <!-- Button cập nhật thiết bị -->
                    @if($role_vaitro && $role_vaitro->Cnthietbi == 1)
                    <div class="themthietbi" style="margin-left: 25px; margin-top: 25px;">
                        <a href="{{url('/capnhatthietbi/' . $device->deviceid)}}" style="text-decoration: none; color: orangered;">
                            <div>
                                <p><i class="fa-solid fa-square-pen"></i><br>
                                Cập nhật <br> thiết bị</p>
                            </div>
                        </a>
                    </div>
                    @endif

                    </div>
                </div>

            </div>
            @endif
        </form>

@endsection

