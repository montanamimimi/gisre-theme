<?php get_header(); ?>

<?php pageBanner(array(
  'title' => __('Ссылки по теме', 'gisre-theme'),
  'desc' => '<p>' . __('Подборка онлайн ресурсов по теме ВИЭ', 'gisre-theme') . '</p>',
  'image' => 'assets/images/linksswallpaper.jpg'
)); ?>



<section class="links">
    <div class="container">
      <div class="links__items">
        <?php     
          while(have_posts()) {
            the_post(); 
            get_template_part('template-parts/linkcard');
            }  
        ?> 
      </div>
    </div>
</section>

<?php get_footer(); ?>