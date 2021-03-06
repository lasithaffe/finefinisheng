<?php

function ewd_register_styles(){


    wp_register_style('ewd_bootstrap',get_template_directory_uri().'/assets/css/bootstrap-reboot.min.css');
    wp_register_style('ewd_bootstrap_grid',get_template_directory_uri().'/assets/css/bootstrap-grid.min.css');
    wp_register_style('ewd_owd_carousal',get_template_directory_uri().'/assets/css/owl.carousel.min.css');
    wp_register_style('ewd_owl_theme',get_template_directory_uri().'/assets/css/owl.theme.default.min.css');
    wp_register_style('ewd_aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
    wp_register_style('ewd_hover',get_template_directory_uri().'/assets/css/hover.css');
    wp_register_style('ewd_circle',get_template_directory_uri().'/assets/css/circle.css');
    wp_register_style('ewd_yb',get_template_directory_uri().'/assets/css/YouTubePopUp.css');
    wp_register_style('ewd_style',get_template_directory_uri().'/assets/css/style.css');
    wp_register_style('ewd_res',get_template_directory_uri().'/assets/css/responsive.css');

    wp_enqueue_style('ewd_bootstrap');
    wp_enqueue_style('ewd_bootstrap_grid');
    wp_enqueue_style('ewd_aos');
    wp_enqueue_style('ewd_owd_carousal');
    wp_enqueue_style('ewd_owl_theme');
    wp_enqueue_style('ewd_hover');
    wp_enqueue_style('ewd_circle');
    wp_enqueue_style('ewd_yb');
    wp_enqueue_style('ewd_style');
    wp_enqueue_style('ewd_res');


}

function ewd_register_scripts(){

    wp_register_script('ewd_jquery',get_template_directory_uri().'/assets/js/jquery-3.3.1.min.js',array(),null,true);
    wp_register_script('ewd_aos','https://unpkg.com/aos@2.3.1/dist/aos.js',array(),null,true);
    wp_register_script('ewd_owd_carousal',get_template_directory_uri().'/assets/js/owl.carousel.js',array(),null,true);
    wp_register_script('ewd_youtube',get_template_directory_uri().'/assets/js/YouTubePopUp.jquery.js',array(),null,true);
    wp_register_script('ewd_custom',get_template_directory_uri().'/assets/js/custom.js',array(),null,true);
    wp_register_script('ewd_validator','https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js',array(),null,true);
    wp_register_script('ewd_careers',get_template_directory_uri().'/assets/js/careers.js',array(),null,true);

    wp_enqueue_script('ewd_jquery');
    wp_enqueue_script('ewd_aos');
    wp_enqueue_script('ewd_owd_carousal');
    wp_enqueue_script('ewd_youtube');
    wp_enqueue_script('ewd_custom');

    if(is_page('careers')){
        wp_enqueue_script('ewd_validator');
        wp_enqueue_script('ewd_careers');
    }
}