<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

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


$is_auth = rand(0, 1);

$user_name = 'Никита Шишкин';

define('TEXT_LIMIT', 300);

$page_content = include_template('main.php', ['posts' => $posts_list]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);

?>
