
        <a href="<?php the_permalink(); ?>" class="cards__item">
          <div class="cards__item-container">
            <div class="cards__item-desc">
              <h3 class="cards__item-header">
                <?php the_title(); ?> 
              </h3>
              <span class="cards__item-date"><?php the_time('n.j.Y'); ?></span>
              <p class="cards__item-text">
              <?php 
                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                }
              ?>
              </p>
              <div class="cards__button">Читать далее</div>
            </div>
          
            <div class="cards__item-pic">
              <img src="<?php the_post_thumbnail_url('booksCover'); ?>" alt="">
            </div>
          </div>
        </a>        