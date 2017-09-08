<?php
session_start();
$title = "Вход";

require_once 'functions.php';

$validation_errors = validationLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors['error'])) {

    require_once 'userdata.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user = search_user_email($email, $users)) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user;
            header("Location: index.php");

        } else {

            $errors['error'][] = 'no_valid_password';
            $content = renderTemplate('templates/login.php',

                [
                    'errors' => $errors
                ]);
        }
    }
} else {
    $content = renderTemplate('templates/login.php',
        [
            'validation_errors' => $validation_errors
        ]);
}

$layout = renderTemplate('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'main' => ''
    ]);

print $layout;


