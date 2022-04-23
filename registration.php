<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

$rules = [
    'email' => function() {
        return validate_filled('email');
    },
    'login' => function() {
        return validate_filled('login');
    },
    'password' => function() {
        return validate_filled('password');
    },
    'password-repeat' => function() {
        return validate_filled('password-repeat');
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


if (count($errors)) {
    print_r($errors);
} else {
    if (!empty($_POST)) {
        if ($_POST['password'] === $_POST['password-repeat']) {
            $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $email = $_POST['email'];
            $login = $_POST['login'];

            print_r($_FILES);


            $file_name = $_FILES['userpic-file']['name'];
            $file_path = __DIR__ . '/uploads/';
            $file_url = '/uploads/' . $file_name;

            move_uploaded_file($_FILES['userpic-file']['tmp_name'], $file_path . $file_name);


            $stmt = $con->stmt_init();
            $stmt->prepare("INSERT INTO users(email, login, password, avatar) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $email, $login, $pass_hash, $file_url);
            $stmt->execute();

            header('Location: /index.php');
        } else {
            $errors['password'] = 'Пароли не совпадают';
        }
    }
}

$is_auth = 1;
$user_name = 'Никита Шишкин';

$page_content = include_template('registration-site.php', ['errors' => $errors]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'is_auth' => $is_auth, 'title' => $user_name, 'registration' => true]);

print($layout_content);
