<?php

$sql_id_lots = 'SELECT id FROM lots WHERE data_end <= NOW() AND winner_id is null;';
$id_lots = select_data($link, $sql_id_lots, '');

$sql_max_bet = '
    SELECT b.user_price AS `max_bet`, u.name, u.email, u.id, l.id as `lot_id`, l.lot_name
    FROM bet b
    LEFT JOIN user u ON u.id = b.user_id
    LEFT JOIN lots l on l.id = b.lot_id
    WHERE l.id = ?
    ORDER BY user_price DESC
    LIMIT 1;';

$data_winner = [];

foreach ($id_lots as $lot => $value) {

    foreach (select_data($link, $sql_max_bet, [$value['id']]) as $key) {

        $data_winner[] = $key;

        exec_query($link, 'UPDATE lots SET winner_id = ? WHERE id = ?;', [$key['id'], $key['lot_id']]);

    }
}

$transport = (new Swift_SmtpTransport('smtp.mail.ru', 465))
    ->setUsername('doingsdone@mail.ru')
    ->setPassword('rds7BgcL')
    ->setEncryption('ssl');

$mailer = new Swift_Mailer($transport);

foreach ($data_winner as $winner) {

    $content = render_template('templates/email.php',
        [
            'name' => $winner['name'],
            'email' => $winner['email'],
            'lot_name' => $winner['lot_name'],
            'my_bets' => 'http://localhost:8888/210992-yeticave/my-bets.php',
            'lot_url' => 'http://localhost:8888/210992-yeticave/lot.php?id=' . $winner['lot_id']
        ]);

    $message = (new Swift_Message('Ваша ставка победила!!!'))
        ->setFrom('doingsdone@mail.ru')
        ->setTo([$winner['email'] => $winner['name']])
        ->setBody($content,
            'text/html');

    $result = $mailer->send($message);
}













