CREATE DATABASE readme
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

CREATE TABLE readme.users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	email VARCHAR(128) NOT NULL UNIQUE,
	password CHAR(64) NOT NULL,
	avatar VARCHAR(128)
);

CREATE TABLE readme.posts (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	caption VARCHAR(128),
	content TEXT(1000),
	autor_q VARCHAR(128),
	img VARCHAR(128) NOT NULL,
	video VARCHAR(128),
	site VARCHAR(128),
	counter INT,
	autor_id INT,
	CONSTRAINT autor_post_fk
	FOREIGN KEY (autor_id) REFERENCES readme.users (id)
	-- Внешний ключ: тип контента
	-- Внешний ключ: хештеги
);

CREATE TABLE readme.comments (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	autor_id INT,
	content_id INT,
	CONSTRAINT autor_comment_fk
	FOREIGN KEY (autor_id) REFERENCES readme.users (id),
	CONSTRAINT content_id_fk
	FOREIGN KEY (content_id) REFERENCES readme.posts (id)
);

CREATE TABLE readme.likes (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	post_id INT,
	CONSTRAINT user_like_fk
	FOREIGN KEY (user_id) REFERENCES readme.users (id),
	CONSTRAINT post_id_fk
	FOREIGN KEY (post_id) REFERENCES readme.posts (id)
);

CREATE TABLE readme.subscibes (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	user_subscribed INT,
	CONSTRAINT user_subscribe_fk
	FOREIGN KEY (user_id) REFERENCES readme.users (id),
	CONSTRAINT user_on_subscribe_fk
	FOREIGN KEY (user_subscribed) REFERENCES readme.users (id)
);

CREATE TABLE readme.messages (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	content TEXT(1000),
	user_message INT,
	user_recipient INT,
	CONSTRAINT user_message_fk
	FOREIGN KEY (user_message) REFERENCES readme.users (id),
	CONSTRAINT user_recipient_fk
	FOREIGN KEY (user_recipient) REFERENCES readme.users (id)
);

CREATE TABLE readme.hashtags (
	id INT AUTO_INCREMENT PRIMARY KEY,
	hashtag VARCHAR(128)
);

CREATE TABLE readme.types (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(128)
);

CREATE TABLE readme.auth (
	id INT AUTO_INCREMENT PRIMARY KEY,
	role VARCHAR(128)
)