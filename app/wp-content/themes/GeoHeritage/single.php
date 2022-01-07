<?php get_header(); ?>

<?php while ( have_posts() ){ the_post(); ?>

<section id="banner" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">

    <div class="container">
    
        <h1 class="title"><?php the_title(); ?></h1>

        <div id="breadcrumbs">
            <?php geoHeritageBreadcrumbs(); ?>
        </div>

    </div>

</section>
    
<section id="description">

    <div class="container">

        <!-- <img src="<?php the_post_thumbnail_url(); ?>" alt="" class="image"> -->

        <div class="text">
            <?php the_content(); ?>
        </div>

    </div>

</section>

<?php $images = get_field('postGallery');
    if( $images ): ?>
    <section id="gallery">

        <div id="lightgallery">
            
            <?php foreach( $images as $image ): ?>
                <a href="<?php echo esc_url($image['url']); ?>" class="link">
                    <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="image" />
                </a>
            <?php endforeach; ?>
            
        </div>

    </section>
<?php endif; ?>

<?php }

if ( ! have_posts() ){


} ?>


<?php get_footer(); ?>