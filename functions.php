<?php

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

function format_time($ts) {
    $time_now = strtotime('now');
    $time_location = 60 * 60 * 3;
    $time_difference = $time_now - $ts - $time_location;
    $one_day = 60 * 60 * 24;
    $one_hour = 60 * 60;

    switch ($time_difference) {
        case $time_difference > $one_day:
            return date("d.m.y в H:i", $ts);
            break;
        case $time_difference >= $one_hour:
            return date("G часов назад", $ts);
            break;
        default:
            return date("i минут назад", $ts);
            break;
    }
}

function time_bet($ts) {
    $time_now = strtotime('now');
    $one_day = strtotime('-1 hour');
    $one_hour = strtotime('-1 day');
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

function file_validation() {
    $mime_type = ['image/png', 'image/jpeg'];
    $result = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['lot-file'])) {
        $file_tmp_name = $_FILES['lot-file']['tmp_name'];
        $file_size = $_FILES['lot-file']['size'];
        $file_type = mime_content_type($file_tmp_name);
        $file_max_size = 1000000;

        if (!in_array($file_type, $mime_type)){
            $result['error'] = 'Загрузите картинку в формате jpg или png' . "<br>";
        }

        if ($file_size > $file_max_size) {
            $result['error'] .= 'Максимальный размер файла не должен превышать - 1МБ';
        }

        if (empty($result['error'])) {
            $file_name = $_FILES['lot-file']['name'];
            $file_path = __DIR__ . '/img/';
            $file_url = 'img/' . $file_name;
            move_uploaded_file($_FILES['lot-file']['tmp_name'], $file_path . $file_name);
            $result['url'] = $file_url;
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

function search_user_email($email, $users) {
    $result = null;

    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
        }
    }

    return $result;
}

function cost_validation() {
    $errors = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_POST['cost'] == '') {
            $errors = 1;
        }
    }

    return $errors;
}

function find_bets($array) {
    $result = false;

    foreach ($array as $lots) {
        if ($lots['lot_id'] === $_GET['id']) {
            $result = true;
            break;
        }
    }

    return $result;
}
