<?php

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

/**
 * Обрезает переданный текст, если он больше заданного значения
 *
 * Примеры использования:
 * cut_long_text('Привет, я строка');
 *
 * @param string $text Данные в виде строки
 * @param int $text_limit Число, по которому обрезаем строку
 *
 * @return string Итоговый HTML
 */
function cut_long_text($text, $text_limit) {
    $text_size = mb_strlen($text);

    if ($text_size > $text_limit) {
        $words = explode(' ', $text);
        $words_count = 0;
        $index = 0;

        while ($words_count < $text_limit) {
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
 * get_posts_with_users($db, $filter);
 *
 * @param mysqli $db Ресурс соединения
 * @param string $filter Значение фильтра
 *
 * @return array Возвращает массив с типами данных
 */
function get_posts_with_users($db, $fiter_type_post, $filter, $limit, $offset)
{
    $filter = $filter === 'ASC' ? 'ASC' : 'DESC';

    $sql = "SELECT p.id, author_id, author_quote, counter, type_post, video, login, content, avatar, img, site, caption FROM posts p JOIN users u ON p.author_id = u.id ORDER BY " . $fiter_type_post . " " . $filter . " LIMIT " . $limit . " OFFSET " . $offset;

    $stmt = $db->stmt_init();
    $stmt->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Делает mySQL-запрос к базе данных со всеми возможными типами контента
 *
 * Примеры использования:
 * get_all_types($db);
 *
 * @param mysqli $db Ресурс соединения
 *
 * @return array Возвращает массив с типами данных
 */
function get_all_types($db) {
    $result_content = mysqli_query($db, "SELECT * FROM types");
    return $rows_content = mysqli_fetch_all($result_content, MYSQLI_ASSOC);
}

/**
 * Возвращает тип данных в формате string
 *
 * Примеры использования:
 * get_type(1);
 *
 * @param int $type_id Ссылка на id в базе данных
 *
 * @return string Возвращает тип поста
 */
function get_type($type_id) {
    switch ($type_id) {
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
 * get_type_db(text);
 *
 * @param string $type Тип документа
 *
 * @return string Возвращает тип поста
 */
function get_type_db($type) {
    switch ($type) {
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
 * get_filtered_posts($db, $filter);
 *
 * @param mysqli $db Ресурс соединения
 * @param string $filter Значение фильтра
 *
 * @return array Возвращает массив с типами данных
 */
function get_filtered_posts($db, $filter_type_post, $filter_order_by, $filter_asc, $limit, $offset) {
    if (empty($filter_type_post)) {
        $correct_value_filter = '';
    } else {
        $correct_value_filter = 'AND type_post = ' . $filter_type_post;
    }

    $sql = "SELECT p.id, author_quote, author_id, counter, type_post, video, login, content, avatar, img, site, caption FROM posts p JOIN users u ON p.author_id = u.id " . $correct_value_filter . " ORDER BY " . $filter_asc . " " . $filter_order_by . " LIMIT " . $limit . " OFFSET " . $offset;

    $result_content = mysqli_query($db, "SELECT p.id, author_quote, author_id, counter, type_post, video, login, content, avatar, img, site, caption FROM posts p JOIN users u ON p.author_id = u.id " . $correct_value_filter . " ORDER BY " . $filter_asc . " " . $filter_order_by . " LIMIT " . $limit . " OFFSET " . $offset);
    return $rows_content = mysqli_fetch_all($result_content, MYSQLI_ASSOC);
}

/**
 * Делает mySQL-запрос к базе данных для получения поста с нужным id
 *
 * Примеры использования:
 * get_post_id($db, 2);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор поста
 *
 * @return array Возвращает массив данными о посте
 */
function get_content_post($db, $id) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT p.id, counter, video, content, img, site, caption, avatar, type_post, login, author_quote FROM posts p JOIN users u ON p.author_id = u.id WHERE p.id = ? LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Делает mySQL-запрос к базе данных для получения всех публикаций юзера с нужным id
 *
 * Примеры использования:
 * get_all_posts($db, 4);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор юзера
 *
 * @return array Возвращает массив с типами данных
 */
function get_user_posts($db, $id) {
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
 * get_all_subscribers($db, $id);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор юзера
 *
 * @return array Возвращает массив с типами данных
 */
function get_user_subscribers($db, $id) {
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
 * get_user_id($db, 2);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор поста
 *
 * @return array Возвращает массив с типами данных
 */
function get_user_id($db, $id) {
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
 * check_exist_post($db, 6);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор поста
 *
 * @return array Возвращает массив с типами данных, если он есть, иначе — пустой массив
 */
function check_exist_post($db, $id) {
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
 * get_user_data($db, 'user500');
 *
 * @param mysqli $db Ресурс соединения
 * @param string $login Логин пользователя
 *
 * @return array Возвращает массив с типами данных
 */
function get_user_data($db, $login) {
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
 * @param mysqli $db Ресурс соединения
 * @param string $login Логин пользователя
 *
 * @return array Возвращает массив с типами данных
 */
function get_name_and_avatar($db, $login) {
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
 * @param string $name Наименование значения
 *
 * @return string Возвращает название поля либо пустую строку
 */
function get_post_value($name) {
    return $_POST[$name] ?? "";
}

/**
 * Функцию для проверки длины поля
 *
 * Примеры использования:
 * validate_length($text, 20, 100);
 *
 * @param string $text Наименование значения
 * @param string $min Минимальное значение строки
 * @param string $max Максимальное значение строки
 *
 * @return string Возвращает название поля либо пустую строку
 */
function validate_length($name, $min, $max) {
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
 * @param string $name Наименование значения
 *
 * @return string Возвращает название поля либо пустую строку
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
 * search_by_text($db, $text);
 *
 * @param mysqli $db Ресурс соединения
 * @param string $text набранный текст
 *
 * @return array Возвращает массив с содержанием поста, в котором есть совпадение, иначе — пустой массив
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
 * get_posts_with_content($db, 10);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор юзера
 *
 * @return array Возвращает массив с содержанием поста, в котором есть совпадение, иначе — пустой массив
 */
function get_posts_with_content($db, $id) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT p.id, p.dt_add, caption, content, author_quote, img, video, site, counter, author_id, type_post, u.dt_add, u.email, u.login, u.password, u.avatar FROM posts p LEFT JOIN users u ON u.id = p.author_id WHERE author_id = ?");
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
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 * @param int $id_sub Идентификатор юзера, на которого делается подписка
 */
function subscribe_user($db, $id_user, $id_sub) {
    $stmt = $db->stmt_init();
    $stmt->prepare("INSERT INTO subscribes(user_id, user_subscribed) VALUES (?, ?)");
    $stmt->bind_param('ii', $id_user, $id_sub);
    $stmt->execute();
}

/**
 * Функция проверки пользователя на наличие подписки
 *
 * Примеры использования:
 * is_subscribed($db, 6, 2);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 * @param int $id_sub Идентификатор юзера, проверка на которого делается
 *
 * @return array Возвращает массив с содержанием id юзера, если он подписан, иначе — пустой массив
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
 * Функция удаляет пользователя из подписанных
 *
 * Примеры использования:
 * unsubscribe($db, 6, 2);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 * @param int $id_sub Идентификатор юзера, от которого он хочет отписаться
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
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 * @param int $id_post Идентификатор поста, которому ставится лайк
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
 * @param mysqli $db Ресурс соединения
 * @param int $id_post Идентификатор поста, у которого определяется количество лайков
 *
 * @return array Возвращает массив с числом лайков
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
 * create_comment($db, 6, 2);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 * @param int $id_post Идентификатор поста
 * @param string $text Текст комментария
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
 *
 * @return string Возвращает строку с ошибкой, если строка меньше 4 символов
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
 * @param mysqli $db Ресурс соединения
 * @param int $id_post Идентификатор поста
 *
 * @return array Возвращает массив со всеми комментариями поста
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
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 *
 * @return array Возвращает массив с постами
 */
function get_feed_posts($db, $id_user) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT p.id, author_id, author_quote, counter, type_post, login, content, avatar, img, site, caption, video FROM posts p JOIN users u ON p.author_id = u.id JOIN subscribes s ON s.user_id = p.author_id WHERE s.user_subscribed = ? ORDER BY counter ASC");
    $stmt->bind_param('i', $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция берёт логин юзера для отправки email при подписке
 *
 * Примеры использования:
 * get_login($db, 2);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 *
 * @return array Возвращает массив с логином юзера
 */
function get_login($db, $id_user) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT u.login, u.email FROM subscribes s INNER JOIN users u ON s.user_id = u.id WHERE s.user_id = ? LIMIT 1");
    $stmt->bind_param('i', $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция берёт список юзеров, кому нужно отправить уведомление о новом посте
 *
 * Примеры использования:
 * get_subscribers_list($db, 6);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id_user Идентификатор юзера
 *
 * @return array Возвращает массив со списком юзеров
 */
function get_subscribers_list($db, $id_user) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT s.user_id, s.user_subscribed, u.id, u.login, u.email FROM subscribes s INNER JOIN users u ON s.user_id = u.id WHERE s.user_subscribed = ?");
    $stmt->bind_param('i', $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция делает email-рассылку пользователям
 *
 * Примеры использования:
 * send_mail($to, $from, $text_content);
 *
 * @param string $to Email-адрес получателя
 * @param string $from Email-адрес отправителя
 * @param string $text_content Содержимое email
 */
function send_mail($to, $title_content, $text_content) {
    $message = new Email();
    $message->to($to);
    $message->from('gladoratorx@yandex.com');
    $message->subject($title_content);
    $message->text($text_content);

    $dsn = 'smtp://gladoratorx@yandex.ru:мой_токен@smtp.yandex.ru:465?encryption=tls&auth_mode=login';
    $transport = Transport::fromDsn($dsn);

    $mailer = new Mailer($transport);
    $mailer->send($message);
}

/**
 * Функция принимает хештеги в виде строки, форматирует их и возвращает в виду массива
 *
 * Примеры использования:
 * format_hashtags($text);
 *
 * @param string $text Список хештегов
 *
 * @return array Возвращает массив со списком хештегов
 */
function format_hashtags($text) {
    $words = explode(' ', $text);

    $correct_hashtags = [];

    foreach($words as $word) {
        if (mb_strlen($word) >= 2) {
            if ($word[0] === '#') {
                array_push($correct_hashtags, $word);
            } else {

                $word = '#' . $word;
                array_push($correct_hashtags, $word);
            }
        }
    }

    return $correct_hashtags;
}

/**
 * Функция делают запрос по хештегу и проверяет, есть ли такой в базе
 * Примеры использования:
 * check_hashtag($db, $text);
 *
 * @param mysqli $db Ресурс соединения
 * @param string $text Хештег
 *
 * @return array Возвращает массив с найденным хештегом, иначе — пустой массив
 */
function check_hashtag($db, $text) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT hashtag FROM hashtags WHERE hashtag = ?");
    $stmt->bind_param('s', $text);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция берёт id последнего поста юзера
 * Примеры использования:
 * get_last_post_id($db, 2);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор поста
 *
 * @return array Возвращает массив с найденным последним постом, иначе — пустой массив
 */
function get_last_post_id($db, $id) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT id, author_id, caption, dt_add FROM posts WHERE author_id = ? ORDER BY dt_add DESC LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция берёт id хештега
 * Примеры использования:
 * get_hashtag_id($db, $text);
 *
 * @param mysqli $db Ресурс соединения
 * @param string $text Хештег
 *
 * @return array Возвращает массив с найденным id хештега, иначе — пустой массив
 */
function get_hashtag_id($db, $text) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT id, hashtag FROM hashtags WHERE hashtag = ?");
    $stmt->bind_param('s', $text);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция берёт все хештеги поста
 * Примеры использования:
 * get_all_hashtags_post($db, $id);
 *
 * @param mysqli $db Ресурс соединения
 * @param int $id Идентификатор поста
 *
 * @return array Возвращает массив со всеми хештегами поста
 */
function get_all_hashtags_post($db, $id) {
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT post_id, hashtag_id, h.hashtag FROM hashtags_posts INNER JOIN hashtags h ON h.id = hashtags_posts.hashtag_id WHERE post_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $rows_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция берёт последний id из таблицы posts
 * Примеры использования:
 * get_posts_last_id($db);
 *
 * @param mysqli $db Ресурс соединения
 *
 * @return array Возвращает массив с id последнего поста
 */
function get_posts_last_id($db) {
    $result_content = mysqli_query($db, "SELECT max(id) FROM posts");

    return $rows_content = mysqli_fetch_all($result_content, MYSQLI_ASSOC);
}
