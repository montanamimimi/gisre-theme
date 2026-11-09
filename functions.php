<?php 

require_once( get_template_directory() . "/includes/helpers.php" );
require_once( get_template_directory() . "/includes/search-route.php" );

class GisreTheme {
    private $version;

    public function init() 
    {
        $this->version = wp_get_theme()->get('Version');
        add_post_type_support('page', 'excerpt');
        add_action('rest_api_init', [ $this, 'gisreCustomRest']);
        add_action( 'wp_enqueue_scripts', [ $this, 'assets' ] );
        add_action('after_setup_theme', [$this, 'features' ]);
        add_filter('nav_menu_css_class', [$this, 'styles' ], 1, 3);
        add_action('init', [$this, 'postTypes' ]);
        add_action('widgets_init', [ $this, 'widgets' ]);
        add_action('pre_get_posts', [ $this, 'queries' ]);
        add_action( 'init', [ $this, 'settings'] );
        add_filter('rest_authentication_errors', [ $this, 'closeRestApi' ]);
        // show_admin_bar(false);
    }

    public function gisreCustomRest()
    {
        register_rest_field('post', 'relatedObjects', array(
            'get_callback' => function(){
                return get_field('related_object');
            }
        ));
    }

    public function assets()
    {
        wp_enqueue_script('my-scripts', get_theme_file_uri('/build/index.js'), [], $this->version, true);    
        wp_enqueue_style('gisre_test_styles', get_theme_file_uri('/build/index.css'), [], $this->version);
        wp_localize_script('my-scripts', 'gisreData', array(
            'root_url' => get_site_url()
        ));
    }

    public function features() {
        register_nav_menu('headerMenuLocation', 'Header Menu Location');
        register_nav_menu('footerMenuLocation', 'Footer Menu Location');
        register_nav_menu('footerMenuLocation2', 'Footer Menu Location 2');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('newsFrontpage', 455, 375, true);
        load_theme_textdomain('gisre-theme', get_template_directory() . '/languages');
    }

    public function styles($classes, $item, $args) {
        if(isset($args->add_li_class)) {
            $classes[] = $args->add_li_class;
        }
        return $classes;
    }

	public function closeRestApi($result) 
	{
		if (!empty($result)) {
			return $result;
		}

		if (!current_user_can('edit_posts')) {
			return new WP_Error(
				'rest_not_allowed',
				'REST API access is restricted.',
				['status' => 401]
			);
		}

		return $result;
	}    

    public function postTypes() {

        register_post_type( 'etype', array(    
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
            'taxonomies'  => array( 'category' ),
            'rewrite' => array(
                'slug' => 'energytypes'
            ),
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Виды энергии',
                'add_new_item' => 'Добавить вид',
                'edit_item' => 'Редактировать вид',
                'all_items' => 'Все виды',
                'singular_name' => 'Вид энергии'
            ),
            'menu_icon' => 'dashicons-carrot'
        ));

        register_post_type( 'book', array(        
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
            'taxonomies'  => array( 'category' ),
            'rewrite' => array(
                'slug' => 'books'
            ),
            'has_archive' => true,
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Книги',
                'add_new_item' => 'Добавить новую книгу',
                'edit_item' => 'Редактировать книгу',
                'all_items' => 'Все книги',
                'singular_name' => 'Книга'
            ),
            'menu_icon' => 'dashicons-book'
        ));    

        register_post_type( 'link', array(        
            'supports' => array('title', 'editor', 'thumbnail'),
            'taxonomies'  => array( 'links' ),
            'rewrite' => array(
                'slug' => 'links'
            ),
            'has_archive' => true,
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Ссылки',
                'add_new_item' => 'Добавить новую ссылку',
                'edit_item' => 'Редактировать ссылку',
                'all_items' => 'Все ссылки',
                'singular_name' => 'Ссылка'
            ),
            'menu_icon' => 'dashicons-admin-links'
        ));    
        
    }

    public function widgets() {
        register_sidebar( array(
            'name' => esc_html__('Polylangplace', 'gisretranslate'),
            'id' => 'language_switcher',
            'description' => esc_html__('Add widgets here', 'gisretranslate'),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        ) );
    }

    public function queries($query) {

        if ($query->is_main_query() && ! is_admin()) {

            // Links section

            if ($query->is_post_type_archive('link')) {
                $query->set('posts_per_page' , -1);
            }

            // News section

            if ($query->is_home() ) {
                $query->set('cat' , 28);
            }

        }
    }

    public function settings() {
        if( function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title' => 'Site Settings',
                'menu_title' => 'Site Settings',
                'menu_slug' => 'theme-settings',
                'capability' => 'publish_pages',
                'redirect' => false
            ]);						
        }

    }    
}

$theme = new GisreTheme();
$theme->init();