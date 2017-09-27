<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $value): ?>
            <li class="nav__item">
                <a href="all-lots.php?id=<?= $value['id']; ?>"><?= $value['category_name']; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<section class="lot-item container">
    <h2><?= htmlspecialchars($current_lot['lot_name']); ?></h2>
<div class="lot-item__content">
    <div class="lot-item__left">
        <div class="lot-item__image">
            <img src="<?= $current_lot['image']; ?>" width="730" height="548" alt="Сноуборд">
        </div>
        <p class="lot-item__category">Категория: <span><?= $current_lot['category_name']; ?></span></p>
        <p class="lot-item__description">
            <?php if (isset($current_lot['description']) && $current_lot['description'] != null): ?>
                <?= htmlspecialchars($current_lot['description']); ?>
            <?php else: ?>
            Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег
            мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
            снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
            кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
            просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
            равнодушным.</p>
        <?php endif; ?>
    </div>
    <div class="lot-item__right">
        <?php if (isset($_SESSION['user']) && !$check_bet): ?>
        <div class="lot-item__state">
            <div class="lot-item__timer timer">
                <?= lot_time_remaining($current_lot['data_end']); ?>
            </div>
            <div class="lot-item__cost-state">
                <div class="lot-item__rate">
                    <span class="lot-item__amount">Текущая цена</span>
                    <span class="lot-item__cost"><?= $current_lot['cost']; ?></span>
                </div>
                <div class="lot-item__min-cost">
                    Мин. ставка <span><?= !empty($min_bet['price']) ? $min_bet['price'] : $current_lot['first_bet']; ?> р</span>
                </div>
            </div>
            <form class="lot-item__form" action="lot.php?id=<?=$_GET['id'];?>" method="post">
                <p class="lot-item__form-item <?= !empty($validation_errors) && (in_array('empty', $validation_errors) || in_array('no_numeric', $validation_errors) || in_array('no_first_bet', $validation_errors)) ? 'form__item--invalid' : '';?>">
                    <label for="cost">Ваша ставка</label>
                    <input id="cost" type="text" name="cost" placeholder="<?= !empty($min_bet['price']) ? $min_bet['price'] : $current_lot['first_bet']; ?>" >
                </p>
                <button type="submit" class="button">Сделать ставку</button>
            </form>
        </div>
        <?php endif; ?>
        <div class="history">
            <h3>История ставок (<span><?= $count_bets; ?></span>)</h3>
            <!-- заполните эту таблицу данными из массива $bets-->
            <table class="history__list">
                <?php if ($count_bets !== 0) : ?>
                    <?php foreach ($array_bets as $bet => $value) : ?>
                        <tr class="history__item">
                            <td class="history__name"><?= $value['name']; ?></td>
                            <td class="history__price"><?= $value['user_price']; ?>р</td>
                            <td class="history__time"><?= format_time($value['date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                 <?php endif; ?>
            </table>
        </div>
    </div>
</div>
</section>

