<?php
    require_once __DIR__ . '/../../../vendor/autoload.php';
    authAdmin();
    use \App\Product;
    global $PDO;
    $product = new Product($PDO);
    $current_page = 'Manage Products';


    use App\Paginator;

    $limit = (isset($_GET['limit']) && is_numeric($_GET['limit'])) ? (int)$_GET['limit'] :12;
    $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

    $product_p = new Product($PDO);
    $type = null;
    $searchKey = null;

    if (isset($_GET['key'])) {
        $searchKey = $_GET['key'];
        $number_of_products = $product_p->countNumberOfProductsBySearchKey($searchKey);
    } else {
        $number_of_products = $product->countNumberOfProducts();
    }

    $paginator = new Paginator(
        recordsPerPage: $limit,
        totalRecords: $number_of_products,
        currentPage: $page,
    );

    $products = $product->paginate($paginator->recordOffset, $paginator->recordsPerPage, $type, $searchKey);
    $pages = $paginator->getPages(length: 3);



    require_once __DIR__ . '/../../Views/header.php';
    require_once __DIR__ . '/../../Views/admin/m-product.php';
    require_once __DIR__ . '/../../Views/footer.php';


?>