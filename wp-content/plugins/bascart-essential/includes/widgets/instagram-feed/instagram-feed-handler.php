<?php

namespace Elementor;

use ElementsKit\Libs\Framework\Attr;


class ElementsKit_Widget_Instagram_Feed_Handler extends \ElementsKit_Lite\Core\Handler_Widget {

	protected static $transient_name = 'ekit_instagram_cached_data';

	public function wp_init() {

		include(self::get_dir() . 'classes/settings.php');

		(new \ElementsKit\Widgets\Instagram_Feed\Instagram_Feed_Api());
	}

	static function get_name() {
		return 'elementskit-instagram-feed';
	}

	static function get_title() {
		return esc_html__('Instagram Feed', 'bascart-essential');
	}

	static function get_icon() {
		return 'ekit ekit-instagram ekit-widget-icon ';
	}

	static function get_categories() {
		return ['elementskit'];
	}

	static function get_dir() {
		return \ElementsKit::widget_dir() . 'instagram-feed/'; 
	}

	static function get_url() {
		return \ElementsKit::widget_url() . 'instagram-feed/';
	}


	public static function get_data() {

		$user_id = (function_exists('bascart_option'))? bascart_option('instagram_client_id'): '';

		$username = (function_exists('bascart_option'))? bascart_option('instagram_username'): '';

		$token = (function_exists('bascart_option'))? bascart_option('instagram_secret_key'): '';

		return [
			'user_id'  => $user_id,
			'token'    => $token,
			'username' => $username,
		];
	}

	public static function get_user_info() {

		$token = (function_exists('bascart_option'))? bascart_option('instagram_secret_key'): '';
		$user_id = (function_exists('bascart_option'))? bascart_option('instagram_client_id'): '';

		$trans_key = self::get_transient_key_for_user($user_id);

		$cache_data = get_transient($trans_key);

		if(false === $cache_data) {

			$feed = self::call_api_for_user_details($user_id, $token);

			set_transient($trans_key, $feed, 86400 * 2); // set expire time to 48 hours

			return $feed;
		}

		return $cache_data;
	}

	public static function get_transient_key($uid) {

		return 'ekit_instagram_cached_data_' . md5($uid);
	}

	public static function get_transient_key_for_user($uid) {

		return 'ekit_insta_cache_user_info__' . md5($uid);
	}

	public static function get_instagram_feed_from_API() {

		return self::get_cached_data();
	}

	static function get_cached_data() {

		$client_id = (function_exists('bascart_option'))?bascart_option('instagram_client_id'): '';

		if(empty($client_id)) {

			$ret = new \stdClass();
			$msg = new \stdClass();

			$msg->message = esc_html__('User id is not set yet! Please go to settings and set the user id.', 'bascart-essential');
			$ret->error = $msg;

			return $ret;
		}

		$data['instragram']['token'] = (function_exists('bascart_option'))?bascart_option('instagram_secret_key'): '';

		if(empty($data['instragram']['token'])) {

			$ret = new \stdClass();
			$msg = new \stdClass();

			$msg->message = esc_html__('Access token is not set yet! Please go to settings and set the access token.', 'bascart-essential');
			$ret->error = $msg;

			return $ret;
		}

		$user_id = bascart_option('instagram_client_id');
		$trans_key = self::get_transient_key($user_id);

		$cache_data = get_transient($trans_key);

		if(false === $cache_data) {

			$api_key = (function_exists('bascart_option'))? bascart_option('instagram_secret_key'): '';

			$feed = self::call_api($api_key);

			set_transient($trans_key, $feed, 86400); // set expire time to 24 hours

			return $feed;
		}

		return $cache_data;
	}

	public static function call_api($access_token) {

		$url = 'https://graph.instagram.com/me/media?fields=id,media_type,media_url,username,timestamp&access_token=' . $access_token;

		$c_con = curl_init();

		curl_setopt($c_con, CURLOPT_URL, $url);
		curl_setopt($c_con, CURLOPT_RETURNTRANSFER, true);

		$feed = curl_exec($c_con);
		curl_close($c_con);

		$response = json_decode($feed);

		return $response;
	}

	public static function call_api_for_user_details($uid, $token) {

		$fld[] = 'id';
		$fld[] = 'username';
		$fld[] = 'profile_picture';

		$url = 'https://graph.instagram.com/'.$uid.'?access_token=' . $token.'&fields='. implode(',', $fld);

		$c_con = curl_init();

		curl_setopt($c_con, CURLOPT_URL, $url);
		curl_setopt($c_con, CURLOPT_RETURNTRANSFER, true);

		$feed = curl_exec($c_con);
		curl_close($c_con);

		$response = json_decode($feed);

		return $response;
	}
}
