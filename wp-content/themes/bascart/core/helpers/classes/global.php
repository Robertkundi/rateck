<?php
namespace Bascart\Core\Helpers\Classes;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

defined('ABSPATH') || exit;
add_action('wp_loaded', function(){
    if(class_exists('ShopEngine')) {
        class Bascart_Controls_Ajax_Select2_Api extends \ShopEngine\Base\Api {
            public function config(){
                $this->prefix = 'bascartselect2';
            }

            public function get_deal_product_list(){
                if(!current_user_can('edit_posts')){
                    return;   
                }

                $query_args = [
                    'post_type'         => 'product',
                    'post_status'       => 'publish',
                    'posts_per_page'    => 15,
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key'     => '_sale_price_dates_to',
                            'value' => '', 
                            'compare' => '!='
                        ),
                    ),
                ];

                if(isset($this->request['ids'])){
                    $ids = explode(',', $this->request['ids']);
                    $query_args['post__in'] = $ids;
                }
                if(isset($this->request['s'])){
                    $query_args['s'] = $this->request['s'];
                }

                $query = new \WP_Query($query_args);
                $options = [];
                if($query->have_posts()):
                    while ($query->have_posts()) {
                        $query->the_post();
                        $options[] = [ 'id' => get_the_ID(), 'text' => get_the_title() ];
                    }
                endif;

                return ['results' => $options];
                wp_reset_postdata();
        }

        // brands
        public function get_product_brands(){
            $query_args = [
                'taxonomy'      => 'brands_cat', // taxonomy name
                'orderby'       => 'name', 
                'order'         => 'DESC',
                'hide_empty'    => false,
                'number'        => 30
            ];

            if(isset($this->request['ids'])){
                $ids = explode(',', $this->request['ids']);
                $query_args['include'] = $ids;
            }
            if(isset($this->request['s'])){
                $query_args['name__like'] = $this->request['s'];
            }

            $terms = get_terms( $query_args );

            $options = [];
            $count = count($terms);
            if($count > 0):
                foreach ($terms as $term) {
                    $options[] = [ 'id' => $term->term_id, 'text' => $term->name ];
                }
            endif;      
            return ['results' => $options];
        }

            
        }
    
        new Bascart_Controls_Ajax_Select2_Api();
    }
}, 999999);

