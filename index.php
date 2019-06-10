<?php

function renderTemplate($page, $content = '', $params = []) {
    extract($params);
    ob_start();
    include $page . ".php";
    return ob_get_clean();    
}
$name = "User1";
$content = renderTemplate("templates/about", renderTemplate("templates/header"), ['name' => $name]);
echo renderTemplate("templates/layout", $content);