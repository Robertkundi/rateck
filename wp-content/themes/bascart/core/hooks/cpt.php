<?php if (!defined('ABSPATH')) die('Direct access forbidden.');

// if there is no excerpt, sets a defult placeholder
// ----------------------------------------------------------------------------------------

if ( class_exists( 'BascartCustomPost\Bascart_CustomPost' ) ) {

	$brand_tax = new  BascartCustomPost\Bascart_Taxonomies('bascart');
	$brand_tax->xs_init('brands_cat', 'Brand Category', 'Brands Categories', 'product');
}

