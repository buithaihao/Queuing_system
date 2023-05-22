@extends("Template.templates")

@section('ctcapso')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
        <!-- Hiện thông tin user -->
        
        <form action="" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            @if($user = session('user'))
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cấp số
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/capso" style="color: #848387; text-decoration: none;">Danh sách cấp số</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Chi tiết</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý cấp số</h5>
                    <div style="display: flex">
                
                    <div class="khung_themthietbi" style="height: 500px;">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin cấp số</p>
                            <div class="row">

                                <!--  -->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6" style="width: 130px;"><p>Họ tên:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->membername}}</span></div>

                                        <div class="col-lg-6" style="width: 130px;"><p>Tên dịch cụ:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->service}}</span></div>

                                        <div class="col-lg-6" style="width: 130px;"><p>Số thứ tự:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->numberid}}</span></div>

                                        <div class="col-lg-6" style="width: 130px;"><p>Thời gian cấp:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->granttime}}</span></div>

                                        <div class="col-lg-6" style="width: 130px;"><p>Hạn sử dụng:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->expiry}}</span></div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6" style="width: 140px;"><p>Nguồn cấp:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->devicetype}}</span></div>

                                        <div class="col-lg-6" style="width: 140px;"><p>Trạng thái:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>
                                        @if ($number->trangthai == "Bỏ qua")
                                            <?php DB::table('numbers')->where('numberid', $number->numberid)->update(['trangthai' => 'Bỏ qua']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#E73F3F" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $number->trangthai }}
                                        @elseif ($number->trangthai == "Đã sử dụng")
                                            <?php DB::table('numbers')->where('numberid', $number->numberid)->update(['trangthai' => 'Đã sử dụng']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#7e7d88" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $number->trangthai }}
                                        @else 
                                            <?php DB::table('numbers')->where('numberid', $number->numberid)->update(['trangthai' => 'Đang chờ']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#4277ff" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $number->trangthai }}
                                        @endif
                                        </span></div>

                                        <div class="col-lg-6" style="width: 140px;"><p>Số điện thoại:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->tel}}</span></div>

                                        <div class="col-lg-6" style="width: 140px;"><p>Địa chỉ Email:</p></div>
                                        <div class="col-lg-6" style="width: 280px; color: #848387;"><span>{{$number->email}}</span></div>
                                    </div>
                                </div>
                                       
                            </div>
   
                        </div>
                    </div>
                    <!-- Button cập nhật thiết bị -->
                    <div class="themthietbi" style="margin-top: 25px; padding-top: 12px; margin-left: 25px; width: 90px; height: 80px; border-radius: 0 0 5px 5px;">
                        <a href="{{url('')}}/capso" style="text-decoration: none; color: orangered;">
                            <div style="text-align: center;">
                                <p><i class="fa-solid fa-rotate-left"></i><br>
                                    Quay lại</p>
                            </div>
                        </a>
                    </div>

                    </div>
                </div>

            </div>
            @endif
        </form>

@endsection

