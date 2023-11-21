<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Bascart_Brands extends Widget_Base {


  public $base;

    public function get_name() {
        return 'brands';
    }

    public function get_title() {

        return esc_html__( 'Product Brands', 'bascart' );

    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return [ 'bascart-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Product Brands', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'style',
			[
				'label' => esc_html__( 'Category Style', 'bascart' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => esc_html__( 'Style 1', 'bascart' ),
					'style-2' => esc_html__( 'Style 2', 'bascart' ),
					'style-3' => esc_html__( 'Brand Slider', 'bascart' ),
				]
			]
		);
		$this->add_control(
			'ajax_load',
			[
                'label' => esc_html__( 'Enable Ajax Load?', 'bascart' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Yes', 'bascart' ),
                'label_off' => esc_html__( 'No', 'bascart' ),
                'default'   => 'yes',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-1'
						],
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-2'
						]
					]
				]
			]
		);
		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'bascart' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__( 'DESC', 'bascart' ),
					'ASC' => esc_html__( 'ASC', 'bascart' ),
				],
			]
		);

		$this->add_control(
			'category', [
				'label' => esc_html__( 'Select Brands', 'bascart' ),
				'label_block' => true,
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->brand_category(),
                'multiple' => true,
                'condition' => ['style!' => 'style-2'],
				'description' => esc_html__('choose the category that you want to show ', 'bascart')
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'single_category', [
				'label' => esc_html__( 'Select Brand', 'bascart' ),
				'label_block' => true,
				'type'      => Controls_Manager::SELECT2,
				'options'   => $this->brand_category(),
				'description' => esc_html__('choose the category that you want to show ', 'bascart')
			]
		);
		$repeater->add_control(
			'cat_image',
			[
				'label' => __( 'Choose Image', 'bascart' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__('choose the category Image ', 'bascart')
			]
		);

		$this->add_control(
			'single_cat_list',
			[
				'label' => __( 'Repeater List', 'bascart' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'condition' => ['style' => 'style-2'],
				'default' => [
					[
						'single_category' => __( 'Title #1', 'bascart' ),
					],
				],
			]
		);

        $this->add_responsive_control(
			'column',
			[
				'label' => esc_html__( 'Column', 'bascart' ),
                'description' => esc_html__('Choose the column', 'bascart'),
				'type'	=> Controls_Manager::NUMBER,
				'min' 	=> 1,
				'max' 	=> 12,
				'step' 	=> 1,
				'desktop_default'	=> 7,
				'tablet_default'	=> 2,
				'mobile_default'	=> 1,
                'selectors' => [
					'{{WRAPPER}} .bascart-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr)',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-1'
						],
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-2'
						]
					]
				]
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => esc_html__('Show brand icon', 'bascart'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'bascart'),
				'label_off' => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('Are you want to show brand icon', 'bascart')
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__('Show brand Title', 'bascart'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'bascart'),
				'label_off' => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__('Are you want to show brand title', 'bascart'),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-1'
						],
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-2'
						]
					]
				]
			]
		);

		$this->add_control(
			'show_count',
			[
				'label' => esc_html__('Show Porduct Count', 'bascart'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'bascart'),
				'label_off' => esc_html__('Hide', 'bascart'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('Are you want to show product count', 'bascart'),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-1'
						],
						[
							'name' => 'style',
							'operator' => '==',
							'value' => 'style-2'
						]
					]
				]
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Content Alignment', 'bascart' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bascart' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bascart' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bascart' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
                'selectors' => [
					'{{WRAPPER}} .product-brand-wrap' => 'text-align: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();

		// Slider conrtols
        $this->start_controls_section(
			'brand_slider_settings',
			[
				'label'	=> esc_html__( 'Slider Settings', 'bascart' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => ['style' => 'style-3']
			]
		);
		$this->add_control(
			'slider_items',
			[
				'label'         => esc_html__('Slide Items', 'bascart'),
				'type'          => Controls_Manager::NUMBER,
				'default'       => 5,
			]
		);
		$this->add_control(
            'slider_space_between',
            [
                'label'         => esc_html__('Slider Item Space', 'bascart'),
                'description'   => esc_html__('Space between slides', 'bascart'),
                'type'          => \Elementor\Controls_Manager::NUMBER,
                'return_value'  => 'yes',
                'default'       => 30
            ]
        );
        $this->add_control(
            'show_navigation',
            [
                'label'       => esc_html__('Show Navigation', 'bascart'),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'    => esc_html__('Yes', 'bascart'),
                'label_off'   => esc_html__('No', 'bascart'),
                'default'     => 'yes',
            ]
        );
        $this->add_control(
			'left_arrow_icon',
			[
				'label' => esc_html__( 'Left Arrow Icon', 'bascart' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'xts-icon xts-chevron-left',
					'library' => 'solid',
				],
				'condition' => ['show_navigation' => 'yes']
			]
		);
        $this->add_control(
			'right_arrow_icon',
			[
				'label' => esc_html__( 'Right Arrow Icon', 'bascart' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'xts-icon xts-chevron-right',
					'library' => 'solid',
				],
				'condition' => ['show_navigation' => 'yes']
			]
		);
        $this->end_controls_section();

		// STYLE SECTION - BRAND SINGLE ITEM
        $this->start_controls_section(
			'single_brand_item_section',
			[
				'label'	=> esc_html__( 'Brand Item', 'bascart' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_column_gap',
			[
                'label' => esc_html__( 'Column Gap', 'bascart' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
				'default'       => [
                    'unit'  => 'px',
                    'size'  => '0',
                ],
				'selectors' => [
					'{{WRAPPER}} .bascart-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
        );

		$this->add_responsive_control(
			'item_row_gap',
			[
                'label' => esc_html__( 'Row Gap', 'bascart' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
				'default'       => [
                    'unit'  => 'px',
                    'size'  => '0',
                ],
				'selectors' => [
					'{{WRAPPER}} .bascart-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
        );

        $this->start_controls_tabs(
            'brand_item_tabs'
        );

        $this->start_controls_tab(
            'brand_item_normal_tab',
            [
                'label' => __('Normal', 'bascart'),
            ]
        );

        $this->add_control(
			'brand_item_bg',
			[
				'label'	=> esc_html__( 'Background Color', 'bascart' ),
				'type' 	=> \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .product-brand-wrap' => 'background: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'brand_item_hover_tab',
            [
                'label' => __('Hover', 'bascart'),
            ]
        );

        $this->add_control(
			'brand_item_hover_bg',
			[
				'label'	=> esc_html__( 'Background Color', 'bascart' ),
				'type' 	=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-brand-wrap:hover' => 'background: {{VALUE}}',
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default'    => [
                    'top'       => '30',
                    'right'     => '30',
                    'bottom'    => '30',
                    'left'      => '30',
                    'unit'      => 'px',
                    'isLinked'  => true,
                ],
				'selectors' => [
					'{{WRAPPER}} .product-brand-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'brand_item_border',
				'label' => esc_html__( 'Border', 'bascart' ),
				'fields_options' => [
					'border'     => [
						'default' => 'solid',
					],
					'width'     => [
						'default'       => [
							'top'       => '1',
							'right'     => '1',
							'bottom'    => '1',
							'left'      => '1',
							'isLinked'  => false,
						],
					],
					'color'     => [
						'default' => '#E6EBF0'
					]
				],
				'selector' => '{{WRAPPER}} .product-brand-wrap',
				'separator' => 'before',
			]
		);

        $this->end_controls_section();

		// STYLE SECTION - BRAND TITLE
        $this->start_controls_section(
			'title_section',
			[
				'label'	=> esc_html__( 'Title', 'bascart' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => ['show_title' => 'yes']
			]
		);
        
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'bascart' ),
				'selector' => '{{WRAPPER}} .product-brand-title',
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
                        'label' => esc_html__('Font Size (px)', 'bascart'),
                        'size_units' => ['px'],
						'default' => [
							'size' => '18',
							'unit' => 'px'
						]
					],
					'font_weight'    => [
						'default' => '700',
					],
					'text_transform' => [
						'default' => '',
					],
					'line_height'    => [
						'default' => [
							'size' => '20',
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

		$this->start_controls_tabs(
			'title_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => esc_html__('Normal', 'bascart'),
			]
		);

        $this->add_control(
			'title_color',
			[
				'label'	=> esc_html__( 'Title Color', 'bascart' ),
				'type' 	=> Controls_Manager::COLOR,
				'default' => '#101010',
				'selectors' => [
					'{{WRAPPER}} .product-brand-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => esc_html__('Hover', 'bascart'),
			]
		);

        $this->add_control(
			'title_hover_color',
			[
				'label'	=> esc_html__( 'Title Color', 'bascart' ),
				'type' 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-brand-title:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'       => '15',
                    'right'     => '0',
                    'bottom'    => '0',
                    'left'      => '0',
                    'unit'      => 'px',
                    'isLinked'  => false,
                ],
				'selectors' => [
					'{{WRAPPER}} .product-brand-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		// STYLE SECTION - PRODUCT COUNT
        $this->start_controls_section(
			'brand_product_count_section',
			[
				'label'	=> esc_html__( 'Product Count', 'bascart' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
				'condition' => ['show_count' => 'yes'],
			]
		);

		$this->start_controls_tabs(
			'count_color_tabs'
		);

		$this->start_controls_tab(
			'count_color_normal_tab',
			[
				'label' => esc_html__('Normal', 'bascart'),
			]
		);

        $this->add_control(
			'count_color',
			[
				'label' => esc_html__( 'Color', 'bascart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#101010',
				'selectors' => [
					'{{WRAPPER}} .cat-count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'count_color_hover_tab',
			[
				'label' => esc_html__('Hover', 'bascart'),
			]
		);

        $this->add_control(
			'count_hover_color',
			[
				'label' => esc_html__( 'Color', 'bascart' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#E70042',
				'selectors' => [
					'{{WRAPPER}} .cat-count:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .product-brand-wrap:hover .cat-count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'count_typography',
				'label'         => esc_html__('Typography', 'bascart'),
				'selector'      => '{{WRAPPER}} .cat-count',
				'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
                        'label' => esc_html__('Font Size (px)', 'bascart'),
                        'size_units' => ['px'],
						'default' => [
							'size' => '14',
							'unit' => 'px'
						]
					],
					'font_weight'    => [
						'default' => '400',
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
					'line_height'    => [
						'default' => [
							'size' => '20',
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
			'count_margin',
			[
				'label' => esc_html__( 'Margin', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'default'    => [
                    'top'       => '15',
                    'right'     => '0',
                    'bottom'    => '0',
                    'left'      => '0',
                    'unit'      => 'px',
                    'isLinked'  => false,
                ],
				'selectors' => [
					'{{WRAPPER}} .cat-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        // Slider controls start
        $this->start_controls_section(
			'slider_section_style',
			[
				'label' => esc_html__( 'Slider Nav Style', 'bascart' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['show_navigation' => 'yes']
			]
		);
        $this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__( 'width', 'bascart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 200,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
			
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'icon_height',
			[
				'label' => esc_html__( 'Height', 'bascart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' , '%' ],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 200,
					],
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
			
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->start_controls_tabs(
            'navigation_style_tabs'
        );
        
        $this->start_controls_tab(
          'navigation_style_normal_tab',
          [
            'label' => __( 'Normal', 'bascart' ),
          ]
        );
        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'bascart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Icon Background Color', 'bascart' ),
                'default' => '#E4E8F8',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_icon_border',
                'label' => esc_html__('Nagigation Icon Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'label' => esc_html__('Item Border', 'bascart'),
                    ],
                    'width'     => [
                        'label' => esc_html__('Item Border Width', 'bascart'),
                        'default'       => [
                            'isLinked'  => true,
                        ],
                    ],
                    'color'     => [
                        'label' => esc_html__('Item Border Color', 'bascart'),
                        'default' => '#D8D3D3'
                    ]
                ],
                'selector' => '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
          'navigation_style_hover_tab',
          [
            'label' => __( 'Hover', 'bascart' ),
          ]
        );
        $this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Icon Color', 'bascart' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'icon_bg_color_hover',
			[
				'label' => esc_html__( 'Icon Background Color', 'bascart' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#EE4D4D',
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_icon_hover_border',
                'label' => esc_html__('Nagigation Icon Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'label' => esc_html__('Item Border', 'bascart'),
                    ],
                    'width'     => [
                        'label' => esc_html__('Item Border Width', 'bascart'),
                        'default'       => [
                            'isLinked'  => true,
                        ],
                    ],
                    'color'     => [
                        'label' => esc_html__('Item Border Color', 'bascart'),
                        'default' => '#D8D3D3'
                    ]
                ],
                'selector' => '{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'bascart' ),
				'selector' => '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev',
			]
		);
        $this->add_responsive_control(
			'nav_border_radius',
			[
				'label' => esc_html__( 'Nav Border Radius', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();
        ?>
             <div class="bascart-<?php echo esc_attr($this->get_name()); ?>" data-widget_settings='<?php echo json_encode($settings); ?>'>
                <?php $this->render_raw(); ?>
            </div>
        <?php
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();
		if(!empty($settings['ajax_load']) && $settings['ajax_load'] == 'yes'){
			echo '<div class="bascart-loader">'. esc_html__('Loading...', 'bascart') .'<div class="bascart-loader-circle"></div></div>';
            return;
        }
        $tpl = get_widget_template($this->get_name());
        include $tpl;
    }

	public function brand_category(){
        $terms = get_terms(array(
            'taxonomy'    => 'brands_cat',
            'hide_empty'  => false,
            'posts_per_page' => -1,
        ));

        $cat_list = [];
        foreach ($terms as $post) {
            $cat_list[$post->term_id]  = [$post->name];
        }
        return $cat_list;
    }

    protected function content_template() { }
}