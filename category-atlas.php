<?php get_header(); ?>

<?php pageBanner(array(
  'title' => "Атлас ресурсов солнечной энергии",
  'desc' => ""
)); ?>


<section class="cards">
    <div class="container">
      <div class="atlas">

        <h3>АТЛАС РЕСУРСОВ СОЛНЕЧНОЙ ЭНЕРГИИ НА ТЕРРИТОРИИ РОССИИ</h3>
        <p>Авторы: О.С. Попель, С.Е. Фрид, Ю.Г. Коломиец, С.В. Киселева, Е.Н. Терехова. </p>
        <p>Объединенный институт высоких температур РАН, Москва 2010 </p>

        <div class="atlas__content">
            <div class="atlas__pic">
                <img src="<?php echo get_theme_file_uri('/assets/images/atlas_gl.png') ?>" alt="">
            </div>
            <div class="atlas__text">
                <h4>Содержание: </h4>
                <ul>
                    <?php     
                    query_posts('cat=34&order=ASC');
                    while(have_posts()) {
                        the_post(); ?>
                        
                    <li><a href="<?php the_permalink(); ?>">       
                        <?php the_title(); ?>  
                        <?php 
                        if (has_excerpt()) {
                            echo get_the_excerpt();
                        } 
                        ?>
                    
                        </a></li>    
                    <?php  }  
                    ?> 
                </ul>
            </div>
        </div>

      </div>
      <?php echo paginate_links(); ?>
    </div>
</section>


<?php get_footer(); ?>