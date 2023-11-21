<?php
if (empty($args)) {
    return;
}
$query = new WP_Query($args);

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

        $column_class = !empty($settings['column_class']) ? $settings['column_class'] : 'col-md-4';
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
        <div class='<?php echo esc_attr($column_class); ?> bascart-single-product-item'>
            <?php
            foreach ($content as $key => $value) {
                $function = '_product_' . (is_numeric($value) ? $key : $value);
                if (function_exists($function)) {
                    $function($settings);
                }
            }

            if (!empty($settings['counter_position']) && $settings['counter_position'] == 'footer') {
                _product_sale_end_date($settings, esc_html__('Ends in ', 'bascart'));
            }
            ?>

        </div>
<?php endwhile;
endif;
wp_reset_postdata();
