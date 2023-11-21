<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (!defined('ABSPATH')) exit;
class Bascart_Product_Grid extends Widget_Base
{
    use \Bascart\Core\Helpers\Classes\Product_Controls;

    public $base;

    public function get_name()
    {
        return 'product-grid';
    }

    public function get_title()
    {

        return esc_html__('Product Grid', 'bascart');
    }

    public function get_icon()
    {
        return 'eicon-products';
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

        $this->product_genreral_controls([
            'defaults'   => [
                'page' => 6,
                'column'    => 'col-md-6 col-lg-3',
                'off'   => ''
            ]
        ]);

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
                'type'      => Controls_Manager::SELECT2,
				'options'   => $this->post_category(),
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

        $this->product_settings_controls([
            'title',
            'price',
            'swatches'
        ]);

        $this->end_controls_section();

        $this->product_common_style([
            'wrapper',
            'image',
            'title',
            'price',
            'quicview',
            'cart',
            'comparison',
            'color_swatch'
        ]);
        // end styles
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

        if(!empty($settings['ajax_load']) && $settings['ajax_load'] == 'yes'){
            echo '<div class="bascart-loader">'. esc_html__('Loading...', 'bascart') .'<div class="bascart-loader-circle"></div></div>';
            return;
        }
        
        $tpl = get_widget_template($this->get_name());
        if (file_exists($tpl)) {
            include $tpl;
        }
    }

    public function post_category(){
        $terms = get_terms(array(
            'taxonomy'    => 'product_cat',
            'hide_empty'  => -1,
            'posts_per_page' => -1,
        ));

        $cat_list = [];
        foreach ($terms as $post) {
            $cat_list[$post->term_id]  = [$post->name];
        }
        return $cat_list;
    }

    protected function content_template()
    {
    }
}
