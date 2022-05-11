
        <a href="<?php the_permalink(); ?>" class="cards__item">
          <div class="cards__item-container">
            <div class="cards__item-desc">
              <h3 class="cards__item-header">
                <?php the_title(); ?> 
              </h3>
              <div class="cards__item-book-info"><?php echo __('Год выпуска', 'gisre-theme'); ?>: <?php echo get_field('year'); ?><br>
              <?php echo __('Авторы', 'gisre-theme'); ?>: <?php echo get_field('author'); ?></div>
              <p class="cards__item-text">
              <?php 
                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 10);
                }
              ?>
              </p>
              <div class="cards__button"><?php echo __('Подробная информация', 'gisre-theme'); ?></div>
            </div>
          
            <div class="cards__item-pic" style="background-image: url(<?php  the_post_thumbnail_url(); ?>);">            
            </div>
          </div>
        </a>        