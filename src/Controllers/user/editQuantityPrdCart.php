<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
    authUser();
    use \App\Product;
    use \App\Order;

    global $PDO;
    $order = new Order($PDO);
    $product = new Product($PDO);

if (isset($_POST)) {
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $old_quantity = $_POST['old_quantity'];
    $new_quantity = $_POST['new_quantity'];

    $product_info = $product->getProductInfoById($product_id);
    $stock_quantity = $product_info['stock_quantity'];
    $product_name = html_escape($product_info['product_name']);

    if ($new_quantity === $old_quantity) {
        $_SESSION['edit_quantity_status'] = "<h5 class='text-center text-danger'>Số lượng sản phẩm trong giỏ hàng không thay đổi</h5>";
    } else
    if ($new_quantity <= 0) {
        $_SESSION['edit_quantity_status'] = "<h5 class='text-center text-danger'>Số lượng sản phẩm không hợp lệ</h5>";
    } else {
        $change_number_prd = $new_quantity - $old_quantity;
        if ($change_number_prd > 0) {
            if ($change_number_prd > $stock_quantity) {
                if ($stock_quantity == 0) {
                    $_SESSION['edit_quantity_status'] = "<h5 class='text-center text-danger'>Số lượng sản phẩm trong kho đã hết</h5>";
                } else {
                    $_SESSION['edit_quantity_status'] = '<h5 class="text-center text-danger">Rất tiếc số lượng sản phẩm "' . $product_name . '" chỉ còn ' . $stock_quantity . "</h5>";
                }
            } else {
                $update_odd = $order->updateQuantityInOrderDetails($order_id, $product_id, $new_quantity);
                $update_prd = $product->removeNumberOfProduct($product_id, $change_number_prd);
                if ($update_odd && $update_prd) {
                    $_SESSION['edit_quantity_status'] = "<h5 class='text-center text-success'>Cập nhật sản phẩm trong giỏ hàng thành công</h5>";
                } else {
                    $_SESSION['edit_quantity_status'] = "<h5 class='text-center text-danger'>Cập nhật sản phẩm trong giỏ hàng thất bại</h5>";
                }
            }
        } else
        if ($change_number_prd < 0) {
            $change_number_prd = (-1) * $change_number_prd;
            $update_odd = $order->updateQuantityInOrderDetails($order_id, $product_id, $new_quantity);
            $update_prd = $product->addNumberOfProduct($product_id, $change_number_prd);
            if ($update_odd && $update_prd) {
                $_SESSION['edit_quantity_status'] = "<h5 class='text-center text-success'>Cập nhật sản phẩm trong giỏ hàng thành công</h5>";
            } else {
                $_SESSION['edit_quantity_status'] = "<h5 class='text-center text-danger'>Cập nhật sản phẩm trong giỏ hàng thất bại</h5>";
            }
        }
    }
}
redirect('/user/cart');

