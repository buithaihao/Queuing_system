@extends("Template.templates")

@section('capsomoi')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
        <!-- Hiện thông tin user -->
        
        <form action="{{url('')}}/capsomoi" id="myForm"  method="post" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
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
                        <span style="color: orangered; padding-left: 10px;">Cấp số mới</span></p>
                    </div>
                </div>

                <div class="mt-2">
                    <h5 style="color: orangered; font-size: 28px;">Quản lý cấp số</h5>
                    <div class="khung_themthietbi">
                        <div class="container" style="text-align: center;">
                            <p style="padding-top: 20px; font-size: 35px; font-weight: 500; color: orangered;">Cấp số mới</p>
                            <div>

                                <p style="font-size: 18px; font-weight: 500;">Dịch vụ khách hàng lựa chọn</p>

                                <p>
                                    <span class="dropdown-loai">
                                        <select name="chondichvu" class="select_loai">
                                            <option value="" disabled hidden selected>Chọn dịch vụ</option>
                                            <option value="Khám sản - Phụ khoa">Khám sản - Phụ khoa</option>
                                            <option value="Khám răng hàm mặt">Khám răng hàm mặt</option>
                                            <option value="Khám tai mũi họng">Khám tai mũi họng</option>
                                            <option value="Khám tim mạch">Khám tim mạch</option>
                                            <option value="Khám hô hấp">Khám hô hấp</option>
                                            <option value="Khám tổng quát">Khám tổng quát</option>
                                        </select>
                                        <span class="icon_dropd"><i class="fa-solid fa-caret-down" style="left: 460px;"></i></span>
                                    </span><br>
                                    @if($errors->has('chondichvu')) 
                                        <span class="text-danger">{{$errors->first('chondichvu')}}</span>
                                    @endif 
                                </p>

                            </div>

                            <!-- Button thêm thiết bị -->
                            <p style="margin-top: 50px; text-align: center;">
                                <a href="{{url('/')}}/capso">
                                    <button type="button" class="button_huy" style="background-color: white;">Hủy bỏ</button>
                                </a>
                                <!-- Nếu có lỗi thì nhấn sẽ không hiện modal và báo lỗi, còn ngược lại nếu không có lỗi thì hiện modal -->
                                <a href="#">
                                    <button type="submit" class="button_xn">In số</button>
                                </a>

                                @if(session('error'))
                                    <script>
                                        alert('{{session('error')}}');
                                    </script>
                                @endif
                            </p>
                
                        </div>
                    </div>
                </div>

            </div>
            @endif

            <!-- ==== Popup ==== -->
            <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="btn-close-popup" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-x"></i>
                        </button>
                        <div class="content-header">
                        @if (session('capsomoi'))
                            <h3>Số thứ tự được cấp</h3>
                            <h2>{{ session('capsomoi')->numberid }}</h2>
                            <p>DV: {{ session('capsomoi')->service }} <b>(tại quầy số 1)</b></p>
                        @else 
                            <h3>Số thứ tự được cấp</h3>
                                <h5>Chưa có số nào được cấp</h5>
                        @endif
                        </div>
                        <div class="content-footer">
                            <div>
                            @if (session('capsomoi'))
                                <div class="text-datetime">
                                    <p>Thời gian cấp:</p>
                                    <p>{{ session('capsomoi')->granttime }}</p>
                                </div>
                                <div class="text-datetime">
                                    <p>Hạn sử dụng:</p>
                                    <p>{{ session('capsomoi')->expiry }}</p>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if ($errors->any())
            <!-- Display the form errors here -->
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('capsomoi'))
            <!-- Show the modal if there are no errors -->
            <script>
                $(document).ready(function () {
                    $('#staticBackdrop').modal('show');
                });
            </script>
        @endif

@endsection

