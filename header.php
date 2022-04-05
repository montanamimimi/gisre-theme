<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset') ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?> 
    </head>
    <body <?php body_class(); ?> >
        <header class="header">
            <div class="container">
                <div class="header__container">
                    <div class="header__logo">
                        <a 
                            href="<?php if (get_locale() == 'ru_RU') { echo site_url(); } else { echo site_url('/en'); }?>" 
                            class="header__logo-link">
                          <img 
                               src="<?php echo get_theme_file_uri('/assets/images/logo.png') ?>" alt ="<?php bloginfo('description'); ?>" 
                               class="header__image">
                            <p class="header__sitename"> <?php echo __('ГИC&nbsp;ВИЭ', 'gisre-theme'); ?>  </p></a>                    
                    </div>
                    <a href="#" class="toggle-button">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </a>
                    <nav class="menu header__menu">
                        <?php 
                            wp_nav_menu(array(
                                'theme_location' => 'headerMenuLocation',
                                'menu_class' => 'nav',
                                'add_li_class' => 'nav-item'
                            ))                        
                        ?>
                    </nav>
                    <?php dynamic_sidebar('language_switcher'); ?>
                    <a class="header__search" id="search-btn" >
                        <svg class="header__search-img" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 64 64" width="64px" height="64px"><path d="M 24 2.8886719 C 12.365714 2.8886719 2.8886719 12.365723 2.8886719 24 C 2.8886719 35.634277 12.365714 45.111328 24 45.111328 C 29.036552 45.111328 33.664698 43.331333 37.298828 40.373047 L 52.130859 58.953125 C 52.130859 58.953125 55.379484 59.435984 57.396484 57.333984 C 59.427484 55.215984 58.951172 52.134766 58.951172 52.134766 L 40.373047 37.298828 C 43.331332 33.664697 45.111328 29.036548 45.111328 24 C 45.111328 12.365723 35.634286 2.8886719 24 2.8886719 z M 24 7.1113281 C 33.352549 7.1113281 40.888672 14.647457 40.888672 24 C 40.888672 33.352543 33.352549 40.888672 24 40.888672 C 14.647451 40.888672 7.1113281 33.352543 7.1113281 24 C 7.1113281 14.647457 14.647451 7.1113281 24 7.1113281 z"/></svg>
                    </a>
                </div>
            </div>
        </header>




     


