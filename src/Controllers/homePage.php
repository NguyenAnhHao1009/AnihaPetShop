<?php

require_once '../vendor/autoload.php';
use App\Product;

global $PDO;
$product = new Product($PDO);

$num_of_prd_to_show = 12;
$products_random = $product->getListProductsRandomByNumber($num_of_prd_to_show);
require_once __DIR__ . '/../Views/index.php';