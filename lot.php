<?php
session_start();
require_once 'data.php';
require_once 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if ($array_lots[$id] == NULL) {
    http_response_code(404);
    $main = "class=\"container\"";
    $content = "Такой страницы не существует (ошибка 404)";
} else {
    $main = '';
    $array_lots = $array_lots[$id];
    $content = renderTemplate('templates/lot.php',
        [
            'array_lots' => $array_lots,
            'id' => $id,
            'bets' => $bets
        ]);
}

$layout = renderTemplate('templates/layout.php',
    [
        'title' => $array_lots[$id]['title'],
        'content' => $content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'main' => $main
    ]);

print $layout;
