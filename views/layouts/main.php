<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="/img/logo.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title><?=$title?></title>
</head>
<body>
<?=$error?>
<? echo $nav?>

<div class="container wrapper">
    <!-- <? echo $auth?> -->
    <div class="auth">
        <?if(!$allow):?>
            <h3>Авторизация</h3>
            <form method="post" action="/">
                <input type="text" name="login" placeholder="Логин admin, user1, user2">
                Save? <input type="checkbox" name="save">
                <input type="password" name="pass" placeholder="Пароль 123">
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


    <div class="content">
        <?=$content?>
    </div>
</div>

</body>

</html>