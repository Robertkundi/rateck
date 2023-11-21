<?php
$style = $settings['deal_style'];
$title_crop = $settings['title_character'];
$show_color_swatches = $settings['show_color_swatches'];
$widget_id = $settings['widget_id'];
$slider_loop = $settings['ts_slider_loop'];
$slider_autoplay = $settings['ts_slider_autoplay'];
$slider_speed = $settings['ts_slider_speed'];
$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
?>
<div class="container woocommerce">
    <div class="row bascart-deal-products-wrap bascart-deal-products <?php echo esc_attr($style) ?>">
        <!-- <div class="row"> -->
		<?php

		  $args = array(
			'post_type' => ['product', 'product_variation'],
			'status'    => 'publish',
			'meta_query' => array(
				array(
					'key'     => '_sale_price_dates_to',
					'value' => time(),
					'compare' => '>'
				),
				array(
					'key'     => '_sale_price',
					'value' => 0,
					'compare' => '>'
				),
			),
			'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 4,
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

		$view = [
			'image',
			'category',
			'title',
			'price',
			'progress'
		];
		if(!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') :
		?>
        <div class="<?php echo esc_attr($swiper_class); ?>">
            <div class="swiper-wrapper"> <?php
				$settings['column_class'] = 'swiper-slide';
				endif;


				if($style == 'style2') {
					$files = BASCART_CORE . '/elementor/templates/content-parts/product-content2.php';
					if(file_exists($files)) {
						require $files;
					}
				} else {
					$query = get_posts($args);
					foreach($query as $post) {
						if(!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') :
							?>
                            <div class="swiper-slide">
						<?php endif; ?>
						<?php bascart_woocommerce_loop_item($post->ID, $title_crop, '', '', '', '', '', $show_color_swatches); ?>
						<?php if(!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') : ?>
                            </div>
						<?php endif; ?>
						<?php
					}
				}

				?>
            </div>
        </div>

		<?php if(!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') : ?>
            <!-- next / prev arrows -->
            <div class="swiper-button-next swiper-next-<?php echo esc_attr($widget_id); ?>">
				<?php \Elementor\Icons_Manager::render_icon($settings['right_arrow_icon'], ['aria-hidden' => 'true']); ?>
            </div>
            <div class="swiper-button-prev swiper-prev-<?php echo esc_attr($widget_id); ?>">
				<?php \Elementor\Icons_Manager::render_icon($settings['left_arrow_icon'], ['aria-hidden' => 'true']); ?>
            </div>
		<?php endif;
		?>
        <!-- </div> -->
    </div>
</div>