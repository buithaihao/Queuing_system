@extends("Template.templates")

@section('dashboard')
<?php

use Illuminate\Support\Facades\Auth;

$user = session('user');
$user = Auth::user();

?>
@if($user = session('user'))
<main style="display: flex; width: 1200px;">
    <form action="" style="width: 800px; height: 750px; background-color: #f7f7f7;">
        @csrf
        <div class="container mt-4">

            <div class="row">
                <!-- Chia khung bên trái -->
                <div class="col-lg-4">
                    <p style="width: 1200px; font-weight: 600;
                        font-size: larger; margin-top: 5px; color: orangered;">Dashboard</p>
                </div>
            </div>

            <div class="mt-3">
                <h5 style="color: orangered; font-size: 28px;">Biểu đồ cấp số</h5>
                <div style="width: 785px; display: flex; justify-content: space-evenly;">

                    <div class="khung_bieudo">
                        <div style="display: flex; height: 60px;">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.15" cx="24" cy="24" r="23.5" fill="#6695FB" stroke="#DADADA" />
                                <g clip-path="url(#clip0_209_18730)">
                                    <path
                                        d="M17.25 12C17.4489 12 17.6397 12.079 17.7803 12.2197C17.921 12.3603 18 12.5511 18 12.75V13.5H30V12.75C30 12.5511 30.079 12.3603 30.2197 12.2197C30.3603 12.079 30.5511 12 30.75 12C30.9489 12 31.1397 12.079 31.2803 12.2197C31.421 12.3603 31.5 12.5511 31.5 12.75V13.5H33C33.7956 13.5 34.5587 13.8161 35.1213 14.3787C35.6839 14.9413 36 15.7044 36 16.5V33C36 33.7956 35.6839 34.5587 35.1213 35.1213C34.5587 35.6839 33.7956 36 33 36H15C14.2044 36 13.4413 35.6839 12.8787 35.1213C12.3161 34.5587 12 33.7956 12 33V16.5C12 15.7044 12.3161 14.9413 12.8787 14.3787C13.4413 13.8161 14.2044 13.5 15 13.5H16.5V12.75C16.5 12.5511 16.579 12.3603 16.7197 12.2197C16.8603 12.079 17.0511 12 17.25 12V12ZM13.5 18V33C13.5 33.3978 13.658 33.7794 13.9393 34.0607C14.2206 34.342 14.6022 34.5 15 34.5H33C33.3978 34.5 33.7794 34.342 34.0607 34.0607C34.342 33.7794 34.5 33.3978 34.5 33V18H13.5Z"
                                        fill="#6493F9" />
                                </g>
                            </svg>
                            <p style="margin-left: 10px;">Số thứ tự đã cấp</p>
                        </div>
                        <div class="container" style="display: flex;">
                            <h3 style="width: 55px;">{{$numberCount}}</h3>
                            <div class="sophantram_tang" style="display: flex;">
                                <p><i class="fa-solid fa-arrow-up"></i></p>
                                <p>32,41%</p>
                            </div>
                        </div>
                    </div>

                    <div class="khung_bieudo">
                        <div style="display: flex; height: 60px;">
                            <svg width="49" height="48" viewBox="0 0 49 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.15" cx="24.75" cy="24" r="23" fill="#35C75A" stroke="#35C75A"
                                    stroke-width="2" />
                                <g clip-path="url(#clip0_209_18861)">
                                    <path
                                        d="M29.031 22.7194C29.1008 22.789 29.1563 22.8718 29.1941 22.9629C29.2319 23.054 29.2513 23.1517 29.2513 23.2504C29.2513 23.349 29.2319 23.4467 29.1941 23.5378C29.1563 23.6289 29.1008 23.7117 29.031 23.7814L24.531 28.2814C24.4613 28.3512 24.3786 28.4066 24.2875 28.4444C24.1963 28.4822 24.0987 28.5017 24 28.5017C23.9014 28.5017 23.8037 28.4822 23.7126 28.4444C23.6214 28.4066 23.5387 28.3512 23.469 28.2814L21.219 26.0314C21.1493 25.9616 21.094 25.8788 21.0562 25.7877C21.0185 25.6966 20.9991 25.599 20.9991 25.5004C20.9991 25.4017 21.0185 25.3041 21.0562 25.213C21.094 25.1219 21.1493 25.0391 21.219 24.9694C21.3598 24.8285 21.5508 24.7494 21.75 24.7494C21.8486 24.7494 21.9463 24.7688 22.0374 24.8066C22.1285 24.8443 22.2113 24.8996 22.281 24.9694L24 26.6899L27.969 22.7194C28.0387 22.6495 28.1214 22.5941 28.2126 22.5563C28.3037 22.5185 28.4014 22.499 28.5 22.499C28.5987 22.499 28.6963 22.5185 28.7875 22.5563C28.8786 22.5941 28.9613 22.6495 29.031 22.7194Z"
                                        fill="#35C75A" />
                                    <path
                                        d="M18 12C18.1989 12 18.3897 12.079 18.5303 12.2197C18.671 12.3603 18.75 12.5511 18.75 12.75V13.5H30.75V12.75C30.75 12.5511 30.829 12.3603 30.9697 12.2197C31.1103 12.079 31.3011 12 31.5 12C31.6989 12 31.8897 12.079 32.0303 12.2197C32.171 12.3603 32.25 12.5511 32.25 12.75V13.5H33.75C34.5456 13.5 35.3087 13.8161 35.8713 14.3787C36.4339 14.9413 36.75 15.7044 36.75 16.5V33C36.75 33.7956 36.4339 34.5587 35.8713 35.1213C35.3087 35.6839 34.5456 36 33.75 36H15.75C14.9544 36 14.1913 35.6839 13.6287 35.1213C13.0661 34.5587 12.75 33.7956 12.75 33V16.5C12.75 15.7044 13.0661 14.9413 13.6287 14.3787C14.1913 13.8161 14.9544 13.5 15.75 13.5H17.25V12.75C17.25 12.5511 17.329 12.3603 17.4697 12.2197C17.6103 12.079 17.8011 12 18 12V12ZM14.25 18V33C14.25 33.3978 14.408 33.7794 14.6893 34.0607C14.9706 34.342 15.3522 34.5 15.75 34.5H33.75C34.1478 34.5 34.5294 34.342 34.8107 34.0607C35.092 33.7794 35.25 33.3978 35.25 33V18H14.25Z"
                                        fill="#35C75A" />
                                </g>
                            </svg>
                            <p style="margin-left: 10px; width: 90px;">Số thứ tự đã sử dụng</p>
                        </div>
                        <div class="container" style="display: flex;">
                            <h3 style="width: 55px;">{{$numberCount_dasudung}}</h3>

                            <div class="sophantram_tang" style="display: flex;">
                                <p><i class="fa-solid fa-arrow-down"></i></p>
                                <p>32,41%</p>
                            </div>

                        </div>
                    </div>

                    <div class="khung_bieudo">
                        <div style="display: flex; height: 60px;">
                            <svg width="49" height="48" viewBox="0 0 49 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.15" cx="24.25" cy="24" r="23.5" fill="#FFAC6A" stroke="#DADADA" />
                                <path
                                    d="M31.2505 20.9625L32.155 20.058C32.2767 19.9378 32.4308 19.8555 32.5984 19.8211C32.766 19.7868 32.94 19.8019 33.0992 19.8645L34.2017 20.304C34.3627 20.3696 34.5007 20.4814 34.5983 20.6252C34.6958 20.7691 34.7486 20.9387 34.75 21.1125V23.1315C34.748 23.3637 34.6539 23.5856 34.4884 23.7485C34.3229 23.9113 34.0995 24.0018 33.8672 24L33.8297 23.9985C26.1077 23.5185 24.55 16.977 24.2552 14.4735C24.2425 14.3591 24.2525 14.2434 24.2845 14.1329C24.3165 14.0224 24.37 13.9193 24.4418 13.8294C24.5137 13.7396 24.6026 13.6648 24.7034 13.6093C24.8042 13.5538 24.9149 13.5187 25.0292 13.506C25.0631 13.502 25.0972 13.5 25.1312 13.5H27.0812C27.2552 13.5006 27.4249 13.5532 27.5687 13.6511C27.7125 13.7489 27.8238 13.8875 27.8882 14.049L28.3285 15.1515C28.3932 15.3102 28.4098 15.4845 28.376 15.6526C28.3423 15.8207 28.2597 15.9751 28.1387 16.0965L27.2342 17.001C27.2342 17.001 27.7547 20.526 31.2505 20.9625Z"
                                    fill="#FFAC6A" />
                                <path
                                    d="M24.25 34.5H22.75V30.75C22.7494 30.1534 22.5122 29.5815 22.0903 29.1597C21.6685 28.7378 21.0966 28.5006 20.5 28.5H17.5C16.9034 28.5006 16.3315 28.7378 15.9097 29.1597C15.4878 29.5815 15.2506 30.1534 15.25 30.75V34.5H13.75V30.75C13.7512 29.7558 14.1467 28.8027 14.8497 28.0997C15.5527 27.3967 16.5058 27.0012 17.5 27H20.5C21.4942 27.0012 22.4473 27.3967 23.1503 28.0997C23.8533 28.8027 24.2488 29.7558 24.25 30.75V34.5Z"
                                    fill="#FFAC6A" />
                                <path
                                    d="M19 19.5C19.445 19.5 19.88 19.632 20.25 19.8792C20.62 20.1264 20.9084 20.4778 21.0787 20.889C21.249 21.3001 21.2936 21.7525 21.2068 22.189C21.12 22.6254 20.9057 23.0263 20.591 23.341C20.2763 23.6557 19.8754 23.87 19.439 23.9568C19.0025 24.0436 18.5501 23.999 18.139 23.8287C17.7278 23.6584 17.3764 23.37 17.1292 23C16.882 22.63 16.75 22.195 16.75 21.75C16.75 21.1533 16.9871 20.581 17.409 20.159C17.831 19.7371 18.4033 19.5 19 19.5ZM19 18C18.2583 18 17.5333 18.2199 16.9166 18.632C16.2999 19.044 15.8193 19.6297 15.5355 20.3149C15.2516 21.0002 15.1774 21.7542 15.3221 22.4816C15.4668 23.209 15.8239 23.8772 16.3484 24.4017C16.8728 24.9261 17.541 25.2833 18.2684 25.4279C18.9958 25.5726 19.7498 25.4984 20.4351 25.2145C21.1203 24.9307 21.706 24.4501 22.118 23.8334C22.5301 23.2167 22.75 22.4917 22.75 21.75C22.75 21.2575 22.653 20.7699 22.4646 20.3149C22.2761 19.86 21.9999 19.4466 21.6517 19.0983C21.3034 18.7501 20.89 18.4739 20.4351 18.2855C19.9801 18.097 19.4925 18 19 18Z"
                                    fill="#FFAC6A" />
                            </svg>
                            <p style="margin-left: 10px;">Số thứ tự đang chờ</p>
                        </div>
                        <div class="container" style="display: flex;">
                            <h3 style="width: 55px;">{{$numberCount_dangcho}}</h3>

                            <div class="sophantram_tang" style="display: flex;">
                                <p><i class="fa-solid fa-arrow-up"></i></p>
                                <p>56,41%</p>
                            </div>

                        </div>
                    </div>

                    <div class="khung_bieudo">
                        <div style="display: flex; height: 60px;">
                            <svg width="49" height="48" viewBox="0 0 49 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle opacity="0.15" cx="24.5" cy="24" r="23.5" fill="#F86D6D" stroke="#DADADA" />
                                <path
                                    d="M24.26 18.15C24.2819 18.105 24.3161 18.0671 24.3585 18.0406C24.4009 18.0141 24.45 18 24.5 18C24.5501 18 24.5991 18.0141 24.6415 18.0406C24.684 18.0671 24.7181 18.105 24.74 18.15L25.691 20.0775C25.7101 20.1165 25.7383 20.1503 25.7733 20.1759C25.8084 20.2015 25.8491 20.2182 25.892 20.2245L28.022 20.5335C28.2395 20.565 28.328 20.8335 28.169 20.988L26.63 22.4895C26.599 22.5198 26.5758 22.5572 26.5624 22.5985C26.5491 22.6398 26.546 22.6838 26.5535 22.7265L26.9165 24.8475C26.9247 24.8965 26.919 24.9468 26.9002 24.9927C26.8813 25.0386 26.85 25.0784 26.8098 25.1075C26.7696 25.1367 26.7221 25.154 26.6726 25.1576C26.6231 25.1613 26.5735 25.151 26.5295 25.128L24.6245 24.126C24.5863 24.106 24.5439 24.0956 24.5008 24.0956C24.4577 24.0956 24.4152 24.106 24.377 24.126L22.472 25.128C22.4281 25.1506 22.3787 25.1605 22.3294 25.1567C22.2801 25.1529 22.2329 25.1355 22.1929 25.1064C22.153 25.0773 22.1219 25.0377 22.1031 24.992C22.0843 24.9463 22.0786 24.8963 22.0865 24.8475L22.4495 22.7265C22.4572 22.6839 22.4543 22.64 22.4413 22.5987C22.4282 22.5575 22.4053 22.52 22.3745 22.4895L20.8295 20.988C20.7941 20.9533 20.7691 20.9093 20.7573 20.8612C20.7455 20.813 20.7473 20.7625 20.7625 20.7153C20.7778 20.6681 20.8059 20.6261 20.8437 20.594C20.8815 20.5619 20.9275 20.5409 20.9765 20.5335L23.1065 20.2245C23.1494 20.2182 23.1902 20.2015 23.2252 20.1759C23.2602 20.1503 23.2885 20.1165 23.3075 20.0775L24.26 18.15Z"
                                    fill="#F86D6D" />
                                <path
                                    d="M15.5 15C15.5 14.2044 15.8161 13.4413 16.3787 12.8787C16.9413 12.3161 17.7044 12 18.5 12H30.5C31.2956 12 32.0587 12.3161 32.6213 12.8787C33.1839 13.4413 33.5 14.2044 33.5 15V35.25C33.4999 35.3857 33.4631 35.5188 33.3933 35.6351C33.3236 35.7515 33.2236 35.8468 33.104 35.9108C32.9844 35.9748 32.8497 36.0052 32.7142 35.9988C32.5787 35.9923 32.4474 35.9492 32.3345 35.874L24.5 31.6515L16.6655 35.874C16.5526 35.9492 16.4213 35.9923 16.2858 35.9988C16.1503 36.0052 16.0156 35.9748 15.896 35.9108C15.7764 35.8468 15.6764 35.7515 15.6067 35.6351C15.5369 35.5188 15.5001 35.3857 15.5 35.25V15ZM18.5 13.5C18.1022 13.5 17.7206 13.658 17.4393 13.9393C17.158 14.2206 17 14.6022 17 15V33.849L24.0845 30.126C24.2076 30.0441 24.3521 30.0004 24.5 30.0004C24.6479 30.0004 24.7924 30.0441 24.9155 30.126L32 33.849V15C32 14.6022 31.842 14.2206 31.5607 13.9393C31.2794 13.658 30.8978 13.5 30.5 13.5H18.5Z"
                                    fill="#F86D6D" />
                            </svg>
                            <p style="margin-left: 10px;">Số thứ tự đã bỏ qua</p>
                        </div>
                        <div class="container" style="display: flex;">
                            <h3 style="width: 55px;">{{$numberCount_boqua}}</h3>

                            <div class="sophantram_tang" style="display: flex;">
                                <p><i class="fa-solid fa-arrow-down"></i></p>
                                <p>22,41%</p>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="khung_bieudo_loc">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <p
                                    style="font-weight: 600; font-size: larger; margin-top: 5px; color: black; text-align: left;">
                                    Bảng thống kê theo {{ request()->input('filterDate') ? strtolower(request()->input('filterDate')) : 'ngày' }}
                                </p>
                                <p style="line-height: 0px; color: #848387; font-size: 18px;">Tháng <?php echo date('m'); ?>/<?php echo date('Y'); ?></p>
                        
                            </div>

                            <div class="col-lg-6">
                                <p
                                    style="font-weight: 600; font-size: larger; margin-top: 5px; color: black; text-align: right;">
                                    Xem theo
                                <form action="{{ url('') }}dashboard" id="filterForm" method="get">
                                    <span class="dropdown-icon_capso">
                                        <select id="filterDate" name="filterDate" class="dropd_capso"
                                            style="color: #757575;" onchange="this.form.submit()">
                                            <option value="Ngày"
                                                {{ request()->input('filterDate') == 'Ngày' ? 'selected' : '' }}>Ngày
                                            </option>
                                            <option value="Tháng"
                                                {{ request()->input('filterDate') == 'Tháng' ? 'selected' : '' }}>Tháng
                                            </option>
                                            <option value="Năm"
                                                {{ request()->input('filterDate') == 'Năm' ? 'selected' : '' }}>Năm
                                            </option>
                                        </select>
                                        <span class="icon_dropd"><i class="fa-solid fa-caret-down"></i></span>
                                    </span>
                                </form>
                                </p>
                            </div>
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>
    <form action="" style="margin-left: 20px; width: 800px; height: 750px; background-color: #ffffff;">
        @csrf
        <div class="container" style="margin-top: 90px; height: 660px;">
            <div class="mt-3" style="height: 660px;">
                <h5 style="color: orangered; font-size: 28px; padding-left: 24px;">Tổng quan</h5>

                <div class="content-right" style="height: 615px;">

                    <!-- Thiết bị -->
                    <div class="overview-rect">
                        <div class="diagram-device">
                            <div id="device" style="width: 95px; height: 95px;"></div>
                        </div>
                        <div class="overview-number">
                            <p class="number">{{$deviceCount}}</p>
                            <p class="text-device"><i class="fa-solid fa-computer"></i><span>Thiết bị</span></p>
                        </div>
                        <div class="overview-status">
                            <div>
                                <p>
                                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="orangered" />
                                    </svg>
                                    Đang hoạt động
                                </p>
                                <span class="span-device">{{$deviceCount_hoatdong}}</span>
                            </div>

                            <div>
                                <p>
                                    <svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="#7e7d88" />
                                    </svg>
                                    Ngưng hoạt động
                                </p>
                                <span class="span-device">{{$deviceCount_ngunghoatdong}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="overview-rect">
                        <div class="diagram-service">
                            <div id="service" style="width: 95px; height: 95px;"></div>
                        </div>
                        <div class="overview-number">
                            <p class="number">{{$serviceCount}}</p>
                            <p class="text-service"><svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.7704 5.7304C14.7704 7.04284 14.0591 8.22267 12.9266 9.04368C12.8874 9.07098 12.8658 9.11778 12.8639 9.16459L12.8149 10.4419C12.809 10.6135 12.6189 10.713 12.4739 10.6213L11.3864 9.94074C11.3864 9.94074 11.3864 9.94074 11.3845 9.94074C11.3218 9.89978 11.2453 9.88808 11.1748 9.90954C10.5282 10.1104 9.82472 10.2216 9.08797 10.2216C9.07817 10.2216 9.06837 10.2216 9.05857 10.2216C9.07817 10.0928 9.08797 9.96219 9.08797 9.82958C9.08797 7.99841 7.2108 6.51436 4.89472 6.51436C4.41857 6.51436 3.96201 6.57676 3.53485 6.69182C3.44863 6.38175 3.40356 6.05802 3.40356 5.7265C3.40356 3.24398 5.94695 1.2334 9.08601 1.2334C12.227 1.2373 14.7704 3.24983 14.7704 5.7304Z"
                                        stroke="#4277FF" stroke-width="1.10526" stroke-miterlimit="10" />
                                    <path
                                        d="M3.53675 6.69531C1.88884 7.14189 0.703369 8.37828 0.703369 9.83308C0.703369 10.8003 1.22851 11.6721 2.06324 12.2785C2.09263 12.3 2.1083 12.3331 2.11026 12.3682L2.14553 13.3102C2.14945 13.4369 2.29053 13.5091 2.3983 13.4428L3.20168 12.9396C3.20756 12.9357 3.2154 12.9299 3.22128 12.926C3.25067 12.9026 3.28986 12.8948 3.32513 12.9065C3.81108 13.0625 4.34013 13.1483 4.89662 13.1483C7.04419 13.1483 8.81555 11.871 9.06048 10.2251"
                                        stroke="#4277FF" stroke-width="1.10526" stroke-miterlimit="10" />
                                </svg>
                                <span>Dịch vụ</span>
                            </p>
                        </div>
                        <div class="overview-status">
                            <div>
                                <p><svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="#4277ff" />
                                    </svg>
                                    Đang hoạt động
                                </p><span class="span-service">{{$serviceCount_hoatdong}}</span>
                            </div>

                            <div>
                                <p><svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="#7e7d88" />
                                    </svg>
                                    Ngưng hoạt động
                                </p>
                                <span class="span-service">{{$serviceCount_ngunghoatdong}}</span>
                            </div>

                        </div>
                    </div>

                    <div class="overview-rect">
                        <div class="diagram-numberlevel">
                            <div id="number" style="width: 95px; height: 95px;"></div>
                        </div>
                        <div class="overview-number">
                            <p class="number">{{$numberCount}}</p>
                            <p class="text-numberlevel"><svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_201_18602)">
                                        <g clip-path="url(#clip1_201_18602)">
                                            <path d="M1.16663 9.91699L6.99996 12.8337L12.8333 9.91699" stroke="#35C75A"
                                                stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1.16663 7L6.99996 9.91667L12.8333 7" stroke="#35C75A"
                                                stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M6.99996 1.16699L1.16663 4.08366L6.99996 7.00033L12.8333 4.08366L6.99996 1.16699Z"
                                                stroke="#35C75A" stroke-width="1.16667" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_201_18602">
                                            <rect width="14" height="14" fill="white" />
                                        </clipPath>
                                        <clipPath id="clip1_201_18602">
                                            <rect width="14" height="14" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>Cấp số</span>
                            </p>
                        </div>
                        <div class="overview-status">
                            <div>
                                <p><svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="#35c75a" />
                                    </svg>
                                    Đã sử dụng
                                </p>
                                <span class="span-numberlevel">{{$numberCount_dasudung}}</span>
                            </div>

                            <div>
                                <p><svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="#7e7d88" />
                                    </svg>
                                    Đang chờ
                                </p><span class="span-numberlevel">{{$numberCount_dangcho}}</span>
                            </div>
                            <div>
                                <p><svg width="4" height="4" viewBox="0 0 4 4" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="4" height="4" rx="2" fill="#E73F3F" />
                                    </svg>
                                    Bỏ qua
                                </p><span class="span-numberlevel">{{$numberCount_boqua}}</span>
                            </div>

                        </div>
                    </div>

                    <div class="calendar" style="height: 320px;">
                        <div class="header-calendar">
                            <button type="button" class="prev">&#10094;</button>
                            <div class="month">
                                <p><span class="day"></span> <span class="month-name"></span> <span class="year"></span>
                                </p>
                            </div>
                            <button type="button" class="next">&#10095;</button>
                        </div>

                        <ul class="weekdays">
                            <li>Mo</li>
                            <li>Tu</li>
                            <li>We</li>
                            <li>Th</li>
                            <li>Fr</li>
                            <li>Sa</li>
                            <li>Su</li>
                        </ul>

                        <ul class="days"></ul>
                    </div>


                </div>

            </div>
        </div>
    </form>
