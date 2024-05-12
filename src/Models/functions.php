<?php

function redirect(string $location): void
{
    header("Location: $location", true, 302);
    exit;
}

function html_escape(?string $text): string
{
    if(empty($text) || !isset($text)){
        return '';
    } 
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8', false);
}


function checkSignUpForm($data, $PDO): array
{

    $user = new App\User($PDO);
    $check_signup_form = [];

    $user_name = htmlspecialchars($data['user_name']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $re_password = htmlspecialchars($data['re_password']);
    $phone_number = htmlspecialchars($data['phone_number']);
    $address = htmlspecialchars($data['address']);
    $check = (isset($data['agree_term'])) ? 'checked' : 'no_checked';

    if (empty($user_name)) {
        $check_signup_form['user_name'] = 'Vui lòng nhập họ, tên';
    }
    if (empty($email)) {
        $check_signup_form['email'] = 'Vui lòng nhập email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check_signup_form['email'] = 'Email không đúng định dạng';
    } else if ($user->isExistEmail($email)) {
        $check_signup_form['email'] = 'Email đã được sử dụng';
    }
    if (empty($password)) {
        $check_signup_form['password'] = 'Vui lòng nhập mật khẩu';
    } else if (strlen($password) < 8) {
        $check_signup_form['password'] = 'Mật khẩu phải chứa từ 8 kí tự trở lên';
    } else if (
        !preg_match("#[0-9]+#", $password) ||
        !preg_match("#[a-zA-Z]+#", $password) ||
        !preg_match("#[\W]+#", $password)
    ) {
        $check_signup_form['password'] = 'Mật khẩu phải gồm chữ cái, số, và ký tự đặc biệt.';
    }
    if (empty($re_password)) {
        $check_signup_form['re_password'] = 'Vui lòng xác nhận mật khẩu';
    } else if ($password !== $re_password) {
        $check_signup_form['re_password'] = 'Mật khẩu chưa khớp';
    }
    if (empty($phone_number)) {
        $check_signup_form['phone_number'] = 'Vui lòng nhập số điện thoại';
    } else {
        if (!preg_match("/^[0-9]+$/", $phone_number)) {
            $check_signup_form['phone_number'] = 'Số điện thoại không đúng định dạng';
        } else if ($user->isExistPhoneNumber($phone_number)) {
            $check_signup_form['phone_number'] = 'Số điện thoại đã được sử dụng';
        }
    }
    if (empty($address)) {
        $check_signup_form['address'] = 'Vui lòng nhập địa chỉ';
    }
    if (empty($address)) {
        $check_signup_form['address'] = 'Vui lòng nhập địa chỉ';
    }

    if (empty($data['agree_term']) || $data['agree_term'] != 'on') {
        $check_signup_form['agree_term'] = 'Vui lòng chấp nhận điều khoảng sử dụng';
    }

    return $check_signup_form;
}

function checkLoginForm($data): array
{
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);

    $check_login_form = [];
    if (empty($email)) {
        $check_login_form['email'] = 'Vui lòng nhập email';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $check_login_form['email'] = 'Email không đúng định dạng';
        }
    };

    if (empty($password)) {
        $check_login_form['password'] = 'Vui lòng nhập mật khẩu';
    };
    return $check_login_form;
}

function saveImgToUploadsFolder($img_tmp_name, $img_name): bool
{
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($img_name);

    if (move_uploaded_file($img_tmp_name, $uploadFile)) {
        return true;
    }
    return false;
}

function removeImgFromUploadsFolder($img_name)
{
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($img_name);
    if (file_exists($uploadFile)) {
        unlink($uploadFile);
    }
}

function authAdmin(){
    if(!isset($_SESSION['admin_id']))
        redirect('/');
}

function authUser(){
    if(!isset($_SESSION['user_id']))
        redirect('/');
}
