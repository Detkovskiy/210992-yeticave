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
}

$categories = select_data($link, 'SELECT category_name, id, class FROM categories;', '');
