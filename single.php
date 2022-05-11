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

     
     <p class="single-banner__button">
       <?php echo get_the_category_list( ', ')  ?>
     </p>
    </div>
  </div>
</section>

<section class="single-text">
  <div class="container">
      <div class="single-text__desc">

      <?php  if ($isnews) { ?>
      <p>Дата публикации: <?php the_time('j.n.Y'); ?></p>
     <?php } ?>
        
        
        <div class="separator"></div>
        
        <?php 
        $postImage = get_the_post_thumbnail_url();
          if ($postImage && $isnews) { ?>
            <div class="single-text__image">
              <img src="<?php echo $postImage ?>" alt="<?php echo esc_html ( get_the_title() ) ?>">
            </div>        
          <?php } ?>

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

      <?php 
        if (get_field('source')) { ?>

          Источник: <a href="<?php echo get_field('sourcelink'); ?>" target="_blank" rel="nofollow"><?php echo get_field('source'); ?></a>
        <?php }
      ?>

      <div class="single-link">

      </div>

      <div class="single-paginate">
        <div class="single-paginate__item">
          <?php previous_post_link( '%link', 'Предыдущий пост', true ); ?>
        </div>
        <div class="single-paginate__item">
          <?php next_post_link( '%link', 'Следующий пост', true ); ?>
        </div>
             
        
      </div>
      <div class="div"> 
      </div>
  </div>
</section>


<?php get_footer(); ?>