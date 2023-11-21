<?php
namespace Elementor;

if(!defined('ABSPATH')) {
	exit;
}

class Bascart_Wishlist_Counter extends Widget_Base {
	public $base;

	public function get_name() {
		return 'wishlist-counter';
	}
	public function get_title() {

		return esc_html__('Wishlist Counter', 'bascart');

	}

	public function get_icon() {
		return 'eicon-heart-o';
	}

	public function get_categories() {
		return ['bascart-elements'];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__('Wishlist Settings', 'bascart'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'wishlist_icon',
			[
				'label'   => esc_html__('Select Wishlist Icon', 'bascart'),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'xts-icon xts-heart',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'wishlist_url',
			[
				'label'       => esc_html__('Wishlist URL', 'bascart'),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'bascart'),
				'default'     => [
					'url'               => '#',
					'is_external'       => false,
					'nofollow'          => true,
					'custom_attributes' => '',
				],
			]
		);
		$this->add_control(
			'show_wishlist_title',
			[
				'label' => esc_html__( 'Show Wishlist Title', 'bascart' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'wishlist_title',
			[
				'label' => esc_html__( 'Wishlist Title', 'bascart' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Wishlist', 'bascart' ),
				'placeholder' => esc_html__( 'Add wishlist widget title here.', 'bascart' ),
				'condition' => ['show_wishlist_title' => 'yes']
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_tab',
			[
				'label' => esc_html__('Wishlist Icon Style', 'bascart'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'icon_typography',
				'label'          => esc_html__('Icon Typeography', 'bascart'),
				'selector'       => '{{WRAPPER}} .wishlist-content > i',
				'exclude'        => ['font_family', 'font_style', 'text_decoration', 'text_transform', 'letter_spacing', 'word_spacing'],
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'label'      => esc_html__('Font Size ', 'bascart'),
						'default'    => [
							'size' => '20',
							'unit' => 'px'
						],
						'size_units' => ['px']
					],
					'line_height' => [
						'label'      => esc_html__('Line Height', 'bascart'),
						'default'    => [
							'size' => '1',
							'unit' => 'em'
						],
						'size_units' => ['em']
					],
				],
			]
		);
		$this->add_control(
			'wishlist_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .wishlist-content > i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wishlist_icon_hover_color',
			[
				'label'     => esc_html__('Icon Hover Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wishlist-content > i:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'wishlist_icon_padding',
			[
				'label'      => esc_html__('Icon Padding', 'bascart'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .wishlist-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wishlist_icon_margin',
			[
				'label'      => esc_html__('Icon Margin', 'bascart'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .wishlist-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'wishlist_icon_border',
				'label'    => esc_html__('Icon Border', 'bascart'),
				'selector' => '{{WRAPPER}} .wishlist-content',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'counter_style_tab',
			[
				'label' => esc_html__('Wishlist Counter Style', 'bascart'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'counter_typography',
				'label'          => esc_html__('Counter Typeography', 'bascart'),
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
							'size' => '22',
							'unit' => 'px'
						],
						'size_units' => ['px', 'em']
					],
				],
				'selector'       => '{{WRAPPER}} .wishlist-count'
			]
		);
		$this->add_responsive_control(
			'counter_width',
			[
				'label'     => esc_html__('Counter Width', 'bascart'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '22',
				'selectors' => [
					'{{WRAPPER}} .wishlist-count' => 'width: {{VALUE}}px;',
				],
			]
		);
		$this->add_responsive_control(
			'counter_height',
			[
				'label'     => esc_html__('Counter Height', 'bascart'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '22',
				'selectors' => [
					'{{WRAPPER}} .wishlist-count' => 'height: {{VALUE}}px;',
				],
			]
		);
		$this->add_control(
			'counter_color',
			[
				'label'     => esc_html__('Counter Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .wishlist-count' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'counter_background_color',
			[
				'label'     => esc_html__('Counter Background Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#769881',
				'selectors' => [
					'{{WRAPPER}} .wishlist-count' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'counter_hover_color',
			[
				'label'     => esc_html__('Counter Hover Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wishlist-count:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'counter_hover_background_color',
			[
				'label'     => esc_html__('Counter Hover Background Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wishlist-count:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'counter_right_position',
			[
				'label'      => esc_html__('Counter Right Position', 'bascart'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => -15,
				],
				'selectors'  => [
					'{{WRAPPER}} .wishlist-count' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'counter_top_position',
			[
				'label'      => esc_html__('Counter Top Position', 'bascart'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => -10,
				],
				'selectors'  => [
					'{{WRAPPER}} .wishlist-count' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'counter_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bascart'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '50',
					'right'    => '50',
					'bottom'   => '50',
					'left'     => '50',
					'unit'     => '%',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .wishlist-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'wishlist_title_style',
			[
				'label' => esc_html__('Wishlist Title Style', 'bascart'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => ['show_wishlist_title' => 'yes']
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'wishlist_title_typography',
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
				'selector'       => '{{WRAPPER}} .wishlist-widget-title'
			]
		);
		$this->add_responsive_control(
			'wishlist_title_margin',
			[
				'label'      => esc_html__('Margin', 'bascart'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .wishlist-widget-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wishlist_title_color',
			[
				'label'     => esc_html__('Title Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#101010',
				'selectors' => [
					'{{WRAPPER}} .wishlist-widget-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'wishlist_title_hover_color',
			[
				'label'     => esc_html__('Title Hover Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wishlist-widget-title:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		?>
        <div class="bascart-<?php echo esc_attr($this->get_name()); ?>"
             data-widget_settings='<?php echo json_encode($settings); ?>'>
			<?php $this->render_raw(); ?>
        </div>
		<?php

	}
	protected function render_raw() {
		$settings = $this->get_settings_for_display();
        $tpl = get_widget_template($this->get_name());
        if (file_exists($tpl)) {
            include $tpl;
        }
	}

	protected function content_template() {
	}
}