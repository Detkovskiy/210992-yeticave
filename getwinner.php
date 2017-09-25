<?php

$sql_id_lots = 'SELECT id FROM lots WHERE data_end <= NOW() AND winner_id is null;';
$id_lots = select_data($link, $sql_id_lots, '');

$sql_max_bet = '
    SELECT max(b.user_price) AS `max_bet`, u.name, u.email, u.id, l.id as `lot_id`, l.lot_name
    FROM bet b
    LEFT JOIN lots l ON b.lot_id = l.id
    LEFT JOIN user u ON b.user_id = u.id
    WHERE b.lot_id = ?;';

$data_winner = [];

foreach ($id_lots as $lot => $value) {

    foreach (select_data($link, $sql_max_bet, [$value['id']]) as $key) {

        $data_winner[] = $key;

        exec_query($link, 'UPDATE lots SET winner_id = ? WHERE id = ?;', [$key['id'], $key['lot_id']]);

        $content = render_template('templates/email.php',
            [
                'name' => $key['name'],
                'email' => $key['email'],
                'lot_name' => $key['lot_name'],
                'my_bets' => 'http://localhost:8888/210992-yeticave/my-bets.php',
                'lot_url' => 'http://localhost:8888/210992-yeticave/lot.php?id=' . $key['lot_id']
            ]);

        $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465))
            ->setUsername('doingsdone@mail.ru')
            ->setPassword('rds7BgcL');

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Ваша ставка победила!!!'))
            ->setFrom('doingsdone@mail.ru')
            ->setTo([/*$key['email']*/ '9119113142@mail.ru' => $key['name']])
            ->setBody($content,
                'text/html');

        $result = $mailer->send($message);
    }
}

