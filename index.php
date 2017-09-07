<?php
// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

// время до начала следующих суток
$lot_time_remaining = date("H : i", (($tomorrow - $now) - 10800));

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
        /*'is_auth' => $is_auth,
        'user_name' => $user_name,*/
        'user_avatar' => $user_avatar,
        'main' => $main
    ]);

print $layout;


