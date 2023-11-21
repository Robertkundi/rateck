<?php 
$style = $settings['deal_style'];
$title_crop = $settings['title_character'];
?>
<div class="container woocommerce">
    <div class="row bascart-deal-products-wrap bascart-deal-products <?php echo esc_attr($style)?>">
        <?php
            global $post;
            $tags_array = [];
            $tags = wp_get_post_terms( $post->ID, "product_tag" );
            foreach ( $tags as $tag ) {
                $tags_array[] .= $tag->term_id;
            }

            $args = array(
                'post_type' => 'product',
                'orderby' => 'rand',
                'category__in' => wp_get_post_categories( $post->ID ),
                'post__not_in' => array( $post->ID ),
                'posts_per_page' => isset($settings['products_per_page']) ? $settings['products_per_page'] : 6,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_tag',
                        'field' => 'id',
                        'terms' => $tags_array
                    )
                )
            );

            $view = [
                'image',
                'category',
                'title',
                'price',
                'progress'
            ];
            if(!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') :
            ?>
                <div class="swiper-container">
                <div class="swiper-wrapper"> <?php
                $settings['column_class'] = 'swiper-slide';
            endif;
            if ($style == 'style2') {
                $files = BASCART_CORE . '/elementor/templates/content-parts/product-content2.php';
                if (file_exists($files)) {
                    require $files;
                }
            } else {
                $query = get_posts($args);
                foreach ($query as $post) {
                    if(!empty($settings['enable_carousel']) && $settings['enable_carousel'] == 'yes') :
                    ?>
                    <div class="swiper-slide">
                    <?php endif; ?>
                    <?php bascart_woocommerce_loop_item($post->ID, $title_crop); ?>
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
                <div class="swiper-button-next swiper-next-<?php echo esc_attr($this->get_id()); ?>"> 
                    <?php \Elementor\Icons_Manager::render_icon( $settings['right_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class="swiper-button-prev swiper-prev-<?php echo esc_attr($this->get_id()); ?>">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['left_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
            <?php endif;
        ?>
    </div>
</div>