<?php

function load_new_img($db) {
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
            $path = str_replace('engine', 'public', __DIR__) . '/img/big/' . $name;
            // var_dump($path);
            // die;

            if(!move_uploaded_file($tmp_name, $path)){
                    // $error ="Ошибка загрузки: неверно указано имя файла или директория загрузки";
                    echo "Ошибка загрузки: неверно указано имя файла или директория загрузки";
                } else {
                    update_gallery_database($db, $name);
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

function init_gallery_database($db) {
    $gallery = array_splice(scandir('./img/big'), 2);
    // $path = str_replace('\engine', '\public\\', __DIR__);
    $path = './img/big';

    foreach ($gallery as $item) {

        $name = $item;
        
        $location = $path . $name;
        // die($location);
        $size = filesize('../public/img/big/' . $name);
        $file = file('../public/img/big/' . $name);

        // $insert = mysqli_query($db, "INSERT INTO `gallery` (`location`, `size`, `name`)
        //     VALUES ($location, $size, $name)");


        $query = "INSERT INTO `gallery` (`location`, `size`, `name`)
            VALUES (?, ?, ?)";
        
        $stmt = mysqli_prepare($db, $query);

        mysqli_stmt_bind_param($stmt, "sss", $val1, $val2, $val3);

        $val1 = $location;
        $val2 = $size;
        $val3 = $name;

        mysqli_stmt_execute($stmt);

    }

}

function update_gallery_database($db, $file_name) {
    
    
    $location = './img/big';
    $size = filesize('../public/img/big/' . $file_name);

        // var_dump($location);
        // var_dump($name);
        // var_dump($size);

        // $insert = mysqli_query($db, "INSERT INTO `gallery` (`location`, `size`, `name`)
        //     VALUES ($location, $size, $name)");


        $query = "INSERT INTO `gallery` (`location`, `size`, `name`)
            VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db, $query);

        mysqli_stmt_bind_param($stmt, "sss", $val1, $val2, $val3);

        $val1 = $location;
        $val2 = $size;
        $val3 = $file_name;

        mysqli_stmt_execute($stmt);

}

function upd_views($db, $card) {
    $id = $card['id'];
    // echo $card['views'];

    $update = "UPDATE `gallery` SET `views` = `views` + 1 WHERE id = $id";
    $stmt = mysqli_prepare($db, $update);
    mysqli_stmt_execute($stmt);
    // $stmt = mysqli_prepare($db, $query);
}