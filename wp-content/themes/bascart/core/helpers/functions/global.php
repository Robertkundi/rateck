<?php if(!defined('ABSPATH')) {
	die('Direct access forbidden.');
}
/**
 * helper functions
 */

// simply echo the variable
// ----------------------------------------------------------------------------------------
function bascart_return($s) {

	return bascart_kses($s);
}

// return the specific value from theme options/ customizer/ etc
// ----------------------------------------------------------------------------------------
function bascart_option($key, $default_value = '', $method = 'customizer') {
	if(defined('DEVM')) {
		switch($method) {
			case 'customizer':
				$value = devm_theme_option($key);
				break;
			default:
				$value = '';
				break;
		}

		return (!isset($value) || $value == '') ? $default_value : $value;
	}

	return $default_value;
}


// return the specific value from metabox
// ----------------------------------------------------------------------------------------
function bascart_meta_option($postid, $key, $default_value = '') {
	if(defined('DEVM')) {
		$value = devm_meta_option($postid, $key, $default_value);
	}

	return (!isset($value) || $value == '') ? $default_value : $value;
}

// extract unyson image data from option value in a much simple way
// ----------------------------------------------------------------------------------------
function bascart_src($key, $default_value = '', $input_as_attachment = false) { // for src
	if($input_as_attachment == true) {
		$attachment = $key;
	} else {
		$attachment = bascart_option($key);
	}

	if(isset($attachment['url']) && !empty($attachment)) {
		return $attachment['url'];
	}

	return $default_value;
}


// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function bascart_kses($raw) {

	$allowed_tags = array(
		'a'          => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'abbr'       => array(
			'title' => array(),
		),
		'b'          => array(),
		'blockquote' => array(
			'cite' => array(),
		),
		'cite'       => array(
			'title' => array(),
		),
		'code'       => array(),
		'del'        => array(
			'datetime' => array(),
			'title'    => array(),
		),
		'dd'         => array(),
		'div'        => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'dl'         => array(),
		'dt'         => array(),
		'em'         => array(),
		'h1'         => array(),
		'h2'         => array(),
		'h3'         => array(),
		'h4'         => array(),
		'h5'         => array(),
		'h6'         => array(),
		'i'          => array(
			'class' => array(),
		),
		'img'        => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li'         => array(
			'class' => array(),
		),
		'ol'         => array(
			'class' => array(),
		),
		'p'          => array(
			'class' => array(),
		),
		'q'          => array(
			'cite'  => array(),
			'title' => array(),
		),
		'span'       => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'iframe'     => array(
			'width'       => array(),
			'height'      => array(),
			'scrolling'   => array(),
			'frameborder' => array(),
			'allow'       => array(),
			'src'         => array(),
		),
		'strike'     => array(),
		'br'         => array(),
		'strong'     => array(),
		'ul'         => array(
			'class' => array(),
		),
	);

	if(function_exists('wp_kses')) { // WP is here
		$allowed = wp_kses($raw, $allowed_tags);
	} else {
		$allowed = $raw;
	}


	return $allowed;
}


