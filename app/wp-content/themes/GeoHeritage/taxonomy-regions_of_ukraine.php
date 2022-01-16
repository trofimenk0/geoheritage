<?php
get_header(); 

$region             = get_queried_object();
$region_id          = $region->term_id;
$region_description = get_the_archive_description();
$region_emblem_id   = carbon_get_term_meta( $region_id, 'region_of_ukraine_emblem' );
$region_emblem_url  = wp_get_attachment_image_url( $region_emblem_id, 'medium', true );
?>

<main class="region">

    <section class="region__banner">
        <img src="<?php echo $region_emblem_url; ?>" alt="" class="region__emblem">

        <h1 class="region__name">
            <?php echo $region->name; ?>
        </h1>
    </section>

    <section class="region__description">
        <div class="region__descriptionContent">
            <?php echo wp_kses_post( wpautop( $region_description ) ); ?>
        </div>
    </section>

    <section class="region__monuments">

        <h2 class="region__monumentsTitle">
            Геопамʼятки області
        </h2>

        <div class="region__monumentsList">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
                <a href="<?php the_permalink(); ?>" class="region__monumentsItem" data-depth="0.2">
                    <?php echo get_the_post_thumbnail( $id, 'medium', array( 'class' => 'region__monumentsItemImage' ) ); ?>
                    
                    <div class="region__monumentsItemName">
                        <?php the_title() ?>

                        <svg class="region__monumentsItemIcon" width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.9 5C1.9 3.29 3.29 1.9 5 1.9H9V0H5C2.24 0 0 2.24 0 5C0 7.76 2.24 10 5 10H9V8.1H5C3.29 8.1 1.9 6.71 1.9 5ZM6 6H14V4H6V6ZM15 0H11V1.9H15C16.71 1.9 18.1 3.29 18.1 5C18.1 6.71 16.71 8.1 15 8.1H11V10H15C17.76 10 20 7.76 20 5C20 2.24 17.76 0 15 0Z" fill="white"/>
                        </svg>
                    </div>
                </a>

            <?php endwhile; else : ?>

                <p>Геопам'ятки в процесі створення.</p>

            <?php endif; ?>
        </div>

    </section>


</main>

<?php get_footer(); ?>