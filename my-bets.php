<?php
session_start();

require_once 'config.php';
require_once 'init.php';

if(isset($_SESSION['user'])) {
   // $my_lots = json_decode($_SESSION['my_lots'], true);

    $sql_all_my_bet = '
      SELECT l.id, lot_name, image, category_name, user_price
      FROM lots l
      LEFT JOIN categories c ON l.category_id = c.id
      LEFT JOIN bet b ON b.lot_id = l.id
      WHERE b.user_id = ?;';

    $all_bets = select_data($link, $sql_all_my_bet, [$_SESSION['user']['id']]);

    $content = render_template('templates/my-bets.php',
        [
            //'my_lots' => $my_lots,
            'all_bets' => $all_bets
            //'lot_time_remaining_sec' => $lot_time_remaining_sec
        ]);

    $layout = render_template('templates/layout.php',
        [
            'title' => 'Мои ставки',
            'content' => $content,
            'user_avatar' => $user_avatar,
        ]);

    print $layout;
}

header("Location: login.php");
