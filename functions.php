<?php

function renderTemplate($fileTemplate, $data) {
    if (file_exists($fileTemplate)/* and is_array($data)*/) {
        extract($data);
        ob_start('ob_gzhandler');
        require_once $fileTemplate;
        return ob_get_clean();
    } else {
        return '';
    }
}

function format_time($ts) {
    $time_now = strtotime('now');
    $time_difference = $time_now - $ts - 10800;

    switch ($time_difference) {
        case $time_difference > 86400:
            return date("d.m.y в H:i", $ts);
            break;
        case $time_difference >= 3600:
            return date("G часов назад", $ts);
            break;
        default:
            return date("i минут назад", $ts);
            break;
    }
}
