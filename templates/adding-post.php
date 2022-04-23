<?php

$default_filter = true;

if ($_GET) {
  $default_filter = false;
}

?>

<div class="page__main-section">
  <div class="container">
    <h1 class="page__title page__title--adding-post">Добавить публикацию</h1>
  </div>
  <div class="adding-post container">
    <div class="adding-post__tabs-wrapper tabs">
      <div class="adding-post__tabs filters">
        <ul class="adding-post__tabs-list filters__list tabs__list">
          <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--photo <?=(($_GET['filter'] == 'photo') or $default_filter) ? 'filters__button--active tabs__item--active' : '';?> tabs__item button" href="add.php?filter=photo">
              <svg class="filters__icon" width="22" height="18">
                <use xlink:href="#icon-filter-photo"></use>
              </svg>
              <span>Фото</span>
            </a>
          </li>
          <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--video <?=($_GET['filter'] == 'video') ? 'filters__button--active tabs__item--active' : '';?> tabs__item button" href="add.php?filter=video">
              <svg class="filters__icon" width="24" height="16">
                <use xlink:href="#icon-filter-video"></use>
              </svg>
              <span>Видео</span>
            </a>
          </li>
          <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--text <?=($_GET['filter'] == 'text') ? 'filters__button--active tabs__item--active' : '';?> tabs__item button" href="add.php?filter=text">
              <svg class="filters__icon" width="20" height="21">
                <use xlink:href="#icon-filter-text"></use>
              </svg>
              <span>Текст</span>
            </a>
          </li>
          <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--quote <?=($_GET['filter'] == 'quote') ? 'filters__button--active tabs__item--active' : '';?> tabs__item button" href="add.php?filter=quote">
              <svg class="filters__icon" width="21" height="20">
                <use xlink:href="#icon-filter-quote"></use>
              </svg>
              <span>Цитата</span>
            </a>
          </li>
          <li class="adding-post__tabs-item filters__item">
            <a class="adding-post__tabs-link filters__button filters__button--link <?=($_GET['filter'] == 'link') ? 'filters__button--active tabs__item--active' : '';?> tabs__item button" href="add.php?filter=link">
              <svg class="filters__icon" width="21" height="18">
                <use xlink:href="#icon-filter-link"></use>
              </svg>
              <span>Ссылка</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="adding-post__tab-content">
        <section class="adding-post__photo tabs__content <?=(($_GET['filter'] == 'photo') or $default_filter) ? 'tabs__content--active' : '';?>">
          <h2 class="visually-hidden">Форма добавления фото</h2>
          <form class="adding-post__form form" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form__text-inputs-wrapper">
              <div class="form__text-inputs">
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="photo-heading">Заголовок <span class="form__input-required">*</span></label>
                  <div class="form__input-section <?=array_key_exists('photo-heading', $errors) ? 'form__input-section--error' : '';?>">
                    <input class="adding-post__input form__input" id="photo-heading" type="text" name="photo-heading" placeholder="Введите заголовок" value="<?=get_post_value('photo-heading');?>">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc"><?=$errors['photo-heading'];?></p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="photo-url">Ссылка из интернета</label>
                  <div class="form__input-section <?=array_key_exists('photo-url', $errors) ? 'form__input-section--error' : '';?>">
                    <input class="adding-post__input form__input" id="photo-url" type="text" name="photo-url" placeholder="Введите ссылку" value="<?=get_post_value('photo-url');?>">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc"><?=$errors['photo-url'];?></p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="photo-tags">Теги</label>
                  <div class="form__input-section <?=array_key_exists('photo-tags', $errors) ? 'form__input-section--error' : '';?>">
                    <input class="adding-post__input form__input" id="photo-tags" type="text" name="photo-tags" placeholder="Введите теги" value="<?=get_post_value('photo-tags');?>">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc"><?=$errors['photo-tags'];?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php if (!empty($errors)): ?>
              <div class="form__invalid-block">
                <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                  <?php foreach ($errors as $key => $value): ?>
                    <?php

if ($key == 'photo-heading') {
  $caption = 'Заголовок. ';
} elseif ($key == 'photo-url') {
  $caption = 'Ссылка из интернета. ';
} elseif ($key == 'photo-tags') {
  $caption = 'Теги. ';
}

