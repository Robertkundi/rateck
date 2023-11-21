<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * A Font Icon select box.
 *
 * @property array $icons   A list of font-icon classes. [ 'class-name' => 'nicename', ... ]
 *                          Default Font Awesome icons. @see Control_Icon::get_icons().
 * @property array $include list of classes to include form the $icons property
 * @property array $exclude list of classes to exclude form the $icons property
 *
 * @since 1.0.0
 */
class Bascart_Icon_Controler extends Elementor\Base_Data_Control {

	public function get_type() {
		return 'icon';
	}

	/**
	 * Get icons list
	 *
	 * @return array
	 */

	public static function get_icons() {

		$icons = array(
			'xts-icon xts-delivery' => 'xts-icon xts-delivery',
			'xts-icon xts-faqs' => 'xts-icon xts-faqs',
			'xts-icon xts-map' => 'xts-icon xts-map',
			'xts-icon xts-message' => 'xts-icon xts-message',
			'xts-icon xts-phone' => 'xts-icon xts-phone',
			'xts-icon xts-return' => 'xts-icon xts-return',
			'xts-icon xts-user' => 'xts-icon xts-user',
			'xts-icon xts-quote-left' => 'xts-icon xts-quote-left',
			'xts-icon xts-heart-fill' => 'xts-icon xts-heart-fill',
			'xts-icon xts-four-column' => 'xts-icon xts-four-column',
			'xts-icon xts-one-column' => 'xts-icon xts-one-column',
			'xts-icon xts-three-column' => 'xts-icon xts-three-column',
			'xts-icon xts-two-column' => 'xts-icon xts-two-column',
			'xts-icon xts-wallet' => 'xts-icon xts-wallet',
			'xts-icon xts-wave' => 'xts-icon xts-wave',
			'xts-icon xts-bag' => 'xts-icon xts-bag',
			'xts-icon xts-eye-ware' => 'xts-icon xts-eye-ware',
			'xts-icon xts-flippers' => 'xts-icon xts-flippers',
			'xts-icon xts-shoes' => 'xts-icon xts-shoes',
			'xts-icon xts-shorts' => 'xts-icon xts-shorts',
			'xts-icon xts-quote_icon' => 'xts-icon xts-quote_icon',
			'xts-icon xts-arrow-left' => 'xts-icon xts-arrow-left',
			'xts-icon xts-arrow-right' => 'xts-icon xts-arrow-right',
			'xts-icon xts-author' => 'xts-icon xts-author',
			'xts-icon xts-category' => 'xts-icon xts-category',
			'xts-icon xts-chevron-left' => 'xts-icon xts-chevron-left',
			'xts-icon xts-chevron-right' => 'xts-icon xts-chevron-right',
			'xts-icon xts-date' => 'xts-icon xts-date',
			'xts-icon xts-search' => 'xts-icon xts-search',
			'xts-icon xts-drive' => 'xts-icon xts-drive',
			'xts-icon xts-eye' => 'xts-icon xts-eye',
			'xts-icon xts-gift' => 'xts-icon xts-gift',
			'xts-icon xts-uniE90C' => 'xts-icon xts-uniE90C',
			'xts-icon xts-uniE90D' => 'xts-icon xts-uniE90D',
			'xts-icon xts-uniE90E' => 'xts-icon xts-uniE90E',
			'xts-icon xts-uniE90F' => 'xts-icon xts-uniE90F',
			'xts-icon xts-uniE910' => 'xts-icon xts-uniE910',
			'xts-icon xts-uniE911' => 'xts-icon xts-uniE911',
			'xts-icon xts-uniE912' => 'xts-icon xts-uniE912',
			'xts-icon xts-heart' => 'xts-icon xts-heart',
			'xts-icon xts-law_firm' => 'xts-icon xts-law_firm',
			'xts-icon xts-layer' => 'xts-icon xts-layer',
			'xts-icon xts-message' => 'xts-icon xts-message',
			'xts-icon xts-uniE917' => 'xts-icon xts-uniE917',
			'xts-icon xts-uniE918' => 'xts-icon xts-uniE918',
			'xts-icon xts-uniE919' => 'xts-icon xts-uniE919',
			'xts-icon xts-power_1' => 'xts-icon xts-power_1',
			'xts-icon xts-question' => 'xts-icon xts-question',
			'xts-icon xts-tags' => 'xts-icon xts-tags',
			'xts-icon xts-target' => 'xts-icon xts-target',
			'xts-icon xts-truck_1' => 'xts-icon xts-truck_1',
			'xts-icon xts-user' => 'xts-icon xts-user',
			'xts-icon xts-swim' => 'xts-icon xts-swim',
			'xts-icon xts-arrow_left' => 'xts-icon xts-arrow_left',
			'xts-icon xts-arrow_left_fill' => 'xts-icon xts-arrow_left_fill',
			'xts-icon xts-arrow_right' => 'xts-icon xts-arrow_right',
			'xts-icon xts-arrow_right_fill' => 'xts-icon xts-arrow_right_fill',
			'xts-icon xts-arrow_top' => 'xts-icon xts-arrow_top',
			'xts-icon xts-briefcase' => 'xts-icon xts-briefcase',
			'xts-icon xts-card' => 'xts-icon xts-card',
			'xts-icon xts-cart' => 'xts-icon xts-cart',
			'xts-icon xts-uniE929' => 'xts-icon xts-uniE929',
			'xts-icon xts-uniE92A' => 'xts-icon xts-uniE92A',
			'xts-icon xts-uniE92B' => 'xts-icon xts-uniE92B',
			'xts-icon xts-check_box' => 'xts-icon xts-check_box',
			'xts-icon xts-compare' => 'xts-icon xts-compare',
			'xts-icon xts-alarmclock' => 'xts-icon xts-alarmclock',
			'xts-icon xts-avocado' => 'xts-icon xts-avocado',
			'xts-icon xts-biscuit' => 'xts-icon xts-biscuit',
			'xts-icon xts-bread' => 'xts-icon xts-bread',
			'xts-icon xts-cake' => 'xts-icon xts-cake',
			'xts-icon xts-camaramic' => 'xts-icon xts-camaramic',
			'xts-icon xts-car3' => 'xts-icon xts-car3',
			'xts-icon xts-cart4' => 'xts-icon xts-cart4',
			'xts-icon xts-cart6' => 'xts-icon xts-cart6',
			'xts-icon xts-chicken' => 'xts-icon xts-chicken',
			'xts-icon xts-clipboard' => 'xts-icon xts-clipboard',
			'xts-icon xts-compare5' => 'xts-icon xts-compare5',
			'xts-icon xts-home2' => 'xts-icon xts-home2',
			'xts-icon xts-imac' => 'xts-icon xts-imac',
			'xts-icon xts-laptop' => 'xts-icon xts-laptop',
			'xts-icon xts-location' => 'xts-icon xts-location',
			'xts-icon xts-lovetag' => 'xts-icon xts-lovetag',
			'xts-icon xts-milk' => 'xts-icon xts-milk',
			'xts-icon xts-minitrack' => 'xts-icon xts-minitrack',
			'xts-icon xts-offer' => 'xts-icon xts-offer',
			'xts-icon xts-office' => 'xts-icon xts-office',
			'xts-icon xts-security' => 'xts-icon xts-security',
			'xts-icon xts-tea' => 'xts-icon xts-tea',
			'xts-icon xts-user3' => 'xts-icon xts-user3',
			'xts-icon xts-view' => 'xts-icon xts-view',
			'xts-icon xts-watchtab' => 'xts-icon xts-watchtab',
			'xts-icon xts-bag-solid' => 'xts-icon xts-bag-solid',
			'xts-icon xts-bag-alt' => 'xts-icon xts-bag-alt',
			'xts-icon xts-circle' => 'xts-icon xts-circle',
			'xts-icon xts-comment' => 'xts-icon xts-comment',
			'xts-icon xts-envelope-open' => 'xts-icon xts-envelope-open',
			'xts-icon xts-facebook' => 'xts-icon xts-facebook',
			'xts-icon xts-headphones-alt' => 'xts-icon xts-headphones-alt',
			'xts-icon xts-instagram' => 'xts-icon xts-instagram',
			'xts-icon xts-linkedin' => 'xts-icon xts-linkedin',
			'xts-icon xts-long-arrow' => 'xts-icon xts-long-arrow',
			'xts-icon xts-minus' => 'xts-icon xts-minus',
			'xts-icon xts-pinterest' => 'xts-icon xts-pinterest',
			'xts-icon xts-reddit' => 'xts-icon xts-reddit',
			'xts-icon xts-tiktok' => 'xts-icon xts-tiktok',
			'xts-icon xts-twitter' => 'xts-icon xts-twitter',
			'xts-icon xts-plus' => 'xts-icon xts-plus',
			'xts-icon xts-arrow-down' => 'xts-icon xts-arrow-down',
			'xts-icon xts-arrow-up' => 'xts-icon xts-arrow-up',
			'xts-icon xts-times' => 'xts-icon xts-times',
			'xts-icon xts-chevron-down' => 'xts-icon xts-chevron-down',
			'xts-icon xts-chevron-up' => 'xts-icon xts-chevron-up',
			'xts-icon xts-play-solid' => 'xts-icon xts-play-solid',
			'xts-icon xts-expand' => 'xts-icon xts-expand',
			'xts-icon xts-check-solid' => 'xts-icon xts-check-solid',
			'xts-icon xts-phone-2' => 'xts-icon xts-phone-2',
			'xts-icon xts-dot_menu' => 'xts-icon xts-dot_menu',
			'xts-icon xts-email-2' => 'xts-icon xts-email-2',
			'xts-icon xts-feature_icon1' => 'xts-icon xts-feature_icon1',
			'xts-icon xts-feature_icon2' => 'xts-icon xts-feature_icon2',
			'xts-icon xts-feature_icon3' => 'xts-icon xts-feature_icon3',
			'xts-icon xts-feature_icon4' => 'xts-icon xts-feature_icon4'
		);

		return $icons;
	}

	/**
	 * Retrieve icons control default settings.
	 *
	 * Get the default settings of the icons control. Used to return the default
	 * settings while initializing the icons control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */

	protected function get_default_settings() {
		return [
			'options' => self::get_icons(),
		];
	}

	/**
	 * Render icons control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function content_template() {
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">

				<select class="elementor-control-icon" data-setting="{{ data.name }}" data-placeholder="<?php esc_attr_e( 'Select Icon', 'bascart' ); ?>">

					<option value=""><?php esc_html_e( 'Select Icon', 'bascart' ); ?></option>
					<# _.each( data.options, function( option_title, option_value ) { #>
					<option value="{{ option_value }}">{{{ option_title }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{ data.description }}</div>
		<# } #>
		<?php
	}

}
