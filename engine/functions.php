<?php

function prepareVariables ($page) {

    $allow = false;

    if (is_auth()) {
        $allow = true;
        $user = get_user();
    }

    if (isset($_POST['guest'])) {
        $allow = true;
        $user = get_user();
        $_SESSION['user'] = $user;
    }

    if ($_SESSION['user'] == 'guest') {
        $allow = true;
        $user = 'guest';
    }

    $params = [];
    $row = [];
    $nav = renderNav();
    // $auth = renderTemplate('auth');
    

    switch ($page) {
        case 'index':
            $params = [
                'title' => 'Main',
                'nav' => $nav,
                // 'auth' => $auth,
                'allow' => $allow,
                'user' => $user,
            ];
            break;
        
        case 'calculator1':
            
            $params = [
                'title' => 'calculator1',
                'nav' => $nav,
                // 'auth' => $auth,
                'allow' => $allow,
                'user' => $user,
                'result' => $_SESSION['result'],
                'operand1' => $_SESSION['operand1'],
                'operand2' => $_SESSION['operand2'],
                'operation' => $_SESSION['operation'],
            ];
            break;
        
        case 'calculator2':
            $params = [
                'title' => 'calculator2',
                'nav' => $nav,
                // 'auth' => $auth,
                'allow' => $allow,
                'user' => $user,
            ];
            break;
        
        case 'math':
            // die(var_dump($_POST));
            $val1 = (int) $_POST['operand1'];
            $val2 = (int) $_POST['operand2'];
            $operation = $_POST['operation'];

            switch($operation) {
                case "+":
                    $result = mathOperation($val1, $val2, 'add');
                    break;
                case "-":
                    $result = mathOperation($val1, $val2, 'dim');
                    break;
                case "*":
                    $result = mathOperation($val1, $val2, 'mult');
                    break;
                case "/":
                    $result = mathOperation($val1, $val2, 'div');
                    break;
            }

            $_SESSION['result'] = $result;
            $_SESSION['operand1'] = $val1;
            $_SESSION['operand2'] = $val2;
            $_SESSION['operation'] = $operation;

            header("Location: ../calculator1");
            // $response['result'] = $result;
            
            // echo json_encode($response);
            die();
            break;

        case 'math2':
            // die(var_dump($_POST));
            $val1 = (int) $_POST['operand1'];
            $val2 = (int) $_POST['operand2'];
            $operation = $_POST['operation'];

            switch($operation) {
                case "+":
                    $result = mathOperation($val1, $val2, 'add');
                    break;
                case "-":
                    $result = mathOperation($val1, $val2, 'dim');
                    break;
                case "*":
                    $result = mathOperation($val1, $val2, 'mult');
                    break;
                case "/":
                    $result = mathOperation($val1, $val2, 'div');
                    break;
            }

            
            $response['result'] = $result;
            
            echo json_encode($response);
            die();
            break;
        
        case 'catalog':
            $params = [
                'title' => 'Каталог',
                'nav' => $nav,
                // 'auth' => $auth,
                'allow' => $allow,
                'user' => $user,
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
        
        case 'add_to_basket':
            $id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            if (isset($_SESSION['id'])||isset($_SESSION['user'])){
                // add_to_basket($id);
                $response['result'] = add_to_basket($id);
                echo json_encode($response);
                die();
            } else {
                $response['error'] = 'Ошибка: для совершения покупок необходимо
                 войти на сайт';    
                echo json_encode($response);
                die();
            }
            // $response['result'] = 'ok';
            // $response['id'] = $id;
            // $response['SESSION_user'] = $_SESSION['user'];
            
            echo json_encode($response);

            die();
            break;
        
        case 'delete_from_basket':
            $id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            if (isset($_SESSION['id'])||isset($_SESSION['user'])){
                // add_to_basket($id);
                $response['result'] = delete_from_basket($id);
                echo json_encode($response);
                die();
            } else {
                $response['error'] = 'Ошибка: для совершения покупок необходимо
                 войти на сайт';    
                echo json_encode($response);
                die();
            }
            $response['result'] = 'ok';
            $response['id'] = $id;
            $response['SESSION_user'] = $_SESSION['user'];
            
            echo json_encode($response);

            die();
            break;

        case 'addlike':

            $id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            $update = executeQuery("UPDATE `gallery` SET `likes` = `likes` + 1 WHERE id = $id");
            $result = executeQuery("SELECT * FROM `gallery` WHERE id = $id");
            $card = mysqli_fetch_assoc($result);
            $likes = $card['likes'];
            $response['result'] = $likes;
            
            echo json_encode($response);
            die();
            break;
        
        case 'addfeedback':

            $id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            if (isset($_POST['ok'])) {
                $name = real_escape($_POST['name']);
                $feedback = real_escape($_POST['feedback']);
                $sql = "INSERT INTO `feedback` (`item_id`, `name`, `feedback`)
                        VALUES ('$id','{$name}', '{$feedback}')";
                $result = executeQuery($sql);
                
                // if(!$result){
                //     echo 'error insert feedback';
                // }
            }
            
            $message = explode("/", $_SERVER['REQUEST_URI'])[3];
            
            header("Location: ../card/$id/OK" );
            break;
        
        case 'deletefeedback':

            $card_id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            $feedback_id = (int)explode("/", $_SERVER['REQUEST_URI'])[3];
            $sql = "DELETE FROM `feedback` WHERE id = $feedback_id";
            $result = executeQuery($sql);

            header("Location: ../../card/$card_id/DELETE" );

            break;

        case 'editfeedback':
            
            $card_id = (int)explode("/", $_SERVER['REQUEST_URI'])[2];
            $feedback_id = (int)explode("/", $_SERVER['REQUEST_URI'])[3];
            $sql = "UPDATE `feedback` SET `feedback`= '{$_POST['feedback']}', `name` = '{$_POST['name']}'
            WHERE id = $feedback_id";
            $result = executeQuery($sql);
           
            header("Location: ../../card/$card_id/EDITED" );

            break;
        
        case 'gallery':
        
            load_new_img();
    
            $gallery = getGallery();
    
            $params = [
                'title' => 'Галерея',
                'nav' => $nav,
                // 'auth' => $auth,
                'allow' => $allow,
                'user' => $user,
                'gallery' => $gallery,
            ];
            break;
        
        case 'basket':
            $basket = getBasket();
            $params = [
                'title' => 'Корзина',
                'nav' => $nav,
                // 'auth' => $auth,
                'allow' => $allow,
                'user' => $user,
                'basket' => $basket,
            ];
            break;

        case 'card':
            
            $card_id = explode("/", $_SERVER['REQUEST_URI'])[2];
            $feedback_id = explode("/", $_SERVER['REQUEST_URI'])[4];
            $card = getCard($card_id);
            load_new_img();
            upd_views($card_id);

            //создать getFeedback()
            // $db = getDb();
            // $feedback = mysqli_query($db, "SELECT * FROM `feedback` WHERE `item_id` = $card_id");
            $feedback = executeQuery("SELECT * FROM `feedback` WHERE `item_id` = $card_id");
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
                        $action = 'editfeedback/' . $card['id'] . '/' . $feedback_id;
                        
                        $card_id = (int) explode("/", $_SERVER['REQUEST_URI'])[2];
                        $id = (int) explode("/", $_SERVER['REQUEST_URI'])[4];
                        $sql = "SELECT * FROM `feedback` WHERE id = $id";
                        $result = executeQuery($sql);
                        $row = mysqli_fetch_assoc($result);
                        
                        break;
                    case "EDITED":
                        $message = "Сообщение изменено";
                        break;
                    default:
                        $btn_text = 'Отправить';
                        $message = '';
                }
            }
    
            $params = [
                'title' => '№' . $card_id,
                'id' => $id,
                'nav' => $nav,
                // 'auth' => $auth,
                'allow' => $allow,
                'user' => $user,
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
            
            if(!move_uploaded_file($tmp_name, $path)){
                // $error ="Ошибка загрузки: неверно указано имя файла или директория загрузки";
                echo "Ошибка загрузки: неверно указано имя файла или директория загрузки";
            } else {
                    update_gallery_database($name);
                    create_thumbnail("../public/img/big/$name", "../public/img/small/$name", 150, 150);
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
        'nav' => $params['nav'],
        // 'auth' => $params['auth'],
        'allow' => $params['allow'],
        'user' => $params['user'],
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

function renderNav() {
    return renderMenu(
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
            'calculator1' => [
                'link' => '../../../calculator1',
                'name' => 'Калькулятор 1',
            ],
            'calculator2' => [
                'link' => '../../../calculator2',
                'name' => 'Калькулятор 2',
            ],
            'basket' => [
                'link' => '../../../basket',
                'name' => 'Корзина',
            ],
        ]
    );
    
}

function init_gallery_database() {
    // $db = getDb();
    $gallery = array_splice(scandir('./img/big'), 2);
    $path = './img/big';

    foreach ($gallery as $item) {

        $name = $item;
        
        $size = filesize('../public/img/big/' . $name);
        $file = file('../public/img/big/' . $name);

        $query = "INSERT INTO `gallery` (`size`, `name`) VALUES ({$size}, {$name})";

        executeQuery($query);

    }
}

function update_gallery_database($file_name) {
    
    $db =getDb();
    // $location = './img/big';
    $size = filesize('./img/big/' . $file_name);

    $query = "INSERT INTO `gallery` (`size`, `name`, `description`, `item_name`, `price`)
        VALUES (?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($db, $query);
    
    mysqli_stmt_bind_param($stmt, "sssss", $val1, $val2, $val3, $val4, $val5);
    
    $val1 = $size;
    $val2 = $file_name;
    $val3 = 'Новинка!' ;
    $val4 = '';
    $val5 = '300';
    
    mysqli_stmt_execute($stmt);

}

function upd_views($id) {
    $update = "UPDATE `gallery` SET `views` = `views` + 1 WHERE id = $id";
    executeQuery($update);
}