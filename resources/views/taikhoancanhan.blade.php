@extends("Template.templates")

@section('taikhoancanhan')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
  <div style="width: 1220px; height: 800px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        <!-- Hiện thông tin user -->
            <div class="container mt-4">

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-2">
                        <p style="color: orangered; font-weight: 600; font-size: larger; margin-top: 5px;">Thông tin cá nhân</p>
                    </div>
                </div>

                <!-- Thông tin của user -->
                <div class="khung">
                    <div class="container">
                        <div class="row">
                            @if($user = session('user'))
                            <!-- Hình user -->
                            <div class="col-lg-3 pt-4">
                                
                                <!-- Avatar user -->
                                @foreach($hinhanh as $key => $image)
                                    @if($image->imageid)
                                        <p><img src="{{ asset($image->image) }}" alt=""></p>
                                    @endif
                                @endforeach
                                    @if(collect($hinhanh)->isEmpty())
                                        <p><img src="{{ asset('./resources/views/Imgs/Avatar.jpg') }}" alt=""></p>
                                    @endif
                                
                                <!-- Tên user -->
                                <h5>{{ $user->membername }}</h5>
                                <form action="{{ url('') }}/uploadimage" method="post" id="upload-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="hinh" class="custom-file-upload">
                                            <p class="icon_camera"><i class="fa-sharp fa-solid fa-camera"></i></p>
                                        </label>
                                        <input id="hinh" type="file" name="hinh" style="display: none;">
                                        <!-- <button type="submit">Thêm ảnh</button> -->
                                        @if(session('error'))
                                            <script>
                                                alert('{{session('error')}}');
                                            </script>
                                        @endif
                                        @if(session('success'))
                                            <script>
                                                alert('{{session('success')}}');
                                            </script>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <!-- Thông tin user -->
                            <div class="col-lg-9 pt-4">
                                <div class="row" style="line-height: 40px;">
                                    <!-- Input người dùng -->
                                    <div class="col-lg-6">
                                    @if($user = session('user'))
                                        <p><span style="font-weight: 600;">Tên người dùng *</span>
                                            <input type="text" class="nhap_avatar" name="tennd" disabled placeholder="{{ $user->membername }}">
                                        </p>
                                        @else
                                        <p><span style="font-weight: 600;">Tên người dùng *</span>
                                            <input type="text" class="nhap_avatar" name="tennd" disabled>
                                        </p>
                                    @endif
                                    </div>
                                    <!-- Input đăng nhập -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Tên đăng nhập *</span>
                                            <input type="text" class="nhap_avatar" name="tendn" disabled placeholder="{{ $user->memberlogin }}">
                                        </p>
                                    </div>
                                    <!-- Input số điện thoại -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Số điện thoại *</span>
                                            <input type="number" class="nhap_avatar" name="sdt" disabled placeholder="{{ $user->tel }}">
                                        </p>
                                    </div>
                                    <!-- Input mật khẩu -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Mật khẩu *</span>
                                            <input type="password" class="nhap_avatar" name="matkhau" disabled placeholder="{{ $user->password }}">
                                        </p>
                                    </div>
                                    <!-- Input email -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Email *</span>
                                            <input type="text" class="nhap_avatar" name="email" disabled placeholder="{{ $user->email }}">
                                        </p>
                                    </div>
                                    <!-- Input vai trò -->
                                    <div class="col-lg-6">
                                        <p><span style="font-weight: 600;">Vai trò *</span>
                                            <input type="text" class="nhap_avatar" name="vaitro" disabled placeholder="{{ $user->vaitro }}">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
<script>
    $(function() {
        $('#hinh').on('change', function() {
            $('#upload-form').submit();
        });
    });
</script>
</div>
@endsection

