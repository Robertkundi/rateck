<?php
add_action('woocommerce_before_shop_loop', 'bascart_woocommerce_output_all_notices_before', 9);
add_action('woocommerce_before_shop_loop', 'bascart_woocommerce_output_all_notices_after', 11);

function bascart_woocommerce_output_all_notices_before() {
	?>
    <div class="col-12">
	<?php
}

function bascart_woocommerce_output_all_notices_after() {
	?>
    </div>
	<?php
}

add_action('woocommerce_before_shop_loop', 'bascart_shop_loop_before_start', 1);
function bascart_shop_loop_before_start() {
	?>
    <div class="row shop-before-start">
	<?php
}

add_action('woocommerce_before_shop_loop', 'bascart_shop_loop_before_end', 40);
function bascart_shop_loop_before_end() {
	?>
    </div>
	<?php
}


remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_action('woocommerce_before_shop_loop_item_title', 'bascart_template_loop_product_thumbnail', 10);
function bascart_template_loop_product_thumbnail($size = 'woocommerce_thumbnail') {
	global $post, $product;
	$image_size = apply_filters('single_product_archive_thumbnail_size', $size);
	?>
    <div class="shop-loop-thumb">
		<?php
		$product_gallery_ids = $product->get_gallery_image_ids();
		if(isset($product_gallery_ids[1])) {
			$image_url = wp_get_attachment_url($product_gallery_ids[1]);
			?>
            <div class="thumb-hover">
                <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
                    <img src="<?php echo esc_url($image_url); ?>"
                         alt="<?php echo get_the_title($product->get_id()); ?>">
                </a>
            </div> <!-- ./hover-thumb -->
			<?php
		}
		?>
        <div class="wishlist-icon-thumb">
			<?php
			$args = array();
			if($product) {
				$defaults = array(
					'quantity'   => 1,
					'class'      => implode(
						' ',
						array_filter(
							array(
								'button',
								'product_type_' . $product->get_type(),
								$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
								$product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
							)
						)
					),
					'attributes' => array(
						'data-product_id'  => $product->get_id(),
						'data-product_sku' => $product->get_sku(),
						'aria-label'       => $product->add_to_cart_description(),
						'rel'              => 'nofollow',
					),
				);

				$args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

				if(isset($args['attributes']['aria-label'])) {
					$args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
				}

				echo apply_filters(
					'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
					sprintf(
						'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url($product->add_to_cart_url()),
						esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
						esc_attr(isset($args['class']) ? $args['class'] : 'button'),
						isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
						'<i class="xts-icon xts-cart"></i>'
					),
					$product,
					$args
				);
			}
			?>
        </div>
        <a href="<?php echo esc_url(get_permalink()); ?>"
           title="<?php echo get_the_title(); ?>"><?php echo bascart_kses($product) ? $product->get_image($image_size) : ''; ?></a>

		<?php if($product->is_on_sale()) {
			if($product->is_type('variable')) {
				$percentages = array();
				$prices = $product->get_variation_prices('max');

				foreach($prices['price'] as $key => $price) {
					if($prices['regular_price'][$key] !== $price) {
						$percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
					}
				}

				$percentage = max($percentages) . '%';
			} elseif($product->is_type('grouped')) {
				$percentage = '';
			} else {
				$regular_price = (float)$product->get_regular_price();
				$sale_price = (float)$product->get_sale_price();

				if($sale_price != 0 || !empty($sale_price)) {
					$percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
				} else {
					$percentage = '';
				}
			}
			echo apply_filters('woocommerce_sale_flash', '<span class="onsale-percentage">' . $percentage . esc_html__(' OFF', 'bascart') . '</span>', $post, $product); ?>

		<?php } ?>

        <div class="add-to-cart-hover-box">
			<?php
			$args = array();
			if($product) {
				$defaults = array(
					'quantity'   => 1,
					'class'      => implode(
						' ',
						array_filter(
							array(
								'button',
								'product_type_' . $product->get_type(),
								$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
								$product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
							)
						)
					),
					'attributes' => array(
						'data-product_id'  => $product->get_id(),
						'data-product_sku' => $product->get_sku(),
						'aria-label'       => $product->add_to_cart_description(),
						'rel'              => 'nofollow',
					),
				);

				$args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

				if(isset($args['attributes']['aria-label'])) {
					$args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
				}

				echo apply_filters(
					'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
					sprintf(
						'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url($product->add_to_cart_url()),
						esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
						esc_attr(isset($args['class']) ? $args['class'] : 'button'),
						isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
						esc_html($product->add_to_cart_text())
					),
					$product,
					$args
				);
			}
			?>
        </div>
    </div>
	<?php
}

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_action('woocommerce_shop_loop_item_title', 'bascart_template_loop_product_title', 10);
function bascart_template_loop_product_title() {
	global $post, $product;
	?>

	<?php
	// WooCommerce Swatches Options
	if(defined('DEVM')) {
		$show_swatch = bascart_option('show_swatch');
	} else {
		$show_swatch = '';
	}

	?>
    <div class="product-loop-desc">
        <!-- Shopengine color swatches -->
		<?php
		if($show_swatch == 'yes') {
			do_action("shopengine_swatches_anywhere", $product, ['pa_color']);
		}
		?>
		<?php
		$product_categories = get_the_terms(get_the_ID(), 'product_cat');
		if(!empty($product_categories)) { ?>
            <ul class="product-categories">
				<?php
				foreach($product_categories as $key => $term) {
					if($key == 1) {
						break;
					} ?>
                    <li>
                        <a href="<?php echo esc_url(get_term_link($term->term_id, 'product_cat')); ?>"><?php echo esc_html($term->name); ?></a>
                    </li>
				<?php } ?>
            </ul>
		<?php } ?>
        <h3 class="product-title"><a href="<?php echo esc_url(get_permalink()); ?>"
                                     title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>

		<?php if($product->get_price_html()) { ?>
            <span class="product-price">
                <?php echo bascart_kses($product->get_price_html()); ?>
            </span>
		<?php } ?>

    </div>
	<?php
}

