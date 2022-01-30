<?php

/**
 * Include external files
 */
require_once( get_template_directory() . '/inc/ajax.php' );
require_once( get_template_directory() . '/inc/breadcrumbs.php' );
require_once( get_template_directory() . '/inc/carbon-fields.php' );
require_once( get_template_directory() . '/inc/custom-post-types.php' );

add_action( 'after_setup_theme', 'geoheritage_theme_setup' );
function geoheritage_theme_setup() {

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'regions-emblems-small', 100, 100, false );

	load_theme_textdomain( 'geoheritage', get_template_directory() . '/languages' );

	/*
	* Let WordPress manage the document title.
	* This theme does not use a hard-coded <title> tag in the document head,
	* WordPress will provide it for us.
	*/
	add_theme_support( 'title-tag' );

	register_nav_menus( array(
		'main_menu' => __( 'Primary menu', 'geoheritage' ),
		'footer_menu' => __( 'Footer menu', 'geoheritage' ),
		'footer_menu_second' => __( 'Second footer menu', 'geoheritage' ),
	) );

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	$logo_width  = 300;
	$logo_height = 100;

	add_theme_support(
		'custom-logo',
		array(
			'height'               => $logo_height,
			'width'                => $logo_width,
			'flex-width'           => true,
			'flex-height'          => true,
			'unlink-homepage-logo' => true,
		)
	);

	add_theme_support( 'align-wide' );

	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);

	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-line-height' );

}

add_action( 'wp_enqueue_scripts', 'geoheritage_enqueue_style' ); 
function geoheritage_enqueue_style() {
	wp_enqueue_style( 'geoheritage-swiper-style', 'https://unpkg.com/swiper@7/swiper-bundle.min.css', true );
    wp_enqueue_style( 'geoheritage-main-style', get_template_directory_uri() . '/resource/dist/css/main.css', true );
}

add_action( 'wp_enqueue_scripts', 'geoheritage_enqueue_script' );
function geoheritage_enqueue_script() {

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'geoheritage-swiper-script', 'https://unpkg.com/swiper@7/swiper-bundle.min.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'geoheritage-main-script', get_template_directory_uri() . '/resource/dist/js/main.js', array(), wp_get_theme()->get( 'Version' ), true );

}

/**
 * add SVG to allowed file uploads
 */
function add_file_types_to_uploads($file_types){

	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg';
	$new_filetypes['glb'] = 'file/glb+xml';
	$file_types = array_merge($file_types, $new_filetypes );

	return $file_types;
	
} 
add_action('upload_mimes', 'add_file_types_to_uploads');

/**
 * Post Excerpt
 */
add_filter( 'excerpt_length', function() {
	return 40;
} );

add_filter( 'excerpt_more', function( $more ) {
	return '...';
} );