CREATE DATABASE yeticave;
USE yeticave;

CREATE TABLE category(
  id INT AUTO_INCREMENT PRIMARY KEY,
  category CHAR
);

CREATE TABLE lots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  name TEXT,
  description TEXT,
  image TEXT,
  cost INT,
  data_end DATE,
  cost_range INT,
  like_number INT
);

CREATE TABLE bet(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  user_price INT
);

CREATE TABLE user(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_reg DATE,
  email CHAR UNIQUE,
  name CHAR,
  password CHAR,
  avatar TEXT,
  contact TEXT
);

/* Связь id лота с именем автора */
SELECT l.id, date, l.name, description, image, cost, data_end, cost_range, like_number, u.name
FROM lots l JOIN user u ON l.id = u.email;

/* Связь названия лота с категорией - вопрос!!!! */
SELECT l.id, date, name, description, image, cost, data_end, cost_range, like_number, c.category
FROM lots l JOIN category c ON name = c.category;

/* Связь id ставки с именем пользователем */
SELECT b.id, date, user_price, u.name
FROM bet b JOIN user u ON b.id = u.id;

/* Связь id ставки с id лотом */
SELECT b.id, b.date, user_price, l.date, l.name, description, image, cost, data_end, cost_range, like_number
FROM bet b JOIN lots l ON b.id = l.id;

/* Добавление индексов */
CREATE INDEX c_category ON category(category);
CREATE INDEX c_user_price ON bet(user_price);
CREATE INDEX c_email ON user(email);
