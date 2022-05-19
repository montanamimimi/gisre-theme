<?php get_header(); ?>


<section class="single-banner">
  <div class="container">
    <div class="single-banner__content">
      <div class="single-banner__book">
       <div class="single-banner__img">
         <img src="<?php the_post_thumbnail_url(); ?>" alt="">
       </div>
       <div class="single-banner__desc">
        <h1><?php the_title(); ?></h1>
        <p class="single-banner__author">
          <b><?php echo __('Авторы', 'gisre-theme'); ?>:</b> <?php echo get_field('author'); ?>
        </p>
        <p class="single-banner__isbn">
          <b>ISBN:</b> <?php echo get_field('isbn'); ?>
        </p>
        <p class="single-banner__pages">
          <b><?php echo __('Количество страниц', 'gisre-theme'); ?>:</b> <?php echo get_field('pages'); ?>
        </p>
        <p class="single-banner__year">
          <b><?php echo __('Год выпуска', 'gisre-theme'); ?>:</b> <?php echo get_field('year'); ?>
        </p>
       </div>

      </div>


    </div>
  </div>
</section>

<section class="single-text">
  <div class="container">


      <div class="single-text__desc">
        
        <div class="single-text__content">
          <?php the_content(); ?>
        </div>

      </div>
      <div class="single-text__goback">
 
        <a href="<?php echo get_post_type_archive_link('book');  ?>"><?php echo __('Назад к списку книг', 'gisre-theme'); ?></a>
      </div>
  </div>
</section>



<?php get_footer(); ?>