<?php get_header(); ?>

<?php
while ( have_posts() ) :
	the_post(); 

    $monument_id = get_the_ID();
    
    ?>

    <main class="geoMonument">

        <section class="geoMonument__banner" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
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

        if( $gallery ): ?>
            <section class="geoMonument__gallery">
                <div class="geoMonument__galleryContent">
                    <?php foreach( $gallery as $image_id ): ?>
                        <img src="<?php echo wp_get_attachment_image_url( $image_id, 'medium' ); ?>" alt="" class="geoMonument__galleryImage">
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>


    </main>

<?php endwhile; ?>



<?php get_footer(); ?>