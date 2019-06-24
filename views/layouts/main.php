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
            margin: 2px;
            transition: 1s;
        }

        .card:hover {
            filter: brightness(1.1);
            transform: scale(1.1);
            transition-duration: .3s;
        }

        .description {

            margin: ;
        }

    </style>
    <title><?=$title?></title>
</head>
<body>
<?=$error?>
<? echo $nav?>


<div class="container">
    <?=$content?>
</div>

</body>

</html>