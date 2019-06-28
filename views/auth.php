<?php
    $allow = false;

    if (is_auth()) {
        $allow = true;
        $user = get_user();
    }
    if (isset($_POST['guest'])) {
        $allow = true;
        $user = get_user();
        $_SESSION['user'] = $user;
    }
    
    if ($_SESSION['user'] == 'guest') {
        $allow = true;
    }


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
?>
<div class="auth">
    <?if(!$allow):?>
        <h3>Авторизация</h3>
        <form method="post" action="/">
            <input type="text" name="login" placeholder="Логин">
            Save? <input type="checkbox" name="save">
            <input type="password" name="pass" placeholder="Пароль">
            <input type="submit" name="send">
        </form>
        <br>
        
        <form method="post" action="/">
            <input type="submit" name="guest" value="Войти как Гость">
        </form>
        
        <?if($auth_error):?>
            <p>Ошибка авторизации</p>
        <?endif?>
    <?else:?>
        <h3>Добро пожаловать, <?=$user?>! <a href="?logout">[Выход]</a></h3>
    <?endif;?>
</div>