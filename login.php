<?php
session_start();
$title = "Вход";

require_once 'init.php';

$validation_errors = [];
$errors = [];

if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {

    $validation_errors = login_validation();

    if (empty($validation_errors)) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql_user = 'SELECT id, email, password, name, avatar FROM user;';
        $users = select_data($link, $sql_user, '');

        if ($user = search_user_email($email, $users)) {

            if (password_verify($password, $user['password'])) {

                $_SESSION['user'] = $user;
                header("Location: index.php");

            } else {

                $errors[] = 'no_valid_password';

            }
        }
    }
}

$content = render_template('templates/login.php',
    [
        'validation_errors' => $validation_errors,
        'errors' => $errors
    ]);

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content
    ]);

print $layout;


