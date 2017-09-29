<?php

session_start();

/**
 * Подключаем файл соединения с БД
 */
require_once 'config.php';
require_once 'init.php';

$title = "Добавление лота";

/**
 * Проверка наличия пользователя прошедшего верификацию
 */
if (isset($_SESSION['user'])) {

    /**
     * Рендер контента страницы. Формы добаления лота.
     */
    $content = render_template('templates/add-lot.php', ['categories' => $categories]);

    /**
     * Проверка отправки формы методом POST и валидация полученных данных
     */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $validation_errors = validation();
        $validation_file = file_validation('lot-file');

        if (empty($validation_errors) && empty($validation_file['error'])) {

            /**
             * Определение id категории лота
             */
            $sql_category_id = 'SELECT id FROM categories WHERE category_name = ?;';
            $category_id = select_data($link, $sql_category_id, [$_POST['category']])[0];

            /**
             * Формирование массива данных нового лота и запись в БД
             */
            $user_add_lot = [
                'user_id' => $_SESSION['user']['id'],
                'category_id' => $category_id['id'],
                'lot_name' => htmlspecialchars($_POST['lot-name']),
                'description' => htmlspecialchars($_POST['message']),
                'image' => $validation_file['url'],
                'cost' => $_POST['lot-rate'],
                'cost_range' => $_POST['lot-step'],
                'data_end' => convert_date_sql($_POST['lot-date'])
            ];

            $lot_id = insert_data($link, 'lots', $user_add_lot) ? mysqli_insert_id($link) : '';

            /**
             * Переход на страницу с добавленным лотом
             */
            header("Location: lot.php?id=$lot_id");

        } else {

            /**
             * Рендер ошибок при валидации данных формы
             */
            $content = render_template('templates/add-lot.php',
                [
                    'validation_errors' => $validation_errors,
                    'text_error_empty_field' => $text_error_empty_field,
                    'text_error_numeric_field' => $text_error_numeric_field,
                    'validation_file' => $validation_file,
                    'categories' => $categories
                ]);
        }
    }

    $layout = render_template('templates/layout.php',
        [
            'title' => $title,
            'content' => $content,
            'user_avatar' => $user_avatar,
            'main' => false,
            'categories' => $categories,
            'no_selected' => true
        ]);

    print $layout;

} else {
    header("Location: login.php");
}