trait Product_Controls
{
    protected function _product_wrapper()
    {
        $this->start_controls_section(
            'product_wrap_style_section',
            [
                'label' => esc_html__('Product Wrap', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'product_content_align',
            [
                'label'        => esc_html__('Content Alignment', 'bascart'),
                'type'         => Controls_Manager::CHOOSE,
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
                'selectors' => [
                    '{{WRAPPER}} .product-loop-desc' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_wrap_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '30',
                    'right' => '30',
                    'bottom' => '30',
                    'left' => '30',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-loop-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_wrap_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .product-loop-desc',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_badge()
    {
        $this->start_controls_section(
            'product_badge_style_section',
            [
                'label' => esc_html__('Product Badge', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'show_sale',
                            'operator' => '===',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'show_off',
                            'operator' => '===',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'show_tag',
                            'operator' => '===',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_badge_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_weight'   => [
                        'default'   => '700',
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
                ],
            )
        );

        $this->add_control(
            'product_badge_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_badge_bg',
            [
                'label'     => esc_html__('Badge Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#f03d3f',
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_percentage_badge_bg',
            [
                'label'     => esc_html__('Percentage Badge Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .off' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_off' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_badgey_item_space_between',
            [
                'label' => __('Item Space Between (px)', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge ul li:not(:last-child)'   => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
                    '{{WRAPPER}} .product-tag-sale-badge.align-vertical ul li:not(:last-child)'   => 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_badge_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '0',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_badge_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link',
            ]
        );
        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bascart'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '3',
                    'left' => '3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-tag-sale-badge .tag a, {{WRAPPER}} .product-tag-sale-badge .no-link' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_image()
    {
        $this->start_controls_section(
            'product_image_style',
            [
                'label' => esc_html__('Product Image', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_image_bg',
            [
                'label'     => esc_html__('Image Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .shop-loop-thumb' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_image_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
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
                    '{{WRAPPER}} .shop-loop-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_category()
    {
        $this->start_controls_section(
            'product_category_style_section',
            [
                'label' => esc_html__('Product Category', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'show_category'   => 'block'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_category_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .product-categories li a',
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
            'product_category_tabs'
        );

        $this->start_controls_tab(
            'product_category_normal_tab',
            [
                'label' => __('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'product_category_color',
            [
                'label' => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#858585',
                'selectors' => [
                    '{{WRAPPER}} .product-categories li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_category_hover_tab',
            [
                'label' => __('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'product_category_hover_color',
            [
                'label' => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F03D3F',
                'selectors' => [
                    '{{WRAPPER}} .product-categories li a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'product_category_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '5',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-categories' => 'line-height: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_title()
    {
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
                ],
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
                        'default'   => '700',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '16',
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
                ],
            )
        );

        $this->add_responsive_control(
            'product_title_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
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
                    '{{WRAPPER}} .product-title' => 'margin: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_rating()
    {
        $this->start_controls_section(
            'product_rating_style_section',
            [
                'label' => esc_html__('Product Rating', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'    => [
                    'hide_rating!'   => 'yes'
                ]
            ]
        );

        $this->add_control(
            'product_rating_star_size',
            [
                'label' => __('Rating Star Size', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max' => 100,
                        'step'  => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_rating_star_color',
            [
                'label'     => esc_html__('Star Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fec42d',
                'selectors' => [
                    '{{WRAPPER}} .product-rating .star-rating span::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_rating_empty_star_color',
            [
                'label'     => esc_html__('Empty Star Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fec42d',
                'selectors' => [
                    '{{WRAPPER}} .product-rating .star-rating::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_rating_count_color',
            [
                'label'     => esc_html__('Count Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999999',
                'selectors' => [
                    '{{WRAPPER}} .rating-count' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_rating_count_typography',
                'label'    => esc_html__('Count Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .rating-count',
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
                            'size'  => '12',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ]
                ],
            )
        );

        $this->add_responsive_control(
            'product_rating_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-rating' => 'line-height: 0; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_price()
    {
        $this->start_controls_section(
            'product_price_style_section',
            [
                'label' => esc_html__('Product Price', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                ],
            ]
        );

        $this->add_control(
            'product_price_sale_price_color',
            [
                'label' => esc_html__('Sale Color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default'   => '#5D6171',
                'selectors' => [
                    '{{WRAPPER}} .product-price del .woocommerce-Price-amount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_price_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .product-price .woocommerce-Price-amount',
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
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ]
                ],
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
                'name'     => 'product_price_discount_badge_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'description'   => esc_html__('Typography for sale price and discount badge', 'bascart'),
                'selector' => '{{WRAPPER}} .product-price .onsale-off, {{WRAPPER}} .product-price del .woocommerce-Price-amount',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                        'label'   => esc_html__('Typography sale and discount', 'bascart'),
                    ],
                    'font_weight'   => [
                        'default'   => '700',
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
                ],
            )
        );

        $this->add_responsive_control(
            'product_price_discount_badge_padding',
            [
                'label'            => esc_html__('Badge Padding', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '0',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-price .onsale-off' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'hide_off'  => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'product_price_discount_badge_margin',
            [
                'label'            => esc_html__('Badge Margin', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .product-price .onsale-off' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'hide_off'  => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'product_price_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
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
                    '{{WRAPPER}} .product-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_price_space_between',
            [
                'label' => __('Price Space Between', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max' => 500,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max' => 100,
                        'step'  => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-price .price ins' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->end_controls_section();
    }

    protected function _product_description()
    {
        $this->start_controls_section(
            'product_description_style_section',
            [
                'label' => esc_html__('Product Description', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_description_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .prodcut-description',
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
            'product_description_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .prodcut-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_description_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '15',
                    'right' => '0',
                    'bottom' => '15',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .prodcut-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_description_border',
                'label' => esc_html__('Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => 'solid',
                    ],
                    'width'     => [
                        'default'       => [
                            'top'       => '1',
                            'right'     => '0',
                            'bottom'    => '0',
                            'left'      => '0',
                            'isLinked'  => false,
                        ],
                    ],
                    'color'     => [
                        'default' => '#F2F2F2'
                    ]
                ],
                'selector' => '{{WRAPPER}} .prodcut-description',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_cart()
    {
        $this->start_controls_section(
            'product_add_to_cart_button_style_section',
            [
                'label' => esc_html__('Product Add to Cart', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_add_to_cart_button_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .button,  {{WRAPPER}} .woocommerce .bascart-multivendor-item .add-to-cart-hover-box .add_to_cart_button',
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
                            'size'  => '18',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ],
                    'letter_spacing' => [
                        'default' => [
                            'size' => '0.4',
                        ],
                    ],
                ],
            )
        );

        $this->start_controls_tabs(
            'product_add_to_cart_button_tabs'
        );

        $this->start_controls_tab(
            'product_add_to_cart_button_normal_tab',
            [
                'label' => __('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .button'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_bg_color',
            [
                'label'     => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .button'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_add_to_cart_button_hover_tab',
            [
                'label' => __('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_hover_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .button:hover'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_add_to_cart_button_hover_bg_color',
            [
                'label'     => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .button:hover'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'product_add_to_cart_button_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
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
                    '{{WRAPPER}} .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
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
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_add_to_cart_button_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .button',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_add_to_cart_button_border_radius',
            [
                'label'            => esc_html__('Border Radius (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_quicview()
    {
        $this->start_controls_section(
            'product_quicview_button_style_section',
            [
                'label' => esc_html__('Product Quick View', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_quicview_button_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .shopengine-quickview-trigger',
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
                            'size'  => '18',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ],
                    'letter_spacing' => [
                        'default' => [
                            'size' => '0.4',
                        ],
                    ],
                ],
            )
        );

        $this->start_controls_tabs(
            'product_quicview_button_tabs'
        );

        $this->start_controls_tab(
            'product_quicview_button_normal_tab',
            [
                'label' => __('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'product_quicview_button_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-quickview-trigger'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_quicview_button_bg_color',
            [
                'label'     => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-quickview-trigger'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_quicview_button_hover_tab',
            [
                'label' => __('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'product_quicview_button_hover_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-quickview-trigger:hover'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_quicview_button_hover_bg_color',
            [
                'label'     => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-quickview-trigger:hover'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'product_quicview_button_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
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
                    '{{WRAPPER}} .shopengine-quickview-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_quicview_button_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
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
                    '{{WRAPPER}} .shopengine-quickview-trigger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_quicview_button_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .shopengine-quickview-trigger',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_quicview_button_border_radius',
            [
                'label'            => esc_html__('Border Radius (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .shopengine-quickview-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function _product_comparison()
    {
        $this->start_controls_section(
            'product_comparison_button_style_section',
            [
                'label' => esc_html__('Comparison Button', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'comparison_button_icon_size',
                'label'    => esc_html__('Comparison Button Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .shopengine-comparison',
                'fields_options'    => [
                    'typography'     => [
                        'default' => 'custom',
                    ],
                    'font_size'     => [
                        'default'   => [
                            'size'  => '20',
                            'unit'  => 'px'
                        ],
                        'label'    => esc_html__('Font Size (px)', 'bascart'),
                        'size_units' => ['px']
                    ]
                ],
            )
        );

        $this->start_controls_tabs(
            'product_comparison_button_tabs'
        );

        $this->start_controls_tab(
            'product_comparison_button_normal_tab',
            [
                'label' => __('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'product_comparison_button_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-comparison'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_comparison_button_bg_color',
            [
                'label'     => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#2C2F40',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-comparison'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_comparison_button_hover_tab',
            [
                'label' => __('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'product_comparison_button_hover_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-comparison:hover'   => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'product_comparison_button_hover_bg_color',
            [
                'label'     => esc_html__('Background', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EE4D4D',
                'selectors' => [
                    '{{WRAPPER}} .shopengine-comparison:hover'   => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'product_comparison_button_padding',
            [
                'label'            => esc_html__('Padding (px)', 'bascart'),
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
                    '{{WRAPPER}} .shopengine-comparison' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_comparison_button_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
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
                    '{{WRAPPER}} .shopengine-comparison' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_comparison_button_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .shopengine-comparison, {{WRAPPER}} .woocommerce .bascart-multivendor-item .add-to-cart-hover-box a:last-child',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_comparison_button_border_radius',
            [
                'label'            => esc_html__('Border Radius (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .shopengine-comparison' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }


    protected function _product_hover()
    {
        // hover overlay style start
        $this->start_controls_section(
            'product_hover_overlay_style_section',
            [
                'label' => esc_html__('Product Hover', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_product_hover_overlay!'  => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs(
            'product_hover_overlay_color_tabs'
        );

        $this->start_controls_tab(
            'product_hover_overlay_color_normal_tab',
            [
                'label' => __('Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'product_hover_overlay_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#101010',
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a::before'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a::after'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_hover_overlay_bg_color',
            [
                'label'     => esc_html__('Background Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'product_hover_overlay_color_hover_tab',
            [
                'label' => __('Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'product_hover_overlay_hover_color',
            [
                'label'     => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#F03D3F',
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a.added::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a.loading::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a:hover::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a:hover::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_hover_overlay_hover_bg_color',
            [
                'label'     => esc_html__('Background Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .overlay-add-to-cart a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'product_hover_overlay_divider_one',
            [
                'type' =>   Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'product_hover_overlay_font_size',
            [
                'label' => __('Font Size (px)', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart a::before'    => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .overlay-add-to-cart a::after'     => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_hover_overlay_padding',
            [
                'label'            => esc_html__('Item Padding (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '10',
                    'right' => '22',
                    'bottom' => '10',
                    'left' => '22',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .overlay-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_hover_overlay_item_space_between',
            [
                'label' => __('Item Space Between (px)', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .overlay-add-to-cart.position-bottom a:not(:last-child)'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .overlay-add-to-cart.position-left a:not(:last-child)'     => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .overlay-add-to-cart.position-right a:not(:last-child)'    => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .overlay-add-to-cart.position-center a:not(:nth-child(2n))'    => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .overlay-add-to-cart.position-center a:not(:nth-child(1), :nth-child(2))'    => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_hover_overlay_border',
                'label' => esc_html__('Border', 'bascart'),
                'fields_options' => [
                    'border'     => [
                        'default' => '',
                        'selectors' => [
                            '{{SELECTOR}} .overlay-add-to-cart' => 'border-style: {{VALUE}};',
                            '{{SELECTOR}} .overlay-add-to-cart:not(:last-child)' => 'border-style: {{VALUE}};',
                        ],
                    ],
                    'width'     => [
                        'default'       => [
                            'top'       => '0',
                            'right'     => '0',
                            'bottom'    => '0',
                            'left'      => '0',
                            'isLinked'  => true,
                        ],
                        'selectors' => [
                            '{{SELECTOR}} .overlay-add-to-cart' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{SELECTOR}} .overlay-add-to-cart a:not(:last-child)' => 'border-width: 0 {{RIGHT}}{{UNIT}} 0 0;',
                        ],
                    ],
                    'color'     => [
                        'default' => '#F2F2F2',
                        'selectors' => [
                            '{{SELECTOR}} .overlay-add-to-cart' => 'border-color: {{VALUE}};',
                            '{{SELECTOR}} .overlay-add-to-cart a:not(:last-child)' => 'border-color: {{VALUE}};',
                        ],
                    ]
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_hover_overlay_border_radius',
            [
                'label'            => esc_html__('Border Radius (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .overlay-add-to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'product_hover_overlay_margin',
            [
                'label'            => esc_html__('Wrap Margin (px)', 'bascart'),
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
                    '{{WRAPPER}} .overlay-add-to-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        // hover overlay style end
    }

    protected function _product_item_style2()
    {
        /*  ------------------------------
        Start product item wrapper style 
        -----------------------------------*/
        $this->start_controls_section(
            'product_item_wrapper',
            [
                'label' => esc_html__('Product Item', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Border and boxshadow
        $this->start_controls_tabs(
            'product_item_border_and_shadow_tab'
        );
        
        $this->start_controls_tab(
          'product_item_normal_tab',
          [
            'label' => __( 'Normal', 'bascart' ),
          ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_item_border',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .style2 .shop-loop-item'
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'product_item_box_shadow',
				'label' => __( 'Box Shadow', 'bascart' ),
				'selector' => '{{WRAPPER}} .style2 .shop-loop-item',
			]
		); 
        $this->end_controls_tab();
        
        $this->start_controls_tab(
          'product_item_hover_tab',
          [
            'label' => __( 'Hover', 'bascart' ),
          ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_item_border_hover',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .style2 .shop-loop-item:hover',
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'product_item_box_shadow_hover',
				'label' => __( 'Box Shadow', 'bascart' ),
				'selector' => '{{WRAPPER}} .style2 .shop-loop-item:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        // Border and box-shadow end
        
        $this->add_responsive_control(
            'product_item_border_radius',
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
                    '{{WRAPPER}} .style2 .shop-loop-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
            ]
        );
        // Description style
		$this->add_control(
			'description_heading',
			[
				'label' => __( 'Description Style', 'bascart' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'product_description_typography',
                'label'    => esc_html__('Typography', 'bascart'),
                'selector' => '{{WRAPPER}} .product-loop-desc .product-short-description',
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
                            'size'  => '22',
                            'unit'  => 'px'
                        ],
                        'size_units' => ['px'] // enable only px
                    ]
                ],
                'separator' => 'after',
            )
        );
        $this->add_control(
            'description_text_color',
            [
                'label' => esc_html__('Color', 'bascart'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-loop-desc .product-short-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'description_text_margin',
            [
                'label'            => esc_html__('Margin (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .product-loop-desc .product-short-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        ); 
        $this->end_controls_section();
        // end styles
    }
    protected function _product_color_swatch() {
        /*  ------------------------------
        Start product item wrapper style 
        -----------------------------------*/
        $this->start_controls_section(
            'color_swatch_style',
            [
                'label' => esc_html__('Color Swatch', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'color_swatch_item_width',
            [
                'label' => __('Swatch Item Width (px)', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .shopengine_swatches.shopengine_swatches_in_loop .swatch.swatch_color'   => 'width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'color_swatch_item_height',
            [
                'label' => __('Swatch Item Height (px)', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .shopengine_swatches.shopengine_swatches_in_loop .swatch.swatch_color'   => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'color_swatch_margin',
            [
                'label'            => esc_html__('Swatch Margin (px)', 'bascart'),
                'type'            => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px'],
                'default'   => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors'     => [
                    '{{WRAPPER}} .shopengine_swatches_in_loop' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_section();
        // end styles
    }


    public function product_common_style($param = ['wrapper', 'badge', 'image', 'category', 'title', 'rating', 'price', 'description', 'cart', 'quicview', 'hover', 'comparison', 'item_style2', 'color_swatch'])
    {
        foreach ($param as $p) {
            $method = '_product_' .  $p;
            if (method_exists($this, $method)) {
                $this->$method();
            }
        }
    }

    public function product_genreral_controls($param = [])
    {
        $default = !empty($param) && !empty($param['defaults']) ? $param['defaults'] : [];
        $exclude = !empty($param) && !empty($param['exclude']) ? $param['exclude'] : [];

        if (empty($exclude) || !in_array('ajax_load', $exclude)) {
            $this->add_control(
                'ajax_load',
                [
                    'label' => esc_html__('Enable Ajax Load?', 'bascart'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on'  => esc_html__('Yes', 'bascart'),
                    'label_off' => esc_html__('No', 'bascart'),
                    'default'   => (isset($default['ajax']) ? esc_attr($default['ajax']) : 'yes'),
                ]
            );
        }
        $this->add_control(
            'products_per_page',
            [
                'label' => esc_html__('Products Per Page', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'default'   => (isset($default['page']) ? esc_attr($default['page']) : 6),
            ]
        );

        if (empty($exclude) || !in_array('order', $exclude)) {
            $this->add_control(
                'product_order',
                [
                    'label' => esc_html__('Order', 'bascart'),
                    'type' => Controls_Manager::SELECT,
                    'default'   => (isset($default['order']) ? esc_attr($default['order']) : 'DESC'),
                    'options'   => [
                        'ASC'       => esc_html__('ASC', 'bascart'),
                        'DESC'      => esc_html__('DESC', 'bascart'),
                    ],
                ]
            );
        }

        if (empty($exclude) || !in_array('orderby', $exclude)) {
            $this->add_control(
                'product_orderby',
                [
                    'label' => esc_html__('Order By', 'bascart'),
                    'type' => Controls_Manager::SELECT,
                    'default'   => (isset($default['orderby']) ? esc_attr($default['orderby']) : 'date'),
                    'options'   => [
                        'ID'       => esc_html__('ID', 'bascart'),
                        'title'       => esc_html__('Title', 'bascart'),
                        'name'      => esc_html__('Name', 'bascart'),
                        'date'      => esc_html__('Date', 'bascart'),
                        'comment_count'      => esc_html__('Popular', 'bascart'),
                    ],
                ]
            );
        }

        $this->add_control(
            'column_class',
            [
                'label' => esc_html__('Products Column', 'bascart'),
                'type' => Controls_Manager::SELECT,
                'default'   => (isset($default['column']) ? esc_attr($default['column']) : 'col-md-6 col-lg-2'),
                'options'   => [
                    'col-md-6 col-lg-12' => 'Column 1',
                    'col-md-6 col-lg-6' => 'Column 2',
                    'col-md-6 col-lg-4' => 'Column 3',
                    'col-md-6 col-lg-3' => 'Column 4',
                    'col-md-6 col-lg-2' => 'Column 6',
                ]
            ]
        );
    }

    public function product_settings_controls($param = [])
    {

        if (empty($param) || in_array('badge', $param)) {
            $this->add_control(
                'badge_settings',
                [
                    'label' => __('Badge:', 'bascart'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'show_sale',
                [
                    'label'         => esc_html__('Show Sale Badge?', 'bascart'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => esc_html__('Yes', 'bascart'),
                    'label_off'     => esc_html__('No', 'bascart'),
                    'return_value'  => 'yes',
                    'default'       => (isset($default['sale_badge']) ? esc_attr($default['sale_badge']) : 'yes'),
                    'selectors'        => [
                        '{{WRAPPER}} .badge.sale' => 'display: inline-block !important;'
                    ],
                ]
            );

            $this->add_control(
                'show_off',
                [
                    'label'         => esc_html__('Show Discount Percentage', 'bascart'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => esc_html__('Yes', 'bascart'),
                    'label_off'     => esc_html__('No', 'bascart'),
                    'return_value'  => 'yes',
                    'default'       => (isset($default['off']) ? esc_attr($default['off']) : 'yes'),
                    'selectors'        => [
                        '{{WRAPPER}} .onsale-off' => 'display: inline-block;'
                    ]
                ]
            );
            $this->add_control(
                'show_tag',
                [
                    'label'         => esc_html__('Show Tag', 'bascart'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => esc_html__('Yes', 'bascart'),
                    'label_off'     => esc_html__('No', 'bascart'),
                    'return_value'  => 'yes',
                    'default'       => (isset($default['show_tag']) ? esc_attr($default['show_tag']) : 'yes'),
                    'selectors'        => [
                        '{{WRAPPER}} .badge.tag' => 'display: inline-block;'
                    ]
                ]
            );

            $this->add_control(
                'badge_position',
                [
                    'label' => __('Badge Position', 'bascart'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top-left' => [
                            'title' => __('Top Left', 'bascart'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'top-right' => [
                            'title' => __('Top Right', 'bascart'),
                            'icon' => 'eicon-h-align-right',
                        ],
                        'custom' => [
                            'title' => __('Custom', 'bascart'),
                            'icon' => 'eicon-settings',
                        ],
                    ],
                    'default' => 'top-right',
                    'toggle' => false,
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'show_sale',
                                'operator' => '===',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'show_off',
                                'operator' => '===',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'show_tag',
                                'operator' => '===',
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );

            $this->add_control(
                'badge_position_x_axis',
                [
                    'label' => __('Badge Position (X axis)', 'bascart'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min'   => 0,
                            'max' => 1000,
                            'step'  => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 4,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .product-tag-sale-badge' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'badge_position' => 'custom',
                    ]
                ]
            );

            $this->add_control(
                'badge_position_y_axis',
                [
                    'label' => __('Badge Position (Y axis)', 'bascart'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min'   => 0,
                            'max' => 1000,
                            'step'  => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 4,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .product-tag-sale-badge' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'badge_position' => 'custom',
                    ]
                ]
            );

            $this->add_control(
                'badge_align',
                [
                    'label' => __('Badge Align', 'bascart'),
                    'description' => esc_html__('Styling controls are in style tab', 'bascart'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'vertical' => [
                            'title' => __('Vertical', 'bascart'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'horizontal' => [
                            'title' => __('Horizontal', 'bascart'),
                            'icon' => 'eicon-h-align-left',
                        ],
                    ],
                    'default' => 'horizontal',
                    'toggle' => false,
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'show_sale',
                                'operator' => '===',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'show_off',
                                'operator' => '===',
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
        }

        if (empty($param) || in_array('title', $param)) {
            $this->add_control(
                'title_settings',
                [
                    'label' => __('Title:', 'bascart'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'title_character',
                [
                    'label'         => esc_html__('Title Word Count', 'bascart'),
                    'description'   => esc_html__('Number of words to show in product title', 'bascart'),
                    'type'          => Controls_Manager::NUMBER,
                    'return_value'  => 'yes',
                    'default'       => 30,
                ]
            );
        }

        if (empty($param) || in_array('hover', $param)) {
            $this->add_control(
                'product_hover_overlay_settings',
                [
                    'label' => esc_html__('Product Hover:', 'bascart'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'hide_product_hover_overlay',
                [
                    'label' => esc_html__('Hide Product Hover', 'bascart'),
                    'description' => esc_html__('Styling controls are in style tab', 'bascart'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on'  => esc_html__('Yes', 'bascart'),
                    'label_off' => esc_html__('No', 'bascart'),
                    'default'   => 'yes',
                    'selectors' => [
                        '{{WRAPPER}} .overlay-add-to-cart' => 'display: none;'
                    ]
                ]
            );

            $this->add_control(
                'product_hover_overlay_position',
                [
                    'label' => __('Position', 'bascart'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __('Left', 'bascart'),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => __('Right', 'bascart'),
                            'icon' => 'eicon-h-align-right',
                        ],
                        'bottom' => [
                            'title' => __('Bottom', 'bascart'),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                        'center' => [
                            'title' => __('Center', 'bascart'),
                            'icon' => 'eicon-h-align-center',
                        ],
                    ],
                    'default' => 'bottom',
                    'toggle' => false,
                    'condition' => [
                        'hide_product_hover_overlay!'  => 'yes'
                    ]
                ]
            );
        }

        if (empty($param) || in_array('price', $param)) {
            $this->add_control(
                'price_settings',
                [
                    'label' => __('Price:', 'bascart'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'price_alignment',
                [
                    'label' => esc_html__('Alignment', 'bascart'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'flex-start',
                    'options' => [
                        'flex-start' => esc_html__('Inline', 'bascart'),
                        'center' => esc_html__('Center', 'bascart'),
                        'space-between' => esc_html__('Space Between', 'bascart')
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .shop-loop-item .product-price' => 'justify-content: {{VALUE}}'
                    ]
                ]
            );
            $this->add_control(
                'hide_off',
                [
                    'label'         => esc_html__('Hide Off Tag', 'bascart'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => esc_html__('Yes', 'bascart'),
                    'label_off'     => esc_html__('No', 'bascart'),
                    'return_value'  => 'yes',
                    'default'       => (isset($default['off_tag']) ? esc_attr($default['off_tag']) : 'yes'),
                    'selectors'        => [
                        '{{WRAPPER}} .onsale-percentage' => ''
                    ],
                ]
            );
        }

        if (empty($param) || in_array('category', $param)) {
            $this->add_control(
                'category_settings',
                [
                    'label' => __('Category:', 'bascart'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'show_category',
                [
                    'label' => esc_html__('Show Category?', 'bascart'),
                    'type' => Controls_Manager::SELECT2,
                    'options'   => [
                        'block' => esc_html__('Yes', 'bascart'),
                        'none'  => esc_html__('No', 'bascart')
                    ],
                    'default'   => (isset($default['show_category']) ? esc_attr($default['show_category']) : 'block'),
                    'selectors' => [
                        '{{WRAPPER}} .product-category' => 'display: {{VALUE}}'
                    ]
                ]
            );
            $this->add_control(
                'category_limit',
                [
                    'label' => esc_html__('Category Limit', 'bascart'),
                    'type' => Controls_Manager::NUMBER,
                    'default'   => (isset($default['category_limit']) ? esc_attr($default['category_limit']) : 1),
                    'min'       => 1,
                    'max'       => 100,
                    'step'      => 1,
                    'condition' => [
                        'show_category' => 'block'
                    ]
                ]
            );
        }

        if (empty($param) || in_array('swatches', $param)) {
            $this->add_control(
                'color_swatch_settings',
                [
                    'label' => __('Color Swatch:', 'bascart'),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_color_swatches',
                [
                    'label' => esc_html__( 'Show Color Swatch', 'bascart' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'bascart' ),
                    'label_off' => esc_html__( 'Hide', 'bascart' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );
        }
    }

    public function slider_navigation_pagination_controls($param = []) {
        if (empty($param) || in_array('navigation', $param)) {
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
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
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
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
                    'default' => '#2c2f40',
                    'selectors' => [
                        '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'icon_bg_color',
                [
                    'label' => esc_html__( 'Icon Background Color', 'bascart' ),
                    'default' => '#e4e8f8',
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .swiper-button-next' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}}'
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
                    'default' => '#ffffff',
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
                    'default' => '#ee4d4d',
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
                    'exclude'       => ['font_family', 'text_transform', 'font_style', 'text_decoration', 'letter_spacing'],
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
                            'default' => '600',
                        ],
                        'line_height'    => [
                            'default' => [
                                'size' => '50',
                                'unit' => 'px'
                            ]
                        ]
                    ]
                ]
            );
            $this->add_responsive_control(
                'nav_border_radius',
                [
                    'label' => esc_html__( 'Nav Border Radius', 'bascart' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'default'   => [
                        'top' => '50',
                        'right' => '50',
                        'bottom' => '50',
                        'left' => '50',
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );
            $this->add_responsive_control(
                'slide_prev_position',
                [
                    'label' => esc_html__( 'Previous Button Position (x-axis)', 'bascart' ),
                    'description' => esc_html__('(-) Negative values are allowed', 'bascart'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' , '%' ],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 200,
                        ],
                        'px' => [
                            'min' => -100,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => -80,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .swiper-button-prev' => 'transform: translate({{SIZE}}{{UNIT}}, -50%);',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slide_next_position',
                [
                    'label' => esc_html__( 'Next Button Position (x-axis)', 'bascart' ),
                    'description' => esc_html__('(-) Negative values are allowed', 'bascart'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' , '%' ],
                    'range' => [
                        '%' => [
                            'min' => -100,
                            'max' => 200,
                        ],
                        'px' => [
                            'min' => -100,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 80,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .swiper-button-next' => 'transform: translate({{SIZE}}{{UNIT}}, -50%);',
                    ],
                ]
            );
            $this->end_controls_section();
        }
    }
}
