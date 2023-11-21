<?php 
$title_crop = $settings['title_character'];
$show_color_swatches = $settings['show_color_swatches'];
?>
<div class="woocommerce">
    <?php
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => isset($settings['products_per_page']) ? $settings['products_per_page'] : 6,
            'order'             => isset($settings['product_order']) ? $settings['product_order'] : 'DESC',
            'orderby'           => isset($settings['product_orderby']) ? $settings['product_orderby'] : 'date',
        );

        if($settings['product_by'] == 'category'){
            $args['tax_query'] = [
                [
                    'taxonomy'   => 'product_cat',
                    'field'      => 'term_id',
                    'terms'      => !empty($settings['term_list']) ? $settings['term_list'] : [],
                ],
            ];
        }

        if($settings['product_by'] == 'product'){
            $args['post__in'] = !empty($settings['product_list']) ? $settings['product_list'] : [];
        } ?>

    <div class="swiper-container">
        <div class="swiper-wrapper"> 
            <?php 
                $settings['column_class'] = 'swiper-slide';
                $query = get_posts($args);
                foreach ($query as $post) : ?>
                <div class="swiper-slide">
                    <?php bascart_woocommerce_loop_item($post->ID, $title_crop, '', '', '', '', '', $show_color_swatches); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if(!empty($settings['show_navigation']) && $settings['show_navigation'] == 'yes') : ?>
        <!-- next / prev arrows -->
        <div class="swiper-button-next swiper-next-<?php echo esc_attr($this->get_id()); ?>"> 
            <?php \Elementor\Icons_Manager::render_icon( $settings['right_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="swiper-button-prev swiper-prev-<?php echo esc_attr($this->get_id()); ?>">
            <?php \Elementor\Icons_Manager::render_icon( $settings['left_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
    <?php endif; ?>
</div>