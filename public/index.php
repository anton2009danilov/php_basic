<?php

$db = @mysqli_connect('localhost', 'root', '', 'shop') or die('Ошибка соединения с БД: ' . 
mysqli_connect_error());

include_once '../config/config.php';

// init_gallery_database($db);

// while($row = mysqli_fetch_assoc($result)) {
//     var_dump($row);
// }

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
        ],
        'catalog' => [
            'link' => './?page=catalog',
            'name' => 'Каталог',
        ],
        'gallery' => [
            'link' => './?page=gallery',
            'name' => 'Галерея',
        ],
        // 'api_catalog' => [
        //     'link' => './?page=api_catalog',
        //     'name' => 'api',
        // ],
    ]
);

switch ($page) {
    case 'index':
        $params = [
            'title' => 'Main',
            'nav' => print($nav)
        ];
        break;
    
    case 'catalog':

        // $catalog = mysqli_query($db, "SELECT * FROM `gallery` ORDER BY `views` DESC");

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
    
        load_new_img($db);

        $gallery = mysqli_query($db, "SELECT * FROM `gallery` ORDER BY `views` DESC");

        $params = [
            'title' => 'Галерея',
            'nav' => print($nav),
            'gallery' => $gallery,
        ];
        break;
    
    case 'card':
        
        $id = (int) $_GET['id'];
        load_new_img($db);

        $query = mysqli_query($db, "SELECT * FROM `gallery` WHERE `id` = $id");  
        $card = mysqli_fetch_assoc($query);
        upd_views($db, $card);

        $params = [
            'title' => '№' . $id,
            'id' => $id,
            'nav' => print($nav),
            'card' => $card,
        ];
        break;

    default:
        $params = [
            'title' => $page,
        ];
}


echo render($page, $params );

// _log($params);