<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        body {
            background-image: url(/img/texture1.png);
            color: #ff8989;
        }

        img {
            padding: 1px;
            margin: 2px;
            border: 1px solid pink;
        }

        .upload {
            color: #ff8989;
        }

        .upload_btn {
            color: #ff8989;
            border: none;
            background: none;
        }

        .upload_btn:hover {
            color: #ff5959;
        }

        .card {
            width: 160px;
            /* width: 200px; */
            margin: 10px 2px;
            transition: 1s;
        }

        .card:hover {
            filter: brightness(1.1);
            transform: scale(1.1);
            transition-duration: .3s;
        }

        .card__description {
            /* height: 80px; */
        }

        .wrapper {
            margin-top: 10px;
        }
        .auth{
            border-bottom: solid 1px pink;
            margin: 20px;
            padding: 20px;
        }

    </style>
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


    
    <?=$content?>
</div>

</body>

</html>