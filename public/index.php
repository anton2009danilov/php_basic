<?php

include_once '../config/config.php';


// define('TEMPLATES_DIR', __DIR__ . '/views/');
// define('LAYOUTS_DIR', './layouts/');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

$params = [];
$nav = renderMenu(
    [
        'Menu' => [
        'index' => [
            './' => 'Главная'
        ],
        'catalog' => [
            './?&page=catalog' => 'Каталог'
        ],
        'gallery' => [
            './?&page=gallery' => 'Галерея'],
        'api_catalog' => [
            './?&page=api_catalog' => 'api'],
        ]
    ]
);

// var_dump($nav);



switch ($page) {
    case 'index':
        $params = [
            'title' => 'Main',
            'nav' => print($nav)
        ];
        break;
    
    case 'catalog':

        $params = [
            'title' => 'Каталог',
            'nav' => print($nav),
            'catalog' => ["Мишка", "Пони", "Крокодил"],
        ];
        break;

    case 'api_catalog':

        $params = [
            'title' => 'api',
            'catalog' => ["Мишка", "Пони", "Крокодил"]
        ];

        echo json_encode($params, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        die();
        break;
    
    case 'gallery':
        
        if($_POST['load']) {
            // var_dump($_POST);
            // var_dump($_FILES);
            // exit;
            extract($_FILES);
            extract($new_img);
            if($size > 100000) {
                // header("Location: /?page=gallery");    
                echo "Ошибка загрузки: превышен максимальный размер файла";
            } 

            else if ($type !== 'image/jpeg' && $type !=='image/png' && $type !== 'image/gif') {
                echo "Ошибка загрузки: допускается только загрузка файлов формата jpeg, png, gif";
            }
            
            else {
                $path = __DIR__ . '/img/big/' . $name;

                if(!move_uploaded_file($tmp_name, $path)){
                    // trigger_error("Ошибка загрузки", E_USER_ERROR);
                    echo "Ошибка загрузки: неверно указано имя файла или директория загрузки";
                } else {
                    create_thumbnail("./img/big/$name", "./img/small/$name", 150, 150);
                    header("Location: /?page=gallery");
                }

            }

            
        }

        $images = scandir('./img/big');
        unset($images[0], $images[1]);

        $params = [
            'title' => 'Галерея',
            'nav' => print($nav),
            'gallery' => $images,
        ];
    break;

    default:
        $params = [
            'title' => $page,
        ];
}


echo render($page, $params );

// _log($params);

// $file = create_thumbnail('./img/big/item1.jpg', './img/small/item1.jpg', 150, 150);
// $file = create_thumbnail('./img/big/item2.jpg', './img/small/item2.jpg', 150, 150);
// $file = create_thumbnail('./img/big/item3.jpg', './img/small/item3.jpg', 150, 150);
