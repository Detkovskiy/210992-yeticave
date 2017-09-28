<?php
session_start();
$title = "Вход";

require_once 'init.php';

$login = [];

if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {

    $login = login_validation($link, $_POST['email']);

    if (empty($login['errors'])) {

        if (password_verify($_POST['password'], $login['user']['password'])) {

            $_SESSION['user'] = $login['user'];
            header("Location: index.php");

        } else {

            $login['errors'][] = 'no_valid_password';

        }
    }
}

$content = render_template('templates/login.php',
    [
        'login' => $login
    ]);

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'main' => false,
        'no_selected' => true,
        'categories' => $categories
    ]);

print $layout;


