<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'index';
}

$params = [];

switch ($page) {
    case 'index':
        $params = [
            'title' => 'Main',
            // 'content' => renderTemplate('about', ['name' => 'Мир'])
        ];
        break;
    case 'catalog':
        $params = [
            'title' => 'Каталог',
            'catalog' => ["Чай", "Печенье", "Крендель"]
        ];
        break;
    default:
        $params = [
            'title' => $page
        ];
}


echo render($page, $params );

function render($page, array $params = []) {
    $content = renderTemplate('./layouts/main', [
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
    
    $fileName = "./views/" . $page . ".php";
    
    if(file_exists($fileName)) {
        include $fileName;
    } else {
        Die("Страницы {$fileName} не существует");
    }

    return ob_get_clean();
}
