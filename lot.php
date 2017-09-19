<?php
session_start();

require_once 'data.php';
//require_once 'functions.php';
require_once 'init.php';

if (isset($_GET['id'])) {
    $id = $_SESSION['id'] = $_GET['id'];
}

$sql_lots = 'SELECT l.id, lot_name, cost, image, description, category_name FROM lots l JOIN categories c ON category_id = c.id WHERE l.id = ?;';

$array_lots = select_data($link, $sql_lots, [$id]);

$my_lots = [];
$check_bets = false;

if(isset($_SESSION['my_lots']) && $_SESSION['my_lots']) {
    $my_lots = json_decode($_SESSION['my_lots'], true);
    $check_bets = find_bets($my_lots);
}
$aa = $array_lots[0]['id'];
if (isset($_GET['id']) && !($array_lots[0]['id'] == $id)) {
    http_response_code(404);
    $main = "class=\"container\"";
    $content = "Такой страницы не существует (ошибка 404)";
} else {
    $main = '';
    $current_lot = select_data($link, $sql_lots, [$id]);
    $content = render_template('templates/lot.php',
        [
            'current_lot' => $current_lot,
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

$layout = render_template('templates/layout.php',
    [
        'title' => $array_lots[$id]['title'],
        'content' => $content,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'main' => $main
    ]);

print $layout;