function wpuf_woo_product_gallery($post_id) {
	if(isset($_POST['wpuf_files']['_product_image'])) {
		$images = get_post_meta($post_id, '_product_image');
		update_post_meta($post_id, '_product_image_gallery', implode(',', $images));
	}
}

add_action('wpuf_add_post_after_insert', 'wpuf_woo_product_gallery');
add_action('wpuf_edit_post_after_update', 'wpuf_woo_product_gallery');

/*
 * Bascart product loop buttons
 * */
function bascart_product_loop_buttons($product_id) {
	?>
    <div class="add-to-cart-hover-box">
		<?php
		$args = [];
		$product = wc_get_product($product_id);
		if($product) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

			if(isset($args['attributes']['aria-label'])) {
				$args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
			}

			echo apply_filters(
				'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
				sprintf(
					'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
					esc_url($product->add_to_cart_url()),
					esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
					esc_attr(isset($args['class']) ? $args['class'] : 'button'),
					isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
					esc_html($product->add_to_cart_text())
				),
				$product,
				$args
			);
		}
		?>
    </div>
	<?php
}

/*
 * Bascart product wishlist button
 * */

function bascart_product_wishlist_button($product_id) {
	?>
    <div class="wishlist-icon-thumb">
		<?php
		$args = [];
		$product = wc_get_product($product_id);
		if($product) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

			if(isset($args['attributes']['aria-label'])) {
				$args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
			}

			echo apply_filters(
				'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
				sprintf(
					'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
					esc_url($product->add_to_cart_url()),
					esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
					esc_attr(isset($args['class']) ? $args['class'] : 'button'),
					isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
					'<i class="xts-icon xts-cart"></i>'
				),
				$product,
				$args
			);
		}
		?>
    </div>
	<?php
}

