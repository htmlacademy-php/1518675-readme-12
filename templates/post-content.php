<main class="page__main page__main--publication">
  <div class="container">
    <h1 class="page__title page__title--publication"><?= htmlspecialchars($content['caption']); ?></h1>
    <section class="post-details">
      <h2 class="visually-hidden">Публикация</h2>
      <div class="post-details__wrapper post-photo">
        <div class="post-details__main-block post post--details">
          <?php

          $type_name = get_type($content['type_post']);
          $template_name = 'post-' . $type_name . '.php';

          $post_content = include_template($template_name, ['content' => $content]);
          print($post_content);

          ?>
          <div class="post__indicators">
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
            <span class="post__view">500 просмотров</span>
          </div>
          <ul class="post__tags">
            <?php foreach($hashtags as $hashtag): ?>
                <li><a href="/search.php?header-search=<?= substr($hashtag['hashtag'], 1); ?>"><?= $hashtag['hashtag']; ?></a></li>
            <?php endforeach; ?>
          </ul>
          <div class="comments">
            <form class="comments__form form" action="comment.php" method="post">
              <div class="comments__my-avatar">
                <img class="comments__picture" src="<?= $avatar_user; ?>" alt="Аватар пользователя">
              </div>
              <div class="form__input-section form__input-section--error">
                <textarea class="comments__textarea form__textarea form__input" name="text-content" id="text-content" placeholder="Ваш комментарий"></textarea>
                <input class="visually-hidden" name="id-post" id="id-post" type="text" value="<?= $content['id'] ?>">
                <input class="visually-hidden" name="id-user" id="id-user" type="text" value="<?= $user_id; ?>">
                <label class="visually-hidden">Ваш комментарий</label>
                <button class="form__error-button button" type="button">!</button>
                <div class="form__error-text">
                  <h3 class="form__error-title">Ошибка валидации</h3>
                  <p class="form__error-desc">Это поле обязательно к заполнению</p>
                </div>
              </div>
              <button class="comments__submit button button--green" type="submit">Отправить</button>
            </form>
            <div class="comments__list-wrapper">
              <ul class="comments__list">
                <?php foreach($comments as $comment): ?>
                    <li class="comments__item user">
                        <div class="comments__avatar">
                            <a class="user__avatar-link" href="#">
                                <img class="comments__picture" src="<?= $comment['avatar']; ?>" alt="Аватар пользователя">
                            </a>
                        </div>
                        <div class="comments__info">
                            <div class="comments__name-wrapper">
                                <a class="comments__user-name" href="#">
                                    <span><?= htmlspecialchars($comment['login']); ?></span>
                                </a>
                                <time class="comments__time" datetime="2019-03-20">1 ч назад</time>
                            </div>
                            <p class="comments__text"><?= htmlspecialchars($comment['content']); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
              </ul>
              <a class="comments__more-link" href="#">
                <span>Показать все комментарии</span>
                <sup class="comments__amount">45</sup>
              </a>
            </div>
          </div>
        </div>
        <div class="post-details__user user">
          <div class="post-details__user-info user__info">
            <div class="post-details__avatar user__avatar">
              <a class="post-details__avatar-link user__avatar-link" href="profile.php?id=<?= $user_id; ?>">
                <img class="post-details__picture user__picture" src="<?= $content['avatar']; ?>" alt="Аватар пользователя">
              </a>
            </div>
            <div class="post-details__name-wrapper user__name-wrapper">
              <a class="post-details__name user__name" href="profile.php?id=<?= $user_id; ?>">
                <span><?= htmlspecialchars($content['login']); ?></span>
              </a>
              <time class="post-details__time user__time" datetime="2014-03-20">5 лет на сайте</time>
            </div>
          </div>
          <div class="post-details__rating user__rating">
            <p class="post-details__rating-item user__rating-item user__rating-item--subscribers">
              <span class="post-details__rating-amount user__rating-amount"><?= $user_subscribers[0]; ?></span>
              <span class="post-details__rating-text user__rating-text">подписчиков</span>
            </p>
            <p class="post-details__rating-item user__rating-item user__rating-item--publications">
              <span class="post-details__rating-amount user__rating-amount"><?= $user_posts[0]; ?></span>
              <span class="post-details__rating-text user__rating-text">публикаций</span>
            </p>
          </div>
          <div class="post-details__user-buttons user__buttons">
            <form action="subscribe.php" method="post">
              <input class="visually-hidden" type="text" id="user-id" name="user-id" value="<?= $user_id; ?>">
              <button class="profile__user-button user__button user__button--subscription button button--main" style="width: 100%" type="submit"><?=$subscribed ? 'Подписаться' : 'Отписаться';?></button>
            </form>
            <a class="user__button user__button--writing button button--green" href="#">Сообщение</a>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
