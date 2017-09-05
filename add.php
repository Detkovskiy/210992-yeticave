<?php
require_once 'data.php';
require_once 'functions.php';

$title = "Добавление лота";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ads = [];

    if (isset($_FILES['lot-file'])) {
        $file_name = $_FILES['lot-file']['name'];
        $file_path = __DIR__ . '/img/';
        $file_url = 'img/' . $file_name;
        move_uploaded_file($_FILES['lot-file']['tmp_name'], $file_path . $file_name);
        $ads['url'] = $file_url;
    }

    $ads['title'] = $_POST['lot-name'];
    $ads['category'] = $_POST['category'];
    $ads['price'] = $_POST['lot-rate'];
    $ads['description'] = $_POST['message'];

    $content = renderTemplate('templates/lot.php', ['bets' => $bets, 'ads' => $ads]);
} else {
    $content = renderTemplate('templates/add-lot.php', [ ]);
}

$layout = renderTemplate('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]);

print $layout;


