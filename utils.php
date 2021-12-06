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

/**
 * Возвращает тип данных в формате string
 *
 * Примеры использования:
 * get_type_db($text);
 *
 * @param string $text Тип документа
 *
 * @return Возвращает тип поста в формате string
 */
function get_type_db($type)
{
    switch($type)
    {
        case 'text':
        return 1;
        case 'quote':
        return 2;
        case 'photo':
        return 3;
        case 'video':
        return 4;
        case 'link':
        return 5;
        default:
        return 'empty';
    }
};

/**
 * Делает mySQL-запрос к базе данных для получения списка постов определённого типа, объединённых
 * с пользователями и отсортированный по популярности
 *
 * Примеры использования:
 * get_filtered_posts($db);
 *
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_filtered_posts($db, $filter)
{
    $result_content = mysqli_query($db, "SELECT p.id, counter, type_post, login, content, avatar, img, site, caption FROM posts p JOIN users u ON p.author_id = u.id AND type_post ='" . $filter . "' ORDER BY counter ASC");
    return $rows_content = mysqli_fetch_all($result_content, MYSQLI_ASSOC);
}

/**
 * Делает mySQL-запрос к базе данных для получения поста с нужным id
 *
 * Примеры использования:
 * get_post_id($_GET['id']);
 *
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_content_post($db, $id)
{
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT p.id, counter, content, img, site, caption, avatar, type_post, login, author_quote FROM posts p JOIN users u ON p.author_id = u.id WHERE p.id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Делает mySQL-запрос к базе данных для получения всех публикаций юзера с нужным id
 *
 * Примеры использования:
 * get_all_posts($_GET['id']);
 *
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_user_posts($db, $id)
{
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT count(*) FROM posts WHERE author_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_row($result);
}

/**
 * Делает mySQL-запрос к базе данных для получения всех подписчиков юзера
 *
 * Примеры использования:
 * get_all_subscribers($_GET['id']);
 *
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_user_subscribers($db, $id)
{
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT count(*) FROM subscribes WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_row($result);
}

/**
 * Делает mySQL-запрос к базе данных для получения id юзера по id поста
 *
 * Примеры использования:
 * get_user_id($_GET['id']);
 *
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_user_id($db, $id)
{
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT p.id, author_id FROM posts p JOIN users u ON p.author_id = u.id WHERE p.id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Делает mySQL-запрос к базе данных для проверки существующего поста
 *
 * Примеры использования:
 * check_exist_post($id);
 *
 * @param string $text Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function check_exist_post($db, $id)
{
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT id FROM posts WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

