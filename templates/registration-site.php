<main class="page__main page__main--registration">
  <div class="container">
    <h1 class="page__title page__title--registration">Регистрация</h1>
  </div>
  <section class="registration container">
    <h2 class="visually-hidden">Форма регистрации</h2>
    <form class="registration__form form" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="form__text-inputs-wrapper">
        <div class="form__text-inputs">
          <div class="registration__input-wrapper form__input-wrapper">
            <label class="registration__label form__label" for="registration-email">Электронная почта <span class="form__input-required">*</span></label>
            <div class="form__input-section <?= array_key_exists('email', $errors) ? 'form__input-section--error' : ''; ?>">
              <input class="registration__input form__input" id="registration-email" type="email" name="email" placeholder="Укажите эл.почту" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
              <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
              <div class="form__error-text">
                <h3 class="form__error-title">Электронная почта</h3>
                <p class="form__error-desc"><?= isset($errors['email']) ? $errors['email'] : ''; ?></p>
              </div>
            </div>
          </div>
          <div class="registration__input-wrapper form__input-wrapper">
            <label class="registration__label form__label" for="registration-login">Логин <span class="form__input-required">*</span></label>
            <div class="form__input-section <?= array_key_exists('login', $errors) ? 'form__input-section--error' : ''; ?>">
              <input class="registration__input form__input" id="registration-login" type="text" name="login" placeholder="Укажите логин" value="<?= isset($_POST['login']) ? $_POST['login'] : ''; ?>">
              <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
              <div class="form__error-text">
                <h3 class="form__error-title">Логин</h3>
                <p class="form__error-desc"><?= isset($errors['login']) ? $errors['login'] : ''; ?></p>
              </div>
            </div>
          </div>
          <div class="registration__input-wrapper form__input-wrapper">
            <label class="registration__label form__label" for="registration-password">Пароль<span class="form__input-required">*</span></label>
            <div class="form__input-section <?= array_key_exists('password', $errors) ? 'form__input-section--error' : ''; ?>">
              <input class="registration__input form__input" id="registration-password" type="password" name="password" placeholder="Придумайте пароль">
              <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
              <div class="form__error-text">
                <h3 class="form__error-title">Пароль</h3>
                <p class="form__error-desc"><?= isset($errors['password']) ? $errors['password'] : ''; ?></p>
              </div>
            </div>
          </div>
          <div class="registration__input-wrapper form__input-wrapper">
            <label class="registration__label form__label" for="registration-password-repeat">Повтор пароля<span class="form__input-required">*</span></label>
            <div class="form__input-section <?= array_key_exists('password-repeat', $errors) ? 'form__input-section--error' : ''; ?>">
              <input class="registration__input form__input" id="registration-password-repeat" type="password" name="password-repeat" placeholder="Повторите пароль">
              <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
              <div class="form__error-text">
                <h3 class="form__error-title">Повтор пароля</h3>
                <p class="form__error-desc"><?= isset($errors['password-repeat']) ? $errors['password-repeat'] : ''; ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php if (!empty($errors)): ?>
          <div class="form__invalid-block">
            <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
            <ul class="form__invalid-list">
              <?php foreach($errors as $error => $value): ?>
                <?php if ($error == 'email'): ?>
                  <li class="form__invalid-item">Электронная почта. <?= $errors['email']; ?></li>
                <?php elseif ($error == 'login'): ?>
                  <li class="form__invalid-item">Логин. <?= $errors['login']; ?></li>
                <?php elseif ($error == 'password'): ?>
                  <li class="form__invalid-item">Пароль. <?= $errors['password']; ?></li>
                <?php elseif ($error == 'password-repeat'): ?>
                  <li class="form__invalid-item">Повтор пароля. Это поле должно быть заполнено.</li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>
      <div class="registration__input-file-container form__input-container form__input-container--file">
        <div class="registration__input-file-wrapper form__input-file-wrapper">
          <div class="registration__file-zone form__file-zone dropzone">
            <input class="registration__input-file form__input-file" id="userpic-file" type="file" name="userpic-file" title=" ">
            <div class="form__file-zone-text">
              <span>Перетащите фото сюда</span>
            </div>
          </div>
          <button class="registration__input-file-button form__input-file-button button" type="button">
            <span>Выбрать фото</span>
            <svg class="registration__attach-icon form__attach-icon" width="10" height="20">
              <use xlink:href="#icon-attach"></use>
            </svg>
          </button>
        </div>
        <div class="registration__file form__file dropzone-previews">

        </div>
      </div>
      <button class="registration__submit button button--main" type="submit">Отправить</button>
    </form>
  </section>
</main>
