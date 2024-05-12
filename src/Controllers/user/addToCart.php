<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
    authUser();

    use \App\Product;
    use \App\Order;

    global $PDO;
    $order = new Order($PDO);
    $product = new Product($PDO);

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
    $product_id = $_POST['add_to_cart'];
    $user_id = $_SESSION['user_id'];
    $quantity = $_POST['quantity'] ?? 1;

    if ($order->addProductToCart($user_id, $product_id, $quantity) && $product->removeNumberOfProduct($product_id, $quantity)) {
        $_SESSION['add-to-cart-status'] = 'Thêm thành công ' . $quantity . ' sản phẩm vào giỏ hàng';
    } else {
        $_SESSION['add-to-cart-status'] = 'Thêm thất bại sản phẩm vào giỏ hàng';
    }
}

redirect('/user/cart');
