USE readme;

-- Добавляем данные в таблицу types согласно ТЗ
INSERT INTO types (name, icon) VALUES ('Текст', 'text');
INSERT INTO types (name, icon) VALUES ('Цитата', 'quote');
INSERT INTO types (name, icon) VALUES ('Картинка', 'photo');
INSERT INTO types (name, icon) VALUES ('Видео', 'video');
INSERT INTO types (name, icon) VALUES ('Ссылка', 'link');

-- Добавляем в таблицу users несколько пользователей
INSERT INTO users (dt_add, email, password, avatar) VALUES ('01.08.21', 'my-mail@mail.ru', 'password367', 'avatar-3.png');
INSERT INTO users (dt_add, email, password, avatar) VALUES ('24.05.21', 'testg@gmail.ru', '000091', 'avatarochka.png');
INSERT INTO users (dt_add, email, password, avatar) VALUES ('26.06.21', 'komar@gmail.ru', '1234', 'ava3000.png');

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

-- Придумываем несколько комментариев к разным постам
