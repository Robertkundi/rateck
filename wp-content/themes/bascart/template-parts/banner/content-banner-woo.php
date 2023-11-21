<?php
    $banner_image             =  '';
    $banner_title             = '';
    $woo_banner_title_color = "";
    $show_breadcrumb = "";

    if ( defined( 'DEVM' ) ) {

        // Blog banner show option
        $woo_show_banner          = bascart_option('woo_show_banner');

        if ( $woo_show_banner !== 'yes' ) {
            return;
        }

        // Customizer options
        $woo_banner_title       = bascart_option('woo_banner_title');
        $banner_woo_image       = bascart_option('banner_woo_image');
        $woo_show_breadcrumb    = bascart_option('woo_show_breadcrumb');

        //title
        $banner_title = ($woo_banner_title != '') ? $woo_banner_title : esc_html__( 'Products', 'bascart' );

        // Breacumb
        if( $woo_show_breadcrumb === 'yes' ){
            $show_breadcrumb = "yes";
        }

        //image
        $banner_image = ($banner_woo_image != '') ? wp_get_attachment_image_url($banner_woo_image, "full") : BASCART_IMG.'/bg_banner.png';

    }else{
        //default
        $banner_image             = "";
        $banner_title    = esc_html__( 'Products', 'bascart' );
        $woo_banner_title_color = "#FFFFFF";
        $show_breadcrumb         = "no";
    }
    if( isset($banner_image) && $banner_image != ''){
        $banner_image = $banner_image;
    } 

    $class_name = 'woo-banner';
    
    get_template_part('template-parts/banner/banner', 'content', [
        'banner-image' => $banner_image,
        'banner-title' => $banner_title,
        'show-breadcrumb' => $show_breadcrumb,
        'class-name' => $class_name,
    ]);
?>

