<?php
session_start();
// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');



$title = "Главная";
$main = "class=\"container\"";

require_once 'data.php';
require_once 'functions.php';

$content = renderTemplate('templates/index.php',
    [
        'array_lots' => $array_lots,
        'categories' => $categories,
        'lot_time_remaining' => $lot_time_remaining
    ]);

$layout = renderTemplate('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'user_avatar' => $user_avatar,
        'main' => $main
    ]);

print $layout;