// build google font url
// ----------------------------------------------------------------------------------------
function bascart_google_fonts_url($font_families = []) {
	$fonts_url = '';
	/*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
	if($font_families && 'off' !== _x('on', 'Google font: on or off', 'bascart')) {
		$query_args = array(
			'family' => urlencode(implode('|', $font_families))
		);

		$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
	}

	return esc_url_raw($fonts_url);
}

// return cover image from an youtube video url
// ----------------------------------------------------------------------------------------
function bascart_youtube_cover($e) {
	$src = null;
	//get the url
	if($e != '') {
		$url = $e;
		$queryString = parse_url($url, PHP_URL_QUERY);
		parse_str($queryString, $params);
		$v = $params['v'];
		//generate the src
		if(strlen($v) > 0) {
			$src = "http://i3.ytimg.com/vi/$v/default.jpg";
		}
	}

	return $src;
}


// return embed code for sound cloud
// ----------------------------------------------------------------------------------------
function bascart_soundcloud_embed($url) {
	return 'https://w.soundcloud.com/player/?url=' . urlencode($url) . '&auto_play=false&color=915f33&theme_color=00FF00';
}


// return embed code video url
// ----------------------------------------------------------------------------------------
function bascart_video_embed($url) {
	//This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
	$embed_url = '';
	if(strpos($url, 'facebook.com/') !== false) {
		//it is FB video
		$embed_url = 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode($url) . '&show_text=1&width=200';
	} else {
		if(strpos($url, 'vimeo.com/') !== false) {
			//it is Vimeo video
			$video_id = explode("vimeo.com/", $url)[1];
			if(strpos($video_id, '&') !== false) {
				$video_id = explode("&", $video_id)[0];
			}
			$embed_url = 'https://player.vimeo.com/video/' . $video_id;
		} else {
			if(strpos($url, 'youtube.com/') !== false) {
				//it is Youtube video
				$video_id = explode("v=", $url)[1];
				if(strpos($video_id, '&') !== false) {
					$video_id = explode("&", $video_id)[0];
				}
				$embed_url = 'https://www.youtube.com/embed/' . $video_id;
			} else {
				if(strpos($url, 'youtu.be/') !== false) {
					//it is Youtube video
					$video_id = explode("youtu.be/", $url)[1];
					if(strpos($video_id, '&') !== false) {
						$video_id = explode("&", $video_id)[0];
					}
					$embed_url = 'https://www.youtube.com/embed/' . $video_id;
				} else {
					//for new valid video URL
				}
			}
		}
	}

	return $embed_url;
}

if(!function_exists('bascart_advanced_font_styles')) :

	/**
	 * Get shortcode advanced Font styles
	 *
	 */
	function bascart_advanced_font_styles($data) {

		$style = [];

		if(is_string($data)) {
			$style = json_decode($data, true);
		} else {
			$style = $data;
		}

		$font_styles = $font_weight = '';

		$font_weight = (isset($style['weight']) && $style['weight']) ? 'font-weight:' . esc_attr($style['weight']) . ';' : '';

		$font_styles .= isset($style['family']) ? 'font-family: ' . $style['family'] . ', sans-serif;' : '';
		$font_styles .= isset($style['style']) && $style['style'] ? 'font-style:' . esc_attr($style['style']) . ';' : '';

		$font_styles .= isset($style['color']) && !empty($style['color']) ? 'color:' . esc_attr($style['color']) . ';' : '';
		$font_styles .= isset($style['line_height']) && !empty($style['line_height']) ? 'line-height:' . esc_attr($style['line_height'] / $style['size']) . ';' : '';
		$font_styles .= isset($style['letter_spacing']) && !empty($style['letter_spacing']) ? 'letter-spacing:' . esc_attr($style['letter_spacing'] / 1000 * 1) . 'rem;' : '';
		$font_styles .= isset($style['size']) && !empty($style['size']) ? 'font-size:' . esc_attr($style['size']) . 'px;' : '';

		$font_styles .= !empty($font_weight) ? $font_weight : '';

		return !empty($font_styles) ? $font_styles : '';
	}

endif;


/**
 * hooks for wp blog part
 */

// if there is no excerpt, sets a defult placeholder
// ----------------------------------------------------------------------------------------
function bascart_excerpt($words = 20) {
	$excerpt = get_the_excerpt();
	$trimmed_content = wp_trim_words($excerpt, $words);
	echo bascart_kses($trimmed_content);
}


// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function bascart_move_comment_textarea_to_bottom($fields) {
	$comment_field = $fields['comment'];
	unset($fields['comment']);
	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter('comment_form_fields', 'bascart_move_comment_textarea_to_bottom');


// change textarea position in comment form
// ----------------------------------------------------------------------------------------
function bascart_search_form($form) {
	$form = '
        <form  method="get" action="' . esc_url(home_url('/')) . '" class="bascart-serach xs-search-group">
            <div class="input-group">
                <input type="search" class="form-control" name="s" placeholder="' . esc_attr__('Search', 'bascart') . '" value="' . get_search_query() . '">
                <div class="input-group-append">
                    <button class="input-group-text search-button"><i class="xts-icon xts-search"></i></button>
                </div>
            </div>
        </form>';

	return $form;
}

add_filter('get_search_form', 'bascart_search_form');

function bascart_body_classes($classes) {

	if(is_active_sidebar('sidebar-1')) {
		$classes[] = 'sidebar-active';
	} else {
		$classes[] = 'sidebar-inactive';
	}
	$box_class = bascart_option('general_body_box_layout');
	if(isset($box_class['style'])) {
		if($box_class['style'] == 'yes') {
			$classes[] = 'body-box-layout';
		}
	}

	return $classes;
}

add_filter('body_class', 'bascart_body_classes');


function get_widget_template($temp_name) {
	return BASCART_CORE . '/elementor/templates/' . $temp_name . '/' . $temp_name . '.php';
}

function bascart_category_filter() {
	$term_id = $_POST['term_id'];
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => 6,
		'tax_query'      => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $term_id,
			),
		)
	);
	$query = new WP_Query($args);

	if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
		echo bascart_product_cotnent();
	endwhile; endif;
	wp_reset_postdata();

	die(0);
}

