<?php
session_start();

require_once 'config.php';
require_once 'init.php';

if (isset($_GET['id'])) {

    $sql_lots = '
    SELECT l.id, lot_name, cost, data_end, image, description, category_name, l.cost + l.cost_range AS `first_bet` 
    FROM lots l 
    LEFT JOIN categories c ON category_id = c.id 
    LEFT JOIN bet b ON b.lot_id = l.id 
    WHERE l.id = ?;';

    $sql_bets = '
    SELECT b.user_price, u.name, b.date, u.id AS `user_id`
    FROM lots l 
    LEFT JOIN bet b ON b.lot_id = l.id 
    LEFT JOIN user u ON b.user_id = u.id 
    WHERE b.user_price != \'\' and l.id = ?
    ORDER BY b.date DESC;';

    $sql_price = '
    SELECT b.user_price + l.cost_range AS `price`
    FROM bet b
    LEFT JOIN lots l on l.id = b.lot_id
    WHERE l.id = ?
    ORDER BY user_price DESC
    LIMIT 1';

    $current_lot = select_data($link, $sql_lots, [$_GET['id']])[0];
    $array_bets = select_data($link, $sql_bets, [$_GET['id']]);

    $count_bets = count($array_bets);
    $main = false;

    if ($current_lot['id'] == $_GET['id']) {

        $validation_errors = [];

        $check_bet = isset($_SESSION['user']) ? find_bet($array_bets) : '';

        if ($check_bet) {
            $min_bet = isset($_SESSION['user']) ? select_data($link, $sql_price, [$_GET['id']])[0] : '';
        } else {
            $min_bet = '';
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $validation_errors = cost_validation($current_lot['first_bet']);

            if (empty($validation_errors))  {

                insert_data($link, 'bet', ['user_id' => $_SESSION['user']['id'], 'lot_id' => $_GET['id'], 'user_price' => $_POST['cost']]);

                header("Location: my-bets.php");
            }
        }

        $content = render_template('templates/lot.php',
            [
                'current_lot' => $current_lot,
                'array_bets' => $array_bets,
                'min_bet' => $min_bet,
                'count_bets' => $count_bets,
                'validation_errors' => $validation_errors,
                'check_bet' => $check_bet
            ]);

    } else {
        http_response_code(404);
        $main = true;
        $content = "Такой страницы не существует (ошибка 404)";
    }

    $layout = render_template('templates/layout.php',
        [
            'title' => $current_lot['lot_name'],
            'content' => $content,
            'user_avatar' => $user_avatar,
            'categories' => $categories,
            'main' => $main,
            'no_selected' => true
        ]);

    print $layout;
}




