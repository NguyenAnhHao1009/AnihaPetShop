<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
authAdmin();
use \App\Product;
global $PDO;
$product = new Product($PDO);

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    if ($product->delete($id)) {
        $_SESSION['delete_product_status'] = '<h5 class="text-success text-center fw-bolder">' . 'Xóa sản phẩm thành công!' . '</h5>';
        redirect('/admin/product');
    } else {
        $_SESSION['delete_product_status'] = '<h5 class="text-danger text-center fw-bolder">' . 'Sản phẩm đang trong đơn hàng nên không thể xóa' . '</h5>';
        redirect('/admin/product');
    };
} else {
    redirect('/admin/product');
}
