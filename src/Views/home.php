<section class="">

  <div class="slider">
    <div class="list">
      <div class="item">
        <img src="/img/slider6.jfif" alt="">
      </div>
      <div class="item">
        <img src="/img/slider3.jfif" alt="">
      </div>
      <div class="item">
        <img src="/img/slider2.jfif" alt="">
      </div>
      <div class="item">
        <img src="/img/slider7.jfif" alt="">
      </div>
      <div class="item">
        <img src="/img/slider4.jfif" alt="">
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

  <div id="services" class="pt-4 py-5 container">
    <h1 class="text-center pt-2">DỊCH VỤ</h1>
    <div class="row">
      <hr>
      <a href="/product?type=food" class="service text-center col-6  col-md-3">
        <i class="fa-solid fa-utensils"></i>
        <h4>Thức ăn</h4>
        <div>Cung cấp đầy đủ các loại thức ăn cho thú cưng của bạn</div>
      </a>
      <a href="/product?type=food" class="service text-center col-6  col-md-3">
        <i class="fa-solid fa-hand-holding-medical"></i>
        <h4>Sức khỏe</h4>
        <div>Nơi tận tâm yêu thương những bé thú cưng đáng yêu</div>
      </a>
      <a href="/product?type=rabbit" class="service text-center col-6 col-md-3">
        <i class="fa-solid fa-paw"></i>
        <h4>Thú cưng</h4>
        <div>Cung cấp đa dạng các loại thú cưng phổ biến trên thị trường</div>
      </a>
      <a href="/product?type=accessory" class="service text-center col-6  col-md-3">
        <i class="fa-solid fa-house-chimney-window"></i>
        <h4>Phụ kiện</h4>
        <div>Phụ kiện là thứ không thể thiếu của các bé thú cưng</div>
      </a>
    </div>
  </div>
  <div class="container">
    <h1 class="text-center pt-4">DANH MỤC NỔI BẬT</h1>
    <div class=" pb-5 row justify-content-around">
      <hr>
      <div class="col-3">
        <div class="image-container text-center">
          <img class="img-fluid" src="img/cat.jpg" alt="Ảnh mèo">
          <div class="overlay">
            <div>
              <h1 class="h1 text-white">CAT</h1>
              <button class="shop-now-btn btn px-3"><a href="/product?type=cat" class="text-white h5 "><i class="fa-solid fa-cart-shopping"></i></a></button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="image-container text-center">
          <img class="img-fluid" src="img/dog.jpg" alt="Ảnh mèo">
          <div class="overlay">
            <div>
              <h1 class="h1 text-white">DOG</h1>
              <button class="shop-now-btn btn px-3"><a href="/product?type=dog" class="text-white h5 "><i class="fa-solid fa-cart-shopping"></i></a></button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="image-container text-center">
          <img class="img-fluid" src="img/hamster.jpg" alt="Ảnh mèo">
          <div class="overlay">
            <div>
              <h1 class="h1 text-white">MICE</h1>
              <button class="shop-now-btn btn px-3"><a href="/product?type=mouse" class="text-white h5 "><i class="fa-solid fa-cart-shopping"></i></a></button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="image-container text-center">
          <img class="img-fluid" src="img/rabbit.jpg" alt="Ảnh thỏ">
          <div class="overlay">
            <div>
              <h1 class="h1 text-white">BUNNY</h1>
              <button class="shop-now-btn btn px-3"><a href="/product?type=rabbit" class="text-white h5 "><i class="fa-solid fa-cart-shopping"></i></a></button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <h1 class="text-center">SẢN PHẨM BÁN CHẠY</h1>
  <div class="container bg-color-secondary">
    <hr>
    <div class="row justify-content-around justify-content-md-start">

      <?php

      if (isset($products_random)) :
        foreach ($products_random as $sp) :
      ?>

          <form action="/add_to_cart" method="post" class="product-box col-5 col-md-3 col-lg-2 px-2 py-3">
            <input hidden name='add_to_cart' type="text" value=<?= html_escape($sp['product_id']) ?? '' ?>>
            <input type="hidden" name="stock_quantity" value="<?= html_escape($sp['stock_quantity']) ?? 0 ?>">
            <input type="hidden" name="quantity" value="1">
            <div class='product'>
              <img class="img-fluid" src="/uploads/<?= html_escape($sp['product_avatar']) ?? '' ?>" alt="Ảnh đang cập nhật">
              <div class="col-12 info justify-content-center">
                <p class="text-truncate text-center px-2"><b><?= html_escape($sp['product_name']) ?? '' ?></b></p>
                <p class=" text-secondary text-center"><b>Kho: </b><?= html_escape($sp['stock_quantity']) ?? '' ?></p>
                <div class="text-center">
                  <a href="/product_detail?id=<?= html_escape($sp['product_id']) ?? '' ?>" class="btn btn-detail">Details</a>
                  <button type="submit" class="btn btn-add-to-cart"><i class="fa-solid fa-cart-plus"></i></button>
                </div>
              </div>
            </div>
          </form>

      <?php endforeach;
      endif;

      if (!isset($products_random) || !$products_random) {
        echo '<div class="col-12 text-center"><h1>Không có sản phẩm nào</h1></div>';
      }
      ?>

    </div>
    <div class=" pb-5 text-center"><a href="/product" id='more-products-btn' class="btn">Xem Thêm <i class="fa-solid fa-angles-right"></i></a></div>
  </div>


  <div id="before-footer" class="p-4 container-fluid">
    <div  style='margin:auto' class="row container">
      <a   class=" text-center col-6  col-lg-3">
        <i class="fa-solid fa-truck"></i>
        <h5 class='pt-3 text-truncate'>Vận chuyển miễn phí</h5>
        <p  >Miễn phí ship toàn quốc</p>
      </a>
      <a class=" text-center col-6  col-lg-3">
        <i class="fa-solid fa-phone-volume"></i>
        <h5 class='pt-3 text-truncate'>Hỗ trợ 24/7</h5>
        <p >Luôn tận tâm với khách hàng</p>
      </a>
      <a  class=" text-center col-6 col-lg-3">
        <i class="fa-solid fa-money-bill-wheat"></i>
        <h5 class='pt-3 text-truncate'>Ưu đãi ngập tràn</h5>
        <p >Rất nhiều quà tặng kèm theo</p>
      </a>
      <a href='/signup'  class="sign-up text-center col-6  col-lg-3">
        <i class="fa-solid fa-user-plus"></i>
        <h5 class='pt-3 text-truncate'>Đăng ký ngay</h5>
        <p >Để nhận được nhiều ưu đãi</p>
      </a>
    </div>
  </div>
</section>