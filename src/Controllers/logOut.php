<?php
    if(isset($_SESSION['admin_id']) ||isset($_SESSION['user_id'])){
        session_destroy();
        $_SESSION = array();
        redirect('/');
        exit;
    }
    redirect('/');

?>