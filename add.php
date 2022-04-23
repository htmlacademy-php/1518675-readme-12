<?php

require('utils.php');
require('helpers.php');
require_once('config.php');

$is_auth = 1;

$user_name = 'Никита Шишкин';

$rules = [
    'photo-heading' => function() {
        return validate_filled('photo-heading');
    },
    'photo-url' => function() {
        return validate_filled('photo-url');

    },
    'photo-tags' => function() {
        return validate_filled('photo-tags');
    }
];

$errors = [];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule();
        }
    }
    $errors = array_filter($errors);
}

if (count($errors)) {
    print_r($errors);
} else {
    if (!empty($_POST)) {
        if ($_POST['post-type'] == 'photo') {
            if (isset($_FILES['userpic-file-photo'])) {

                $file_name = $_FILES['userpic-file-photo']['name'];
                $file_path = __DIR__ . '/uploads/';
                $file_url = '/uploads/' . $file_name;

                move_uploaded_file($_FILES['userpic-file-photo']['tmp_name'], $file_path . $file_name);

                $caption = $_POST['photo-heading'];
                $link = $_POST['photo-url'];
                $tags = $_POST['photo-tags'];
                $content = '';
                $type_post = get_type_db($_POST['post-type']);

                $stmt = $con->stmt_init();
                $stmt->prepare("INSERT INTO posts(caption, img, content, type_post, author_id) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('sssii', $caption, $file_url, $content, $type_post, $_SESSION['user']['id']);
                $stmt->execute();

                // Hashtahgs
                $hashtags = format_hashtags($tags);
                foreach($hashtags as $hashtag) {
                    if (empty(check_hashtag($con, $hashtag))) {
                        $stmt = $con->stmt_init();
                        $stmt->prepare("INSERT INTO hashtags(hashtag) VALUES (?)");
                        $stmt->bind_param('s', $hashtag);
                        $stmt->execute();
                    }

                    $post_id = get_last_post_id($con, $_SESSION['user']['id']);
                    $hashtag_id = get_hashtag_id($con, $hashtag);

                    $stmt = $con->stmt_init();
                    $stmt->prepare("INSERT INTO hashtags_posts(post_id, hashtag_id) VALUES (?, ?)");
                    $stmt->bind_param('ii', $post_id[0]['id'], $hashtag_id[0]['id']);
                    $stmt->execute();
                }

                header('Location: /feed.php');

            }

        } elseif($_POST['post-type'] == 'video') {

            header('Location: /feed.php');

        } elseif($_POST['post-type'] == 'text') {
            $caption = $_POST['text-heading'];
            $text = $_POST['post-text'];
            $type_post = get_type_db($_POST['post-type']);

            $stmt = $con->stmt_init();
            $stmt->prepare("INSERT INTO posts(caption, content, type_post, author_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('sssii', $caption, $content, $type_post, $_SESSION['user']['id']);
            $stmt->execute();

        } elseif($_POST['post-type'] == 'quote') {

            $caption = $_POST['quote-heading'];
            $text = $_POST['cite-text'];
            $quote = $_POST['quote-author'];
            $type_post = get_type_db($_POST['post-type']);

            $stmt = $con->stmt_init();
            $stmt->prepare("INSERT INTO posts(caption, content, author_quote, type_post, author_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssii', $caption, $text, $author_quote, $type_post, $_SESSION['user']['id']);
            $stmt->execute();

        } elseif($_POST['post-type'] == 'link') {

            header('Location: /feed.php');
        }
    }
}


$page_content = include_template('adding-post.php', ['errors' => $errors]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $user_name, 'is_auth' => $is_auth]);
print($layout_content);

?>
