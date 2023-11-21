<?php
if ( defined( 'DEVM' ) ) {
   // Body Bg
   $style_body_bg     = bascart_option('style_body_bg', '#FFF');

   // Primary color
   $style_primary     = bascart_option('style_primary', '#ee4d4d');

   // Secondary color
   $style_secondary     = bascart_option('secondary_color', '#a352ff');

   // Title color
   $title_color     = bascart_option('title_color', '#101010');

   // details banner title color
   $details_banner_title_color     = bascart_option('details_banner_title_color');
   $details_banner_overlay_color     = bascart_option('details_banner_overlay_color');

   // blog banner 
   $banner_title_color     = bascart_option('banner_title_color');
   $banner_overlay_color     = bascart_option('banner_overlay_color');

   // page banner 
   $page_banner_title_color     = bascart_option('page_banner_title_color');
   $page_meta_banner_title_color = bascart_meta_option( get_the_ID(), 'page_meta_banner_title_color');
   $page_banner_breadcrumb_color = bascart_option('page_banner_breadcrumb_color');
   $page_meta_breadcrumb_color = bascart_meta_option( get_the_ID(), 'page_meta_breadcrumb_color');
   $page_banner_overlay_color     = bascart_option('page_banner_overlay_color');

   // blog banner 
   $woo_banner_title_color     = bascart_option('woo_banner_title_color');
   $woo_banner_overlay_color     = bascart_option('woo_banner_overlay_color');




   // Footer color
   $footer_bg_color     = bascart_option('footer_bg_color');
   $footer_text_color          = bascart_option('footer_text_color');
   $footer_link_color          = bascart_option('footer_link_color');
   $footer_widget_title_color  = bascart_option('footer_widget_title_color');
   $copyright_bg_color         = bascart_option('copyright_bg_color');
   $footer_copyright_color     = bascart_option('footer_copyright_color');
   $footer_padding_top         = bascart_option('footer_padding_top');
   $footer_padding_bottom      = bascart_option('footer_padding_bottom');


   // all typography
   $global_body_font = bascart_option( 'body_font' );

   Bascart_DEVM_Google_Fonts::add_typography_v2( $global_body_font );
   $body_font = bascart_advanced_font_styles( $global_body_font );

   $heading_font_one = bascart_option( 'heading_font_one' );
   Bascart_DEVM_Google_Fonts::add_typography_v2( $heading_font_one );
   $heading_font_one = bascart_advanced_font_styles( $heading_font_one );

   $heading_font_two = bascart_option( 'heading_font_two' );
   Bascart_DEVM_Google_Fonts::add_typography_v2( $heading_font_two );
   $heading_font_two = bascart_advanced_font_styles( $heading_font_two );

   $heading_font_three = bascart_option( 'heading_font_three' );
   Bascart_DEVM_Google_Fonts::add_typography_v2( $heading_font_three );
   $heading_font_three = bascart_advanced_font_styles( $heading_font_three );

   $heading_font_four = bascart_option( 'heading_font_four' );
   Bascart_DEVM_Google_Fonts::add_typography_v2( $heading_font_four );
   $heading_font_four = bascart_advanced_font_styles( $heading_font_four );

   $heading_font_five = bascart_option( 'heading_font_five' );
   Bascart_DEVM_Google_Fonts::add_typography_v2( $heading_font_five );
   $heading_font_five = bascart_advanced_font_styles( $heading_font_five );

   $heading_font_six = bascart_option( 'heading_font_six' );
   Bascart_DEVM_Google_Fonts::add_typography_v2( $heading_font_six );
   $heading_font_six = bascart_advanced_font_styles( $heading_font_six );


   $custom_css = "
      html.fonts-loaded h1{ 
         $heading_font_one
      }
      html.fonts-loaded h2{
            $heading_font_two
      }
      html.fonts-loaded h3{
            $heading_font_three
      }
      html.fonts-loaded h4{
            $heading_font_four
      }
      html.fonts-loaded h5{
            $heading_font_five
      }
      html.fonts-loaded h6{
            $heading_font_six
      }
      body{
         background:{$style_body_bg };
      }

      html.fonts-loaded body{
         $body_font
      }

      .banner-title, .xs-jumbotron-title{
         color: {$banner_title_color};
      }
      
      .xs-banner:before{
         background-color: {$banner_overlay_color};
      }

      .details-banner .banner-title{
         color: {$details_banner_title_color};
      }
      .details-banner:before{
         background-color: {$details_banner_overlay_color};
      }

      .page-banner .banner-title{
         color: {$page_banner_title_color};
      }
      
      .page-banner .banner-title{
         color: {$page_meta_banner_title_color};
      }
      
      .page-banner:before{
         background-color: {$page_banner_overlay_color};
      }

      .page-banner .breadcrumb li , .page-banner .breadcrumb li a{
         color: {$page_banner_breadcrumb_color};
      }

      .page-banner .breadcrumb li , .page-banner .breadcrumb li a{
         color: {$page_meta_breadcrumb_color};
      }

      .woo-banner .banner-title{
         color: {$woo_banner_title_color};
      }
      .woo-banner:before{
         background-color: {$woo_banner_overlay_color};
      }
      .xs-footer{
         background-color:   $footer_bg_color;
         padding-top: $footer_padding_top;
         padding-bottom: $footer_padding_bottom;
      }
      .xs-footer .footer-widget,
      .xs-footer .footer-widget li,
      .xs-footer .footer-widget p{
         color: $footer_text_color;
      }

      .xs-footer .footer-widget a{
         color: $footer_link_color;
      }
      .xs-footer .widget-title{
         color: $footer_widget_title_color;
      }
      .copy-right{
         background-color:   $copyright_bg_color;
      }
      .copyright-text{
         color: $footer_copyright_color;
      }
      
      :root {
         --primary-color: {$style_primary};
         --secondary-color: {$style_secondary};
      }
   
      ";
   wp_add_inline_style( 'bascart-style', $custom_css );
}
