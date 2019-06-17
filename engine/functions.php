<?php

function render($page, array $params = []) {
    $content = renderTemplate(LAYOUTS_DIR . 'main', [
        'content'=>renderTemplate($page, $params),
        'title'=> $params['title']
    ]);
    return $content;
}

function renderTemplate($page, array $params = []) {
    ob_start();

    if (!is_null($params)) {
        extract($params);
        // foreach ($params as $key => $value) {
        //     $$key = $value;
        // }
    }
    
    $fileName = TEMPLATES_DIR . $page . ".php";
    
    if(file_exists($fileName)) {
        include $fileName;
    } else {
        Die("Страницы {$fileName} не существует");
    }

    return ob_get_clean();
}



// $arr2 = [
//     'Menu1' => [
//         'linkA1' => 'Страница А1',
//         'linkA2' => 'Страница А2',
//         'Menu2' => [
//                 'linkB1' => 'Страница B1',
//                 'linkB2' => 'Страница B2',
//                 'linkB3' => 'Страница B3',
//                 'linkB4' => 'Страница B4',
//         ],
//         'linkA3' => 'Страница А3',
//         'linkA4' => 'Страница А4',
//     ]
// ];

// $arr = [
//     'Menu1' => [
//         'linkA1' => 'Страница А1',
//         'linkA2' => 'Страница А2',
//     ]
// ];

function renderMenu($arr) {
    $menu = '<ul class="nav justify-content-center bg-secondary">';
    foreach ($arr as $link => $text) {
        if (is_array($text)){

            // $menu .= $link;
        }

        if (!is_array($text)) {
            $menu .= "
            <li class='nav-item'>
                <a class= 'nav-link active text-light' href = '$link'>{$text}</a>
            </li>
            ";
        } else {
            
           $menu .= renderMenu($arr[$link]);
        }

    }

    return $menu . '</ul>';
}

