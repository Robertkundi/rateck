<?php

namespace Elementor;

use \Elementor\ElementsKit_Widget_Vertical_Menu_Handler as Handler;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class ElementsKit_Widget_Vertical_Menu extends Widget_Base {
	use \ElementsKit_Lite\Widgets\Widget_Notice;

	public $base;

	public function get_name() {
        return Handler::get_name();
    }

    public function get_title() {
        return Handler::get_title();
    }

    public function get_icon() {
        return Handler::get_icon();
    }

    public function get_categories() {
        return Handler::get_categories();
    }

    public function get_help_url() {
        return '';
    }

    public function get_menus(){
        $list = [];
        $menus = wp_get_nav_menus();
        foreach($menus as $menu){
            $list[$menu->slug] = $menu->name;
        }

        return $list;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'elementskit_vertical_menu_content_tab',
            [
                'label' => esc_html__('Vertical menu settings', 'bascart-essential'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'elementskit_nav_menu',
            [
                'label'     =>  esc_html__( 'Select menu', 'bascart-essential' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus(),
            ]
		);
        
        $this->add_control(
			'elementskit_vertical_menu_badge_position',
			[
				'label' => esc_html__( 'Badge Position', 'bascart-essential' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Right', 'bascart-essential' ),
				'label_off' => esc_html__( 'Left', 'bascart-essential' ),
				'return_value' => 'yes',
			]
        );

        $this->add_control(
            'divider_1',
            ['type' => Controls_Manager::DIVIDER]
        );
        
        $this->add_control(
			'elementskit_vertical_menu_show_toggle',
			[
				'label' => esc_html__( 'Toggle', 'bascart-essential' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'bascart-essential' ),
				'label_off' => esc_html__( 'Hide', 'bascart-essential' ),
				'return_value' => 'yes',
			]
        );

        $this->add_control(
			'elementskit_vertical_menu_show_active_or_not',
			[
				'label' => esc_html__( 'Show Toggle Menu on all pages', 'bascart-essential' ),
				'type'  => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'bascart-essential' ),
				'label_off' => esc_html__( 'Hide', 'bascart-essential' ),
                'return_value' => 'yes',
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
			]
		);

       

        $this->add_control(
			'elementskit_vertical_menu_is_toggle_for_frontpage',
			[
				'label' => esc_html__( 'Show Toggle only on home', 'bascart-essential' ),
				'type'  => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'bascart-essential' ),
				'label_off' => esc_html__( 'Hide', 'bascart-essential' ),
                'description' => esc_html__('This option allows you to show this menu only for home page', 'bascart-essential'),
                'condition' => [
                    'elementskit_vertical_menu_show_active_or_not' => ''
                ],
               
			]
		);

        $this->add_control(
            'divider_2',
            ['type' => Controls_Manager::DIVIDER]
        );
        
        $this->add_control(
			'elementskit_vertical_menu_toggle_title',
			[
				'label' => esc_html__( 'Title', 'bascart-essential' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'All Categories', 'bascart-essential' ),
                'placeholder' => esc_html__( 'Type your title here', 'bascart-essential' ),
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
			]
        );
        
        $this->start_controls_tabs(
            'elementskit_vertical_nav_menu_tabs',
            [
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
            ]
		);
			// right icon
			$this->start_controls_tab(
				'elementskit_vertical_nav_menu_right_icon_tab',
				[
					'label' => esc_html__( 'Icon Left', 'bascart-essential' ),
				]
            );

            $this->add_control(
                'elementskit_vertical_menu_toggle_title_icon_right',
                [
                    'label' => esc_html__( 'Menu Icon Left', 'bascart-essential' ),
                    'type' => Controls_Manager::ICONS,
                ]
            );
            
            $this->end_controls_tab();

            // left icon
			$this->start_controls_tab(
				'elementskit_vertical_nav_menu_left_icon_tab',
				[
					'label' => esc_html__( 'Icon Right', 'bascart-essential' ),
				]
            );
            
            $this->add_control(
                'elementskit_vertical_menu_toggle_title_icon_left',
                [
                    'label' => esc_html__( 'Menu Icon Right', 'bascart-essential' ),
                    'type' => Controls_Manager::ICONS,
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'submenu_click_area',
            [
                'label'         => esc_html__('Submenu Click Area', 'bascart-essential'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Icon', 'bascart-essential'),
                'label_off'     => esc_html__('Text', 'bascart-essential'),
                'return_value'  => 'icon',
                'default'       => 'icon',
            ]
        );
		
        $this->end_controls_section();
		
        $this->insert_pro_message();
        
        // Toggle Button Style
        $this->start_controls_section(
			'elementskit_vertical_menu_toggle_style_tab',
			[
				'label' => esc_html__( 'Toggle Button', 'bascart-essential' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'elementskit_vertical_menu_show_toggle' => 'yes'
                ]
			]
        );
        
        $this->start_controls_tabs(
            'elementskit_vertical_menu_toggle_style_control_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'elementskit_vertical_menu_toggle_style_noraml_tab',
				[
					'label' => esc_html__( 'Normal', 'bascart-essential' ),
				]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_vertical_menu_toggle_content_typography',
                    'label' => esc_html__( 'Typography', 'bascart-essential' ),
                    'selector' => '{{WRAPPER}} .ekit-vertical-menu-tigger',
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_toggle_title_color',
                [
                    'label' => esc_html__( 'Color', 'bascart-essential' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-menu-tigger' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ekit_vertical_menu_toggle_background',
                    'label' => esc_html__( 'Background', 'bascart-essential' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ekit-vertical-menu-tigger',
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_toggle_padding',
                [
                    'label' => esc_html__( 'Padding', 'bascart-essential' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-menu-tigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_toggle_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'bascart-essential' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-menu-tigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );    

            $this->end_controls_tab();

            // Active
			$this->start_controls_tab(
				'elementskit_vertical_menu_toggle_style_active_tab',
				[
					'label' => esc_html__( 'Active', 'bascart-essential' ),
				]
            );
            
            $this->add_control(
                'ekit_vertical_menu_toggle_title_color_active',
                [
                    'label' => esc_html__( 'Color', 'bascart-essential' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .vertical-menu-active .ekit-vertical-menu-tigger' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ekit_vertical_menu_toggle_background_active',
                    'label' => esc_html__( 'Background', 'bascart-essential' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .vertical-menu-active .ekit-vertical-menu-tigger',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        
        // Menu container
        $this->start_controls_section(
			'ekit_vertical_menu_container_style_tab',
			[
				'label' => esc_html__( 'Menu Container', 'bascart-essential' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_vertical_menu_container_background',
				'label' => esc_html__( 'Background', 'bascart-essential' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav',
			]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_vertical_menu_container_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'bascart-essential' ),
				'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav',
			]
        );
        
        $this->add_control(
			'ekit_vertical_menu_container_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'bascart-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-vertical-navbar-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
        
        // Menu items
        $this->start_controls_section(
			'ekit_vertical_menu_items_style_tab',
			[
				'label' => esc_html__( 'Menu Items', 'bascart-essential' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
            'elementskit_vertical_menu_items_style_control_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'elementskit_vertical_menu_items_style_noraml_tab',
				[
					'label' => esc_html__( 'Normal', 'bascart-essential' ),
				]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_vertical_menu_items_content_typography',
                    'label' => esc_html__( 'Typography', 'bascart-essential' ),
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a',
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_items_title_color',
                [
                    'label' => esc_html__( 'Color', 'bascart-essential' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'ekit_vertical_menu_items_padding',
                [
                    'label' => esc_html__( 'Padding', 'bascart-essential' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_control(
                'ekit_vertical_menu_items_icon_padding',
                [
                    'label' => esc_html__( 'Icon Spacing', 'bascart-essential' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a .ekit-menu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ekit_vertical_menu_items_border',
                    'label' => esc_html__( 'Border', 'bascart-essential' ),
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav>li',
                ]
            );

            $this->end_controls_tab();

            // Hover
			$this->start_controls_tab(
				'elementskit_vertical_menu_items_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'bascart-essential' ),
				]
            );
            
            $this->add_control(
                'ekit_vertical_menu_items_title_color_active',
                [
                    'label' => esc_html__( 'Color', 'bascart-essential' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li>a:hover' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .ekit-vertical-navbar-nav>li:hover>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();
        
        // Sub Menu items
        $this->start_controls_section(
			'ekit_vertical_sub_menu_items_style_tab',
			[
				'label' => esc_html__( 'Sub Menu Items', 'bascart-essential' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
            'elementskit_vertical_sub_menu_items_style_control_tabs'
		);
			// Normal
			$this->start_controls_tab(
				'elementskit_vertical_sub_menu_items_style_noraml_tab',
				[
					'label' => esc_html__( 'Normal', 'bascart-essential' ),
				]
            );

            $this->add_responsive_control(
                'ekit_vertical_sub_menu_container_width',
                [
                    'label' => esc_html__( 'Width', 'bascart-essential' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 220,
                            'max' => 700,
                            'step' => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_vertical_sub_menu_items_content_typography',
                    'label' => esc_html__( 'Typography', 'bascart-essential' ),
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a',
                ]
            );

            $this->add_control(
                'ekit_vertical_sub_menu_items_title_color',
                [
                    'label' => esc_html__( 'Color', 'bascart-essential' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'ekit_vertical_sub_menu_items_padding',
                [
                    'label' => esc_html__( 'Padding', 'bascart-essential' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ekit_vertical_sub_menu_items_border',
                    'label' => esc_html__( 'Border', 'bascart-essential' ),
                    'selector' => '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li',
                ]
            );

            $this->end_controls_tab();

            // Hover
			$this->start_controls_tab(
				'elementskit_vertical_sub_menu_items_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'bascart-essential' ),
				]
            );
            
            $this->add_control(
                'ekit_vertical_sub_menu_items_title_color_active',
                [
                    'label' => esc_html__( 'Color', 'bascart-essential' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li>a:hover' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .ekit-vertical-navbar-nav .elementskit-dropdown>li:hover>a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->end_controls_section();
    }

	protected function render( ) {
		$settings = $this->get_settings_for_display();
        echo '<div class="ekit-wid-con">';
            $this->render_raw();
        echo '</div>';
    }

    protected function vertical_menu_icon($props, $classname) {
        if ($props && $props['value'] !== '') {
            if ($props['library'] !== 'svg') { ?>
                <i class="<?php echo esc_attr($props['value'] .' '. $classname); ?> vertical-menu-icon"></i>
            <?php } else { ?>
                <img class="<?php echo esc_attr($classname); ?> vertical-menu-icon" src="<?php echo esc_url($props['value']['url']); ?>" alt="vertical menu icon">
            <?php }
        }
    }

    protected function render_raw( ) {
		$settings = $this->get_settings_for_display();
        extract($settings);

        if ($elementskit_nav_menu !== '') {
            $active_vertical_menu_toggle = $elementskit_vertical_menu_show_active_or_not == 'yes' ? 'vertical-menu-active' : '';
           
            if( $elementskit_vertical_menu_is_toggle_for_frontpage === 'yes' && is_front_page()  ) {
                $active_vertical_menu_toggle = 'vertical-menu-active';
            }

        ?>
        <div 
            class="ekit-vertical-main-menu-wraper <?php echo esc_attr($elementskit_vertical_menu_show_toggle == 'yes' ? 'ekit-vertical-main-menu-on-click' : '') ?> <?php echo esc_attr( $active_vertical_menu_toggle ) ?> <?php echo esc_attr($elementskit_vertical_menu_badge_position == 'yes' ? 'badge-position-right' : 'badge-position-left') ?>"
        >
            <?php if ($elementskit_vertical_menu_show_toggle == 'yes') { ?>
            <a href="#" class="ekit-vertical-menu-tigger">
                <?php $this->vertical_menu_icon($elementskit_vertical_menu_toggle_title_icon_right, 'vertical-menu-right-icon'); ?>
                <?php if ($elementskit_vertical_menu_toggle_title !== '') { ?>
                <span class="ekit-vertical-menu-tigger-title"><?php echo esc_html($elementskit_vertical_menu_toggle_title);?></span>
                <?php }; ?>
                <?php $this->vertical_menu_icon($elementskit_vertical_menu_toggle_title_icon_left, 'vertical-menu-left-icon'); ?>
            </a>
            <?php }; ?>
            <?php
                if($settings['elementskit_nav_menu'] != '' && wp_get_nav_menu_items($settings['elementskit_nav_menu']) !== false && count(wp_get_nav_menu_items($settings['elementskit_nav_menu'])) > 0){
                    $args = [
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'container'       => 'div',
                        'container_class' => 'ekit-vertical-menu-container',
                        'menu'         	  => $settings['elementskit_nav_menu'],
                        'menu_class'      => 'ekit-vertical-navbar-nav submenu-click-on-' . $settings['submenu_click_area'],
                        'depth'           => 4,
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'walker'          => (class_exists('\ElementsKit_Lite\ElementsKit_Menu_Walker') ? new \ElementsKit_Lite\ElementsKit_Menu_Walker() : '' )
                    ];
        
                    wp_nav_menu($args);
                }
            ?>
        </div>
        <?php
        } else { ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <?php echo esc_html__('Please Select Menu', 'bascart-essential'); ?>  
            </div>
        </div>
        <?php }
    }
}
