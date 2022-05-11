<?php get_header(); ?>



<?php etypeBanner(array(
  'title' => get_the_title(),
  'desc' => get_the_excerpt(),
  'image' => get_the_post_thumbnail_url()
)); ?>

<section class="single-text">
  <div class="container">
  <img src="<?php the_field('etype-icon') ?>" alt="<?php echo get_the_title() . ' иконка'; ?>" style="max-width: 100px">
      <div class="single-text__desc">
        
        <div class="single-text__content">
          <?php the_content(); ?>
        </div>

      </div>
  </div>
</section>

<?php get_footer(); ?>