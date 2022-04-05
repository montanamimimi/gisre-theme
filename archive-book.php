<?php get_header(); ?>

<?php pageBanner(array(
  'title' => __('Книги', 'gisre-theme'),
  'desc' => '<p>' . __('Тематические книги по теме Возобновляемая Энергетика', 'gisre-theme') . '</p>',
  'image' => 'assets/images/bookswallpaper.jpg'
)); ?>



<section class="cards">
    <div class="container">
      <div class="cards__items">
        <?php     
          while(have_posts()) {
            the_post(); 
            get_template_part('template-parts/bookcard');
            }  
        ?> 
      </div>
      <?php echo paginate_links(); ?>
    </div>
</section>

<?php get_footer(); ?>