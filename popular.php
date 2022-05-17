<?php

require('helpers.php');
require_once('config.php');
require_once('utils.php');

if (!isset($_SESSION['user'])) {
    header("Location: /index.php");
    exit();
}

define('LIMIT_OF_PAGE', 9);

$filter_order = 'ASC';
$filter_value = 'all';

$total_pages = 1;
$offset = 0;
$number_of_page = 1;

if (isset($_GET['page'])) {
    $number_of_page = $_GET['page'];
} else {
    $number_of_page = 1;
}

if (isset($_GET['order'])) {
    if ($_GET['order'] === 'date') {
        $filter_type_post = 'p.dt_add';
    } else {
        $filter_type_post = 'p.' . $_GET['order'];
    }
} else {
    $filter_type_post = 'counter';
}

if (isset($_GET['filter'])) {

    if ($_GET['filter'] === 'all') {
        $filter_value = '';
    } else {
        $filter_value = get_type_db($_GET['filter']);
    }

    $all_posts_number = count(get_filtered_posts($con, $filter_value, $filter_order, $filter_type_post, 1000, $offset));

    if ($all_posts_number > LIMIT_OF_PAGE) {
        $total_pages = ceil($all_posts_number / LIMIT_OF_PAGE);

        $offset = ($number_of_page - 1) * LIMIT_OF_PAGE;
    }

    $posts_list = get_filtered_posts($con, $filter_value, $filter_order, $filter_type_post, LIMIT_OF_PAGE, $offset);

} else {

    $filter_value = '';

    $all_posts_number = count(get_filtered_posts($con, $filter_value, $filter_order, $filter_type_post, 1000, $offset));

    if ($all_posts_number > LIMIT_OF_PAGE) {
        $total_pages = ceil($all_posts_number / LIMIT_OF_PAGE);

        $offset = ($number_of_page - 1) * LIMIT_OF_PAGE;
    }

    $posts_list = get_filtered_posts($con, $filter_value, $filter_order, $filter_type_post, LIMIT_OF_PAGE, $offset);
}

$types_list = get_all_types($con);

$name_and_avatar = get_name_and_avatar($con, $_SESSION['user']['login']);

$is_auth = 1;
$current_url = 'popular';

define('TEXT_LIMIT', 300);

$page_content = include_template('popular-content.php', ['posts' => $posts_list, 'total_pages' => $total_pages, 'current_page' => $number_of_page, 'sorting' => $filter_type_post]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $name_and_avatar[0]['login'], 'is_auth' => $is_auth, 'avatar' => $name_and_avatar[0]['avatar'], 'url' => $current_url]);
print($layout_content);

?>
