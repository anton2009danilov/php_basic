<?php

function prepareVariables ($page) {

    $params = [];
    $row = [];

    $nav = renderMenu(
        [
            'index' => [
                'link' => '../../..',
                'name' => 'Главная',
            ],
            'catalog' => [
                'link' => '../../../catalog',
                'name' => 'Каталог',
            ],
            'gallery' => [
                'link' => '../../../gallery',
                'name' => 'Галерея',
            ],
            'api_catalog' => [
                'link' => '../../../api_catalog',
                'name' => 'api',
            ],
            'addlike' => [
                'link' => '../../../addlike/1',
                'name' => 'addlike_item1',
            ],
        ]
    );

    switch ($page) {
        case 'index':
            $params = [
                'title' => 'Main',
                'nav' => $nav
            ];
            break;
        
        case 'catalog':
            $params = [
                'title' => 'Каталог',
                'nav' => $nav,
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

        case 'addlike':

            $id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            $db = getDb();
            $update = mysqli_query($db, "UPDATE `gallery` SET `likes` = `likes` + 1 WHERE id = $id");
            $result = mysqli_query($db, "SELECT * FROM `gallery` WHERE id = $id");
            $card = mysqli_fetch_assoc($result);
            $likes = $card['likes'];
            $response['result'] = $likes;
            
            echo json_encode($response);
            die();
            break;
        
        case 'addfeedback':

            $id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            $db = getDb();
            if (isset($_POST['ok'])) {
                $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['name'])));
                $feedback = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback'])));
                $sql = "INSERT INTO `feedback` (`item_id`, `name`, `feedback`)
                        VALUES ('$id','{$name}', '{$feedback}')";
                $result = executeQuery($sql);
                
                // if(!$result){
                //     echo 'error insert feedback';
                // }
                // die(var_dump($result));
            }
            
            $message = explode("/", $_SERVER['REQUEST_URI'])[3];
            
            header("Location: ../card/$id/OK" );
            // $result = mysqli_query($db, "SELECT * FROM `feedback` WHERE 1");

            // die();
            break;
        
        case 'deletefeedback':

            $card_id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            $feedback_id = (int)explode("/", $_SERVER['REQUEST_URI'])[3];
            $db = getDb();
            
            $sql = "DELETE FROM `feedback` WHERE id = $feedback_id";
            $result = executeQuery($sql);

            $result = mysqli_query($db, "SELECT * FROM `feedback` WHERE 1");

            header("Location: ../../card/$card_id/DELETE" );
            // die();
            break;

        case 'editfeedback':
            // die(var_dump($_POST));
            
            $card_id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            $feedback_id = (int)explode("/", $_SERVER['REQUEST_URI'])[3];
            $db = getDb();
            
            // var_dump('edit');
            $sql = "UPDATE `feedback` SET `feedback`= '{$_POST['feedback']}', `name` = '{$_POST['name']}'
            WHERE id = $feedback_id";
            // die(var_dump($sql));
            $result = executeQuery($sql);
            
            // $result = mysqli_query($db, "SELECT * FROM `feedback` WHERE 1");

            header("Location: ../../card/$card_id/EDITED" );
            // die();
            break;
        
        case 'gallery':
        
            load_new_img();
    
            // $gallery = mysqli_query($db, "SELECT * FROM `gallery` ORDER BY `views` DESC");
            $gallery = getGallery();
    
            $params = [
                'title' => 'Галерея',
                'nav' => $nav,
                'gallery' => $gallery,
            ];
            break;
        
        case 'card':
            
            $card_id = explode("/", $_SERVER['REQUEST_URI'])[2];
            $feedback_id = explode("/", $_SERVER['REQUEST_URI'])[4];
            $card = getCard($card_id);
            load_new_img();
            upd_views($card_id);

            //создать getFeedback()
            $db = getDb();
            $feedback = mysqli_query($db, "SELECT * FROM `feedback` WHERE `item_id` = $card_id");
            ///
            $str = explode("/", $_SERVER['REQUEST_URI'])[3];
            $btn_text = 'Отправить';
            $action = 'addfeedback/' . $card_id;

            if ($str) {
                switch ($str) {
                    case "OK":
                        $message = "Сообщение добавлено";
                        break;
                    case "DELETE":
                        $message = "Сообщение удалено";
                        break;
                    case "EDIT":
                        $btn_text = 'Править';
                        var_dump($id);
                        $action = 'editfeedback/' . $card['id'] . '/' . $feedback_id;
                        
                        $card_id = (int) explode("/", $_SERVER['REQUEST_URI'])[2];
                        $id = (int) explode("/", $_SERVER['REQUEST_URI'])[4];
                        // die(var_dump($id));
                        // $id = (int) explode("/", $_SERVER['REQUEST_URI'])[4];
                        $sql = "SELECT * FROM `feedback` WHERE id = $id";
                        $result = mysqli_query($db, $sql);
                        $row = mysqli_fetch_assoc($result);
                        
                        break;
                    case "EDITED":
                        $message = "Сообщение изменено";
                        break;
                    default:
                        $btn_text = 'Отправить';
                        $message = '';
                        // var_dump($message);
                }
            }
    
            $params = [
                'title' => '№' . $id,
                'id' => $id,
                'nav' => $nav,
                'card' => $card,
                'feedback' => $feedback,
                'message' => $message,
                'row' => $row,
                'btn_text' => $btn_text,
                'action' => $action
            ];
            break;
    
        default:
            $params = [
                'title' => $page,
            ];
        }
    return $params;
}

