<?php get_header(); ?>

<?php
if ( have_posts() ) {

	while ( have_posts() ) {

		the_post();

        /**
         * Home page banner fields
         */
        $banner_title    = carbon_get_the_post_meta( 'front_page_banner_title' );
        $banner_text     = carbon_get_the_post_meta( 'front_page_banner_text' );
        $banner_bg_image = carbon_get_the_post_meta( 'front_page_banner_bg_image' );
        $banner_image    = carbon_get_the_post_meta( 'front_page_banner_image' );

        /**
         * Home page description fields
         */
        $description_text = carbon_get_the_post_meta( 'front_page_description_text' );

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

    <!-- Description -->
    <section class="homeDescription">
        <div class="homeDescription__content">
            <?php echo $description_text; ?>
        </div>
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
                            <svg class="homeRegions__regionIconLink" width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.9 5C1.9 3.29 3.29 1.9 5 1.9H8.05C8.57467 1.9 9 1.47467 9 0.95V0.95C9 0.425329 8.57467 0 8.05 0H5C2.24 0 0 2.24 0 5C0 7.76 2.24 10 5 10H8.05C8.57467 10 9 9.57467 9 9.05V9.05C9 8.52533 8.57467 8.1 8.05 8.1H5C3.29 8.1 1.9 6.71 1.9 5ZM6 5C6 5.55228 6.44772 6 7 6H13C13.5523 6 14 5.55228 14 5V5C14 4.44772 13.5523 4 13 4H7C6.44772 4 6 4.44772 6 5V5ZM15 0H11.95C11.4253 0 11 0.425329 11 0.95V0.95C11 1.47467 11.4253 1.9 11.95 1.9H15C16.71 1.9 18.1 3.29 18.1 5C18.1 6.71 16.71 8.1 15 8.1H11.95C11.4253 8.1 11 8.52533 11 9.05V9.05C11 9.57467 11.4253 10 11.95 10H15C17.76 10 20 7.76 20 5C20 2.24 17.76 0 15 0Z" fill="#52d858"/>
                            </svg>

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