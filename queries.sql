INSERT INTO categories(category_name)
  VALUE
    ('Доски и лыжи'),
    ('Крепления'),
    ('Ботинки'),
    ('Одежда'),
    ('Инструменты'),
    ('Разное');

INSERT INTO user(email, name, password)
  VALUE
    ('ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'),
    ('kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'),
    ('warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW');

INSERT INTO lots(user_id, winner_id, category_id, date, lot_name, description, image, cost, cost_range, data_end, like_number)
  VALUE
    (1, 2, 1, '2017-09-13 14:42:00', '2014 Rossignol District Snowboard', ' ', 'img/lot-1.jpg', 10999, 2000, '2017-09-14', 5),
    (2, 1, 1, '2017-09-13 11:42:00', 'DC Ply Mens 2016/2017 Snowboard', '22', 'img/lot-2.jpg', 159999, 5000, '2017-09-14', 6),
    (3, 2, 2, '2017-09-13 15:42:00', 'Крепления Union Contact Pro 2015 года размер L/XL', ' ', 'img/lot-3.jpg', 8000, 1000, '2017-09-14', 35),
    (1, 2, 3, '2017-09-13 08:42:00', 'Ботинки для сноуборда DC Mutiny Charocal', ' ', 'img/lot-4.jpg', 10999, 2000, '2017-09-14', 1),
    (2, 1, 4, '2017-09-13 21:42:00', 'Куртка для сноуборда DC Mutiny Charocal', ' ', 'img/lot-5.jpg', 7500, 1000, '2017-09-14', 11),
    (2, 3, 6, '2017-09-13 19:42:00', 'Маска Oakley Canopy', ' ', 'img/lot-6.jpg', 5400, 500, '2017-09-14', 21);

INSERT INTO bet(user_id, lot_id, date, user_price)
  VALUE
    (1, 3, '2017-09-13 21:42:00', 20000),
    (2, 3, '2017-09-13 10:42:00', 10000),
    (3, 3, '2017-09-13 16:42:00', 15000),
    (1, 1, '2017-09-13 20:42:00', 10000),
    (2, 1, '2017-09-13 18:42:00', 20000),
    (3, 1, '2017-09-13 02:42:00', 30000),
    (2, 2, '2017-09-13 05:42:00', 12000),
    (3, 3, '2017-09-13 10:42:00', 33000);

# получение списка категорий
SELECT category_name FROM categories;

# поление открытых лотов
SELECT
  lot_name AS 'Наименование',
  cost AS Начальная_цена,
  image AS Изображение,
  COALESCE(MAX(b.user_price), 'Ставок нет') AS Максимальная_ставка,
  COUNT(b.lot_id) AS Количество_ставок,
  category_name AS Категория
FROM lots l JOIN categories c ON category_id = c.id
  LEFT JOIN bet b ON b.lot_id = l.id
WHERE l.data_end > CURDATE()
GROUP BY l.id
ORDER BY Количество_ставок DESC;

# поиск лота по названию
SELECT * FROM lots
WHERE lot_name = '2014 Rossignol District Snowboard' OR description LIKE '2%';

# меняем название
UPDATE lots SET lot_name = '2017 Rossignol District Snowboard'
WHERE id = 1;

# получение списка ставок по id
SELECT * FROM bet
WHERE lot_id = 1 ORDER BY date DESC;

