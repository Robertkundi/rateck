<?php
namespace Elementor;

class ElementsKit_Widget_Vertical_Menu_Handler extends \ElementsKit_Lite\Core\Handler_Widget{

    static function get_name() {
        return 'ekit-vertical-menu';
    }

    static function get_title() {
        return esc_html__( 'Vertical menu', 'bascart-essential' );
    }

    static function get_icon() {
        return 'eicon-nav-menu ekit-widget-icon ';
    }

    static function get_categories() {
        return [ 'elementskit_headerfooter' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'vertical-menu/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'vertical-menu/';
    }

}