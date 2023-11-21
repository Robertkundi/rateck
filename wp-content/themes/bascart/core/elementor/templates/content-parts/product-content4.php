<?php
if (empty($args)) {
    return;
}
$title_crop = $settings['title_character'];
$show_add_to_cart_button = $settings['show_add_to_cart_button'];
$query = new WP_Query($args);

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
    <div class="bascart-list-product-item">
        <?php 
            global $product;
            $image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
            $product_id = get_the_id();
            if ( ! is_a( $product, 'WC_Product' ) ) {
                $product = wc_get_product($product_id);
            }
        ?>
        <div class="product-image">
            <a href="<?php echo esc_url(get_permalink($product_id)); ?>" title="<?php echo get_the_title($product_id); ?>"><?php echo bascart_kses($product) ? $product->get_image($image_size) : ''; ?></a>
        </div>
        <div class="product-description">

            <h3 class="product-title">
                <a href="<?php echo esc_url(get_permalink($product_id)); ?>" title="<?php echo get_the_title($product_id); ?>"><?php echo wp_trim_words(get_the_title($product_id), $title_crop, ''); ?></a>
            </h3>

            <?php if ($product->get_price_html()) { ?>
                <span class="product-price">
                    <?php echo bascart_kses($product->get_price_html()); ?>
                </span>
            <?php } ?>

            <?php if('yes' === $show_add_to_cart_button): ?>
                
            <div class="add-to-cart-button">
                <a href="<?php echo esc_url($product->add_to_cart_url()) ?>" class="ajax_add_to_cart add_to_cart_button button" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()) ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart"><?php esc_html_e(' Add to Cart', 'bascart'); ?>
                 </a>
            </div>

            <?php endif; ?>
        </div>
    </div>
<?php endwhile;
endif;
wp_reset_postdata();
