<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * enqueue all theme scripts and styles
 */


// stylesheets
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {

	if (! defined( 'DEVM' ) ) {
		wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap', [], null );
	}

	if(class_exists('woocommerce')){
		wp_enqueue_style( 'bascart-woocommerce-style', BASCART_CSS . '/public/woocommerce.css', null, BASCART_VERSION );
	}

	wp_enqueue_style( 'bascart-icon', BASCART_CSS . '/public/icon.css', null, BASCART_VERSION );
	wp_enqueue_style( 'bascart-style', BASCART_CSS . '/public/style.css', null, BASCART_VERSION );

}

// javascripts
// ----------------------------------------------------------------------------------------
if ( !is_admin() ) {
	// Load WordPress Comment js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
	}
}
