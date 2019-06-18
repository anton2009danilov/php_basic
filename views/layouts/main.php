<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-image: url(./img/texture1.png);
            color: #ff8989;
        }

        img {
            padding: 1px;
            margin: 5px;
            border: 1px solid pink;
        }

        .upload {
            color: #ff8989;
        }

        #new_img {
            /* width: 0.1px;
            height: 0.1px; */
            /* opacity: 0; */
            /* overflow: hidden; */
            /* position: absolute; */
            /* z-index: -1; */
        }

        a img {
            transition: 1s;
        }
        a img:hover {
            filter: brightness(1.1);
            transform: scale(1.1);
            transition-duration: .3s;
        }

        .upload_btn {
            color: #ff8989;
            border: none;
            background: none;
        }

        .upload_btn:hover {
            color: #ff5959;
        }
        
    </style>
    <title><?=$title?></title>
</head>
<body>
<?=$error?>
<?=$nav?>
<!-- <ul class="nav justify-content-center bg-secondary">
  <li class="nav-item">
    <a class="nav-link active text-light" href="/">Главная</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-light" href="/?page=catalog">Каталог</a>
  </li>
</ul> -->

<div class="container">
    <?=$content?>
</div>

</body>
</html>