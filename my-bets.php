<?php
session_start();

$tittle = 'Мои ставки';

require_once 'config.php';
require_once 'init.php';

if(isset($_SESSION['user'])) {

    $sql_all_my_bet = '
      SELECT l.id, lot_name, image, category_name, user_price, data_end, b.date, l.winner_id
      FROM lots l
      LEFT JOIN categories c ON l.category_id = c.id
      LEFT JOIN bet b ON b.lot_id = l.id
      WHERE b.user_id = ?
      ORDER BY data_end DESC;';

    $all_bets = select_data($link, $sql_all_my_bet, [$_SESSION['user']['id']]);

    $content = render_template('templates/my-bets.php',
        [
            'all_bets' => $all_bets
        ]);

    $layout = render_template('templates/layout.php',
        [
            'title' => $tittle,
            'content' => $content,
            'user_avatar' => $user_avatar,
            'categories' => $categories,
            'main' => false,
            'no_selected' => true
        ]);

    print $layout;

} else {

    header("Location: login.php");

}


