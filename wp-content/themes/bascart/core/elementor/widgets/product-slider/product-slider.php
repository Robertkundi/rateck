<?php
namespace Elementor;
use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Bascart_Product_Slider extends Widget_Base {
    use \Bascart\Core\Helpers\Classes\Product_Controls;

    public $base;

    public function get_name() {
        return 'product-slider';
    }

    public function get_title() {

        return esc_html__( 'Product Slider', 'bascart' );

    }

    public function get_icon() {
        return 'eicon-product-stock';
    }

    public function get_categories() {
        return [ 'bascart-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__('General', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'product_by',
            [
                'label' => esc_html__( 'Show product by', 'bascart' ),
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
                'type' => ElementsKit_Controls_Manager::AJAXSELECT2,
                'options'   => 'ajaxselect2/product_cat',
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
        $this->add_control(
            'products_per_page',
            [
                'label' => esc_html__('Products Per Page', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'default'   => (isset($default['page']) ? esc_attr($default['page']) : 6),
            ]
        );
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
        $this->end_controls_section();

        /* 
            Slider Controls start
        */
        $this->start_controls_section(
            'slider-settings',
            [
                'label' => esc_html__('Slider Setting', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'bascart' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bascart' ),
                'label_off' => esc_html__( 'No', 'bascart' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' => esc_html__('Slides to Show', 'bascart'),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
                'mobile_default' => '1',
                'tablet_default' => '2',
                'min' => 1,
                'max' => 50,
                'step' => 1,
                'description' => esc_html__('Number of slides to be visible in the slider.', 'bascart')
            ]
        );

        $this->add_control(
            'slider_autoplay_delay',
            [
                'label' => esc_html__( 'Autoplay Delay', 'bascart' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1500,
                'condition' =>["slider_autoplay"=>["yes"] ]
            ]
        );
        $this->add_control(
            'slider_loop',
            [
                'label' => esc_html__( 'Loop', 'bascart' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bascart' ),
                'label_off' => esc_html__( 'No', 'bascart' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' =>["slider_autoplay"=>["yes"] ]
            ]
        );
        $this->add_control(
            'slider_space_between',
            [
                'label'         => esc_html__('Slider Item Space', 'bascart'),
                'type'          => Controls_Manager::NUMBER,
                'return_value'  => 'yes',
                'default'       => 30
            ]
        );

        
        $this->add_control(
            'show_navigation',
            [
                'label'       => esc_html__('Show Navigation', 'bascart'),
                'type'        => Controls_Manager::SWITCHER,
                'label_on'    => esc_html__('Yes', 'bascart'),
                'label_off'   => esc_html__('No', 'bascart'),
                'default'     => 'yes'
            ]
        );


        $this->add_control(
			'left_arrow_icon',
			[
				'label' => esc_html__( 'Left Arrow Icon', 'bascart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'xts-icon xts-chevron-left',
					'library' => 'solid',
				]
			]
		);
        $this->add_control(
			'right_arrow_icon',
			[
				'label' => esc_html__( 'Right Arrow Icon', 'bascart' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'xts-icon xts-chevron-right',
					'library' => 'solid',
				]
			]
		);
        $this->end_controls_section();
        /* 
            --------------------------------
            Product settings start
            --------------------------------
        */
        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Product Settings', 'bascart'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
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
        $this->product_settings_controls(['title', 'price', 'category', 'swatches']);
        $this->end_controls_section();
        $this->slider_navigation_pagination_controls(['navigation']);
        // Widget common style
        $this->product_common_style([
            'wrapper',
            'image',
            'category',
            'hover',
            'title',
            'price',
            'cart',
            'quicview',
            'comparison',
            'item_style2',
            'color_swatch'
        ]);
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();
	    $settings['widget_id'] = $this->get_id();
        ?>
            <div class="bascart-<?php echo esc_attr($this->get_name()); ?>"  data-widget_settings='<?php echo json_encode($settings); ?>'>
                <?php $this->render_raw(); ?>
            </div>
        <?php
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();

        // Get the template file from ../templates/product-slider
        $tpl = get_widget_template($this->get_name());
        if(file_exists($tpl)){
            include $tpl;
        }
    }
    protected function content_template() { }
}