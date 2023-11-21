<?php
namespace Elementor;

if (!defined('ABSPATH')) exit;

class Bascart_Category_Slider extends Widget_Base
{

    public $base;

    public function get_name()
    {
        return 'category-slider';
    }

    public function get_title()
    {
        return esc_html__('Category Slider', 'bascart');
    }

    public function get_icon()
    {
        return 'eicon-posts-carousel';
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
                'label' => esc_html__('Category Slider', 'bascart')
            ]
        );
        $this->add_control(
            'slider_style',
            [
                'label' => esc_html__('Slider Type', 'bascart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slider-image-style',
                'options' => [
                    'slider-image-style'  => esc_html__('Image Slider', 'bascart'),
                    'slider-icon-style'  => esc_html__('Icon Slider', 'bascart'),
                    'slider-title-top'  => esc_html__('Title Top Slider', 'bascart'),
                ]
            ]
        );
		$this->add_control(
			'show_product_count',
			[
				'label' => esc_html__( 'Show Product Count', 'bascart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'slider_style'  => 'slider-icon-style'
                ]
			]
		);
        $this->add_control(
            'slider_items',
            [
                'label'         => esc_html__('Slide Items', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 2
            ]
        );
        $this->add_control(
            'post_per_page',
            [
                'label'         => esc_html__('Total Slide Count', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 12
            ]
        );
        $this->add_control(
            'ts_slider_loop',
            [
                'label' => esc_html__( 'Loop', 'bascart' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bascart' ),
                'label_off' => esc_html__( 'No', 'bascart' ),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'ts_slider_speed',
            [
                'label' => esc_html__( 'Slider speed', 'bascart' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1500
            ]
        );
        $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'bascart' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bascart' ),
                'label_off' => esc_html__( 'No', 'bascart' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );
        $this->add_control(
            'ts_slider_autoplay_delay',
            [
                'label' => esc_html__( 'Autoplay Delay', 'bascart' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1500,
                'condition' =>["ts_slider_autoplay"=>["yes"] ]
            ]
        );
        $this->add_control(
            'show_title_icon',
            [
                'label'       => esc_html__('Show Title Icon', 'bascart'),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'    => esc_html__('Yes', 'bascart'),
                'label_off'   => esc_html__('No', 'bascart'),
                'default'     => 'yes',
                'condition' => [
                    'slider_style'  => 'slider-image-style'
                ]
            ]
        );
        $this->add_control(
            'title_position',
            [
                'label'       => esc_html__('Title Position', 'bascart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'title_on_top',
                'options' => [
                    'title_on_top'  => esc_html__('On Image', 'bascart'),
                    'title_bellow_image'  => esc_html__('Bellow Image', 'bascart'),
                ],
                'condition' => [
                    'slider_style'  => 'slider-image-style'
                ]
            ]
        );
        $this->add_control(
            'post_cats',
            [
                'label' => esc_html__('Select Categories', 'bascart'),
                'type'      => Controls_Manager::SELECT2,
                'options'   => $this->post_category(),
                'label_block' => true,
                'multiple'  => true
            ]
        );
        $this->add_control(
			'image_hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'bascart' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'enable-hover-animation',
                'options' => [
                    'enable-hover-animation'  => esc_html__('Enable Animation', 'bascart'),
                    'disable-hover-animation'  => esc_html__('Disable Animation', 'bascart')
                ]
            ]
		);
        $this->end_controls_section();
        // Category slider button text and icon panel.
        $this->start_controls_section(
            'button_text_and_icon',
            [
                'label' => esc_html__('Button Settings', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['slider_style' => 'slider-title-top']
            ]
        );
        $this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Button Text', 'bascart' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Shop Now', 'bascart' )
			]
		);
        $this->add_control(
            'show_button_icon',
            [
                'label'       => esc_html__('Show Button Icon', 'bascart'),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'    => esc_html__('Yes', 'bascart'),
                'label_off'   => esc_html__('No', 'bascart'),
                'default'     => 'yes'
            ]
        );
        $this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Button Icon', 'bascart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'xts-icon xts-arrow-right',
					'library' => 'icon-bascart'
				]
			]
		);
        $this->end_controls_section();
        // Navigation styles
        $this->start_controls_section(
            'slider_nav',
            [
                'label' => esc_html__('Slider Controls', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'slider_space_between',
            [
                'label'         => esc_html__('Slider Item Space', 'bascart'),
                'description'   => esc_html__('Space between slides', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
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
                'default'     => 'yes'
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
                'condition' => ['show_navigation' => 'yes']
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
                'condition' => ['show_navigation' => 'yes']
			]
		);
        $this->end_controls_section();

        // Category slider style controler
        $this->start_controls_section(
            'bascart_style_block_section',
            [
                'label' => esc_html__('Slider Elements Style', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_settings',
            [
                'label' => __('Title Style', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs(
            'title_style_tabs'
        );
        $this->start_controls_tab(
          'title_style_normal_tab',
          [
            'label' => __( 'Normal', 'bascart' ),
          ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .bascart-category-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bascart-category-title  a' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_color',
				'label' => __( 'Title Background', 'bascart' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .bascart-category-title',
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab(
          'title_style_hover_tab',
          [
            'label' => __( 'Hover', 'bascart' ),
          ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Title hover color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .bascart-category-title:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bascart-category-title a:hover' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_hover_bg_color',
				'label' => __( 'Title Hover Background', 'bascart' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .bascart-category-title:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'title_text_align',
            [
                'label' => __('Title Alignment', 'bascart'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bascart'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bascart'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bascart'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .bascart-category-title' => 'text-align:{{VALUE}};',
                    '{{WRAPPER}} .bascart-category-title' => 'text-align:{{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography',
                'label' => esc_html__('Title Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .bascart-category-title',
                'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
                        'label' => esc_html__('Font Size (px)', 'bascart'),
                        'size_units' => ['px'],
						'default' => [
							'size' => '17',
							'unit' => 'px'
						]
					],
					'font_weight'    => [
						'default' => '700',
					],
					'text_transform' => [
						'default' => 'capitalize',
					],
					'line_height'    => [
						'default' => [
							'size' => '24',
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
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'default'   => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .bascart-category-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'default'   => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .bascart-category-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        // Description styles
        $this->add_control(
            'description_settings',
            [
                'label' => __('Description Settings', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .category-description' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .category-description',
                'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
                        'label' => esc_html__('Font Size (px)', 'bascart'),
                        'size_units' => ['px'],
						'default' => [
							'size' => '16',
							'unit' => 'px'
						]
					],
					'font_weight'    => [
						'default' => '400',
					],
					'line_height'    => [
						'default' => [
							'size' => '24',
							'unit' => 'px'
						]
					]
				]
            ]
        );
        $this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__('Description Margin', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'default'   => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .category-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        // Buttons Style
        $this->add_control(
            'button_settings',
            [
                'label' => __('Button Settings', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );
        
        $this->start_controls_tab(
          'button_style_normal_tab',
          [
            'label' => __( 'Normal', 'bascart' ),
          ]
        );
        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Text color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '#181B2B',
                'selectors' => [
                    '{{WRAPPER}} .category-button' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => esc_html__( 'Background', 'bascart' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .category-button',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Button Border', 'bascart'),
                'selector' => '{{WRAPPER}} .category-button'
            ]
        );
        $this->end_controls_tab();
        
        $this->start_controls_tab(
          'button_style_hover_tab',
          [
            'label' => __( 'Hover', 'bascart' )
          ]
        );
        
        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Text Color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '#769881',
                'selectors' => [
                    '{{WRAPPER}} .category-button:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_bg_color',
				'label' => esc_html__( 'Background', 'bascart' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .category-button:hover',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'label' => esc_html__('Button Border', 'bascart'),
                'selector' => '{{WRAPPER}} .category-button:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'category_button_typography',
                'label' => esc_html__('Button Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .category-button',
                'fields_options' => [
					'typography'     => [
						'default' => 'custom',
					],
					'font_size'      => [
                        'label' => esc_html__('Font Size (px)', 'bascart'),
                        'size_units' => ['px'],
						'default' => [
							'size' => '15',
							'unit' => 'px'
						]
					],
					'font_weight'    => [
						'default' => '500',
					],
					'line_height'    => [
						'default' => [
							'size' => '16',
							'unit' => 'px'
						]
					]
				]
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label'            => esc_html__('Button Margin', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .category-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label'            => esc_html__('Button Padding', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .category-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'button_icon_margin',
            [
                'label'            => esc_html__('Icon Margin', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        // Image styles
        $this->add_control(
            'image_settings',
            [
                'label' => __('Image Style', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__('Image Border', 'bascart'),
                'selector' => '{{WRAPPER}} .bascart-category-slider img'
            ]
        );
        $this->add_responsive_control(
			'image_border_radius',
			[
				'label'       => esc_html__('Border Radius', 'bascart'),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'       => '0',
					'right'     => '0',
					'bottom'    => '0',
					'left'      => '0',
					'unit'      => 'px',
					'isLinked'  => true,
				],
				'selectors'     => [
					'{{WRAPPER}} .bascart-category-slider img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
        $this->add_control(
            'title_icon_settings',
            [
                'label' => __('Title Icon Style', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
			'title_icon_width',
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
					'{{WRAPPER}} .bascart-category-title i' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'title_icon_height',
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
					'{{WRAPPER}} .bascart-category-title i' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_icon_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .bascart-category-title i',
                'exclude'       => ['font_family', 'text_transform', 'font_style', 'text_decoration', 'letter_spacing'],
                'fields_options'    => [
                    'font_weight'   => [
                        'default'   => '700',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '16',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px']
                    ],
                    'line_height'   => [
                        'default'   => [
                            'size'  => '24',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px']
                    ]
                ],
            )
        );
        $this->start_controls_tabs(
            'title_icon_style_tabs'
        );
        $this->start_controls_tab(
          'title_icon_style_normal_tab',
          [
            'label' => __( 'Normal', 'bascart' )
          ]
        );
        $this->add_control(
            'title_icon_color',
            [
                'label' => esc_html__('Title icon color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .bascart-category-title i' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
			'title_icon_bg_color',
			[
				'label'	=> esc_html__('Background Color', 'bascart'),
				'type' 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bascart-category-title i' => 'background: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        
        $this->start_controls_tab(
          'title_icon_style_hover_tab',
          [
            'label' => __( 'Hover', 'bascart' ),
          ]
        );
        $this->add_control(
            'title_icon_hover_color',
            [
                'label' => esc_html__('Title icon color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .bascart-category-title:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
			'title_icon_hover_bg_color',
			[
				'label'	=> esc_html__('Background Color', 'bascart'),
				'type' 	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bascart-category-title:hover i' => 'background: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Category Icon slider style
        $this->start_controls_section(
			'icon_slider_style',
			[
				'label' => esc_html__( 'Icon Slider Style', 'bascart' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>["slider_style"=>["slider-icon-style"] ],
			]
		);
        $this->add_responsive_control(
            'icon_slide_content_alignment',
            [
                'label' => __('Alignment', 'bascart'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bascart'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bascart'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bascart'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .category-slider-icon, {{WRAPPER}} .item-counter, {{WRAPPER}} .bascart-category-title' => 'text-align:{{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'slider_item_padding',
            [
                'label'            => esc_html__('Item Padding', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .slider-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
			'slider_item_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slider-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->start_controls_tabs(
            'icon_slider_style_tabs'
        );
        
        $this->start_controls_tab(
          'icon_slider_normal_tab',
          [
            'label' => __( 'Normal', 'bascart' )
          ]
        );
        $this->add_control(
            'slider_item_background_color',
            [
                'label' => esc_html__('Item Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-item' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'slide_icon_color',
            [
                'label' => esc_html__('Icon Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-slider-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_color',
            [
                'label' => esc_html__('Counter Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-counter' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_product_count'  => 'yes'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slider_item_border',
                'label' => esc_html__('Item Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                        'label' => esc_html__('Item Border', 'bascart'),
                    ],
                    'width'     => [
                        'label' => esc_html__('Item Border Width', 'bascart'),
                        'default'       => [
                            'top'       => '1',
                            'right'     => '1',
                            'bottom'    => '1',
                            'left'      => '1',
                            'isLinked'  => false,
                        ],
                    ],
                    'color'     => [
                        'label' => esc_html__('Item Border Color', 'bascart'),
                        'default' => '#EAEAEA'
                    ]
                ],
                'selector' => '{{WRAPPER}} .slider-item'
            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab(
          'icon_slider_hover_tab',
          [
            'label' => __( 'Hover', 'bascart' ),
          ]
        );
        $this->add_control(
            'slider_item_hover_background_color',
            [
                'label' => esc_html__('Item Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-item:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'slide_icon_hover_color',
            [
                'label' => esc_html__('Icon Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-icon-style:hover .category-slider-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'counter_hover_color',
            [
                'label' => esc_html__('Counter Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-icon-style:hover .item-counter' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_product_count'  => 'yes'
                ]
            ]
        );
        $this->add_control(
            'item_hoverr_title_color',
            [
                'label' => esc_html__('Title Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-icon-style:hover .bascart-category-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'slider_item_border_hover',
                'label' => esc_html__('Item Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                        'label' => esc_html__('Item Border', 'bascart'),
                    ],
                    'width'     => [
                        'label' => esc_html__('Item Border Width', 'bascart'),
                        'default'       => [
                            'top'       => '1',
                            'right'     => '1',
                            'bottom'    => '1',
                            'left'      => '1',
                            'isLinked'  => false,
                        ],
                    ],
                    'color'     => [
                        'label' => esc_html__('Item Border Color', 'bascart'),
                        'default' => '#EAEAEA'
                    ]
                ],
                'selector' => '{{WRAPPER}} .slider-item:hover'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->add_control(
			'icon_styling_section',
			[
				'label' => __( 'Icon Styles', 'bascart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'slider_icon_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .category-slider-icon',
                'exclude'       => ['font_family', 'text_transform', 'font_style', 'text_decoration', 'letter_spacing'],
                'fields_options'    => [
                    'font_weight'   => [
                        'default'   => '700',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '16',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px']
                    ],
                    'line_height'   => [
                        'default'   => [
                            'size'  => '24',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px']
                    ]
                ]
            )
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label'            => esc_html__('Icon Margin', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .category-slider-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
		$this->add_control(
			'counter_styling_section',
			[
				'label' => __( 'Counter Styles', 'bascart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                    'show_product_count'  => 'yes'
                ]
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'counter_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .item-counter',
                'condition' => [
                    'show_product_count'  => 'yes'
                ],
                'fields_options'    => [
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '16',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px']
                    ],
                    'line_height'   => [
                        'default'   => [
                            'size'  => '24',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px']
                    ]
                ]
            )
        );
        $this->add_control(
			'slide_item_bottom_indecator',
			[
				'label' => esc_html__( 'Show Bottom Indecator', 'bascart' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'show',
				'default' => 'hide',
                'condition' => [
                    'slider_style'  => 'slider-icon-style'
                ]
			]
		);
        $this->add_control(
            'slide_item_indecator_color',
            [
                'label' => esc_html__('Indecator Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-bottom-indecator-show::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'slide_item_bottom_indecator'  => 'show'
                ]
            ]
        );
        $this->add_control(
            'slide_item_indecator_height',
            [
                'label' => esc_html__('Indecator Height', 'bascart'),
                'type'      => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 100
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'selectors' => [
					'{{WRAPPER}} .item-bottom-indecator-show::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slide_item_bottom_indecator'  => 'show'
                ]
            ]
        );
        $this->end_controls_section();
        // Category Icon slider style end

        // Title top items style
        $this->start_controls_section(
			'title_top_style',
			[
				'label' => esc_html__( 'Slide Item Style', 'bascart' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['slider_style' => 'slider-title-top']
			]
		);
        $this->add_responsive_control(
			'slide_item_padding',
			[
				'label' => esc_html__('Slide Item Padding', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
                'default'   => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .slider-title-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->add_responsive_control(
			'slide_item_border_radius',
			[
				'label' => esc_html__( 'Item Border Radius', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .slider-title-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
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
				]
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

    protected function render(){
        $settings = $this->get_settings_for_display();
        $settings['widget_id'] = $this->get_id();
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
        if (file_exists($tpl)) {
            include $tpl;
        }
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

    protected function content_template() {}
}
