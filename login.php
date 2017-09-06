<?php

$title = "Вход";

require_once 'functions.php';



$validation_errors = validationLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($validation_errors['error'])) {
    require_once 'validation.php';

} else {
    $content = renderTemplate('templates/login.php',
        [
            'validation_errors' => $validation_errors
        ]);
}




$layout = renderTemplate('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'main' => ''
    ]);

print $layout;


