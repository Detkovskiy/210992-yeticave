<?php

require_once 'functions.php';

$link = mysqli_connect("localhost:3306", "root", "1121", "yeticave");

if (!$link) {
    $error = mysqli_connect_error();
    $content = render_template('templates/error.php',
        [
            'error' => $error
        ]);

    $layout = render_template('templates/layout.php',
        [
            'content' => $content,
        ]);

    print $layout;
    exit();
} /*else {
    print_r('Подключение успешно!' . '<br>');

    if (isset($_GET['id'])) {
        $id = $_SESSION['id'] = $_GET['id'];
    }
    print_r(select_data($link, 'SELECT l.id, lot_name, cost, image, description, category_name FROM lots l JOIN categories c ON category_id = c.id WHERE l.id = ?;', [$id]));
}*/

//insert_data($link, 'user', ['email' => '1@bca.ru', 'name' => '111']);


//exec_query($link, 'DELETE FROM user WHERE id > ?;', [3]);


$categories = select_data($link, 'SELECT category_name FROM categories;', '');
