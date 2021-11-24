<?php

require('helpers.php');
require_once('config.php');


// Неработающее подготовленное выражение
// $statement_types = "SELECT * FROM category=?";
// $statement = $con->prepare($statement_types);
// $statement->bind_param('s', 'types');
// $statement->execute();
// Неработающее подготовленное выражение

$types_list = get_content($con, "SELECT * FROM types");
$posts_list = get_content($con, "SELECT p.id, counter, type_post, login, content, avatar FROM posts p JOIN users u ON p.author_id = u.id ORDER BY counter ASC");

$is_auth = rand(0, 1);

$user_name = 'Никита Шишкин';

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

/**
 * Делает mySQL-запрос к базе данных со всеми возможными типами контента
 *
 * Примеры использования:
 * get_types($db);
 * 
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_content ($db, $statement) {
  $result_content = mysqli_query($db, $statement);
  return $rows_content = mysqli_fetch_all($result_content, MYSQLI_ASSOC);
}

$pageContent = include_template('main.php', ['posts' => $posts_list]);
$layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => $user_name, 'is_auth' => $is_auth]);

print($layoutContent);
?>
