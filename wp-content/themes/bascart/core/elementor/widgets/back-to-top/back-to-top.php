<?php
namespace Elementor;
if (!defined('ABSPATH')) exit;
class Bascart_Back_To_Top extends Widget_Base
{


    public $base;

    public function get_name()
    {
        return 'back-to-top';
    }

    public function get_title()
    {

        return esc_html__('Bascart Back To Top', 'bascart');

    }

    public function get_icon()
    {
        return 'fas fa-arrow-up';
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
            'backto_button_icon',
            [
                'label' => esc_html__('Select Icon', 'bascart'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-up',
                ]
            ]
        );


        $this->start_controls_tabs('bascart_tabs_styled');

        $this->start_controls_tab(
            'tab_style_normal',
            [
                'label' => esc_html__('Button Normal', 'bascart'),
            ]
        );

        $this->add_control(
            'backto_button_color',
            [
                'label' => esc_html__('Button color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bascart-back-top' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'backto_button_bg_color',
                'label' => esc_html__('Backto BG color', 'bascart'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bascart-back-top',
            ]
        );

        $this->add_responsive_control(
            'backto_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bascart'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bascart-back-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'backto_font_size',
            [
                'label' => esc_html__('Icon Size', 'bascart'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bascart-back-top i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'backto_border_normal',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .bascart-back-top',
            ]
        );

        $this->add_responsive_control(
            'backto_border_padding',
            [
                'label' => esc_html__('Button Padding', 'bascart'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bascart-back-top i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_style_active',
            [
                'label' => esc_html__('Button Hover', 'bascart'),
            ]
        );

        $this->add_control(
            'backto_button_hov_color',
            [
                'label' => esc_html__('Backto Hover color', 'bascart'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bascart-back-top:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'backto_button_hov_bg_color',
                'label' => esc_html__('Backto Button Hover BG color', 'bascart'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bascart-back-top:hover',
            ]
        );

        $this->add_responsive_control(
            'backto_hov_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bascart'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bascart-back-top:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'backto_border_hover',
                'label' => esc_html__('Border', 'bascart'),
                'selector' => '{{WRAPPER}} .bascart-back-top:hover',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

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
    protected function render_raw() {
        $settings = $this->get_settings_for_display();

        $tpl = get_widget_template($this->get_name());
        if (file_exists($tpl)) {
            include $tpl;
        }
    }

    protected function content_template() { }
}