<?php



add_action( 'rest_api_init', function () {
    add_filter( 'allowed_http_origin', '__return_true' );
    header("access-control-allow-origin: *");


    register_rest_route( 'api/careers', '/get', array(
        'methods' => 'GET',
        'callback' => 'get_careers'
    ) );



    header("Access-Control-Allow-Origin: *");
} );

function get_careers(WP_REST_Request $request){

    $response = array();
    $inputs =  $request->get_params();

    $args = array(
        'post_type' => 'career',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'career_categories',
                'field'    => 'slug',
                'terms'    => $inputs['slug']
            )
        ),
    );

    $careers = new WP_Query($args);

    while($careers->have_posts()){
        $careers->the_post();
        $response[] = array(
                            'title'=>get_the_title(),
                            'description'=>get_the_content(),
                            'date'=>get_the_modified_date('M d, Y')
                        );
    }
    wp_reset_query();

    return $response;
}
