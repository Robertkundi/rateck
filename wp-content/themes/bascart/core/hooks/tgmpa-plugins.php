<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * register required plugins
 */

function bascart_register_required_plugins() {
	$plugins	 = array(
		array(
			'name'		 => esc_html__( 'Elementor', 'bascart' ),
			'slug'		 => 'elementor',
			'required'	 => true,
        ),
		array(
			'name'		 => esc_html__( 'Elementskit Lite', 'bascart' ),
			'slug'		 => 'elementskit-lite',
			'required'	 => true,
        ),
		array(
			'name'		 => esc_html__( 'Devmonsta', 'bascart' ),
			'slug'		 => 'devmonsta',
			'required'	 => true,
			'version'	 => 'Version 1.0.6',
            'source'	 => 'https://demo.themewinter.com/wp/plugins/devmonsta.zip',
		),
		array(
			'name'		 => esc_html__( 'MetForm', 'bascart' ),
			'slug'		 => 'metform',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'WooCommerce', 'bascart' ),
			'slug'		 => 'woocommerce',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'ShopEngine', 'bascart' ),
			'slug'		 => 'shopengine',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'One Click Demo Import', 'bascart' ),
			'slug'		 => 'one-click-demo-import',
			'required'	 => true,
		),
		array(
			'name'		 => esc_html__( 'Bascart Essential', 'bascart' ),
			'slug'		 => 'bascart-essential',
			'required'	 => true,
			'version'	 => '1.0.8',
			'source'	 => 'https://demo.themewinter.com/wp/plugins/bascart/bascart-essential.zip',
		),
		array(
			'name'		 => esc_html__( 'Timetics', 'bascart' ),
			'slug'		 => 'timetics',
		),
	);

	$config = array(
		'id'			 => 'bascart', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path'	 => '', // Default absolute path to bundled plugins.
		'menu'			 => 'bascart-install-plugins', // Menu slug.
		'parent_slug'	 => 'themes.php', // Parent menu slug.
		'capability'	 => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'	 => true, // Show admin notices or not.
		'dismissable'	 => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'	 => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic'	 => false, // Automatically activate plugins after installation or not.
		'message'		 => '', // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'bascart_register_required_plugins' );