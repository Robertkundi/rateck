<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (!defined('ABSPATH')) exit;


class Bascart_Filterable_Product_List extends Widget_Base
{

    use \Bascart\Core\Helpers\Classes\Product_Controls;

    public $base;

    public function get_name()
    {
        return 'filterable-product-list';
    }

    public function get_title()
    {

        return esc_html__('Filterable Product List', 'bascart');
    }

    public function get_icon()
    {
        return 'eicon-product-tabs';
    }

    public function get_categories()
    {
        return ['bascart-elements'];
    }

    private function slugify($text)
    {
        if (empty($text)) {
            return '';
        }
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
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
            'tab_style',
            [
                'label' => esc_html__('Tab style', 'bascart'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1'  => esc_html__('Style 1', 'bascart'),
                    'style2'  => esc_html__('Style 2', 'bascart'),
                ],
            ]
        );

        $this->product_genreral_controls([
            'defaults'  => [
                'column'    => 'col-md-6 col-lg-3'
            ]
        ]);

        $repeater = new Repeater();

        $repeater->add_control(
            'filter_label',
            [
                'label' => esc_html__('Filter Label', 'bascart'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'product_list',
            [
                'label' => esc_html__('Select Products', 'bascart'),
                'label_block' => true,
                'type' => ElementsKit_Controls_Manager::AJAXSELECT2,
                'options'   => 'ajaxselect2/product_list',
                'multiple' => true
            ]
        );

        $this->add_control(
            'filter_content',
            [
                'label' => esc_html__('Filter Content', 'bascart'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'after',
                'fields' => $repeater->get_controls()
            ]
        );

        $this->end_controls_section();

        // styles

        // Product Filter Nav
        $this->start_controls_section(
            'product_filter_nav_style_section',
            [
                'label' => esc_html__('Product Filter Nav', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'product_filter_nav_alignment',
            [
                'label'        => esc_html__('Alignment', 'bascart'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'description' => esc_html__('Left', 'bascart'),
                        'icon'        => 'fa fa-align-left',
                    ],
                    'center' => [
                        'description' => esc_html__('Center', 'bascart'),
                        'icon'        => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'description' => esc_html__('Right', 'bascart'),
                        'icon'        => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .filter-nav' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_filter_nav_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .filter-nav a',
                'exclude'       => ['font_family'],
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_family'    => [
                        'default' => 'Spartan',
                    ],
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
                ],
            )
        );

        $this->start_controls_tabs(
            'product_filter_nav_tabs'
        );

        $this->start_controls_tab(
            'product_filter_nav_normal_tab',
            [
                'label' => esc_html__('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'product_filter_nav_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_filter_nav_item_background',
            [
                'label'     => esc_html__('Background Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a' => 'background: {{VALUE}}',
                ],
            ]
        );        

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_filter_nav_hover_tab',
            [
                'label' => esc_html__('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'product_filter_nav_hover_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a:hover'   => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'product_filter_nav_item_hover_background',
            [
                'label'     => esc_html__('Background Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a:hover' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'product_filter_nav_active_tab',
            [
                'label' => esc_html__('Active', 'bascart'),
            ]
        );
        $this->add_control(
            'product_filter_nav_active_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a.active'  => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'product_filter_nav_item_active_background',
            [
                'label'     => esc_html__('Background Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .filter-nav a.active' => 'background: {{VALUE}}',
                ],
            ]
        );        
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'product_filter_nav_item_padding',
            [
                'label'            => esc_html__('Item Padding', 'bascart'),
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
                    '{{WRAPPER}} .filter-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    // '{{WRAPPER}} .filter-nav li:first-child a' => 'padding-left: 0;',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'product_filter_nav_item_border_radius',
            [
                'label'            => esc_html__('Item Border Radius', 'bascart'),
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
                    '{{WRAPPER}} .filter-nav li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_filter_nav_item_indicator_border',
                'label' => esc_html__('Bottom Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                        'label' => esc_html__('Item Indicator Border', 'bascart'),
                    ],
                    'width'     => [
                        'label' => esc_html__('Item Indicator Border Width', 'bascart'),
                        'allowed_dimensions'    =>  ['bottom'],
                        'default'       => [
                            'top'       => '0',
                            'right'     => '0',
                            'bottom'    => '4',
                            'left'      => '0',
                            'isLinked'  => false,
                        ],
                    ],
                    'color'     => [
                        'label' => esc_html__('Item Indicator Border Color', 'bascart'),
                        'default' => '#A352FF'
                    ]
                ],
                'selector' => '{{WRAPPER}} .filter-nav a.active::before, {{WRAPPER}} .filter-nav a:hover::before',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_filter_nav_seperator',
            [
                'label' => esc_html__('Nav Seperator', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_nav_seperator',
            [
                'label'         => esc_html__('Show Nav Seperator', 'bascart'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'bascart'),
                'label_off'     => esc_html__('No', 'bascart'),
                'return_value'  => 'yes',
                'default'       => (isset($default['badge']) ? esc_attr($default['badge']) : ''),
                'selectors'        => [
                    '{{WRAPPER}} .filter-nav li:not(:last-child)::before' => 'content: ""; position: absolute; top: 0; right: 0;'
                ],
            ]
        );

        $this->add_control(
            'nav_seperator_height',
            [
                'label' => esc_html__('Nav Seperator Height', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max' => 100,
                        'step'  => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-nav li:not(:last-child)::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_nav_seperator' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'nav_seperator_position_top',
            [
                'label' => esc_html__('Nav Seperator Position Top (px)', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max' => 200,
                        'step'  => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-nav li:not(:last-child)::before' => 'top: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'show_nav_seperator' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_seperator_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .filter-nav li:not(:last-child)::before',
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                    ],
                    'width'     => [
                        'allowed_dimensions'    =>  ['right'],
                        'default'       => [
                            'top'       => '0',
                            'right'     => '2',
                            'bottom'    => '0',
                            'left'      => '0',
                            'isLinked'  => false,
                        ],
                    ],
                    'color'     => [
                        'default' => '#F2F2F2'
                    ]
                ],
                'condition' => [
                    'show_nav_seperator' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'nav_active_item_border_around_heading',
            [
                'label' => esc_html__('Active Item Border', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_nav_seperator!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_active_nav_item_border_around',
            [
                'label'         => esc_html__('Show Active Item Border', 'bascart'),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'bascart'),
                'label_off'     => esc_html__('No', 'bascart'),
                'return_value'  => 'yes',
                'default'       => (isset($default['badge']) ? esc_attr($default['badge']) : ''),
                'condition' => [
                    'show_nav_seperator!' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_item_border_around',
                'label' => esc_html__('Nav Item Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'label' => esc_html__('Nav Item Border', 'bascart'),
                        'default' => 'solid',
                        'selectors'     => [
                            '{{WRAPPER}} .filter-nav li a:not(.active, :hover)' => 'border-style: {{VALUE}}',
                            '{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-style: {{VALUE}}',
                        ],
                    ],
                    'width'     => [
                        'label' => esc_html__('Nav Item Border Width', 'bascart'),
                        'default'       => [
                            'top'       => '2',
                            'right'     => '2',
                            'bottom'    => '2',
                            'left'      => '2',
                            'isLinked'  => true,
                        ],
                        'selectors'     => [
                            '{{WRAPPER}} .filter-nav li a:not(.active, :hover)' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ],
                    'color'     => [
                        'label' => esc_html__('Nav Item Border Color', 'bascart'),
                        'default' => '#E60000',
                        'selectors'     => [
                            '{{WRAPPER}} .filter-nav li a:not(.active, :hover)' => 'border-color: transparent',
                            '{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-color: {{VALUE}}',
                        ],
                    ]
                ],
                'condition' => [
                    'show_nav_seperator!' => 'yes',
                    'show_active_nav_item_border_around' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'nav_item_border_around_radius',
            [
                'label' => esc_html__('Nav Item Border Radius (px)', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max' => 200,
                        'step'  => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .filter-nav li a.active, {{WRAPPER}} .filter-nav li a:hover' => 'border-radius: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'show_nav_seperator!' => 'yes',
                    'show_active_nav_item_border_around' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'product_filter_nav_item_list',
            [
                'label' => esc_html__('Nav Item List', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_filter_nav_item_list_padding',
            [
                'label'            => esc_html__('Item List Padding', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '23',
                    'bottom' => '0',
                    'left' => '23',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .filter-nav li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .filter-nav li:first-child'    => 'padding-left: 0',
                    '{{WRAPPER}} .filter-nav li:last-child'     => 'padding-right: 0',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'product_filter_nav_item_list_margin',
            [
                'label'            => esc_html__('Nav Wrap Margin', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '30',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .filter-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'product_filter_nav_wrap',
            [
                'label' => esc_html__('Nav Wrap', 'bascart'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_filter_nav_wrap_padding',
            [
                'label'            => esc_html__('Nav Wrap Padding', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .filter-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'product_filter_nav_wrap_margin',
            [
                'label'            => esc_html__('Nav Wrap Margin', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .filter-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_filter_nav_wrap_border',
                'label' => esc_html__('Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'label' => esc_html__('Nav Wrap Border', 'bascart'),
                    ],
                    'width'     => [
                        'label' => esc_html__('Nav Wrap Border Width', 'bascart'),
                    ],
                    'color'     => [
                        'label' => esc_html__('Nav Wrap Border Color', 'bascart'),
                    ]
                ],
                'selector' => '{{WRAPPER}} .filter-nav',
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
        // Controls added for product style 2
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
        $this->add_control(
            'enable_custom_ordering',
            [
                'label' => esc_html__('Enable Custom Ordering? ', 'bascart'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__('Yes', 'bascart'),
                'label_off' => esc_html__('No', 'bascart'),
            ]
        );
        $this->product_settings_controls(['title', 'price', 'category', 'swatches']);


        $this->end_controls_section();

        $this->start_controls_section(
            'custom-order-section',
            [
                'label' => esc_html__('Custom Ordering', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'enable_custom_ordering'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'order-image',
            [
                'label' => esc_html__('Image', 'bascart'),
                'type' => Controls_Manager::NUMBER
            ]
        );

        $this->add_control(
            'order-category',
            [
                'label' => esc_html__('Category', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'condition'    => [
                    'show_category'   => 'block'
                ]
            ]
        );

        $this->add_control(
            'order-title',
            [
                'label' => esc_html__('Title', 'bascart'),
                'type' => Controls_Manager::NUMBER
            ]
        );

        $this->add_control(
            'order-rating',
            [
                'label' => esc_html__('Rating', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'condition'    => [
                    'hide_rating!'   => 'yes'
                ]
            ]
        );

        $this->add_control(
            'order-price',
            [
                'label' => esc_html__('Price', 'bascart'),
                'type' => Controls_Manager::NUMBER,
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
                'selector' => '{{WRAPPER}} .woocommerce .shop-loop-item .shop-loop-thumb .onsale-percentage',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '400',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '13',
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
                    '{{WRAPPER}} .woocommerce .shop-loop-item .shop-loop-thumb .onsale-percentage' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'discount_badge_BGcolor',
            [
                'label' => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-loop-item .shop-loop-thumb .onsale-percentage' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .woocommerce .shop-loop-item .shop-loop-thumb .onsale-percentage:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'discount_badge_hover_BGcolor',
            [
                'label' => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-loop-item .shop-loop-thumb .onsale-percentage:hover' => 'background: {{VALUE}};',
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
                    '{{WRAPPER}} .woocommerce .shop-loop-item .shop-loop-thumb .onsale-percentage' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        /**
         * @params - These are common style sections: wrapper, badge, image, category, title, rating, pricing, description, cart
         */
        $this->product_common_style(['wrapper', 'image', 'category', 'title', 'price', 'cart', 'quicview', 'hover', 'comparison', 'item_style2', 'color_swatch']);

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
        if (file_exists($tpl)) {
            include $tpl;
        }
    }
    protected function content_template()
    {
    }
}
