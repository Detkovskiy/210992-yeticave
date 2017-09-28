<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
        <?php foreach ($all_bets as $bet => $value):?>
        <tr class="rates__item <?= lot_time_remaining($value['data_end']) ? '' : (($value['winner_id'] == $_SESSION['user']['id']) ? 'rates__item--win' : 'rates__item--end');?>">
            <td class="rates__info">
                <div class="rates__img">
                    <img src="<?=$value['image']; ?>" width="54" height="40" alt="Сноуборд">
                </div>
                <h3 class="rates__title"><a href="lot.php?id=<?= $value['id']; ?>"><?=$value['lot_name']; ?></a></h3>
            </td>
            <td class="rates__category">
                <?=$value['category_name']; ?>
            </td>
            <td class="rates__timer">
            <?php if (lot_time_remaining($value['data_end'])): ?>
                <div class="timer timer--finishing"><?= lot_time_remaining($value['data_end']); ?></div>
            <?php elseif ($value['winner_id'] == $_SESSION['user']['id']): ?>
                <div class="timer timer--win">Ставка выиграла</div>
            <?php else : ?>
                <div class="timer timer--end">Торги окончены</div>
            <? endif; ?>
            </td>
            <td class="rates__price">
              <?=$value['user_price']; ?> р
            </td>
            <td class="rates__time">
                <?=format_time($value['date'])?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</section>

