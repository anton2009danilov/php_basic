<?php
    include "../engine/auth.php";
    // if(!$allow) die("Неверный ключ!");


    // setcookie('login', 'admin', time() + 3600, '/');
?>

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
        Войти как Гость
        <input type="submit" name="guest">
    </form>
    
    <?if($auth_error):?>
        <p>Ошибка авторизации</p>
    <?endif?>
    
    <?if($user):?>
        <br>
        <h3>Добро пожаловать, <?=$user?>!</a></h3>
        <hr>
    <?else:?>
        <br>
        <h3>Добро пожаловать!</a></h3>
        <hr>
    <?endif;?>

<?else:?>

    <h3>Добро пожаловать, <?=$user?>! <a href="?logout">[Выход]</a></h3>
    <hr>
<?endif;?>