<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_create_fields' );
function crb_create_fields() {
    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_fields( array(
            Field::make( 'separator', 'footer_separator', __( 'Footer' ) ),
            Field::make( 'text', 'partners_title', __( 'Partners Section Title' ) ),
            Field::make( 'complex', 'partners', __( 'Partners List' ) )
                ->add_fields( array(
                    Field::make( 'image', 'partner_logo', __( 'Partner Logo' ) )
                        ->set_width( 20 ),
                    Field::make( 'text', 'partner_name', __( 'Partner Name' ) )
                        ->set_width( 40 ),
                    Field::make( 'text', 'partner_link', __( 'Partner Link' ) )
                        ->set_width( 40 ),
                ) ),
            Field::make( 'text', 'copyright_text', __( 'Copyright Text' ) ),
        ) );


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

    /**
     * Geological monuments fields
     */
    Container::make( 'post_meta', __( 'Geological Monument Data' ) )
        ->where( 'post_type', '=', 'geological_monuments' )
        ->add_fields(
            array(
                Field::make( 'media_gallery', 'geological_monument_gallery', __( 'Geological Monument Gallery' ) )
            )
        );


    /**
     * About page template fields
     */
    Container::make( 'post_meta', __( 'About page fields', 'crb' ) )
        ->where( 'post_type', '=', 'page' )
        ->where( 'post_template', '=', 'about.php' )
        ->add_tab(
            __( 'Banner' ),
            array(
                Field::make( 'image', 'about_page_banner_bg_image', __( 'Banner Background Image' ) )
                    ->set_value_type( 'url' ),
            )
        )
        ->add_tab(
            __( 'Partners' ),
            array(
                Field::make( 'complex', 'about_page_partners', __( 'Partners' ) )
                    ->add_fields( array(
                        Field::make( 'image', 'logo', __( 'Partner Logo' ) )
                            ->set_width( 20 ),
                        Field::make( 'text', 'name', __( 'Partner Name' ) )
                            ->set_width( 40 ),
                        Field::make( 'text', 'link', __( 'Partner Link' ) )
                            ->set_width( 40 ),
                        Field::make( 'rich_text', 'description', __( 'Description' ) )
                    ) )
            )
        );

}

?>