/*
 * Bascart product loop item
 * */
if(!function_exists('bascart_woocommerce_loop_item')) {
	function bascart_woocommerce_loop_item($product_id, $title_crop, $show_description = 'no', $description_characters = 10, $show_rating = 'no', $show_buttons_on_hover = 'no', $show_category_list = 'yes', $show_color_swatches = 'no') {
		$percentage = '';
		$product = wc_get_product($product_id);
		global $post;
		$image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
		?>
        <div class="shop-loop-item product">
            <div class="shop-loop-thumb">
				<?php
				$product_gallery_ids = $product->get_gallery_image_ids();
				if(isset($product_gallery_ids[1])) {
					$image_url = wp_get_attachment_url($product_gallery_ids[1]);
					?>
                    <div class="thumb-hover">
                        <a href="<?php echo esc_url(get_permalink($product_id)); ?>">
                            <img src="<?php echo esc_url($image_url); ?>"
                                 alt="<?php echo esc_attr(get_the_title($product_id)); ?>">
                        </a>
                    </div> <!-- ./hover-thumb -->
					<?php
				}
				?>

				<?php bascart_product_wishlist_button($product_id); ?>

                <a href="<?php echo esc_url(get_permalink($product_id)); ?>"
                   title="<?php echo get_the_title($product_id); ?>"><?php echo bascart_kses($product) ? $product->get_image($image_size) : ''; ?></a>

				<?php if($product->is_on_sale()) {
					if($product->is_type('variable')) {
						$percentages = array();
						$prices = $product->get_variation_prices();

						foreach($prices['price'] as $key => $price) {
							if($prices['regular_price'][$key] !== $price) {
								$percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
							}
						}

						$percentage = max($percentages) . '%';
					} elseif($product->is_type('grouped')) {
						$percentages = array();
					} else {
						$regular_price = (float)$product->get_regular_price();
						$sale_price = (float)$product->get_sale_price();

						if($sale_price != 0 || !empty($sale_price)) {
							$percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
						} else {
							$percentage = '';
						}
					}
					echo apply_filters('woocommerce_sale_flash', '<span class="onsale-percentage">' . $percentage . esc_html__(' OFF', 'bascart') . '</span>', $post, $product); ?>

				<?php } ?>
				<?php if('yes' !== $show_buttons_on_hover) : ?>
					<?php bascart_product_loop_buttons($product_id); ?>
				<?php endif; ?>

            </div>
            <div class="product-loop-desc">

                <!-- Shopengine color swatches -->
				<?php
				if($show_color_swatches == 'yes') {
					do_action("shopengine_swatches_anywhere", $product, ['pa_color']);
				}
				?>
                <!-- Product category list -->
				<?php
				$product_categories = get_the_terms($product_id, 'product_cat');
				if('yes' === $show_category_list && !empty($product_categories)) { ?>
                    <ul class="product-categories">
						<?php
						foreach($product_categories as $key => $term) {
							if($key == 1) {
								break;
							} ?>
                            <li>
                                <a href="<?php echo esc_url(get_term_link($term->term_id, 'product_cat')); ?>"><?php echo esc_html($term->name); ?></a>
                            </li>
						<?php } ?>
                    </ul>
				<?php }
				?>

                <!-- Product title -->
                <h3 class="product-title">
                    <a href="<?php echo esc_url(get_permalink($product_id)); ?>"
                       title="<?php echo get_the_title($product_id); ?>">
						<?php echo wp_trim_words(get_the_title($product_id), $title_crop, ''); ?>
                    </a>
                </h3>

                <!-- Product short description block -->
				<?php if('yes' === $show_description) : ?>
                    <p class="product-short-description"><?php echo wp_trim_words(get_the_excerpt($product_id), $description_characters, ''); ?></p>
				<?php endif; ?>

                <!-- Product footer block -->
                <div class="product-footer-wrapper">
                    <div class="product-footer">
                        <!-- Product price block -->
						<?php
						$price_multiline = '';
						if('yes' === $show_rating) {
							$price_multiline = 'price-multiline';
						}
						?>
						<?php if($product->get_price_html()) { ?>
                            <span class="product-price <?php echo esc_attr($price_multiline); ?>">
                                    <?php echo bascart_kses($product->get_price_html()); ?>
                                </span>
						<?php } ?>

                        <!-- Rating block -->
						<?php if('yes' === $show_rating && $product->get_rating_count() > 0) { ?>
                            <div class="product-rating">
								<?php woocommerce_template_loop_rating(); ?>
                            </div>
						<?php } ?>
                    </div>

					<?php if('yes' === $show_buttons_on_hover) : ?>
                        <div class="product-footer-action-buttons">
							<?php bascart_product_action_buttons(); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
		<?php
	}
}


