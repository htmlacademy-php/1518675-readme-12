<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

$types_list = get_all_types($con);
$posts_list = get_posts_with_users($con);

$is_auth = rand(0, 1);

$user_name = 'Никита Шишкин';

define('TEXT_LIMIT', 300);

$pageContent = include_template('main.php', ['posts' => $posts_list]);
$layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => $user_name, 'is_auth' => $is_auth]);

print($layoutContent);

?>
