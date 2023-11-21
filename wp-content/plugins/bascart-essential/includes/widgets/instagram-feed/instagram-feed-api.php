<?php

namespace ElementsKit\Widgets\Instagram_Feed;

use Elementor\ElementsKit_Widget_Instagram_Feed_Handler;
use ElementsKit\Libs\Framework\Attr;
use ElementsKit_Lite\Core\Handler_Api;

defined('ABSPATH') || exit;

class Instagram_Feed_Api extends Handler_Api {

	public function config() {

		$this->prefix = 'widget/instagram-feed';
	}


	public function post_remove_cache() {

		$data = $this->request->get_params();
		$idd = sanitize_key($data['provider_id']);

		if($idd == 'instagram_feed') {

			if(empty($data['instragram']['user_id'])) {

				return [
					'success' => false,
					'msg'     => esc_html__('No user id found!', 'bascart-essential'),
				];
			}

			$trans_key = ElementsKit_Widget_Instagram_Feed_Handler::get_transient_key($data['instragram']['user_id']);

			if(delete_transient($trans_key)) {

				return [
					'success' => true,
					'msg'     => esc_html__('Successfully cleaned', 'bascart-essential'),
				];
			}

			return [
				'success' => false,
				'msg'     => esc_html__('Cache not found!', 'bascart-essential'),
			];
		}

		return [
			'success' => false,
			'msg'     => esc_html__('Unknown provider key', 'bascart-essential'),
		];
	}
}
