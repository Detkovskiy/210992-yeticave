<?php
session_start();

require_once 'init.php';

$title = 'Регистрация';

$errors = [];
$validation_errors = registration_validation();
$validation_file = file_validation('avatar');

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors) && empty($validation_file['error'])) {

    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $message = $_POST['message'];
    $time_reg = date("y.m.d", strtotime('now'));

    $sql_email_user = 'SELECT email FROM user;';
    $email_users = select_data($link, $sql_email_user, '');

    if (!search_user_email($email, $email_users)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        if (isset($validation_file['url'])) {
            insert_data($link, 'user', ['date_reg' => $time_reg, 'email' => $email, 'name' => $name, 'password' => $password_hash, 'contact' => $message, 'avatar' => $validation_file['url']]);
        } else {
            insert_data($link, 'user', ['date_reg' => $time_reg, 'email' => $email, 'name' => $name, 'password' => $password_hash, 'contact' => $message]);
        }


        $content = render_template('templates/login.php',

            [
                'login_tittle' => 'Теперь вы можете войти, используя свой email и пароль'
            ]);
    }
        else {

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
            'validation_file' => $validation_file,
            'errors' => $errors
        ]);
}

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'categories' => $categories
    ]);

print $layout;
