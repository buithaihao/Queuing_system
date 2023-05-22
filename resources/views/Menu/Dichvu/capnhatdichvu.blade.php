@extends("Template.templates")

@section('capnhatdichvu')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>  
        <!-- Hiện thông tin user -->
        
        <form action="{{ url('/capnhatdichvu/' . $service->serviceid) }}" method="post" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            @if($user = session('user'))
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Dịch vụ
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/dichvu" style="color: #848387; text-decoration: none;">Danh sách dịch vụ</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/ctdichvu/' . $service->serviceid)}}" style="color: #848387; text-decoration: none;">Chi tiết</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Cập nhật</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý dịch vụ</h5>
                    <div class="khung_dichvu">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin dịch vụ</p>
                            <div class="row">
                               
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <!-- Input mã dịch vụ -->
                                        <p>Mã dịch vụ: <span class="text-danger">*</span>
                                        <input type="text" class="nhap_themthietbi" name="madv" value="{{ $service->servicecode }}" placeholder="Nhập mã dịch vụ" style="color: #848387;">
                                            @if($errors->has('madv')) 
                                                <strong class="text-danger">{{$errors->first('madv')}}</strong>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- Input tên dịch vụ -->
                                        <p>Tên dịch vụ: <span class="text-danger">*</span>
                                        <input type="text" class="nhap_themthietbi" name="tendv" value="{{ $service->servicename }}" placeholder="Nhập tên dịch vụ" style="color: #848387;">
                                            @if($errors->has('tendv')) 
                                                <strong class="text-danger">{{$errors->first('tendv')}}</strong>
                                            @endif
                                        </p>
                                    </div>

                                    <h5 style="color: orangered; font-size: 28px;">Quy tắc cấp số</h5>

                                    <!-- Quy tắc cấp số -->
                                    <div class="row mt-3">
                                        <!-- Tăng tự động từ -->
                                        <div class="col-lg-6" style="width: 190px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check1" name="tangtudong" value="tangtudong" {{ $service->autoincrease ? 'checked' : '' }}>
                                                <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Tăng tự động từ:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label><span class="tangtudong">
                                                <a href="#">0001</a></span> <span style="font-size: 18px; font-weight: 600;">đến</span> 
                                                <span class="tangtudong"><a href="#">9999</a></span></label>
                                        </div>
                                        <!-- Prefix -->
                                        <div class="col-lg-6 mt-3" style="width: 190px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check2" name="prefix" value="prefix" {{ $service->prefix ? 'checked' : '' }}>
                                                <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Prefix:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label><span class="tangtudong">
                                                <a href="#">0001</a></span></label>
                                        </div>
                                        <!-- Surfix -->
                                        <div class="col-lg-6 mt-3" style="width: 190px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check3" name="surfix" value="surfix" {{ $service->surfix ? 'checked' : '' }}>
                                                <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Surfix:</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label><span class="tangtudong">
                                                <a href="#">0001</a></span></label>
                                        </div>
                                        <!-- Reset mỗi ngày -->
                                        <div class="col-lg-6 mt-3" style="width: 190px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check4" name="reset" value="reset" {{ $service->reset ? 'checked' : '' }}>
                                                <label class="form-check-label" style="font-size: 18px; font-weight: 600;">Reset mỗi ngày</label>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <!-- Input mô tả -->
                                    <div class="col-lg-12">
                                    <p>Mô tả: <span class="text-danger">*</span>
                                    <input type="text" class="nhap_themdichvu" name="mota" value="{{ $service->describe }}" placeholder="Nhập mô tả" style="color: #848387;">
                                        @if($errors->has('mota')) 
                                            <strong class="text-danger">{{$errors->first('mota')}}</strong>
                                        @endif
                                    </p>
                                    </div>
                                </div>
                                
                            </div>

                                <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>

                            <!-- Button thêm thiết bị -->
                            <p style="margin-top: 70px; margin-left: 357px;">
                                <a href="{{url('/')}}/dichvu">
                                    <button type="button" class="button_huy">Hủy bỏ</button>
                                </a>
                                <a href="#">
                                    <button type="submit" class="button_xn">Cập nhật</button>
                                </a>
                            </p>
                                @if(session('error'))
                                    <script>
                                        alert('{{session('error')}}');
                                        window.location.href = "/Queuing_System/dichvu";
                                    </script>
                                @endif
                                @if(session('success'))
                                    <script>
                                        alert('{{session('success')}}');
                                        window.location.href = "/Queuing_System/dichvu";
                                    </script>
                                @endif
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </form>

@endsection

