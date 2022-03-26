<?php get_header(); ?>

<?php pageBanner(array(
  'title' => 'Книги',
  'desc' => '<p>Тематические книги по теме Возобновляемая Энергетика</p>',
  'image' => 'assets/images/bookswallpaper.jpg'
)); ?>


<section class="cards">
    <div class="container">
      <div class="cards__items">
        <?php     
          while(have_posts()) {
            the_post(); 
            get_template_part('template-parts/card');
            }  
        ?> 
      </div>
      <?php echo paginate_links(); ?>
    </div>
</section>

<?php get_footer(); ?>