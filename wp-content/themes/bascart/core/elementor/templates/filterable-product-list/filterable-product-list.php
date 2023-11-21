<?php

$style = $settings['tab_style'];
?>
<div class="bascart-filterable-product-wrap woocommerce">
    <?php
    $slug = '';
    $products = [];
    ?>
    <div class="filter-nav">
        <ul>
            <?php if (!empty($settings['filter_content'])) : foreach ($settings['filter_content'] as $key => $content) :
                    if ($key == 0) {
                        $slug = slugify($content['filter_label']);
                        if(isset($content['product_list'])){
                            $products = $content['product_list'];
                        }                        
                    }
            ?>
                    <li class="filter-nav-item"><a href="#" class="bc-filter-nav-link <?php echo esc_attr($key == 0 ? 'active' : ''); ?>" data-filter-slug="<?php echo esc_attr(slugify($content['filter_label'])); ?>" data-product-list='<?php echo !empty($content['product_list']) ? json_encode($content['product_list']) : ''; ?>' data-product-style='<?php echo esc_attr($style)?>'><?php echo esc_html($content['filter_label']); ?></a></li>
            <?php endforeach;
            endif; ?>
        </ul>
    </div>
    <div class="container filter-content">
        <div class="<?php echo esc_attr($style)?> row filtered-product-list active filter-<?php echo esc_attr($slug); ?> ">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 6,
                'order'          => isset($settings['product_order']) ? $settings['product_order'] : 'DESC',
                'post__in'  => $products
            );

            $view = [
                'image' => (!empty($settings['order-image']) ? $settings['order-image'] : 0),
                'category' => (!empty($settings['order-category']) ? $settings['order-category'] : 0),
                'title' => (!empty($settings['order-title']) ? $settings['order-title'] : 0),
                'rating' => (!empty($settings['order-rating']) ? $settings['order-rating'] : 0),
                'price' => (!empty($settings['order-price']) ? $settings['order-price'] : 0),
                'description' => (!empty($settings['order-description']) ? $settings['order-description'] : 0),
            ];

            if ($style == 'style2') {
                $files = BASCART_CORE . '/elementor/templates/content-parts/product-content2.php';
                if (file_exists($files)) {
                    require $files;
                }
            } else {
                $files = BASCART_CORE . '/elementor/templates/content-parts/product-content2.php';
                if (file_exists($files)) {
                    require $files;
                }
            }
            ?>
        </div>
    </div>
</div>