<?php
session_start();

require_once '../vendor/autoload.php';
$router = new \Bramus\Router\Router();


$router->get('/', function () {
    $current_page = 'Home';
    require_once __DIR__ . '/../src/Controllers/homePage.php';
    
});

$router->get('/login', function () {
    require_once __DIR__ . '/../src/Views/login.php';
});

$router->post('/login', function(){
    require_once __DIR__ . '/../src/Controllers/testLoginForm.php';
});

$router->get('/signup', function () {
    require_once __DIR__ . '/../src/Views/signup.php';
});

$router->post('/signup', function () {
    require_once __DIR__ . '/../src/Controllers/testSignUpForm.php';
});

$router->get('/logout', function () {
    require_once __DIR__ . '/../src/Controllers/logOut.php';
});

$router->get('/term', function () {
    require_once __DIR__ . '/../src/Views/term.php';
});

$router->get('/about', function () {
    require_once __DIR__ . '/../src/Views/about.php';
});


$router->get('/transaction', function(){
    require_once __DIR__ . '/../src/Views/transaction.php';
});

$router->get('/contact', function(){
    $current_page = 'Contact';
    require_once __DIR__ . '/../src/Views/contact.php';
});

$router->get('/product', function () {
    require_once __DIR__ . '/../src/Controllers/setProductPaginator.php';

});

$router->get('/product_detail?', function () {
   
    require_once __DIR__ . '/../src/Controllers/getDetailProduct.php';
 
});

$router->get('/admin', function () {
    require_once __DIR__ . '/../src/Controllers/admin/authAdmin.php';
    
});

$router->get('/admin/user', function () {
    require_once __DIR__ . '/../src/Controllers/admin/adminUsers.php';
});

$router->get('/admin/product', function () {
    require_once __DIR__ . '/../src/Controllers/admin/adminProducts.php';
});

$router->all('/admin/product/edit', function () {
    require_once __DIR__ . '/../src/Controllers/admin/editProduct.php';
});

$router->all('/admin/product/create', function () {
    require_once __DIR__ . '/../src/Controllers/admin/createProduct.php';
});

$router->get('/admin/product/delete', function () {
    require_once __DIR__ . '/../src/Controllers/admin/deleteProduct.php';
});

$router->all('/admin/order', function () {
    require_once __DIR__ . '/../src/Controllers/admin/adminOrders.php';
});

$router->get('/admin/order_detail', function(){
    require_once __DIR__ . '/../src/Controllers/admin/order_detail.php';
});

$router->get('/admin/order/accept', function () {
    require_once __DIR__ . '/../src/Controllers/admin/acceptOrder.php';
});

$router->get('/admin/order/rm_order', function () {
    require_once __DIR__ . '/../src/Controllers/admin/removeOrder.php';
});

$router->all('/user/edit', function () {
    require_once __DIR__ . '/../src/Controllers/user/editUser.php';
});

$router->get('/user/cart', function () {
    require_once __DIR__ . '/../src/Controllers/user/cartUser.php';
});

$router->get('/user/cart/remove', function () {
    require_once __DIR__ . '/../src/Controllers/user/removeCart.php';
});

$router->get('/user/cart/finish', function () {
    require_once __DIR__ . '/../src/Controllers/user/cartFinish.php';
});

$router->post('/user/cart/edit', function () {
    require_once __DIR__ . '/../src/Controllers/user/editQuantityPrdCart.php';
});

$router->post('/user/cart/send', function () {
    require_once __DIR__ . '/../src/Controllers/user/sendCart.php';
});

$router->get('/user/cart/rm_order', function () {
    require_once __DIR__ . '/../src/Controllers/user/removeOrder.php';
});

$router->post('/add_to_cart', function () {
    require_once __DIR__ . '/../src/Controllers/user/addToCart.php';
});

$router->get('/user/cart/print', function () {
    require_once __DIR__ . '/../src/Controllers/user/printOrder.php';
});


$router->set404(function () {
    require_once __DIR__ . '/../src/Views/error.php';
});

$router->run(); 

?>