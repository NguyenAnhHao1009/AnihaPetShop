<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
authAdmin();
use \App\Product;
global $PDO;
$product = new Product($PDO);
$current_page = 'Create Product';
if($_SERVER['REQUEST_METHOD'] == 'POST'):
if (!empty($_POST) && !empty($_FILES)) {
    $img_name = $_FILES['product_avatar']['name'];
    $img_tmp_name = $_FILES['product_avatar']['tmp_name'];
    saveImgToUploadsFolder($img_tmp_name, $img_name);
    $_POST['product_avatar'] = $img_name;
    $product->fill($_POST);
    print_r($_POST);
    if ($product->save()) {
        $_SESSION['add_product_status'] = 'Bạn đã thêm sản phẩm thành công!';
        redirect('/admin/product');
    } else {
        $_SESSION['add_product_status'] = 'Thêm sản phẩm thất bại, hãy thử lại!';
        redirect('/admin/product/create');
    }
} 
endif;
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once __DIR__ . '/../../Views/header.php';
    require_once __DIR__ . '/../../Views/admin/m-create-product.php';
    require_once __DIR__ . '/../../Views/footer.php';
}




