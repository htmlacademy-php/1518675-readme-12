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
                print_r($_FILES);
                $photo_url = $_FILES['userpic-file-photo']['name'];

                $caption = $_POST['photo-heading'];
                $link = $_POST['photo-url'];
                $tags = $_POST['photo-tags'];
                $content = '';
                $type_post = get_type_db($_POST['post-type']);

                $stmt = $con->stmt_init();
                $stmt->prepare("INSERT INTO posts(caption, img, content, type_post, author_id) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param('sssii', $caption, $link, $content, $type_post, $_SESSION['user']['id']);
                $stmt->execute();
            } elseif (isset($_POST['photo-url'])) {
                if (filter_var($_POST['photo-url'], FILTER_VALIDATE_URL)) {
                    $photo_url = $_POST['photo-url'];
                } else {
                    $errors['photo-url'] == 'invalid-url';
                }
            }
        } elseif($_POST['post-type'] == 'video') {

        } elseif($_POST['post-type'] == 'text') {
            $caption = $_POST['text-heading'];
            $text = $_POST['post-text'];
            $type_post = get_type_db($_POST['post-type']);

            $stmt = $con->stmt_init();
            $stmt->prepare("INSERT INTO posts(caption, content, type_post, author_id) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('sssii', $caption, $content, $type_post, $_SESSION['user']['id']);
            $stmt->execute();

        } elseif($_POST['post-type'] == 'quote') {
            print_r('<h1>work</h1>');

            $caption = $_POST['quote-heading'];
            $text = $_POST['cite-text'];
            $quote = $_POST['quote-author'];
            $type_post = get_type_db($_POST['post-type']);

            $stmt = $con->stmt_init();
            $stmt->prepare("INSERT INTO posts(caption, content, author_quote, type_post, author_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssii', $caption, $text, $author_quote, $type_post, $_SESSION['user']['id']);
            $stmt->execute();

        } elseif($_POST['post-type'] == 'link') {

        }

    }
}

$page_content = include_template('adding-post.php', ['errors' => $errors]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);

?>
