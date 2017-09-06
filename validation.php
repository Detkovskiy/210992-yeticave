<?php
session_start();

require_once 'userdata.php';

function search_user_email($email, $users) {
    $result = NULL;

    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
        }
    }

    return $result;
}

$email = $_POST['email'];
$password = $_POST['password'];

if ($user = search_user_email($email, $users)) {
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: /210992-yeticave/index.php");
    }
}




