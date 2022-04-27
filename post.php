<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

$user_name = 'Никита Шишкин';

if (isset($_GET['id']) && check_exist_post($con, $_GET['id'])) {
    $content = get_content_post($con, $_GET['id']);

    $all_hashtags = get_all_hashtags_post($con, $_GET['id']);

    $name_and_avatar = get_name_and_avatar($con, $_SESSION['user']['login']);
    $is_auth = 1;

    $user_id = get_user_id($con, $_GET['id']);

    $user_posts = get_user_posts($con, $user_id[0]['author_id']);
    $user_subscribers = get_user_subscribers($con, $user_id[0]['author_id']);

    $comments = get_post_comments($con, $_GET['id']);

    $page_content = include_template('post-content.php', ['content' => $content[0], 'user_posts' => $user_posts, 'user_subscribers' => $user_subscribers, 'user_id' => $user_id[0]['id'], 'comments' => $comments, 'hashtags' => $all_hashtags]);
    $layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $user_name, 'is_auth' => $is_auth, 'avatar' => $name_and_avatar[0]['avatar'], 'url' => $current_url]);
    print($layout_content);
} else {
    $page_content = include_template('404-error.php');
}

