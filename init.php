<?php

require_once 'functions.php';

$link = mysqli_connect("localhost:3306", "root", "1121", "yeticave");

if (!$link) {
    $error = mysqli_connect_error();
    $content = render_template('templates/error.php',
        [
            'error' => $error
        ]);

    print $content;
    exit;
} else {
    print_r('Подключение успешно!' . '<br>');
    print_r(select_data($link, 'SELECT email FROM USER WHERE id = ?;', [2]));

}

//insert_data($link, 'user', ['email' => '1@bca.ru', 'name' => '111']);


//exec_query($link, 'DELETE FROM user WHERE id > ?;', [3]);
