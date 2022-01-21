<?php
/**
* Template Name: About
*
* @package WordPress
* @subpackage GeoHeritage
* @since GeoHeritage 1.0
*/

get_header(); 

/**
 * Start the Loop
 */
while ( have_posts() ) :
	the_post(); 
    
    /**
     * About page fields
     */
    $banner_bg_image = carbon_get_the_post_meta( 'about_page_banner_bg_image' );
    ?>


    <main class="pageAbout">

        <!-- Banner -->
        <section class="aboutBanner" style="background-image: url( '<?php echo $banner_bg_image; ?>' );">
            <div class="aboutBanner__content">
                <h1 class="aboutBanner__title"><?php the_title(); ?></h1>
                <div class="breadcrumbs aboutBanner__breadcrumbs">
                    <?php echo geoHeritageBreadcrumbs(); ?>
                </div>

                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" class="homeBanner__image">
            </div>
        </section>






    </main>

<?php
/**
 * End of the loop.
 */
endwhile;

get_footer();