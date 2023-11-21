<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * hooks for adding google fonts
 */

class Bascart_DEVM_Google_Fonts {

	static private $data = array(
		'subset' => array(),
		'family' => array(),
	);

	public static function add_typography_v2( $value ) {
		$data_value = [];
		if (is_string($value)) {
			$data_value = json_decode($value, true);
		} else {
			$data_value = $value;
		}
		if ( in_array( isset( $data_value[ 'family' ] ), array( true, 'true' ), true ) ) {
			self::$data[ 'family' ][ $data_value[ 'family' ] ][ 'weight' ]	 = true;			
		}
		if ( in_array( isset( $data_value[ 'style' ] ), array( true, 'true' ), true ) ) {
			self::$data[ 'subset' ][ $data_value[ 'style' ] ]= true;
		} 
	}

	public static function clear() {
		self::$data = array();
	}

	public static function generate_url() {
		/**
		 * Example:
		 *
		 * <link href="
		 * https://fonts.googleapis.com/css?
		 * family={Family}|{Family}:{variant},{variant}
		 * &amp;
		 * subset=cyrillic-ext,greek,vietnamese
		 * " rel="stylesheet">
		 */
		if ( empty( self::$data[ 'family' ] ) ) {
			return false;
		}
		$query = array(
			'family' => array(),
			'subset' => implode( ',', array_keys( self::$data[ 'subset' ] ) ),
		);

		foreach ( self::$data[ 'family' ] as $family => $family_data ) {
			if ( !empty( $family ) ) {
				$family_data[ 'variants' ][900] = $family_data[ 'variants' ][700] = $family_data[ 'variants' ][400] = 1;
				$query[ 'family' ][] = $family . ':' . implode( ',', array_keys( $family_data[ 'variants' ] ) );
			}
		}

		$query[ 'family' ] = implode( '|', $query[ 'family' ] );
		$query_add_arg = add_query_arg( 'family', urlencode( $query[ 'family' ] ), "https://fonts.googleapis.com/css" );

		return add_query_arg(array('display'=>'swap'), $query_add_arg);

	}

	public static function output_url() {
		if ( $url = self::generate_url() ):
			?><link href="<?php echo esc_url_raw( $url ) ?>" rel="stylesheet"><?php
		endif;
	}

}

add_action('init', 'bascart_google_fonts_loads');
function bascart_google_fonts_loads(){
	$google_fonts_load = bascart_option('google_fonts_load');
	if($google_fonts_load =='yes'){
		add_action( 'wp_enqueue_scripts', array( 'Bascart_DEVM_Google_Fonts', 'output_url' ), 9999 );
	}
}




