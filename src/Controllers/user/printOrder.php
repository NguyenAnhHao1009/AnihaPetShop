<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
authUser();
use \App\Order;
use \App\User;
global $PDO;
$order = new Order($PDO);
$user = new User($PDO);
$mpdf = new \Mpdf\Mpdf();



if($_GET['id']<=0 || empty($_GET['order_id'])){
    echo($_GET['id']);
}

$order_id = $_GET['id'];


$order_print = $order->getInfoOrderToPrint($order_id);

$owner = $user->getInfoById($_SESSION['user_id']);

if($order_print == null ){
    redirect('/');
}


$order_date = strtotime($order_print[0]['order_date']);

$order_date = date('H:m:s d-m-Y', $order_date);

$pathToView = __DIR__ . '/../../Views/user/u-print-order.php';
ob_start();
require_once $pathToView;
$htmlContent = ob_get_clean();
$mpdf->WriteHTML($htmlContent);


$mpdf->WriteHTML('');
$mpdf->Output();
