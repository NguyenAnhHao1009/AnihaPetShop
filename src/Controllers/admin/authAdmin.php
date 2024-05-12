<?php
    require_once __DIR__ . '/../../../vendor/autoload.php';
    authAdmin();

    use \App\User;
    use \App\Product;
    use \App\Order;

    global $PDO;
    $user = new User($PDO);
    $product = new Product($PDO);
    $order = new Order($PDO);

    $current_page = 'DashBoard';

    $admin_info = $user->getInfoById($_SESSION['admin_id']);
    $num_products = $product->countNumberOfProducts();
    $num_users = $user->countNumberOfUsers();
    $num_orders = $order->countNumberOfOrders();
    $total_revenue = $order->getRevenue();

    require_once __DIR__ . '/../../Views/header.php';
    require_once __DIR__ . '/../../Views/admin/dashboard.php';
    require_once __DIR__ . '/../../Views/footer.php';

?>