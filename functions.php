<?php

function renderTemplate($fileTemplate, $data) {
    if (file_exists($fileTemplate) and is_array($data)) {
        extract($data);
        ob_start('ob_gzhandler');
        require_once $fileTemplate;
        return ob_get_clean();
    } else {
        return '';
    }
}
