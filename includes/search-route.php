<?php 

function gisreSearchResults($data) {

    $mainQuery = new WP_Query(array(  
        'posts_per_page' => -1,      
        'post_type' => array('eobject', 'post', 'page', 'book'),
        's' => sanitize_text_field($data['term'])
      ));

    $results = array(
        'generalInfo' => array(),        
        'eobjects' => array(),
        'books' => array()
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if ((get_post_type() == 'page') OR (get_post_type() == 'post')) {
            
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'link' => get_the_permalink(),
                'id' => get_the_id()
            ));
        }

        if (get_post_type() == 'eobject') {
            array_push($results['eobjects'], array(
                'title' => get_the_title(),
                'link' => get_the_permalink()
            ));
        }

        if (get_post_type() == 'book') {
            array_push($results['books'], array(
                'title' => get_the_title(),
                'link' => get_the_permalink()
            ));
        }

    }

    return $results;
}

function gisreRegisterSearch() {
    register_rest_route('gisre/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'gisreSearchResults'
    ));
}

add_action('rest_api_init', 'gisreRegisterSearch');