<?php
session_start();

/**
 * Подключаем файла соединения с БД
 */
require_once 'init.php';

$title = 'Регистрация';

/**
 * При POST запросе начинается валидация полученных данных
 */
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation_errors = registration_validation();
    $validation_file = file_validation('avatar');

    if (empty($validation_errors) && empty($validation_file['error'])) {

        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $message = $_POST['message'];

        /**
         * Формирование запроса в БД для проверки дублирования email
         */
        $sql_email_user = 'SELECT id FROM user WHERE email = ?;';

        if (!select_data($link, $sql_email_user, [$_POST['email']])) {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            /**
             * Формирование массива данных нового пользователя
             */
            $info_new_user = [
                    'email' => $email,
                    'name' => $name,
                    'password' => $password_hash,
                    'contact' => $message
            ];

            /**
             * Проверка загрузки аватара и установка дефолтной картинки
             */
            if (isset($validation_file['url'])) {
                $info_new_user['avatar'] = $validation_file['url'];
            }

            /**
             * Запись данных в БД и переход на главную страницу для входа на сайт
             */
            if (insert_data($link, 'user', $info_new_user)) {

                $content = render_template('templates/login.php',

                    [
                        'login_tittle' => 'Теперь вы можете войти, используя свой email и пароль'
                    ]);

            } else {

                /**
                 * Вывод сообщения об ошибке при записи данных в БД
                 */
                $content = render_template('templates/sing-up.php',

                    [
                        'error_insert_bd' => 'Произошла ошибка записи данных!'
                    ]);
            }

        } else {

            /**
             * Вывод ошибки при дублировании email в БД
             */
            $errors[] = 'double_email';
            $content = render_template('templates/sing-up.php',

                [
                    'errors' => $errors
                ]);
        }

    } else {

        /**
         * Вывод ошибок валидации полей формы
         */
        $content = render_template('templates/sing-up.php',
            [
                'validation_errors' => $validation_errors,
                'validation_file' => $validation_file
            ]);
    }

} else {

    $content = render_template('templates/sing-up.php', ['categories' => $categories]);
}

/**
 * Рендер страницы
 */
$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'categories' => $categories,
        'no_selected' => true,
        'main' => false
    ]);

print $layout;
