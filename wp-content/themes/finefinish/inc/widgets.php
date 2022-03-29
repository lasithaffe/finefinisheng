<?php

function register_widgets() {

    register_sidebar(array(
        'name' => 'Top Header',
        'id'    => 'ewd_top_header'
    ));
    
    register_sidebar(array(
        'name' => 'Footer Bottom',
        'id'    => 'ewd_footer_bottom',
        'before_widget' => ' ',
        'after_widget' => ' ',
        'before_title' => '<span style="display: none;">',
        'after_title' => '</span>',
    ));

    register_sidebar(array(
        'name' => 'Footer Social',
        'id'    => 'ewd_footer_social_bottom'
    ));

}

include(get_template_directory().'/partials/widgets/ewd_footer_bottom.php');
include(get_template_directory().'/partials/widgets/ewd_top_header.php');

function wpb_load_career_widget() {
    register_widget( 'wpb_top_header_widget' );
    register_widget( 'wpb_footer_bottom_widget' );
}

add_action( 'widgets_init', 'wpb_load_career_widget' );