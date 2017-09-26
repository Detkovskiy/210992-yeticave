<?php
session_start();

$title = "Главная";

require_once 'config.php';
require_once 'init.php';
require_once 'getwinner.php';

$current_page = $_GET['page'] ?? 1;
$page_item = 1;

$sql_count_lots = 'SELECT count(*) as count FROM lots;';
$count_lots = select_data($link, $sql_count_lots, '')[0];

$page_count = ceil($count_lots['count'] / $page_item);
$offset = ($current_page - 1) * $page_item;
$pages = range(1, $page_count);

$sql_lots =
    'SELECT l.id, lot_name, cost, image, category_name, data_end
    FROM lots l
    JOIN categories c ON category_id = c.id
    LIMIT ? OFFSET ?;';

$array_lots = select_data($link, $sql_lots, [$page_item, $offset]);

$content = render_template('templates/index.php',
    [
        'array_lots' => $array_lots,
        'categories' => $categories,
        'pages' => $pages,
        'page_count' => $page_count,
        'current_page' => $current_page
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


