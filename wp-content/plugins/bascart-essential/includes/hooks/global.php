<?php if ( ! defined( 'ABSPATH' ) ) exit;
if (!function_exists('is_plugin_active')) {
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

// Woo Mini Cart
// -----------------------------------------------

// add cart tile controls to woo mini cart
add_action( 'elementor/element/elementskit-woo-mini-cart/content_section/before_section_end', function( $element, $args ) {

	$element->add_control( 'ekit_woo_mini_cart_show_title', [
		'label'        => esc_html__('Show Cart Title', 'bascart-essential'),
		'type'         => \Elementor\Controls_Manager::SWITCHER,
		'return_value' => 'yes',
		'default'      => '',
		'separator'     => 'before',
	]);

	$element->add_control(
		'ekit_woo_mini_cart_title',
		[
			'label'     => esc_html__( 'Cart Title', 'bascart-essential' ),
			'type'      => \Elementor\Controls_Manager::TEXT,
			'default'   => esc_html__('My Cart', 'bascart-essential'),
			'condition' => ['ekit_woo_mini_cart_show_title' => 'yes'],
		]
	);
	$element->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name'           => 'cart_title_typography',
			'label'          => esc_html__('Typeography', 'bascart'),
			'fields_options' => [
				'typography'  => [
					'default' => 'custom',
				],
				'font_weight' => [
					'default' => '400',
				],
				'font_size'   => [
					'label'      => esc_html__('Font Size', 'bascart'),
					'default'    => [
						'size' => '12',
						'unit' => 'px'
					],
					'size_units' => ['px']
				],
				'line_height' => [
					'label'      => esc_html__('Line Height', 'bascart'),
					'default'    => [
						'size' => '24',
						'unit' => 'px'
					],
					'size_units' => ['px', 'em']
				],
			],
			'selector'       => '{{WRAPPER}} .mini-cart-title',
			'condition' => ['ekit_woo_mini_cart_show_title' => 'yes']
		]
	);
	$element->add_responsive_control(
		'cart_title_margin',
		[
			'label'      => esc_html__('Margin', 'bascart'),
			'type'       => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'default'    => [
				'top'      => '0',
				'right'    => '0',
				'bottom'   => '0',
				'left'     => '0',
				'unit'     => 'px',
				'isLinked' => true,
			],
			'selectors'  => [
				'{{WRAPPER}} .mini-cart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => ['ekit_woo_mini_cart_show_title' => 'yes']
		]
	);
	$element->add_control(
		'cart_title_color',
		[
			'label'     => esc_html__('Title Color', 'bascart'),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'default'   => '#101010',
			'selectors' => [
				'{{WRAPPER}} .mini-cart-title' => 'color: {{VALUE}};',
			],
			'condition' => ['ekit_woo_mini_cart_show_title' => 'yes']
		]
	);
	$element->add_control(
		'cart_title_hover_color',
		[
			'label'     => esc_html__('Title Hover Color', 'bascart'),
			'type'      => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .ekit-dropdown-back:hover .mini-cart-title' => 'color: {{VALUE}};',
			],
			'condition' => ['ekit_woo_mini_cart_show_title' => 'yes']
		]
	);	
}, 10, 2 );

// update new option to to woo mini cart visibility
add_action( 'elementor/element/elementskit-woo-mini-cart/content_section/before_section_end', function( $control_stack, $args ) {

	$new_options = [
		'default' => 'click',
		'options' => [
			'click'		=> esc_html__( 'Click', 'bascart-essential' ),
			'hover'		=> esc_html__( 'Hover', 'bascart-essential' ),
			'off_canvas'	=> esc_html__( 'Off Canvas', 'bascart-essential' ),
		],
	];

	$control_stack->update_control( 'ekit_woo_mini_cart_visibility', $new_options );
}, 10, 2 );

if(is_plugin_active( 'elementskit-lite/elementskit-lite.php' ) && !is_plugin_active( 'elementskit/elementskit.php' )){
	// mini cart offcanvas after body open tag
	add_action('wp_body_open', 'mini_cart_offcanvas_after_body_open_tag');
	if ( !function_exists('mini_cart_offcanvas_after_body_open_tag') ) {
		function mini_cart_offcanvas_after_body_open_tag() {
			?>
			<div class="xs-sidebar-group">
				<div class="xs-overlay bg-black"></div>
				<div class="ekit-wid-con xs-minicart-widget">
					<div class="ekit-mini-cart">
						<div class="widget-heading media">
							<h3 class="widget-title align-self-center d-flex"><?php echo esc_html__('Shopping cart', 'bascart-essential'); ?></h3>
							<div class="media-body">
								<a href="#" class="close-side-widget">
									<i class="xts-icon xts-times"></i>
								</a>
							</div>
						</div>
						<div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
