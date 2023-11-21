<?php
$title_length = $settings['title_character'];
$column_class = $settings['column_class'];
$widget_id    = $settings['widget_id'];
$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container'; 
?>
<div class="container woocommerce">
    <div class="row">
		<?php
		$args = array(
			'post_type'      => 'product',
			'meta_query'     => array(
				array(
					'key'     => '_sale_price_dates_to',
					'value'   => '',
					'compare' => '!='
				),
			),
			'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 6,
			'order'          => isset($settings['product_order']) ? $settings['product_order'] : 'DESC',
			'orderby'        => isset($settings['product_orderby']) ? $settings['product_orderby'] : 'date',
		);

		if($settings['product_by'] == 'category') {
			$args['tax_query'] = [
				[
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => !empty($settings['term_list']) ? $settings['term_list'] : [],
				],
			];
		}

		if($settings['product_by'] == 'product') {
			$args['post__in'] = !empty($settings['deal_product_list']) ? $settings['deal_product_list'] : [];
		}
		$query = get_posts($args);
		if(!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') : ?>
            <div class="<?php echo esc_attr($swiper_class); ?>">
                <div class="swiper-wrapper">
					<?php foreach($query as $post) : ?>
                        <div class="swiper-slide">
							<?php bascart_multivendor_product_loop($post->ID, $title_length); ?>
                        </div>
					<?php endforeach; ?>
                </div>

                <!-- next / prev arrows -->
                <div class="swiper-button-next swiper-next-<?php echo esc_attr($widget_id); ?>">
					<?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
                </div>
                <div class="swiper-button-prev swiper-prev-<?php echo esc_attr($widget_id); ?>">
					<?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
                </div>
            </div>
		<?php else : foreach($query as $post) : ?>
            <div class="<?php echo esc_attr($column_class); ?>">
				<?php bascart_multivendor_product_loop($post->ID, $title_length); ?>
            </div>
		<?php
		endforeach;
		endif; ?>
    </div>
</div>