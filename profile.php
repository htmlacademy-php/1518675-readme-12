<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

$is_auth = 1;
$name_and_avatar = get_name_and_avatar($con, $_SESSION['user']['login']);

$posts = get_posts_with_content($con, $_GET['id']);
$user_subscribers = get_user_subscribers($con, $_GET['id']);

if (isset($_GET['filter'])) {
    $current_filter = $_GET['filter'];
} else {
    $current_filter = 'posts';
}

if (!isset($_SESSION['user'])) {
    header("Location: /index.php");
    exit();
} else {
    $page_content = include_template('profile-content.php', ['posts' => $posts, 'subscribers' => $user_subscribers[0], 'user_id' => $_GET['id'], 'filter' => $current_filter]);
    $layout_content = include_template('layout.php', ['content' => $page_content, 'is_auth' => $is_auth, 'title' => $name_and_avatar[0]['login'], 'avatar' => $name_and_avatar[0]['avatar']]);
    print($layout_content);
}
