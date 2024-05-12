<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
authUser();
use \App\Order;
use \App\Product;
global $PDO;
$order = new Order($PDO);

if (!empty($_POST['id'])) {
    $order_id = $_POST['id'];
    if ($order->changeStatusFrom_1To0($order_id)) {
        $order_address = $_POST['order_address'];
        $order_phone = $_POST['order_phone'];
        if(!$order->updatePhoneOrderAndAddressOrderOfOrder($order_id, $order_phone, $order_address)){
            $_SESSION['add-order-status'] = 'Không thể cập nhật thông tin giao hàng';
        }else{
            $_SESSION['add-order-status'] = 'Bạn đã thêm một đơn hàng thành công';
        }
        
    } else {
        $_SESSION['add-order-status'] = 'Thêm đơn hàng thất bại';
    }
    redirect('/user/cart/finish');
} else{
    redirect('/user/cart');
}