</main>

<?php
$totalDevices = $deviceCount_hoatdong + $deviceCount_ngunghoatdong;

//Tính phần trăm của thiết bị được thêm vào. Kiểm tra nếu tổng số thiết bị là 0
if ($totalDevices == 0) {
    $deviceCount_hoatdong_pt = 0;
    $serviceCount_ngunghoatdong_pt = 0;
} else {
    // Tính phần trăm dựa trên dữ liệu tổng số dịch vụ
    $deviceCount_hoatdong_pt = round(($deviceCount_hoatdong / $totalDevices) * 100);
    $deviceCount_ngunghoatdong_pt = round(($deviceCount_ngunghoatdong / $totalDevices) * 100);
}

$totalServices = $serviceCount_hoatdong + $serviceCount_ngunghoatdong;

//Tính phần trăm của dịch vụ được thêm vào. Kiểm tra nếu tổng số dịch vụ là 0
if ($totalServices == 0) {
    $serviceCount_hoatdong_pt = 0;
    $serviceCount_ngunghoatdong_pt = 0;
} else {
    // Tính phần trăm dựa trên dữ liệu tổng số dịch vụ
    $serviceCount_hoatdong_pt = round(($serviceCount_hoatdong / $totalServices) * 100);
    $serviceCount_ngunghoatdong_pt = round(($serviceCount_ngunghoatdong / $totalServices) * 100);
}

