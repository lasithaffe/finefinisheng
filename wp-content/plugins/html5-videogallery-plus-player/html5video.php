<?php
/**
 * Plugin Name: Video gallery and Player
 * Plugin URI: https://www.wponlinesupport.com/plugins/
 * Text Domain: html5-videogallery-plus-player
 * Domain Path: /languages/
 * Description: Easy to add and display your HTML5, YouTube, Vimeo vedio gallery with Magnific Popup to your website. Also work with Gutenberg shortcode block.
 * Author: WP OnlineSupport
 * Version: 2.4
 * Author URI: https://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author WP OnlineSupport
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! defined( 'WP_HTML5VP_VERSION' ) ) {
	define( 'WP_HTML5VP_VERSION', '2.4' ); // Version of plugin
}
if( ! defined( 'WP_HTML5VP_DIR' ) ) {
	define( 'WP_HTML5VP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'WP_HTML5VP_URL' ) ) {
	define( 'WP_HTML5VP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( ! defined( 'WP_HTML5VP_POST_TYPE' ) ) {
	define( 'WP_HTML5VP_POST_TYPE', 'sp_html5video' ); // Plugin post type name
}

/**
 * Function to load text domain
 * 
 * @package HTML5 Video gallery and Player
 * @since 1.1
 */ 
 
add_action('plugins_loaded', 'wp_html5video_load_textdomain');
function wp_html5video_load_textdomain() {
	load_plugin_textdomain( 'html5-videogallery-plus-player', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
} 

/**
 * Function to load JS and CSS files
 * 
 * @package HTML5 Video gallery and Player
 * @since 1.1
 */
add_action( 'wp_enqueue_scripts','wp_html5video_style_css' );

function wp_html5video_style_css() {		
	
	wp_enqueue_style( 'wp_html5video_css',  plugin_dir_url( __FILE__ ). 'assets/css/video-js.css', array(), WP_HTML5VP_VERSION );
	wp_enqueue_style( 'wp_html5video_colcss',  plugin_dir_url( __FILE__ ). 'assets/css/video-style.css', array(), WP_HTML5VP_VERSION );		

	// Registring and enqueing wpos-magnific-popup-style css
	if( ! wp_style_is( 'wpos-magnific-popup-style', 'registered' ) ) {
			wp_enqueue_style( 'wpos-magnific-popup-style',  plugin_dir_url( __FILE__ ). 'assets/css/magnific-popup.css', array(), WP_HTML5VP_VERSION );
			wp_enqueue_style( 'wpos-magnific-popup-style' );
	}			
	
	wp_register_script( 'wp-html5video-js', WP_HTML5VP_URL.'assets/js/video.js', array('jquery'), WP_HTML5VP_VERSION, true );
	wp_enqueue_script( 'wp-html5video-js' );
	
	if( ! wp_script_is( 'wpos-magnific-popup-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-popup-jquery', WP_HTML5VP_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), WP_HTML5VP_VERSION, true );
		}	

	wp_register_script( 'wp-html5video-public-js', WP_HTML5VP_URL.'assets/js/wp-html5vp-public.js', array('jquery'), WP_HTML5VP_VERSION, true );
}

// Action to add style at admin side
add_action( 'admin_enqueue_scripts', 'wp_html5vp_admin_script' );

/**
 * Function to add script at admin side
 * 
 * @package HTML5 Video gallery and Player
 * @since 2.4
 */
function wp_html5vp_admin_script( $hook ) {

	if( $hook == WP_HTML5VP_POST_TYPE.'_page_vgap-designs' ) {

		// Registring admin script
		wp_register_script( 'wp-html5vp-admin-script', WP_HTML5VP_URL.'assets/js/wp-html5vp-admin.js', array('jquery'), WP_HTML5VP_VERSION, true );
		wp_enqueue_script( 'wp-html5vp-admin-script' );
	}
}
 
/**
 * Function to create custom post type
 * 
 * @package HTML5 Video gallery and Player
 * @since 1.1
 */
function html5video_setup_post_types() {

	$html5video_labels =  apply_filters( 'sp_html5video_labels', array(
		'name'                => 'Video Gallery',
		'singular_name'       => 'Video Gallery',
		'add_new'             => __('Add New', 'html5-videogallery-plus-player'),
		'add_new_item'        => __('Add New Video', 'html5-videogallery-plus-player'),
		'edit_item'           => __('Edit Video', 'html5-videogallery-plus-player'),
		'new_item'            => __('New Video', 'html5-videogallery-plus-player'),
		'all_items'           => __('All Videos', 'html5-videogallery-plus-player'),
		'view_item'           => __('View Video Gallery', 'html5-videogallery-plus-player'),
		'search_items'        => __('Search Video Gallery', 'html5-videogallery-plus-player'),
		'not_found'           => __('No Videos Gallery found', 'html5-videogallery-plus-player'),
		'not_found_in_trash'  => __('No Videos Gallery found in Trash', 'html5-videogallery-plus-player'),
		'parent_item_colon'   => '',
		'menu_name'           => __('Video Gallery', 'html5-videogallery-plus-player'),
		'exclude_from_search' => true
	) );


	$html5video_args = array(
		'labels' 			=> $html5video_labels,
		'public' 			=> false,
		'publicly_queryable'=> false,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'query_var' 		=> false,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'menu_icon'   		=> 'dashicons-format-video',
		'hierarchical' 		=> false,
		'supports' => array('title','thumbnail')
	);
	register_post_type( 'sp_html5video', apply_filters( 'sp_html5video_post_type_args', $html5video_args ) );

}

