<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
      <?php
        if ( is_front_page() || is_single() ) {
          the_title();
        } else if ( is_category() ) {
          echo single_cat_title();
        }
      ?>
    </title>
    
    <?php wp_head(); ?>
  </head>
  <body>

    <!-- <div id="preloader">
      <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
        <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round" />
        <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round" />
        <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round" />
        <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round" />
      </svg>
    </div> -->
    
    <header class="header">

      <div class="header__container">
        <?php the_custom_logo(); ?>

        <nav class="header__primaryMenu">
          <h4 class="header__primaryMenuTitle">
            <?php _e( 'Меню:', 'geoheritage' ) ?>
          </h4>
          <?php $menuArgs = array(
            'theme_location'  => 'Primary menu',
            'menu'            => 'Primary menu', 
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

        <div class="header__search">
          <?php get_search_form(); ?>
        </div>

        <button class="header__buttonMenu">
          <svg class="header__buttonMenuIcon" width="36" height="30" viewBox="0 0 36 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.8 0C10.8059 0 10 0.805888 10 1.8C10 2.79411 10.8059 3.6 11.8 3.6H34.2C35.1941 3.6 36 2.79411 36 1.8C36 0.805888 35.1941 0 34.2 0H11.8Z" fill="#52D858"/>
            <path d="M7.8 26C6.80589 26 6 26.8059 6 27.8C6 28.7941 6.80589 29.6 7.8 29.6H34.2C35.1941 29.6 36 28.7941 36 27.8C36 26.8059 35.1941 26 34.2 26H7.8Z" fill="#52D858"/>
            <path d="M1.8 13C0.805886 13 0 13.8059 0 14.8C0 15.7941 0.805887 16.6 1.8 16.6H34.2C35.1941 16.6 36 15.7941 36 14.8C36 13.8059 35.1941 13 34.2 13H1.8Z" fill="#52D858"/>
          </svg>
        </button>
      </div>

    </header>