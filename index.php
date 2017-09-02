<?php
$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

// время до начала следующих суток
$lot_time_remaining = date("H : i", (($tomorrow - $now) - 10800));

// массив с категориями товаров
$categories = ["Все категории", "Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];

// массив с объявлениями
$ads = [
    [
        'title' => '2014 Rossignol District Snowboard',
        'category' => $categories[0],
        'price' => '10999',
        'url' => 'img/lot-1.jpg'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => $categories[0],
        'price' => '159999',
        'url' => 'img/lot-2.jpg'
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => $categories[1],
        'price' => '8000',
        'url' => 'img/lot-3.jpg'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => $categories[2],
        'price' => '10999',
        'url' => 'img/lot-4.jpg'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => $categories[3],
        'price' => '7500',
        'url' => 'img/lot-5.jpg'
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'category' => $categories[5],
        'price' => '5400',
        'url' => 'img/lot-6.jpg'
    ]
];

$title = "Главная";

require_once 'functions.php';

$content = renderTemplate('templates/index.php',
    [
        'ads' => $ads,
        'categories' => $categories,
        'lot_time_remaining' => $lot_time_remaining
    ]);

$layout = renderTemplate('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'is_auth' => $is_auth,
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]);

print $layout;


