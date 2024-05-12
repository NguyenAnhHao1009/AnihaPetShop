<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
authAdmin();
use \App\Order;
global $PDO;
$order = new Order($PDO);

$current_page = 'Order Detail';


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
       $odds = $order->getInfoOrderToPrint($_GET['id']);
    }else{
        redirect('/');
    }
}

require_once __DIR__ . '/../../Views/header.php';
require_once __DIR__ . '/../../Views/admin/m-order-detail.php';
require_once __DIR__ . '/../../Views/footer.php';


?>