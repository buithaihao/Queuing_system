@extends("Template.templates")

@section('themvaitro')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
        <!-- Hiện thông tin user -->
        
        <form action="{{url('')}}/themvaitro" method="post" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="padding-left: 10px;"><a href="{{url('/')}}/quanlyvaitro" style="color: #848387; text-decoration: none;">Quản lý vai trò</a></span>
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Thêm vai trò</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Danh sách vai trò</h5>
                    <div class="khung_dichvu">
                        <div class="container">
                            <p style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Thông tin vai trò</p>
                            <div class="row">
                               
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <!-- Input mã dịch vụ -->
                                        <p>Tên vai trò: <span class="text-danger">*</span>
                                        <input type="text" class="nhap_themthietbi" name="tenvt" placeholder="Nhập vai trò" style="color: #848387;">
                                            @if($errors->has('tenvt')) 
                                                <strong class="text-danger">{{$errors->first('tenvt')}}</strong>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="col-lg-12">
                                        <!-- Input mô tả -->
                                        <p>Mô tả:
                                        <input type="text" class="nhap_themdichvu" name="mota" placeholder="Nhập mô tả" style="color: #848387;">
                                            @if($errors->has('mota')) 
                                                <strong class="text-danger">{{$errors->first('mota')}}</strong>
                                            @endif
                                        </p>
                                    </div>

                                    <p style="font-size: 16px; font-weight: 500; color: #848387;"><span class="text-danger">*</span> Là trường thông tin bắt buộc</p>
                                </div>

                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <!-- Phân quyền chức năng -->
                                        <p style="line-height: 0px; margin-top: 5px;">Phân quyền chức năng: <span class="text-danger">*</span> 
                                            <div class="list-role">
                                                <span style="padding-top: 20px; font-size: 25px; font-weight: 500; color: orangered;">Nhóm chức năng</span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="tcchucnanga" name="tangtudong" value="something" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Tất cả</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="ctthietbi" name="ctthietbi" value="Xem chi tiết thiết bị" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Xem chi tiết thiết bị</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="themthietbi" name="themthietbi" value="Thêm thiết bị" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Thêm thiết bị</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="capnhatthietbi" name="capnhatthietbi" value="Cập nhật thiết bị" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Cập nhật thiết bị</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="ctdichvu" name="ctdichvu" value="Xem chi tiết dịch vụ" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Xem chi tiết dịch vụ</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="themdichvu" name="themdichvu" value="Thêm dịch vụ" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Thêm dịch vụ</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="capnhatdichvu" name="capnhatdichvu" value="Cập nhật dịch vụ" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Cập nhật dịch vụ</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="ctcapso" name="ctcapso" value="Xem chi tiết cấp số" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Xem chi tiết cấp số</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="capso" name="capso" value="Cấp số" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Cấp số</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="themvaitro" name="themvaitro" value="Thêm vai trò" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Thêm vai trò</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="capnhatvaitro" name="capnhatvaitro" value="Cập nhật vai trò" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Cập nhật vai trò</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="capnhattaikhoan" name="capnhattaikhoan" value="Cập nhật tài khoản" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Cập nhật tài khoản</label>
                                                </span>
                                                <span class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="themtaikhoan" name="themtaikhoan" value="Thêm tài khoản" style="margin-top: 7px;">
                                                    <label class="form-check-label" style="font-size: 18px; font-weight: 400;">Thêm tài khoản</label>
                                                </span>
                                                
                                                <script>
                                                    // Get the "Tất cả" checkbox
                                                    var checkboxAll = document.getElementById('tcchucnanga');

                                                    // Get all checkboxes except the "Tất cả" checkbox
                                                    var checkboxes = document.querySelectorAll('.list-role input[type=checkbox]:not(#tcchucnanga)');

                                                    // Add event listener to the "Tất cả" checkbox
                                                    checkboxAll.addEventListener('change', function() {
                                                        // Set the state of other checkboxes based on the "Tất cả" checkbox
                                                        checkboxes.forEach(function(checkbox) {
                                                            checkbox.checked = checkboxAll.checked;
                                                        });
                                                    });

                                                    // Add event listeners to the other checkboxes
                                                    checkboxes.forEach(function(checkbox) {
                                                        checkbox.addEventListener('change', function() {
                                                            // If any checkbox is unchecked, uncheck the "Tất cả" checkbox
                                                            if (!checkbox.checked) {
                                                                checkboxAll.checked = false;
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                                
                            </div>

                            <!-- Button thêm vai trò -->
                            <p style="margin-top: 40px; margin-left: 357px;">
                                <a href="{{url('')}}/quanlyvaitro">
                                    <button type="button" class="button_huy">Hủy bỏ</button>
                                </a>
                                <a href="#">
                                    <button type="submit" class="button_xn">Thêm</button>
                                </a>
                            </p>
                                @if(session('success'))
                                    <script>
                                        alert('{{session('success')}}');
                                        window.location.href = "/Queuing_System/quanlyvaitro";
                                    </script>
                                @endif
                        </div>
                    </div>
                </div>

            </div>
        </form>

@endsection

