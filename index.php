<?php
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

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

require_once 'data.php';
require_once 'functions.php';

$content = renderTemplate('templates/index.php',
    [
        'ads' => $ads,
        'categories' => $categories,
        'lot_time_remaining' => $lot_time_remaining
    ]);

$layout = renderTemplate('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]);

print $layout;


