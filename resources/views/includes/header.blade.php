<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
<form action="">
    <!-- Hiện khung menu -->
    <p class="img"><a href="{{url('/')}}/taikhoancanhan"><img src="{{ asset('./resources/views/Imgs/Logo_01.jpg') }}" width="45%" height="45%" alt=""></a></p>
            <div class="menu">
                <ul>
                    <li><a href="{{url('/')}}/dashboard"><i class="fa-brands fa-windows"></i> Dashboard</a></li>
                    <li><a href="{{url('/')}}/thietbi"><i class="fa-solid fa-computer"></i> Thiết bị</a></li>
                    <li><a href="{{url('/')}}/dichvu"><i class="fa-regular fa-comments"></i> Dịch vụ</a></li>
                    <li><a href="{{url('/')}}/capso"><i class="fa-brands fa-dropbox"></i> Cấp số</a></li>
                    <li><a href="{{url('/')}}/baocao"><i class="fa-solid fa-bookmark"></i> Báo cáo</a></li>
                    <li><div class="dropdown dropend">
                            <p data-bs-toggle="dropdown"><a href="#">
                                <i class="fa-solid fa-gear"></i> Cài đặt hệ thống 
                                <i class="fa-solid fa-ellipsis-vertical"></i></a></p>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{url('')}}/quanlyvaitro">Quản lý vai trò</a></li>
                                <li><a class="dropdown-item" href="{{url('')}}/quanlytaikhoan">Quản lý tài khoản</a></li>
                                <li><a class="dropdown-item" href="{{url('')}}/nhatky">Nhật ký người dùng</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Nút button đăng nhập -->
            <p style="text-align: center;">
            @if($user = session('user'))
            <a href="{{ url('/dangxuat') }}">
                    <button type="button" class="button_dn">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất
                    </button>
                </a>
            @else
                <a href="{{ url('/dangnhap') }}">
                    <button type="button" class="button_dn">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng nhập
                    </button>
                </a>
            @endif
            </p>

            <div style="display: flex; position: absolute; top: 20px; width: 100px;">
                <div style="width: 30px; margin-left: 1150px;">
                    @if($user = session('user'))
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <button type="button" class="icon_notify"><i class="fa-solid fa-bell"></i></button>
                        </a>
                        <div class="dropdown-menu dropdown-menu-start dropdown-menu-notification dropdown-menu-end">
                            <div class="header-notification">
                                <p>Thông báo</p>
                            </div>
                                <?php
                                $capsos = \App\Models\Number::join('devices', 'numbers.deviceid', '=', 'devices.deviceid')
                                    ->join('members as m', 'numbers.memberid', '=', 'm.memberid')
                                    ->select('numbers.*', 'm.tinhtrang')
                                    ->get();
                                ?>
                               
                                    <div class="list-notification">
                                        @foreach($capsos as $key => $number)
                                        <div class="item-notification">
                                            <p class="text-user-notifi">Người dùng: {{ $number->membername }}</p>
                                            <p class="condition-notifi">Thời gian nhận số: {{ $number->granttime}}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                
                        </div>
                    </div>
                    @else
                    <div>
                        <a href="#"><p class="icon_notify_chuadn"><i class="fa-solid fa-bell"></i></p></a>
                    </div>
                    @endif
                </div>
                <div style="display: flex;">
                    <!-- Chia khung cho avatar -->
                    @if($user = session('user'))
                    <div style="width: 40px; height: 40px; margin-left: 20px;">
                    <?php
                        $user = \App\Models\Member::user();
                        $hinhanh = [];
                        
                        if ($user) {
                            $hinhanh = \App\Models\Image::join('members', 'images.memberid', '=', 'members.memberid')
                                ->where('members.memberid', '=', $user->memberid)
                                ->select('images.image', 'images.imageid')
                                ->get();
                        }
                    ?>
                        @foreach($hinhanh as $key => $image)
                            @if($image->imageid)
                                <img src="{{ asset($image->image) }}" class="icon_avatar">
                            @endif
                        @endforeach
                            @if(collect($hinhanh)->isEmpty())
                                <img src="{{ asset('./resources/views/Imgs/Avatar.jpg') }}" class="icon_avatar">
                            @endif
                    </div>
                    @endif
                    <!-- Chia khung cho tên người dùng -->
                    @if($user = session('user'))
                    <div style="width: 200px; height: 40px; margin-left: 10px;">
                        <p style="color:#848387; line-height: 20px; margin-top: 1px;">Xin chào <br>
                            <span style="color: black; font-weight: 500;">{{ $user->membername }}</span></p>
                    </div>
                    @elseif(!View::hasSection('themthietbi'))
                    <div style="width: 180px; height: 40px; margin-left: 20px;">
                        <p style="color:#848387; line-height: 20px; margin-top: 1px;">Xin chào <br>
                            <span style="color: black; font-weight: 500;">Bạn cần đăng nhập</span></p>
                    </div>
                    @endif
                </div>
            </div>
</form>