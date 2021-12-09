<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

if (isset($_GET['id']) && check_exist_post($con, $_GET['id'])) {
    $content = get_content_post($con, $_GET['id']);

    $user_id = get_user_id($con, $_GET['id']);

    $user_posts = get_user_posts($con, $user_id[0]['author_id']);
    $user_subscribers = get_user_subscribers($con, $user_id[0]['author_id']);

    $page_content = include_template('post-content.php', ['content' => $content, 'user_posts' => $user_posts, 'user_subscribers' => $user_subscribers]);
    print($page_content);
} else {
    header('HTTP/1.1 404 not found');
}

