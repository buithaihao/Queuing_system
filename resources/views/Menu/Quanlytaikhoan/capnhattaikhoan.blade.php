@extends("Template.templates")

@section('capnhattaikhoan')
<?php

use Illuminate\Support\Facades\Auth;
$user = session('user');
$user = Auth::user();

?>

        <!-- Hiện thông tin user -->
    
        <form action="{{ url('/capnhattaikhoan/' . $member->memberid) }}" method="post" style="width: 1220px; height: 800px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4" >
                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/quanlytaikhoan" style="color: #848387; text-decoration: none;">Quản lý tài khoản</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Cập nhật tài khoản</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý thiết bị</h5>
                    <div class="khung_themthietbi">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin tài khoản</p>
                            <div class="row">
                                
                                <!-- Input họ tên -->
                                <div class="col-lg-6">
                                    <p>Họ tên: <span class="text-danger">*</span>
                                        <input type="text" class="nhap_themthietbi" value="{{ $member->membername }}" name="tennd" placeholder="Nhập họ tên" style="color: #848387;">
                                        @if($errors->has('tennd')) 
                                            <span class="text-danger">{{$errors->first('tennd')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input tên đăng nhập -->
                                <div class="col-lg-6">
                                    <p>Tên đăng nhập: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themthietbi" value="{{$member->memberlogin}}" name="tendn" placeholder="Nhập tên đăng nhập" style="color: #848387;">
                                        @if($errors->has('tendn')) 
                                            <span class="text-danger">{{$errors->first('tendn')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input số điện thoại -->
                                <div class="col-lg-6">
                                    <p>Số điện thoại: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themthietbi" value="{{$member->tel}}" name="sdt" placeholder="Nhập số điện thoại" style="color: #848387;">
                                        @if($errors->has('sdt')) 
                                            <span class="text-danger">{{$errors->first('sdt')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input mật khẩu -->
                                <div class="col-lg-6">
                                    <p>Mật khẩu: <span class="text-danger">*</span>
                                    <input type="password" class="nhap_themthietbi" value="{{$member->password}}" disabled name="matkhau" style="color: #848387;"></p>
                                </div>

                                 <!-- Input email -->
                                 <div class="col-lg-6">
                                    <p>Email: <span class="text-danger">*</span>
                                    <input type="email" class="nhap_themthietbi" value="{{$member->email}}" name="email" placeholder="Nhập email" style="color: #848387;">
                                        @if($errors->has('email')) 
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input nhập lại mật khẩu -->
                                <div class="col-lg-6">
                                    <p>Nhập lại mật khẩu: <span class="text-danger">*</span>
                                    <input type="password" class="nhap_themthietbi" value="{{$member->password}}" disabled name="nlmatkhau" style="color: #848387;">
                                        @if($errors->has('nlmatkhau')) 
                                            <span class="text-danger">{{$errors->first('nlmatkhau')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input địa chỉ IP -->
                                <div class="col-lg-6">
                                    <p>Vai trò: <span class="text-danger">*</span>
                                        <span class="dropdown-loai">
                                            <select name="vaitro" class="select_loai" value="{{$member->vaitro}}">
                                                <option value="" disabled hidden selected>Chọn vai trò</option>
                                                @foreach($roles as $key => $role)
                                                    <option value="{{$role->rolename}}" {{ $member->vaitro == $role->rolename ? 'selected' : '' }}>{{$role->rolename}}</option>
                                                @endforeach
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                        </span>
                                        @if($errors->has('vaitro')) 
                                            <span class="text-danger">{{$errors->first('vaitro')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Input mật khẩu -->
                                <div class="col-lg-6">
                                    <p>Tình trạng: <span class="text-danger">*</span>
                                        <span class="dropdown-loai">
                                            <select name="tinhtrang" class="select_loai">
                                                <option value="" disabled hidden selected>Tất cả</option>
                                                <option value="Hoạt động" {{ $member->tinhtrang == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="Ngưng hoạt động" {{ $member->tinhtrang == 'Ngưng hoạt động' ? 'selected' : '' }}>Ngưng hoạt động</option>
                                            </select>
                                            <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                        </span>
                                        @if($errors->has('tinhtrang')) 
                                            <span class="text-danger">{{$errors->first('tinhtrang')}}</span>
                                        @endif
                                    </p>
                                </div>

                                <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>

                            </div>

                            <!-- Button thêm thiết bị -->
                            <p style="margin-top: 140px; margin-left: 357px;">
                                <a href="{{url('/')}}/quanlytaikhoan">
                                    <button type="button" class="button_huy">Hủy bỏ</button>
                                </a>
                                <a href="#">
                                    <button type="submit" class="button_xn">Cập nhật</button>
                                </a>
                            </p>
                            @if(session('success'))
                                <script>
                                    alert('{{session('success')}}');
                                    window.location.href = "/Queuing_System/quanlytaikhoan";
                                </script>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </form>

@endsection

