<?php get_header(); ?>

<?php pageBanner(array(
  'title' => 'Новости',
  'desc' => '<p>Последние новости в мире возобновляемой энергетики</p>'
)); ?>



  <section class="catlist">
    <div class="container">

      <ul class="catlist__items">
            <?php 
            // $catlist = wp_list_categories(array(
            //         'title_li' => ''
            //   ));        
            ?>
      </ul>
    </div>
  </section>

  <section class="cards news__cards">
    <div class="container">
      <div class="cards__items">
        <?php         

          while(have_posts()) {
            the_post(); 
            get_template_part('template-parts/card');
            }  

          wp_reset_postdata();
        ?> 
      </div>
      <div class="pagination__items">
        <?php echo paginate_links(); ?>
      </div>

    </div>
  </section>


<?php get_footer(); ?>