add_action('wp_ajax_bascart_category_filter', 'bascart_category_filter');
add_action('wp_ajax_nopriv_bascart_category_filter', 'bascart_category_filter');


function bascart_filter_cat_products() {
	if(isset($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
		die ();
	}

	$products = $_POST['products'];
	$settings = $_POST['settings'];
	if(empty($products)) {
		die("<p class='error'>" . esc_html__('No products were found.', 'bascart') . "</p>");
	}
	$args = array(
		'post_type'      => 'product',
		'post__in'       => $products,
		'posts_per_page' => 50
	);

	if($settings['tab_style'] == 'style2') {
		$files = BASCART_CORE . '/elementor/templates/content-parts/product-content2.php';
		if(file_exists($files)) {
			require $files;
		}
	} else {
		$files = BASCART_CORE . '/elementor/templates/content-parts/product-content2.php';
		if(file_exists($files)) {
			require $files;
		}
	}


	die(0);
}

add_action('wp_ajax_bascart_filter_cat_products', 'bascart_filter_cat_products');
add_action('wp_ajax_nopriv_bascart_filter_cat_products', 'bascart_filter_cat_products');

function slugify($text) {
	if(empty($text)) {
		return '';
	}
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);

	if(empty($text)) {
		return 'n-a';
	}

	return $text;
}

