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
        ->add_tab(
            __( 'Banner' ),
            array(
                Field::make( 'text', 'front_page_banner_title', __( 'Banner Title' ) )
                    ->set_width( 60 ),
                Field::make( 'image', 'front_page_banner_bg_image', __( 'Banner Background Image' ) )
                    ->set_value_type( 'url' )
                    ->set_width( 20 ),
                Field::make( 'image', 'front_page_banner_image', __( 'Banner Content Image' ) )
                    ->set_value_type( 'url' )
                    ->set_width( 20 ),
                Field::make( 'textarea', 'front_page_banner_text', __( 'Banner Text' ) ),
            )
        )
        ->add_tab(
            __( 'Description' ),
            array(
                Field::make( 'textarea', 'front_page_description_text', __( 'Description Text' ) ),
            )
        );


        

    /**
     * Regions fields
     */
    Container::make( 'term_meta', __( 'Regions of Ukraine Properties' ) )
        ->where( 'term_taxonomy', '=', 'regions_of_ukraine' )
        ->add_fields(
            array(
                Field::make( 'image', 'region_of_ukraine_emblem', __( 'Coat of arms of the region' ) ),
            )
        );

}

?>