/*
 * Bascart multi vendor product layout.
 */

if(!function_exists('bascart_multivendor_product_loop')) {
	function bascart_multivendor_product_loop($product_id, $title_length = 10) {
		global $post;
		$product = wc_get_product($product_id);
		$image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
		?>
        <div class="shop-loop-item bascart-multivendor-item product">
            <div class="shop-loop-thumb">
				<?php
				$product_gallery_ids = $product->get_gallery_image_ids();
				if(isset($product_gallery_ids[1])) {
					$image_url = wp_get_attachment_url($product_gallery_ids[1]);
					?>
                    <div class="thumb-hover">
                        <a href="<?php echo esc_url(get_permalink($product_id)); ?>">
                            <img src="<?php echo esc_url($image_url); ?>"
                                 alt="<?php echo esc_attr(get_the_title($product_id)); ?>">
                        </a>
                    </div> <!-- ./hover-thumb -->
					<?php
				}

				?>
                <a href="<?php echo esc_url(get_permalink($product_id)); ?>"
                   title="<?php echo get_the_title($product_id); ?>"><?php echo bascart_kses($product) ? $product->get_image($image_size) : ''; ?></a>

				<?php if($product->is_on_sale()) {
					if($product->is_type('variable')) {
						$percentages = array();
						$prices = $product->get_variation_prices();

						foreach($prices['price'] as $key => $price) {
							if($prices['regular_price'][$key] !== $price) {
								$percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
							}
						}

						$percentage = max($percentages) . '%';
					} elseif($product->is_type('grouped')) {
						$percentages = array();
					} else {
						$regular_price = (float)$product->get_regular_price();
						$sale_price = (float)$product->get_sale_price();

						if($sale_price != 0 || !empty($sale_price)) {
							$percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
						} else {
							$percentage = '';
						}
					}
					echo apply_filters('woocommerce_sale_flash', '<span class="onsale-percentage">' . $percentage . esc_html__(' OFF', 'bascart') . '</span>', $post, $product); ?>

				<?php } ?>
				<?php bascart_product_wishlist_button($product_id); ?>

            </div>
            <div class="product-loop-desc">
                <!-- Product vendor name -->
				<?php
				if(class_exists('WeDevs_Dokan')) {
					bascart_product_sold_by($product_id);
				}
				?>
                <!-- Product title -->
                <h3 class="product-title">
                    <a href="<?php echo esc_url(get_permalink($product_id)); ?>"
                       title="<?php echo get_the_title($product_id); ?>">
						<?php echo wp_trim_words(get_the_title($product_id), $title_length, ''); ?>
                    </a>
                </h3>
                <!-- Product footer block -->
                <div class="product-footer-wrapper">
                    <div class="product-footer">
                        <!-- Product price block -->
						<?php if($product->get_price_html()) { ?>
                            <span class="product-price price-multiline">
                                <?php echo bascart_kses($product->get_price_html()); ?>
                            </span>
						<?php } ?>

                        <!-- Rating block -->
						
						<?php  if( $product->get_rating_count() > 0  ) { ?>
                            <div class="product-rating">
								<?php  
								$rating  = $product->get_average_rating();
								$count   = $product->get_rating_count();
								echo wc_get_rating_html( $rating, $count ); 
								?>
                            </div>
						<?php  } ?>
                    </div>

                    <div class="product-footer-action-buttons">
						<?php bascart_product_loop_buttons($product_id); ?>
                    </div>
                </div>

            </div>
        </div>
		<?php
	}
}