$totalNumbers = $numberCount_dangcho + $numberCount_dasudung + $numberCount_boqua;

//Tính phần trăm của cấp số được thêm vào. Kiểm tra nếu tổng số cấp số là 0
if ($totalNumbers == 0) {
    $numberCount_dangcho = 0;
    $numberCount_dasudung = 0;
    $numberCount_boqua = 0;
} else {
    // Tính phần trăm dựa trên dữ liệu tổng số cấp số
    $numberCount_dasudung_pt = round(($numberCount_dangcho / $totalNumbers) * 100);
    $numberCount_dangcho_pt = round(($numberCount_dasudung / $totalNumbers) * 100);
    $numberCount_boqua_pt = round(($numberCount_boqua / $totalNumbers) * 100);
}

$deviceCount_hoatdong_pt = isset($deviceCount_hoatdong_pt) ? $deviceCount_hoatdong_pt : 0;
$deviceCount_ngunghoatdong_pt = isset($deviceCount_ngunghoatdong_pt) ? $deviceCount_ngunghoatdong_pt : 0;
$serviceCount_hoatdong_pt = isset($serviceCount_hoatdong_pt) ? $serviceCount_hoatdong_pt : 0;
$serviceCount_ngunghoatdong_pt = isset($serviceCount_ngunghoatdong_pt) ? $serviceCount_ngunghoatdong_pt : 0;
$numberCount_dasudung_pt = isset($numberCount_dasudung_pt) ? $numberCount_dasudung_pt : 0;
$numberCount_dangcho_pt = isset($numberCount_dangcho_pt) ? $numberCount_dangcho_pt : 0;
$numberCount_boqua_pt = isset($numberCount_boqua_pt) ? $numberCount_boqua_pt : 0;
$numberCount = isset($numberCount) ? $numberCount : 0;
?>
<!-- Chart -->
<script type="text/javascript">
$(document).ready(function() {
        var deviceCount_hoatdong_pt = <?php echo $deviceCount_hoatdong_pt; ?>;
        var deviceCount_ngunghoatdong_pt = <?php echo $deviceCount_ngunghoatdong_pt; ?>;
        var serviceCount_hoatdong_pt = <?php echo $serviceCount_hoatdong_pt; ?>;
        var serviceCount_ngunghoatdong_pt = <?php echo $serviceCount_ngunghoatdong_pt; ?>;
        var numberCount_dasudung_pt = <?php echo $numberCount_dasudung_pt; ?>;
        var numberCount_dangcho_pt = <?php echo $numberCount_dangcho_pt; ?>;
        var numberCount_boqua_pt = <?php echo $numberCount_boqua_pt; ?>;
        var numberCount = <?php echo $numberCount; ?>;


    new Morris.Donut({
        element: 'device',
        resize: true,
        colors: [
            'orangered',
            '#7e7d88',
        ],
        data: [{
                label: deviceCount_hoatdong_pt + '%',
                value: deviceCount_hoatdong_pt
            },
            {
                label: deviceCount_ngunghoatdong_pt + '%',
                value: deviceCount_ngunghoatdong_pt
            },
        ],
        formatter: function(y) {
            return '';
        },
        labelColor: '#848387',
    });

    new Morris.Donut({
        element: 'service',
        resize: true,
        colors: [
            '#4277ff',
            '#7e7d88',
        ],
        data: [{
                label: serviceCount_hoatdong_pt + '%',
                value: serviceCount_hoatdong_pt
            },
            {
                label: serviceCount_ngunghoatdong_pt + '%',
                value: serviceCount_ngunghoatdong_pt
            },
        ],
        formatter: function(y) {
            return '';
        },
        labelColor: '#848387',
    });

    new Morris.Donut({
        element: 'number',
        resize: true,
        colors: [
            '#35c75a',
            '#7e7d88',
            '#E73F3F',
        ],
        data: [{
                label: numberCount_dasudung_pt + '%',
                value: numberCount_dasudung_pt
            },
            {
                label: numberCount_dangcho_pt + '%',
                value: numberCount_dangcho_pt
            },
            {
                label: numberCount_boqua_pt + '%',
                value: numberCount_boqua_pt
            },
        ],
        formatter: function(y) {
            return '';
        },
        labelColor: '#848387',
    });

    var data = [{
        a: numberCount
    }, ];

    var config = {
        data: data,
        xkey: 'a',
        ykeys: ['a'],
        labels: ['Số thứ tự đã cấp'],
        fillOpacity: 0.6,
        hideHover: 'auto',
        behaveLikeLine: true,
        resize: true,
        pointFillColors: ['blue'],
        pointStrokeColors: ['#ffffff'],
        lineColors: ['blue']
    };

    config.element = 'area-chart';
    Morris.Area(config);

});

