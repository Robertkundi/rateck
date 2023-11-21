<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;
use \ElementsKit_Lite\Modules\Controls\Widget_Area_Utils as Widget_Area_Utils;

if ( ! defined( 'ABSPATH' ) ) exit;


class Bascart_Offer_Slider extends Widget_Base {


  public $base;

    public function get_name() {
        return 'offer-slider';
    }

    public function get_title() {

        return esc_html__( 'Offer Slider', 'bascart' );

    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'bascart-elements' ];
    }

	protected function register_controls(){
		$this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$repeater = new Repeater();

		$repeater->add_control(
            'offer_title', [
                'label' => esc_html__('Offer Title', 'bascart'),
                'type' => Controls_Manager::TEXT,
				'default' => 'Offer Title',
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'offer_amount', [
                'label' => esc_html__('Offer Amount', 'bascart'),
                'type' => Controls_Manager::TEXT,
				'default' => 'Offer Amount',
                'label_block' => true,
            ]
        );

		$repeater->add_control(
            'offer_image', [
                'label' => esc_html__('Offer Image', 'bascart'),
                'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );

		$repeater->add_control(
			'offer_link',
			[
				'label' => __( 'Link', 'bascart' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'bascart' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'offer_items',
			[
				'label' => __( 'Items', 'bascart' ),
				'type' => Controls_Manager::REPEATER,
				'default'=> [
					[
						'text' => __( 'Offer Item', 'bascart' ),
					]
				],
				'fields' => $repeater->get_controls(),

			]
		);

		$this->add_control(
            'slider_item',
            [
                'label'         => esc_html__('Slide Items', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 2,
            ]
        );

		$this->add_control(
            'slider_autoplay',
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
            'slider_autoplay_delay',
            [
                'label' => esc_html__( 'Autoplay Delay', 'bascart' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1500,
                'condition' =>["slider_autoplay"=>["yes"] ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_section_style',
			[
				'label' => esc_html__( 'Offer Slider Style', 'bascart' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'offer_color',
			[
				'label' => esc_html__( 'Offer Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .offer-content .offer' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'offer_typography',
				'label' => esc_html__( 'Typography', 'bascart' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .offer-content .offer',
			]
		);

		$this->add_responsive_control(
			'offer_margin',
			[
				'label' => esc_html__( 'Margin', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .offer-content .offer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'offer_padding',
			[
				'label' => esc_html__( 'Padding', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .offer-content .offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'offer_amount_color',
			[
				'label' => esc_html__( 'Offer Amount Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .offer-content .offer-amount' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'offer_amount_typography',
				'label' => esc_html__( 'Typography', 'bascart' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .offer-content .offer-amount',
			]
		);

		$this->add_responsive_control(
			'offer_amount_margin',
			[
				'label' => esc_html__( 'Margin', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .offer-content .offer-amount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'offer_amount_padding',
			[
				'label' => esc_html__( 'Padding', 'bascart' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .offer-content .offer-amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				],
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
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'bascart' ),
				'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
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
					'{{WRAPPER}} {{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_nav_style',
			[
				'label' => esc_html__( 'Slider Nav Style', 'bascart' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nav_bg',
			[
				'label' => esc_html__( 'Arrow Background Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .offer-slider .swiper-button-next , {{WRAPPER}} .offer-slider .swiper-button-prev' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav_icon_color',
			[
				'label' => esc_html__( 'Arrow Color', 'bascart' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .offer-slider .swiper-button-next , {{WRAPPER}} .offer-slider .swiper-button-prev' => 'color: {{VALUE}}',
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


		$this->end_controls_section();
	}

    protected function render( ) {
        $settings = $this->get_settings_for_display();
        ?>
            <div class="bascart-<?php echo esc_attr($this->get_name()); ?>"  data-widget_settings='<?php echo json_encode($settings); ?>'>
                <?php $this->render_raw(); ?>
            </div>
        <?php
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();
		$slider_items = $settings['offer_items'];

        $tpl = get_widget_template($this->get_name());
        if(file_exists($tpl)){
            include $tpl;
        }
    }
    protected function content_template() { }
}