function bascart_ajax_widget_load() {
	if(isset($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
		die ();
	}

	$name = $_POST['widget_name'];
	$settings = $_POST['settings'];

	$tpl = BASCART_CORE . '/elementor/templates/' . $name . '/' . $name . '.php';

	if(file_exists($tpl)) {
		include $tpl;
	}

	die(0);
}

add_action('wp_ajax_bascart_ajax_widget_load', 'bascart_ajax_widget_load');
add_action('wp_ajax_nopriv_bascart_ajax_widget_load', 'bascart_ajax_widget_load');

// view count
add_action('wp_head', 'bascart_track_product_views');
function bascart_track_product_views($product_id) {
	if(class_exists('WooCommerce') && !is_product()) {
		return;
	}
	$product_id = get_the_id();

	$count_key = 'bascart_product_views_count';
	$count = get_post_meta($product_id, $count_key, true);
	if($count == '') {
		$count = 1;
		delete_post_meta($product_id, $count_key);
		add_post_meta($product_id, $count_key, '1');
	} else {
		$count++;
		update_post_meta($product_id, $count_key, $count);
	}
}

add_filter('woocommerce_get_price_html', 'add_percentage_to_sale_bubble', 10, 3);
function add_percentage_to_sale_bubble($price, $product) {
	$product_data = $product->get_data();
	$output = '';
	if(!empty($product_data['regular_price']) && $product_data['sale_price']) {
		$percentage = round((($product_data['regular_price'] - $product_data['sale_price']) / $product_data['regular_price']) * 100);
		$output = ' <span class="onsale-off">' . $percentage . '% ' . esc_html__('Off', 'bascart') . '</span>';
	}

	return $price . $output;
}

// WooCommerce


function _product_sale_end_date($settings) {
	$date = get_post_meta(get_the_id(), '_sale_price_dates_to', true);
	if(!empty($date)) :
		$formatted_date = date("Y-m-d", $date);
		$config = [
			'days'    => __('Days', 'bascart'),
			'hours'   => __('Hours', 'bascart'),
			'minutes' => __('Minutes', 'bascart'),
			'seconds' => __('Seconds', 'bascart'),
		];

		?>
        <div data-prefix="<?php echo !empty($settings['counter_prefix']) ? $settings['counter_prefix'] : ''; ?>"
             class="product-end-sale-timer <?php echo !empty($settings['counter_position']) ? 'counter-position-' . esc_attr($settings['counter_position']) : ''; ?>"
             data-config='<?php echo json_encode($config); ?>'
             data-date="<?php echo esc_attr($formatted_date); ?>"></div>
	<?php
	endif;
}

function _product_progress($settings = null) {
	global $product;
	$available_products = $product->get_stock_quantity();
	$sales_products = $product->get_total_sales();

	if(!empty($available_products)) :
		$total = $available_products + $sales_products;
		$percentage = ($sales_products / $total) * 100;
		?>
        <div class="product-progress">
            <div class="product-progress-bar-wrap">
                <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr($percentage); ?>%"
                     aria-valuenow="<?php echo esc_attr($percentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <ul class="product-progress-meta">
				<?php if(!empty($available_products)) : ?>
                    <li class="available"><?php echo __('Available: ', 'bascart');
						echo esc_html($available_products); ?></li>
				<?php endif; ?>
				<?php if(!empty($sales_products)) : ?>
                    <li class="sold"><?php echo __('Sold: ', 'bascart');
						echo esc_html($sales_products); ?></li>
				<?php endif; ?>
				<?php if(!empty($settings['counter_position']) && $settings['counter_position'] == 'progressbar') : ?>
                    <li class="counter"><?php echo _product_sale_end_date($settings); ?></li>
				<?php endif; ?>
            </ul>
        </div>
	<?php
	endif;
}

function _product_image($settings = null) {
	global $product;
	?>
    <div class='product-thumb'>
        <a href="<?php echo get_the_permalink(); ?>">
			<?php echo woocommerce_get_product_thumbnail($product->get_id()); ?>
        </a>
        <!-- end sale date -->
		<?php
		if(!empty($settings['counter_position']) && $settings['counter_position'] == 'image') {
			_product_sale_end_date($settings);
		} ?>

        <!-- tag and sale badge -->
		<?php _product_tag_sale_badge($settings); ?>
    </div>
	<?php
}

function _product_category($settings = null) {
	global $product;

	$terms = get_the_terms(get_the_ID(), 'product_cat');
	if(empty($terms)) {
		return false;
	}

	$terms = array_slice($terms, 0, (isset($settings['category_limit']) ? $settings['category_limit'] : 1));

	$terms_count = count($terms);

	if($terms_count > 0) {
		echo "<div class='product-category'><ul>";
		foreach($terms as $key => $term) {
			$sperator = $key !== ($terms_count - 1) ? ',' : '';
			echo "<li><a href='" . get_term_link($term) . "'>" . esc_html($term->name) . $sperator . "</a></li>";
		}
		echo "</ul></div>";
	}
}

function _discount_percentage($settings = null) {
	global $product;

	$product_data = $product->get_data();
	$output = '';
	if(!empty($product_data['regular_price']) && $product_data['sale_price']) {
		$percentage = round((($product_data['regular_price'] - $product_data['sale_price']) / $product_data['regular_price']) * 100);

		return $percentage;
	}

	return '';
}

function _product_tag_sale_badge($settings = null) {
	global $product;
	$terms = get_the_terms(get_the_ID(), 'product_tag');
	if($product->is_on_sale() || !empty($terms)) : ?>
        <div class="product-tag-sale-badge position-<?php echo !empty($settings['badge_position']) ? esc_attr($settings['badge_position']) : ''; ?> align-<?php echo !empty($settings['badge_align']) ? esc_attr($settings['badge_align']) : ''; ?>">
            <ul>
				<?php if(!empty($settings['show_tag']) && $settings['show_tag'] == 'yes' && !empty(_discount_percentage())) : ?>
                    <li class="badge no-link off"><?php echo '-' . esc_html(_discount_percentage()) . '%'; ?></li>
				<?php endif; ?>

				<?php if(!empty($terms)) : $term = $terms[0];
					$bg = get_term_meta($term->term_id, 'devmonsta_bascart_tag_bg_color', true);
					?>
                    <li class="badge tag">
                        <a <?php if(!empty($bg)) : ?>style="background-color:<?php echo esc_attr($bg); ?>" <?php endif; ?>
                           href="<?php echo get_term_link($term->term_id); ?>"><?php echo esc_html($term->name); ?></a>
                    </li>
				<?php endif;

				if($product->is_on_sale()) {
					echo "<li class='badge no-link sale'>" . __('Sale!', 'bascart') . "</li>";
				}
				?>
            </ul>
        </div>
	<?php
	endif;
}

function _product_title($settings = null) {
	?>
    <h3 class='product-title'>
        <a href="<?php echo get_the_permalink(); ?>">
			<?php
			if(isset($settings['title_character']) && !empty($settings['title_character'])) :
				echo substr(get_the_title(), 0, $settings['title_character']);
			else :
				echo get_the_title();
			endif;
			?>
        </a>
    </h3>
	<?php
}

function _product_rating($settings = null) {
	global $product;
	?>
    <div class="product-rating">
		<?php
		if($product->get_rating_count() > 0) {
			woocommerce_template_loop_rating();
		} else {
			$rating_html = '<div class="star-rating">';
			$rating_html .= wc_get_star_rating_html(0, 0);
			$rating_html .= '</div>';

			echo bascart_kses($rating_html);
		}

		// review count
		$review_count = $product->get_review_count();
		echo "<span class='rating-count'>(" . $review_count . ")</span>";
		?>
    </div>
	<?php
}

function _product_price($settings = null) {
	?>
    <div class="product-price">
		<?php woocommerce_template_single_price(); ?>
    </div>

    <div class="overlay-add-to-cart position-<?php echo !empty($settings['product_hover_overlay_position']) ? esc_attr($settings['product_hover_overlay_position']) : ''; ?>">
		<?php woocommerce_template_loop_add_to_cart(); ?>
        <!-- <a href="javascript:" class="wishlist"></a>
		<a href="javascript:" class="compare"></a> -->
    </div>

	<?php
}

function _product_description($settings = null) {
	global $product;

	if($product->is_type('simple') == false) :
		$product_data = $product->get_data($product->get_id());
		?>
        <footer class="product-details-cart">
            <div class="prodcut-description">
                <p>
					<?php
					if(isset($settings['description_character']) && !empty($settings['description_character'])) :
						echo apply_filters('bascart_product_short_description', substr(wp_strip_all_tags($product->get_description()), 0, $settings['description_character']));
					else :
						echo apply_filters('bascart_product_short_description', $product->get_description());
					endif;
					?>
                </p>
            </div>
            <div class="add-to-cart-bt">
				<?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </footer>
	<?php endif;
}


function xs_category_list_slug($cat) {
	$query_args = array(
		'orderby'    => 'ID',
		'order'      => 'DESC',
		'hide_empty' => 1,
		'taxonomy'   => $cat
	);

	$categories = get_categories($query_args);
	$options = array(esc_html__('0', 'bascart') => 'All Category');
	if(is_array($categories) && count($categories) > 0) {
		return $categories;
	}
}

if(!function_exists('bascart_result_search_product')) {
	function bascart_result_search_product() {

		$keyword = $_POST['keyword'];
		$cat_id = $_POST['cat_id'];
		$settings = $_POST['settings'];

		if($keyword) {
			$args = array(
				'order'          => 'DESC',
				'orderby'        => 'date',
				'post_status'    => 'publish',
				'post_type'      => array('product'),
				'posts_per_page' => 6,
			);

			if($keyword && isset($keyword) && $keyword !== "") {
				$args['s'] = $keyword;
			}
			if(isset($cate_ids) && ($cate_ids != -1)) {
				$args['tax_query'] = [
					[
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $cat_id,
					],
				];
			}

			$view = [
				'image',
				'title',
				'price',
				'rating'
			];

			$files = BASCART_CORE . '/elementor/templates/content-parts/product-content.php';
			if(file_exists($files)) {
				require $files;
			}

		}
		wp_die();
	}
}
add_action('wp_ajax_bascart_result_search_product', 'bascart_result_search_product');
add_action('wp_ajax_nopriv_bascart_result_search_product', 'bascart_result_search_product');


function bascart_product_sold_by($product_id) {

	$seller = get_post_field('post_author', $product_id);
	$author = get_user_by('id', $seller);
	$vendor = dokan()->vendor->get($seller);

	$store_info = dokan_get_store_info($author->ID);

	if(!empty($store_info['store_name'])) : ?>
        <div class="store-name">
            <a href="<?php echo esc_url($vendor->get_shop_url()); ?>"> <?php echo esc_html($vendor->get_shop_name()); ?></a>
        </div>
	<?php endif;

}