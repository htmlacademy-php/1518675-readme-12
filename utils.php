<?php

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
function cut_long_text ($text, $text_limit)
{
    $text_size = mb_strlen($text);

    if ($text_size > $text_limit)
    {
        $words = explode(' ', $text);
        $words_count = 0;
        $index = 0;

        while ($words_count < $text_limit)
        {
            $words_count += strlen($words[$index]);
            $new_string_array[$index] = $words[$index];
            $index++;
        }

        $link = '<a class="post-text__more-link" href="#">Читать далее</a>';

        return $new_string = '<p>' . implode(' ', $new_string_array) . '...' . '</p>' . $link;
    }
return '<p>' . $text . '</p>';
}

/**
 * Делает mySQL-запрос к базе данных для получения списка постов, объединённых с пользователями и отсортированный по популярности
 *
 * Примеры использования:
 * get_posts_with_users($db);
 *
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_posts_with_users($db)
{
    $result_content = mysqli_query($db, "SELECT p.id, counter, type_post, login, content, avatar, img, site, caption FROM posts p JOIN users u ON p.author_id = u.id ORDER BY counter ASC");
    return $rows_content = mysqli_fetch_all($result_content, MYSQLI_ASSOC);
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
function get_all_types($db)
{
    $result_content = mysqli_query($db, "SELECT * FROM types");
    return $rows_content = mysqli_fetch_all($result_content, MYSQLI_ASSOC);
}

/**
 * Возвращает тип данных в формате string
 *
 * Примеры использования:
 * get_type($post['type_post']);
 *
 * @param number $type_id Ссылка на id в базе данных
 *
 * @return Возвращает тип поста в формате string
 */
function get_type($type_id)
{
    switch($type_id)
    {
        case 1:
        return 'text';
        case 2:
        return 'quote';
        case 3:
        return 'photo';
        case 4:
        return 'video';
        case 5:
        return 'link';
        default:
        return 'empty';
    }
};