add_action('init', 'html5video_setup_post_types');

/* Register Taxonomy */
add_action( 'init', 'sp_html5video_taxonomies');
function sp_html5video_taxonomies() {
	$labels = array(
		'name'              => _x( 'Category', 'html5-videogallery-plus-player' ),
		'singular_name'     => _x( 'Category', 'html5-videogallery-plus-player' ),
		'search_items'      => __( 'Search Category', 'html5-videogallery-plus-player' ),
		'all_items'         => __( 'All Category', 'html5-videogallery-plus-player' ),
		'parent_item'       => __( 'Parent Category', 'html5-videogallery-plus-player' ),
		'parent_item_colon' => __( 'Parent Category:', 'html5-videogallery-plus-player' ),
		'edit_item'         => __( 'Edit Category', 'html5-videogallery-plus-player' ),
		'update_item'       => __( 'Update Category', 'html5-videogallery-plus-player' ),
		'add_new_item'      => __( 'Add New Category', 'html5-videogallery-plus-player' ),
		'new_item_name'     => __( 'New Category Name', 'html5-videogallery-plus-player' ),
		'menu_name'         => __( 'Video Category', 'html5-videogallery-plus-player' ),
	);

	$args = array(
		'public'            => false,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => false,
	);

	register_taxonomy( 'video-category', array( 'sp_html5video' ), $args );
}

function sp_html5video_rewrite_flush() {  
	html5video_setup_post_types();  
	flush_rewrite_rules();

	// Deactivate pro version
	if( is_plugin_active('videogallery-plus-player-pro/video-gallery.php') ) {
		add_action('update_option_active_plugins', 'wp_html5vp_deactivate_pro_version');
	}
}
register_activation_hook( __FILE__, 'sp_html5video_rewrite_flush' );

/**
 * Deactivate pro plugin
 * 
 * @package Video gallery and Player
 * @since 2.0.0
 */
function wp_html5vp_deactivate_pro_version() {
	deactivate_plugins('videogallery-plus-player-pro/video-gallery.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Video gallery and Player
 * @since 2.0.0
 */
function wp_html5vp_admin_notice() {
	
	$dir = ABSPATH . 'wp-content/plugins/videogallery-plus-player-pro/video-gallery.php';
	
	// If FREE plugin is active and PRO plugin exist
	if( is_plugin_active( 'html5-videogallery-plus-player/html5video.php' ) && file_exists($dir) ) {
		
		global $pagenow;
		$notice_link        = add_query_arg( array('message' => 'wp-html5vp-plugin-notice'), admin_url('plugins.php') );
		$notice_transient   = get_transient( 'wp_html5vp_install_notice' );
		
		if( $notice_transient == false && $pagenow == 'plugins.php' && file_exists( $dir ) && current_user_can( 'install_plugins' ) ) {
			  echo '<div class="updated notice" style="position:relative;">
					<p>
						<strong>'.sprintf( __('Thank you for activating %s', 'html5-videogallery-plus-player'), 'Video gallery and Player').'</strong>.<br/>
						'.sprintf( __('It looks like you had PRO version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'html5-videogallery-plus-player'), '<strong>(<em>Video gallery and Player PRO</em>)</strong>' ).'
					</p>
					<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
				</div>';
		}
	}
}

// Action to display notice
add_action( 'admin_notices', 'wp_html5vp_admin_notice');

/**
 * Function to create category shortcode
 * 
 * @package HTML5 Video gallery and Player
 * @since 1.1
 */
add_filter("manage_video-category_custom_column", 'video_category_columns', 10, 3);
add_filter("manage_edit-video-category_columns", 'video_category_manage_columns'); 

function video_category_manage_columns($columns) {
	   
	$new_columns['video_shortcode'] = __( 'Category Shortcode', 'html5-videogallery-plus-player' );
	
	$columns = wp_html5vp_add_array( $columns, $new_columns, 2 );

	return $columns;
}

function video_category_columns($out, $column_name, $theme_id) {
	
	switch ($column_name) {
		case 'video_shortcode':
			echo '[sp_html5video category="' . $theme_id. '"]';
			break;
	}
	return $out;
}

// Functions File
require_once( WP_HTML5VP_DIR . '/includes/wp-html5vp-functions.php' );

require_once( WP_HTML5VP_DIR . '/includes/class_shortcode.php' );
require_once( WP_HTML5VP_DIR . '/includes/class_admin_metabox.php' );

// Admin File
require_once( WP_HTML5VP_DIR . '/includes/admin/class-html5vp-admin.php' );

/* Recommended Plugins Starts */
if ( is_admin() ) {
	require_once( WP_HTML5VP_DIR . '/wpos-plugins/wpos-recommendation.php' );

	wpos_espbw_init_module( array(
							'prefix'	=> 'wp-html5vp',
							'menu'		=> 'edit.php?post_type='.WP_HTML5VP_POST_TYPE,
							'position'	=> 3,
						));
}
/* Recommended Plugins Ends */

/* Plugin Wpos Analytics Data Starts */
function wpos_analytics_anl37_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'            => 37,
							'file'          => plugin_basename( __FILE__ ),
							'name'          => 'Video gallery and Player',
							'slug'          => 'video-gallery-and-player',
							'type'          => 'plugin',
							'menu'          => 'edit.php?post_type=sp_html5video',
							'text_domain'   => 'html5-videogallery-plus-player',							
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl37_load();
/* Plugin Wpos Analytics Data Ends */