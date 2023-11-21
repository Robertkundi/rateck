<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (!defined('ABSPATH')) exit;
class Bascart_Product_Category extends Widget_Base
{


	public $base;

	public function get_name()
	{
		return 'product-category';
	}

	public function get_title()
	{

		return esc_html__('Product Category', 'bascart');
	}

	public function get_icon()
	{
		return 'eicon-gallery-grid';
	}

	public function get_categories()
	{
		return ['bascart-elements'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'section_tab',
			[
				'label' => esc_html__('Product Category', 'bascart'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ajax_load',
			[
				'label' => esc_html__('Enable Ajax Load?', 'bascart'),
				'type' => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Yes', 'bascart'),
				'label_off' => esc_html__('No', 'bascart'),
				'default'   => 'yes',
			]
		);

		$this->add_control(
			'style',
			[
				'label' => esc_html__('Style', 'bascart'),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => esc_html__('Grid Style', 'bascart'),
					'style-4' => esc_html__('Grid Style 2', 'bascart'),
					'grid-style-3' => esc_html__('Grid Style 3', 'bascart'),
					'style-2' => esc_html__('Masonary Style', 'bascart'),
					'style-3' => esc_html__('List Style', 'bascart'),
					'style-5' => esc_html__('List Style 2', 'bascart'),
					'list-style-3' => esc_html__('List Style 3', 'bascart'),
				],
				'description' => esc_html__('Choose the category style', 'bascart')
			]
		);

		$this->add_control(
			'category',
			[
				'label' => esc_html__('Select Category', 'bascart'),
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->post_category(),
				'multiple' => true,
				'label_block' => true,
				'condition' => ['style' => 'style-1'],
				'description' => esc_html__('choose the category that you want to show ', 'bascart')

			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'single_category',
			[
				'label' => esc_html__('Select Category', 'bascart'),
				'type' => ElementsKit_Controls_Manager::AJAXSELECT2,
				'options'   => 'ajaxselect2/product_cat',
				'description' => esc_html__('choose the category that you want to show ', 'bascart')
			]
		);
		$repeater->add_control(
			'cat_image',
			[
				'label' => __('Choose Image', 'bascart'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__('Choose the category image', 'bascart')
			]
		);

		// Controls needed for only list-style-3
		$repeater->add_control(
			'category_item_background',
			[
				'label' => esc_html__('Item Background', 'bascart'),
				'description' => esc_html__('Set only for (List Style 3)','bascart'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{CURRENT_ITEM}}.product-category-wrap' => 'background: {{VALUE}}',
				]
			]
		);
		$repeater->add_control(
			'category_image_background',
			[
				'label' => esc_html__('Image Background', 'bascart'),
				'description' => esc_html__('Set only for (List Style 3)','bascart'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{CURRENT_ITEM}} .product-category-image img' => 'background: {{VALUE}}',
				]
			]
		);
		// End of list-style-3 specfic controls

		$repeater->add_control(
			'show_description',
			[
				'label' => esc_html__('Show Description', 'bascart'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'bascart'),
				'label_off' => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater->add_responsive_control(
			'img_horizontal_position',
			[
				'label' => __('Image Position Horizontal', 'bascart'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.product-category-wrap, {{WRAPPER}} .grid-style-3 {{CURRENT_ITEM}}.product-category-wrap:hover' => 'background-position-x: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$repeater->add_responsive_control(
			'img_vertical_position',
			[
				'label' => __('Image Position Vertical', 'bascart'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 200
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.product-category-wrap, {{WRAPPER}} .grid-style-3 {{CURRENT_ITEM}}.product-category-wrap:hover' => 'background-position-y: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'single_cat_list',
			[
				'label' => __('Repeater List', 'bascart'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'condition' => ['style' => ['style-2', 'style-3', 'style-4', 'style-5', 'list-style-3', 'grid-style-3']],
				'default' => [
					[
						'single_category' => __('Title #1', 'bascart'),
					],
				],
			]
		);

		$this->add_control(
			'column',
			[
				'label' => esc_html__('Column', 'bascart'),
				'description' => esc_html__('Choose the column', 'bascart'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'12' => esc_html__('1', 'bascart'),
					'6' => esc_html__('2', 'bascart'),
					'4'  => esc_html__('3', 'bascart'),
					'3' => esc_html__('4', 'bascart'),
				],
				'condition' => ['style' => ['style-1', 'grid-style-3']],
			]
		);

		$this->add_responsive_control(
			'style_3_column',
			[
				'label' => esc_html__('Column', 'bascart'),
				'description' => esc_html__('Choose the column', 'bascart'),
				'type'	=> Controls_Manager::NUMBER,
				'min' 	=> 1,
				'max' 	=> 12,
				'step' 	=> 1,
				'desktop_default'	=> 3,
				'tablet_default'	=> 2,
				'mobile_default'	=> 1,
				'selectors' => [
					'{{WRAPPER}} .bascart-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
				],
				'condition' => ['style' => 'style-3', 'style' => 'list-style-3'],
			]
		);
		// Needed for list style 3
		$this->add_responsive_control(
			'item_gap_handeler',
			[
				'label' => esc_html__('Column Gap', 'bascart'),
				'type'	=> Controls_Manager::NUMBER,
				'desktop_default'	=> 20,
				'tablet_default'	=> 20,
				'mobile_default'	=> 10,
				'selectors' => [
					'{{WRAPPER}} .bascart-grid' => 'grid-gap: {{VALUE}}px',
				],
				'condition' => ['style' => 'list-style-3']
			]
		);
		// End list style 3

		$this->add_control(
			'show_count',
			[
				'label' => esc_html__('Show Product Count', 'bascart'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'bascart'),
				'label_off' => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('Are you want to show product count', 'bascart')

			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => esc_html__('Show Button', 'bascart'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'bascart'),
				'label_off' => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('Are you want to show Button', 'bascart')

			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'bascart'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Default title', 'bascart'),
				'placeholder' => __('Type your title here', 'bascart'),
				'condition' => ['show_icon' => 'yes']
			]
		);


		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'bascart'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => ['show_icon' => 'yes']
			]
		);


		$this->add_control(
			'text_align',
			[
				'label' => esc_html__('Content Alignment', 'bascart'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bascart'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bascart'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bascart'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .single-product-category' => 'text-align: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();

		// STYLE - TITLE
		$this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__('Title', 'bascart'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'bascart'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default'	=> '#3E3E3E',
				'selectors' => [
					'{{WRAPPER}} .product-category-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__('Title Hover Color', 'bascart'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default'	=> '#F03D3F',
				'selectors' => [
					'{{WRAPPER}} .product-category-title:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__('Title Background Color', 'bascart'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .product-category-title' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'bascart'),
				'selector' => '{{WRAPPER}} .product-category-title',
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
						'label' => esc_html__('Font Size (px)', 'bascart'),
						'size_units' => ['px'],
						'default' => [
							'size' => '20',
							'unit' => 'px'
						]
					],
					'font_weight'    => [
						'default' => '500',
					],
					'text_transform' => [
						'default' => '',
					],
					'line_height'    => [
						'default' => [
							'size' => '22',
							'unit' => 'px'
						]
					],
					'letter_spacing' => [
						'default' => [
							'size' => '',
						]
					],
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .product-category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .product-category-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label'            => esc_html__('Border Radius (px)', 'bascart'),
				'type'            => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px'],
				'default'   => [
					'top' => '6',
					'right' => '6',
					'bottom' => '6',
					'left' => '6',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors'     => [
					'{{WRAPPER}} .product-category-wrap,{{WRAPPER}} .bascart-product-category-item h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Box Shadow', 'bascart'),
				'selector' => '{{WRAPPER}} .product-category-title',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'category_description_section',
			[
				'label' => esc_html__('Description', 'bascart'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_description_typography',
				'label'    => esc_html__('Typography', 'bascart'),
				'selector' => '{{WRAPPER}} .category-description',
				'fields_options'    => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_weight'   => [
						'default'   => '400',
					],
					'font_size'     => [
						'default'   => [
							'size'  => '14',
							'unit'  => 'px'
						],
						'label'    => esc_html__('Font Size (px)', 'bascart'),
						'size_units' => ['px']
					],
					'text_transform'    => [
						'default'   => '',
					],
					'line_height'   => [
						'default'   => [
							'size'  => '17',
							'unit'  => 'px'
						],
						'size_units' => ['px'] // enable only px
					]
				],
			)
		);

		$this->add_control(
			'category_description_color',
			[
				'label'     => esc_html__('Color', 'bascart'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#666666',
				'selectors' => [
					'{{WRAPPER}} .category-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_description_padding',
			[
				'label'			=> esc_html__('Padding (px)', 'bascart'),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> ['px'],
				'default'   => [
					'top' => '15',
					'right' => '0',
					'bottom' => '15',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .category-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Image style section (List style 3)
		$this->start_controls_section(
			'category_image_style',
			[
				'label' => esc_html__('Image Style', 'bascart'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['style' => 'list-style-3']
			]
		);
		$this->add_responsive_control(
			'image_margin',
			[
				'label' => esc_html__('Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'       => '0',
					'right'     => '20',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
					'isLinked'  => false,
				],
				'selectors' => [
					'{{WRAPPER}} .product-category-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__('Border radius', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'       => '50',
					'right'     => '50',
					'bottom'    => '50',
					'left'      => '50',
					'unit'      => '%',
					'isLinked'  => true,
				],
				'selectors' => [
					'{{WRAPPER}} .product-category-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

		// Count section style
		$this->start_controls_section(
			'count_section',
			[
				'label' => esc_html__('Category Count', 'bascart'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['show_count' => 'yes']
			]
		);
		$this->add_control(
			'count_color',
			[
				'label' => esc_html__('Color', 'bascart'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cat-count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'count_typography',
				'label' => esc_html__('Typography', 'bascart'),
				'selector' => '{{WRAPPER}} .cat-count',
			]
		);
		$this->add_responsive_control(
			'count_margin',
			[
				'label' => esc_html__('Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .cat-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// STYLE - BUTTON
		$this->start_controls_section(
			'btn_section',
			[
				'label' => esc_html__('Button', 'bascart'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => ['show_icon' => 'yes']
			]
		);

		$this->start_controls_tabs(
			'button_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			[
				'label' => __('Normal', 'bascart'),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'bascart'),
				'type' => Controls_Manager::COLOR,
				'default'	=> '#858585',
				'selectors' => [
					'{{WRAPPER}} .cat-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('background Color', 'bascart'),
				'type' => Controls_Manager::COLOR,
				'default'	=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .cat-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab',
			[
				'label' => __('Hover', 'bascart'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Color', 'bascart'),
				'type' => Controls_Manager::COLOR,
				'default'	=> '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .cat-icon:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('background Color', 'bascart'),
				'type' => Controls_Manager::COLOR,
				'default'	=> '#F03D3F',
				'selectors' => [
					'{{WRAPPER}} .cat-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'button_typography_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'button_font_size',
			[
				'label' => esc_html__('Button Font Size (px)', 'bascart'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'default'       => [
					'unit'  => 'px',
					'size'  => '12',
				],
				'selectors' => [
					'{{WRAPPER}} .cat-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'bascart'),
				'selector' => '{{WRAPPER}} .cat-icon',
				'fields_options' => [
					'border_type' => [
						'default' => 'yes'
					],
					'border' => [
						'default' => 'solid',
						'devices' => ['desktop'],
						'responsive' => true,
					],
					'width' => [
						'label' => esc_html__('Border Width', 'bascart'),
						'default'       => [
							'top'       => '0',
							'right'     => '0',
							'bottom'    => '2',
							'left'      => '0',
							'isLinked'  => false,
						],
						'devices' => ['desktop'],
						'responsive' => true,
					],
					'color' => [
						'label' => esc_html__('Border Color', 'bascart'),
						'alpha' => false,
						'default' => '#FFF',
						'devices' => ['desktop'],
						'responsive' => true,
					],

				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border radius', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'       => '100',
					'right'     => '100',
					'bottom'    => '100',
					'left'      => '100',
					'unit'      => '%',
					'isLinked'  => true,
				],
				'selectors' => [
					'{{WRAPPER}} .cat-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .cat-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// STYLE - ADVANCED
		$this->start_controls_section(
			'advance_section',
			[
				'label' => esc_html__('Advanced', 'bascart'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_column_gap',
			[
				'label' => esc_html__('Column Gap', 'bascart'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'       => [
					'unit'  => 'px',
					'size'  => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .bascart-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
				],
				'condition' => ['style' => 'style-3'],
			]
		);

		$this->add_responsive_control(
			'item_row_gap',
			[
				'label' => esc_html__('Row Gap', 'bascart'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'       => [
					'unit'  => 'px',
					'size'  => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .bascart-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
				],
				'condition' => ['style' => 'style-3'],
			]
		);

		$this->start_controls_tabs(
			'item_tabs',
			[
				'condition' => ['style' => 'style-3'],
			]
		);

		$this->start_controls_tab(
			'item_normal_tab',
			[
				'label' => __('Normal', 'bascart'),
			]
		);

		$this->add_control(
			'item_bg',
			[
				'label'	=> esc_html__('Background Color', 'bascart'),
				'type' 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-cat-list-item' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'label' => __('Box Shadow', 'bascart'),
				'selector' => '{{WRAPPER}} .single-cat-list-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'item_hover_tab',
			[
				'label' => __('Hover', 'bascart'),
			]
		);

		$this->add_control(
			'item_hover_bg',
			[
				'label'	=> esc_html__('Background Color', 'bascart'),
				'type' 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-cat-list-item:hover' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_hover_box_shadow',
				'label' => __('Box Shadow', 'bascart'),
				'selector' => '{{WRAPPER}} .single-cat-list-item:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'item_divider',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => ['style' => 'style-3'],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__('Padding', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .product-category-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label' => esc_html__('Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .product-category-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => ['style!' => 'style-3'],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'grid_style_3',
			[
				'label' => esc_html__('Grid Style Three', 'bascart'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['style' => 'grid-style-3'],
			]
		);

		$this->add_control(
			'cat_wrapper_bg_color',
			[
				'label' => esc_html__('Wrapper Background Color', 'bascart'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default'	=> '',
				'selectors' => [
					'{{WRAPPER}} .grid-style-3 .product-category-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'grid_style_3_title_margin',
			[
				'label' => esc_html__('Title Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .grid-style-3 .product-category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_style_3_padding',
			[
				'label' => esc_html__('Padding', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .grid-style-3 .product-category-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_style_3_margin',
			[
				'label' => esc_html__('Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .grid-style-3 .product-category-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'grid_style_3_border_radius',
			[
				'label' => esc_html__('Border radius', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'       => '50',
					'right'     => '50',
					'bottom'    => '50',
					'left'      => '50',
					'unit'      => '%',
					'isLinked'  => true,
				],
				'selectors' => [
					'{{WRAPPER}} .grid-style-3 .product-category-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>
		<div class="bascart-<?php echo esc_attr($this->get_name()); ?>" data-widget_settings='<?php echo json_encode($settings); ?>'>
			<?php $this->render_raw(); ?>
		</div>
<?php
	}

	protected function render_raw()
	{
		$settings = $this->get_settings_for_display();

		if (!empty($settings['ajax_load']) && $settings['ajax_load'] == 'yes') {
			echo '<div class="bascart-loader">' . esc_html__('Loading...', 'bascart') . '<div class="bascart-loader-circle"></div></div>';
			return;
		}

		$tpl = get_widget_template($this->get_name());
		include $tpl;
	}

	public function post_category(){
        $terms = get_terms(array(
            'taxonomy'    => 'product_cat',
            'hide_empty'  => -1,
            'posts_per_page' => -1,
        ));

        $cat_list = [];
        foreach ($terms as $post) {
            $cat_list[$post->term_id]  = [$post->name];
        }
        return $cat_list;
    }
	
	protected function content_template()
	{
	}


}
