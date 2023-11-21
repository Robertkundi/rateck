<?php
$settings['widget_id'] = $this->get_id();
$style                 = $settings['slider_style'];
$show_counter          = $settings['show_product_count'];
$bottom_indecator      = $settings['slide_item_bottom_indecator'];
$category_ids          = $settings['post_cats'];
$title_icon            = $settings['show_title_icon'];
$title_position        = $settings['title_position'];
$hover_animation       = $settings['image_hover_animation'];
$button_text           = $settings['button_text'];
$show_button_icon      = $settings['show_button_icon'];
$args = array(
    'taxonomy'     => 'product_cat',
    'orderby'      => 'name',
    'hide_empty'   => 0
);

if(!empty($category_ids)){
    $args['include'] = $category_ids;
}
$all_categories = get_terms($args);
$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
if(!empty($all_categories)){ ?>
    <div class="<?php echo esc_attr($swiper_class); ?>">
        <div class="swiper-wrapper">
            <?php foreach ($all_categories as $cat) {

                $term = get_term($cat, 'product_cat');
                $image_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                $post_thumbnail_img = wp_get_attachment_image_src($image_id, 'full');

                if ($cat->category_parent == 0) { ?>
                    <?php
                        $bg_color = '';
                        $icon_calss = '';
                        if ( defined( 'DEVM' ) ) {
                            $bg_color = devm_taxonomy($term->term_id, 'devmonsta_bascart_product_cat_bg_color', true);
                            $icon_calss = '<i class="'.devm_taxonomy( $term->term_id, 'devmonsta_bascart_product_cat_icon_class', true).'"></i>';
                        }
                    ?>
                    <?php if($style === 'slider-title-top'): ?>
                        <div class="swiper-slide <?php echo esc_attr($style); ?>" style="--cat-color: <?php echo esc_attr($bg_color); ?>;">
                            <div class="category-slider-content">
                                <h3 class="bascart-category-title <?php echo esc_attr($title_position); ?>">
                                    <a href="<?php echo esc_url(get_term_link($cat->slug, 'product_cat')); ?>">    
                                        <?php echo esc_html($cat->name); ?>
                                    </a>
                                </h3>
                                <p class="category-description"><?php echo esc_html($cat->description); ?></p>
                                <a href="<?php echo esc_url(get_term_link($cat->slug, 'product_cat')); ?>" class="category-button">
                                    <?php echo esc_html($button_text); ?>
                                    <?php if($show_button_icon === 'yes'): ?>
                                        <div class="button-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php if (!empty($image_id) && $image_id != '') : ?>
                                <div class="categorory-slider-image <?php echo esc_attr($hover_animation); ?>">
                                    <a href="<?php echo esc_url(get_term_link($cat->slug, 'product_cat')); ?>">
                                        <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <div class="swiper-slide <?php echo esc_attr($style); ?> item-bottom-indecator-<?php echo esc_attr($bottom_indecator); ?>" style="--cat-color: <?php echo esc_attr($bg_color); ?>;">
                            <a class="slider-item" href="<?php echo esc_url(get_term_link($cat->slug, 'product_cat')); ?>">
                                <?php if($style == 'slider-icon-style'): ?>
                                    <div class="category-slider-icon <?php echo esc_attr($hover_animation); ?>">
                                        <?php echo bascart_kses($icon_calss);; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($style == 'slider-image-style' && !empty($post_thumbnail_img)) : ?>
                                    <div class="categorory-slider-image <?php echo esc_attr($hover_animation); ?>">
                                        <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                                    </div>
                                <?php endif; ?>
                                <h3 class="bascart-category-title <?php echo esc_attr($title_position); ?>">
                                    <?php echo esc_html($cat->name); ?> 
                                    <?php if($title_icon == 'yes'): ?>
                                        <i class="xts-icon xts-arrow-right"></i>
                                    <?php endif; ?>
                                </h3>
                                <?php if($show_counter == 'yes'): ?>
                                    <p class="item-counter">
                                        <?php echo number_format_i18n($term->count) . esc_html__(' Items Available', 'bascart'); ?>
                                    </p>
                                <?php endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php }
            } ?>
        </div>
    </div>

    <?php if($settings['show_navigation'] == 'yes'){ ?>
        <div class="category-slider-nav-item swiper-button-prev swiper-prev-<?php echo esc_attr($this->get_id()); ?>">
            <?php \Elementor\Icons_Manager::render_icon( $settings['left_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="category-slider-nav-item swiper-button-next swiper-next-<?php echo esc_attr($this->get_id()); ?>"> 
            <?php \Elementor\Icons_Manager::render_icon( $settings['right_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
    <?php } ?>

<?php } ?>
