<?php

function load_new_img() {
    if($_POST['load']) {
                 
        $new_img = $_FILES['new_img'];
        $type = $new_img['type'];
        $name = $new_img['name'];
        $tmp_name = $new_img['tmp_name'];
     
        if($size > 100000) {
            // header("Location: /?page=gallery");    
            echo "Ошибка загрузки: превышен максимальный размер файла";
        } 

        else if ($type !== 'image/jpeg' && $type !=='image/png' && $type !== 'image/gif') {
            // $error = "Ошибка загрузки: допускается только загрузка файлов формата jpeg, png, gif";
            echo "Ошибка загрузки: допускается только загрузка файлов формата jpeg, png, gif";
        }
        
        else {
            $path = __DIR__ . '/img/big/' . $name;

            if(!move_uploaded_file($tmp_name, $path)){
                    // $error ="Ошибка загрузки: неверно указано имя файла или директория загрузки";
                    echo "Ошибка загрузки: неверно указано имя файла или директория загрузки";
                } else {
                    create_thumbnail("./img/big/$name", "./img/small/$name", 150, 150);
                    header("Location: /?page=gallery");
                    die();
                }
        }
    }
}

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

function renderMenu($params) {
    
    return renderTemplate('menu', $params);

    }
