<?php

require_once('config.php');
require_once('utils.php');

if (isset($_SESSION)) {
    if (!empty(check_exist_post($con, $_POST['post-id']))) {
        like_post($con, $_SESSION['user']['id'], $_POST['post-id']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

