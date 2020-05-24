<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="/img/logo.png"/>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
<!--          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title><?= $title ?></title>
</head>
<body>
<div class="wrapper">
    <?= $error ?>
    <? echo $nav ?>

    <div class="container">

        <div class="auth">
            <? if (!$allow): ?>
                <h3>Авторизация</h3>
                <form method="post" action="/">
                    <input type="text" name="login" placeholder="Логин admin, user1, user2">
                    Save? <input type="checkbox" name="save">
                    <input type="password" name="pass" placeholder="Пароль 123">
                    <input type="submit" name="send">
                </form>
                <br>

<!--                <form method="post" action="/">-->
<!--                    <input type="submit" name="guest" value="Войти как Гость">-->
<!--                </form>-->

                <? if ($auth_error): ?>
                    <p>Ошибка авторизации</p>
                <? endif ?>
            <? else: ?>
                <h3>Добро пожаловать, <?= $user ?>! <a href="?logout">[Выход]</a></h3>
            <? endif; ?>
        </div>


        <div class="content">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <span class="text-muted">
            Copyright
<!--            <i class="fa fa-copyright" aria-hidden="true"></i>-->
            <i class="far fa-copyright"></i>
            BestFriends 2019-2020. Все друзья защищены</span>
    </div>
</footer>

</body>

</html>