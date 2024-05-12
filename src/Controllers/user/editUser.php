
<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
authUser();
use \App\User;
global $PDO;
$user = new User($PDO);
$current_page = 'Edit User';

if($_SERVER['REQUEST_METHOD'] == 'POST'):
if (isset($_POST['edit-user'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];


    $current_email = $user->getInfoById($user_id);

    if ($user->isExistEmailExceptThis($email, $user_id)) {
        $_SESSION['edit_user_status'] = 'Email đã tồn tại vui lòng sử dụng email khác';
        redirect('/user/edit');
    } else if ($user->isExistPhoneNumberExceptThis($phone_number, $user_id)) {
        $_SESSION['edit_user_status'] = 'Số điện thoại đã tồn tại vui lòng sử dụng số điện thoại khác';
        redirect('/user/edit');
    }

    $data = array();
    $data['user_id'] = $user_id;
    $data['user_name'] = $user_name;
    $data['email'] = $email;
    $data['phone_number'] = $phone_number;
    $data['address'] = $address;
    $data['password'] = '';

    if (!empty($_POST['password']) || !empty($_POST['new_password']) || !empty($_POST['re_new_password'])) {
        if (empty($_POST['password']) || empty($_POST['new_password']) || empty($_POST['re_new_password'])) {
            $_SESSION['edit_user_status'] = 'Thông tin mật khẩu bị thiếu';
            redirect('/user/edit');
        } else {
            if ($_POST['new_password'] != $_POST['re_new_password']) {
                $_SESSION['edit_user_status'] = 'Mật khẩu xác nhận không khớp';
                redirect('/user/edit');
            } else {
                $data['password'] = $_POST['new_password'];
                if ($user->checkPass($_POST['password'], $_SESSION['user_id'])) {
                    if ($user->update($user_id, $data)) {
                        $_SESSION['edit_user_status'] = 'Cập nhật thành công';
                    } else {
                        $_SESSION['edit_user_status'] = 'Cập nhật không thành công';
                    }
                } else {
                    $_SESSION['edit_user_status'] = 'Cập nhật không thành công, có vấn đề về mật khẩu';
                }
            }
        }
    } else {
        if ($user->update($user_id, $data)) {
            $_SESSION['edit_user_status'] = 'Cập nhật thông tin thành công';
        } else {
            $_SESSION['edit_user_status'] = 'Cập nhật không thành công';
        }
    }
}
endif;

$user_id = $_SESSION['user_id'] ?? -1;
$user_info = $user->getInfoById($user_id);
$user_name = html_escape($user_info['user_name']);
$email = html_escape($user_info['email']);
$phone_number = html_escape($user_info['phone_number']);
$address = html_escape($user_info['address']);

require_once __DIR__ . '/../../Views/header.php';
require_once __DIR__ . '/../../Views/user/u-edit.php';
require_once __DIR__ . '/../../Views/footer.php';

?>