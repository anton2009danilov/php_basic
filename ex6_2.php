<?php

$title = 'Главная страница - страница обо мне';
$header = 'Информация обо мне';
$year = '2018';

$content = file_get_contents("site2.tmpl");

$content = str_replace("{{ TITLE }}", $title, $content);
$content = str_replace("{{ HEADER }}", $header, $content);
$content = str_replace("{{ YEAR }}", $year, $content);

echo $content;