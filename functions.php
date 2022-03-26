<?php 

// addint exerpts to pages

add_post_type_support('page', 'excerpt');

require get_theme_file_path('/includes/search-route.php');

// Add custom fields to REST API

function gisre_custop_rest() {
    register_rest_field('post', 'relatedObjects', array(
        'get_callback' => function(){
            return get_field('related_object');
        }
    ));
}

add_action('rest_api_init', 'gisre_custop_rest');

// Files js css

function gisre_files() {
    wp_enqueue_script('my-scripts', get_theme_file_uri('/build/index.js'), NULL, false, true);    
    wp_enqueue_style('gisre_test_styles', get_theme_file_uri('/build/index.css'));
    wp_localize_script('my-scripts', 'gisreData', array(
        'root_url' => get_site_url()
    ));
}


add_action('wp_enqueue_scripts', 'gisre_files');

// Features

function gisre_features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocation', 'Footer Menu Location');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('objectsOnMap', 600, 400, true);
    add_image_size('booksCover', 200, 250, true);
}


add_action('after_setup_theme', 'gisre_features');

// Some class for main menu

function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

// Dont show admin bar

show_admin_bar(false);

// Functions for content

function pageBanner($args = NULL) {
    if (!$args['title']) {
        $args['title'] = 'Welcome';      
    }

    if (!$args['desc']) {
        $args['desc'] = '';    
    }

    if (!$args['image']) {
        $args['image'] = 'assets/images/background-banner.jpg';    
    }

    ?>
        <section class="mainbanner" style="background-image: url(<?php echo get_theme_file_uri($args['image']); ?>)">
            <div class="container">
                <h1>
                    <?php echo $args['title'] ?>
                </h1>
                <div class="mainbanner__desc"><?php echo $args['desc'] ?></div>
            </div>
        </section>
    <?php
}

