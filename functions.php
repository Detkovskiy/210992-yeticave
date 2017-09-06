<?php

function renderTemplate($file_template, $data) {
    if (file_exists($file_template)/* and is_array($data)*/) {
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

function validation() {
    $errors = ['error' => []];
    $field_numeric = ['lot-rate', 'lot-step'];
    $empty_field = ['lot-name', 'category', 'message', 'lot-date'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($field_numeric as $valueField) {
            if (!is_numeric($_POST[$valueField])) {
                $errors['error'][] = $valueField;
            }
        }

        foreach ($empty_field as $valueField) {
            if ($_POST[$valueField] == '') {
                $errors['error'][] = $valueField;
            }
        }
    }

    return $errors;
}

function fileValidation() {
    $fileErrorText = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['lot-file'])) {
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_name = $_FILES['lot-file']['tmp_name'];
        $file_size = $_FILES['lot-file']['size'];
        $file_type = finfo_file($file_info, $file_name);
        $file_max_size = 1000000;

        if ($file_type !== 'image/jpeg') {
            $fileErrorText = 'Загрузите картинку в формате jpg';
        }

        if ($file_size > $file_max_size) {
            $fileErrorText .= 'Максимальный размер файла: 1МБ';
        }
    }
    return $fileErrorText;
}

function validationLogin() {
    $errors = ['error' => []];
    $empty_field = ['email', 'password'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($empty_field as $valueField) {
            if ($_POST[$valueField] == '') {
                $errors['error'][] = $valueField;
            }
        }

        if (!in_array('email', $errors['error'])) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['error'][] = 'novalidation';
            }
        }
    }

    return $errors;
}
