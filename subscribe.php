<?php

require 'vendor/autoload.php';

require_once 'config.php';
require_once 'utils.php';

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

if (isset($_SESSION)) {
  if (is_subscribed($con, $_POST['user-id'], $_SESSION['user']['id'])) {
    unsubscribe($con, $_POST['user-id'], $_SESSION['user']['id']);
    header("Location: /profile.php?id=" . $_POST['user-id']);
  } else {
    subscribe_user($con, $_POST['user-id'], $_SESSION['user']['id']);

    $title_content = 'У вас новый подписчик';

    $sub = get_login($con, $_POST['user-id']);

    $address = $sub[0]['email'];

    $text_content = 'Здравствуйте, ' . $sub[0]['login'] . '. На вас подписался новый пользователь ' . $_SESSION['user']['login'] . '. Вот ссылка на его профиль: ' . 'https://readme/profile.php?id=' . $_SESSION['user']['id'];

    send_mail($address, $title_content, $text_content);

    header("Location: /profile.php?id=" . $_POST['user-id']);
  }
}
