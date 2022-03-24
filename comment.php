<?php

require('utils.php');
require_once('config.php');

$rules = [
    'text-content' => function() {
        return validate_comment('text-content');
    },
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
        if (isset($_SESSION['user'])) {
            create_comment($con, $_SESSION['user']['id'], $_POST['id-post'], $_POST['text-content']);
            header("Location: /profile.php?id=" . $_POST['id-user']);
        }
    }
}