/**
 * ---------------------------------
 * product single tab title remove
 * ---------------------------------
 */
add_filter('woocommerce_product_description_heading', '__return_null');
add_filter('woocommerce_product_additional_information_heading', '__return_null');


/**
 * ------------------------------------------------------------------------------------------------
 * quantity plus and minus
 * ------------------------------------------------------------------------------------------------
 */
add_action('woocommerce_after_quantity_input_field', 'bascart_display_quantity_plus');

function bascart_display_quantity_plus() {
	?>
    <button type="button" class="plus">+</button>
	<?php
}

add_action('woocommerce_before_quantity_input_field', 'bascart_display_quantity_minus');

function bascart_display_quantity_minus() {
	?>
    <button type="button" class="minus">-</button>
	<?php
}


/**
 * ------------------------------------------------------------------------------------------------
 * Checkout steps in page title
 * ------------------------------------------------------------------------------------------------
 */

if(!function_exists('bascart_checkout_steps')) {
	function bascart_checkout_steps() {

		$class_step = '';

		if(is_order_received_page()) {
			$class_step = ' step-final ';
		}
		?>
        <div class="bascart-checkout-steps">
            <ul>
                <li class="step-cart <?php echo (is_cart()) ? 'step-active' : 'step-inactive'; ?>">
                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                        <span><?php esc_html_e('Shopping cart', 'bascart'); ?></span>
                    </a>
                </li>
                <li class="step-checkout <?php echo (is_checkout() && !is_order_received_page()) ? 'step-active' : 'step-inactive' . $class_step; ?>">
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>">
                        <span><?php esc_html_e('Checkout', 'bascart'); ?></span>
                    </a>
                </li>
                <li class="step-complete <?php echo (is_order_received_page()) ? 'step-active' : 'step-inactive'; ?>">
                    <span><?php esc_html_e('Order complete', 'bascart'); ?></span>
                </li>
            </ul>
        </div>
		<?php
	}
}

//variable products price as simple products
add_filter('woocommerce_variable_sale_price_html', 'bascart_shop_variable_product_price', 10, 2);
add_filter('woocommerce_variable_price_html', 'bascart_shop_variable_product_price', 10, 2);
function bascart_shop_variable_product_price($price, $product) {
	$variation_min_reg_price = $product->get_variation_regular_price('min', true);
	$variation_min_sale_price = $product->get_variation_sale_price('min', true);
	if($product->is_on_sale() && !empty($variation_min_sale_price)) {
		if(!empty($variation_min_sale_price)) {
			$price = '<del>' . wc_price($variation_min_reg_price) . '</del>
        <ins>' . wc_price($variation_min_sale_price) . '</ins>';
		}
	} else {
		if(!empty($variation_min_reg_price)) {
			$price = '<ins>' . wc_price($variation_min_reg_price) . '</ins>';
		} else {
			$price = '<ins>' . wc_price($product->regular_price) . '</ins>';
		}
	}

	return $price;
}

/**
 * -------------------------------------------
 * Markup added inside default breadcrumb
 * -------------------------------------------
 */
add_filter('woocommerce_breadcrumb_defaults', 'bascart_woocommerce_breadcrumbs');
function bascart_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '',
		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><ul class="bascart-breadcrumb">',
		'wrap_after'  => '</ul></nav>',
		'before'      => '<li>',
		'after'       => '</li>',
		'home'        => _x('Home', 'breadcrumb', 'bascart'),
	);
}

