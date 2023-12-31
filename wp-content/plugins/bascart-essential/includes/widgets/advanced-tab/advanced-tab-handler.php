<?php
namespace Elementor;

class ElementsKit_Widget_Advanced_Tab_Handler extends \ElementsKit_Lite\Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-tab';
    }

    static function get_title() {
        return esc_html__('Advanced Tab', 'bascart-essential');
    }

    static function get_icon() {
        return 'ekit ekit-tab ekit-widget-icon ';
    }

    static function get_categories() {
        return ['bascart-essential' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'advanced-tab/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'advanced-tab/';
    }

}