function getGallery() {
    $sql = "SELECT * FROM `gallery` ORDER BY `views` DESC";
    $gallery = getAssocResult($sql);
    return $gallery;
}

function getCard($id) {
    $sql = "SELECT * FROM `gallery` WHERE `id` = $id";
    $card = getAssocResult($sql)[0];
    $result = [];
    if (isset($card)){
        $result = $card;
    }
    return $result;
}

function load_new_img() {
    $db = getDb();
    
    if($_POST['load']) {
                 
        $new_img = $_FILES['new_img'];
        $type = $new_img['type'];
        $name = $new_img['name'];
        $tmp_name = $new_img['tmp_name'];

        if($size > 120000) {
            // header("Location: /gallery");    
            echo "Ошибка загрузки: превышен максимальный размер файла";
        } 

        else if ($type !== 'image/jpeg' && $type !=='image/png' && $type !== 'image/gif') {
            // $error = "Ошибка загрузки: допускается только загрузка файлов формата jpeg, png, gif";
            echo "Ошибка загрузки: допускается только загрузка файлов формата jpeg, png, gif";
        }
        
        else {
            $path = str_replace('engine', 'public', __DIR__) . '/img/big/' . $name;
            die(var_dump($path));
            // die;

            if(!move_uploaded_file($tmp_name, $path)){
                    // $error ="Ошибка загрузки: неверно указано имя файла или директория загрузки";
                    echo "Ошибка загрузки: неверно указано имя файла или директория загрузки";
                } else {
                    // die(var_dump($name));
                    update_gallery_database($name);
                    create_thumbnail("../public/img/big/$name", "../public/img/small/$name", 150, 150);
                    // header("Location: /?page=gallery");
                    header("Location: /gallery");
                    die();
                }
        }
    }
}

function render($page, array $params = []) {
    $content = renderTemplate(LAYOUTS_DIR . 'main', [
        'content'=>renderTemplate($page, $params),
        'title'=> $params['title'],
        'nav' => $params['nav']
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

function init_gallery_database() {
    $db = getDb();
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

function update_gallery_database($file_name) {
    
    $db =getDb();
    $location = './img/big';
    $size = filesize('./img/big/' . $file_name);


    $query = "INSERT INTO `gallery` (`location`, `size`, `name`)
        VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);

    mysqli_stmt_bind_param($stmt, "sss", $val1, $val2, $val3);

    $val1 = $location;
    $val2 = $size;
    $val3 = $file_name;

    mysqli_stmt_execute($stmt);

}

function upd_views($id) {
    $db = getDb();
    $update = "UPDATE `gallery` SET `views` = `views` + 1 WHERE id = $id";
    $stmt = mysqli_prepare($db, $update);
    mysqli_stmt_execute($stmt);
    // $stmt = mysqli_prepare($db, $query);
}