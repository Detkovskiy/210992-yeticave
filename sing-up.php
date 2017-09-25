<?php
session_start();

require_once 'init.php';

$title = 'Регистрация';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation_errors = registration_validation();
    $validation_file = file_validation('avatar');

    if (empty($validation_errors) && empty($validation_file['error'])) {

        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $message = $_POST['message'];

        $sql_email_user = 'SELECT email FROM user;';
        $email_users = select_data($link, $sql_email_user, '');

        if (!search_user_email($email, $email_users)) {

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $info_new_user = [
                    'email' => $email,
                    'name' => $name,
                    'password' => $password_hash,
                    'contact' => $message
            ];

            if (isset($validation_file['url'])) {
                $info_new_user['avatar'] = $validation_file['url'];
            }

            if (insert_data($link, 'user', $info_new_user)) {

                $content = render_template('templates/login.php',

                    [
                        'login_tittle' => 'Теперь вы можете войти, используя свой email и пароль'
                    ]);

            } else {

                $content = render_template('templates/sing-up.php',

                    [
                        'error_insert_bd' => 'Произошла ошибка записи данных!'
                    ]);
            }

        } else {

            $errors[] = 'double_email';
            $content = render_template('templates/sing-up.php',

                [
                    'errors' => $errors
                ]);
        }

    } else {

        $content = render_template('templates/sing-up.php',
            [
                'validation_errors' => $validation_errors,
                'validation_file' => $validation_file
            ]);
    }

} else {

    $content = render_template('templates/sing-up.php', ['']);
}

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'categories' => $categories
    ]);

print $layout;
