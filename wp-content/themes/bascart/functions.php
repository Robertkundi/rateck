<?php
/*
Theme Name: Bascart
Theme URI: https://themeforest.net/user/tripples/portfolio
Author: Tripples
Author URI: https://themewinter.com
Description: Bascart is powerful and modern eCommerce responsive WordPress Theme.
Version: 1.1.5
License: GNU General Public License v2 or later
License URI: LICENSE
Text Domain: bascart
Tags: theme-options, post-formats, featured-images
Requires at least: 5.0
Tested up to: 6.2
Requires PHP: 7.4
*/
// shorthand contants
define('BASCART_THEME', 'Bascart WordPress Theme');
define('BASCART_VERSION', '1.1.5');


// shorthand contants for theme assets url
// ------------------------------------------------------------------------
define('BASCART_THEME_URI', get_template_directory_uri());
define('BASCART_THEME_DIR_FILE', dirname(__FILE__));
define('BASCART_IMG', BASCART_THEME_URI . '/assets/images');
define('BASCART_CSS', BASCART_THEME_URI . '/assets/css');
define('BASCART_JS', BASCART_THEME_URI . '/assets/js');


// shorthand contants for theme assets directory path
// ----------------------------------------------------------------------------------------
define('BASCART_THEME_DIR', get_template_directory());
define('BASCART_IMG_DIR', BASCART_THEME_DIR . '/assets/images');
define('BASCART_CSS_DIR', BASCART_THEME_DIR . '/assets/css');
define('BASCART_JS_DIR', BASCART_THEME_DIR . '/assets/js');

define('BASCART_CORE', BASCART_THEME_DIR . '/core');
define('BASCART_CORE_ELEMENTOR', BASCART_CORE . '/elementor');
define('BASCART_REMOTE_CONTENT', esc_url('https://demo.themewinter.com/wp/demo-content/bascart'));
define('BASCART_LIVE_URL', esc_url('https://demo.themewinter.com/wp/bascart/'));

// set up the content width value based on the theme's design
// ----------------------------------------------------------------------------------------
if (!isset($content_width)) {
    $content_width = 800;
}

// set up theme default and register various supported features.
// ----------------------------------------------------------------------------------------

function bascart_setup() {

    // make the theme available for translation
    $lang_dir = BASCART_THEME_DIR . '/languages';
    load_theme_textdomain('bascart', $lang_dir);

    // add support for post formats
    add_theme_support('post-formats', [
        'standard', 'image', 'video', 'audio','gallery'
    ]);

    // add support for automatic feed links
    add_theme_support('automatic-feed-links');

    // let WordPress manage the document title
    add_theme_support('title-tag');

    // add support for post thumbnails
    add_theme_support('post-thumbnails');

    // add support for custom logo
    add_theme_support( 'custom-logo' );

    // hard crop center center


    // register navigation menus
    register_nav_menus(
        [
            'primary' => esc_html__('Primary Menu', 'bascart')
        ]
    );

    // HTML5 markup support for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    
    // woocommerce features
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}
add_action('after_setup_theme', 'bascart_setup');

function bascart_remove_devm_settings() {
    remove_submenu_page( 'themes.php', 'devm-settings' );
}
add_action( 'admin_menu', 'bascart_remove_devm_settings', 999 );


// include the init.php
// ----------------------------------------------------------------------------------------
require_once( BASCART_CORE . '/init.php');
require_once( BASCART_CORE . '/elementor/elementor.php');

// wordpress default image size remove for temporary 
// ----------------------------------------------------------------------------------------
add_filter( 'intermediate_image_sizes_advanced', 'bascart_remove_default_images' );
function bascart_remove_default_images( $sizes ) {
    unset( $sizes['small']); 
    unset( $sizes['medium']); 
    unset( $sizes['large']);
    unset( $sizes['medium_large']);
    return $sizes;
}

