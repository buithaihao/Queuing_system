@extends("Template.templates")

@section('nhatky')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
@if($user = session('user'))
        <form action="" style="width: 1220px; height: 750px; background-color: #f7f7f7; border: 1px solid #f7f7f7;">
        @csrf
            <div class="container mt-4" >

                <div class="row">
                    <!-- Chia khung bên trái -->
                    <div class="col-lg-4">
                        <p style="width: 1200px; font-weight: 600; font-size: larger; margin-top: 5px; color: #848387;">Cài đặt hệ thống
                        <span style="font-size: 10px; position: absolute; top: 38px;"><i class="fa-solid fa-chevron-right"></i></span>
                        <span style="color: orangered; padding-left: 10px;">Nhật ký hoạt động</span></p>
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
                                    <p style="font-weight: 600; line-height: 40px; margin-left: 150px;">Từ khóa
                                        <span class="dropdown-icon">
                                            <input type="search" class="dropd" name="timkiem" placeholder="Nhập từ khóa">
                                            <span class="icon_search"><i class="fa-solid fa-magnifying-glass"></i></span>
                                        </span>
                                    </p>
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
                                    <td class="th-border-left" style="color: #ffffff; font-size: 16px;">Tên đăng nhập</td>
                                    <td class="border-table" style="color: #ffffff; font-size: 16px;">Thời gian tác động</td>
                                    <td style="color: #ffffff; font-size: 16px;">IP thực hiện</td>
                                    <td class="th-border-right" style="color: #ffffff; font-size: 16px;">Thao tác thực hiện</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nhatky as $key => $diary)
                                        <tr class="color-tr-white">
                                            <td class="{{ $loop->last ? 'th-border-bottom-left' : '' }}">
                                                {{ $diary->memberlogin }}
                                            </td>
                                            <td class="border-table">{{$diary->impacttime}}</td>

                                            @if (!$device = \App\Models\Device::find($diary->deviceid))
                                                <td>{{ $diary->ipdone }}</td>
                                            @else
                                                <?php
                                                    DB::table('diarys')->where('diaryid', $device->memberid)->update(['deviceid' => $device->deviceid]);
                                                ?>
                                                <td>{{ $diary->ipdone }}</td>
                                            @endif
                                            <td class="{{ $loop->last ? 'th-border-bottom-right' : '' }}">
                                                {{ $diary->thaotac }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            </div>

                        </div>
                    <!--  -->
                </div>

                <!-- Phân trang -->
                @if($user = session('user'))
                <div class="phantrang">
                    @if ($nhatky instanceof Illuminate\Pagination\LengthAwarePaginator && $nhatky->hasPages())
                        <ul class="trang">
                            @if ($nhatky->onFirstPage())
                                <li>
                                    <a href="#" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $nhatky->previousPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-left"></i></a>
                                </li>
                            @endif

                            <!-- Display first three pages -->
                            @foreach ($nhatky->getUrlRange(1, min(3, $nhatky->lastPage())) as $page => $url)
                                @if ($page == $nhatky->currentPage())
                                    <li class="modautrang"><a href="">{{ $page }}</a></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            <!-- Display last page -->
                            @if ($nhatky->lastPage() > 3)
                                <li class="ellipsis"><span>...</span></li>
                                @foreach ($nhatky->getUrlRange($nhatky->lastPage(), $nhatky->lastPage()) as $page => $url)
                                    @if ($page == $nhatky->currentPage())
                                        <li class="modautrang"><a href="">{{ $page }}</a></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif

                            @if ($nhatky->hasMorePages())
                                <li>
                                    <a href="{{ $nhatky->nextPageUrl() }}" style="font-size: 29px;"><i class="fa-solid fa-caret-right"></i></a>
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
