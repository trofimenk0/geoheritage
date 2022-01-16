<?php
/**
 * Footer data
 */
$partners = carbon_get_theme_option( 'partners' );
$copyright_text = carbon_get_theme_option( 'copyright_text' );
$partners_title = carbon_get_theme_option( 'partners_title' );

?>


    <footer class="footer">
      <div class="footer__content">
        <div class="footer__partners">
          <h3 class="footer__partnersTitle">
            <?php echo $partners_title; ?>
          </h3>

          <?php foreach ( $partners as $partner ) { 
            
            $logo_id = $partner['partner_logo'];
            $image_url = wp_get_attachment_image_url( $logo_id, 'thumbnail', true );
            $image_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
            ?>
            
            <a href="<?php echo $partner['partner_link']; ?>" class="footer__partnersLink" rel="nofollow">
              <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>" class="footer__partnersLogo">
              <span class="footer__partnersName">
                <?php echo $partner['partner_name']; ?>
              </span>
            </a>

          <?php } ?>

        </div>

        <nav class="footer__menu">
          <h3 class="footer__menuTitle">
            Популярні області
          </h3>

          <?php $menuArgs = array(
            'theme_location'  => 'Footer menu',
            'menu'            => 'Footer menu', 
            'container'       => false, 
            'container_class' => '', 
            'container_id'    => '',
            'menu_class'      => '', 
            'menu_id'         => '',
            'echo'            => false,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '%3$s',
            'depth'           => 0,
            'walker'          => '',
          );

          echo strip_tags(wp_nav_menu( $menuArgs ), '<a>' ); ?>
        </nav>
      </div>

      <div class="footer__copyright">
        <?php echo $copyright_text; ?>
      </div>
    </footer>

    <?php wp_footer();?>
  </body>
</html>