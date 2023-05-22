@extends("Template.templates")

@section('baocao')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
@if($user = session('user'))
        <form action="" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4">

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Báo cáo
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Lập báo cáo</span></p>
                    </div>
                </div>

                <div class="mt-3">

                    <div class="row" style="width: 1200px;">
                        <!-- Danh sách thiết bị -->
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p style="font-weight: 600; margin-bottom: 5px; margin-top: 11px;">Chọn thời gian</p>
                                    <p style="display: flex; align-items: center;">
                                        <input type="date" class="chonthoigian" name="thoigian_dau" onchange="this.form.submit()" value="{{ request()->thoigian_dau }}">
                                        <span style="font-size: 16px; margin: 0px 10px;"><i class="fa-solid fa-caret-right"></i></span>
                                        <input type="date" class="chonthoigian" name="thoigian_cuoi" onchange="this.form.submit()" value="{{ request()->thoigian_cuoi }}">
                                    </p>
                                </div>
                                <div class="col-lg-4">
                                    <!-- code... -->
                                </div>
                                <div class="col-lg-4">
                                    <!-- code... -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <!--  -->
                    <div class="content-device" style="display: flex;">
                        <div class="table-list-device">
                            <table>
                                <thead>
                                    <tr>
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">
                                        <div class="row">
                                            <div class="col-lg-6" style="line-height: 15px;">Số thứ tự</div>
                                            <div class="col-lg-6" style="text-align: center;">
                                                <span class="icon_sapxep">
                                                    <a href="?page={{$capso->currentPage()}}&sort-by=numberid&sort-type={{$sortType}}">
                                                        <i class="fa-solid fa-sort"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-table-right" style="color: #ffffff; font-size: 16px;">
                                        <div class="row">
                                            <div class="col-lg-6" style="line-height: 15px;">Tên dịch vụ</div>
                                            <div class="col-lg-6" style="text-align: center;">
                                                <span class="icon_sapxep">
                                                    <a href="?page={{$capso->currentPage()}}&sort-by=service&sort-type={{$sortType}}">
                                                        <i class="fa-solid fa-sort"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-light" style="color: #ffffff; font-size: 16px;">
                                        <div class="row">
                                            <div class="col-lg-6" style="line-height: 15px;">Thời gian cấp </div>
                                            <div class="col-lg-6" style="text-align: center;">
                                                <span class="icon_sapxep">
                                                    <a href="?page={{$capso->currentPage()}}&sort-by=granttime&sort-type={{$sortType}}">
                                                        <i class="fa-solid fa-sort"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">
                                        <div class="row">
                                            <div class="col-lg-6" style="line-height: 15px;">Tình trạng  </div>
                                            <div class="col-lg-6" style="text-align: center;">
                                                <span class="icon_sapxep">
                                                    <a href="?page={{$capso->currentPage()}}&sort-by=trangthai&sort-type={{$sortType}}">
                                                        <i class="fa-solid fa-sort"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;"> 
                                        <div class="row">
                                            <div class="col-lg-6" style="line-height: 15px;">Nguồn cấp </div>
                                            <div class="col-lg-6" style="text-align: center;">
                                                <span class="icon_sapxep">
                                                    <a href="?page={{$capso->currentPage()}}&sort-by=devidetype&sort-type={{$sortType}}">
                                                        <i class="fa-solid fa-sort"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($capso as $key => $number)
                                <tr class="color-tr-white">
                                    <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">
                                        {{ $number->numberid }}
                                    </td>
                                    <td class="border-table-right">{{ $number->service }}</td>
                                    <td class="border-table">{{ $number->granttime }}</td>
                                    <td>
                                        <?php
                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                        $now = \Carbon\Carbon::now();
                                        $vn_time = $now->setTimezone('Asia/Ho_Chi_Minh');
                                        $number->granttime = $vn_time;
                                        $number->expiry = $vn_time->copy()->addMinutes(30);
                                        ?>
                                        @if (now() >= Carbon\Carbon::parse($number->created_at)->addMinutes(30))
                                            <?php DB::table('numbers')->where('numberid', $number->numberid)->update(['trangthai' => 'Bỏ qua']); ?>
                                            <svg width="8" height="9" viewBox="0 0 8 9" fill="#E73F3F" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="4" cy="4.5" r="4" />
                                            </svg> {{ $number->trangthai }}
                                        @elseif(now() >= Carbon\Carbon::parse($number->created_at)->addMinutes(15))
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
                                    </td>
                                    <td class="{{ $loop->last ? 'th-border-bottom-right' : '' }}">{{ $number->devicetype }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>

                            <!-- Button thêm thiết bị -->
                            <form action="{{url('')}}/xuat_excel" method="post">
                                @csrf
                                <div class="themthietbi" style="height: 80px; padding-top: 15px;">
                                    <a href="{{url('')}}/xuat_excel" name="export_csv" style="text-decoration: none; color: orangered;">
                                        <div>
                                            <p><i class="fa-solid fa-file-arrow-down"></i><br>
                                            Tải về</p>
                                        </div>
                                    </a>
                                </div>
                            </form>
                        </div>
                    <!--  -->
                </div>

                <!-- Phân trang -->
                @if($user = session('user'))
                <div class="phantrang">
                    @if ($capso instanceof Illuminate\Pagination\LengthAwarePaginator && $capso->hasPages())
                        <ul class="trang">
                            @if ($capso->onFirstPage())
                                <li>
                                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $capso->previousPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @endif

                            <!-- Display first three pages -->
                            @foreach ($capso->getUrlRange(1, min(3, $capso->lastPage())) as $page => $url)
                                @if ($page == $capso->currentPage())
                                    <li class="modautrang"><a href="">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <!-- Display last page -->
                            @if ($capso->lastPage() > 3)
                                <li class="ellipsis"><span>...</span></li>
                                @foreach ($capso->getUrlRange($capso->lastPage(), $capso->lastPage()) as $page => $url)
                                    @if ($page == $capso->currentPage())
                                        <li class="modautrang"><a href="">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif

                            @if ($capso->hasMorePages())
                                <li>
                                    <a href="{{ $capso->nextPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
                @endif

            </div>
        </form>
@endif
@endsection

