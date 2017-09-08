<?php
session_start();

require_once 'functions.php';
require_once 'data.php';


if($_SESSION['my_lots']) {
    $my_lots = json_decode($_SESSION['my_lots'], true);
}

$content = renderTemplate('templates/my-lots.php',
    [
        'my_lots' => $my_lots,
        'array_lots' => $array_lots,
        'lot_time_remaining_sec' => $lot_time_remaining_sec
    ]);

$layout = renderTemplate('templates/layout.php',
    [
        'title' => 'Мои ставки',
        'content' => $content,
        'user_avatar' => $user_avatar,
    ]);

print $layout;
