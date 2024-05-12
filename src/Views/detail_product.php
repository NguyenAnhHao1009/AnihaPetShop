<?php

if (isset($no_product_id)) {
    echo "<h3 class='text-center text-secondary py-3'>{$no_product_id}</h3>";
    echo "<hr>";
    echo "<h1 class='text-center mb-3'>SẢN PHẨM ĐƯỢC ĐỀ XUẤT</h1>";
?>
    <div class="container">
        <div class="row justify-content-around justify-content-md-start">
            <?php
            foreach ($products_random as $sp) :
            ?>
                 <form action="/add_to_cart" method="post" class="product-box col-5 col-md-3 col-lg-2 px-2 py-3">
                    <input hidden name='add_to_cart' type="text" value=<?= html_escape($sp['product_id']) ?>>
                    <input type="hidden" name="stock_quantity" value="<?= html_escape($sp['stock_quantity']) ?>">
                    <input type="hidden" name="quantity" value="1">
                    <div class='product'>
                        <img class="img-fluid" src="/uploads/<?= html_escape($sp['product_avatar']) ?>" alt="Ảnh đang cập nhật">
                        <div class="col-12 info justify-content-center">
                            <p class="text-truncate px-2 text-center"><b><?= html_escape($sp['product_name']) ?></b></p>
                            <p class=" text-secondary text-center"><b>Kho: </b><?= html_escape($sp['unit_price']) ?></p>
                            <div class="text-center">
                                <a href="/product_detail?id=<?= html_escape($sp['product_id']) ?>" class="btn btn-detail">Details</a>
                                <button class="add-to-cart btn btn-add-to-cart"><i class="fa-solid fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endforeach ?>
        </div>
    </div>

<?php } else {
?>
    <form id="detail_product_form" action="/add_to_cart" method="post" class="box-detail container py-5 mt-5  ">
        <input hidden name='add_to_cart' type="text" value=<?= html_escape($product->getId()) ?>>
        <div class="row justify-content-around">
            <div class="col-12  row col-md-4 text-center align-item-center p-2">
                <div class="container-fluid">
                    <img width="70%" class="img-fluid rounded" src="uploads/<?= html_escape($product->getProductAvatar()) ?>" alt="Ảnh sản phẩm">
                </div>

            </div>
            <div class="col-12 col-md-8">
                <h1><?php echo html_escape($product->getName()) ?></h1>
                <hr>
                <p class="product_description"><?= html_escape($product->getDescription()) ?? 'Thông tin đang cập nhật' ?></p>
                <div class="d-flex justify-content-between row">
                    <p class="col-5"><b>Danh mục:</b> <a class="text-secondary" href="/product?type=<?= html_escape($product->getCategoryName()) ?? 0 ?>"><?= html_escape($product->getCategoryName()) ?? 'Unknown' ?></a></p>
                    <p class="col-5"><b>Số lượng còn lại: </b><?= $product->getStockQuantity()?? 0 ?></p>
                    <input type="hidden" name="stock_quantity" value="<?= $product->getStockQuantity()??0 ?>">
                </div>
                <p><b>Giá:</b> <?= html_escape($product->getUnitPrice()) . '$' ?></p>

                <div class="">
                    <p class="col-12 col-md-6"><b>Số lượng:</b> <input value="1" id='number_of_products' name='quantity' style="width: 3em" type="number"></p>
                    <p class="col-12 col-md-6 text-start"><button id='btn-add-to-cart' class="btn btn-add-to-cart" type="submit">Thêm vào giỏ hàng</button></p>
                </div>
            </div>
        </div>
    </form>

    <h1 class="text-center mt-5">CÁC SẢN PHẨM TƯƠNG TỰ</h1>

    <div class="container">
        <hr>
        <div class="row justify-content-around justify-content-md-start">
            <?php
            foreach ($products_related as $sp) :
            ?>

                <form action="/add_to_cart" method="post" class="product-box col-5 col-md-3 col-lg-2 px-2 py-3">
                    <input hidden name='add_to_cart' type="text" value=<?= html_escape($sp['product_id']) ?>>
                    <input type="hidden" name="stock_quantity" value="<?= html_escape($sp['stock_quantity']) ?>">
                    <input type="hidden" name="quantity" value="1">
                    <div class='product'>
                        <img class="img-fluid" src="/uploads/<?= html_escape($sp['product_avatar']) ?>" alt="Ảnh đang cập nhật">
                        <div class="col-12 info justify-content-center">
                            <p class="text-truncate px-2 text-center"><b><?= html_escape($sp['product_name']) ?></b></p>
                            <p class=" text-secondary text-center"><b>Kho: </b><?= html_escape($sp['unit_price']) ?></p>
                            <div class="text-center">
                                <a href="/product_detail?id=<?= html_escape($sp['product_id']) ?>" class="btn btn-detail">Details</a>
                                <button class="add-to-cart btn btn-add-to-cart"><i class="fa-solid fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endforeach ?>
        </div>
    </div>
<?php } ?>
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