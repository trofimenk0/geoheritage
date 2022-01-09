<?php
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
		'main_menu' => __( 'Primary menu', 'geoheritage' ),
		'footer_menu' => __( 'Footer menu', 'geoheritage' ),
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
    wp_enqueue_style( 'geoheritage-main-style', get_template_directory_uri() . '/resource/dist/css/main.css', true );
}

add_action( 'wp_enqueue_scripts', 'geoheritage_enqueue_script' );
function geoheritage_enqueue_script() {

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	wp_enqueue_script( 'jquery' );

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

/**
 * BREADCRUMBS
 */
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

/*
* Creating a function to create custom post type geological monuments
*/
function geo_custom_post_type_geological_monuments() {
 
	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Geological monuments', 'Post Type General Name', 'geoheritage' ),
		'singular_name'       => _x( 'Geological monument', 'Post Type Singular Name', 'geoheritage' ),
		'menu_name'           => __( 'Geological monuments', 'geoheritage' ),
		'parent_item_colon'   => __( 'Parent geological monument', 'geoheritage' ),
		'all_items'           => __( 'All geological monuments', 'geoheritage' ),
		'view_item'           => __( 'View geological monument', 'geoheritage' ),
		'add_new_item'        => __( 'Add New geological monument', 'geoheritage' ),
		'add_new'             => __( 'Add New', 'geoheritage' ),
		'edit_item'           => __( 'Edit geological monument', 'geoheritage' ),
		'update_item'         => __( 'Update geological monument', 'geoheritage' ),
		'search_items'        => __( 'Search geological monument', 'geoheritage' ),
		'not_found'           => __( 'Not Found', 'geoheritage' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'geoheritage' ),
	);
		
	// Set other options for Custom Post Type	
	$args = array(
		'label'               => __( 'geological monuments', 'geoheritage' ),
		'description'         => __( 'Geological monuments of Ukraine', 'geoheritage' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'regions_of_ukraine' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'data:image/svg+xml;base64,' . base64_encode('<svg width="22" height="12" viewBox="0 0 22 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13 0L9.25 5L12.1 8.8L10.5 10C8.81 7.75 6 4 6 4L0 12H22L13 0Z" fill="black"/></svg>'),
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
	
	);

	register_post_type( 'geological_monuments', $args );
	
}
add_action( 'init', 'geo_custom_post_type_geological_monuments', 0 );

/*
* Creating a function to create custom taxonomy
*/
function geo_custom_taxonomy_regions_of_ukraine(){

	// список параметров: wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy( 'regions_of_ukraine', [ 'geological_monuments' ], [
		'label'                 => 'Regions of Ukraine', // определяется параметром $labels->name
		'labels'                => [
			'name'              => 'Regions of Ukraine',
			'singular_name'     => 'Region of Ukraine',
			'search_items'      => 'Search regions of Ukraine',
			'all_items'         => 'All regions of Ukraine',
			'view_item '        => 'View region of Ukraine',
			'parent_item'       => 'Parent region of Ukraine',
			'parent_item_colon' => 'Parent region of Ukraine:',
			'edit_item'         => 'Edit region of Ukraine',
			'update_item'       => 'Update region of Ukraine',
			'add_new_item'      => 'Add New region of Ukraine',
			'new_item_name'     => 'New region of Ukraine',
			'menu_name'         => 'Regions of Ukraine',
			'back_to_items'     => '← Back to region of Ukraine',
		],
		'description'           => 'Regions of Ukraine description',
		'public'                => true,
		'hierarchical'          => false,
		'rewrite'               => true,
		'capabilities'          => array(),
		'meta_box_cb'           => null,
		'show_admin_column'     => false,
		'show_in_rest'          => true,
		'rest_base'             => null,
	] );
}
add_action( 'init', 'geo_custom_taxonomy_regions_of_ukraine' );

/*
* Livesearch ajax function
*/
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() { ?>

	<script type="text/javascript">
		$('#searchInput').on( 'keyup', function() {
			let searchQuery = $('#searchInput').val();
			if ( searchQuery.length > 2 ) {
				$.ajax( {
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					data: {
						action: 'search_geological_monuments',
						searchQuery: searchQuery
					},
					success: function( data ) {
						if ( ! data ) {
							$('#searchResults').removeClass('header__searchResults_active').empty().hide();
							return;
						}
						$('#searchResults').addClass('header__searchResults_active').css('display', 'flex').empty().append( data );
					}
				} );
			} else {
				$('#searchResults').removeClass('header__searchResults_active').empty().hide();
			}
		} );
	</script>

<?php }

add_action('wp_ajax_search_geological_monuments' , 'geo_search_geological_monuments');
add_action('wp_ajax_nopriv_search_geological_monuments','geo_search_geological_monuments');
function geo_search_geological_monuments() {

    $the_query = new WP_Query( 
      array( 
        'posts_per_page' => 20, 
        's'              => esc_attr( $_POST['searchQuery'] ), 
        'post_type'      => 'post',
      ) 
    );
  
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ): $the_query->the_post(); ?>

			<a href="<?php echo esc_url( post_permalink() ); ?>" class="header__searchResultLink">
				<?php the_title();?>
			</a>

        <?php endwhile;
        wp_reset_postdata();  
    endif;

    die();
}