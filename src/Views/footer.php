<footer class="container-fluid bg-light px-0">
  <div class="container-fluid container-md ">
    <div class="row p-3">
      <div class="container col-12 col-md-6 col-lg-3">
        <img src="/img/header-img.jpg" alt="Banner" class="img-fluid">
        <p class='mb-1'><b>Address: </b>22/12 Đ.Mậu Thân, An Hòa, Ninh Kiều, TP Cần Thơ</p>
        <p class='mb-1'><b>Email: </b>anihastore@gmail.com</p>
        <p class='mb-1'><b>Tel: </b>0789887234</p>
        <p>
          <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
          <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://www.tiktok.com/en/"><i class="fa-brands fa-tiktok"></i></a>
          <a href="https://twitter.com/"><i class="fa-brands fa-twitter"></i></a>
          <a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i></a>
        </p>
      </div>
      <div class="container col-12 col-md-6 col-lg-3 mb-4">
        <h4>Cửa Hàng</h4>

        <a><b>AniHa Store </b>là địa chỉ uy tín cung cấp thú cưng và phụ kiện thú cưng nhập khẩu chất lượng tốt nhất
          từ 2024.</a><br><br>


      </div>
      <div class="support container col-12 col-md-6 col-lg-3 mb-4">
        <h4 class="text-nowrap">Hỗ Trợ Khách Hàng</h4>
        <p>
          <a href="/about">Về chúng tôi</a><br>
          <a href="/contact">Liên hệ cửa hàng</a><br>
          <a href="/term">Điều khoảng & chính sách bảo mật</a><br>
          <a href="/transaction">Điều kiện giao dịch chung</a><br>
          <a href="/transaction">Chính sách bảo hành và đổi trả</a><br>
         
        
        </p>



      </div>

      <div class="container col-12 col-md-6 col-lg-3">
        <h4>Chứng nhận</h4>
        <p>
          <b>AniHa Store</b> cam kết tuân thủ các quy định tại Luật Lâm nghiệp, Luật Chăn nuôi, các Nghị định hướng
          dẫn (Nghị định 13/2020/NĐ-CP, 06/2019/NĐ-CP, v.v…) và các văn bản liên quan khi kinh doanh các loài thú nuôi
          trên website này.
        </p>
      </div>
    </div>

  </div>

  <p id="backToTopBtn" class="fw-bolder" title="Go to top"><i class="fa-solid fa-angles-up"></i></p>
</footer>


<?php
include_once __DIR__ . '/myconfirm.php';
include_once  __DIR__ .'/myalert.php';
?>

<script type='text/javascript' src='/js/back_to_top.js'></script>

<script type='text/javascript' src='/js/sort.js'></script>

<script type='text/javascript' src='/js/index.js'></script>

<script type='text/javascript' src='/js/check_form.js'></script>

<script type='text/javascript' src='/js/my_confirm.js'></script>


<script>
  // Yêu cầu có tài khoản để dùng giỏ hàng 
  $('.btn-go-to-cart').on('click', function(event){
    <?php
    if (!isset($_SESSION['user_id'])) { ?>
      event.preventDefault();
      my_alert("Bạn cần có tài khoản người dùng để sử dụng chức năng này");
      return;
    <?php }?>
  });

  // Yêu cầu có tài khoản để thêm giỏ hàng
  let confirmed_add_to_cart = false;
  $('.btn-add-to-cart').on('click', function(event) {
    <?php
    if (!isset($_SESSION['user_id'])) { ?>
      event.preventDefault();
      my_alert("Bạn cần có tài khoản người dùng để sử dụng chức năng này");
      return;
    <?php
    }
    ?>
    let form = $(this).closest('form');
    
    if (form) {
      
      var stock_quantity = form.find('input[name="stock_quantity"]');
      
      stock_quantity = parseInt(stock_quantity.val());
      var quantity = form.find("input[name='quantity']");

      if (stock_quantity <= 0) {
          event.preventDefault();
          my_alert("Số lượng sản phẩm này trong kho đã hết");
          return;
      }

      if(quantity.val().trim() == ''){
        event.preventDefault();
        my_alert("Vui lòng nhập số lượng sản phẩm");
        return;
      }

      quantity = parseInt(quantity.val());
      
      if(quantity <= 0){
        event.preventDefault();
        my_alert("Số lượng sản phẩm không hợp lệ");
        return;
      }
      if (quantity > stock_quantity) {
        event.preventDefault();
        my_alert("Số lượng sản phẩm vượt quá số lượng trong kho");
        return;
      }
      
      my_confirm('Thêm sản phẩm vào giỏ hàng', function(){
            confirmed_add_to_cart = true; // Người dùng đã xác nhận
            form.submit(); // Tiếp tục submit form
      });
        return confirmed_add_to_cart;
    }
  });
</script>



</body>

</html