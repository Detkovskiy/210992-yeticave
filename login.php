<?php
session_start();
$title = "Вход";

require_once 'functions.php';
$errors = [];
$validation_errors = login_validation();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors)) {

    require_once 'userdata.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user = search_user_email($email, $users)) {

        if (password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user;
            header("Location: index.php");

        } else {

            $errors[] = 'no_valid_password';
            $content = render_template('templates/login.php',

                [
                    'errors' => $errors
                ]);
        }
    }
} else {
    $content = render_template('templates/login.php',
        [
            'validation_errors' => $validation_errors,
            'errors' => $errors
        ]);
}

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'main' => ''
    ]);

print $layout;


