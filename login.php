<?php
session_start();
$title = "Вход";

/**
 * Подключаем файл соединения с БД
 */
require_once 'init.php';

$login = [];

/**
 * При POST запросе начинается валидация полученных данных
 */
if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {

    // валидация полей и поиск пользователя в БД
    $login = login_validation($link, $_POST['email']);

    if (empty($login['errors'])) {

        // верификация пароля пользователя
        if (password_verify($_POST['password'], $login['user']['password'])) {

            $_SESSION['user'] = $login['user'];
            header("Location: index.php");

        } else {

            $login['errors'][] = 'no_valid_password';

        }
    }
}

/**
 * Рендер контента страницы и лэйаута
 */
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


