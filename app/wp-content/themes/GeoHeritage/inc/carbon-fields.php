<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_create_fields' );
function crb_create_fields() {
    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_fields( array() );


    /**
     * Home page fields
     */
    Container::make( 'post_meta', __( 'Front page fields' ) )
        ->where( 'post_id', '=', get_option( 'page_on_front' ) )
        ->add_tab( __( 'Banner' ), array(
            Field::make( 'text', 'front_page_banner_title', __( 'Title' ) )
                ->set_width( 60 ),
            Field::make( 'image', 'front_page_banner_bg_image', __( 'Background Image' ) )
                ->set_value_type( 'url' )
                ->set_width( 20 ),
            Field::make( 'image', 'front_page_banner_image', __( 'Content Image' ) )
                ->set_value_type( 'url' )
                ->set_width( 20 ),
            Field::make( 'textarea', 'front_page_banner_text', __( 'Text' ) ),
        ) );
}

?>