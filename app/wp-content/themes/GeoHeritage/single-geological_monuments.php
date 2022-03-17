<?php get_header(); ?>

<?php
while ( have_posts() ) :
	the_post(); 

    $monument_id = get_the_ID();

    if ( has_post_thumbnail() ) :
        $post_thumbnail = get_the_post_thumbnail_url( $monument_id, 'full' );
    else :
        $post_thumbnail = get_template_directory_uri() . '/resource/dist/images/GoeMonumentImagePlaceholder.svg';
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

        if ( $gallery ): 
        $index = 0;
        ?>
            <section class="geoMonument__gallery">
                <h2 class="geoMonument__galleryTitle">
                    Галерея:
                </h2>
                <div class="geoMonument__galleryContent">
                    <?php foreach( $gallery as $image_id ): ?>
                        <a href="javascript: void(0);" class="geoMonument__galleryItem" data-index="<?php echo ++$index; ?>">
                            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'medium' ); ?>" alt="" class="geoMonument__galleryImage">
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- <section class="geoMonument__slider">
                <button class="geoMonument__sliderClose">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M31.9998 31.9998L2 2" stroke="#14181F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M31.9999 2L1.99995 32" stroke="#14181F" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="swiper-wrapper geoMonument__sliderWrapper">
                    <?php foreach( $gallery as $image_id ): ?>
                        <div class="swiper-slide geoMonument__sliderSlide">
                            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'full' ); ?>" alt="" class="geoMonument__sliderImage">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next geoMonument__sliderNavNext"></div>
                <div class="swiper-button-prev geoMonument__sliderNavPrev"></div>
            </section> -->
        <?php endif; ?>

    </main>

<?php endwhile; ?>



<?php get_footer(); ?>