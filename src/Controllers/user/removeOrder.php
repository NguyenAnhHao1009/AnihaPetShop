<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
authUser();
use \App\Order;
use \App\Product;
global $PDO;
$order = new Order($PDO);
$product = new Product($PDO);

if (!empty($_GET['id'])) {
    $order_id = $_GET['id'];

    if($order->getOwnerIdByOrderId($order_id) != $_SESSION['user_id']){
        $_SESSION['remove-order-status'] = 'Bạn không có quyền truy cập đơn hàng này!';
        redirect('/user/cart/finish');
    }

    if ($order->checkOrderHaveStatus0($order_id)) {
        $prd_quantity_arr = $order->orderIdAndQuantityOfOrder($order_id);
        foreach ($prd_quantity_arr as $prd_quantity) {
            $product_id = $prd_quantity['product_id'];
            $quantity = $prd_quantity['quantity'];
            $product->addNumberOfProduct($product_id, $quantity);
        }
        if ($order->changeStatusTo_2($order_id)) {
            $_SESSION['remove-order-status'] = 'Hủy đơn hàng thành công';
        } else {
            $_SESSION['remove-order-status'] = 'Hủy đơn hàng thất bại';
        }
    } else {
        $_SESSION['remove-order-status'] = 'Có lỗi xảy ra khi xóa đơn hàng';
    }
    redirect('/user/cart/finish');
} else {
    redirect('/user/cart/finish');
}
