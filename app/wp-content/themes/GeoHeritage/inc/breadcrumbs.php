<?php
function geoHeritageBreadcrumbs( $id = null ) {

    /**
     * Output of the functions
     */
    $output = '';
 
	/**
     * Get the current page number
     */
	$page_num = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 
    /**
     * Set devider
     */
	$separator = ' <span class="divider">/</span> ';

	/**
     * If front page
     */
	if ( is_front_page() && $page_num > 1 ) {
        $output = '<a href="' . site_url() . '">Home</a>' . $separator . $page_num . ' page';
        return $output;
	}

    /**
     * If not front page
     */
    $output = '<a href="' . site_url() . '">Головна</a>' . $separator;

    /**
     * Post type is "Geological Monument"
     */
    if ( is_single() && 'geological_monuments' == get_post_type() ) {
        $post_terms = get_the_terms( $id, 'regions_of_ukraine' );

        foreach ( $post_terms as $term ) {
            $output .= '<a href="' . get_term_link( $term ) . '" title="Перейти к ' . esc_attr( $term->name ) .  '">' . $term->name . '</a>' . $separator;
        }

        $output .= get_the_title();
        return $output;
    }

    /**
     * If simple post
     */
    if ( is_single() ) {
        $post_terms = get_the_category();

        foreach ( $post_terms as $term ) {
            $output .= '<a href="' . get_term_link( $term ) . '" title="Перейти к ' . esc_attr( $term->name ) .  '">' . $term->name . '</a>' . $separator;
        }
        
        $output .= get_the_title();
        return $output;
    } 
    
    /**
     * If page
     */
    if ( is_page() ) {
        $output .= get_the_title();
        return $output;
    }
    
    /**
     * If category
     */
    if ( is_category() ) {
        single_cat_title();
    }
    
    /**
     * If tag
     */
    if( is_tag() ) {
        single_tag_title();
    }
    
    /**
     * If day
     */
    if ( is_day() ) {
        echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
        echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $separator;
        echo get_the_time('d');
    }
    
    /**
     * If month
     */
    if ( is_month() ) {
        echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $separator;
        echo get_the_time('F');
    }
    
    /**
     * If year
     */
    if ( is_year() ) {
        echo get_the_time( 'Y' );
    }
    
    /**
     * If author
     */
    if ( is_author() ) {
        global $author;
        $userdata = get_userdata( $author );
        echo 'Опубликовал(а) ' . $userdata->display_name;
    }
    
    /**
     * If 404
     */
    if ( is_404() ) {
        echo 'Error 404';
    }

    if ( $page_num > 1 ) {
        echo ' (' . $page_num . '-я страница)';
    }
 
}
?>