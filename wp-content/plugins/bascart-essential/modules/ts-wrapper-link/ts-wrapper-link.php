<?php
use Elementor\Controls_Manager;
use Elementor\Element_Base;

defined('ABSPATH') || die();

class Ts_Wrapper_Link {

	public static function init() {
		add_action( 'elementor/element/column/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );

		add_action( 'elementor/frontend/before_render', [ __CLASS__, 'before_section_render' ], 1 );
	}

	public static function add_controls_section( Element_Base $element) {
		$tabs = Controls_Manager::TAB_CONTENT;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() ) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section(
			'_section_ts_wrapper_link',
			[
				'label' => esc_html__( 'Wrapper Link', 'bascart-essential' ),
				'tab'   => $tabs,
			]
		);

		$element->add_control(
			'ts_element_link',
			[
				'label'       => esc_html__( 'Link', 'bascart-essential' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => 'https://yourlink.com',
			]
		);

		$element->end_controls_section();
	}

	public static function before_section_render( Element_Base $element ) {
		$ts_link_settings = $element->get_settings_for_display( 'ts_element_link' );

		if ( $ts_link_settings && ! empty( $ts_link_settings['url'] ) ) {
			$element->add_render_attribute(
				'_wrapper',
				[
					'data-ts-link' => json_encode( $ts_link_settings ),
					'style' => 'cursor: pointer'
				]
			);
		}
	}
}

Ts_Wrapper_Link::init();
