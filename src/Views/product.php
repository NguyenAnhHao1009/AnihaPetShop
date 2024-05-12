<h1 class="text-center fw-bolder p-3">SẢN PHẨM</h1>
<?php
if (isset($_SESSION['search-key'])) {
    echo "<h5 class='text-center '>Kết quả tìm kiếm từ khóa '{$_SESSION['search-key']}'</h5> ";
    unset($_SESSION['search-key']);
}
?>
<?php


if (empty($products_p)) {
    echo '<h3 class="text-center text-secondary"> Không có sản phẩm nào phù hợp</h3>';
} else {

?>
    <hr>
    <div class="container">

        <div class="row justify-content-around justify-content-md-start">
            <?php
            foreach ($products_p as $sp) :
            ?>
                <form action="/add_to_cart" method="post" class="product-box col-5 col-md-3 col-lg-2 px-2 py-3">
                    <input hidden name='add_to_cart' type="text" value=<?= $sp->getId() ?>>
                    <input type="hidden" name="stock_quantity" value="<?= $sp->getStockQuantity() ?>">
                    <input type="hidden" name="quantity" value="1">
                    <div class='product'>
                        <img class="img-fluid" src="uploads/<?= $sp->getProductAvatar() ?>" alt="Ảnh đang cập nhật">
                        <div class="col-12 info justify-content-center">
                            <p class="text-truncate px-2 text-center"><b><?= $sp->getName() ?></b></p>
                            <p class=" text-secondary text-center"><b>Kho: </b><?= $sp->getStockQuantity() ?></p>
                            <div class="text-center">
                                <a href="/product_detail?id=<?= $sp->getId() ?>" class="btn btn-detail">Details</a>
                                <button class="add-to-cart btn btn-add-to-cart"><i class="fa-solid fa-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endforeach ?>
        </div>
    </div>

    <!-- Pagination -->
    <nav class="d-flex justify-content-center">
        <ul class="pagination">

            <li class="page-item <?php echo $paginator->getPrevPage() ? '' : 'disabled'; ?>">
                <a role="button" href="<?php
                                        if (isset($_GET['search_key'])) {
                                            echo '/product?search_key=' . html_escape($_GET['search_key']).'&';
                                        } else if(isset($_GET['type'])) {
                                            echo '/product?type=' . html_escape($_GET['type']).'&';
                                        }else{
                                             echo '/product?';
                                        }
                                        ?>page=<?= $paginator->getPrevPage() ?>" class="page-link">
                    <span class="fw-bolder d-block">&laquo;</i></span>
                </a>
            </li>

            <?php foreach ($pages as $page) : ?>
                <li class="page-item <?php echo $paginator->currentPage === $page ? 'active' : ''; ?>">
                    <a role="button" href="<?php
                                            if (isset($_GET['search_key'])) {
                                                echo '/product?search_key=' . html_escape($_GET['search_key']).'&';
                                            } else if(isset($_GET['type'])) {
                                                echo '/product?type=' . html_escape($_GET['type']).'&';
                                            }else{
                                                 echo '/product?';
                                            }
                                            ?>page=<?= $page ?>" class="page-link">
                        <?= $page ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <li class="page-item <?php echo $paginator->getNextPage() ? '' : 'disabled'; ?>">
                <a role="button" href="<?php
                                        if (isset($_GET['search_key'])) {
                                            echo '/product?search_key=' . html_escape($_GET['search_key']).'&';
                                        } else if(isset($_GET['type'])) {
                                            echo '/product?type=' . html_escape($_GET['type']) .'&';
                                        }else{
                                             echo '/product?';
                                        }
                                        ?>page=<?= $paginator->getNextPage() ?>" class="page-link">
                    <span class="fw-bolder">&raquo;</span>
                </a>
            </li>

        </ul>

    </nav>
    <!-- Pagination -->



<?php } ?>

<?php if (!empty($products_care)) : ?>

    <h2 class="text-center pt-5">ĐƯỢC QUAN TÂM</h2>
    <div class="container">
        <hr>
        <div class="row justify-content-around justify-content-md-start">
            <?php
            foreach ($products_care as $sp) :
            ?>
                <form action="/add_to_cart" method="post" class="product-box col-5 col-md-3 col-lg-2 px-2 py-3">
                    <input hidden name='add_to_cart' type="text" value=<?= html_escape($sp['product_id']) ?>>
                    <input type="hidden" name="stock_quantity" value="<?= html_escape($sp['stock_quantity']) ?? 0 ?>">
                    <input type="hidden" name="quantity" value="1">
                    <div class='product'>
                        <img class="img-fluid" src="uploads/<?= html_escape($sp['product_avatar']) ?>" alt="Ảnh đang cập nhật">
                        <div class="col-12 info justify-content-center">
                            <p class="text-truncate px-2 text-center"><b><?= html_escape($sp['product_name']) ?></b></p>
                            <p class=" text-secondary text-center"><b>Kho: </b><?= html_escape($sp['stock_quantity']) ?></p>
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


<?php endif; ?>
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