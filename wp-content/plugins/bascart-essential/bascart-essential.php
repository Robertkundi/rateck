<?php
/*
* Plugin Name: Bascart Essentials
* License - GNU/GPL V2 or Later
* Description: This is a required plugin for Bascart theme.
* Version: 1.0.8
* text domain: bascart-essential
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add language
add_action( 'init', 'bascart_language_load' );
function bascart_language_load(){
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'bascart-essential', false, $plugin_dir );
}

// main class
class Bascart_Essentials_Includes {
      // auto load
    // ----------------------------------------------------------------------------------------
	public function init() {
        $this->_action_init();
        add_action( 'widgets_init', array( __CLASS__, '_action_widgets_init' ) );
    }

    // plugin version
    public static function version() {
        return '1.0.8';
    }


    // directory name to class name, transform dynamically
    // ----------------------------------------------------------------------------------------
	private static function dirname_to_classname( $dirname ) {
		$class_name	 = explode( '-', $dirname );
		$class_name	 = array_map( 'ucfirst', $class_name );
		$class_name	 = implode( '_', $class_name );

		return $class_name;
    }
    

    static function get_input_widgets() {

		$widgets = [
            'vertical-menu',
            'woo-mini-cart',
            'instagram-feed',
            'popup-modal',
            'advanced-tab'
		];

		return $widgets;
	}


    // include and register widgets
    // ----------------------------------------------------------------------------------------
	public static function include_widget( $widgets_manager ) {
        $rel_path = '/widgets';

        foreach(static::get_input_widgets() as $v) {

			$files_handler = self::get_path( $rel_path ) . '/' . $v . '/' . $v . '-handler'. '.php';
			$files = self::get_path( $rel_path ) . '/' . $v . '/' . $v . '.php';

			if(file_exists($files) && file_exists($files_handler)) {
                require $files_handler;
                require $files;
                
				$class_name = self::dirname_to_classname($v);
                $class_name = '\Elementor\ElementsKit_Widget_' . $class_name;

                if(class_exists($class_name)){
                    $widgets_manager->register_widget_type(new $class_name());
                }
			}
		}
	}

    // directory path for widgets
    // ----------------------------------------------------------------------------------------
	public static function widget_dir() {
		return plugin_dir_path( __FILE__ ) . 'includes/widgets/';
    }

      // include shopengine widgets
    // ----------------------------------------------------------------------------------------
    public function include_shopengine_widgets($list) {
		$widget_list = [ 
			'product-filters'          => [
				'slug'    => 'product-filters',
				'title'   => esc_html__( 'Product Filters', 'bascart-essential'),
				'package' => 'free',
			],
		];

		return array_merge( $list, array_map(function($v){
			$v['path'] = self::widget_dir() . $v['slug'] . '/';

			return $v;
		}, $widget_list)); 
    }
    
    // include method
    // ----------------------------------------------------------------------------------------
	public static function include_isolated( $path ) {
        include $path;
	}

    // directory path for theme core
    // ----------------------------------------------------------------------------------------
	private static function get_path( $append = '' ) {
		$path = plugin_dir_path( __FILE__ ) . 'includes';
		return $path . $append;
    }

    static function plugin_url(){
        return trailingslashit(plugin_dir_url( __FILE__ ));
    }

        // include and register widgets
    // ----------------------------------------------------------------------------------------
	public static function include_widgets( $widget_dir ) {
        $rel_path = '/widgets';
        $path = self::get_path( $rel_path ) . '/' . $widget_dir;
        if ( file_exists( $path ) ) {
            self::include_isolated( $path . '/widget-class.php' );
        }

		register_widget( 'Bascart_' . self::dirname_to_classname( $widget_dir ) );
	}

    // include widgets
    // ----------------------------------------------------------------------------------------
	public static function _action_widgets_init() {
        self::include_widgets('recent-post');
    }

    // include files
    // ----------------------------------------------------------------------------------------
	public function _action_init() {
        self::include_isolated( self::get_path('/post-type/post-class.php') );
        self::include_isolated( self::get_path('/hooks/global.php') );

        add_action('elementskit/loaded', function(){
            if(!in_array('elementskit/elementskit.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
                add_action('elementor/widgets/widgets_registered', array($this, 'include_widget'));
                add_filter( 'elementskit/core/package_type', function($package_type){
                    return 'bascart-essential';
                });
            }
        });

        add_action( 'wp_enqueue_scripts', [$this, 'frontend_js']);
        add_action( 'wp_enqueue_scripts', [$this, 'frontend_css'], 99 );
        add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'elementor_js'] );
        add_filter( 'shopengine/widgets/list', [$this, 'include_shopengine_widgets'], 10, 1);
        
    }

    public function elementor_js() {
        wp_enqueue_script( 'bascart-essential-widget-scripts', static::plugin_url() . 'includes/assets/js/elementor.js',array( 'jquery', 'elementor-frontend', 'elementskit-elementor' ), '1.0', true );
    }

    public function frontend_js() {
        if(is_admin()){
            return;
        }
        // your normal frontend js goes here
    }

    public function frontend_css() {
        if(!is_admin()){
            wp_enqueue_style( 'bascart-essential-widget-styles', static::plugin_url() . 'includes/assets/css/bascart-essentials-widget-styles.css', ['ekit-widget-styles'], '1.0' );
        };
    }
}

(new Bascart_Essentials_Includes())->init();

include 'modules/init.php';

// bascart Copyright shortcode
function bascart_footer_shortcode( $atts ) {

    $atts = shortcode_atts(
        array(
            'text' => 'Copyright &copy; {year} bascart. All Right Reserved.'
        ), $atts, 'bascart_footer' );

    $copyright_text = str_replace(['{year}'], [ date('Y')], $atts['text']);
    return esc_html( $copyright_text );
}

add_shortcode('bascart_footer', 'bascart_footer_shortcode');