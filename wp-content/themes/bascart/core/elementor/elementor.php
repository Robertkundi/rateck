<?php
if(!defined('ABSPATH')) {
	exit;
}

class Bascart_Shortcode {

	/**
	 * Holds the class object.
	 *
	 * @since 1.0
	 *
	 */
	public static $_instance;


	/**
	 * Localize data array
	 *
	 * @var array
	 */
	public $localize_data = array();

	/**
	 * Load Construct
	 *
	 * @since 1.0
	 */

	public function __construct() {
		$this->init();
	}


	public function init() {
		if(!function_exists('is_plugin_active')) {
			include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		}

		add_action('elementor/init', array($this, 'bascart_elementor_init'));
		add_action('elementor/controls/controls_registered', array($this, 'bascart_icon_pack'), 11);
		add_action('elementor/controls/controls_registered', array($this, 'bascart_elementor_init'), 11);
		add_action('elementor/widgets/widgets_registered', array($this, 'bascart_shortcode_elements'));

		if(defined('ELEMENTOR_VERSION')) {
			add_action('elementor/frontend/before_enqueue_scripts', array($this, 'enqueue_scripts'));
		} else {
			add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		}
		add_action('elementor/preview/enqueue_styles', array($this, 'preview_enqueue_scripts'));

		// elemntor icon load
		$this->Bascart_elementor_icon_pack();
	}

	public function Bascart_elementor_icon_pack() {

		$this->__generate_font();

		add_filter('elementor/icons_manager/additional_tabs', [$this, '__add_font']);

	}

	public function __generate_font() {
		global $wp_filesystem;

		require_once(ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
		$css_file = BASCART_CSS_DIR . '/public/icon.css';

		if($wp_filesystem->exists($css_file)) {
			$css_source = $wp_filesystem->get_contents($css_file);
		} // End If Statement

		preg_match_all("/\.(xts-.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0);
		$iconList = [];

		foreach($matches as $match) {
			$new_icons[$match[1]] = str_replace('xts-', '', $match[1]);
			$iconList[]           = str_replace('xts-', '', $match[1]);
		}

		$icons        = new \stdClass();
		$icons->icons = $iconList;
		$icon_data    = json_encode($icons);

		$file = BASCART_THEME_DIR . '/assets/js/public/icon.js';

		global $wp_filesystem;
		require_once(ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
		if($wp_filesystem->exists($file)) {
			$content = $wp_filesystem->put_contents($file, $icon_data);
		}

	}

	public static function bascart_get_instance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new Bascart_Shortcode();
		}

		return self::$_instance;
	}

	/**
	 * Enqueue Scripts
	 *
	 * @return void
	 */

	public function enqueue_scripts() {
		$dependency = ['jquery'];

		if(defined('ELEMENTOR_VERSION')) {
			array_push($dependency, 'elementor-frontend');
		}
		wp_enqueue_script('fontfaceobserver', BASCART_JS . '/public/fontfaceobserver.js', array(), true, true);
		wp_enqueue_script('bascart-main-scripts', BASCART_JS . '/public/scripts.js', $dependency, BASCART_VERSION, true);

		wp_localize_script(
			'bascart-main-scripts',
			'bascart_object',
			array(
				'ajax_url'     => admin_url('admin-ajax.php'),
				'nonce'        => wp_create_nonce('ajax-nonce'),
				'loading_text' => esc_html__('Loading...', 'bascart')
			)
		);

		$global_body_font   = json_decode(bascart_option('body_font'), true);
		$heading_font_one   = json_decode(bascart_option('heading_font_one'), true);
		$heading_font_two   = json_decode(bascart_option('heading_font_two'), true);
		$heading_font_three = json_decode(bascart_option('heading_font_three'), true);
		$heading_font_four  = json_decode(bascart_option('heading_font_four'), true);
		$heading_font_five  = json_decode(bascart_option('heading_font_five'), true);
		$heading_font_six   = json_decode(bascart_option('heading_font_six'), true);

		$font_list = [
			$global_body_font['family'],
			$heading_font_one['family'],
			$heading_font_two['family'],
			$heading_font_three['family'],
			$heading_font_four['family'],
			$heading_font_five['family'],
			$heading_font_six['family'],
		];

		wp_add_inline_script('bascart-main-scripts', 'var fontList = ' . wp_json_encode($font_list), 'before');
	}

	/**
	 * Enqueue editor styles
	 *
	 * @return void
	 */

	public function preview_enqueue_scripts() {

		wp_enqueue_style('bascart-elementor-editor', BASCART_CSS . '/public/editor.css', null, BASCART_VERSION);
	}

	/**
	 * Elementor Initialization
	 *
	 * @since 1.0
	 *
	 */

	public function bascart_elementor_init() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'bascart-elements',
			[
				'title' => esc_html__('Bascart', 'bascart'),
				'icon'  => 'fas fa-plug',
			],
			1
		);
	}

	public function bascart_shortcode_elements($widgets_manager) {
		foreach($this->get_input_widgets() as $v) {

			if(($v == "advanced-slider" || $v == "filterable-product-list") && (!is_plugin_active('elementskit-lite/elementskit-lite.php') && !is_plugin_active('elementskit/elementskit.php'))) {
				return;
			}

			$files = BASCART_CORE . '/elementor/widgets/' . $v . '/' . $v . '.php';

			// devm_print($files);

			if(file_exists($files)) {
				require $files;

				$class_name = '\Elementor\Bascart_' . self::make_classname($v);

				if(class_exists($class_name)) {
					$widgets_manager->register_widget_type(new $class_name());
				}
			}
		}
	}

	// elementor icon fonts loaded

	public function get_input_widgets() {

		$widgets = [
			'filterable-product-list',
			'product-category',
			'logo',
			'recently-viewed-products',
			'advanced-slider',
			'brands',
			'deal-products',
			'product-list',
			'product-grid',
			'category-slider',
			'slider-product',
			'back-to-top',
			'offer-slider',
			'news-ticker',
			'user-icon',
			'related-products',
			'wishlist-counter',
			'product-slider',
			'vendor-grid',
			'multi-vendor-products'
		];

		return $widgets;
	}

	public static function make_classname($dirname) {
		$dirname    = pathinfo($dirname, PATHINFO_FILENAME);
		$class_name = explode('-', $dirname);
		$class_name = array_map('ucfirst', $class_name);
		$class_name = implode('_', $class_name);

		return $class_name;
	}

	/**
	 * Extend Icon pack core controls.
	 *
	 * @param object $controls_manager Controls manager instance.
	 * @return void
	 */

	public function bascart_icon_pack($controls_manager) {

		require_once BASCART_CORE . '/elementor/controls/icon.php';

		$controls = array(
			$controls_manager::ICON => 'Bascart_Icon_Controler',
		);

		foreach($controls as $control_id => $class_name) {
			$controls_manager->unregister_control($control_id);
			$controls_manager->register_control($control_id, new $class_name());
		}

	}

	public function __add_font($font) {
		$font_new['icon-electionify'] = [
			'name'          => 'icon-bascart',
			'label'         => esc_html__('Bascart Icons', 'bascart'),
			'url'           => BASCART_CSS . '/public/icon.css',
			'enqueue'       => [BASCART_CSS . '/public/icon.css'],
			'prefix'        => 'xts-',
			'displayPrefix' => 'xts-icon',
			'labelIcon'     => 'xts-icon xts-layer',
			'ver'           => '5.9.1',
			'fetchJson'     => BASCART_JS . '/public/icon.js',
			'native'        => true,
		];

		return array_merge($font, $font_new);
	}


}

Bascart_Shortcode::bascart_get_instance();
