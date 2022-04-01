<?php

require 'vendor/autoload.php';

require 'utils.php';
require 'helpers.php';
require_once 'config.php';

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

$is_auth = 1;

$user_name = 'Никита Шишкин';

$rules = [
  'photo-heading' => function () {
    return validate_filled('photo-heading');
  },
  'photo-url' => function () {
    return validate_filled('photo-url');

  },
  'photo-tags' => function () {
    return validate_filled('photo-tags');
  },
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
    $caption = $_POST['photo-heading'];
    $link = $_POST['photo-url'];
    $tags = $_POST['photo-tags'];

    $stmt = $con->stmt_init();
    $stmt->prepare("INSERT INTO posts(caption, site, content) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $caption, $link, $tags);
    $stmt->execute();

    $subscribers_list = get_subscribers_list($con, $_SESSION['user']['id']);

    foreach ($subscribers_list as $item) {
      $address = $item['email'];
      $title_content = 'Новая публикация от пользователя' . $_SESSION['user']['login'];
      $text_content = 'Здравствуйте, ' . $item['login'] . '. Пользователь ' . $_SESSION['user']['login'] . ' только что опубликовал новую запись „' . $caption . '“. Посмотрите её на странице пользователя: https://readme/profile.php?id=' . $_SESSION['user']['id'];

      send_mail($address, $title_content, $text_content);
    }
  }
}

$page_content = include_template('adding-post.php', ['errors' => $errors]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);

?>
