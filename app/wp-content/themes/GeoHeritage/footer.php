</main>

    <footer id="footer">
      <div class="container">
        <div id="partners">
          <?php $logosList = get_field('footerLogos', 'option');
          if( $logosList ) {
            foreach( $logosList as $logo ) { ?>

                <a href="<?php echo $logo['link'] ?>" class="link">
                  <?php echo wp_get_attachment_image( $logo['image'], 'full' ); ?>
                </a>

            <?php }
          } ?>
        </div>

        <div id="copyright">
          <?php the_field("copyright", "option") ?>
        </div>
      </div>
    </footer>

    <?php wp_footer();?>
  </body>
</html>