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
<form class="form container <?= !empty($validation_errors) ? 'form--invalid' : '' ?>" action="sing-up.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?= in_array('error_mail_validation', $validation_errors) || in_array('email', $validation_errors) || in_array('double_email', $errors) ? 'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $_POST['email'] ?? ''; ?>">
        <span class="form__error"><?= in_array('email', $validation_errors) || in_array('error_mail_validation', $validation_errors) ? 'Введите email' : (in_array('double_email', $errors) ? 'Пользователь с таким email уже зарегистрирован' : ''); ?></span>
    </div>
    <div class="form__item <?= in_array('password', $validation_errors) ? 'form__item--invalid' : ''; ?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?= $_POST['password'] ?? ''; ?>">
        <span class="form__error"><?= in_array('password', $validation_errors) ? 'Введите пароль' : ''; ?></span>
    </div>
    <div class="form__item <?= in_array('name', $validation_errors) ? 'form__item--invalid' : ''; ?>">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= $_POST['name'] ?? ''; ?>">
        <span class="form__error"><?= in_array('name', $validation_errors) ? 'Введите свое имя' : ''; ?></span>
    </div>
    <div class="form__item <?= in_array('message', $validation_errors) ? 'form__item--invalid' : ''; ?>">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться" ><?= $_POST['message'] ?? ''; ?></textarea>
        <span class="form__error"><?= in_array('message', $validation_errors) ? 'Введите контактные данные' : ''; ?></span>
    </div>
    <div class="form__item form__item--file form__item--last">
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="photo2" name="avatar" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>
