<?php
session_start();

require_once 'config.php';
require_once 'init.php';

if(isset($_GET['search']) && !empty(htmlspecialchars(trim($_GET['search'])))) {

    $search_text = htmlspecialchars(trim($_GET['search']));

    $mask_search_text = "%$search_text%";

    $current_page = $_GET['page'] ?? 1;
    $page_item = 9;

    $sql_count_lots = '
        SELECT count(*) as count 
        FROM lots l
        WHERE l.data_end >  NOW() AND l.lot_name LIKE ?  OR l.description LIKE ? ;';

    $count_lots = select_data($link, $sql_count_lots, [$mask_search_text, $mask_search_text])[0];

    $page_count = ceil($count_lots['count'] / $page_item);
    $offset = ($current_page - 1) * $page_item;
    $pages = range(1, $page_count);

    $sql_search_text = '
    SELECT l.id, l.lot_name, l.date, l.data_end, l.cost, l.cost, c.category_name, l.image
    FROM lots l
    LEFT JOIN categories c ON c.id = l.category_id
    WHERE l.data_end >  NOW() AND l.lot_name LIKE ?  OR l.description LIKE ? 
    ORDER BY l.date DESC
    LIMIT ? OFFSET ?;';

    $result_search = select_data($link, $sql_search_text, [$mask_search_text, $mask_search_text, $page_item, $offset]);

    $content = render_template('templates/search.php',
        [
            'search_text' => $search_text,
            'result_search' => $result_search,
            'pages' => $pages,
            'page_count' => $page_count,
            'current_page' => $current_page
        ]);

    $layout = render_template('templates/layout.php',
        [
            'title' => 'Результаты поиска по запросу' . $search_text,
            'content' => $content,
            'categories' => $categories,
            'main' => false,
            'user_avatar' => $user_avatar,
            'no_selected' => true
        ]);

    print $layout;

} else {

    header("Location: index.php");

}




