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
        
        <p><a href="<?php echo get_post_type_archive_link('eobject'); ?>" class="single-banner__link">К объектам</a></p>
        <div class="separator"></div>
        <div class="single-text__content">
          <?php the_content(); ?>
        </div>
        <div class="single-text__adding">

        <?php 

          $myLastObjects = new WP_Query(array(
            'posts_per_page' => 3,
            'post_type' => 'post',
            'meta_query' => array(array(
              'key' => 'related_object',
              'compare' => 'LIKE',
              'value' => '"' . get_the_ID() . '"'
            ))
          ));

          while($myLastObjects->have_posts()) {
            $myLastObjects->the_post(); ?>

          <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>


          <?php
            } 
            wp_reset_postdata();
          ?>
        </div>
      </div>
  </div>
</section>
    

<?php get_footer(); ?>