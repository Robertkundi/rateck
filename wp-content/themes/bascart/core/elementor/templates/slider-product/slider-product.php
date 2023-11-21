<div class="bascart-product-slider-item-wrapper">
    <?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 1,
        'order'          => isset($settings['product_order']) ? $settings['product_order'] : 'DESC',
        'orderby'          => isset($settings['product_orderby']) ? $settings['product_orderby'] : 'date',
    );

    if ($settings['product_by'] == 'category') {
        $args['tax_query'] = [
            [
                'taxonomy'   => 'product_cat',
                'field'        => 'term_id',
                'terms'         => !empty($settings['term_list']) ? $settings['term_list'] : [-1],
            ],
        ];
    }

    if ($settings['product_by'] == 'product') {
        $args['post__in'] = !empty($settings['product_list']) ? $settings['product_list'] : [-1];
    }

    $view = [
        'image',
        'category',
        'title',
        'rating',
        'price'
    ];

    $files = BASCART_CORE . '/elementor/templates/content-parts/product-content4.php';
    if (file_exists($files)) {
        require $files;
    }
    ?>
</div>