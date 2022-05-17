<?php

if (isset($_GET['filter'])) {
  $filter_value = $_GET['filter'];
} else {
  $filter_value = 'all';
}

?>

<div class="container">
  <h1 class="page__title page__title--feed">Моя лента</h1>
</div>
<div class="page__main-wrapper container">
  <section class="feed">
    <h2 class="visually-hidden">Лента</h2>
    <div class="feed__main-wrapper">
      <div class="feed__wrapper">
        <?php foreach ($posts as $post): ?>
          <?php if (get_type($post['type_post']) == 'photo'): ?>
            <?php if ((isset($_GET['filter']) and ($_GET['filter'] == 'photo') or isset($_GET['filter']) and $_GET['filter'] == 'all') or (!isset($_GET['filter']))): ?>
              <article class="feed__post post post-photo">
                <header class="post__header post__author">
                  <a class="post__author-link" href="profile.php?id=<?= $post['author_id']; ?>" title="Автор">
                    <div class="post__avatar-wrapper">
                      <img class="post__author-avatar" src="<?= $post['avatar']; ?>" alt="Аватар пользователя" width="60" height="60">
                    </div>
                    <div class="post__info">
                      <b class="post__author-name"><?= htmlspecialchars($post['login']); ?></b>
                      <span class="post__time">15 минут назад</span>
                    </div>
                  </a>
                </header>
                <div class="post__main">
                  <h2><a href="post.php?id=<?= $post['id']; ?>"><?= htmlspecialchars($post['caption']); ?></a></h2>
                  <div class="post-photo__image-wrapper">
                    <img src="<?= $post['img']; ?>" alt="Фото от пользователя" width="760" height="396">
                  </div>
                </div>
                <footer class="post__footer post__indicators">
                  <div class="post__buttons">
                    <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                      <svg class="post__indicator-icon" width="20" height="17">
                        <use xlink:href="#icon-heart"></use>
                      </svg>
                      <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                        <use xlink:href="#icon-heart-active"></use>
                      </svg>
                      <span>250</span>
                      <span class="visually-hidden">количество лайков</span>
                    </a>
                    <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                      <svg class="post__indicator-icon" width="19" height="17">
                        <use xlink:href="#icon-comment"></use>
                      </svg>
                      <span>25</span>
                      <span class="visually-hidden">количество комментариев</span>
                    </a>
                    <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
                      <svg class="post__indicator-icon" width="19" height="17">
                        <use xlink:href="#icon-repost"></use>
                      </svg>
                      <span>5</span>
                      <span class="visually-hidden">количество репостов</span>
                    </a>
                  </div>
                </footer>
              </article>
            <?php endif; ?>
          <?php elseif(get_type($post['type_post']) == 'text'): ?>
            <?php if ((isset($_GET['filter']) and ($_GET['filter'] == 'text') or isset($_GET['filter']) and $_GET['filter'] == 'all') or (!isset($_GET['filter']))): ?>
              <article class="feed__post post post-text">
                <header class="post__header post__author">
                <a class="post__author-link" href="profile.php?id=<?= $post['author_id']; ?>" title="Автор">
                  <div class="post__avatar-wrapper">
                    <img class="post__author-avatar" src="<?= $post['avatar']; ?>" alt="Аватар пользователя">
                  </div>
                  <div class="post__info">
                    <b class="post__author-name"><?= htmlspecialchars($post['login']); ?></b>
                    <span class="post__time">25 минут назад</span>
                  </div>
                </a>
              </header>
              <div class="post__main">
                <h2><a href="post.php?id=<?= $post['id']; ?>"><?= htmlspecialchars($post['caption']); ?></a></h2>
                <p>
                  <?= $post['content']; ?>
                </p>
                <a class="post-text__more-link" href="#">Читать далее</a>
              </div>
              <footer class="post__footer post__indicators">
                <div class="post__buttons">
                  <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                    <svg class="post__indicator-icon" width="20" height="17">
                      <use xlink:href="#icon-heart"></use>
                    </svg>
                    <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                      <use xlink:href="#icon-heart-active"></use>
                    </svg>
                    <span>250</span>
                    <span class="visually-hidden">количество лайков</span>
                  </a>
                  <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-comment"></use>
                    </svg>
                    <span>25</span>
                    <span class="visually-hidden">количество комментариев</span>
                  </a>
                  <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-repost"></use>
                    </svg>
                    <span>5</span>
                    <span class="visually-hidden">количество репостов</span>
                  </a>
                </div>
              </footer>
            </article>
          <?php endif; ?>
          <?php elseif(get_type($post['type_post']) == 'video'): ?>
            <?php if ((isset($_GET['filter']) and ($_GET['filter'] == 'video') or isset($_GET['filter']) and $_GET['filter'] == 'all') or (!isset($_GET['filter']))): ?>
            <article class="feed__post post post-video">
              <header class="post__header post__author">
                <a class="post__author-link" href="profile.php?id=<?= $post['author_id']; ?>" title="Автор">
                  <div class="post__avatar-wrapper">
                    <img class="post__author-avatar" src="<?= $post['avatar']; ?>" alt="Аватар пользователя">
                  </div>
                  <div class="post__info">
                    <b class="post__author-name"><?= $post['login']; ?></b>
                    <span class="post__time">5 часов назад</span>
                  </div>
                </a>
              </header>
              <div class="post__main">
                <div class="post-video__block">
                  <div class="post-video__preview">
                    <?= embed_youtube_video($post['video']); ?>
                  </div>
                  <div class="post-video__control">
                    <button class="post-video__play post-video__play--paused button button--video" type="button"><span class="visually-hidden">Запустить видео</span></button>
                    <div class="post-video__scale-wrapper">
                      <div class="post-video__scale">
                        <div class="post-video__bar">
                          <div class="post-video__toggle"></div>
                        </div>
                      </div>
                    </div>
                    <button class="post-video__fullscreen post-video__fullscreen--inactive button button--video" type="button"><span class="visually-hidden">Полноэкранный режим</span></button>
                  </div>
                  <button class="post-video__play-big button" type="button">
                    <svg class="post-video__play-big-icon" width="27" height="28">
                      <use xlink:href="#icon-video-play-big"></use>
                    </svg>
                    <span class="visually-hidden">Запустить проигрыватель</span>
                  </button>
                </div>
              </div>
              <footer class="post__footer post__indicators">
                <div class="post__buttons">
                  <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                    <svg class="post__indicator-icon" width="20" height="17">
                      <use xlink:href="#icon-heart"></use>
                    </svg>
                    <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                      <use xlink:href="#icon-heart-active"></use>
                    </svg>
                    <span>250</span>
                    <span class="visually-hidden">количество лайков</span>
                  </a>
                  <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-comment"></use>
                    </svg>
                    <span>25</span>
                    <span class="visually-hidden">количество комментариев</span>
                  </a>
                  <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-repost"></use>
                    </svg>
                    <span>5</span>
                    <span class="visually-hidden">количество репостов</span>
                  </a>
                </div>
              </footer>
            </article>
            <?php endif; ?>
          <?php elseif(get_type($post['type_post']) == 'quote'): ?>
            <?php if ((isset($_GET['filter']) and ($_GET['filter'] == 'quote') or isset($_GET['filter']) and $_GET['filter'] == 'all') or (!isset($_GET['filter']))): ?>
            <article class="feed__post post post-quote">
              <header class="post__header post__author">
                <a class="post__author-link" href="profile.php?id=<?= $post['author_id']; ?>" title="Автор">
                  <div class="post__avatar-wrapper">
                    <img class="post__author-avatar" src="<?= $post['avatar']; ?>" alt="Аватар пользователя">
                  </div>
                  <div class="post__info">
                    <b class="post__author-name"><?= htmlspecialchars($post['login']); ?></b>
                    <span class="post__time">2 дня назад</span>
                  </div>
                </a>
              </header>
              <div class="post__main">
                <blockquote>
                  <p>
                    <?= htmlspecialchars($post['content']); ?>
                  </p>
                  <cite><?= htmlspecialchars($post['author_quote']); ?></cite>
                </blockquote>
              </div>
              <footer class="post__footer post__indicators">
                <div class="post__buttons">
                  <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                    <svg class="post__indicator-icon" width="20" height="17">
                      <use xlink:href="#icon-heart"></use>
                    </svg>
                    <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                      <use xlink:href="#icon-heart-active"></use>
                    </svg>
                    <span>250</span>
                    <span class="visually-hidden">количество лайков</span>
                  </a>
                  <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-comment"></use>
                    </svg>
                    <span>25</span>
                    <span class="visually-hidden">количество комментариев</span>
                  </a>
                  <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-repost"></use>
                    </svg>
                    <span>5</span>
                    <span class="visually-hidden">количество репостов</span>
                  </a>
                </div>
              </footer>
            </article>
            <?php endif; ?>
          <?php elseif(get_type($post['type_post']) == 'link'): ?>
            <?php if ((isset($_GET['filter']) and ($_GET['filter'] == 'link') or isset($_GET['filter']) and $_GET['filter'] == 'all') or (!isset($_GET['filter']))): ?>
            <article class="feed__post post post-link">
              <header class="post__header post__author">
                <a class="post__author-link" href="profile.php?id=<?= $post['author_id']; ?>" title="Автор">
                  <div class="post__avatar-wrapper">
                    <img class="post__author-avatar" src="<?= $post['avatar']; ?>" alt="Аватар пользователя">
                  </div>
                  <div class="post__info">
                    <b class="post__author-name"><?= htmlspecialchars($post['login']); ?></b>
                    <span class="post__time">Месяц назад</span>
                  </div>
                </a>
              </header>
              <div class="post__main">
                <div class="post-link__wrapper">
                  <a class="post-link__external" href="<?= $post['site']; ?>" title="Перейти по ссылке">
                    <div class="post-link__icon-wrapper">
                      <img src="img/logo-vita.jpg" alt="Иконка">
                    </div>
                    <div class="post-link__info">
                      <h3><?= htmlspecialchars($post['caption']); ?></h3>
                      <span><?= htmlspecialchars($post['site']); ?></span>
                    </div>
                    <svg class="post-link__arrow" width="11" height="16">
                      <use xlink:href="#icon-arrow-right-ad"></use>
                    </svg>
                  </a>
                </div>
              </div>
              <footer class="post__footer post__indicators">
                <div class="post__buttons">
                  <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                    <svg class="post__indicator-icon" width="20" height="17">
                      <use xlink:href="#icon-heart"></use>
                    </svg>
                    <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                      <use xlink:href="#icon-heart-active"></use>
                    </svg>
                    <span>250</span>
                    <span class="visually-hidden">количество лайков</span>
                  </a>
                  <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-comment"></use>
                    </svg>
                    <span>25</span>
                    <span class="visually-hidden">количество комментариев</span>
                  </a>
                  <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
                    <svg class="post__indicator-icon" width="19" height="17">
                      <use xlink:href="#icon-repost"></use>
                    </svg>
                    <span>5</span>
                    <span class="visually-hidden">количество репостов</span>
                  </a>
                </div>
              </footer>
            </article>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
    <ul class="feed__filters filters">
      <li class="feed__filters-item filters__item">
        <a class="filters__button <?= ($filter_value == 'all') ? 'filters__button--active' : ''; ?>" href="feed.php?filter=all">
          <span>Все</span>
        </a>
      </li>
      <li class="feed__filters-item filters__item">
        <a class="filters__button filters__button--photo <?= ($filter_value == 'photo') ? 'filters__button--active' : ''; ?> button" href="feed.php?filter=photo">
          <span class="visually-hidden">Фото</span>
          <svg class="filters__icon" width="22" height="18">
            <use xlink:href="#icon-filter-photo"></use>
          </svg>
        </a>
      </li>
      <li class="feed__filters-item filters__item">
        <a class="filters__button filters__button--video <?= ($filter_value == 'video') ? 'filters__button--active' : ''; ?> button" href="feed.php?filter=video">
          <span class="visually-hidden">Видео</span>
          <svg class="filters__icon" width="24" height="16">
            <use xlink:href="#icon-filter-video"></use>
          </svg>
        </a>
      </li>
      <li class="feed__filters-item filters__item">
        <a class="filters__button filters__button--text <?= ($filter_value == 'text') ? 'filters__button--active' : ''; ?> button" href="feed.php?filter=text">
          <span class="visually-hidden">Текст</span>
          <svg class="filters__icon" width="20" height="21">
            <use xlink:href="#icon-filter-text"></use>
          </svg>
        </a>
      </li>
      <li class="feed__filters-item filters__item">
        <a class="filters__button filters__button--quote <?= ($filter_value == 'quote') ? 'filters__button--active' : ''; ?> button" href="feed.php?filter=quote">
          <span class="visually-hidden">Цитата</span>
          <svg class="filters__icon" width="21" height="20">
            <use xlink:href="#icon-filter-quote"></use>
          </svg>
        </a>
      </li>
      <li class="feed__filters-item filters__item">
        <a class="filters__button filters__button--link <?= ($filter_value == 'link') ? 'filters__button--active' : ''; ?> button" href="feed.php?filter=link">
          <span class="visually-hidden">Ссылка</span>
          <svg class="filters__icon" width="21" height="18">
            <use xlink:href="#icon-filter-link"></use>
          </svg>
        </a>
      </li>
    </ul>
  </section>
  <aside class="promo">
    <article class="promo__block promo__block--barbershop">
      <h2 class="visually-hidden">Рекламный блок</h2>
      <p class="promo__text">
        Все еще сидишь на окладе в офисе? Открой свой барбершоп по нашей франшизе!
      </p>
      <a class="promo__link" href="#">
        Подробнее
      </a>
    </article>
    <article class="promo__block promo__block--technomart">
      <h2 class="visually-hidden">Рекламный блок</h2>
      <p class="promo__text">
        Товары будущего уже сегодня в онлайн-сторе Техномарт!
      </p>
      <a class="promo__link" href="#">
        Перейти в магазин
      </a>
    </article>
    <article class="promo__block">
      <h2 class="visually-hidden">Рекламный блок</h2>
      <p class="promo__text">
        Здесь<br> могла быть<br> ваша реклама
      </p>
      <a class="promo__link" href="#">
        Разместить
      </a>
    </article>
  </aside>
</div>
