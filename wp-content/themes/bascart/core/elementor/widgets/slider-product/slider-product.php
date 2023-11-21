<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (!defined('ABSPATH')) exit;

class Bascart_Slider_Product extends Widget_Base
{
    use \Bascart\Core\Helpers\Classes\Product_Controls;

    public $base;

    public function get_name()
    {
        return 'slider-product';
    }

    public function get_title()
    {

        return esc_html__('Product Block', 'bascart');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['bascart-elements'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'products_per_page',
            [
                'label' => esc_html__('Products Per Page', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'default'   => (isset($default['page']) ? esc_attr($default['page']) : 1),
            ]
        );

        $this->add_control(
            'divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'product_by',
            [
                'label' => esc_html__('Show product by', 'bascart'),
                'type'  =>  Controls_Manager::SELECT2,
                'options'   => [
                    'category' => esc_html__('Category', 'bascart'),
                    'product' => esc_html__('Product', 'bascart')
                ],
                'default'   => 'category',
                'seperator' => 'before'
            ]
        );

        $this->add_control(
            'term_list',
            [
                'label' => esc_html__('Select Categories', 'bascart'),
                'type' => ElementsKit_Controls_Manager::AJAXSELECT2,
                'options'   => 'ajaxselect2/product_cat',
                'multiple' => true,
                'label_block' => true,
                'condition'    => [
                    'product_by'    => 'category'
                ]
            ]
        );

        $this->add_control(
            'product_list',
            [
                'label' => esc_html__('Select Products', 'bascart'),
                'type' => ElementsKit_Controls_Manager::AJAXSELECT2,
                'options'   => 'ajaxselect2/product_list',
                'multiple' => true,
                'label_block' => true,
                'condition'    => [
                    'product_by'    => 'product'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_character',
            [
                'label'         => esc_html__('Words to show', 'bascart'),
                'description'   => esc_html__('Words to show in the product title', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
                'return_value'  => 'yes',
                'default'       => 30,
            ]
        );
        
		$this->add_control(
			'show_add_to_cart_button',
			[
				'label' => __( 'Show Add To Cart Button', 'bascart' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'bascart' ),
				'label_off' => __( 'Hide', 'bascart' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'hide_sell_off_tag',
            [
                'label'         => esc_html__('Hide Sell Off', 'bascart'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Hide', 'bascart'),
                'label_off'     => esc_html__('Show', 'bascart'),
                'return_value'  => 'yes',
                'default'       => (isset($default['show_sell_off_tag']) ? esc_attr($default['show_sell_off_tag']) : 'yes'),
                'selectors'        => [
                    '{{WRAPPER}} .onsale-off' => 'display: none;'
                ]
            ]
        );

        $this->add_control(
            'hide_original_price',
            [
                'label'         => esc_html__('Hide Original Price', 'bascart'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Hide', 'bascart'),
                'label_off'     => esc_html__('Show', 'bascart'),
                'return_value'  => 'yes',
                'default'       => (isset($default['hide_original_price']) ? esc_attr($default['hide_original_price']) : 'yes'),
                'selectors'        => [
                    '{{WRAPPER}} .product-price del' => 'display: none;'
                ]
            ]
        );

        $this->end_controls_section();
        // Product Title styles
        $this->start_controls_section(
            'product_title_style_section',
            [
                'label' => esc_html__('Product Title', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'product_title_color_tabs'
        );

        $this->start_controls_tab(
            'product_title_color_normal_tab',
            [
                'label' => __('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .product-title a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_title_color_hover_tab',
            [
                'label' => __('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'product_title_hover_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .product-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_title_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .product-title',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '800',
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
                            'size'  => '22',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ]
                ]
            )
        );

        $this->add_responsive_control(
            'product_title_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        // Product price styles
        $this->start_controls_section(
            'product_price_style_section',
            [
                'label' => esc_html__('Product Price', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'product_price_price_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'product_price_sale_price_color',
            [
                'label' => esc_html__('Sale Color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .product-price del .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_price_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .woocommerce-Price-amount.amount',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '700',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '18',
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
                        'size_units' => ['px'] // enable only px
                    ]
                ]
            )
        );

        $this->add_control(
            'product_price_discount_badge_style_section',
            [
                'label' => esc_html__('Price Discount Badge', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'hide_off'  => ''
                ]
            ]
        );

        $this->add_control(
            'product_price_discount_badge_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .product-price .onsale-off' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'hide_off'  => ''
                ]
            ]
        );

        $this->add_control(
            'product_price_discount_badge_bg_color',
            [
                'label'     => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F54F29',
                'selectors' => [
                    '{{WRAPPER}} .product-price .onsale-off' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'hide_off'  => ''
                ]
            ]
        );

        $this->add_control(
            'price_divider',
            [
                'type' => Controls_Manager::DIVIDER,
                'condition' => [
                    'hide_off!'  => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_price_original_badge_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .slider-product-item del .woocommerce-Price-amount.amount',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                        'label'   => esc_html__('Typography for original price', 'bascart'),
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
                            'size'  => '24',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ]
                ]
            )
        );

        $this->add_responsive_control(
            'product_price_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->end_controls_section();

        // Add to cart button style
        $this->start_controls_section(
            'product_add_to_cart_button_style',
            [
                'label' => esc_html__('Add to Cart Button', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_add_to_cart_button_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .button',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '800',
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
                        'default'   => 'uppercase',
                    ],
                    'line_height'   => [
                        'default'   => [
                            'size'  => '15',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ],
                    'letter_spacing' => [
                        'default' => [
                            'size' => '0.5',
                        ],
                    ],
                ],
            )
        );

        // Color Tab start
        $this->start_controls_tabs(
            'product_add_to_cart_button_tabs'
        );
        $this->start_controls_tab(
            'product_add_to_cart_button_normal_tab',
            [
                'label' => __('Normal', 'bascart')
            ]
        );
        $this->add_control(
            'product_add_to_cart_button_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .button'   => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'product_add_to_cart_button_bg_color',
            [
                'label'     => esc_html__('BG Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .button'   => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_add_to_cart_button_hover_tab',
            [
                'label' => __('Hover', 'bascart')
            ]
        );
        
        $this->add_control(
            'product_add_to_cart_button_hover_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .button:hover'   => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_hover_bg_color',
            [
                'label'     => esc_html__('Hover BG Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .button:hover'   => 'background-color: {{VALUE}}'
                ]
            ]
        );
        $this->end_controls_tab();
        $this-> end_controls_tabs();
        // Color tab end

        $this->add_responsive_control(
            'product_add_to_cart_button_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'     => [
                    '{{WRAPPER}} .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'product_add_to_cart_button_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'separator',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
        // Border tab start
        $this->start_controls_tabs(
            'product_add_to_cart_button_border_tabs'
        );
        $this->start_controls_tab(
            'product_add_to_cart_button_border_tab',
            [
                'label' => __('Normal', 'bascart')
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_add_to_cart_button_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .button',
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'product_add_to_cart_button_border_tab_hover',
            [
                'label' => __('Hover', 'bascart')
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_add_to_cart_button_border_hover',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .button:hover',
            ]
        );
        $this->end_controls_tab();
        $this-> end_controls_tabs();   
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
        $tpl = get_widget_template($this->get_name());
        if (file_exists($tpl)) {
            include $tpl;
        }
    }
    protected function content_template()
    {
    }
}
