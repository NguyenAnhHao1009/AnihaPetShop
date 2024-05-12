
<?php

require_once '../vendor/autoload.php';

use App\User;

global $PDO;
$user = new User($PDO);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_name = htmlspecialchars($_POST['user_name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $re_password = htmlspecialchars($_POST['re_password']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $address = htmlspecialchars($_POST['address']);
    $check = (isset($_POST['agree_term'])) ? 'checked' : 'no_checked';
    
    $check_signup_form = checkSignUpForm($_POST, $PDO);
    if (empty($check_signup_form)) {
        $user->fill($_POST);
        if($user->add()){
            $_SESSION['signup_success_message'] = '<i class="fa-solid fa-user-check"></i> Register Success, Login now!';
            redirect('/login');
        };
    }
    require_once __DIR__ .'/../Views/signup.php' ;
}

?>