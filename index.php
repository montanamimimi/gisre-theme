<?php get_header(); ?>

<?php pageBanner(array(
  'title' => 'Новости',
  'desc' => '<p>Последние новости в мире возобновляемой энергетики</p>'
)); ?>



  <section class="catlist">
    <div class="container">

      <ul class="catlist__items">
            <?php $catlist = wp_list_categories(array(
                    'title_li' => ''
              ));        
            ?>
      </ul>
    </div>
  </section>

  <section class="cards">
    <div class="container">
      <div class="cards__items">
        <?php   
        
          query_posts('cat=28');

          while(have_posts()) {
            the_post(); 
            get_template_part('template-parts/card');
            }  

          wp_reset_postdata();
        ?> 
      </div>
      <?php echo paginate_links(); ?>
    </div>
  </section>


<?php get_footer(); ?>