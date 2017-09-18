<?php
session_start();
require_once 'data.php';
require_once 'functions.php';

$title = "Добавление лота";


$validation_errors = validation();
$validation_file = file_validation();

if (isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors) && empty($validation_file['error'])) {
        $user_add_lot = [];

        $user_add_lot['url'] = $validation_file['url'];
        $user_add_lot['title'] = htmlspecialchars($_POST['lot-name']);
        $user_add_lot['category'] = $_POST['category'];
        $user_add_lot['price'] = $_POST['lot-rate'];
        $user_add_lot['description'] = htmlspecialchars($_POST['message']);

        $content = render_template('templates/lot.php',
            [
                'bets' => $bets,
                'current_lot' => $user_add_lot,
                'lot_time_remaining' => $lot_time_remaining
            ]);

    } else {
        $content = render_template('templates/add-lot.php',
            [
                'validation_errors' => $validation_errors,
                'text_error_empty_field' => $text_error_empty_field,
                'text_error_numeric_field' => $text_error_numeric_field,
                'categories' => $categories,
                'validation_file' => $validation_file
            ]);
    }

    $layout = render_template('templates/layout.php',
        [
            'title' => $title,
            'content' => $content,
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'user_avatar' => $user_avatar
        ]);

    print $layout;
} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
