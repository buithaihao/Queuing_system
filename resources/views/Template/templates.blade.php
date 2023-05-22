<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queuing_system</title>
    <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link FontAwesome -->
    <script src="https://kit.fontawesome.com/9ddb5fa8d6.js" crossorigin="anonymous"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <!-- Link Css -->
    <!-- <link rel="stylesheet" href="./resources/views/Template/templates.css"> -->
    <!-- Link thư viện JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Thư viện Morris.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />

    <!-- Thư viện biểu đồ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<style>
    /* Body */
    .dangnhap, .datlaimatkhau, .quenmatkhau{
        margin-top: 90px;
    }
    .dangky {
        background-color: #f7f7f7;
    }
    /* Logo */
    .img {
        text-align: center;
    }
    .img_dangnhap {
        text-align: center;
    }
    .img_dangky {
        margin-left: 600px;
    }
    .img_datlaimatkhau {
        text-align: center;
    }
    .img_quenmatkhau {
        text-align: center;
    }
    /* Chỉnh các input */
    .nhap {
    width: 550px;
    height: 50px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    }
    .nhap_quenmk {
    width: 500px;
    height: 50px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    }
    .nhap_avatar {
        width: 370px;
        height: 40px;
        border-radius: 8px;
        background-color: #d8d8d8;
        border: 1px solid rgb(202, 202, 202);
        padding-left: 10px;
    }
    .dropd {
        width: 270px;
        height: 45px;
        border-radius: 8px;
        border: 1px solid rgb(202, 202, 202);
        padding-left: 10px;
    }
    .dropdown-icon {
        position: relative;
    }

    .dropdown-icon select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .dropdown-icon i {
        position: absolute;
        top: 50%;
        left: 240px;
        transform: translateY(-50%);
    }
    .icon_dropd {
        color: orangered;
        font-size: 25px;
    }
    /* Chỉnh màu ký tự quenmk */
    .quenmk a {
        text-decoration: none;
        color: #ff0000;
    }
    /* Nút button */
    .button_dangnhap {
        width: 105px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
    }
    .button_dangnhap:hover {
        background-color: rgb(201, 54, 1);
    }
    .button_dangky {
        width: 125px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
        text-align: center;
    }
    .button_dangky:hover {
        background-color: rgb(201, 54, 1);
    }
    .button_datlaimatkhau {
        width: 105px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
    }
    .button_datlaimatkhau:hover {
        background-color: rgb(201, 54, 1);
    }
    .button_xn {
        width: 140px;
        height: 37px;
        color: #ffffff;
        background-color: orangered;
        border: none;
        border-radius: 6px;
        margin-left: 40px;
    }
    .button_xn:hover {
        background-color: rgb(201, 54, 1);
    }
    /* Nút button hủy */
    .button_huy {
        text-decoration: none;
        display: inline-block;
        width: 140px;
        height: 40px;
        border-radius: 6px;
        border: 1px solid orangered;
        background-color: #f7f7f7;
        color: orangered;
        text-align: center;
        line-height: 37px;
    }
    .button_huy:hover {
        background-color: #f7f7f7;
        border: 1px solid rgb(201, 54, 1);
        color:rgb(201, 54, 1);
    }
    .button_dn {
        margin-top: 210px;
        width: 140px;
        height: 37px;
        color: orangered;
        font-weight: 400;
        background-color: #fceac8;
        border: none;
        border-radius: 6px;
    }
     /* Menu */
    .menu ul {
        list-style-type: none;
        padding: 0px;
    }
    .menu ul a {
        padding-left: 15px;
        color: #848387;
        text-decoration: none;
        line-height: 50px;
        display: block;
    }
    .menu ul a:hover {
        color: orangered;
        background-color: #fceac8;
    }
    /* Thông tin của user */
    .khung {
        margin-top: 70px;
        background-color: #ffffff;
        border-radius: 10px;
        width: 1100px;
        height: 380px;
        box-shadow: 2px 2px 10px #848387;
    }
    .khung img {
        margin-top: 10px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        margin-left: 10px;
    }
    .khung h5 {
        margin-top: 25px;
        font-size: 25px;
        text-align: center;
        font-weight: 600;
    }
    /* Chỉnh icon bell */
    .icon {
        color: orangered;
        width: 30px;
        height: 30px;
        text-align: center;
        padding-top: 2px;
        border-radius: 50%;
        background-color: #fceac8;
        margin-top: 5px;
        margin-left: 690px;
    }
    .icon_notify {
        color: orangered;
        width: 30px;
        height: 30px;
        text-align: center;
        padding-top: 3.5px;
        border-radius: 50%;
        background-color: #fceac8;
        margin-top: 5px;
        border: none;
    }
    /* Button chuông khi chưa đăng nhập ở trang cá nhân */
    .icon_notify_chuadn {
        color: orangered;
        width: 30px;
        height: 30px;
        text-align: center;
        padding-top: 3.5px;
        border-radius: 50%;
        background-color: #fceac8;
        margin-top: 5px;
        /* margin-left: 730px; */
        border: none;
    }
    .icon:hover, .icon_notify:hover, .icon_notify_chuadn:hover {
        color: #ffffff;
        background-color: orangered;
    }
    /* Chỉnh hình avatar nhỏ */
    .icon_avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    /* Chỉnh icon camera */
    .icon_camera {
        color: #ffffff;
        width: 50px;
        height: 50px;
        text-align: center;
        border-radius: 50%;
        background-color: orangered;
        position: absolute;
        top: 365px;
        left: 440px;
        border: 3px solid #ffffff;
        font-size: 26px;
        padding-top: 2px;
    }
    /* Thanh tìm kiếm */
    .icon_search {
        color: orangered;
        font-size: 20px;
    }
    .dropd::-webkit-search-cancel-button {
        display: none;
    }

    /* Thanh cuộn dropdown (icon chuông) */
    .dropdown-menu-notification {
        z-index: 99999;
        width: 360px;
        height: 526px;
        position: absolute;
        top: 0;
        left: 800;
        margin: 0;
        padding: 0;
        border-radius: 10px;
        margin-right: -20px;
        overflow: hidden;
        border: none;
        background-color: #ffffff;
    }
    .header-notification {
        background-color: #FF9138;
        height: 48px;
        display: flex;
    }
    
    .header-notification p {
        margin: 0;
        padding: 0;
        color: #fff;
        display: flex;
        align-items: center;
        margin-left: 24px;
        font-size: 20px;
        font-weight: 700;
        line-height: 30px;
    }
    .list-notification {
        height: 477px;
        overflow-y: auto;
        background-color: #fff;
    }
    .list-role {
        overflow-y: auto;
        width: 500px;
        height: 400px;
        padding-top: 10px;
        padding-left: 20px;
        background-color: #fceac8;
        line-height: 30px;
    }
    .list-role::-webkit-scrollbar {
        width: 0em;
    }
     
    .list-role:hover::-webkit-scrollbar {
        width: 0.3em;
    }
    .list-role:hover::-webkit-scrollbar-thumb {
        margin-left: 5px;
    }
    
    .list-role::-webkit-scrollbar-track {
        -webkit-box-shadow: none;
        background-color: transparent;
    }
    
    .list-role::-webkit-scrollbar-thumb {
        background-color: #FFC89B;
        outline: none;
        border-radius: 20px;
    }
    /* Thanh cuộn notification*/
    .list-notification::-webkit-scrollbar {
        width: 0em;
    }
    
    .list-notification:hover::-webkit-scrollbar {
        width: 0.3em;
    }
    .list-notification:hover::-webkit-scrollbar-thumb {
        margin-left: 5px;
    }
    
    .list-notification::-webkit-scrollbar-track {
        -webkit-box-shadow: none;
        background-color: transparent;
    }
    
    .list-notification::-webkit-scrollbar-thumb {
        background-color: #FFC89B;
        outline: none;
        border-radius: 20px;
    }
    
    .item-notification {
        padding: 16px 0px 12px 24px;
        border-bottom: 1.5px solid #D4D4D7;
    }
    .item-notification:hover {
        background-color: #FFF2E7;
    }
    
    .text-user-notifi {
        margin: 0;
        padding: 0;
        font-size: 16px;
        font-weight: 700;
        line-height: 24px;
        color: #BF5805;
    }
    
    .condition-notifi {
        margin: 0;
        padding: 0;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
        color: #535261;
    }

    /* Button thêm thiết bị */
    .themthietbi {
        margin-top: 16px;
        width: 80px; 
        height: 90px;
        text-align: center; 
        border-radius: 5px;
        background-color: #fceac8;
        padding: 5px;
        box-shadow: 1px 1px 10px #848387;
        font-weight: 600;
    }
    .themthietbi i {
        color: orangered;
        font-size: 29px;
    }

