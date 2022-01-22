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
    $banner_bg_image     = carbon_get_the_post_meta( 'about_page_banner_bg_image' );
    $about_page_partners = carbon_get_the_post_meta( 'about_page_partners' );

    $about_page_developer_photo       = carbon_get_the_post_meta( 'about_page_developer_photo' );
    $about_page_developer_name        = carbon_get_the_post_meta( 'about_page_developer_name' );
    $about_page_developer_profession  = carbon_get_the_post_meta( 'about_page_developer_profession' );
    $about_page_developer_description = carbon_get_the_post_meta( 'about_page_developer_description' );
    $about_page_developer_socials     = carbon_get_the_post_meta( 'about_page_developer_socials' );
    ?>

    <main class="pageAbout">

        <!-- Banner -->
        <section class="aboutBanner" style="background-image: url( '<?php echo wp_get_attachment_image_url( $banner_bg_image, 'large', true ); ?>' );">
            <div class="aboutBanner__content">
                <h1 class="aboutBanner__title"><?php the_title(); ?></h1>
                <div class="breadcrumbs aboutBanner__breadcrumbs">
                    <?php echo geoHeritageBreadcrumbs(); ?>
                </div>

                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" class="homeBanner__image">
            </div>
        </section>

        <?php
        /**
         * Parnters section
         */
        if ( ! empty( $about_page_partners ) ) : ?>

            <section class="aboutPartners">
                <div class="aboutPartners__content">
                    <h2 class="aboutPartners__title">
                        <?php _e( 'Наші партнери', 'geoheritage' ) ?>
                    </h2>

                    <?php foreach ( $about_page_partners as $partner ) : ?>
                        
                        <div class="aboutPartners__item">
                            <div class="aboutPartners__itemLogoWrapper">
                                <img src="<?php echo wp_get_attachment_image_url( $partner['logo'], 'medium', true ) ?>" alt="" class="aboutPartners__itemLogo">
                            </div>

                            <div class="aboutPartners__itemInfo">
                                <h3 class="aboutPartners__itemName">
                                    <?php echo $partner['name']; ?>
                                </h3>

                                <div class="aboutPartners__itemDescription">
                                    <?php echo wpautop( $partner['description'] ); ?>
                                </div>

                                <a href="<?php echo $partner['link']; ?>" class="aboutPartners__itemLink" rel="nofollow" target="_blank">
                                    <?php _e( 'Відвідати сайт', 'geoheritage' ) ?>

                                    <svg class="aboutPartners__itemLinkIcon" width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.9 5C1.9 3.29 3.29 1.9 5 1.9H8.05C8.57467 1.9 9 1.47467 9 0.95V0.95C9 0.425329 8.57467 0 8.05 0H5C2.24 0 0 2.24 0 5C0 7.76 2.24 10 5 10H8.05C8.57467 10 9 9.57467 9 9.05V9.05C9 8.52533 8.57467 8.1 8.05 8.1H5C3.29 8.1 1.9 6.71 1.9 5ZM6 5C6 5.55228 6.44772 6 7 6H13C13.5523 6 14 5.55228 14 5V5C14 4.44772 13.5523 4 13 4H7C6.44772 4 6 4.44772 6 5V5ZM15 0H11.95C11.4253 0 11 0.425329 11 0.95V0.95C11 1.47467 11.4253 1.9 11.95 1.9H15C16.71 1.9 18.1 3.29 18.1 5C18.1 6.71 16.71 8.1 15 8.1H11.95C11.4253 8.1 11 8.52533 11 9.05V9.05C11 9.57467 11.4253 10 11.95 10H15C17.76 10 20 7.76 20 5C20 2.24 17.76 0 15 0Z" fill="#52d858"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
            </section>

        <?php endif; ?>

        <!-- Developer -->
        <section class="aboutDeveloper">
            <div class="aboutDeveloper__content">
                <h2 class="aboutDeveloper__title">
                    <?php _e( 'Розробник', 'geoheritage' ) ?>
                </h2>

                <div class="aboutDeveloper__info">
                    <h3 class="aboutDeveloper__name">
                        <?php echo $about_page_developer_name; ?>
                    </h3>

                    <h4 class="aboutDeveloper__profession">
                        <?php echo $about_page_developer_profession; ?>
                    </h4>

                    <div class="aboutDeveloper__description">
                        <?php echo wpautop( $about_page_developer_description ); ?>
                    </div>

                    <?php if ( ! empty( $about_page_developer_socials ) ) : ?>

                        <div class="aboutDeveloper__socials">
                            <?php foreach ( $about_page_developer_socials as $social ) : ?>

                                <a href="<?php echo $social['link']; ?>" class="aboutDeveloper__socialsItem" rel="nofollow" target="_blank">
                                    <img src="<?php echo wp_get_attachment_image_url( $social['logo'], 'large', true ); ?>" alt="" class="aboutDeveloper__socialsItemLogo">
                                </a>

                            <?php endforeach; ?>
                        </div>

                    <?php endif; ?>
                </div>

                <div class="aboutDeveloper__photoWrapper">
                    <img src="<?php echo wp_get_attachment_image_url( $about_page_developer_photo, 'large', true ); ?>" alt="" class="aboutDeveloper__photo">
                </div>

            </div>
        </section>

    </main>

<?php
/**
 * End of the loop.
 */
endwhile;

get_footer();