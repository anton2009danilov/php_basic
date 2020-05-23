<?php
session_start();
include_once '../config/config.php';

// init_gallery_database();
// var_dump($_POST);

if (isset($_GET['logout'])) {
    setcookie('hash');
    session_destroy();
    header("Location: /");
}

if (isset($_POST['send'])) {
    
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    
    if (!auth($login, $pass)) {
        $auth_error = true;
        // die('Неверный логин или пароль');
        
    } else {
        if (isset($_POST['save'])) {
            $hash = uniqid(rand(), true);
            // $id = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_SESSION['id'])));
            $id = real_escape($_SESSION['id']);
            $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `id` = '{$id}'";
            executeQuery($sql);
            setcookie("hash", $hash, time() +36000);
        }
        
        $allow = true;
        $user = get_user();
    }
}


$url_array = explode("/", $_SERVER['REQUEST_URI']);

if (!$url_array[1] == '') {
    $page = $url_array[1];
} else {
    $page = 'catalog';
}
echo render($page, prepareVariables($page));

// _log($params);