<div class="container">
    <section class="lots">
        <h2><?= !empty($category_items[0]['category_name']) ? 'Все лоты в категории <span>«' . $category_items[0]['category_name'] . '»' : 'Все товары этой категории проданы'; ?></span></h2>
        <ul class="lots__list">
            <?php foreach ($category_items as $key => $value): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=  $value['image']; ?>" width="350" height="260" alt="Сноуборд">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=  $value['category_name']; ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=  $value['id']; ?>"><?=  htmlspecialchars($value['lot_name']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=  $value['cost']; ?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=lot_time_remaining($value['data_end']);?>
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
                    <a href="all-lots.php?id=<?= $_GET['id']; ?>&page=<?= $page; ?>"><?= $page; ?></a>
                </li>
            <?php endforeach; ?>

            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
        </ul>
    <?php endif; ?>
</div>
