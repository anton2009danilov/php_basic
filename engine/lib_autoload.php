<?php

$lib_files = array_slice(scandir(ENGINE_DIR),2);

foreach ($lib_files as $file) {
    if ($file != 'lib_autoload.php')
    include_once ENGINE_DIR . "/" . $file;
}