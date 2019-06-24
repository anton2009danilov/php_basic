<?php


define('TEMPLATES_DIR', '../views/');
define('LAYOUTS_DIR', './layouts/');

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'shop');

include_once '../engine/db.php';
include_once '../engine/functions.php';
include_once '../engine/log.php';
include_once '../engine/resize.php';
include_once '../engine/mathOperation.php';
// include_once '../engine/addlike.php';