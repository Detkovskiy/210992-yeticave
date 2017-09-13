CREATE DATABASE yeticave;
USE yeticave;

CREATE TABLE category(
  id INT AUTO_INCREMENT PRIMARY KEY,
  category CHAR
);

CREATE TABLE lots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  winner_id INT,
  category_id INT,
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
  user_id INT,
  lot_id INT,
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

/* Связь объявления с именем автора по id*/
SELECT l.id, date, l.name, description, image, cost, data_end, cost_range, like_number, u.name
FROM lots l JOIN user u ON l.user_id = u.id;

/* Связь названия лота с категорией - вопрос!!!! */
SELECT l.id, date, name, description, image, cost, data_end, cost_range, like_number, c.category
FROM lots l JOIN category c ON l.category_id = c.id;

/* Связь id ставки с именем пользователем */
SELECT b.id, date, user_price, u.name
FROM bet b JOIN user u ON b.user_id = u.id;

/* Связь id ставки с id лотом */
SELECT b.id, b.date, user_price, l.date, l.name, description, image, cost, data_end, cost_range, like_number
FROM bet b JOIN lots l ON b.lot_id = l.id;

/* Добавление индексов */
CREATE INDEX i_category ON category(id);
CREATE INDEX i_category_id ON lots(category_id);

CREATE INDEX i_lot ON lots(id);
CREATE INDEX i_lot_id ON bet(lot_id);

CREATE INDEX i_user_id ON bet(user_id);

CREATE INDEX i_user ON user(id);
CREATE INDEX i_email ON user(email);
