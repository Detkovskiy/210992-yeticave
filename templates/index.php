<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php foreach ($categories as $key => $value): ?>
            <li class="promo__item promo__item<?= $value['class']; ?>">
                <a class="promo__link" href="all-lots.php?id=<?= $value['id']; ?>"><?= $value['category_name']; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
            <select class="lots__select">
                <option>Все категории</option>
                <?php foreach ($categories as $key => $value): ?>
                    <option><?= $value['category_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <ul class="lots__list">
        <?php foreach ($array_lots as $key => $lot): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= $lot['image']; ?>" width="350" height="260" alt="Сноуборд">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= $lot['category_name']; ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $lot['id'];; ?>"><?= htmlspecialchars($lot['lot_name']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= htmlspecialchars($lot['cost']); ?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                            <?= lot_time_remaining($lot['data_end']); ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<?php if ($page_count > 1) : ?>
<ul class="pagination-list">
    <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
    <?php foreach ($pages as $page) : ?>
        <li class="pagination-item <?= ($page == $current_page) ? 'pagination-item-active' : '' ;?> ">
            <a href="index.php?page=<?= $page; ?>"><?= $page; ?></a>
        </li>
        <?php endforeach; ?>

    <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
</ul>
<?php endif; ?>
