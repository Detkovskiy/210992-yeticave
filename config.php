<?php
date_default_timezone_set('Europe/Moscow');

$user_avatar = 'img/user.jpg';
$user_name = 'Констатнтин';

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

// время до начала следующих суток

//$lot_time_remaining_sec = date("H:i:s", (($tomorrow - $now) - 10800));

$text_error_empty_field = 'Заполните это поле';
$text_error_numeric_field = 'Вводить только цифры, больше нуля';
