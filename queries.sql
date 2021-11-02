USE readme;

-- Добавляем данные в таблицу types согласно ТЗ
INSERT INTO types (name, icon) VALUES ('Текст', 'text');
INSERT INTO types (name, icon) VALUES ('Цитата', 'quote');
INSERT INTO types (name, icon) VALUES ('Картинка', 'photo');
INSERT INTO types (name, icon) VALUES ('Видео', 'video');
INSERT INTO types (name, icon) VALUES ('Ссылка', 'link');

-- Добавляем в таблицу users несколько пользователей
INSERT INTO users (dt_add, email, login, password, avatar) VALUES ('01.08.21', 'my-mail@mail.ru', 'Marina', 'password367', 'avatar-3.png');
INSERT INTO users (dt_add, email, login, password, avatar) VALUES ('24.05.21', 'testg@gmail.ru', 'KHARN', '000091', 'avatarochka.png');
INSERT INTO users (dt_add, email, login, password, avatar) VALUES ('26.06.21', 'komar@gmail.ru', 'mindF', '1234', 'ava3000.png');

-- Добавляем в таблицу posts существующие посты
INSERT INTO posts (dt_add, autor_q, content, autor_id, type_post, counter) 
VALUES ('11.11.20', 'Неизвестный автор', 'Мы в жизни любим только раз, а после ищем лишь похожих', '1', '2', '0');
INSERT INTO posts (dt_add, caption, content, autor_id, type_post, counter) 
VALUES ('28.10.21', 'Игра престолов', 'Не могу дождаться начала финального сезона своего любимого сериала!', '2', '1', '0');
INSERT INTO posts (dt_add, caption, img, autor_id, type_post, counter) 
VALUES ('22.02.21', 'Наконец, обработал фотка!', 'picture-4.jpg', '3', '3', '0');
INSERT INTO posts (dt_add, caption, img, autor_id, type_post, counter) 
VALUES ('22.02.21', 'Моя мечта', 'picture-1.jpg', '1', '3', '0');
INSERT INTO posts (dt_add, caption, site, autor_id, type_post, counter) 
VALUES ('19.11.19', 'Лучшие курсы', 'https://htmlacademy.ru/', '2', '5', '0');

-- Добавляем случайное количество просмотров для постов
UPDATE posts SET counter = '250' WHERE id = '1';
UPDATE posts SET counter = '20' WHERE id = '2';
UPDATE posts SET counter = '86' WHERE id = '3';
UPDATE posts SET counter = '110' WHERE id = '4';
UPDATE posts SET counter = '165' WHERE id = '5';

-- Придумываем несколько комментариев к разным постам
INSERT INTO comments (dt_add, user_id, post_id, content) VALUES ('10.02.21', '2', '1', 'Хороший комментарий');
INSERT INTO comments (dt_add, user_id, post_id, content) VALUES ('29.04.21', '1', '1', 'Плохой комментарий');
INSERT INTO comments (dt_add, user_id, post_id, content) VALUES ('13.07.21', '2', '2', 'Очень плохой комментарий');

-- Получаем список постов с сортировкой по популярности (с именами авторов и типом контента)
SELECT p.id, counter, type_post, login FROM posts p JOIN users u ON p.autor_id = u.id ORDER BY counter ASC;

-- Получаем список постов для конкретного пользователя
SELECT autor_id, content FROM posts WHERE autor_id = '2';

-- Получаем список комментариев для одного поста (с логином пользователя)
SELECT content, login, post_id FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = '1';

-- Добавляем лайк к посту
INSERT INTO likes (user_id, post_id) VALUES ('1', '1');

-- Подписываемся на пользователя
INSERT INTO subscribes (user_id, user_subscribed) VALUES ('2', '1');

