<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

if (!isset($_SESSION['user'])) {
    header("Location: /index.php");
    exit();
}

if (isset($_GET['filter'])) {
    $filter_value = $_GET['filter'];

    if ($filter_value === 'all') {
        $posts_list = get_posts_with_users($con);
    } else {
       $posts_list = get_filtered_posts($con, get_type_db($filter_value));
    }
} else {
    $posts_list = get_posts_with_users($con);
}

$types_list = get_all_types($con);

$name_and_avatar = get_name_and_avatar($con, $_SESSION['user']['login']);

$is_auth = 1;

define('TEXT_LIMIT', 300);

print_r($posts_list[0]);

$page_content = include_template('main.php', ['posts' => $posts_list]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $name_and_avatar[0]['login'], 'is_auth' => $is_auth, 'avatar' => $name_and_avatar[0]['avatar']]);

print($layout_content);

?>
