<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\myController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Trang đăng nhập
Route::get('/dangnhap', [myController::class, 'showLogin']);
Route::post('/dangnhap', [myController::class, 'loginUser']);
Route::get('/dangxuat',[myController::class, 'logoutUser']);

// Trang quên mật khẩu
Route::get('/quenmatkhau', [myController::class, 'showPass']);
Route::post('/quenmatkhau', [myController::class, 'forgetPass']);

// Trang đặt lại mật khẩu
Route::get('/datlaimatkhau', [myController::class, 'showNewPass']);
Route::post('/datlaimatkhau', [myController::class, 'newPass']);

// Trang tài khoản cá nhân
Route::get('/taikhoancanhan', [myController::class, 'profile']);
//Hình ảnh cá nhân (avatar)
Route::post('/uploadimage', [myController::class, 'Image']);

//Thông báo đổi mật khẩu
Route::get('/thongbaomk', [myController::class, 'showNotify']);

//Dashboard
Route::get('/dashboard', [myController::class, 'showDashboard']);

//Thiết bị
Route::get('/thietbi', [myController::class, 'showThietbi']);
//Thêm thiết bị
Route::get('/themthietbi', [myController::class, 'showThemthietbi']);
Route::post('/themthietbi', [myController::class, 'Themthietbi']);
//Chi tiết thiết bị
Route::get('/ctthietbi/{deviceid}', [myController::class, 'showCTthietbi']);
//Cập nhật thiết bị
Route::get('/capnhatthietbi/{deviceid}', [myController::class, 'showCapnhatthietbi']);
Route::post('/capnhatthietbi/{deviceid}', [myController::class, 'Capnhatthietbi']);

//Dịch vụ
Route::get('/dichvu', [myController::class, 'showDichvu']);
//Thêm dịch vụ
Route::get('/themdichvu', [myController::class, 'showThemdichvu']);
Route::post('/themdichvu', [myController::class, 'Themdichvu']);
//Chi tiết dịch vụ
Route::get('/ctdichvu/{serviceid}', [myController::class, 'showCTdichvu']);
//Cập nhật dịch vụ
Route::get('/capnhatdichvu/{serviceid}', [myController::class, 'showCapnhatdichvu']);
Route::post('/capnhatdichvu/{serviceid}', [myController::class, 'Capnhatdichvu']);

//Cấp số
Route::get('/capso', [myController::class, 'showCapso']);
//Cấp số mới
Route::get('/capsomoi', [myController::class, 'showCapsomoi']);
Route::post('/capsomoi', [myController::class, 'Capsomoi']);
//Chi tiêt cấp số 
Route::get('/ctcapso/{numberid}', [myController::class, 'showCTcapso']);

//Báo cáo
Route::get('/baocao', [myController::class, 'showBaocao']);
Route::get('/xuat_excel', [myController::class, 'Export_csv']);

//Quản lý vai trò
Route::get('/quanlyvaitro', [myController::class, 'showVaitro']);
//Thêm vai trò
Route::get('/themvaitro', [myController::class, 'showThemvaitro']);
Route::post('/themvaitro', [myController::class, 'Themvaitro']);
//Cập nhật vai trò
Route::get('/capnhatvaitro/{roleid}', [myController::class, 'showCapnhatvaitro']);
Route::post('/capnhatvaitro/{roleid}', [myController::class, 'Capnhatvaitro']);

//Quản lý tài khoản
Route::get('/quanlytaikhoan', [myController::class, 'showTaiKhoan']);
//Thêm tài khoản
Route::get('/themtaikhoan', [myController::class, 'showThemtaikhoan']);
Route::post('/themtaikhoan', [myController::class, 'Themtaikhoan']);
//Cập nhật tài khoản
Route::get('/capnhattaikhoan/{memberid}', [myController::class, 'showCapnhattaikhoan']);
Route::post('/capnhattaikhoan/{memberid}', [myController::class, 'Capnhattaikhoan']);

//Nhật ký người dùng
Route::get('/nhatky', [myController::class, 'showNhatky']);

