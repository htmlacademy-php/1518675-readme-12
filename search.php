<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

$is_auth = 1;
$name_and_avatar = get_name_and_avatar($con, $_SESSION['user']['login']);

if (isset($_GET['header-search'])) {

    $posts = search_by_text($con, $_GET['header-search']);

    if (empty($posts)) {
        $page_content = include_template('search-no-results.php', []);
        $layout_content = include_template('layout.php', ['content' => $page_content, 'is_auth' => $is_auth, 'title' => $name_and_avatar[0]['login'], 'avatar' => $name_and_avatar[0]['avatar']]);
        print($layout_content);
    } else {
        $page_content = include_template('search-content.php', ['posts' => $posts]);
        $layout_content = include_template('layout.php', ['content' => $page_content, 'is_auth' => $is_auth, 'title' => $name_and_avatar[0]['login'], 'avatar' => $name_and_avatar[0]['avatar']]);
        print($layout_content);
    }
}
