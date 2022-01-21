<?php
/*
* Livesearch ajax function
*/
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() { ?>

	<script type="text/javascript">
		$('#searchInput').on( 'keyup', function() {
			let searchQuery = $('#searchInput').val();
			if ( searchQuery.length > 2 ) {
				$.ajax( {
					url: '<?php echo admin_url('admin-ajax.php'); ?>',
					type: 'post',
					data: {
						action: 'search_geological_monuments',
						searchQuery: searchQuery
					},
					success: function( data ) {
						if ( ! data ) {
							$('#searchResults').removeClass('header__searchResults_active').empty().hide();
							return;
						}
						$('#searchResults').addClass('header__searchResults_active').css('display', 'flex').empty().append( data );
					}
				} );
			} else {
				$('#searchResults').removeClass('header__searchResults_active').empty().hide();
			}
		} );
	</script>

<?php }

add_action('wp_ajax_search_geological_monuments' , 'geo_search_geological_monuments');
add_action('wp_ajax_nopriv_search_geological_monuments','geo_search_geological_monuments');
function geo_search_geological_monuments() {

    $the_query = new WP_Query( 
      array( 
        'posts_per_page' => 20, 
        's'              => esc_attr( $_POST['searchQuery'] ), 
        'post_type'      => 'geological_monuments',
      ) 
    );
  
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ): $the_query->the_post(); ?>

			<a href="<?php echo esc_url( post_permalink() ); ?>" class="header__searchResultLink">
				<?php the_title();?>
			</a>

        <?php endwhile;
        wp_reset_postdata();  
    endif;

    die();
}