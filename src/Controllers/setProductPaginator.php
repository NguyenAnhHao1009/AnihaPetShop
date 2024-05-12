<?php


require_once '../vendor/autoload.php';
use App\Paginator;
use App\Product;
global $PDO;

$limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int)$_GET['limit'] :12;
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

$product_p = new Product($PDO);
$type = null;
$searchKey = null;

$current_page = 'Product';

if (isset($_GET['type']) && !empty($_GET['type'])) {
  
        $type = $_GET['type'] ?? -1;
        $type = $product_p->getCategoryIdByName($type);
        switch ($type){
            case 1: $current_page = 'Dog'; break;
            case 2: $current_page = 'Cat'; break;
            case 3: $current_page = 'Mouse'; break;
            case 4: $current_page = 'Food'; break;
            case 5: $current_page = 'Accessory'; break;
            case 6: $current_page = 'Rabbit'; break;
            default: $current_page = 'Product'; break;
        }

        $number_of_products = $product_p->countNumberOfProductsByType($type);
   
} else if (isset($_GET['search_key'])) {
    $current_page = 'Search Product';
    $searchKey = $_GET['search_key'];
    $number_of_products = $product_p->countNumberOfProductsBySearchKey($searchKey);
}else{
    $number_of_products = $product_p->countNumberOfProducts();
}

$paginator = new Paginator(
    recordsPerPage: $limit,
    totalRecords: $number_of_products,
    currentPage: $page,
);
$products_p = $product_p->paginate($paginator->recordOffset, $paginator->recordsPerPage, $type, $searchKey);
$pages = $paginator->getPages(length: 3);

$products_care = $product_p->getListProductsRandomByNumber(6);

require_once __DIR__ . '/../Views/header.php';
require_once __DIR__ . '/../Views/product.php';
require_once __DIR__ . '/../Views/footer.php';
