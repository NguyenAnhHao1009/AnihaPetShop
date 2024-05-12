<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
    authUser();

    use \App\User;
    use \App\Product;
    use \App\Order;

    global $PDO;
    $order = new Order($PDO);

    $current_page = 'Cart';
$user_id = $_SESSION['user_id'] ?? '';

$cart_info = $order->getCartInfoByUserId($user_id);

require_once __DIR__ . '/../../Views/header.php';
require_once __DIR__ . '/../../Views/user/u-cart.php';
require_once __DIR__ . '/../../Views/footer.php';
