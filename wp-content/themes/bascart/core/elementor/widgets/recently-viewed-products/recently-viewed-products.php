<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Bascart_Recently_Viewed_Products extends Widget_Base {
    use \Bascart\Core\Helpers\Classes\Product_Controls;

    public $base;

    public function get_name() {
        return 'recently-viewed-products';
    }

    public function get_title() {

        return esc_html__( 'Recently Viewed Products', 'bascart' );

    }

    public function get_icon() {
        return 'eicon-spacer';
    }

    public function get_categories() {
        return [ 'bascart-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'bascart'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->product_genreral_controls();

        $this->end_controls_section();

        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->product_settings_controls([
            'badge',
            'hover',
        ]);

        $this->end_controls_section();

        /**
         * @params - These are common style sections: wrapper, badge, image, category, title, rating, price, description, cart
         */
        $this->product_common_style([
            'wrapper',
            'badge',
            'image',
            'hover'
        ]);
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

        if(!empty($settings['ajax_load']) && $settings['ajax_load'] == 'yes'){
            echo '<div class="bascart-loader">'. esc_html__('Loading...', 'bascart') .'<div class="bascart-loader-circle"></div></div>';
            return;
        }

        $tpl = get_widget_template($this->get_name());
        if(file_exists($tpl)){
            include $tpl;
        }
    }
    protected function content_template() { }
}