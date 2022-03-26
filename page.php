<?php get_header(); ?>



<section class="single-banner">
  <div class="container">
    <div class="single-banner__content">
     <h1><?php the_title(); ?></h1>
     <p>

     <?php 
            $theParent = wp_get_post_parent_id(get_the_ID());

            if ($theParent) { ?>
                <a href="<?php echo get_permalink($theParent) ?>" >Go to <?php echo get_the_title($theParent) ?> </a>
                <?php 
            }
          ?>
     </p>
    </div>
  </div>
</section>

<section class="single-text">
  <div class="container">
      <div class="single-text__desc">
        
        <div class="single-text__content">
          <?php the_content(); ?>
        </div>
        <div class="single-text__adding">

        <?php 
        $hasChildren = get_pages(array(
          'child_of' => get_the_ID()
        ));

        if ($theParent or $hasChildren) { ?>
        <div >
        <ul >

          <?php 

            if ($theParent) {
              $findChildrenOf = $theParent;
            } else {
              $findChildrenOf = get_the_ID();
            }
            wp_list_pages(array(
              'title_li' => NULL,
              'child_of' => $findChildrenOf,
              'sort_column' => 'menu_order'
            ));
          ?>
        
          </ul>

      </div>
        <?php  } 
       
      ?>
        </div>
      </div>
  </div>
</section>



<?php get_footer(); ?>