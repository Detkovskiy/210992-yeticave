<?php
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 18.09.17
 * Time: 15:17
 */

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
    print_r('Подключение успешно!');
}
