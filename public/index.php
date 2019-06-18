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
// $nav = renderMenu(
//     [
//         'Menu' => [
//         'index' => [
//             './' => 'Главная'
//         ],
//         'catalog' => [
//             './?page=catalog' => 'Каталог'
//         ],
//         'gallery' => [
//             './?page=gallery' => 'Галерея'],
//         'api_catalog' => [
//             './?page=api_catalog' => 'api'],
//         ]
//     ]
// );
$nav = renderMenu(
    [
        'index' => [
            'link' => './',
            'name' => 'Главная',
            // './' => 'Главная'
        ],
        'catalog' => [
            'link' => './?page=catalog',
            'name' => 'Каталог',
            // './?page=catalog' => 'Каталог'
        ],
        'gallery' => [
            'link' => './?page=gallery',
            'name' => 'Галерея',
            // './?page=gallery' => 'Галерея'
        ],
        'api_catalog' => [
            'link' => './?page=api_catalog',
            'name' => 'api',
            // './?page=api_catalog' => 'api'
        ],
    ]
);


// var_dump($nav);
// die();


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
    
        load_new_img();

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
