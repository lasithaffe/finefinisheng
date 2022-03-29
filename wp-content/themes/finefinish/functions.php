<?php
/**
 * Created by PhpStorm.
 * User: Tauseef
 */

/* Config Variables */
define('ASSETS_IMAGE',get_template_directory_uri().'/assets/img/');
define('ASSETS_CSS',get_template_directory_uri().'/assets/css/');
define('ASSETS_JS',get_template_directory_uri().'/assets/js/');
define('ASSETS_RESUME',get_template_directory_uri().'/uploads/resume/');

/* Set up site*/
add_theme_support( 'custom-logo' );
add_theme_support( 'menu' );
add_theme_support( 'post-thumbnails' );

/* Includes */

if (!class_exists('Exception')) {
    //require 'inc/modules/PHPMailer/src/Exception.php';
}

if (!class_exists('PHPMailer')) {
    //require 'inc/modules/PHPMailer/src/PHPMailer.php';
}

if (!class_exists('SMTP')) {
    //require 'inc/modules/PHPMailer/src/SMTP.php';
}

//require 'inc/modules/PHPMailer/src/Exception.php';
//require 'inc/modules/PHPMailer/src/PHPMailer.php';
//require 'inc/modules/PHPMailer/src/SMTP.php';


include(get_template_directory().'/admin/ajex-routes.php');
include(get_template_directory().'/admin/request-handling.php');
include(get_template_directory().'/inc/menu.php');
include(get_template_directory().'/inc/enqueue.php');
include(get_template_directory().'/inc/widgets.php');

/* Action Filters*/
add_action( 'widgets_init', 'register_widgets' );
add_action('wp_enqueue_scripts','ewd_register_styles');
add_action('wp_enqueue_scripts','ewd_register_scripts');
add_action( 'init', 'register_ewd_menus' );
add_action( 'after_setup_theme', 'wp_post_image_sizes' );
add_action('acf/init', 'my_acf_init');

/* Short Codes*/


/* Functions */

function wp_post_image_sizes() {
//    add_image_size( 'news-thumb', 556, 327, true ); // (cropped)
}

function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyD0fVd0YmrvGUMSz3enPPyXTAsZbgS38Gg');
}

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
    $menu = wp_get_nav_menu_object($args->menu);
    if( $args->theme_location == 'footer-social' ) {
        foreach ($items as &$item) {
            $icon = get_field('menu_icon', $item);
            if ($icon) {
                $item->title = ' <img src="' . $icon . '" />';
            }
        }
    }
    return $items;
}


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Settings',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-settings',
    ));

}

function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function get_archive_post_type() {
    return is_archive() ? get_queried_object()->name : false;
}

function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

