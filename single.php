<?php get_header(); 


$category = get_the_category();  
if ($category[0]->term_id == 28) {
  $isnews = true;
}

$prevPost = get_previous_post();
$nextPost = get_next_post();

$prevPostCategory = get_the_category($prevPost->ID);
$nextPostCategory = get_the_category($nextPost->ID);

?>


<section class="single-banner">
  <div class="container">
    <div class="single-banner__content">
     <h1><?php the_title(); ?></h1>
     <?php  if ($isnews) { ?>
      <p><?php the_time('n.j.Y'); ?></p>
     <?php } ?>
     
     <p class="single-banner__button">
       <?php echo get_the_category_list( ', ')  ?>
     </p>
    </div>
  </div>
</section>

<section class="single-text">
  <div class="container">
      <div class="single-text__desc">

        <p class="single-banner__button">
        <?php echo get_the_category_list( ', ')  ?>
        </p>
        
        
        <div class="separator"></div>
        <div class="single-text__content">
          <?php the_content(); ?>
        </div>
        <div class="single-text__adding">
        <?php 
            $relatedObjects = get_field('related_object');

            if ($relatedObjects) { ?>

              <div class="separator"></div>
              <h2>Связанные объекты: </h2>
              <?php 
              foreach($relatedObjects as $object) { ?>                                        
                <h5 class="card-title"> 
                    <a href="<?php echo get_the_permalink($object); ?>">
                      <?php echo get_the_title($object); ?>
                    </a>
                </h5>                                                                                                
              <?php }
            }            

          ?>
        </div>
      </div>

      <div class="single-links">
        <?php 
                   
          if (($category[0]->term_id == $prevPostCategory[0]->term_id) && $prevPost) { ?>
           <a href="<?php echo get_permalink($prevPost->ID); ?>">Предыдущая запись</a>

           <?php } 

          if (($category[0]->term_id == $nextPostCategory[0]->term_id) && $nextPost) { ?>
            <a href="<?php echo get_permalink($nextPost->ID); ?>">Следующая запись</a>

           <?php }  ?>

          
        
      </div>
  </div>
</section>


<?php get_footer(); ?>