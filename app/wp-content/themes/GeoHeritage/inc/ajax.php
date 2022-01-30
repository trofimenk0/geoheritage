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
				<svg class="header__searchResultIcon" width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1.9 5C1.9 3.29 3.29 1.9 5 1.9H8.05C8.57467 1.9 9 1.47467 9 0.95V0.95C9 0.425329 8.57467 0 8.05 0H5C2.24 0 0 2.24 0 5C0 7.76 2.24 10 5 10H8.05C8.57467 10 9 9.57467 9 9.05V9.05C9 8.52533 8.57467 8.1 8.05 8.1H5C3.29 8.1 1.9 6.71 1.9 5ZM6 5C6 5.55228 6.44772 6 7 6H13C13.5523 6 14 5.55228 14 5V5C14 4.44772 13.5523 4 13 4H7C6.44772 4 6 4.44772 6 5V5ZM15 0H11.95C11.4253 0 11 0.425329 11 0.95V0.95C11 1.47467 11.4253 1.9 11.95 1.9H15C16.71 1.9 18.1 3.29 18.1 5C18.1 6.71 16.71 8.1 15 8.1H11.95C11.4253 8.1 11 8.52533 11 9.05V9.05C11 9.57467 11.4253 10 11.95 10H15C17.76 10 20 7.76 20 5C20 2.24 17.76 0 15 0Z" fill="#52d858"/>
				</svg>

				<?php the_title(); ?>
			</a>

        <?php endwhile;
        wp_reset_postdata();  
	else : ?>
	
		<div class="header__searchResultEmpty">
			<?php _e( 'Нічого не знайдено. Змініть будь ласка текст запиту.', 'geoheritage' ); ?>
		</div>
		
		<?php wp_reset_postdata();  
    endif;

    die();
}