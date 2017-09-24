<?php
session_start();

require_once 'data.php';
//require_once 'functions.php';
require_once 'init.php';

if (isset($_GET['id'])) {
    /*$id =*/ $_SESSION['id'] = $_GET['id'];
}

$sql_lots = 'SELECT l.id, lot_name, cost, image, description, category_name, l.cost + l.cost_range AS \'min_bet\' FROM lots l LEFT JOIN categories c ON category_id = c.id LEFT JOIN bet b ON b.lot_id = l.id WHERE l.id = ?;';

$sql_bets = 'SELECT b.user_price, u.name, b.date FROM lots l LEFT JOIN bet b ON b.lot_id = l.id LEFT JOIN user u ON b.user_id = u.id WHERE b.user_price != \'\' and l.id = ?;';

$current_lot = select_data($link, $sql_lots, [$id])[0];
$array_bets = select_data($link, $sql_bets, [$id]);
$count_bets = count($array_bets);

$my_lots = [];
$check_bets = false;

if(isset($_SESSION['my_lots']) && $_SESSION['my_lots']) {
    $my_lots = json_decode($_SESSION['my_lots'], true);
    $check_bets = find_bets($my_lots);
}

$validation_errors = cost_validation($current_lot['min_bet']);

if (isset($_GET['id']) && !($current_lot['id'] == $id)) {
    http_response_code(404);
    $main = "class=\"container\"";
    $content = "Такой страницы не существует (ошибка 404)";
} else {
    $main = '';
    $content = render_template('templates/lot.php',
        [
            'current_lot' => $current_lot,
           // 'id' => $id,
            'array_bets' => $array_bets,
            'count_bets' => $count_bets,
            'lot_time_remaining' => $lot_time_remaining,
            'check_bets' => $check_bets,
            'validation_errors' => $validation_errors
        ]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors)) {

    $my_lot = [
        'my_cost' => $_POST['cost'],
        'time_now' => strtotime('now'),
        'lot_id' => $_SESSION['id'],
        'validation_errors' => $validation_errors
    ];

    $my_lots[] = $my_lot;

    $_SESSION['my_lots'] = json_encode($my_lots);

    insert_data($link, 'bet', ['user_id' => $_SESSION['user']['id'], 'lot_id' => $_GET['id'], 'user_price' => $_POST['cost']]);


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


