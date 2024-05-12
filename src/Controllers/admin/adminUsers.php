<?php
    require_once  __DIR__ . '/../../../vendor/autoload.php';
    authAdmin();

    use \App\User;

    global $PDO;
    $user = new User($PDO);
    $current_page = 'Manage Users';

    if (!empty($_GET['key'])) {
        $users = $user->searchByUserName(trim($_GET['key']));
    } else {
        $users = $user->all();
    }


    require_once __DIR__ . '/../../Views/header.php';
    require_once __DIR__ . '/../../Views/admin/m-user.php';
    require_once __DIR__ . '/../../Views/footer.php';

?>