CREATE DATABASE readme
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE readme;

CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	email VARCHAR(128) NOT NULL UNIQUE,
	login VARCHAR(128) NOT NULL UNIQUE,
	password CHAR(64) NOT NULL,
	avatar VARCHAR(128)
);

CREATE TABLE types (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(128)
);

CREATE TABLE hashtags (
	id INT AUTO_INCREMENT PRIMARY KEY,
	hashtag VARCHAR(128)
);

CREATE TABLE posts (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	caption VARCHAR(128) NOT NULL,
	content TEXT(1000),
	author_quote VARCHAR(128),
	img VARCHAR(128),
	video VARCHAR(128),
	site VARCHAR(128),
	counter INT,
	author_id INT,
	type_post INT,
	CONSTRAINT author_post_fk
	FOREIGN KEY (author_id) REFERENCES users (id),
	CONSTRAINT type_posk_fk
	FOREIGN KEY (type_post) REFERENCES types (id)
);

CREATE TABLE hashtags_posts (
	post_id INT NOT NULL,
	hashtag_id INT NOT NULL,
	CONSTRAINT post_hash_fk
	FOREIGN KEY (post_id) REFERENCES posts (id),
	CONSTRAINT hashtags_posts_fk
	FOREIGN KEY (hashtag_id) REFERENCES hashtags (id)
);

CREATE TABLE comments (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	user_id INT,
	post_id INT,
	content TEXT(1000),
	CONSTRAINT user_comment_fk
	FOREIGN KEY (user_id) REFERENCES users (id),
	CONSTRAINT post_comment_fk
	FOREIGN KEY (post_id) REFERENCES posts (id)
);

CREATE TABLE likes (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	post_id INT,
	CONSTRAINT user_like_fk
	FOREIGN KEY (user_id) REFERENCES users (id),
	CONSTRAINT post_id_fk
	FOREIGN KEY (post_id) REFERENCES posts (id)
);

CREATE TABLE subscribes (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	user_subscribed INT,
	CONSTRAINT user_subscribe_fk
	FOREIGN KEY (user_id) REFERENCES users (id),
	CONSTRAINT user_on_subscribe_fk
	FOREIGN KEY (user_subscribed) REFERENCES users (id)
);

CREATE TABLE messages (
	id INT AUTO_INCREMENT PRIMARY KEY,
	dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	content TEXT(1000),
	user_message INT,
	user_recipient INT,
	CONSTRAINT user_message_fk
	FOREIGN KEY (user_message) REFERENCES users (id),
	CONSTRAINT user_recipient_fk
	FOREIGN KEY (user_recipient) REFERENCES users (id)
);
