<div class="links__card">
    <div class="links__image">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo esc_html ( get_the_title() ) ?>">
    </div>
    <div class="links__text">
        <h3><?php the_title(); ?></h3>        
        <?php the_content(); ?>
        <span><a href="<?php echo get_field('link'); ?>" target="_blank">Перейти на сайт</a></span>
    </div>
</div>
 