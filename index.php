<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

$rules = [
    'login' => function() {
        return validate_filled('login');
    },
    'password' => function() {
        return validate_filled('password');
    }
];

$errors = [];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
    }

    $errors = array_filter($errors);
}

if (!count($errors) and !empty($_POST)) {
    $login = $_POST['login'];
    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $result = get_user_data($con, $login);

    if ($result) {
        if (password_verify($_POST['password'], $result[0]['password'])) {
            $_SESSION['user']['id'] = $result[0]['id'];
            $_SESSION['user']['login'] = $result[0]['login'];
            $_SESSION['user']['password'] = $result[0]['password'];
            $_SESSION['user']['avatar'] = $result[0]['avatar'];
            header("Location: /feed.php");
        }
    }
}

if (isset($_SESSION['user'])) {
    header("Location: /feed.php");
    exit();
} else {
    $page_content = include_template('../main.php', []);
    print($page_content);
}
