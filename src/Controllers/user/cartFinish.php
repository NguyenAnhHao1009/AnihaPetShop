<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
    authUser();

    use \App\User;
    use \App\Product;
    use \App\Order;

    global $PDO;
    $order = new Order($PDO);
    $current_page = 'Orders';
$cart_finish = $order->orderSubmittedFromUser($_SESSION['user_id']);

require_once __DIR__ . '/../../Views/header.php';
require_once __DIR__ . '/../../Views/user/u-cart-finish.php';
require_once __DIR__ . '/../../Views/footer.php';
