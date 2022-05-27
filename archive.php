<?php get_header(); ?>

<?php pageBanner(array(
  'title' => get_the_archive_title(),
  'desc' => get_the_archive_description()
)); ?>

<section>
  <div class="container">
    <div class="parents">
      <?php

      if (is_archive()) { 
      
        $parentCategory = get_queried_object()->parent; 
        
        if ($parentCategory != 0) { ?>
          <div class="parents__show">          
            <a href="<?php echo get_category_link($parentCategory); ?>">
              Вернуться к разделу <?php echo get_cat_name($parentCategory); ?></a>
          </div>
        <?php } 
      } 

      if (is_tag()) { 

     //   $parentCategory = get_queried_object()->parent; 

        $backToList = array();

        while(have_posts()) {
          the_post(); 
          $parentCategory = get_the_category()[0]->parent;
          if ($parentCategory != 0) {
            array_push($backToList, $parentCategory);
          } else {
            array_push($backToList, get_the_category()[0]->term_id);
          }
          }  
        
        if (count($backToList) != 0) { 

          $cleatList = array_unique($backToList);
         

          foreach ($cleatList as $item) { ?>
            <div class="parents__show">          
              <a href="<?php echo get_category_link($item); ?>">
                Вернуться к разделу <?php echo get_cat_name($item); ?></a>
            </div>
          <?php } 
           } 
      }  ?>

    </div>
  </div>
</section>

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

      <div class="pagination__items">
        <?php echo paginate_links(); ?>
      </div>

    </div>
</section>


<?php get_footer(); ?>