<?php
    $banner_image    = '';
    $banner_title    = '';
    $show_breadcrumb = "";

    if ( defined( 'DEVM' ) ) {
        $blog_show_banner          = bascart_option('blog_single_show_banner');
        if ( $blog_show_banner !== 'yes' ) {
            return;
        }

    $blog_show_breadcrumb    = bascart_option('blog_single_show_breadcrumb');
    $banner_blog_image       = bascart_option('banner_blog_single_image');
    $blog_banner_title_color = bascart_option('blog_single_banner_title_color');

    //image
    $banner_image = ($banner_blog_image != '') ? wp_get_attachment_image_url($banner_blog_image, "full") : BASCART_IMG.'/bg_banner.png';

    //breadcumb
    $show_breadcrumb =  (isset($blog_show_breadcrumb)) ? $blog_show_breadcrumb : 'yes';

    }else{
        //default
    $banner_image    = "";
    $banner_title    = get_bloginfo( 'name' );
    $show_breadcrumb = 'yes';
    $blog_banner_title_color = "#ffffff";
    }
    if( isset($banner_image) && $banner_image != ''){
        $banner_image = $banner_image;
    }

    $wraper_class = 'xs-jumbotron d-flex align-items-center ';
    if (is_single() || is_search() || is_home()) {
        $wraper_class .= ' xs_single_blog_banner ';
    }
    $class_name = 'details-banner';
    
    get_template_part('template-parts/banner/banner', 'content', [
        'banner-image' => $banner_image,
        'banner-title' => $banner_title,
        'show-breadcrumb' => $show_breadcrumb,
        'class-name' => $class_name,
    ]);
?>