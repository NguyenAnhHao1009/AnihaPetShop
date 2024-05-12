<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
authAdmin();
use \App\Product;
global $PDO;
$product = new Product($PDO);

$product_info = $_POST;

$current_page = 'Edit Product';

if (!empty($product_info)) {
    $product_info['product_avatar'] = $product_info['old_product_avatar'];

    if (isset($_FILES['product_avatar'])) {
        if ((!empty($_FILES['product_avatar']['name']))) {
            $product_info['product_avatar'] = $_FILES['product_avatar']['name'];
            $product_info['tmp_name'] = $_FILES['product_avatar']['tmp_name'];
        }

        if ($product_info['product_avatar'] !== $product_info['old_product_avatar']) {
            $result_save_img = saveImgToUploadsFolder($product_info['tmp_name'], $product_info['product_avatar']);
            if ($result_save_img == true) {
                removeImgFromUploadsFolder($product_info['old_product_avatar']);
            }
        }
    }
    $product->fill($product_info);
    if ($product->edit()) {
        $_SESSION['edit_product_status'] = '<h5 class="text-success text-center fw-bolder">' . 'Chỉnh sửa sản phẩm thành công!' . '</h5>';
        redirect('/admin/product');
    } else {
        $_SESSION['edit_product_status'] = '<h5 class="text-success text-warning fw-bolder">' . 'Chỉnh sửa sản phẩm thất bại!' . '</h5>';
        redirect('/admin/product');
    };
} else {
    if (empty($_GET['id'])) {
        redirect('/admin/product');
        exit();
    }

    $product_id = $_GET['id'];
    if ($product->find($product_id) === null) {
        redirect('/admin/product');
        exit();
    } else {
        $product = $product->getProductInfoById($product_id);
        require_once __DIR__ . '/../../Views/header.php';
        require_once __DIR__ . '/../../Views/admin/m-edit-product.php';
        require_once __DIR__ . '/../../Views/footer.php';
    }
}
