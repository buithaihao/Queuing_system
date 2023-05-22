@extends("Template.templates")

@section('capnhatthietbi')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
        <!-- Hiện thông tin user -->
        
        <form action="{{ url('/capnhatthietbi/' . $device->deviceid) }}" method="post" style="width: 1220px; height: 780px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
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
                        <span style="color: orangered; padding-left: 10px;">Cập nhật thiết bị</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý thiết bị</h5>
                    <div class="khung_themthietbi">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin thiết bị</p>
                            <div class="row">
                               
                                <!-- Input mã thiết bị -->
                                <div class="col-lg-6">
                                    <p>Mã thiết bị: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themthietbi" name="matb" value="{{ $device->devicecode }}" placeholder="Nhập mã thiết bị" style="color: #848387;">
                                        @if($errors->has('matb')) 
                                            <span class="text-danger">{{$errors->first('matb')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input loại thiết bị -->
                                <div class="col-lg-6">
                                    <p>Loại thiết bị: <span class="text-danger">*</span>
                                        <span class="dropdown-loai">
                                            <select name="loaitb" class="select_loai">
                                                <option value="" disabled hidden selected>Chọn loại thiết bị</option>
                                                <option value="Kiosk" {{ $device->devicetype == 'Kiosk' ? 'selected' : '' }}>Kiosk</option>
                                                <option value="Display counter" {{ $device->devicetype == 'Display counter' ? 'selected' : '' }}>Display counter</option>
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                        </span>
                                        @if($errors->has('loaitb')) 
                                            <span class="text-danger">{{$errors->first('loaitb')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input tên thiết bị -->
                                <div class="col-lg-6">
                                    <p>Tên thiết bị: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themthietbi" name="tentb" value="{{ $device->devicename }}" placeholder="Nhập tên thiết bị" style="color: #848387;">
                                        @if($errors->has('tentb')) 
                                            <span class="text-danger">{{$errors->first('tentb')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input tên đăng nhập -->
                                <div class="col-lg-6">
                                    <p>Tên đăng nhập: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themthietbi" name="tendn" value="{{ $device->memberlogin }}" placeholder="Nhập tài khoản" style="color: #848387;">
                                        <!-- @if($errors->has('tendn')) 
                                            <span class="text-danger">{{$errors->first('tendn')}}</span>
                                        @endif -->
                                    </p>
                                </div>

                                <!-- Input địa chỉ IP -->
                                <div class="col-lg-6">
                                    <p>Địa chỉ IP: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themthietbi" name="diachiip" value="{{ $device->ipaddress }}" placeholder="Nhập địa chỉ IP" style="color: #848387;">
                                        @if($errors->has('diachiip')) 
                                            <span class="text-danger">{{$errors->first('diachiip')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input mật khẩu -->
                                <div class="col-lg-6">
                                    <p>Mật khẩu: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themthietbi" name="matkhau" value="{{ $device->password }}" placeholder="Nhập mật khẩu" style="color: #848387;">
                                        <!-- @if($errors->has('matkhau')) 
                                            <span class="text-danger">{{$errors->first('matkhau')}}</span>
                                        @endif -->
                                    </p>
                                </div>

                                <!-- Input dịch vụ sử dụng -->
                                <div class="col-lg-12">
                                    <p>Dịch vụ sử dụng: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_dv" name="dichvusd" value="{{ $device->service }}" placeholder="Nhập dịch vụ sử dụng" style="color: #848387;">
                                        @if($errors->has('dichvusd')) 
                                            <span class="text-danger">{{$errors->first('dichvusd')}}</span>
                                        @endif
                                    </p>
                                </div>
                                <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>

                            </div>

                            <!-- Button thêm thiết bị -->
                            <p style="margin-top: 140px; margin-left: 357px;">
                                <a href="{{url('/')}}/thietbi">
                                    <button type="button" class="button_huy">Hủy bỏ</button>
                                </a>
                                <a href="#">
                                    <button type="submit" class="button_xn">Cập nhật</button>
                                </a>
                            </p>
                            @if(session('error'))
                            <script>
                                alert('{{session('error')}}');
                                window.location.href = "/Queuing_system/capnhatthietbi/{{ $device->deviceid }}";
                            </script>
                            @endif
                            @if(session('success'))
                                <script>
                                    alert('{{session('success')}}');
                                    window.location.href = "/Queuing_System/thietbi";
                                </script>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </form>

@endsection

