<?php
session_start();

$title = "Главная";

require_once 'config.php';
require_once 'init.php';

$sql_lots = '
    SELECT l.id, lot_name, cost, image, category_name, data_end 
    FROM lots l 
    JOIN categories c ON category_id = c.id;';

$array_lots = select_data($link, $sql_lots, '');

$content = render_template('templates/index.php',
    [
        'array_lots' => $array_lots,
        'categories' => $categories
    ]);

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'categories' => $categories,
        'user_avatar' => $user_avatar,
        'main' => true
    ]);

print $layout;


