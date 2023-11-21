<?php

namespace Elementor;

class ElementsKit_Extend_Sticky{

    public function __construct() {
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'register_controls' ], 6 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'register_controls' ], 6 );
	}

	public function register_controls( Controls_Stack $element ) {
		$element->start_controls_section(
			'section_scroll_effect',
			[
				'label' => esc_html__( 'ElementsKit Sticky', 'bascart-essential' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'ekit_sticky',
			[
				'label' => esc_html__( 'Sticky', 'bascart-essential' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'bascart-essential' ),
					'top' 				=> esc_html__( 'Top', 'bascart-essential' ),
					'bottom' 			=> esc_html__( 'Bottom', 'bascart-essential' ),
					'column' 			=> esc_html__( 'Column', 'bascart-essential' ),
					'show_on_scroll_up' => esc_html__( 'Show on Scroll Up', 'bascart-essential' ),
				],
				'prefix_class'	=> 'ekit-sticky--',
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'ekit_sticky_until',
			[
				'label' => esc_html__( 'Sticky Until', 'bascart-essential' ),
				'description' => esc_html__( 'Section id without starting hash, example "section1".', 'bascart-essential'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'ekit_sticky!' => ['', 'column'],
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'ekit_sticky_offset',
			[
				'label' => esc_html__( 'Sticky Offset', 'bascart-essential' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'required' => true,
				'condition' => [
					'ekit_sticky!' => '',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'ekit_sticky_color',
			[
				'label' => esc_html__( 'Sticky Background Color', 'bascart-essential' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'ekit_sticky!' => ['', 'column'],
				],
				'selectors' => [
					'{{WRAPPER}}.ekit-sticky--effects' => 'background-color: {{VALUE}}',
				],
			]
		);

		$element->add_control(
			'ekit_sticky_on',
			[
				'label' => esc_html__( 'Sticky On', 'bascart-essential' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'desktop_tablet_mobile' => esc_html__( 'All Devices', 'bascart-essential' ),
					'desktop' => esc_html__( 'Desktop Only', 'bascart-essential' ),
					'desktop_tablet' => esc_html__( 'Desktop & Tablet', 'bascart-essential' ),
				],
				'default' => 'desktop_tablet_mobile',
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'ekit_sticky!' => '',
				],
			]
		);

		$element->add_control(
			'ekit_sticky_effect_offset',
			[
				'label' => esc_html__( 'Add "ekit-sticky--effects" Class Offset', 'bascart-essential' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'required' => true,
				'condition' => [
					'ekit_sticky!' => '',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_controls_section();
	}
}