// add/remove hooks for conflicting plugin
add_action('shopengine/templates/elementor/content/before_shop', 'bascart_remove_add_hooks_shop_archive');
add_action('shopengine/templates/elementor/content/before_archive', 'bascart_remove_add_hooks_shop_archive');

function bascart_remove_add_hooks_shop_archive() {

	remove_action('woocommerce_before_shop_loop', 'bascart_woocommerce_output_all_notices_before', 9);
	remove_action('woocommerce_before_shop_loop', 'bascart_woocommerce_output_all_notices_after', 11);

	remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

	add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
	remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

	remove_action('woocommerce_before_shop_loop_item_title', 'bascart_template_loop_product_thumbnail', 10);

	add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
	add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

	remove_action('woocommerce_shop_loop_item_title', 'bascart_template_loop_product_title', 10);

	//add wishlist icon and hover box for thumbnail
	add_action('woocommerce_before_shop_loop_item_title', 'bascart_wishlist_on_loop_before_product_thumbnail', 5);
	function bascart_wishlist_on_loop_before_product_thumbnail() {
		global $post, $product;
		$image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
		?>
        <div class="shop-loop-thumb">
		<?php
		$product_gallery_ids = $product->get_gallery_image_ids();
		if(isset($product_gallery_ids[1])) {
			$image_url = wp_get_attachment_url($product_gallery_ids[1]);
			?>
            <div class="thumb-hover">
                <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
                    <img src="<?php echo esc_url($image_url); ?>"
                         alt="<?php echo get_the_title($product->get_id()); ?>">
                </a>
            </div> <!-- ./hover-thumb -->
			<?php
		}
		?>
        <div class="wishlist-icon-thumb">
			<?php
			$args = array();
			if($product) {
				$defaults = array(
					'quantity'   => 1,
					'class'      => implode(
						' ',
						array_filter(
							array(
								'button',
								'product_type_' . $product->get_type(),
								$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
								$product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
							)
						)
					),
					'attributes' => array(
						'data-product_id'  => $product->get_id(),
						'data-product_sku' => $product->get_sku(),
						'aria-label'       => $product->add_to_cart_description(),
						'rel'              => 'nofollow',
					),
				);

				$args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

				if(isset($args['attributes']['aria-label'])) {
					$args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
				}

				echo apply_filters(
					'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
					sprintf(
						'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url($product->add_to_cart_url()),
						esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
						esc_attr(isset($args['class']) ? $args['class'] : 'button'),
						isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
						esc_html($product->add_to_cart_text())
					),
					$product,
					$args
				);
			}
			?>
        </div>

        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"
           title="<?php echo get_the_title($product->get_id()); ?>"><?php echo bascart_kses($product) ? $product->get_image($image_size) : ''; ?></a>

		<?php if($product->is_on_sale()) {
			if($product->is_type('variable')) {
				$percentages = array();
				$prices = $product->get_variation_prices();

				foreach($prices['price'] as $key => $price) {
					if($prices['regular_price'][$key] !== $price) {
						$percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
					}
				}

				$percentage = max($percentages) . '%';
			} elseif($product->is_type('grouped')) {
				$percentages = array();

				$children_ids = $product->get_children();

				foreach($children_ids as $child_id) {
					$child_product = wc_get_product($child_id);

					$regular_price = (float)$child_product->get_regular_price();
					$sale_price = (float)$child_product->get_sale_price();

					if($sale_price != 0 || !empty($sale_price)) {
						$percentages[] = round(100 - ($sale_price / $regular_price * 100));
					}
				}

				$percentage = max($percentages) . '%';
			} else {
				$regular_price = (float)$product->get_regular_price();
				$sale_price = (float)$product->get_sale_price();

				if($sale_price != 0 || !empty($sale_price)) {
					$percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
				} else {
					$percentage = '';
				}
			}
			echo apply_filters('woocommerce_sale_flash', '<span class="onsale-percentage">' . $percentage . esc_html__(' OFF', 'bascart') . '</span>', $post, $product); ?>

		<?php } ?>
        <div class="add-to-cart-hover-box">
			<?php
			$args = array();
			if($product) {
				$defaults = array(
					'quantity'   => 1,
					'class'      => implode(
						' ',
						array_filter(
							array(
								'button',
								'product_type_' . $product->get_type(),
								$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
								$product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
							)
						)
					),
					'attributes' => array(
						'data-product_id'  => $product->get_id(),
						'data-product_sku' => $product->get_sku(),
						'aria-label'       => $product->add_to_cart_description(),
						'rel'              => 'nofollow',
					),
				);

				$args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

				if(isset($args['attributes']['aria-label'])) {
					$args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
				}

				echo apply_filters(
					'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
					sprintf(
						'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url($product->add_to_cart_url()),
						esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
						esc_attr(isset($args['class']) ? $args['class'] : 'button'),
						isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
						esc_html($product->add_to_cart_text())
					),
					$product,
					$args
				);
			}
			?>
        </div>

		<?php
	}

	//end .shop-loop-thumb
	add_action('woocommerce_before_shop_loop_item_title', 'bascart_wishlist_on_loop_after_product_thumbnail', 15);
	function bascart_wishlist_on_loop_after_product_thumbnail() {
		?>
        </div>
		<?php
	}

	//push categories before title
	add_action('woocommerce_shop_loop_item_title', 'bascart_template_loop_product_title_category', 5);
	function bascart_template_loop_product_title_category() {
		global $post, $product;
		?>
        <div class="product-loop-desc">
			<?php
			$product_categories = get_the_terms(get_the_ID(), 'product_cat');
			if(!empty($product_categories)) { ?>
                <ul class="product-categories">
					<?php
					foreach($product_categories as $key => $term) {
						if($key == 1) {
							break;
						} ?>
                        <li>
                            <a href="<?php echo esc_url(get_term_link($term->term_id, 'product_cat')); ?>"><?php echo esc_html($term->name); ?></a>
                        </li>
					<?php } ?>
                </ul>
			<?php } ?>
            <h3 class="product-title"><a href="<?php echo esc_url(get_permalink()); ?>"
                                         title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>

			<?php if($product->get_price_html()) { ?>
                <span class="product-price">
                    <?php echo bascart_kses($product->get_price_html()); ?>
                </span>
			<?php } ?>

        </div>
		<?php
	}

}

