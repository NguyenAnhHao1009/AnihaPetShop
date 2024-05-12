<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
authUser();
use \App\Order;
use \App\Product;
global $PDO;
$order = new Order($PDO);
$product = new Product($PDO);

$product_id = $_GET['rm_product_id'];
$order_id = $_GET['order_id'];
if (!empty($product_id) && !empty($order_id)) {

    if (!($order->checkProductExistsInOrder($order_id, $product_id))) {
        $_SESSION['remove-product-status'] = 'Sản phẩm chưa có trong giỏ hàng';
        redirect('/user/cart');
    }

    $quantity = $order->getQuantityOfProductInOrder($order_id, $product_id);
    if ($order->removeProductFromCart($order_id, $product_id) && $product->addNumberOfProduct($product_id, $quantity)) {
        $_SESSION['remove-product-status'] = 'Bạn đã xóa sản phẩm ra khỏi giỏ hàng thành công';
    } else {
        $_SESSION['remove-product-status'] = 'Xóa sản phẩm thất bại';
    }
    redirect('/user/cart');
} else {
    redirect('/user/cart');
}
