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