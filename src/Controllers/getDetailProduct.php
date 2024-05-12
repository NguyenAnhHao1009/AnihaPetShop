<?php


require_once '../vendor/autoload.php';

use App\Product;

global $PDO;
$product = new Product($PDO);

$current_page = 'Detail Product';

$product_id = $_GET['id'];
if ($product->find($product_id)) {
    $number_of_products = 6;
    $products_related = $product->getListProductsRelated($product_id, $number_of_products);
} else {
    $no_product_id = 'Không tìm thấy sản phẩm phù hợp';
    $products_random = $product->getListProductsRandomByNumber(12);
}
require_once __DIR__ . '/../Views/header.php';
require_once __DIR__ . '/../Views/detail_product.php';
require_once __DIR__ . '/../Views/footer.php';
?>