<?php
namespace Elementor;
if (!defined('ABSPATH')) exit;

class Bascart_User_Icon extends Widget_Base {
    public $base;

    public function get_name()
    {
        return 'user-icon';
    }

    public function get_title()
    {

        return esc_html__('Bascart User', 'bascart');

    }

    public function get_icon()
    {
        return 'fas fa-user';
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
                'label' => esc_html__('back to top settings', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
			'user_login_icon',
			[
				'label' => esc_html__( 'Icon', 'bascart' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_with_text_show',
			[
				'label'       => esc_html__('Icon with text ', 'bascart'),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__('Yes', 'bascart'),
				'label_off'   => esc_html__('No', 'bascart'),
				'default'     => 'no',
			]
		);
		$this->add_control(
			'icon_with_text',
			[
				'label' => esc_html__('Enter your text', 'bascart'),
				'type' => Controls_Manager::TEXT,
				'condition' => ['icon_with_text_show' => 'yes'],
			]
		);

		$this->add_control(
			'custom_link_show',
			[
				'label'       => esc_html__('Use custom link?', 'bascart'),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__('Yes', 'bascart'),
				'label_off'   => esc_html__('No', 'bascart'),
				'default'     => 'no',
			]
		);
		$this->add_control(
			'user_custom_link',
			[
				'label' => esc_html__('Link', 'bascart'),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition' => ['custom_link_show' => 'yes'],
			]
		);

		$this->add_control(
            'select_menu',
            [
                'label'     =>esc_html__( 'Select menu', 'bascart' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus(),
            ]
        );

		
		$this->end_controls_section();

		$this->start_controls_section(
			'user_login_btn_style',
			[
				'label'	 => esc_html__('User Button Style', 'bascart'),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'user_button_color',
			[
				'label'		 => esc_html__('Menu color', 'bascart'),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .login-user a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'user_button_hover_color',
			[
				'label'		 => esc_html__('Menu hover Color', 'bascart'),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .login-user a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_typography',
				'label' => esc_html__( '', 'bascart' ),
                'selector' => '{{WRAPPER}} .login-user a',
			]
		);
		
		$this->add_responsive_control(
			'user_border_radius',
			[
				'label' => esc_html__('Icon Border Radius', 'bascart'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .login-user > a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

    protected function render()
    {
        $settings       = $this->get_settings();

        ?>
            <div class="bascart-<?php echo esc_attr($this->get_name()); ?>" data-widget_settings='<?php echo json_encode($settings); ?>'>
            <?php $this->render_raw(); ?>
        </div>
        <?php

    }
    protected function render_raw() {
        $settings = $this->get_settings_for_display();

        $tpl = get_widget_template($this->get_name());
        if (file_exists($tpl)) {
            include $tpl;
        }
    }

    protected function content_template() { }
    
	public function get_menus(){
        $list = [];
        $menus = wp_get_nav_menus();
        foreach($menus as $menu){
            $list[$menu->slug] = $menu->name;
        }
        return $list;
    }
}