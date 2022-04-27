<?php
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
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_nav_menus'     => true,
		'show_in_rest'          => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'capabilities'          => array(),
		'description'           => 'Regions of Ukraine description',
	] );
}
add_action( 'init', 'geo_custom_taxonomy_regions_of_ukraine' );

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
* Add the custom columns to the geological_monuments post type:
*/
add_filter( 'manage_geological_monuments_posts_columns', 'set_custom_edit_geological_monuments_columns' );
function set_custom_edit_geological_monuments_columns( $columns ) {
    $region_of_ukraine_column['region_of_ukraine'] = __( 'Region of Ukraine', 'geoheritage' );
	$columns = array_slice( $columns, 0, 2 ) + $region_of_ukraine_column + $columns;

	$monument_thumb_column['monument_thumb'] = __( 'Thumbnail', 'geoheritage' );
	$columns = array_slice( $columns, 0, 1 ) + $monument_thumb_column + $columns;

	return $columns;
}

/*
* Add the data to the custom columns for the bogeological_monumentsok post type:
*/
add_action( 'manage_geological_monuments_posts_custom_column' , 'custom_geological_monuments_column', 10, 2 );
function custom_geological_monuments_column( $column_name ) {
	switch ( $column_name ) {
		case 'region_of_ukraine':
			$regions_of_ukraine = get_the_terms( get_the_ID(), 'regions_of_ukraine' );

			foreach ( $regions_of_ukraine as $region ) {
				?>
				<a href="<?php echo get_edit_term_link( $region->term_id, 'regions_of_ukraine' ); ?>">
					<?php _e( $region->name, 'geoheritage' ); ?>
				</a>
				<?php
			}
			break;

		case 'monument_thumb':
			?>
			<a href="<?php echo get_edit_post_link(); ?>">
				<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'thumbnail' );
				} else {
					echo '<img src="' . get_template_directory_uri() . '/resource/dist/images/UkraineFlag.webp" alt="Geological monument image" class="region__monumentsItemImage">';
				}
				?>
			</a>
			<?php
			break;
	}
}

/*
* Add styles for registered columns
*/
add_action( 'admin_print_footer_scripts-edit.php', function () {
	?>
	<style>
		.type-geological_monuments:hover .monument_thumb img {
			box-shadow: 0 10px 20px 0 rgb(23 23 23 / 10%);
		}

		.column-monument_thumb {
			width: 180px;
		}

		.monument_thumb a {
			display: block;
		}

		.monument_thumb img {
			width: 100%;
			height: 130px;
			max-width: unset;
			max-height: unset;
			object-fit: cover;
			border-radius: 10px;
    		transition: all 0.3s;
		}
	</style>
	<?php
} );