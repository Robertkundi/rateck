<?php
function bascart_add_sub_menu_toggle( $output, $item, $depth, $args ) {
	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add toggle button.
		$output .= '<button class="sub-menu-toggle" aria-expanded="false">';
		$output .= '<span class="icon-plus xts-icon xts-chevron-right"></span>';
		$output .= '<span class="icon-minus xts-icon xts-chevron-right"></span>';
		$output .= '<span class="screen-reader-text">' . esc_html__( 'Open menu', 'bascart' ) . '</span>';
		$output .= '</button>';
	}
	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'bascart_add_sub_menu_toggle', 10, 4 );
