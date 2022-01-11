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

    <section class="homeBanner" style="background-image: url( '<?php echo $banner_bg_image; ?>' );">
        <div class="homeBanner__content">
            <h1 class="homeBanner__title"><?php echo $banner_title; ?></h1>
            <p class="homeBanner__text"><?php echo $banner_text; ?></p>
        </div>

        <img src="<?php echo $banner_image; ?>" alt="" class="homeBanner__image">
    </section>





</main>

<?php get_footer(); ?>