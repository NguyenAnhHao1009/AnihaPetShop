<?php
    require_once __DIR__ . '/../../../vendor/autoload.php';
    authAdmin();
    use \App\Order;
    global $PDO;
    $order = new Order($PDO);
 
    $order_id = $_GET['id'];

    if($order->acceptOrderById($order_id)){
        // $_SESSION['accept_order'] = "Bạn vừa duyệt đơn hàng $order_id thành công";
        redirect('/admin/order_detail?id='.$order_id);
    }else{
        $_SESSION['accept_order'] = "Duyệt đơn hàng $order_id thất bại";
        redirect('/');
    };

    

?>