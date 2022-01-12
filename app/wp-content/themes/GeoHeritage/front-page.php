<?php get_header(); ?>

<?php
if ( have_posts() ) {

	while ( have_posts() ) {

		the_post();

        /**
         * Home page fields
         */
        $banner_title    = carbon_get_the_post_meta( 'front_page_banner_title' );
        $banner_text     = carbon_get_the_post_meta( 'front_page_banner_text' );
        $banner_bg_image = carbon_get_the_post_meta( 'front_page_banner_bg_image' );
        $banner_image    = carbon_get_the_post_meta( 'front_page_banner_image' );

	}

    

}
?>

<main class="homePage">

    <!-- Banner -->
    <section class="homeBanner" style="background-image: url( '<?php echo $banner_bg_image; ?>' );">
        <div class="homeBanner__content">
            <h1 class="homeBanner__title"><?php echo $banner_title; ?></h1>
            <p class="homeBanner__text"><?php echo $banner_text; ?></p>
        </div>

        <img src="<?php echo $banner_image; ?>" alt="" class="homeBanner__image">
    </section>

    <!-- Regions -->

    <section class="homeRegions">
        
            <?php $regions_of_ukraine = get_categories( [
                'taxonomy'     => 'regions_of_ukraine',
                'type'         => 'post',
                'child_of'     => 0,
                'parent'       => '',
                'orderby'      => 'name',
                'order'        => 'ASC',
                'hide_empty'   => 0,
                'hierarchical' => 1,
                'exclude'      => '',
                'include'      => '',
                'number'       => 0,
                'pad_counts'   => false,
            ] );

            if ( $regions_of_ukraine ) { ?>

                <div class="homeRegions__list">

                    <?php
                    foreach ( $regions_of_ukraine as $region ) {

                        $region_name = $region->name;
                        $region_id   = $region->term_id;
                        $region_url  = get_category_link( $region_id );

                        $region_emblem_id  = carbon_get_term_meta( $region_id, 'region_of_ukraine_emblem' );
                        $region_emblem_url = wp_get_attachment_image_url( $region_emblem_id, 'thumbnail', true );
                        ?>

                        <a href="<?php echo $region_url; ?>" class="homeRegions__region">
                            <img src="<?php echo $region_emblem_url; ?>" alt="" class="homeRegions__regionImage">
                            <div class="homeRegions__regionName">
                                <?php echo $region_name; ?>
                            </div>
                        </a>
                        
                    <?php } ?>
                    
                </div>
            <?php } ?>

    </section>







</main>




<?php get_footer(); ?>