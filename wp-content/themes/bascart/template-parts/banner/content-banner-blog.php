<?php
    $banner_image             =  '';
    $banner_title             = '';
    $blog_banner_title_color = "";
    $show_breadcrumb = "";

    if ( defined( 'DEVM' ) ) {

        // Blog banner show option
        $blog_show_banner          = bascart_option('blog_show_banner');

        if ( $blog_show_banner !== 'yes' ) {
            return;
        }

        // Customizer options
        $blog_banner_title       = bascart_option('blog_banner_title');
        $banner_blog_image       = bascart_option('banner_blog_image');
        $blog_show_breadcrumb    = bascart_option('blog_show_breadcrumb');

        //title
        $banner_title = ($blog_banner_title != '') ? $blog_banner_title : get_bloginfo( 'name' );

        // Breacumb
        if( $blog_show_breadcrumb === 'yes' ){
            $show_breadcrumb = "yes";
        }

        //image
        $banner_image = ($banner_blog_image != '') ? wp_get_attachment_image_url($banner_blog_image, "full") : BASCART_IMG.'/bg_banner.png';

    }else{
        //default
        $banner_image             = "";
        $banner_title    = get_bloginfo( 'name' );
        $blog_banner_title_color = "#FFFFFF";
        $show_breadcrumb         = "no";
    }
    if( isset($banner_image) && $banner_image != ''){
        $banner_image = $banner_image;
    } 

    $class_name = 'blog-banner';
    
    get_template_part('template-parts/banner/banner', 'content', [
        'banner-image' => $banner_image,
        'banner-title' => $banner_title,
        'show-breadcrumb' => $show_breadcrumb,
        'class-name' => $class_name,
    ]);
?>

