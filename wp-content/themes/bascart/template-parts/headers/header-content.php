<?php

$bascart_main_logo_url = "";

?>
<header class="primary-menu-wraper">
	<div class="container-fluid">
      <div class="header-row">
         <div class="site-branding">
            <?php
               $bascart_main_logo_url = bascart_option('main_logo');
               if(!empty($bascart_main_logo_url)){
                  $bascart_main_logo_url = wp_get_attachment_image_src($bascart_main_logo_url,'full');
                  if($bascart_main_logo_url['0'] != ''){
                     $bascart_main_logo_url = $bascart_main_logo_url['0'];       
                  }
               }
               $bascart_main_logo_url = $bascart_main_logo_url;
            ?>
            <a class="custom-logo-link" href="<?php echo esc_url(home_url('/')); ?>">
               <?php if($bascart_main_logo_url !=''): ?>
                     <img width="286" height="115" class="img-fluid" src="<?php echo esc_url($bascart_main_logo_url); ?>" alt="<?php echo get_bloginfo('name') ?>">
                  <?php else: ?>
                     <img width="286" height="115" class="img-fluid" src="<?php echo esc_url( bascart_src( 'main_logo', BASCART_IMG . '/logo.png') ) ?>" srcset="<?php echo esc_url( bascart_src( 'main-logo', BASCART_IMG . '/logo.png') ) ?> 1x, <?php echo esc_url( bascart_src( 'custom-logo', BASCART_IMG . '/logo.png') ); ?> 2x" alt="<?php bloginfo('name'); ?>"  >
               <?php endif; ?>
            </a>
            <div class="menu-button-container">
               <button class="nav-toggle-button nav-menu-toggle" aria-controls="primary-navigation" aria-expanded="false">
                  <span class="dropdown-icon"></span>
                  <span class="dropdown-icon"></span>
                  <span class="dropdown-icon"></span>
               </button><!-- #primary-mobile-menu -->
            </div><!-- .menu-button-container -->
         </div>
         <?php if ( has_nav_menu( 'primary' ) ) { ?>
            <div id="primary-navigation" class="primary-navigation-wraper" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'bascart' ); ?>">
               <div class="primary-navigation">
                  <?php
                  wp_nav_menu(
                     array(
                        'theme_location'  => 'primary',
                        'menu_class'      => 'menu-wrapper',
                        'container_class' => 'primary-menu-container',
                        'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
                        'fallback_cb'     => false,
                     )
                  );
                  ?>
               </div>
               <div class="nav-menu-backdrop" aria-controls="primary-navigation"></div>
            </div><!-- #site-navigation -->
         <?php }; ?>
         <div class="header-search">
            <?php echo get_search_form(); ?>
         </div>
         <?php if ( class_exists( 'WooCommerce' ) ) { ?>
            <div class="header-cart">
               <?php
               $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
               $cart_url = wc_get_cart_url();  // Set Cart URL         
               ?>
               <a class="menu-item cart-contents" href="<?php echo esc_url($cart_url); ?>">
               <i class="xts-icon xts-cart"></i>
               <sup><?php echo esc_html($cart_count); ?></sup>
               </a>
            </div>
         <?php } ?>
      </div>
   </div>
</header>

