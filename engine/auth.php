<?php

    
    // $_COOKIE['id'] = '1';
    // var_dump(real_escape($_COOKIE['id']));

    $allow = false;

    if (is_auth()) {
        $allow = true;
        $user = get_user();
    }

    if(isset($_POST['guest']))
        $user = get_user();
    

    if (isset($_GET['logout'])) {
        setcookie('hash');
        session_destroy();
        header("Location: /");
    }

    if (isset($_POST['send'])) {
        
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        if (!auth($login, $pass)) {
            $auth_error = true;
            // die('Неверный логин или пароль');
            
        } else {
            if (isset($_POST['save'])) {
                $hash = uniqid(rand(), true);
                // $id = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_SESSION['id'])));
                $id = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_SESSION['id'])));
                $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `id` = '{$id}'";
                executeQuery($sql);
                setcookie("hash", $hash, time() +36000);
            }
            
            $allow = true;
            $user = get_user();
        }
    }

    function auth($login, $pass) {
        // getDb();
        $login = real_escape($login);
        $sql = "SELECT * FROM `users` WHERE `login` = '{$login}'";
        $result = executeQuery($sql);
        $row = mysqli_fetch_assoc($result);
        // die(var_dump($row));

        if (password_verify($pass, $row['pass'])) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $row['id'];
            return true;
        }
        return false;
    }

    function is_auth() {
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $sql = "SELECT * FROM `users` WHERE `hash` = '{$hash}'";
            $result = mysqli_fetch_assoc(executeQuery($sql));
            $user = $result['login'];
            $id = $result['id'];
            
            if(!empty($user)) {
                $_SESSION['login'] = $user;
                $_SESSION['id'] = $id;
            }
        }

        return isset($_SESSION['login']) ? true : false;
    }

    function get_user() {
        return is_auth() ? $_SESSION['login'] : 'guest';
    }




    // $pass = 123;

    // $hash = password_hash($pass, PASSWORD_DEFAULT);

    
    // $secret_key = $hash;
    // executeQuery();
    // $sql = "SELECT * FROM `users` WHERE `login` = 'admin'";
    // $result = mysqli_fetch_assoc(executeQuery($sql));
    // var_dump($result);
    // $db_hash = $result['pass'];

    // $secret_key = $db_hash;
    // var_dump(password_verify($pass, $hash));

    
    // is_auth();

    // $cookie_key = $_COOKIE['pass'];
    // $session_key = $_SESSION['pass'];
    // $current_key = $_POST['pass'];
    // $current_login = $_POST['login'];
    // $allow = false;

    // $secret_key = 'none';
    
    // if ($current_login) {
    //     $sql = "SELECT * FROM `users` WHERE `login` = '{$current_login}'";
    //     $result = mysqli_fetch_assoc(executeQuery($sql));
        
    //     if (isset($result['pass']))
    //         $secret_key = $result['pass'];
    // }



    // if (isset($_GET['logout'])) {
    //     // setcookie('pass');
    //     // setcookie('login');
    //     // setcookie('key');
    //     setcookie('hash');
    //     session_destroy();
    //     header("Location: /");
    // }
    
    // if (empty($current_key)) {
    //     if($session_key == $secret_key) {
    //         $allow = true;
    //     } else {
    //         if($cookie_key == $secret_key) {
    //             $allow = true;
    //         }
    //     }
    // } else {
    //     if (password_verify($current_key, $secret_key)) {
    //         $allow = true;
    //         // setcookie('pass', $current_key, time() + 36000);
    //         $_SESSION['pass'] = $current_key;
    //         $_SESSION['login'] = $current_login;

    //         if (isset($_POST['save'])) {
    //             setcookie('pass', $current_key, time() + 36000);
    //             setcookie('login', $current_login, time() + 36000);
    //         } 
    //     } else {
    //         $auth_error = true;
    //     }
    // }
    
    // if ($allow) {
    //     if(isset($_SESSION['login']))
    //         $login = $_SESSION['login'];
    //     else $login = $_COOKIE['login'];
    // } 
    