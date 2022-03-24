<?php

require_once('config.php');
require_once('utils.php');

if (isset($_SESSION)) {
    if (is_subscribed($con, $_POST['user-id'], $_SESSION['user']['id'])) {
        unsubscribe($con, $_POST['user-id'], $_SESSION['user']['id']);
        header("Location: /profile.php?id=" . $_POST['user-id']);
    } else {
        subscribe_user($con, $_POST['user-id'], $_SESSION['user']['id']);
        header("Location: /profile.php?id=" . $_POST['user-id']);
    }
}
