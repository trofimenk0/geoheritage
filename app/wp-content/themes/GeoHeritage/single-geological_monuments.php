<?php get_header();

$placeholder_image_id = carbon_get_theme_option( 'placeholder_image' );
?>

<?php
while ( have_posts() ) :
	the_post(); 

    $monument_id = get_the_ID();

    if ( has_post_thumbnail() ) :
        $post_thumbnail = get_the_post_thumbnail_url( $monument_id, 'full' );
    else :
        $post_thumbnail = wp_get_attachment_image_url( $placeholder_image_id, 'full' );
    endif;
    ?>

    <main class="geoMonument">
        <section class="geoMonument__banner" style="background-image: url(<?php echo $post_thumbnail; ?>)">
            <h1 class="geoMonument__title"><?php the_title(); ?></h1>

            <div class="breadcrumbs geoMonument__breadcrumbs">
                <?php echo geoHeritageBreadcrumbs( $monument_id ); ?>
            </div>
        </section>

        <section class="geoMonument__description">
            <div class="geoMonument__descriptionText">
                <?php the_content(); ?>
            </div>
        </section>

        <?php
        $gallery = carbon_get_post_meta( get_the_ID(), 'geological_monument_gallery' );

        if ( $gallery ) : ?>
            <section class="geoMonument__gallery">
                <h2 class="geoMonument__galleryTitle">
                    Галерея:
                </h2>

                <div class="geoMonument__galleryContent frogallery">
                    <?php foreach( $gallery as $image_id ): ?>
                        <a href="<?php echo wp_get_attachment_image_url( $image_id, 'full' ); ?>" class="geoMonument__galleryItem">
                            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'medium' ); ?>" alt="" class="geoMonument__galleryImage">
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>