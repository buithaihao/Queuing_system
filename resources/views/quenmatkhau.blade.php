@extends("Template.templates")

@section('quenmatkhau')
<body class="quenmatkhau">
    <div class="container">
        <div class="row">
            <!-- Phần hiển thị đăng nhập -->
            <div class="col-lg-6" style="background-color: #f7f7f7; padding: 50px;">
                <div style="text-align: center;">
                    <p class="img_quenmatkhau"><img src="./resources/views/Imgs/Logo.jpg" width="30%" height="30%" alt=""></p>
                    <h5 style="font-size: larger; font-weight: 600;">Đặt lại mật khẩu</h5>
                    <form action="{{url('/')}}/quenmatkhau" method="post">
                    @csrf
                    <!-- Input mật khẩu -->
                    <p><span style="font-size: larger;">Vui lòng nhập email để đặt lại mật khẩu của bạn *</span>
                    <input type="pemail" class="nhap_quenmk" name="email_quenmk"><br><br>
                    @if(session()->has('message')) 
                        <strong class="text-danger">{{ session()->get('message') }}</strong>
                    @elseif(session()->has('error'))
                        <strong class="text-danger">{{ session()->get('error') }}</strong>
                    @endif</p>
                    <!-- Button đăng nhập -->
                    <p style="text-align: center;">
                        <a href="{{url('dangnhap')}}">
                            <button type="button" class="button_huy">Hủy</button>
                        </a>
                        <a href="#">
                            <button type="submit" class="button_xn">Tiếp tục</button>
                        </a>
                    </p>
                    </form>
                </div>
            </div>
            
            <!-- Phần hiển thị background -->
            <div class="col-lg-6">
                <img src="./resources/views/Imgs/Background_quenmatkhau.jpg"  width="100%" height="100%" alt="">
            </div>
        </div>
    </div>
</body>

@endsection