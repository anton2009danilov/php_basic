<?php

function renderTemplate($page, $content = '', $params = []) {
    extract($params);
    ob_start();
    include $page . ".php";
    return ob_get_clean();    
}
$header = renderTemplate("templates/header");
$name = "User1";
$content = renderTemplate("templates/about", '', ['name' => $name, 'header' => $header]);
echo renderTemplate("templates/layout", $content);