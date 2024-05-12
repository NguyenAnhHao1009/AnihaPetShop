<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
authAdmin();
use \App\Order;
global $PDO;
$order = new Order($PDO);

$current_page = 'Manage Orders';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $orders = $order->searchOrderById(trim($_POST['order_id']));
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['status'])){
        if($_GET['status'] === 'wait'){
            $orders = $order->all(0);
        }else if($_GET['status'] === 'finish'){
            $orders = $order->all(1);
        }
        else if($_GET['status'] === 'cancel'){
            $orders = $order->all(-2);
        }else{
            
            $orders = $order->all();
        }
    }else{
        $orders = $order->all();
    }
}

require_once __DIR__ . '/../../Views/header.php';
require_once __DIR__ . '/../../Views/admin/m-order.php';
require_once __DIR__ . '/../../Views/footer.php';


?>