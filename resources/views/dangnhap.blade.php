@extends("Template.templates")

@section('dangnhap')
<body class="dangnhap">
    <div class="container">
        <div class="row">

            <!-- Phần hiển thị đăng nhập -->
            <div class="col-lg-6" style="background-color: #f7f7f7; padding: 50px;">
                <div>
                    <p class="img_dangnhap"><img src="./resources/views/Imgs/Logo.jpg" width="30%" height="30%" alt=""></p>
                    <form action="{{url('/')}}/dangnhap" method="post">
                        @csrf
                        <!-- Input đăng nhập -->
                        <p>Tên đăng nhập *
                        <input type="text" class="nhap" name="tendn"><br>
                            @if($errors->has('tendn')) 
                                <strong class="text-danger">{{$errors->first('tendn')}}</strong>
                            @endif</p>
                        <!-- Input mật khẩu -->
                        <p>Mật khẩu *
                        <input type="password" class="nhap" name="matkhau"><br>
                            @if($errors->has('matkhau')) 
                                <strong class="text-danger">{{$errors->first('matkhau')}}</strong>
                            @endif</p>
                        <!-- Linh a quên mật khẩu -->
                        <span class="quenmk"><a href="{{('quenmatkhau')}}">Quên mật khẩu?</a></span><br>
                        <!-- Nút button đăng nhập -->
                        <p style="text-align: center;">
                            <a href="#"><button type="submit" class="button_dangnhap">Đăng nhập</button></a></p>
                            @if(isset($error))
                            <script>
                                alert('{{$error}}');
                                window.location.href = "/Queuing_System/dangnhap";
                            </script>
                            @endif
                    </form>
                </div>
            </div>
            
            <!-- Phần hiển thị background -->
            <div class="col-lg-6">
                <img src="./resources/views/Imgs/Background_dangnhap.jpg"  width="100%" height="100%" alt="">
            </div>

        </div>
    </div>
</body>
    @endsection