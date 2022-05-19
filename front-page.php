<?php get_header(); ?>

  <section class="hero" style="
    background: url(<?php echo get_theme_file_uri('/assets/images/background.jpg') ?>);     
    background-size: cover;
    background-position: center;">
        <div class="container">
            <div class="hero__box">
                <div class="hero__text">
                    <h1 class="hero__slogan">
                    <?php echo __('ГИС Возобновляемые Источники Энергии России', 'gisre-theme'); ?> 
                    </h1>
                </div>
            </div>
        </div>
  </section>
  <section class="reasons">
        <div class="container">
            <h2 class="reasons__header"><?php echo __('Отрасли возобновляемой энергетики', 'gisre-theme'); ?></h2>
            <div class="reasons__items">

              <?php 
                $etypes = new WP_Query(array(
                  'post_type' => 'etype',
                  'order' => 'ASC'
                ));
            
                while($etypes->have_posts()) {
                  $etypes->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="reasons__item">

                    <div class="reasons__container">
                        <img src="<?php the_field('etype-icon') ?>" alt="" class="reasons__item-img">
                        <h3 class="reasons__item-header"><?php the_title(); ?></h3>
                        <p class="reasons__item-desc"><?php the_excerpt(); ?></p>
                    </div>
                    </a>      
                  <?php } 
                  
              ?>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="about__container">
                <div class="about__image">
                    <img src="<?php echo get_theme_file_uri('/assets/images/background.jpg') ?>" alt="">
                </div>
                <div class="about__text">
                    <h2 class="about__header"><?php echo __('О проекте', 'gisre-theme'); ?></h2>
                    <p>
                    <?php echo __('Проект «Геоинформационная система «Возобновляемые источники энергии России» (ГИС ВИЭР) выполняется совместно географическим факультетом МГУ (лаборатория возобновляемых источников энергии (НИЛ ВИЭ)) и Объединенным институтом высоких температур РАН (лаборатория возобновляемых источников энергии). Осуществление проекта было начато в рамках выполнения Государственного контракта № 14.740.11.0096 по Федеральной целевой программе «Научные и научно-педагогические кадры инновационной России» на 2009-2013 годы.', 'gisre-theme'); ?>    
                    
                    </p>
                </div>
            </div>
        </div>
    </section>



    <section class="news">
        <div class="container">
            <h3 class="news__header">
            <?php echo __('Новости ВИЭ', 'gisre-theme'); ?>
            </h3>

            <div class="news__items">



            <?php 

              $myLastPosts = new WP_Query(array(
                'posts_per_page' => 3,
                'cat' => 28
              ));

              while($myLastPosts->have_posts()) {
                $myLastPosts->the_post(); ?>

                <h1> <?php 

                $isHaveImage = get_the_post_thumbnail_url();


                // if ($a) {
                  
                // print_r($a);
                // } else {
                  
                // print_r('AAAAAAAAAAAAAAA');
                // }
                

                
                ?></h1>

                <a href="<?php the_permalink(); ?>#111" class="news__item" style="background-image:url('<?php 
                      if ($isHaveImage) {
                        the_post_thumbnail_url('newsFrontpage');
                      } else {
                        echo get_theme_file_uri('assets/images/news_basic.jpg');
                      }
                    ?>');">
                    <div class="news__item-card">
                        <div class="news__item-desc">
                            <h4 class="news__item-header">
                                   <?php the_title(); ?> 
                            </h4>
                            <span class="news__item-date">
                            <?php the_time('j.n.Y'); ?>
                            </span>
                            <p class="news__item-text">
                            <?php
                                  if (has_excerpt()) {
                                    echo get_the_excerpt();
                                  } else {
                                    echo wp_trim_words(get_the_content(), 18);
                                  }          
                                  ?> 
                            </p>
                        </div>       
                    </div>             
                </a>                
                                
                <?php
              } 
              wp_reset_postdata();
            ?>
            </div>
        </div>
    </section>


    <section class="subscribe" style="background: url(<?php echo get_theme_file_uri('/assets/images/subscribe_bg.jpg') ?>);     background-size: cover;
    background-position: center;">
        <div class="container">

        </div>
    </section>


    <section class="partners">
        <div class="container">
            <div class="partners__items">
                <div class="partners__item">
                    <img src="<?php echo get_theme_file_uri('/assets/images/logo02.png') ?>" alt="" class="partners__image">
                    <p class="partners__text">
                    <?php echo __('Географический факультет МГУ', 'gisre-theme'); ?>
                    </p>
                </div>
                <div class="partners__item partners__item_dark">
                    <img src="<?php echo get_theme_file_uri('/assets/images/logo01.png') ?>" alt="" class="partners__image">
                    <p class="partners__text">
                    <?php echo __('ГИС ВИЭ', 'gisre-theme'); ?>
                    </p>
                </div>
                <div class="partners__item">
                    <img src="<?php echo get_theme_file_uri('/assets/images/logo03.png') ?>" alt="" class="partners__image">
                    <p class="partners__text">
                    <?php echo __('ОИВТ РАН', 'gisre-theme'); ?>
                    </p>
                </div>
            </div>

        </div>
    </section>


  <?php get_footer(); ?>