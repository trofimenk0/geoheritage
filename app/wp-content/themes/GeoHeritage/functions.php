<?php

// ACF OPTIONS PAGE
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

add_action( 'after_setup_theme', 'geoheritage_theme_setup' );
function geoheritage_theme_setup() {

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'category-thumb', 100, 100, false );

	load_theme_textdomain( 'geoheritage', get_template_directory() . '/languages' );

	/*
		* Let WordPress manage the document title.
		* This theme does not use a hard-coded <title> tag in the document head,
		* WordPress will provide it for us.
		*/
	add_theme_support( 'title-tag' );

	register_nav_menus( array(
		'main_menu' => __( 'Головне меню', 'geoheritage' ),
		'footer_menu' => __( 'Меню в футері', 'geoheritage' ),
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
	wp_enqueue_style( 'lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery.js@1.4.0/dist/css/lightgallery.min.css', true );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css', true );
}

add_action( 'wp_enqueue_scripts', 'geoheritage_enqueue_script' );
function geoheritage_enqueue_script() {

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'smooth-scroll', '//cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'stats', '//mrdoob.github.io/stats.js/build/stats.min.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'lightgallery', 'https://cdn.jsdelivr.net/npm/lightgallery.js@1.4.0/dist/js/lightgallery.min.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'threejs', 'https://threejs.org/build/three.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'gltfloader', 'https://threejs.org/examples/js/loaders/GLTFLoader.js', array(), wp_get_theme()->get( 'Version' ), true );
    wp_enqueue_script( 'parallax', 'https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js', array(), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array(), wp_get_theme()->get( 'Version' ), true );
}

// add_filter( 'upload_mimes', 'allows_to_upload_file_types' );
// function allows_to_upload_file_types( $mime_types ){
// 	$mime_types['svg'] = 'image/svg+xml';
// 	$mime_types['svgz'] = 'image/svg+xml'; 
// 	$mime_types['glb'] = 'file/glb+xml';
// 	return $mime_types;
// }

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg';
	$new_filetypes['glb'] = 'file/glb+xml';
	$file_types = array_merge($file_types, $new_filetypes );

	return $file_types; 
} 
add_action('upload_mimes', 'add_file_types_to_uploads');

// Post Excerpt
add_filter( 'excerpt_length', function(){
	return 40;
} );

add_filter('excerpt_more', function($more) {
	return '...';
});

// BREADCRUMBS
function geoHeritageBreadcrumbs(){
 
	// получаем номер текущей страницы
	$page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 
	$separator = ' <span class="divider">/</span> '; //  разделяем обычным слэшем, но можете чем угодно другим
 
	// если главная страница сайта
	if( is_front_page() ){
 
		if( $page_num > 1 ) {
			echo '<a href="' . site_url() . '">Головна</a>' . $separator . $page_num . '-я страница';
		} else {
			echo 'Вы находитесь на главной странице';
		}
 
	} else { // не главная
 
		echo '<a href="' . site_url() . '">Головна</a>' . $separator;
 
 
		if( is_single() ){ // записи
 
			the_category( ', ' ); echo $separator; the_title();
 
		} elseif ( is_page() ){ // страницы WordPress 
 
			the_title();
 
		} elseif ( is_category() ) {
 
			single_cat_title();
 
		} elseif( is_tag() ) {
 
			single_tag_title();
 
		} elseif ( is_day() ) { // архивы (по дням)
 
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
			echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $separator;
			echo get_the_time('d');
 
		} elseif ( is_month() ) { // архивы (по месяцам)
 
			echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
			echo get_the_time('F');
 
		} elseif ( is_year() ) { // архивы (по годам)
 
			echo get_the_time( 'Y' );
 
		} elseif ( is_author() ) { // архивы по авторам
 
			global $author;
			$userdata = get_userdata( $author );
			echo 'Опубликовал(а) ' . $userdata->display_name;
 
		} elseif ( is_404() ) { // если страницы не существует
 
			echo 'Ошибка 404';
 
		}
 
		if ( $page_num > 1 ) { // номер текущей страницы
			echo ' (' . $page_num . '-я страница)';
		}
 
	}
 
}


