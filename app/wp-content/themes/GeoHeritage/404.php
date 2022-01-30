<?php get_header(); 

$image_id = carbon_get_theme_option( 'page_404_image' );
?>

<main class="notFoundPage">
    <section class="notFoundPage__content">
        <img src="<?php echo wp_get_attachment_image_url( $image_id, 'full' ); ?>" alt="" class="notFoundPage__image">

        <h1 class="notFoundPage__title">
            <?php _e( 'Упс... За даним посиланням нічого не знайдено.', 'geoheriatge' ); ?>
        </h1>

        <a href="<?php echo home_url(); ?>" class="notFoundPage__link">
            <?php _e( 'Перейти на головну сторінку', 'geoheriatge' ); ?>
        </a>
    </section>
</main>

<?php get_footer(); ?>