<?php
get_header(); 

$region             = get_queried_object();
$region_id          = $region->term_id;
$region_description = get_the_archive_description();
$region_emblem_id   = carbon_get_term_meta( $region_id, 'region_of_ukraine_emblem' );
$region_emblem_url  = wp_get_attachment_image_url( $region_emblem_id, 'medium', true );
?>

<main class="region">

    <!-- Banner -->
    <section class="region__banner">
        <img src="<?php echo $region_emblem_url; ?>" alt="" class="region__emblem">

        <h1 class="region__name">
            <?php echo $region->name; ?>
        </h1>
    </section>

    <!-- Description -->
    <?php if ( ! empty ( $region_description ) ) : ?>
        <section class="region__description">
            <div class="region__descriptionContent">
                <?php echo wp_kses_post( wpautop( $region_description ) ); ?>

                <button class="region__descriptionButton">
                    <?php _e( 'Більше...', 'geoheritage' ); ?>
                    <svg class="region__descriptionButtonIcon" width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg" class="header__menuItemArrow"><path d="M15.7071 1.70711C16.0976 1.31658 16.0976 0.683417 15.7071 0.292893C15.3166 -0.0976311 14.6834 -0.0976311 14.2929 0.292893L15.7071 1.70711ZM8 8L7.29289 8.70711C7.48043 8.89464 7.73478 9 8 9C8.26522 9 8.51957 8.89464 8.70711 8.70711L8 8ZM1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L1.70711 0.292893ZM14.2929 0.292893L7.29289 7.29289L8.70711 8.70711L15.7071 1.70711L14.2929 0.292893ZM8.70711 7.29289L1.70711 0.292893L0.292893 1.70711L7.29289 8.70711L8.70711 7.29289Z" fill="#52d858"/></svg>
                </button>
            </div>
        </section>
    <?php endif; ?>

    <!-- Monuments -->
    <section class="region__monuments">
        <h2 class="region__monumentsTitle">
            <?php _e( 'Геопамʼятки області', 'geoheritage' ); ?>
        </h2>

        <div class="region__monumentsList">
            <?php if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
            
                    <a href="<?php the_permalink(); ?>" class="region__monumentsItem" data-depth="0.2">
                        <?php 
                        if ( has_post_thumbnail() ) :
                            echo get_the_post_thumbnail( $id, 'medium', array( 'class' => 'region__monumentsItemImage' ) );
                        else :
                            echo '<img src="' . get_template_directory_uri() . '/resource/dist/images/UkraineFlag.webp" alt="Geological monument image" class="region__monumentsItemImage">';
                        endif;
                        ?>
                        
                        <div class="region__monumentsItemName">
                            <?php the_title() ?>

                            <svg class="region__monumentsItemIcon" width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.9 5C1.9 3.29 3.29 1.9 5 1.9H9V0H5C2.24 0 0 2.24 0 5C0 7.76 2.24 10 5 10H9V8.1H5C3.29 8.1 1.9 6.71 1.9 5ZM6 6H14V4H6V6ZM15 0H11V1.9H15C16.71 1.9 18.1 3.29 18.1 5C18.1 6.71 16.71 8.1 15 8.1H11V10H15C17.76 10 20 7.76 20 5C20 2.24 17.76 0 15 0Z" fill="white"/>
                            </svg>
                        </div>
                    </a>

            <?php endwhile;

            else : ?>

                <p class="region__monumentsNotFound">
                    <?php _e( 'Геопам\'ятки в процесі створення.', 'geoheritage' ); ?>
                </p>

            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>