CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name CHAR(100)
);

CREATE TABLE lots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  winner_id INT,
  category_id INT,
  date DATETIME,
  lot_name TEXT,
  description TEXT,
  image TEXT,
  cost INT,
  cost_range INT,
  data_end DATE,
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
  email CHAR(100) UNIQUE,
  name CHAR(100),
  password CHAR(100),
  avatar TEXT,
  contact TEXT
);

/* Связь объявления с именем автора по id*/
SELECT l.id, date, l.lot_name, description, image, cost, data_end, cost_range, like_number, u.name
FROM lots l JOIN user u ON l.user_id = u.id;

/* Связь названия лота с категорией */
SELECT l.id, date, lot_name, description, image, cost, data_end, cost_range, like_number, c.category_name
FROM lots l JOIN categories c ON l.category_id = c.id;

/* Связь id ставки с именем пользователем */
SELECT b.id, date, user_price, u.name
FROM bet b JOIN user u ON b.user_id = u.id;

/* Связь id ставки с id лотом */
SELECT b.id, b.date, user_price, l.date, l.lot_name, description, image, cost, data_end, cost_range, like_number
FROM bet b JOIN lots l ON b.lot_id = l.id;

/* Добавление индексов */
CREATE INDEX i_category ON categories(id);
CREATE INDEX i_category_id ON lots(category_id);

CREATE INDEX i_lot ON lots(id);
CREATE INDEX i_lot_id ON bet(lot_id);

CREATE INDEX i_user_id ON bet(user_id);

CREATE INDEX i_user ON user(id);
CREATE INDEX i_email ON user(email);
