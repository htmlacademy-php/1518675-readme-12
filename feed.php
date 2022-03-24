<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

if (!isset($_SESSION['user'])) {
    header("Location: /index.php");
    exit();
} else {
    $posts_list = get_feed_posts($con, $_SESSION['user']['id']);

    $name_and_avatar = get_name_and_avatar($con, $_SESSION['user']['login']);
    $is_auth = 1;

    $current_url = 'feed';

    $page_content = include_template('feed-content.php', ['posts' => $posts_list]);
    $layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $name_and_avatar[0]['login'], 'is_auth' => $is_auth, 'avatar' => $name_and_avatar[0]['avatar'], 'url' => $current_url]);
    print($layout_content);
}
