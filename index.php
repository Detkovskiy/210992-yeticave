<?php
session_start();

$title = "Главная";

/**
 * Подключаем файлы: соединения с БД и определение победителей с отправкой писем
 */
require_once 'config.php';
require_once 'init.php';
require_once 'getwinner.php';

$current_page = $_GET['page'] ?? 1;
$page_item = 3;

/**
 * Провека GET запроса.
 * Если true, значит необходима фильтрация лотов по категориям.
 * GET запрос приходит от JS скрипта при изменении поля select.
 * Параметр запроса это id категории лота
 */
if (isset($_GET['id'])) {

    /**
     *  Отключение фильтрации. Показ лотов всех категорий
     */
    if ($_GET['id'] == 'all') {
        header("Location: index.php");
    }

    /**
     *  Запрос в БД для определения количества лотов выбранной категории
     */
    $sql_count_lots = '
      SELECT count(*) as count 
      FROM lots
      WHERE category_id = ? AND data_end > now();';

    /**
     *  Расчет колчества страниц для пагинации
     */
    $count_lots = select_data($link, $sql_count_lots, [$_GET['id']])[0];
    $page_count = ceil($count_lots['count'] / $page_item);
    $offset = ($current_page - 1) * $page_item;
    $pages = range(1, $page_count);

    /**
     *  Запрос данных лотов из БД с учетом параметров пагинации
     */
    $sql_lots = '
        SELECT l.id, lot_name, cost, image, category_name, data_end
        FROM lots l
        JOIN categories c ON category_id = c.id
        WHERE data_end > now() AND c.id = ?
        LIMIT ? OFFSET ?;';

    $array_lots = select_data($link, $sql_lots, [$_GET['id'], $page_item, $offset]);

} else {

    /**
     * При отсутствии GET запроса, отображаются лоты всех категорий, участвующие в торгах
     *
     * Запрос о количестве лотов и расчет пагинации
     */
    $sql_count_lots = 'SELECT count(*) as count FROM lots WHERE data_end > now();';
    $count_lots = select_data($link, $sql_count_lots, '')[0];

    $page_count = ceil($count_lots['count'] / $page_item);
    $offset = ($current_page - 1) * $page_item;
    $pages = range(1, $page_count);

    /**
     * Запрос данных лотов из БД с учетом параметров пагинации
     */
    $sql_lots = '
    SELECT l.id, lot_name, cost, image, category_name, data_end
    FROM lots l
    JOIN categories c ON category_id = c.id
    WHERE data_end > now()
    LIMIT ? OFFSET ?;';

    $array_lots = select_data($link, $sql_lots, [$page_item, $offset]);
}

/**
 * Рендер контента страницы и лэйаута.
 */
$content = render_template('templates/index.php',
    [
        'array_lots' => $array_lots,
        'categories' => $categories,
        'pages' => $pages,
        'page_count' => $page_count,
        'current_page' => $current_page
    ]);

$layout = render_template('templates/layout.php',
    [
        'title' => $title,
        'content' => $content,
        'categories' => $categories,
        'user_avatar' => $user_avatar,
        'main' => true,
        'main_page' => true,
        'no_selected' => true
    ]);

print $layout;


