CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  category_name CHAR(100),
  class CHAR(100)
);

CREATE TABLE lots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  winner_id INT,
  category_id INT,
  date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_price INT
);

CREATE TABLE user(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_reg DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  email CHAR(100) UNIQUE,
  name CHAR(100),
  password CHAR(100),
  avatar TEXT,
  contact TEXT
);

/* Добавление индексов */
CREATE INDEX i_category ON categories(id);
CREATE INDEX i_category_id ON lots(category_id);

CREATE INDEX i_lot ON lots(id);
CREATE INDEX i_lot_id ON bet(lot_id);

CREATE INDEX i_user_id ON bet(user_id);

CREATE INDEX i_user ON user(id);
CREATE INDEX i_email ON user(email);


