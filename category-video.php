<?php get_header(); ?>

<?php pageBanner(array(
  'title' => 'Видео контент',
  'desc' => 'Видеоматериалы и записи научных конференций'
)); ?>


<section>
  <div class="container">
    <h2>Сортировать по категории: </h2>
    <?php 
    
    foreach (get_categories(array ('parent' => 37)) as $category) { ?>
    <div class="video__list">
      <div class="video__item">
        <div class="video__image">
          <img src="<?php echo get_theme_file_uri('/assets/images/video-icon.png') ?>" alt="Video-icon">
        </div>
        <div class="video__desc">
          <div class="video__title">
            <h3><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name ?></a></h3>
          </div>

          <div class="video__text">
              <p><?php echo $category->description ?></p>
          </div>
        </div>
      </div>
    </div>
      
    <?php  } ?>

    <h2>Сортировать по тематике:</h2>

    <div class="tags">

    <?php 
   
    foreach (get_tags() as $tag) { ?>
      <div class="tags__item">
        <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name ?></a>
      </div>
    <?php } ?>
    </div>


  </div>
</section>


<section class="cards">
    <div class="container">

      <h2>Смотреть все видео:</h2>
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