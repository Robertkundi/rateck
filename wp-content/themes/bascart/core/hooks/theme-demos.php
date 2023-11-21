<?php
function bascart_import_files() {
	$demo_content_installer	 = BASCART_REMOTE_CONTENT;
	return array(
	  array(
		'import_file_name'           => 'Default Home',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/default/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/default/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/default/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/default/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL
	  ),
	  array(
		'import_file_name'           => 'Classic Fashion',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/fashion/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/fashion/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/fashion/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/fashion/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL . 'fashion'
	  ),
	  array(
		'import_file_name'           => 'Bascart Gadget',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/gadget/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/gadget/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/gadget/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/gadget/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL . 'gadget'
	  ),
	  array(
		'import_file_name'           => 'Bascart Medical',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/medical/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/medical/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/medical/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/medical/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL . 'medical'
	  ),
	  array(
		'import_file_name'           => 'Bascart Furniture',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/furniture/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/furniture/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/furniture/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/furniture/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL . 'furniture'
	  ),
	  array(
		'import_file_name'           => 'Bascart Sports',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/sports/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/sports/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/sports/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/sports/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL . 'sports'
	  ),
	  array(
		'import_file_name'           => 'Bascart Grocery',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/grocery/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/grocery/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/grocery/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/grocery/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL . 'grocery'
	  ),
	  array(
		'import_file_name'           => 'Bascart Multi Vendor',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/multivendor/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/multivendor/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/multivendor/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/multivendor/screenshot.jpg',
		'preview_url'                => BASCART_LIVE_URL . 'multivendor'
	  ),
	  array(
		'import_file_name'           => 'Bascart RTL',
		'categories'                 => array( 'Multipage' ),
		'import_file_url'            => $demo_content_installer . '/rtl/main.xml',
		'import_customizer_file_url' => $demo_content_installer . '/rtl/customizer.dat',
		'import_widget_file_url'     => $demo_content_installer . '/rtl/widgets.wie',
		'import_preview_image_url'   => $demo_content_installer . '/rtl/screenshot.png',
		'preview_url'                => BASCART_LIVE_URL . 'rtl'
	  ),
	);
}
add_filter( 'pt-ocdi/import_files', 'bascart_import_files' );

function bascart_after_import( $selected_import ) {

	$slider_array = array(
		"Default Home" => [
			"slug" => "Home",
		],
		"Classic Fashion" => [
			"slug" => "Home",
		],
		"Bascart Gadget" => [
			"slug" => "Home",
		],
		"Bascart Medical" => [
			"slug" => "Home",
		],
		"Bascart Furniture" => [
			"slug" => "Home",
		],
		"Bascart Sports" => [
			"slug" => "Home",
		],
		"Bascart Grocery" => [
			"slug" => "Home",
		],
		"Bascart Multi Vendor" => [
			"slug" => "Home",
		],
		"Bascart RTL" => [
			"slug" => "Home",
		]
	);
	if( is_array( $slider_array ) ){
		foreach ($slider_array as $i => $values) {
			if ( $i === $selected_import['import_file_name'] ) {
				foreach ($values as $key => $value) {
					//Set Front page
					$page = get_page_by_title( $values['slug'] );
					if ( isset( $page->ID ) ) {
						update_option( 'page_on_front', $page->ID );
						update_option( 'show_on_front', 'page' );
					}
				}
			}
		}
	}
}
add_action( 'pt-ocdi/after_import', 'bascart_after_import' );