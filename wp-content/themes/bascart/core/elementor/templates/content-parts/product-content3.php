<?php
if (empty($args)) {
    return;
}
$title_crop = $settings['title_character'];
$show_color_swatches = $settings['show_color_swatches'];
$query = new WP_Query($args);

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        $default_content = [
            'image',
            'category',
            'title',
            'rating',
            'price',
            'description'
        ];

        $content =  (!empty($view) ? $view : $default_content);
        asort($content, SORT_NUMERIC);
?>
        <div class="product-grid-item">
            <?php bascart_woocommerce_loop_item(get_the_ID(), $title_crop, '', '', '', '', '', $show_color_swatches); ?>
            
        </div>
<?php endwhile;
endif;
wp_reset_postdata();
