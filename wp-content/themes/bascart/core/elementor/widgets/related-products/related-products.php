<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Bascart_related_Products extends Widget_Base {
    use \Bascart\Core\Helpers\Classes\Product_Controls;

    public $base;

    public function get_name() {
        return 'related-products';
    }

    public function get_title() {

        return esc_html__( 'Related Products', 'bascart' );

    }

    public function get_icon() {
        return 'eicon-product-related';
    }

    public function get_categories() {
        return [ 'bascart-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'deal_style',
            [
                'label' => esc_html__('Style', 'bascart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1'  => esc_html__('Style 1', 'bascart'),
                    'style2'  => esc_html__('Style 2', 'bascart'),
                ],
            ]
        );

        $this->product_genreral_controls([
            'defaults'   => [
                'page' => 4,
                'column'    => 'col-md-6 col-lg-3',
                'off'   => ''
            ]
        ]);
        $this->end_controls_section();

        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        /* 
            --------------------------------
            Controls for product style 2
            --------------------------------
        */
        $this->add_control(
			'show_description',
			[
				'label' => esc_html__( 'Show Description', 'bascart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'description_characters',
            [
                'label'         => esc_html__('Description Word Count', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 5,
                'condition' => [
                    'show_description'  => 'yes'
                ]
            ]
        );
        $this->add_control(
            'show_rating',
            [
                'label' => esc_html__('Show Rating', 'bascart'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );
        $this->add_control(
			'show_buttons_on_hover',
			[
				'label' => esc_html__( 'Show Buttons on Footer', 'bascart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_category_list',
			[
				'label' => esc_html__( 'Show Category List', 'bascart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->product_settings_controls();

        $this->add_control(
            'meta_alignment',
            [
                'label' =>esc_html__( 'Meta Alignment', 'bascart' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'row',
                'options' => [
                    'row' =>esc_html__( 'Inine', 'bascart' ),
                    'column' =>esc_html__( 'block', 'bascart' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-progress-meta' => 'flex-direction: {{VALUE}}; align-items: flex-start'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label'         => esc_html__('Enable Carousel?', 'bascart'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'bascart'),
                'label_off'     => esc_html__('No', 'bascart'),
                'return_value'  => 'yes',
                'default'       => ''
            ]
        );

        $this->add_control(
            'slider_space_between',
            [
                'label'         => esc_html__('Slider Item Space', 'bascart'),
                'description'   => esc_html__('Space between slides', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
                'return_value'  => 'yes',
                'default'       => 30,
                'condition' => ['enable_carousel' => 'yes']
            ]
        );

        $this->add_control(
			'left_arrow_icon',
			[
				'label' => esc_html__( 'Left Arrow Icon', 'bascart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'xts-icon xts-chevron-left',
					'library' => 'solid',
				],
                'condition' => ['enable_carousel' => 'yes']
			]
		);
        $this->add_control(
			'right_arrow_icon',
			[
				'label' => esc_html__( 'Right Arrow Icon', 'bascart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'xts-icon xts-chevron-right',
					'library' => 'solid',
				],
                'condition' => ['enable_carousel' => 'yes']
			]
            
		);
        $this->end_controls_section();

        // Widget common style
        $this->product_common_style([
            'wrapper',
            'image',
	        'category',
            'hover',
            'title',
            'price',
            'cart',
            'quicview',
            'comparison',
            'item_style2'
        ]);

        $this->start_controls_section(
            'product_counter_style_section',
            [
                'label' => esc_html__('Product Counter', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_deals!'  => 'yes'
                ]
            ]
        );

        $this->add_control(
            'product_counter_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .product-end-sale-timer' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_counter_bg_color',
            [
                'label'     => esc_html__('Background Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .product-end-sale-timer:not(.counter-position-progressbar) ul' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_counter_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .product-end-sale-timer:not(.counter-position-progressbar) .number, {{WRAPPER}} .product-end-sale-timer',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '500',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '20',
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
                            'size'  => '26',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Line Height (px)', 'bascart'),
                        'size_units' => ['px'] // enable only px
                    ],
                    'letter_spacing' => [
                        'default' => [
                            'size' => '',
                        ],
                    ],
                ],
            )
        );

        $this->add_control(
            'product_counter_text_style_section',
            [
                'label' => esc_html__('Product Counter Text', 'bascart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
            ]
        );

        $this->add_control(
            'product_counter_text_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .product-end-sale-timer .text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
            ]
        );

        $this->add_control(
			'product_counter_text_color_opacity',
			[
				'label' => esc_html__( 'Color Opacity', 'bascart' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .product-end-sale-timer .text' => 'opacity: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_counter_text_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .product-end-sale-timer .text',    
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '11',
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
                            'size'  => '15',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Line Height (px)', 'bascart'),
                        'size_units' => ['px'] // enable only px
                    ],
                    'letter_spacing' => [
                        'default' => [
                            'size' => '',
                        ],
                    ],
                ],
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
            )
        );

        $this->add_control(
            'product_counter_wrap_style_section',
            [
                'label' => esc_html__('Product Counter Wrap', 'bascart' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_counter_border',
                'label' => esc_html__('Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                        'selectors' => [
                            '{{SELECTOR}} .product-end-sale-timer ul' => 'border-style: {{VALUE}};',
                            '{{SELECTOR}} .product-end-sale-timer ul li:not(:last-child)' => 'border-style: {{VALUE}};',
                        ],
                    ],
                    'width'     => [
                        'default'       => [
                            'top'       => '1',
                            'right'     => '1',
                            'bottom'    => '1',
                            'left'      => '1',
                            'isLinked'  => true,
                        ],
                        'selectors' => [
                            '{{SELECTOR}} .product-end-sale-timer ul' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{SELECTOR}} .product-end-sale-timer ul li:not(:last-child)' => 'border-width: 0 {{RIGHT}}{{UNIT}} 0 0;',
                        ],
                    ],
                    'color'     => [
                        'default' => '#F2F2F2',
                        'selectors' => [
                            '{{SELECTOR}} .product-end-sale-timer ul' => 'border-color: {{VALUE}};',
                            '{{SELECTOR}} .product-end-sale-timer ul li:not(:last-child)' => 'border-color: {{VALUE}};',
                        ],
                    ]
                ],
                'separator' => 'before',
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
            ]
        );

        $this->add_responsive_control(
            'product_counter_wrap_padding',
            [
                'label'			=> esc_html__( 'Padding (px)', 'bascart' ),
                'type'			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> [ 'px' ],
                'default'   => [
                    'top' => '10',
                    'right' => '12',
                    'bottom' => '10',
                    'left' => '12',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .product-end-sale-timer ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
                'condition' => [
                    'counter_position!'  => 'progressbar'
                ]
            ]
        );
        $this->end_controls_section();

        // Discount badge control
        $this->start_controls_section(
            'discount_badge',
            [
                'label' => esc_html__('Discount Badge', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'discount_badge_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .shop-loop-thumb .onsale-percentage',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '12',
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
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ]
                ],
                'separator' => 'after',
            )
        );

        $this->start_controls_tabs(
            'discount_badge_tabs'
        );

        $this->start_controls_tab(
            'discount_badge_normal_tab',
            [
                'label' => esc_html__('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'discount_badge_color',
            [
                'label' => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop-loop-thumb .onsale-percentage' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'discount_badge_BGcolor',
            [
                'label' => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop-loop-thumb .onsale-percentage' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_badge_hover_tab',
            [
                'label' => esc_html__('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'discount_badge_hover_color',
            [
                'label' => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop-loop-thumb .onsale-percentage:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'discount_badge_hover_BGcolor',
            [
                'label' => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .shop-loop-thumb .onsale-percentage:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->end_controls_tab();

        $this->add_responsive_control(
            'discount_badge_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .shop-loop-thumb .onsale-percentage' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
			'discount_badge_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .shop-loop-thumb .onsale-percentage' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);        
        $this->end_controls_section();

        $this->start_controls_section(
			'slider_section_style',
			[
				'label' => esc_html__( 'Slider Nav Style', 'bascart' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['enable_carousel' => 'yes']
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
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'bascart' ),
				'selector' => '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev',
			]
		);        
        $this->start_controls_tabs(
            'deal_style_tabs'
        );
        
        $this->start_controls_tab(
          'deal_style_normal_tab',
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
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nagigation_icon_border',
                'label' => esc_html__('Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .swiper-button-next' => 'border-style: {{VALUE}};',
                            '{{WRAPPER}} .swiper-button-prev' => 'border-style: {{VALUE}};',
                        ],
                    ],
                    'width'     => [
                        'default'       => [
                            'top'       => '',
                            'right'     => '',
                            'bottom'    => '',
                            'left'      => '',
                            'isLinked'  => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .swiper-button-next' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .swiper-button-prev' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ],
                    'color'     => [
                        'default' => '#E5E5E5',
                        'selectors' => [
                            '{{WRAPPER}} .swiper-button-next' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .swiper-button-prev' => 'border-color: {{VALUE}};',
                        ],
                    ]
                ]
            ]
        );        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
          'deal_style_hover_tab',
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
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nagigation_icon_border_hover',
                'label' => esc_html__('Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .swiper-button-next:hover' => 'border-style: {{VALUE}};',
                            '{{WRAPPER}} .swiper-button-prev:hover' => 'border-style: {{VALUE}};',
                        ],
                    ],
                    'width'     => [
                        'default'       => [
                            'top'       => '',
                            'right'     => '',
                            'bottom'    => '',
                            'left'      => '',
                            'isLinked'  => true,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .swiper-button-next:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .swiper-button-prev:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ],
                    'color'     => [
                        'default' => '#E5E5E5',
                        'selectors' => [
                            '{{WRAPPER}} .swiper-button-next:hover' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .swiper-button-prev:hover' => 'border-color: {{VALUE}};',
                        ],
                    ]
                ]
            ]
        );   
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
			'nav_border_radius',
			[
				'label' => esc_html__( 'Nav Border Radius', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator' => 'before',
			]
		);
        $this->end_controls_section();
        // end styles
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();
	    $settings['widget_id'] = $this->get_id();
        ?>
            <div class="bascart-<?php echo esc_attr($this->get_name()); ?>"  data-widget_settings='<?php echo json_encode($settings); ?>'>
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
        if(file_exists($tpl)){
            include $tpl;
        }
    }
    protected function content_template() { }
}