/* Bảng danh sách các thiết bị */
.table-list-device {
    width: 1112px;
    margin-top: 16px;
    border-radius: 12px;
}
table {
    border-radius: 12px;
    width: 1087px;
    filter: drop-shadow(2px 2px 8px rgba(232, 239, 244, 0.8));
}
tbody {
    border-radius: 12px;
}
table thead {
    background-color: orangered;
    color: #ffffff;
}
.th-border-left {
    border-radius: 12px 0px 0px 0px;
}
.th-border-right {
    border-radius: 0px 12px 0px 0px;
}
.th-border-bottom-left {
    border-radius: 0px 0px 0px 12px;
}
.th-border-bottom-right {
    border-radius: 0px 0px 12px 0px;
}
tr {
    height: 48px;
}
td {
    font-weight: 400;
    font-size: 16px;
    color: #848387;
    padding-left: 12px;
    line-height: 10px;
}
td a {
    font-weight: 400;
    font-size: 14px;
}
.border-table {
    border-right: 2px solid #ffe3cd;
    border-left: 2px solid #ffe3cd;
}
.border-table-right {
    border-right: 2px solid #ffe3cd;
}
.border-table-left {
    border-left: 2px solid #ffe3cd;
}
.color-tr-or {
    background-color: #fceac8;
}
.color-tr-white {
    background-color: #ffffff;
}
tr:nth-child(even) {
  background-color: #fceac8;
}
/* Phân trang */
.phantrang {
    display: inline-block;
    height: 32px;
    margin-top: 25px;
    margin-left: 765px;
}
.trang {
    display: flex;
}

