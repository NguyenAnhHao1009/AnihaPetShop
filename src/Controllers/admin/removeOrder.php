<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
authAdmin();
use \App\Order;
use \App\Product;
global $PDO;
$order = new Order($PDO);
$product = new Product($PDO);

if (!empty($_GET['id'])) {
    $order_id = $_GET['id'];
    if ($order->checkOrderHaveStatus_2($order_id)) {
        if ($order->removeOrderDetailsHasOrderId($order_id) && $order->removeOrderHasOrderId($order_id)) {
            $_SESSION['accept_order'] = "Xóa đơn hàng $order_id thành công";
        } else {
            $_SESSION['accept_order'] = 'Xóa đơn hàng thất bại';
        }
        redirect('/admin/order');
    } else {
        $_SESSION['accept_order'] = 'Có lỗi xảy ra khi xóa đơn hàng';
    }
    redirect('/admin/order');
} 
else {
    redirect('/admin/order');
}
