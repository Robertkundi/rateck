<?php

namespace Elementor;

if(!defined('ABSPATH')) {
	exit;
}

class Bascart_Vendor_Grid extends Widget_Base {
	public $base;

	public function get_title() {

		return esc_html__('Vendor Grid', 'bascart');

	}

	public function get_icon() {
		return 'eicon-call-to-action';
	}

	public function get_categories() {
		return ['bascart-elements'];
	}

	public function get_menus() {
		$list  = [];
		$menus = wp_get_nav_menus();
		foreach($menus as $menu) {
			$list[$menu->slug] = $menu->name;
		}

		return $list;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__('Vendor Grid Settings', 'bascart'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'column',
			[
				'label'           => esc_html__('Column', 'bascart'),
				'description'     => esc_html__('Choose the column', 'bascart'),
				'type'            => Controls_Manager::NUMBER,
				'min'             => 1,
				'max'             => 12,
				'step'            => 1,
				'desktop_default' => 3,
				'tablet_default'  => 2,
				'mobile_default'  => 1,
				'selectors'       => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
				]
			]
		);
		$this->add_control(
			'show_banner',
			[
				'label'        => esc_html__('Show Banner', 'bascart'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'bascart'),
				'label_off'    => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);
		$this->add_control(
			'show_avatar',
			[
				'label'        => esc_html__('Show Avarar', 'bascart'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'bascart'),
				'label_off'    => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);
		$this->add_control(
			'show_button',
			[
				'label'        => esc_html__('Show Button', 'bascart'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'bascart'),
				'label_off'    => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'vendor_style_tab',
			[
				'label' => esc_html__('Vendor Image Style', 'bascart'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'vendor_image_border_radious',
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
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .seller-avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'bannar_style_tab',
			[
				'label' => esc_html__('Bannar Area Style', 'bascart'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'bannar_border_radious',
			[
				'label'      => esc_html__('Border Radius', 'bascart'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '6',
					'right'    => '6',
					'bottom'   => '0',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .store-banner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_style_tab',
			[
				'label' => esc_html__('Content Area Style', 'bascart'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_background_color',
			[
				'label'     => esc_html__('Background Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f8f8f8',
				'selectors' => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .store-content' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'content_background_hover_color',
			[
				'label'     => esc_html__('Hover Background Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F84D17',
				'selectors' => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .ts-single-vendor:hover .store-content' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'content_area_padding',
			[
				'label'      => esc_html__('Padding', 'bascart'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default'    => [
					'top'      => '50',
					'right'    => '30',
					'bottom'   => '30',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .store-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'content_area_border_radious',
			[
				'label'      => esc_html__('Border Radius', 'bascart'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '6',
					'left'     => '6',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .store-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'           => 'button_typography',
				'label'          => esc_html__('Button Typography', 'bascart'),
				'selector'       => '{{WRAPPER}} .ts-vendor-grid-wrapper .ts-vendor-button',
				'fields_options' => [
					'typography'  => [
						'default' => 'custom',
					],
					'font_weight' => [
						'default' => '500',
					],
					'font_size'   => [
						'default'    => [
							'size' => '14',
							'unit' => 'px'
						],
						'label'      => esc_html__('Font Size (px)', 'bascart'),
						'size_units' => ['px']
					],
					'line_height' => [
						'default'    => [
							'size' => '32',
							'unit' => 'px'
						],
						'label'      => esc_html__('Line Height (px)', 'bascart'),
						'size_units' => ['px'] // enable only px
					]
				],
				'exclude'        => [
					'font_family',
					'letter_spacing',
					'word_spacing',
					'text_transform',
					'text_decoration',
					'font_style'
				],
			)
		);
		$this->add_control(
			'button_background_color',
			[
				'label'     => esc_html__('Background Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#F84D17',
				'selectors' => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .ts-vendor-button' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__('Hover Background Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-vendor-grid-wrapper .ts-vendor-button:hover' => 'background: {{VALUE}};',
				]
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

	public function get_name() {
		return 'vendor-grid';
	}

	protected function render_raw() {
		$settings = $this->get_settings_for_display();

		$tpl = get_widget_template($this->get_name());
		if(file_exists($tpl)) {
			include $tpl;
		}
	}

	protected function content_template() {
	}
}