<?php
require_once  '../vendor/autoload.php';
use App\PDOFactory;

function getMessage(){
    echo 'Toi la anh hao ne';
}


global $PDO;
try {
    // echo ('xinc hao toi la PDO');
    $PDO = (new PDOFactory())->create([
        'dbhost' => 'localhost',
        'dbname' => 'aniha_store_database',
        'dbuser' => 'root',
        'dbpass' => 'Z!L9@Wfd'
    ]);
} catch (Exception $ex) {
    echo 'Không thể kết nối đến MySQL, kiểm tra lại username/password đến MySQL . <br>';
    exit("<pre>{$ex}</pre>");
}
?>