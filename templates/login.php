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
  <form class="form container <?= !empty($validation_errors) ? 'form--invalid' : '' ?>" action="login.php" method="post">
    <h2>Вход</h2>
    <div class="form__item <?= in_array('email', $validation_errors) || in_array('novalidation', $validation_errors) ? 'form__item--invalid' : ''; ?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $_POST['email'] ?? ''; ?>">
      <span class="form__error">Введите e-mail</span>
    </div>
    <div class="form__item form__item--last <?= in_array('password', $validation_errors) || in_array('no_valid_password', $errors) ? 'form__item--invalid' : ''; ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="<?= in_array('no_valid_password', $errors) ? 'Вы ввели неверный пароль' : 'Введите пароль'; ?>" >
      <span class="form__error">Введите пароль</span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