?>
                  <li class="form__invalid-item"><?=$caption;?> Это поле должно быть заполнено.</li>
                  <?php endforeach;?>
                </ul>
              </div>
              <?php endif;?>
            </div>
            <div class="adding-post__input-file-container form__input-container form__input-container--file">
              <div class="adding-post__input-file-wrapper form__input-file-wrapper">
                <div class="adding-post__file-zone adding-post__file-zone--photo form__file-zone dropzone">
                  <input class="adding-post__input-file form__input-file" id="userpic-file-photo" type="file" name="userpic-file-photo" title=" ">
                  <div class="form__file-zone-text">
                    <span>Перетащите фото сюда</span>
                  </div>
                </div>
                <button class="adding-post__input-file-button form__input-file-button form__input-file-button--photo button" type="button">
                  <span>Выбрать фото</span>
                  <svg class="adding-post__attach-icon form__attach-icon" width="10" height="20">
                    <use xlink:href="#icon-attach"></use>
                  </svg>
                </button>
              </div>
              <div class="adding-post__file adding-post__file--photo form__file dropzone-previews">

              </div>
            </div>
            <div class="adding-post__buttons">
              <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
              <a class="adding-post__close" href="#">Закрыть</a>
            </div>
            <input class="visually-hidden" type="text" id="post-type" name="post-type" value="photo">
          </form>
        </section>

        <section class="adding-post__video tabs__content tabs__content <?=($_GET['filter'] == 'video') ? 'tabs__content--active' : '';?>">
          <h2 class="visually-hidden">Форма добавления видео</h2>
          <form class="adding-post__form form" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form__text-inputs-wrapper">
              <div class="form__text-inputs">
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="video-heading">Заголовок <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="video-heading" type="text" name="video-heading" placeholder="Введите заголовок">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="video-url">Ссылка youtube <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="video-url" type="text" name="video-heading" placeholder="Введите ссылку">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="video-tags">Теги</label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="video-tags" type="text" name="photo-heading" placeholder="Введите ссылку">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form__invalid-block">
                <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                  <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                </ul>
              </div>
            </div>

            <div class="adding-post__buttons">
              <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
              <a class="adding-post__close" href="#">Закрыть</a>
            </div>
          </form>
        </section>

        <section class="adding-post__text tabs__content <?=($_GET['filter'] == 'text') ? 'tabs__content--active' : '';?>">
          <h2 class="visually-hidden">Форма добавления текста</h2>
          <form class="adding-post__form form" action="#" method="post" autocomplete="off">
            <div class="form__text-inputs-wrapper">
              <div class="form__text-inputs">
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="text-heading">Заголовок <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="text-heading" type="text" name="text-heading" placeholder="Введите заголовок">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__textarea-wrapper form__textarea-wrapper">
                  <label class="adding-post__label form__label" for="post-text">Текст поста <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <textarea class="adding-post__textarea form__textarea form__input" id="post-text" placeholder="Введите текст публикации"></textarea>
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="post-tags">Теги</label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="post-tags" type="text" name="photo-heading" placeholder="Введите теги">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form__invalid-block">
                <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                  <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                  <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                </ul>
              </div>
            </div>
            <div class="adding-post__buttons">
              <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
              <a class="adding-post__close" href="#">Закрыть</a>
            </div>
          </form>
        </section>

        <section class="adding-post__quote tabs__content <?=($_GET['filter'] == 'quote') ? 'tabs__content--active' : '';?>">
          <h2 class="visually-hidden">Форма добавления цитаты</h2>
          <form class="adding-post__form form" action="#" method="post" autocomplete="off">
            <div class="form__text-inputs-wrapper">
              <div class="form__text-inputs">
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="quote-heading">Заголовок <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="quote-heading" type="text" name="quote-heading" placeholder="Введите заголовок">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__textarea-wrapper">
                  <label class="adding-post__label form__label" for="cite-text">Текст цитаты <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <textarea class="adding-post__textarea adding-post__textarea--quote form__textarea form__input" id="cite-text" placeholder="Текст цитаты"></textarea>
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__textarea-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="quote-author">Автор <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="quote-author" type="text" name="quote-author">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="cite-tags">Теги</label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="cite-tags" type="text" name="photo-heading" placeholder="Введите теги">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form__invalid-block">
                <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                  <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                  <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                </ul>
              </div>
            </div>
            <div class="adding-post__buttons">
              <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
              <a class="adding-post__close" href="#">Закрыть</a>
            </div>
          </form>
        </section>

        <section class="adding-post__link tabs__content <?=($_GET['filter'] == 'link') ? 'tabs__content--active' : '';?>">
          <h2 class="visually-hidden">Форма добавления ссылки</h2>
          <form class="adding-post__form form" action="#" method="post" autocomplete="off">
            <div class="form__text-inputs-wrapper">
              <div class="form__text-inputs">
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="link-heading">Заголовок <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="link-heading" type="text" name="link-heading" placeholder="Введите заголовок">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__textarea-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="post-link">Ссылка <span class="form__input-required">*</span></label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="post-link" type="text" name="post-link">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
                <div class="adding-post__input-wrapper form__input-wrapper">
                  <label class="adding-post__label form__label" for="link-tags">Теги</label>
                  <div class="form__input-section">
                    <input class="adding-post__input form__input" id="link-tags" type="text" name="photo-heading" placeholder="Введите ссылку">
                    <button class="form__error-button button" type="button">!<span class="visually-hidden">Информация об ошибке</span></button>
                    <div class="form__error-text">
                      <h3 class="form__error-title">Заголовок сообщения</h3>
                      <p class="form__error-desc">Текст сообщения об ошибке, подробно объясняющий, что не так.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form__invalid-block">
                <b class="form__invalid-slogan">Пожалуйста, исправьте следующие ошибки:</b>
                <ul class="form__invalid-list">
                  <li class="form__invalid-item">Заголовок. Это поле должно быть заполнено.</li>
                  <li class="form__invalid-item">Цитата. Она не должна превышать 70 знаков.</li>
                </ul>
              </div>
            </div>
            <div class="adding-post__buttons">
              <button class="adding-post__submit button button--main" type="submit">Опубликовать</button>
              <a class="adding-post__close" href="#">Закрыть</a>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</div>
