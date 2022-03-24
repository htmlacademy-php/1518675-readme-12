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
    $result_content = mysqli_query($db, "SELECT p.id, author_id, counter, type_post, login, content, avatar, img, site, caption FROM posts p JOIN users u ON p.author_id = u.id ORDER BY counter ASC");
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
    $stmt->prepare("SELECT p.id, counter, content, img, site, caption, avatar, type_post, login, author_quote FROM posts p JOIN users u ON p.author_id = u.id WHERE p.id = ? LIMIT 1");
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
 * @param string $db Ссылка на базу данных
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
 * @param string $db Ссылка на базу данных
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

/**
 * Делает mySQL-запрос к базе данных информации от юзера
 *
 * Примеры использования:
 * get_user_data($id);
 *
 * @param string $db Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_user_data($db, $login)
{
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Делает mySQL-запрос к базе данных для получения имении и аватара
 *
 * Примеры использования:
 * get_name_and_avatar($db, $login);
 *
 * @param string $db Ссылка на базу данных
 *
 * @return Возвращает массив с типами данных
 */
function get_name_and_avatar($db, $login)
{
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT login, avatar FROM users WHERE login = ?");
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


/**
 * Функцию для получения значений из POST-запроса
 *
 * Примеры использования:
 * get_post_value($name);
 *
 * @param string $text наименование значения
 *
 * @return Возвращает название поля либо пустую строку
 */
function get_post_value($name)
{
    return $_POST[$name] ?? "";
}

/**
 * Функцию для проверки длины поля
 *
 * Примеры использования:
 * validate_length($text, 20, 100);
 *
 * @param string $text наименование значения
 * @param string $min минимальное значение строки
 * @param string $max максимальное значение строки
 *
 * @return Возвращает название поля либо пустую строку
 */
function validate_length($name, $min, $max)
{
    $len = strlen($_POST[$name]);

    if ($len < $min or $len > $max) {
        return 'Значение должно быть от $min до $max символов';
    }
}

/**
 * Функция для проверки длины поля
 *
 * Примеры использования:
 * validate_filled($name);
 *
 * @param string $name наименование значения
 *
 * @return Возвращает название поля либо пустую строку
 */
function validate_filled($name) {
    if (empty($_POST[$name])) {
        return "Это поле должно быть заполнено";
    }
}

/**
 * Функция для полнотекстового поиска
 *
 * Примеры использования:
 * search_text($text);
 *
 * @param string $text набранный текст
 *
 * @return Возвращает определённый пост, в котором есть совпадение
 */
function search_by_text($db, $text) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT * FROM posts p LEFT JOIN users u ON p.author_id = u.id WHERE MATCH(caption, content) AGAINST(?)");
    $stmt->bind_param('s', $text);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция для получения всех постов юзера
 *
 * Примеры использования:
 * search_text($text);
 *
 * @param string $text набранный текст
 *
 * @return Возвращает определённый пост, в котором есть совпадение
 */
function get_posts_with_content($db, $id) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT * FROM posts p LEFT JOIN users u ON u.id = p.author_id WHERE author_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция для подписки пользователя
 *
 * Примеры использования:
 * subscribe_user($db, 6, 2);
 *
 * @param string $id номер id
 */
function subscribe_user($db, $id_user, $id_sub) {
    $stmt = $db->stmt_init();
    $stmt->prepare("INSERT INTO subscribes(user_id, user_subscribed) VALUES (?, ?)");
    $stmt->bind_param('ii', $id_user, $id_sub);
    $stmt->execute();
}

/**
 * Функция проверки, подписан ли пользователь
 *
 * Примеры использования:
 * is_subscribed($db, 6, 2);
 *
 * @param string $id номер id
 */
function is_subscribed($db, $id_user, $id_sub) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT user_id, user_subscribed FROM subscribes WHERE user_id = ? AND user_subscribed = ?");
    $stmt->bind_param('ii', $id_user, $id_sub);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}


/**
 * Функция удаляет запись из таблицы subscribed
 *
 * Примеры использования:
 * unsubscribe($db, 6, 2);
 *
 * @param string $id номер id
 */
function unsubscribe($db, $id_user, $id_sub) {
    $stmt = $db->stmt_init();
    $stmt->prepare("DELETE FROM subscribes WHERE user_id = ? AND user_subscribed = ?");
    $stmt->bind_param('ii', $id_user, $id_sub);
    $stmt->execute();
}

/**
 * Функция ставит лайк посту
 *
 * Примеры использования:
 * like_post($db, 6, 2);
 *
 * @param string $id номер id
 */
function like_post($db, $id_user, $id_post) {
    $stmt = $db->stmt_init();
    $stmt->prepare("INSERT INTO likes(user_id, post_id) VALUES (?, ?)");
    $stmt->bind_param('ii', $id_user, $id_post);
    $stmt->execute();
}

/**
 * Функция определяет количество лайков у поста
 * Примеры использования:
 * get_likes_count($db, 2);
 *
 * @param string $id номер id
 */
function get_likes_count($db, $id_post) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT COUNT(*) FROM likes WHERE post_id = ?");
    $stmt->bind_param('i', $id_post);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция добавляет комментарий к посту
 *
 * Примеры использования:
 * like_post($db, 6, 2);
 *
 * @param string $id номер id
 */
function create_comment($db, $id_user, $id_post, $text) {
    $stmt = $db->stmt_init();
    $stmt->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param('iis', $id_user, $id_post, $text);
    $stmt->execute();
}

/**
 * Функция убирает лишние пробелы у текстового поля и проверяет длину
 *
 * Примеры использования:
 * validate_comment($text);
 *
 * @param string $text текст
 */
function validate_comment($text) {
    $len = strlen(trim($_POST[$text]));

    if ($len < 5) {
        return 'Значение должно быть не меньше 4 символов';
    }
}

/**
 * Функция делают запрос ко всем комментариями поста
 * Примеры использования:
 * get_post_comments($db, 2);
 *
 * @param string $id номер id
 */
function get_post_comments($db, $id_post) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT avatar, content, c.dt_add, login, c.post_id FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = ?");
    $stmt->bind_param('i', $id_post);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция делают запрос ко всем постам, на которые пользователь подписан
 * Примеры использования:
 * get_feed_posts($db, 2);
 *
 * @param string $id номер id
 */
function get_feed_posts($db, $id_user) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT p.id, author_id, author_quote, counter, type_post, login, content, avatar, img, site, caption FROM posts p JOIN users u ON p.author_id = u.id JOIN subscribes s ON s.user_id = p.author_id WHERE s.user_subscribed = ? ORDER BY counter ASC");
    $stmt->bind_param('i', $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
