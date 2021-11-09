<?php

// Подключение к БД
$con = mysqli_connect('readme', 'root', '', 'readme');
// Установка кодировки
mysqli_set_charset($con, 'utf8');
// Формирование SQL-запроса
$sql_types = "SELECT * FROM types";
// Выполнение SQL-запроса (типы контента)
$result_types = mysqli_query($con, $sql_types);
// Преобразование результата в двумерный массив
$rows_types = mysqli_fetch_all($result_types, MYSQLI_ASSOC);

$sql_posts = "SELECT p.id, counter, type_post, login, content, avatar FROM posts p JOIN users u ON p.author_id = u.id ORDER BY counter ASC";
$result_posts = mysqli_query($con, $sql_posts);
$rows_posts = mysqli_fetch_all($result_posts, MYSQLI_ASSOC);

// print_r($rows_types);
print_r($rows_posts);


$is_auth = rand(0, 1);

$user_name = 'Никита Шишкин';

// $posts = [
//   [
//     'caption' => 'Цитата',
//     'type' => 'post-quote',
//     'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
//     'user' => 'Лариса',
//     'avatar' => 'userpic-larisa-small.jpg'
//   ],
//   [
//     'caption' => 'Игра престолов',
//     'type' => 'post-text',
//     'content' => 'Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала! Не могу дождаться начала финального сезона своего любимого сериала!',
//     'user' => 'Владик',
//     'avatar' => 'userpic.jpg'
//   ],
//   [
//     'caption' => 'Наконец, обработал фотки!',
//     'type' => 'post-photo',
//     'content' => 'rock-medium.jpg',
//     'user' => 'Виктор',
//     'avatar' => 'userpic-mark.jpg'
//   ],
//   [
//     'caption' => 'Моя мечта',
//     'type' => 'post-photo',
//     'content' => 'coast-medium.jpg',
//     'user' => 'Лариса',
//     'avatar' => 'userpic-larisa-small.jpg'
//   ],
//   [
//     'caption' => 'Лучшие курсы',
//     'type' => 'post-link',
//     'content' => 'www.htmlacademy.ru',
//     'user' => 'Владик',
//     'avatar' => 'userpic.jpg'
//   ]
// ];

define('TEXT_LIMIT', 300);

/**
 * Обрезает переданный текст, если он больше заданного значения
 *
 * Примеры использования:
 * cutLongText('Привет, я строка');
 *
 * @param string $text Данные в виде строки
 *
 * @return Возвращает обрезанную строку, если больше заданного значения, иначе просто возвращает исходные данные
 */
function cutLongText ($text, $textLimit) {
  $textSize = mb_strlen($text);

  if ($textSize > $textLimit) {
    $words = explode(' ', $text);

    $wordsCount = 0;
    $index = 0;

    while ($wordsCount < $textLimit) {
      $wordsCount += strlen($words[$index]);
      $newStringArray[$index] = $words[$index];
      $index++;
    }

    $link = '<a class="post-text__more-link" href="#">Читать далее</a>';

    return $newString = '<p>' . implode(' ', $newStringArray) . '...' . '</p>' . $link;
  }

  return '<p>' . $text . '</p>';
}

require('helpers.php');

$pageContent = include_template('main.php', ['posts' => $rows_posts]);
$layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => $user_name, 'is_auth' => $is_auth]);

print($layoutContent);
?>
