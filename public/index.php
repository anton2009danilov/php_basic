<?php
session_start();
include_once '../config/config.php';
// include '../engine/auth.php';
// var_dump($allow);
// init_gallery_database();

$url_array = explode("/", $_SERVER['REQUEST_URI']);

if (!$url_array[1] == '') {
    $page = $url_array[1];
} else {
    $page = 'index';
}

echo render($page, prepareVariables($page));

// _log($params);