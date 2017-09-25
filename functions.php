<?php
require_once 'mysql_helper.php';
require_once 'vendor/autoload.php';

function render_template($file_template, $data) {
    if (file_exists($file_template)) {
        extract($data);
        ob_start('ob_gzhandler');
        require_once $file_template;
        return ob_get_clean();
    } else {
        return '';
    }
}

function lot_time_remaining($date_time) {
    $time_now = strtotime('now');
    $ts = strtotime($date_time);
    $time_difference = $ts - $time_now;
    return date("H : i", $time_difference);
}

function format_time($date_time) {
    $ts = strtotime($date_time);
    $time_now = strtotime('now');
    $one_hour = strtotime('-1 hour');
    $one_day = strtotime('-1 day');
    $time_difference = $time_now - $ts;

    switch ($ts) {
        case $ts < $one_day:
            return date("d.m.y в H:i", $ts);
            break;
        case $ts < $one_hour:
            return date("G часов назад", $time_difference);
            break;
        default:
            return date("i минут назад", $time_difference);
            break;
    }
}

function validation() {
    $errors = [];
    $field_numeric = ['lot-rate', 'lot-step'];
    $empty_field = ['lot-name', 'category', 'message', 'lot-date'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($field_numeric as $value_field) {
            if (!is_numeric($_POST[$value_field]))  {
                $errors[] = $value_field;
            }
            if ($_POST[$value_field] == 0) {
                $errors[] = $value_field;
            }
        }

        foreach ($empty_field as $value_field) {
            if ($_POST[$value_field] == '') {
                $errors[] = $value_field;
            }
        }
    }

    return $errors;
}

function file_validation($field_form) {
    $mime_type = ['image/png', 'image/jpeg'];
    $result['error'] = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES[$field_form]) && ($_FILES[$field_form]['size'] > 0)) {
        $file_tmp_name = $_FILES[$field_form]['tmp_name'];
        $file_size = $_FILES[$field_form]['size'];
        $file_type = mime_content_type($file_tmp_name);
        $file_max_size = 1000000;

        if (!in_array($file_type, $mime_type)){
            $result['error'] = 'Загрузите картинку в формате jpg или png' . "<br>";
        }

        if ($file_size > $file_max_size) {
            $result['error'] .= 'Максимальный размер файла не должен превышать - 1МБ';
        }

        if (empty($result['error'])) {
            $file_name = $_FILES[$field_form]['name'];
            if ($field_form == "avatar") {
                $file_path = __DIR__ . '/img/avatars/';
                $file_url = 'img/avatars/' . $file_name;
                move_uploaded_file($_FILES[$field_form]['tmp_name'], $file_path . $file_name);
                $result['url'] = $file_url;
            } else {
                $file_path = __DIR__ . '/img/';
                $file_url = 'img/' . $file_name;
                move_uploaded_file($_FILES[$field_form]['tmp_name'], $file_path . $file_name);
                $result['url'] = $file_url;
            }
        }
    }

    return $result;
}

function login_validation() {
    $errors = [];
    $empty_field = ['email', 'password'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($empty_field as $value_field) {
            if ($_POST[$value_field] == '') {
                $errors[] = $value_field;
            }
        }

        if (!in_array('email', $errors)) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'error_mail_validation';
            }
        }
    }

    return $errors;
}

function registration_validation() {
    $errors = [];
    $empty_field = ['email', 'password', 'name', 'message'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($empty_field as $value_field) {
            if ($_POST[$value_field] == '') {
                $errors[] = $value_field;
            }
        }

        if (!in_array('email', $errors)) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'error_mail_validation';
            }
        }
    }

    return $errors;
}

function search_user_email($email, $users) {
    $result = null;

    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }

    return $result;
}

function cost_validation($bet) {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['cost'] == '') {
            $errors[] = 'empty';
        }
        if (!is_numeric($_POST['cost']))  {
            $errors[] = 'no_numeric';
        }
        if ($_POST['cost'] < $bet) {
            $errors[] = 'no_first_bet';
        }
    }

    return $errors;
}

function find_bet($array) {
    $result = false;

    foreach ($array as $bet) {
        if ($bet['user_id'] === $_SESSION['user']['id']) {
            $result = true;
            break;
        }
    }

    return $result;
}

function select_data($link, $sql, $data) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);

    return $result;
}

function insert_data($link, $table, $data) {
    $keys_arr = array_keys($data);
    $keys = implode(", ", $keys_arr);

    $values_arr = array_values($data);
    $placeholder = [];
    foreach ($values_arr as $key) {
        $placeholder[] = '?';
        }
    $values = implode(", ", $placeholder);

    $sql = "INSERT INTO $table ($keys) VALUES ($values)";
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt);
    $last_id = mysqli_insert_id($link);
    return $result && !empty($last_id) ? $last_id : false;
}

function exec_query($link, $sql, $data) {
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($stmt) ? true : false;
    return $result;
}
