<?php

$title = "Вход";

require_once 'functions.php';


$validation_errors = validationLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($validation_errors['error'])) {
    $content = renderTemplate('templates/login.php',
        [
            'validation_errors' => $validation_errors
            /*'array_lots' => $array_lots,
            'categories' => $categories,
            'lot_time_remaining' => $lot_time_remaining*/
        ]);
} else {
    $content = renderTemplate('templates/login.php',
        [

            /*'array_lots' => $array_lots,
            'categories' => $categories,
            'lot_time_remaining' => $lot_time_remaining*/
        ]);
}




$layout = renderTemplate('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,

        /*'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,*/
        'main' => ''
    ]);

print $layout;


