<?php
session_start();

require_once 'functions.php';
require_once 'data.php';
require_once 'init.php';


if($_SESSION['my_lots']) {
    $my_lots = json_decode($_SESSION['my_lots'], true);
}
$sql_all_lots = 'SELECT l.id, lot_name, image, category_name FROM lots l JOIN categories c ON category_id = c.id;';
$all_lots = select_data($link, $sql_all_lots, '');

$content = render_template('templates/my-lots.php',
    [
        'my_lots' => $my_lots,
        'all_lots' => $all_lots,
        'lot_time_remaining_sec' => $lot_time_remaining_sec
    ]);

$layout = render_template('templates/layout.php',
    [
        'title' => 'Мои ставки',
        'content' => $content,
        'user_avatar' => $user_avatar,
    ]);

print $layout;
