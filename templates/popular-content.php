<?php

require_once('config.php');
require_once('utils.php');

$filter_value = 'all';

if (isset($_GET['filter']))
{
  $filter_value = $_GET['filter'];
};

?>

<div class="container">
  <h1 class="page__title page__title--popular">Популярное</h1>
</div>
<div class="popular container">
  <div class="popular__filters-wrapper">
    <div class="popular__sorting sorting" style="max-width: 560px;">
      <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
      <ul class="popular__sorting-list sorting__list">
        <li class="sorting__item sorting__item--popular">
          <form action="popular.php" method="get">
            <input class="visually-hidden" type="text" id="filter" name="filter" value="<?= isset($_GET['filter']) ? $_GET['filter'] : 'all'; ?>">
            <input class="visually-hidden" type="text" name="page" value="<?= $current_page; ?>">
            <input class="visually-hidden" type="text" name="order" value="<?= 'id'; ?>">
            <button class="sorting__link <?= (isset($_GET['order']) and ($_GET['order'] === 'id') or $sorting === 'counter') ? 'sorting__link--active' : ''; ?>" type="submit" style="border: 0; background: transparent; cursor: pointer;">
              <span>Популярность</span>
              <svg class="sorting__icon" width="10" height="12">
                <use xlink:href="#icon-sort"></use>
              </svg>
            </button>
          </form>
        </li>
        <li class="sorting__item">
          <form action="popular.php" method="get">
            <input class="visually-hidden" type="text" id="filter" name="filter" value="<?= isset($_GET['filter']) ? $_GET['filter'] : 'all'; ?>">
            <input class="visually-hidden" type="text" name="page" value="<?= $current_page; ?>">
            <input class="visually-hidden" type="text" name="order" value="<?= 'counter'; ?>">
            <button class="sorting__link <?= (isset($_GET['order']) and ($_GET['order'] === 'counter')) ? 'sorting__link--active' : ''; ?>" type="submit" style="border: 0; background: transparent; cursor: pointer;">
              <span>Лайки</span>
              <svg class="sorting__icon" width="10" height="12">
                <use xlink:href="#icon-sort"></use>
              </svg>
            </button>
          </form>
        </li>
        <li class="sorting__item">
          <form action="popular.php" method="get">
            <input class="visually-hidden" type="text" id="filter" name="filter" value="<?= isset($_GET['filter']) ? $_GET['filter'] : 'all'; ?>">
            <input class="visually-hidden" type="text" name="page" value="<?= $current_page; ?>">
            <input class="visually-hidden" type="text" name="order" value="<?= 'date'; ?>">
            <button class="sorting__link <?= (isset($_GET['order']) and ($_GET['order'] === 'date')) ? 'sorting__link--active' : ''; ?>" type="submit" style="border: 0; background: transparent; cursor: pointer;">
              <span>Дата</span>
              <svg class="sorting__icon" width="10" height="12">
                <use xlink:href="#icon-sort"></use>
              </svg>
            </button>
          </form>
        </li>
      </ul>
    </div>
    <div class="popular__filters filters">
      <b class="popular__filters-caption filters__caption">Тип контента:</b>
      <ul class="popular__filters-list filters__list">
        <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
          <a class="filters__button filters__button--ellipse filters__button--all <?php print ($filter_value === 'all') ? 'filters__button--active' : ''; ?>" href="popular.php?filter=all">
            <span>Все</span>
          </a>
        </li>
        <li class="popular__filters-item filters__item">
          <a class="filters__button filters__button--photo button <?php print ($filter_value === 'photo') ? 'filters__button--active' : ''; ?>" href="popular.php?filter=photo">
            <span class="visually-hidden">Фото</span>
            <svg class="filters__icon" width="22" height="18">
              <use xlink:href="#icon-filter-photo"></use>
            </svg>
          </a>
        </li>
        <li class="popular__filters-item filters__item">
          <a class="filters__button filters__button--video button <?php print ($filter_value === 'video') ? 'filters__button--active' : ''; ?>" href="popular.php?filter=video">
            <span class="visually-hidden">Видео</span>
            <svg class="filters__icon" width="24" height="16">
              <use xlink:href="#icon-filter-video"></use>
            </svg>
          </a>
        </li>
        <li class="popular__filters-item filters__item">
          <a class="filters__button filters__button--text button <?php print ($filter_value === 'text') ? 'filters__button--active' : ''; ?>" href="popular.php?filter=text">
            <span class="visually-hidden">Текст</span>
            <svg class="filters__icon" width="20" height="21">
              <use xlink:href="#icon-filter-text"></use>
            </svg>
          </a>
        </li>
        <li class="popular__filters-item filters__item">
          <a class="filters__button filters__button--quote button <?php print ($filter_value === 'quote') ? 'filters__button--active' : ''; ?>" href="popular.php?filter=quote">
            <span class="visually-hidden">Цитата</span>
            <svg class="filters__icon" width="21" height="20">
              <use xlink:href="#icon-filter-quote"></use>
            </svg>
          </a>
        </li>
        <li class="popular__filters-item filters__item">
          <a class="filters__button filters__button--link button <?php print ($filter_value === 'link') ? 'filters__button--active' : ''; ?>" href="popular.php?filter=link">
            <span class="visually-hidden">Ссылка</span>
            <svg class="filters__icon" width="21" height="18">
              <use xlink:href="#icon-filter-link"></use>
            </svg>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="popular__posts">
    <?php foreach ($posts as $post): ?>
      <article class="popular__post post post-<?= get_type($post['type_post']); ?>">
        <header class="post__header">
          <?php if (!empty($post['caption'])): ?>
            <a href="post.php?id=<?= $post['id']; ?>">
              <h2><?= htmlspecialchars($post['caption']); ?></h2>
            </a>
          <?php endif; ?>
        </header>
        <div class="post__main">
          <?php if (get_type($post['type_post']) === 'quote'): ?>
            <blockquote>
              <p><?= htmlspecialchars($post['content']); ?></p>
              <cite><?= htmlspecialchars($post['author_quote']); ?></cite>
            </blockquote>
          <?php elseif (get_type($post['type_post']) === 'text'): ?>
            <?= cut_long_text($post['content'], TEXT_LIMIT); ?>
          <?php elseif (get_type($post['type_post']) === 'photo'): ?>
            <div class="post-photo__image-wrapper">
              <img src="<?= htmlspecialchars($post['img']) ?>" alt="Фото от пользователя" width="360" height="240">
            </div>
          <?php elseif (get_type($post['type_post']) === 'video'): ?>
            <div class="post-video__block">
              <div class="post-video__preview">
                <?= embed_youtube_cover($post['video']); ?>
              </div>
              <a href="<?= $post['video']; ?>" class="post-video__play-big button">
                <svg class="post-video__play-big-icon" width="14" height="14">
                  <use xlink:href="#icon-video-play-big"></use>
                </svg>
                <span class="visually-hidden">Запустить проигрыватель</span>
              </a>
            </div>
          <?php elseif (get_type($post['type_post']) === 'link'): ?>
            <div class="post-link__wrapper">
              <a class="post-link__external" href="<?= htmlspecialchars($post['site']); ?>" title="Перейти по ссылке">
                <div class="post-link__info-wrapper">
                  <div class="post-link__icon-wrapper">
                    <img src="https://www.google.com/s2/favicons?domain=vitadental.ru" alt="Иконка">
                  </div>
                  <div class="post-link__info">
                    <?php if (!empty($post['caption'])): ?>
                      <h3><?= htmlspecialchars($post['caption']); ?></h3>
                    <?php endif; ?>
                  </div>
                </div>
                <span><?= htmlspecialchars($post['content']); ?></span>
              </a>
            </div>
          <?php endif; ?>
        </div>
        <footer class="post__footer">
          <div class="post__author">
            <a class="post__author-link" href="profile.php?id=<?= $post['author_id']; ?>" title="Автор">
              <div class="post__avatar-wrapper">
                <img class="post__author-avatar" src="<?= $post['avatar'] ?>" alt="Аватар пользователя">
              </div>
              <div class="post__info">
                <b class="post__author-name"><?= htmlspecialchars($post['login']); ?></b>
                <time class="post__time" datetime="" title="<?= $pastFormatted; ?>">
                  <?php

                  date_default_timezone_set('Europe/Samara');

                  $myDate = generate_random_date($post);
                  $today = date_create('now');
                  $past = date_create($myDate);

                  $todayFormatted = date_format($today, 'Y-m-d H:i:s');
                  $pastFormatted = date_format($past, 'Y-m-d H:i:s');

                  $todayTime = strtotime($todayFormatted);
                  $pastTime = strtotime($pastFormatted);

                  $diff = $todayTime - $pastTime;

                  $minutes = $diff / 60;
                  $hours = $diff / (60 * 60);
                  $days = $diff / (60 * 60 * 24);

                  if (($diff / 60) < 60) {
                    print($minutes . get_noun_plural_form($minutes, ' минута', ' минуты', ' минут') . ' назад');
                  } elseif (($diff / (60 * 60)) < 24) {
                    print($hours . get_noun_plural_form($hours, ' час', ' часов', ' часов') . ' назад');
                  } elseif (($diff / (60 * 60 * 24)) <= 34) {
                    print(floor($days / 7) . get_noun_plural_form(floor($days / 7), ' неделя', ' недели', ' недель') . ' назад');
                  } elseif (($diff / (60 * 60 * 24)) > 35) {
                    print(floor($days / 30) . get_noun_plural_form(floor($days / 30), ' месяц', ' месяца', ' месяцев') . ' назад');
                  }
                  ?>
                </time>
              </div>
            </a>
          </div>
          <div class="post__indicators">
            <div class="post__buttons">
              <form action="like.php" method="post">
                <button type="submit" class="post__indicator post__indicator--likes button" title="Лайк">
                  <svg class="post__indicator-icon" width="20" height="17">
                    <use xlink:href="#icon-heart"></use>
                  </svg>
                  <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                    <use xlink:href="#icon-heart-active"></use>
                  </svg>
                  <span><?= $post['counter']; ?></span>
                  <span class="visually-hidden">количество лайков</span>
                </button>
                <input class="visually-hidden" name="post-id" id="post-id" value="<?= $post['id']; ?>">
              </form>
              <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                <svg class="post__indicator-icon" width="19" height="17">
                  <use xlink:href="#icon-comment"></use>
                </svg>
                <span>0</span>
                <span class="visually-hidden">количество комментариев</span>
              </a>
            </div>
          </div>
        </footer>
      </article>
    <?php endforeach; ?>
  </div>
  <div class="popular__page-links">
    <form action="popular.php" method="get" style="<?= (($total_pages == 1) or ($current_page == 1)) ? 'opacity: 0.3; pointer-events: none; cursor: default;' : ''; ?>">
      <input class="visually-hidden" type="text" id="filter" name="filter" value="<?= isset($_GET['filter']) ? $_GET['filter'] : 'all'; ?>">
      <input class="visually-hidden" type="text" name="page" value="<?= $current_page - 1; ?>">
      <input class="popular__page-link popular__page-link--prev button button--gray" type="submit" value="Предыдущая страница" style="width: 100%; padding: 26px 160px;">
    </form>
    <form class="" action="popular.php" method="get" style="<?= ($total_pages == $current_page) ? 'opacity: 0.3; pointer-events: none; cursor: default;' : ''; ?>">
      <input class="visually-hidden" type="text" id="filter" name="filter" value="<?= isset($_GET['filter']) ? $_GET['filter'] : 'all'; ?>">
      <input class="visually-hidden" type="text" name="page" value="<?= $current_page + 1; ?>">
      <input class="popular__page-link popular__page-link--next button button--gray" type="submit" value="Следующая страница" style="width: 100%; padding: 26px 160px;">
    </form>
  </div>
</div>
