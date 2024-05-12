<div class="slider">
    <div class="list">
        <div class="item">
            <img src="img/slider6.jfif" alt="">
        </div>
        <div class="item">
            <img src="img/slider3.jfif" alt="">
        </div>
        <div class="item">
            <img src="img/slider2.jfif" alt="">
        </div>
        <div class="item">
            <img src="img/slider7.jfif" alt="">
        </div>
        <div class="item">
            <img src="img/slider4.jfif" alt="">
        </div>
    </div>
    <div class="buttons">
        <button id="prev">
            <i class="fa-solid fa-angles-left"></i>
        </button>
        <button id="next">
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>
    <ul class="dots">
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
<marquee behavior="" direction="left" class="p-2 text-center">
    <h3> <img src="./img/logo.png" alt=""> <img src="./img/logo.png" alt=""> CHÀO MỪNG ĐẾN VỚI TRANG QUẢN LÝ <b>ANIHA STORE </b> <img src="./img/logo.png" alt=""> <img src="./img/logo.png" alt=""></h3>
</marquee>
<h1 class="text-center fw-bolder">DASH BOARD</h1>

<div class="container-fluid">


    <div class="row px-3">
        <hr>
        <div class="col-6 col-lg-3  justify-content-between px-0 ">
            <a href="admin/user" style="background-color: #e75811;" class="row m-2 px-2 box py-3 ">
                <div class="col-6 h1 text-truncate fw-bolder"><?= html_escape($num_users) ?></div>
                <div class="col-6 text-center"><i class="col-12 d-block fa-solid fa-users big-icon"></i> </div>
                <div class="col-12 text-center py-1 fw-bolder">Khách hàng </div>
            </a>
        </div>
        <div class="col-6 col-lg-3  justify-content-between px-0 ">
            <a href="/admin/product" style="background-color: #062b9a" class="row m-2 px-2 box py-3 ">
                <div class="col-6 h1 text-truncate fw-bolder"><?= html_escape( $num_products) ?></div>
                <div class="col-6 text-center"><i class="col-12 d-block fa-solid fa-cat big-icon"></i> </div>
                <div class="col-12 text-center py-1 fw-bolder">Sản phẩm </div>
            </a>
        </div>
        <div class="col-6 col-lg-3  justify-content-between px-0 ">
            <a href="/admin/order" style="background-color: #004210;" class="row m-2 px-2 box py-3 ">
                <div class="col-6 h1 text-truncate fw-bolder"><?= html_escape($num_orders) ?></div>
                <div class="col-6 text-center"><i class="col-12 d-block fa-solid fa-file-invoice big-icon"></i> </div>
                <div class="col-12 text-center py-1 fw-bolder">Đơn hàng</div>
            </a>
        </div>
        <div class="col-6 col-lg-3  justify-content-between px-0 ">
            <div style="background-color: #eb017a" class="row m-2 px-2 box py-3 ">
                <div class="col-7 col-lg-7 h1 fw-bolder text-truncate"><?= html_escape($total_revenue) ?> $</div>
                <div class="col-5 col-lg-5 text-center"><i class="col-12 d-block fa-solid fa-hand-holding-dollar big-icon"></i> </div>
                <div class="col-12 text-center py-1 fw-bolder">Doanh thu</div>
            </div>
        </div>
    </div>
</div>
<script src="js/slide.js" type="text/javascript"></script>