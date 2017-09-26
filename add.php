<?php

session_start();

require_once 'config.php';
require_once 'init.php';

$title = "Добавление лота";

if (isset($_SESSION['user'])) {

    $content = render_template('templates/add-lot.php', ['categories' => $categories]);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $validation_errors = validation();
        $validation_file = file_validation('lot-file');

        if (empty($validation_errors) && empty($validation_file['error'])) {

            $sql_category_id = 'SELECT id FROM categories WHERE category_name = ?;';
            $category_id = select_data($link, $sql_category_id, [$_POST['category']])[0];

            $user_add_lot = [
                'user_id' => $_SESSION['user']['id'],
                'category_id' => $category_id['id'],
                'lot_name' => htmlspecialchars($_POST['lot-name']),
                'description' => htmlspecialchars($_POST['message']),
                'image' => $validation_file['url'],
                'cost' => $_POST['lot-rate'],
                'cost_range' => $_POST['lot-step'],
                'data_end' => $_POST['lot-date']
            ];

            insert_data($link, 'lots', $user_add_lot);

            $user_add_lot['first_bet'] = $_POST['lot-rate'] + $_POST['lot-step'];
            $user_add_lot['category_name'] = $_POST['category'];

            $content = render_template('templates/lot.php', ['current_lot' => $user_add_lot]);

        } else {

            $content = render_template('templates/add-lot.php',
                [
                    'validation_errors' => $validation_errors,
                    'text_error_empty_field' => $text_error_empty_field,
                    'text_error_numeric_field' => $text_error_numeric_field,
                    'categories' => $categories,
                    'validation_file' => $validation_file
                ]);
        }
    }

    $layout = render_template('templates/layout.php',
        [
            'title' => $title,
            'content' => $content,
            'user_avatar' => $user_avatar
        ]);

    print $layout;

} else {
    header("Location: login.php");
}
