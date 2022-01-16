<?php get_header(); ?>

<?php
while ( have_posts() ) :
	the_post(); ?>

    <?php echo geoHeritageBreadcrumbs(); ?>

<?php endwhile; ?>


<?php get_footer(); ?>