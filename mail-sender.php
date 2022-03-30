<?php

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

require 'vendor/autoload.php';

$text = '';

$message = new Email();
$message->to('gladosq@gmail.com');
$message->from('gladoratorx@yandex.com');
$message->subject('Моя тема сообщения');
$message->text('Наконец-то Symfony Mailer заработал!');

$dsn = 'smtp://gladoratorx@yandex.ru:pzzfqcltmwfsxrxi@smtp.yandex.ru:465?encryption=tls&auth_mode=login';
$transport = Transport::fromDsn($dsn);

$mailer = new Mailer($transport);
$mailer->send($message);
