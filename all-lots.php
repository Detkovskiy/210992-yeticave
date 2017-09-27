<?php
session_start();

require_once 'config.php';
require_once 'init.php';
$title = '';

if(isset($_GET['id'])) {

    $current_page = $_GET['page'] ?? 1;
    $page_item = 9;

    $sql_count_category_item = '
        SELECT count(*) as count, c.id
        FROM lots l
        LEFT JOIN categories c ON c.id = l.category_id
        WHERE l.data_end >  NOW() AND c.id = ?
        ORDER BY l.date DESC';

    $count_category_item = select_data($link, $sql_count_category_item, [$_GET['id']])[0];

    if ($count_category_item['id'] == $_GET['id']) {

        $page_count = ceil($count_category_item['count'] / $page_item);
        $offset = ($current_page - 1) * $page_item;
        $pages = range(1, $page_count);

        $sql_category_items = '
            SELECT l.id, c.id as `cat_id`, l.lot_name, l.date, l.data_end, l.cost, l.cost, c.category_name, l.image
            FROM lots l
            LEFT JOIN categories c ON c.id = l.category_id
            WHERE l.data_end >  NOW() AND c.id = ?
            ORDER BY l.date DESC
            LIMIT ? OFFSET ?;';

        $category_items = select_data($link, $sql_category_items, [$_GET['id'], $page_item, $offset]);

        if (!empty($category_items[0]['category_name'])) {
            $title = $category_items[0]['category_name'];
        }

        $content = render_template('templates/all-lots.php',
            [
                'category_items' => $category_items,
                'count_category_item' => $count_category_item,
                'pages' => $pages,
                'page_count' => $page_count,
                'current_page' => $current_page,
                'categories' => $categories
            ]);

    } else {
        http_response_code(404);
        $main = true;
        $content = "Такой страницы не существует (ошибка 404)";
    }

    $layout = render_template('templates/layout.php',
        [
            'title' => 'Все лоты в категории' . $title,
            'content' => $content,
            'categories' => $categories,
            'user_avatar' => $user_avatar,
            'main' => false
        ]);

    print $layout;

} else {

    header("Location: index.php");

}





