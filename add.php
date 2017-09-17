<?php
session_start();
require_once 'data.php';
require_once 'functions.php';

$title = "Добавление лота";


$validation_errors = validation();
$error_validation_file = file_validation();
if (isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors) && empty($error_validation_file)) {
        $userLot = [];

        if (isset($_FILES['lot-file'])) {
            $file_name = $_FILES['lot-file']['name'];
            $file_path = __DIR__ . '/img/';
            $file_url = 'img/' . $file_name;
            move_uploaded_file($_FILES['lot-file']['tmp_name'], $file_path . $file_name);
            $userLot['url'] = $file_url;
        }

        $userLot['title'] = htmlspecialchars($_POST['lot-name']);
        $userLot['category'] = $_POST['category'];
        $userLot['price'] = $_POST['lot-rate'];
        $userLot['description'] = htmlspecialchars($_POST['message']);

        $content = render_template('templates/lot.php',
            [
                'bets' => $bets,
                'array_lots' => $userLot,
                'lot_time_remaining' => $lot_time_remaining
            ]);

    } else {
        $content = render_template('templates/add-lot.php',
            [
                'validation_errors' => $validation_errors,
                'text_error_empty_field' => $text_error_empty_field,
                'text_error_numeric_field' => $text_error_numeric_field,
                'categories' => $categories,
                'error_validation_file' => $error_validation_file
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
