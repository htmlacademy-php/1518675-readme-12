<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

$_SESSION = [];

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
    $result = get_login_and_pass($con, $login);

    if ($result) {
        if (password_verify($_POST['password'], $result[0]['password'])) {
            $_SESSION['user']['login'] = $result[0]['login'];
            $_SESSION['user']['password'] = $result[0]['password'];
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
