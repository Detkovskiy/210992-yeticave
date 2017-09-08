<?php
session_start();

require_once 'functions.php';

$content = renderTemplate('templates/my-lots.php',
    [

    ]);

$layout = renderTemplate('templates/layout.php',
    [
        'title' => 'Мои ставки',
        'content' => $content,
        'user_avatar' => $user_avatar,
    ]);

print $layout;
