<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
      <?php 
        if(is_front_page() || is_single()) {
          the_title();
        } else if(is_category()) {
          echo single_cat_title();
        }
      ?>
    </title>
    
    <?php wp_head(); ?>
  </head>
  <body <?php body_class( $class ); ?>>


    <div id="preloader">
      <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
        <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round" />
        <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round" />
        <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round" />
        <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round" />
      </svg>
    </div>
    
    <header id="header">

      <div class="container">
        <?php the_custom_logo(); ?>

        <nav id="mainMenu">


          <?php 

          $menuArgs = array(
            'theme_location'  => 'Головне меню',
            'menu'            => 'Головне меню', 
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

        <button id="btnMobileMenu">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="5" y="29" width="30" height="7" rx="1" fill="url(#paint0_linear)"/>
            <rect x="5" y="16" width="30" height="7" rx="1" fill="url(#paint1_linear)"/>
            <rect x="5" y="3" width="30" height="6" rx="1" fill="url(#paint2_linear)"/>
            <g filter="url(#filter0_bi)">
            <path d="M0 7.2C0 5.98497 0.994923 5 2.22222 5H37.7778C39.0051 5 40 5.98497 40 7.2V9.4C40 10.615 39.0051 11.6 37.7778 11.6H2.22222C0.994924 11.6 0 10.615 0 9.4V7.2Z" fill="#F1F1F1" fill-opacity="0.1"/>
            <path d="M0 7.2C0 5.98497 0.994923 5 2.22222 5H37.7778C39.0051 5 40 5.98497 40 7.2V9.4C40 10.615 39.0051 11.6 37.7778 11.6H2.22222C0.994924 11.6 0 10.615 0 9.4V7.2Z" fill="url(#paint3_linear)" fill-opacity="0.2"/>
            <path d="M0 20.4C0 19.185 0.994923 18.2 2.22222 18.2H37.7778C39.0051 18.2 40 19.185 40 20.4V22.6C40 23.815 39.0051 24.8 37.7778 24.8H2.22222C0.994924 24.8 0 23.815 0 22.6V20.4Z" fill="#F1F1F1" fill-opacity="0.1"/>
            <path d="M0 20.4C0 19.185 0.994923 18.2 2.22222 18.2H37.7778C39.0051 18.2 40 19.185 40 20.4V22.6C40 23.815 39.0051 24.8 37.7778 24.8H2.22222C0.994924 24.8 0 23.815 0 22.6V20.4Z" fill="url(#paint4_linear)" fill-opacity="0.2"/>
            <path d="M0 33.6C0 32.385 0.994923 31.4 2.22222 31.4H37.7778C39.0051 31.4 40 32.385 40 33.6V35.8C40 37.015 39.0051 38 37.7778 38H2.22222C0.994924 38 0 37.015 0 35.8V33.6Z" fill="#F1F1F1" fill-opacity="0.1"/>
            <path d="M0 33.6C0 32.385 0.994923 31.4 2.22222 31.4H37.7778C39.0051 31.4 40 32.385 40 33.6V35.8C40 37.015 39.0051 38 37.7778 38H2.22222C0.994924 38 0 37.015 0 35.8V33.6Z" fill="url(#paint5_linear)" fill-opacity="0.2"/>
            <path d="M2.22222 5.1H37.7778C38.9508 5.1 39.9 6.04115 39.9 7.2V9.4C39.9 10.5589 38.9508 11.5 37.7778 11.5H2.22222C1.0492 11.5 0.1 10.5589 0.1 9.4V7.2C0.1 6.04115 1.0492 5.1 2.22222 5.1ZM2.22222 18.3H37.7778C38.9508 18.3 39.9 19.2411 39.9 20.4V22.6C39.9 23.7589 38.9508 24.7 37.7778 24.7H2.22222C1.0492 24.7 0.1 23.7589 0.1 22.6V20.4C0.1 19.2411 1.0492 18.3 2.22222 18.3ZM2.22222 31.5H37.7778C38.9508 31.5 39.9 32.4411 39.9 33.6V35.8C39.9 36.9589 38.9508 37.9 37.7778 37.9H2.22222C1.0492 37.9 0.1 36.9589 0.1 35.8V33.6C0.1 32.4411 1.0492 31.5 2.22222 31.5Z" stroke="url(#paint6_linear)" stroke-opacity="0.1" stroke-width="0.2"/>
            </g>
            <defs>
            <filter id="filter0_bi" x="-3" y="2" width="46" height="39" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feGaussianBlur in="BackgroundImage" stdDeviation="1.5"/>
            <feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur"/>
            <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur" result="shape"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
            <feOffset dy="0.5"/>
            <feGaussianBlur stdDeviation="1"/>
            <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1"/>
            <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.4 0"/>
            <feBlend mode="normal" in2="shape" result="effect2_innerShadow"/>
            </filter>
            <linearGradient id="paint0_linear" x1="5" y1="29" x2="22.2224" y2="47.7418" gradientUnits="userSpaceOnUse">
            <stop stop-color="#82E8FF"/>
            <stop offset="1" stop-color="#379FFF"/>
            </linearGradient>
            <linearGradient id="paint1_linear" x1="5" y1="16" x2="22.2224" y2="34.7418" gradientUnits="userSpaceOnUse">
            <stop stop-color="#82E8FF"/>
            <stop offset="1" stop-color="#379FFF"/>
            </linearGradient>
            <linearGradient id="paint2_linear" x1="5" y1="3" x2="19.4026" y2="21.2854" gradientUnits="userSpaceOnUse">
            <stop stop-color="#82E8FF"/>
            <stop offset="1" stop-color="#379FFF"/>
            </linearGradient>
            <linearGradient id="paint3_linear" x1="0" y1="5" x2="45.8166" y2="19.1014" gradientUnits="userSpaceOnUse">
            <stop stop-color="#82E8FF"/>
            <stop offset="1" stop-color="#379FFF"/>
            </linearGradient>
            <linearGradient id="paint4_linear" x1="0" y1="5" x2="45.8166" y2="19.1014" gradientUnits="userSpaceOnUse">
            <stop stop-color="#82E8FF"/>
            <stop offset="1" stop-color="#379FFF"/>
            </linearGradient>
            <linearGradient id="paint5_linear" x1="0" y1="5" x2="45.8166" y2="19.1014" gradientUnits="userSpaceOnUse">
            <stop stop-color="#82E8FF"/>
            <stop offset="1" stop-color="#379FFF"/>
            </linearGradient>
            <linearGradient id="paint6_linear" x1="1.25" y1="6.5" x2="40" y2="6.5" gradientUnits="userSpaceOnUse">
            <stop stop-color="#7EE5FF"/>
            <stop offset="1" stop-color="#41A9FF"/>
            </linearGradient>
            </defs>
          </svg>
        </button>
      </div>


    </header>

    <main id="content">