<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;
use \ElementsKit_Lite\Modules\Controls\Widget_Area_Utils as Widget_Area_Utils;


if ( ! defined( 'ABSPATH' ) ) exit; 


class Bascart_Advanced_Slider extends Widget_Base {


  public $base;

    public function get_name() {
        return 'advanced-slider';
    }

    public function get_title() {
        return esc_html__( 'Advanced Slider', 'bascart' );
    }

    public function get_icon() {
        return 'fas fa-layer-group';
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
        $repeater = new Repeater();
        $repeater->add_control(
            'title', [
                'label' => esc_html__('Title', 'bascart'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'tab_content', [
                'label' => esc_html__('Content', 'bascart'),
                'type' => ElementsKit_Controls_Manager::WIDGETAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab_items',
            [
                'label' => esc_html__('Tab content', 'bascart'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'title_field' => '{{ title }}',
                'default' => [
                    [
                        'title' => esc_html__('Slide One', 'bascart'),
                    ],
                    [
                        'title' => esc_html__('Slide Two', 'bascart'),
                    ],
                ],
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_nav',
            [
                'label' => esc_html__('Slider Nav Controls', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'effect_style',
			[
				'label' => esc_html__( 'Slider Effect Style', 'bascart' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'default'  => esc_html__( 'Default', 'bascart' ),
					'fade'  => esc_html__( 'fade', 'bascart' ),
					'cube' => esc_html__( 'cube', 'bascart' ),
					'flip' => esc_html__( 'flip', 'bascart' ),
					'coverflow' => esc_html__( 'coverflow', 'bascart' ),
				],
			]
		);

        $this->add_control(
			'show_pagination',
			[
				'label' => esc_html__( 'Show Pagination Controls', 'bascart' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'show_nav_controls',
			[
				'label' => esc_html__( 'Show Nav Controls', 'bascart' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart' ),
				'label_off' => esc_html__( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
                'condition' => ['show_nav_controls' => 'yes']
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
                'condition' => ['show_nav_controls' => 'yes']
			]
            
		);

		$this->add_control(
            'ts_slider_loop',
            [
                'label' => esc_html__( 'Loop', 'bascart' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bascart' ),
                'label_off' => esc_html__( 'No', 'bascart' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

		$this->add_control(
            'ts_slider_speed',
            [
                'label' => esc_html__( 'Slider speed', 'bascart' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1500,
            ]
        );

        $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'bascart' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
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
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1500,
                'condition' =>["ts_slider_autoplay"=>["yes"] ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'slider_section_style',
			[
				'label' => esc_html__( 'Slider Nav Style', 'bascart' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
 

        $this->add_responsive_control(
			'icon_width',
			[
				'label' => __( 'width', 'bascart' ),
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
				'label' => __( 'Height', 'bascart' ),
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
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'bascart' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev',
			]
		);
		$this->start_controls_tabs(
			'nav_style_tabs'
		);
		
		$this->start_controls_tab(
		  'data_style_normal_tab',
		  [
			'label' => __( 'Normal', 'bascart' ),
		  ]
		);
        $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Icon Background Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nagigation_icon_border',
                'label' => esc_html__('Icon Border', 'bascart'),
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
		  'nav_style_hover_tab',
		  [
			'label' => __( 'Hover', 'bascart' ),
		  ]
		);
		
        $this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_hover_bg_color',
			[
				'label' => esc_html__( 'Icon Hover Background Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nagigation_icon_hover_border',
                'label' => esc_html__('Icon Hover Border', 'bascart'),
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
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
			'slider_pagination_section',
			[
				'label' => esc_html__( 'Slider Pagination Style', 'bascart' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'pagination_bg_color',
			[
				'label' => esc_html__( 'Pagination Background Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'pagination_width',
			[
				'label' => __( 'width', 'bascart' ),
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
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'pagination_height',
			[
				'label' => __( 'Height', 'bascart' ),
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
					'{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'pagination_align',
			[
				'label' => esc_html__( 'Pagination Alignment', 'bascart' ),
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
					'{{WRAPPER}} .swiper-pagination' => 'text-align: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'bottom_to_top',
			[
				'label' => __( 'Bottom To Top', 'bascart' ),
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
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'pagination_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();
		$settings['widget_id'] = $this->get_id();

        ?>
            <div class="bascart-<?php echo esc_attr($this->get_name()); ?>" data-widget_settings='<?php echo json_encode($settings); ?>'>
                <?php $this->render_raw(); ?>
            </div>
        <?php
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();
		$settings['widget_id'] = $this->get_id();
		
        $tpl = get_widget_template($this->get_name());
        if(file_exists($tpl)){
            include $tpl;
        }
    }
    protected function content_template() { }
}