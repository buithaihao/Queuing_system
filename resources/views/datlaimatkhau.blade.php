@extends("Template.templates")

@section('datlaimatkhau')
<body class="datlaimatkhau">
@php
    $token = "";
    $email = "";
    if (isset($_GET['token']) && isset($_GET['email'])) {
        $token = $_GET['token'];
        $email = $_GET['email'];
    } 
@endphp
    <form action="{{url('/')}}/datlaimatkhau" method="post">
    @csrf
    <div class="container">
        <div class="row">

            <!-- Phần hiển thị đăng nhập -->
            <div class="col-lg-6" style="background-color: #f7f7f7; padding: 50px;">
                <div>
                    <p class="img_datlaimatkhau"><img src="./resources/views/Imgs/Logo.jpg" width="30%" height="30%" alt=""></p>
                    <h5 style="font-size: larger; font-weight: 600; text-align: center;">Đặt lại mật khẩu mới</h5>
                        <input type="hidden" class="nhap" name="email" value="{{$email}}">
                        <input type="hidden" class="nhap" name="token" value="{{$token}}">
                    <!-- Input mật khẩu -->
                    <p>Mật khẩu *
                    <input type="password" class="nhap" name="matkhaumoi">
                        @if($errors->has('matkhaumoi')) 
                            <strong class="text-danger">{{$errors->first('matkhaumoi')}}</strong>
                        @endif</p>
                    <!-- Input mật khẩu -->
                    <p>Nhập lại mật khẩu *
                    <input type="password" class="nhap" name="nlmatkhaumoi">
                        @if($errors->has('nlmatkhaumoi')) 
                            <strong class="text-danger">{{$errors->first('nlmatkhaumoi')}}</strong>
                        @endif</p>
                    <!-- Nút button xác nhận -->
                    <p style="text-align: center;"><a href="#"><button type="submit" class="button_datlaimatkhau">Xác nhận</button></a></p>
                        @if(isset($message))
                            <script>
                                alert('{{$message}}');
                                window.location.href = "/Queuing_System/dangnhap";
                            </script>
                        @endif
                </div>
            </div>
            
            <!-- Phần hiển thị background -->
            <div class="col-lg-6">
                <img src="./resources/views/Imgs/Background_quenmatkhau.jpg"  width="100%" height="100%" alt="">
            </div>

        </div>
    </div>
    </form>
</body>

@endsection