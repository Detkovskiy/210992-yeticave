<?php /*print_r($validation_errors['error']) */?>
<?php /*print_r($error_validation_file); */?>
<form class="form form--add-lot container <?= !empty($validation_errors) || !empty($error_validation_file) ? 'form--invalid' : '' ?>" action="add.php" method="post" enctype="multipart/form-data">
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?= in_array('lot-name', $validation_errors) ? 'form__item--invalid' : ''; ?>">
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?= $_POST['lot-name'] ?? ''; ?>">
            <span class="form__error"><?= in_array('lot-name', $validation_errors) ? $text_error_empty_field : ''; ?></span>
        </div>
        <div class="form__item <?= in_array('category', $validation_errors) ? 'form__item--invalid' : ''; ?>">
            <label for="category">Категория</label>
            <select id="category" name="category">
                <option value="" selected>Выберите категорию</option>
                <?php foreach ($categories as $categories): ?>
                    <option value="<?= $categories; ?>" <?= $_POST['category'] == $categories ? 'selected' : '' ?>><?= $categories; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error"><?= in_array('category', $validation_errors) ? $text_error_empty_field : ''; ?></span>
        </div>
    </div>
    <div class="form__item form__item--wide <?= in_array('message', $validation_errors) ? 'form__item--invalid' : ''; ?>">
        <label for="message">Описание</label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"><?= empty($_POST['message']) ? '' : $_POST['message'];?></textarea>
        <span class="form__error"><?= in_array('message', $validation_errors) ? $text_error_empty_field : ''; ?></span>
    </div>
    <div class="form__item form__item--file <?= !empty($error_validation_file) ? 'form__item--invalid' : ''; ?>">
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" name="lot-file" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
        <span class="form__error"><?= $error_validation_file; ?></span>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small <?= in_array('lot-rate', $validation_errors) ? 'form__item--invalid' : ''; ?>">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" name="lot-rate" placeholder="0" value="<?= empty($_POST['lot-rate']) ? '' : $_POST['lot-rate'];?>">
            <span class="form__error"><?= in_array('lot-rate', $validation_errors) ? $text_error_numeric_field : ''; ?></span>
        </div>
        <div class="form__item form__item--small <?= in_array('lot-step', $validation_errors) ? 'form__item--invalid' : ''; ?>">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" name="lot-step" placeholder="0" value="<?= empty($_POST['lot-step']) ? '' : $_POST['lot-step'];?>">
            <span class="form__error"><?= in_array('lot-step', $validation_errors) ? $text_error_numeric_field : ''; ?></span>
        </div>
        <div class="form__item <?= in_array('lot-date', $validation_errors) ? 'form__item--invalid' : ''; ?>">
            <label for="lot-date">Дата завершения</label>
            <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" value="<?= empty($_POST['lot-date']) ? '' : $_POST['lot-date'];?>">
            <span class="form__error"><?= in_array('lot-date', $validation_errors) ? $text_error_empty_field : ''; ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