// ==================================== Biểu đồ Cấp số ====================================
window.onload = function () {
    var ctx = document.getElementById('myChart').getContext('2d');
    var labels = <?php echo json_encode($labels); ?>;
    var counts = <?php echo json_encode($counts); ?>;

    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: '',
          data: counts,
          backgroundColor: '#4277ff',
          borderColor: '#4277ff',
          borderWidth: 1,
          tension: 0.3,
          fill: {
            target: 'origin',
            above: '#d7e3ff',
          },
        }],
      },
      options: {
        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
            },
          }],
        },
        legend: {
          display: true
        },
      },
    });
  };

</script>

<script>
// ==================================== Lịch ====================================
const calendar = document.querySelector('.calendar');
const dayElement = calendar.querySelector('.day');
const monthElement = calendar.querySelector('.month-name');
const yearElement = calendar.querySelector('.year');
const prevButton = calendar.querySelector('.prev');
const nextButton = calendar.querySelector('.next');
const daysList = calendar.querySelector('.days');
let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

//Tạo chức năng để cập nhật ngày, tháng và năm trong lịch
function updateCalendar() {
    daysList.innerHTML = '';

    dayElement.textContent = currentDate.getDate();
    monthElement.textContent = getMonthName(currentMonth);
    yearElement.textContent = currentYear;

    const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    for (let i = 0; i < firstDayOfMonth; i++) {
        const li = document.createElement('li');
        li.innerHTML = '<span class="oldmonths">' + ((new Date(currentYear, currentMonth, 0).getDate()) - (
            firstDayOfMonth - i - 1)) + '</span>';
        daysList.appendChild(li);
    }

    for (let i = 1; i <= daysInMonth; i++) {
        const li = document.createElement('li');
        li.textContent = i;

        if (currentDate.getFullYear() == new Date().getFullYear() && currentDate.getMonth() == new Date().getMonth() &&
            i == new Date().getDate()) {
            li.classList.add('active-days');
        }

        daysList.appendChild(li);
    }

    const daysLeft = 35 - daysInMonth - firstDayOfMonth;

    for (let i = 1; i <= daysLeft; i++) {
        const li = document.createElement('li');
        li.innerHTML = '<span class="oldmonths">' + i + '</span>';
        daysList.appendChild(li);
    }
}

function getMonthName(monthIndex) {
    const monthNames = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];

    return monthNames[monthIndex];
}

updateCalendar();

prevButton.addEventListener('click', function() {
    currentMonth--;

    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }

    currentDate = new Date(currentYear, currentMonth, 1);
    updateCalendar();
});

nextButton.addEventListener('click', function() {
    currentMonth++;

    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }

    currentDate = new Date(currentYear, currentMonth, 1);
    updateCalendar();
});

daysList.addEventListener('click', function(event) {
    const clickedElement = event.target;

    if (clickedElement.tagName === 'LI') {
        const activeElements = daysList.querySelectorAll('.active-days');
        activeElements.forEach(function(element) {
            element.classList.remove('active-days');
        });
        clickedElement.classList.add('active-days');
    }
});
</script>
@endif
@endsection