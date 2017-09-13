<nav class="nav">
    <ul class="nav__list container">
        <li class="nav__item">
            <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Разное</a>
        </li>
    </ul>
</nav>
<section class="rates container">
    <h2>Мои ставки</h2>
    <?php /*print_r($my_lots); */?>
    <table class="rates__list">
        <?php foreach ($my_lots as $lots => $value):?>
        <tr class="rates__item">
            <td class="rates__info">
                <div class="rates__img">
                    <img src="<?=$array_lots[$value['lot_id']]['url']; ?>" width="54" height="40" alt="Сноуборд">
                </div>
                <h3 class="rates__title"><a href="lot.php?id=<?= $value['lot_id']; ?>"><?=$array_lots[$value['lot_id']]['title']; ?></a></h3>
            </td>
            <td class="rates__category">
                <?=$array_lots[$value['lot_id']]['category']; ?>
            </td>
            <td class="rates__timer">
                <div class="timer timer--finishing"><?=$lot_time_remaining_sec; ?></div>
            </td>
            <td class="rates__price">
              <?=$value['my_cost']; ?> р
            </td>
            <td class="rates__time">
                <?=time_bet($value['time_now'])?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</section>

