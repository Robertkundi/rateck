<?php
namespace Elementor;
if (!defined('ABSPATH')) exit;


class bascart_News_Ticker extends Widget_Base
{
    public $base;

    public function get_name()
    {
        return 'news-ticker';
    }

    public function get_title()
    {

        return esc_html__('News Ticker', 'bascart');

    }

    public function get_icon()
    {
        return 'eicon-image';
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
                'label' => esc_html__('News Ticket Content', 'bascart'),
            ]
        );

        $this->add_control(
            'slide_arrows',
            [
                'label' => esc_html__('Show Navigation', 'bascart'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bascart'),
                'label_off' => esc_html__('No', 'bascart'),
                'default' => 'no',

            ]
        );

        $this->add_control(
            'slide_dots',
            [
                'label' => esc_html__('Show Dots', 'bascart'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'default' => 'no',

            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__('Title', 'bascart'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('News ticker title', 'bascart'),
                'default' => esc_html__('Trending', 'bascart'),

            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Posts Select By', 'bascart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'bascart'),
                    'ID' => esc_html__('ID', 'bascart'),
                    'title' => esc_html__('Title', 'bascart'),
                    'comment_count' => esc_html__('Comment Count', 'bascart'),
                    'name' => esc_html__('Name', 'bascart'),
                    'rand' => esc_html__('Random', 'bascart'),
                    'menu_order' => esc_html__('Menu Order', 'bascart'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Post Order', 'bascart'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__('Descending', 'bascart'),
                    'ASC' => esc_html__('Ascending', 'bascart'),
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Post Count', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'default' => '5',
            ]
        );

        $this->add_control(
            'post_cats',
            [
                'label' => esc_html__('Select Categories', 'bascart'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->post_category(),
                'label_block' => true,
                'multiple' => true,
            ]
        );

        $this->add_control('title_crop',
        [
            'label' => esc_html__('Title Word Limit', 'bascart'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 35,
            ],
        ]);

        $this->add_responsive_control(
            'text_align', [
                'label' => esc_html__('Alignment', 'bascart'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [

                    'left' => [
                        'title' => esc_html__('Left', 'bascart'),
                        'ts-icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'bascart'),
                        'ts-icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'bascart'),
                        'ts-icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tranding-bg-white' => 'text-align: {{VALUE}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'ticker_padding',
            [
                'label' => esc_html__('Padding', 'bascart'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tranding-bg-white' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('bascart_style_block_section',
            [
                'label' => esc_html__(' Post', 'bascart'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tranding-bar .trending-slide .trending-title, .tranding-bar .trending-slide .trending-title i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography',
                'label' => esc_html__('Title Typography', 'bascart'),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tranding-bar .trending-slide .trending-title',
            ]
        );

        $this->add_control(
            'news_color',
            [
                'label' => esc_html__('News Color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tranding-bar .swiper-slide .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'news_title_typography',
                'label' => esc_html__('News Typography', 'bascart'),
                'scheme' => Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tranding-bar .swiper-slide .post-title a',
            ]
        );

        $this->end_controls_section();
        /*
           Slider Navigation Style
        */
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $title = $settings['title'];
        $newsticker_nav_enable = $settings['slide_arrows'];
        $post_title_crop = isset($settings['title_crop']) ? $settings['title_crop']['size'] : '35';


        $args = array(
            'orderby' => $settings['orderby'],
            'order' => $settings['order'],
            'posts_per_page' => $settings['posts_per_page'],
        );

        if (!empty($settings['post_cats'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $settings['post_cats']
                )
            );
        }

        $posts = get_posts($args);

        $tpl = get_widget_template($this->get_name());
        include $tpl;

        ?>
        <?php
    }

    protected function content_template()
    {
    }

    public function post_category()
    {

        $terms = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'posts_per_page' => -1,
        ));

        $cat_list = [];
        foreach ($terms as $post) {
            $cat_list[$post->term_id] = [$post->name];
        }
        return $cat_list;
    }
}