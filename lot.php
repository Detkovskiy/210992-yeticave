<?php
session_start();

require_once 'data.php';
require_once 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $_SESSION['id'] = $_GET['id'];
}

$my_lots = [];
$check_bet = false;

if($_SESSION['my_lots']) {
    $my_lots = json_decode($_SESSION['my_lots'], true);
    $check_bets = find_bets($my_lots);
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
            'bets' => $bets,
            'lot_time_remaining' => $lot_time_remaining,
            'check_bets' => $check_bets
        ]);
}

$validation_errors = cost_validation();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors)) {

    $my_lot = [
        'my_cost' => $_POST['cost'],
        'time_now' => strtotime('now'),
        'lot_id' => $_SESSION['id']
    ];

    $my_lots[] = $my_lot;

    $_SESSION['my_lots'] = json_encode($my_lots);

    header("Location: my-lots.php");
}

$layout = renderTemplate('templates/layout.php',
    [
        'title' => $array_lots[$id]['title'],
        'content' => $content,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'main' => $main
    ]);

print $layout;


