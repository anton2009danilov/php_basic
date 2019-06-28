<?php

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
  