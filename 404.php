<?php get_header(); ?>



<section class="single-banner">
  <div class="container">
    <div class="single-banner__content">
     <h1><?php echo __('Ничего не найдено', 'gisre-theme'); ?></h1>
    </div>
  </div>
</section>

<section class="single-text">
  <div class="container">
      <div class="single-text__desc">
                <p>
                <?php echo __('Простите, мы ничего не нашли', 'gisre-theme'); ?>
                </p>
                <p>
                    <a href="<?php echo site_url(); ?>"><?php echo __('Вернуться на главную страницу', 'gisre-theme'); ?></a>
                </p>

      </div>
  </div>
</section>


<?php get_footer(); ?>