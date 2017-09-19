<?php
session_start();
// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');



$title = "Главная";
$main = "class=\"container\"";

require_once 'data.php';
require_once 'init.php';

$categories = select_data($link, 'SELECT category_name FROM categories;', '');

$sql_lots = 'SELECT l.id, lot_name, cost, image, category_name FROM lots l JOIN categories c ON category_id = c.id;';

$array_lots = select_data($link, $sql_lots, '');

$content = render_template('templates/index.php',
    [
        'array_lots' => $array_lots,
        'categories' => $categories,
        'lot_time_remaining' => $lot_time_remaining
    ]);

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'categories' => $categories,
        'user_avatar' => $user_avatar,
        'main' => $main
    ]);

print $layout;


