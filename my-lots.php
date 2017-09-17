<?php
session_start();

require_once 'functions.php';
require_once 'data.php';


if($_SESSION['my_lots']) {
    $my_lots = json_decode($_SESSION['my_lots'], true);
}

$content = render_template('templates/my-lots.php',
    [
        'my_lots' => $my_lots,
        'array_lots' => $array_lots,
        'lot_time_remaining_sec' => $lot_time_remaining_sec
    ]);

$layout = render_template('templates/layout.php',
    [
        'title' => 'Мои ставки',
        'content' => $content,
        'user_avatar' => $user_avatar,
    ]);

print $layout;