// for optimization dequeue styles
add_action( 'wp_enqueue_scripts', 'bascart_remove_unused_css_files', 100 );
function bascart_remove_unused_css_files() {
    $fontawesome = bascart_option('optimization_fontawesome_enable', 'yes');
    $blocklibrary = bascart_option('optimization_blocklibrary_enable', 'yes');
    $elementoricons = bascart_option('optimization_elementoricons_enable', 'yes');
    $elementkitsicons = bascart_option('optimization_elementkitsicons_enable', 'yes');
    $socialicons = bascart_option('optimization_socialicons_enable', 'yes');
    $dashicons = bascart_option('optimization_dashicons_enable', 'yes');

    // dequeue wp-review styles file
    wp_dequeue_style( 'wur_content_css' );
    wp_deregister_style( 'wur_content_css' );

    if($fontawesome == 'no'){
        wp_dequeue_style( 'font-awesome' );
	    wp_deregister_style( 'font-awesome' );
        wp_dequeue_style( 'font-awesome-5-all' );
        wp_deregister_style( 'font-awesome-5-all' );
        wp_dequeue_style( 'font-awesome-4-shim' );
        wp_deregister_style( 'font-awesome-4-shim' );
        wp_dequeue_style( 'fontawesome-five-css' );
        wp_dequeue_script( 'font-awesome-4-shim' );
        wp_dequeue_style( 'wc-blocks-style' );
        wp_dequeue_style( 'wc-blocks-vendors-style' );
        wp_dequeue_script( 'flexslider' );
        wp_dequeue_script( 'jquery-blockui' );
        wp_deregister_script( 'jquery-blockui' );
    }

    if($blocklibrary == 'no'){
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-block-style' );           
    }

    if($elementkitsicons == 'no'){		
		wp_dequeue_style( 'elementor-icons-ekiticons' );
		wp_deregister_style( 'elementor-icons-ekiticons' );
    }

    if($socialicons == 'no'){		
		wp_dequeue_style( 'xs_login_font_login_css' );
    }

    if($elementoricons == 'no'){
        // Don't remove it in the backend
        if ( is_admin() || current_user_can( 'manage_options' ) ) {
            return;
        }
        wp_dequeue_style( 'elementor-animations' );
        wp_dequeue_style( 'elementor-icons' );
        wp_deregister_style( 'elementor-icons' );
    }

    if($dashicons == 'no'){
        // Don't remove it in the backend
        if ( is_admin() || current_user_can( 'manage_options' ) ) {
            return;
        }
        wp_dequeue_style( 'dashicons' );
    }
	
}

add_action( 'elementor/frontend/after_register_styles',function() {
    $fontawesome = bascart_option('optimization_fontawesome_enable', 'yes');
    if($fontawesome == 'no'){
        foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
            wp_deregister_style( 'elementor-icons-fa-' . $style );
        }
    }
}, 20 );

add_filter('elementor/icons_manager/native', function($icons){
    $fontawesome = bascart_option('optimization_fontawesome_enable', 'yes');
    if($fontawesome == 'no'){
        unset($icons['fa-regular']);
        unset($icons['fa-solid']);
        unset($icons['fa-brands']);        
    }

    return $icons;
});

add_action('elementskit_lite/after_loaded', function(){
    add_filter('elementor/icons_manager/additional_tabs', function($icons){
        $elementkitsicons = bascart_option('optimization_elementkitsicons_enable', 'yes');
    
        if($elementkitsicons == 'no'){
            unset($icons['ekiticons']);      
        }
    
        return $icons;
    });
});

/* disable option for font awesome icons from elementor editor */
add_action( 'elementor/frontend/after_register_styles',function() {
    $fontawesome = bascart_option('optimization_fontawesome_enable', 'yes');
    if($fontawesome == 'no'){
        foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
            wp_deregister_style( 'elementor-icons-fa-' . $style );
        }
    }

    $elementkitsicons = bascart_option('optimization_elementkitsicons_enable', 'yes');
    if($elementkitsicons == 'no'){
        wp_deregister_script( 'animate-circle' );
        wp_dequeue_script( 'animate-circle' );
        wp_deregister_script( 'elementskit-elementor' );    
        wp_dequeue_script( 'elementskit-elementor' );
        wp_dequeue_style( 'e-animations' );
        wp_deregister_style( 'e-animations' );
    }
    
}, 20 );

/* Push google analytics code in head area */
function bascart_meta_des_viewport(){
    ?>
    <meta name="description" content="<?php if ( is_single() ) {
    single_post_title('', true); 
        } else {
        bloginfo('name'); echo " - "; bloginfo('description');
        }
        ?>" />
    <?php
}
add_action('wp_head', 'bascart_meta_des_viewport', 1);

// content security policy(CSP)
header("Content-Security-Policy: script-src 'self' 'unsafe-inline' 'unsafe-eval' https: data:");

// Fix builder templates preview link
add_filter('shopengine/demo/bypass_nonce', function($arg){
	return 1;
});

// preloader
function bascart_preloader_function(){
    $preloader_show = bascart_option('preloader_show');
        if($preloader_show == 'yes'){

            $bascart_preloader_logo_url = bascart_option('preloader_logo');
            if(!empty($bascart_preloader_logo_url)){
                $bascart_preloader_logo_url = wp_get_attachment_image_src($bascart_preloader_logo_url,'full');
                if($bascart_preloader_logo_url['0'] != ''){
                    $bascart_preloader_logo_url = $bascart_preloader_logo_url['0'];       
                }
            }
            $bascart_preloader_logo_url = $bascart_preloader_logo_url;
            
        ?>
        <div id="preloader">
            <?php if($bascart_preloader_logo_url !=''): ?>
            
            <div class="preloader-logo">
                <img width="286" height="115" class="img-fluid" src="<?php echo esc_url($bascart_preloader_logo_url); ?>" alt="<?php echo get_bloginfo('name') ?>">
            </div>
            <?php else: ?>
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
            <?php endif; ?>
            <div class="preloader-cancel-btn-wraper"> 
                <span class="btn btn-primary preloader-cancel-btn">
                  <?php esc_html_e('Cancel Preloader', 'bascart'); ?></span>
            </div>
        </div>
    <?php
    }
}
add_action('wp_body_open', 'bascart_preloader_function');