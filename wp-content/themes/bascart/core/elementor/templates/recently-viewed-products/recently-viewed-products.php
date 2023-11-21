<div class="container">
    <div class="row recent-viewed-product-list">
        <?php
        $args = array(
            'post_type'      => 'product',
            'meta_key'       => 'bascart_product_views_count',
            'orderby'        => 'meta_value',
            'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 6,
            'order'          => isset($settings['product_order']) ? $settings['product_order'] : 'DESC',
            'orderby'          => isset($settings['product_orderby']) ? $settings['product_orderby'] : 'date',
        );

        $view = [
            'image',
        ];

        $files = BASCART_CORE . '/elementor/templates/content-parts/product-content.php';
        if(file_exists($files)) {
            require $files;
        }
        ?>
    </div>
</div>