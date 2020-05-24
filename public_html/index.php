<?php
session_start();
include_once '../config/config.php';

//include_once '../engine/resize.php';
//create_thumbnail("./img/big/dragon.jpg", "./img/small/dragon.jpg", 110, 150);
//var_dump(filesize("./img/big/dragon.jpg"));die;
//add_new_item(filesize("./img/big/dragon.jpg"),"dragon.jpg",
//    "Сказочный дракончик. Любит летать и есть сладкое.", "Дракончик", 300);



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