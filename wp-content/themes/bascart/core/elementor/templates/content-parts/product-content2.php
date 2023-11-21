<?php
if(empty($args)) {
	return;
}
$title_crop = $settings['title_character'];
$show_description = $settings['show_description'];
$description_characters = $settings['description_characters'];
$show_rating = $settings['show_rating'];
$show_buttons_on_hover = $settings['show_buttons_on_hover'];
$show_category_list = $settings['show_category_list'];
$show_color_swatches = $settings['show_color_swatches'];
$query = new WP_Query($args);

if($query->have_posts()) : while($query->have_posts()) : $query->the_post();

	$column_class = !empty($settings['column_class']) ? $settings['column_class'] : 'col-md-4';
	$default_content = [
		'image',
		'category',
		'title',
		'rating',
		'price',
		'description'
	];

	$content = (!empty($view) ? $view : $default_content);
	asort($content, SORT_NUMERIC);
	?>
    <div class="<?php echo esc_attr($column_class); ?>">
		<?php bascart_woocommerce_loop_item(get_the_ID(), $title_crop, $show_description, $description_characters, $show_rating, $show_buttons_on_hover, $show_category_list, $show_color_swatches); ?>
    </div>
<?php endwhile;
endif;
wp_reset_postdata();