/*
 * Bascart product action button with icon
 * */
function bascart_product_action_buttons() {
	global $product;
	$args = array();
	if($product) {
		$defaults = array(
			'quantity'   => 1,
			'class'      => implode(
				' ',
				array_filter(
					array(
						'button',
						'product_type_' . $product->get_type(),
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
					)
				)
			),
			'attributes' => array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'aria-label'       => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			),
		);

		$args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

		if(isset($args['attributes']['aria-label'])) {
			$args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
		}

		echo apply_filters(
			'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
			sprintf(
				'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
				esc_url($product->add_to_cart_url()),
				esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
				esc_attr(isset($args['class']) ? $args['class'] : 'button'),
				isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
				'<i class="xts-icon xts-cart"></i>'
			),
			$product,
			$args
		);
	}
}

add_filter('woocommerce_add_to_cart_fragments', 'bascart_woocommerce_header_add_to_cart_fragment', 20);
function bascart_woocommerce_header_add_to_cart_fragment($fragments) {
	ob_start();
	if(WC()->cart->get_cart_contents_count() == 1) {
		$item_text = esc_html__(' item', 'bascart');
	} else {
		$item_text = esc_html__(' items', 'bascart');
	}
	$fragments['.ekit-cart-items-count'] = '<span class="ekit-cart-items-count count">' . WC()->cart->get_cart_contents_count() . '</span>';

	$fragments['.ekit-cart-count'] = '<span class="ekit-cart-count">' . WC()->cart->get_cart_contents_count() . $item_text . '</span>';
	ob_get_clean();

	return $fragments;
}