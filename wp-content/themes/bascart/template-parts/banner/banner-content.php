<?php
$banner_image = $args['banner-image'];
$banner_title = $args['banner-title'];
$show_breadcrumb = $args['show-breadcrumb'];
$class_name = $args['class-name'];
$title_breadcrumb_center_align = bascart_option('title_breadcrumb_center_align');
$page_meta_title_breadcumb_align = bascart_meta_option( get_the_ID(), 'page_meta_title_breadcumb_align' );

?>

<?php if ( class_exists('woocommerce') && ( is_cart() || is_checkout() ) ) { ?>
     <?php bascart_checkout_steps(); ?>
<?php }elseif( class_exists('woocommerce') && is_product()){
    ?>
    <div class="single-product-breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-left align-self-center">
                    <?php
                        if( $show_breadcrumb == 'yes' ){
                            bascart_get_breadcrumbs();
                        }
                    ?>
                </div>
            </div>        
        </div>  
    </div>  
<?php }else { ?>
    
    <section class="xs-banner banner-single <?php echo esc_attr($class_name); ?> <?php echo esc_attr($banner_image == ''?'banner-solid':'banner-bg'); ?>" style="background-image: url(<?php echo esc_attr( $banner_image ); ?>)">
        <div class="container">
            <div class="row">
                <div class="<?php echo esc_attr( $page_meta_title_breadcumb_align == 'yes' || $title_breadcrumb_center_align == 'yes' ? 'col-lg-12 text-center': 'col-lg-7 align-self-center') ?>">
                    <h1 class="banner-title">
                        <?php
                            if(class_exists( 'WooCommerce' ) && is_product()){
                                echo esc_html( $banner_title ); 
                            } else if(class_exists( 'WooCommerce' ) && is_shop()){
                                echo woocommerce_page_title();
                            } else if(is_archive()){
                            the_archive_title();
                            } elseif(is_single()){
                                the_title();
                            } else {
                                echo esc_html( $banner_title );
                            }
                        ?>
                    </h1>
                </div>
                <div class="<?php echo esc_attr($page_meta_title_breadcumb_align == 'yes' || $title_breadcrumb_center_align == 'yes' ? 'col-lg-12 text-center center-padding': 'col-lg-5 col-md-12 text-right align-self-center')?> ">
                    <?php
                        if( $show_breadcrumb == 'yes' ){
                            bascart_get_breadcrumbs();
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>