.trang li {
    width: 32px;
    height: 32px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.trang li a {
    text-decoration: none;
    font-weight: 600;
    font-size: 19px;
    color: #848387;
}

.modautrang {
    background-color: orangered;
}
.modautrang a {
    color: #ffffff !important;
    font-weight: 600;
    font-size: 19px;
}
/* Form nhập thiết bị */
.khung_themthietbi {
    margin-top: 25px;
    background-color: #ffffff;
    border-radius: 10px;
    width: 1100px;
    height: 560px;
    box-shadow: 2px 2px 10px #848387;
    padding-left: 20px;
}
.khung_themthietbi p {
    font-weight: 600;
}
/* Input thêm thiết bị */
.nhap_themthietbi {
    width: 495px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
.nhap_dv {
    width: 1035px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
.nhap_themdichvu {
    width: 495px;

    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    padding-top: 10px;
    padding-bottom: 95px;
}
/* Select loại thiết bị */
.select_loai {
    width: 495px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
    color: #757575;
}
.dropdown-loai {
    position: relative;
}
.dropdown-loai select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.dropdown-loai i {
    position: absolute;
    top: 50%;
    left: 465px;
    transform: translateY(-50%);
}
.icon_dropd {
    color: orangered;
    font-size: 25px;
}
/* Select tên dịch vụ */
.dropd_capso {
    width: 140px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
.dropdown-icon_capso {
    position: relative;
}
.dropdown-icon_capso select {
    -webkit-appearance: none;
    -moz-appearance: none;
     appearance: none;
}
.dropdown-icon_capso i {
    position: absolute;
    top: 50%;
    left: 110px;
    transform: translateY(-50%);
}
.icon_dropd {
    color: orangered;
    font-size: 25px;
}
/* Input chọn thời gian (trang dịch vụ) */
.chonthoigian {
    width: 180px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
/* Tăng tự động ở trang dịch vụ */
.tangtudong {
    border: 1px solid #848387;
    padding: 4px;
    border-radius: 5px;
    width: 50px;
    height: 35px;
}
.tangtudong a {
    text-decoration: none;
    color: black;
}
.khung_dichvu {
    margin-top: 25px;
    background-color: #ffffff;
    border-radius: 10px;
    width: 1100px;
    height: 520px;
    box-shadow: 2px 2px 10px #848387;
    padding-left: 20px;
}
/* Thanh tìm kiếm (trang cấp số) */
.dropd_search {
    width: 252px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid rgb(202, 202, 202);
    padding-left: 10px;
}
.dropdown-icon_search {
        position: relative;
    }
/* Bỏ icon mặc định của input:seach trang capso */
.dropd_search::-webkit-search-cancel-button {
  -webkit-appearance: none;
}

.dropd_search::-webkit-search-decoration {
  -webkit-appearance: none;
}

.dropd_search::-webkit-search-results-button {
  -webkit-appearance: none;
}

.dropd_search::-webkit-search-results-decoration {
  -webkit-appearance: none;
}

.dropdown-icon_search i {
    position: absolute;
    top: 50%;
    left: 220px;
    transform: translateY(-50%);
}
/* Thanh tìm kiếm (trang chi tiết dịch vụ) */
.dropdown-icon_search_ct {
    position: relative;
}
.dropdown-icon_search_ct i {
position: absolute;
top: 50%;
left: 140px;
transform: translateY(-50%);
}

/* Popup */
.modal-content {
    position: relative;
    width: 469px;
    height: 385px;
    background: #ffffff;
    border-radius: 24px;
    overflow: hidden;
    border: none;
}

.btn-close-popup {
    border: none;
    background-color: transparent;
    position: absolute;
    right: 16px;
    top: 14px;
    color: orangered;
    font-size: 20px;
}

.content-header {
    margin-top: 48px;
    text-align: center;
}

.content-header h3 {
    font-weight: 700;
    font-size: 32px;
    line-height: 48px;
    color: #848387;
}

.content-header h2 {
    margin: 24px 0;
    font-weight: 800;
    font-size: 56px;
    line-height: 60px;
    color: orangered;

}

.content-header p {
    font-weight: 400;
    font-size: 18px;
    line-height: 27px;
    color: black;
}

.content-footer {
    background: orangered;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 44px;
    height: 110px;
}

.text-datetime {
    width: 335px;
    height: 33px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.text-datetime p {
    font-weight: 600;
    font-size: 20px;
    color: #FFFFFF;
    display: flex;
}
/* Icon sắp xếp trang báo cáo */
.icon_sapxep a{
    text-decoration: none;
    color: #ffffff;
}
.icon_sapxep i{
    font-size: 18px;
}
/* Khung biểu đồ */
.khung_bieudo {
    width: 180px; 
    height: 120px; 
    background-color: #ffffff; 
    border-radius: 10px;
    padding: 10px;
}
.khung_bieudo p {
    width: 80px; 
    font-weight: 500;
}
.sophantram_tang{
    margin-top: 10px;
    margin-left: 40px;
    border-radius: 7px;
    width: 50px;
    height: 20px;
    padding: 3px;
}
.sophantram_tang {
    background-color: #fceac8;

}
.sophantram_tang p{
    font-size: 10px;
    line-height: 12px;
    font-weight: 400;
    color: orangered;
}
/* dashboard content-right */

.content-right {
    width: 401px;
    height: 100vh;
    background-color: #ffffff;
    padding-left: 24px;
}

.overview-rect {
    margin-top: 12px;
    width: 353px;
    height: 83px;
    background: #ffffff;
    box-shadow: 2px 2px 15px rgba(70, 64, 67, 0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;

}

.overview-number {
    margin-right: 32px;
}

.overview-number .number {
    font-weight: 500;
    font-size: 24px;
    color: black;
    line-height: 10px;
    padding-top: 25px;
    
}

.overview-number .text-device {
    color: orangered;
}

.overview-number .text-service {
    color: #4277ff;
}

.overview-number .text-numberlevel {
    color: #35c75a;
}   

.overview-status {
    width: 145px;
    font-weight: 400;
    font-size: 12px;
    line-height: 21px;
    color: #848387;
    align-items: center;
    margin-top: 15px;
}

.overview-status div {
    display: flex;
    align-items: right;
}

.overview-status div p {
    width: 115px;
    line-height: 10px;
}

.overview-status div span {
    font-weight: 500;
    font-size: 14px;
}


.span-device {
    color: orangered;
    line-height: 10px;
}

.span-service {
    color: #4277ff;
    line-height: 10px;
}

.span-numberlevel {
    color: #35c75a;
    line-height: 10px;
}

/* Lịch */
.calendar {
    margin-top: 16px;
    width: 353px;
    height: 285px;
    background: #FFFFFF;
    box-shadow: 2px 2px 15px rgba(70, 64, 67, 0.1);
    border-radius: 12px;
    padding: 12px 30px;
}

.header-calendar {
    display: flex;
    align-items: center;
    justify-content: space-around;
    height: 40px;
    border-bottom: 1px solid #DCDDFD;
    padding-bottom: 10px;
}

.header-calendar .month {
    font-weight: 700;
    font-size: 16px;
    line-height: 22px;
    color: #FF7506;
}

.header-calendar .prev, .next {
    background-color: transparent;
    border: none;
    color: #FF7506;
    width: 37px;
    height: 37px;
}

.weekdays {
    margin: 0;
    padding: 8px 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.weekdays li {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 0;
    width: 36px;
    height: 36px;
    text-align: center;
    font-weight: 700;
    font-size: 14px;
    line-height: 19px;
    color: #FF9138;
    margin: 0px 3px;
    cursor: pointer;
}

.days {
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
}

.days li {
    width: calc(100% / 7);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    font-weight: 600;
    font-size: 14px;
    line-height: 19px;
    color: #535261;
    margin: 0px 2px;
    border: none;
    cursor: pointer;
}

.oldmonths {
    font-weight: 400;
    color: #7E7D88;
}

.active-days {
    background-color: #FF7506;
    border-radius: 8px;
    color: #fff !important;
}

.active-days span {
    color: #ffffff;
}
/* Khung biểu đồ lọc */
.khung_bieudo_loc {
    margin-top: 25px;
    background-color: #ffffff;
    border-radius: 10px;
    width: 758px;
    height: 468px;
    box-shadow: 2px 2px 10px #848387;
    padding-top: 20px;
    margin-left: 15px;
}
</style>
<body>
    <!-- Trang đăng nhập -->
    @yield ('dangnhap') 
    <!-- Trang đăng ký -->
    @yield ('dangky') 
    <!-- Trang quên mật khẩu -->
    @yield ('quenmatkhau') 
    <!-- Trang đặt lại mật khẩu -->
    @yield ('datlaimatkhau') 
    <div class="row">
        <div class="col-lg-2" style="margin-top: 20px; padding-right: 0px;">
            @if(!View::hasSection('dangnhap') && !View::hasSection('dangky') && !View::hasSection('quenmatkhau')&& !View::hasSection('datlaimatkhau'))
                @include ("includes.header")
            @endif
        </div>
        <div class="col-lg-10">
        <!-- Trang tài khoản cá nhân -->
            @yield ('taikhoancanhan') 
            @yield ('dashboard') 
        <!-- Thiết bị -->
            @yield ('thietbi') 
            @yield ('themthietbi') 
            @yield ('ctthietbi') 
            @yield ('capnhatthietbi') 
        <!-- Dịch vụ -->
            @yield ('dichvu')
            @yield ('themdichvu')
            @yield ('ctdichvu')
            @yield ('capnhatdichvu')
        <!-- Cấp số -->
            @yield ('capso')
            @yield ('capsomoi')
            @yield ('ctcapso')
        <!-- Báo cáo -->
            @yield ('baocao')
        <!-- Vai trò -->
            @yield ('vaitro')
            @yield ('themvaitro')
            @yield ('capnhatvaitro')
        <!-- Tài khoản -->
            @yield ('quanlytaikhoan')
            @yield ('themtaikhoan')
            @yield ('capnhattaikhoan')
        <!-- Nhật ký -->
            @yield ('nhatky')
        </div>
    </div>
</body>

</html>