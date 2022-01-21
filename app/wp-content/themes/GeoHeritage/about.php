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
	the_post(); ?>


    <main class="pageAbout">

        <!-- Banner -->
        <section class="aboutBanner" style="background-image: url( '<?php // echo $banner_bg_image; ?>' );">
            <div class="aboutBanner__content">
                <h1 class="aboutBanner__title"><?php the_title(); ?></h1>
                <div class="breadcrumbs aboutBanner__breadcrumbs">
                    <?php echo geoHeritageBreadcrumbs(); ?>
                </div>
            </div>

            <!-- <img src="<?php echo $banner_image; ?>" alt="" class="homeBanner__image"> -->
        </section>






    </main>

<?php
/**
 * End of the loop.
 */
endwhile;

get_footer();