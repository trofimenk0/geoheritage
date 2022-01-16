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

        if( $gallery ): 
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

            <section class="geoMonument__slider">
                <button class="geoMonument__sliderClose">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.5858 4.43564C29.3668 3.65459 29.3668 2.38826 28.5858 1.60721L28.3928 1.41421C27.6117 0.633165 26.3454 0.633165 25.5644 1.41421L16.4142 10.5644C15.6332 11.3454 14.3668 11.3454 13.5858 10.5644L4.43564 1.41421C3.65459 0.633165 2.38826 0.633165 1.60721 1.41421L1.41421 1.60721C0.633165 2.38826 0.633165 3.65459 1.41421 4.43564L10.5644 13.5858C11.3454 14.3668 11.3454 15.6332 10.5644 16.4142L1.41421 25.5644C0.633165 26.3454 0.633165 27.6117 1.41421 28.3928L1.60721 28.5858C2.38826 29.3668 3.65459 29.3668 4.43564 28.5858L13.5858 19.4356C14.3668 18.6546 15.6332 18.6546 16.4142 19.4356L25.5644 28.5858C26.3454 29.3668 27.6117 29.3668 28.3928 28.5858L28.5858 28.3928C29.3668 27.6117 29.3668 26.3454 28.5858 25.5644L19.4356 16.4142C18.6546 15.6332 18.6546 14.3668 19.4356 13.5858L28.5858 4.43564Z" fill="black"/>
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
            </section>
        <?php endif; ?>

    </main>

<?php endwhile; ?>



<?php get_footer(); ?>