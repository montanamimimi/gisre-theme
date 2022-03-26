<?php get_header(); ?>


<section class="single-banner">
  <div class="container">
    <div class="single-banner__content">
     <h1><?php the_title(); ?></h1>
     <p><?php the_time('n.j.Y'); ?></p>
     <p class="single-banner__button">
       <?php echo get_the_category_list( ', ')  ?>
     </p>
    </div>
  </div>
</section>

<section class="single-text">
  <div class="container">
      <div class="single-text__desc">
        
        <p><a href="<?php echo get_post_type_archive_link('post'); ?>" class="single-banner__link">К новостям</a></p>
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
  </div>
</section>


<?php get_footer(); ?>