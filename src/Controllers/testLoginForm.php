
<?php

require_once '../vendor/autoload.php';

use App\User;

global $PDO;
$user = new User($PDO);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $check_login_form = checkLoginForm($_POST);

    if (empty($check_login_form)) {
        $result = $user->find($email, $password);
        if ($result) {
            $isAd_id = $user->getAdminId($email, $password);

            print_r($isAd_id);

            if ($isAd_id['is_admin'] == 1) {
                $_SESSION['admin_id'] = $isAd_id['user_id'];
                redirect('/admin');
            }
            if ($isAd_id['is_admin'] == 0) {
                $_SESSION['user_id'] = $isAd_id['user_id'];
                redirect('/');
            }
        } else {
            $login_fail =  '<i class="fa-solid fa-user-xmark"></i> Thông tin đăng nhập sai!';
        }
    }
    require_once __DIR__ .'/../Views/login.php';
}
