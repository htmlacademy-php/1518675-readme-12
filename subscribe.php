<?php

require_once 'config.php';
require_once 'utils.php';

require 'vendor/autoload.php';

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

if (isset($_SESSION)) {
  if (is_subscribed($con, $_POST['user-id'], $_SESSION['user']['id'])) {
    unsubscribe($con, $_POST['user-id'], $_SESSION['user']['id']);
    header("Location: /profile.php?id=" . $_POST['user-id']);
  } else {
    subscribe_user($con, $_POST['user-id'], $_SESSION['user']['id']);

    $sub = get_login($con, $_POST['user-id']);

    $text = 'Здравствуйте, ' . $sub[0]['login'] . '. На вас подписался новый пользователь ' . $_SESSION['user']['login'] . '. Вот ссылка на его профиль: ' . 'https://readme/profile.php?id=' . $_SESSION['user']['id'];

    $message = new Email();
    $message->to('gladosq@gmail.com');
    $message->from('gladoratorx@yandex.com');
    $message->subject('У вас новый подписчик');
    $message->text($text);

    $dsn = 'smtp://gladoratorx@yandex.ru:pzzfqcltmwfsxrxi@smtp.yandex.ru:465?encryption=tls&auth_mode=login';
    $transport = Transport::fromDsn($dsn);

    $mailer = new Mailer($transport);
    $mailer->send($message);

    header("Location: /profile.php?id=" . $_POST['user-id']);
  }
}
