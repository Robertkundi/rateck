<?php
    $category_ids        = (is_array($settings['category']) && !empty($settings['category'])) ? $settings['category'] : '';
    $single_cat_list     = $settings['single_cat_list'];
    $show_count          = $settings['show_count'];
    $show_icon           = $settings['show_icon'];
    $show_title          = $settings['show_title'];
    $style               = $settings['style'];
    $column              =  $settings['column'];
    $order               =  $settings['order'];

    $taxonomy            = 'brands_cat';
    $args_cat = array(
        'taxonomy' => $taxonomy,
        'limit' => '-1',
        'hide_empty' => true,
        'order' => $order,
    );
    if($style == 'style-1' || $style == 'style-3'){
       $args_cat['include'] = $category_ids;
       $cats = get_categories( $args_cat );
    }else{
        $cats = $single_cat_list;
    }

    $item_column_gap = (isset($settings['item_column_gap']['size']) && (empty($settings['item_column_gap']['size']) || $settings['item_column_gap']['size'] <= 0)) ? 'no-space-between' : 'space-between';
    $swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
?> 

<?php if($style == 'style-3') : ?>
    <div class="<?php echo esc_attr($swiper_class); ?> product-brand-wrap">
        <div class="swiper-wrapper">
            <?php foreach($cats as $value) : ?>
                <?php 
                    if($style == 'style-3'){
                        $term = get_term($value,$taxonomy);
                        $thumbnail_id   = get_term_meta( $value->term_id, 'devmonsta_brand_image', true );
                        $image_url = wp_get_attachment_url( $thumbnail_id );
                        $widget_id = $value->term_id;
                    }
                    $term_link = get_term_link($term->slug, $taxonomy);
                    ?>
                <div class="swiper-slide">
                    <a class="single-brand-slide-item" href="<?php echo esc_url($term_link); ?>">
                        <?php if($show_icon=='yes' && !empty($image_url)) : ?>
                            <div class="brand-img">
                                <?php echo wp_get_attachment_image($thumbnail_id, 'full'); ?>
                            </div>
                        <?php endif; ?>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php if($settings['show_navigation'] == 'yes') : ?>
        <div class="category-slider-nav-item swiper-button-prev swiper-prev-<?php echo esc_attr($this->get_id()); ?>">
            <?php \Elementor\Icons_Manager::render_icon( $settings['left_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="category-slider-nav-item swiper-button-next swiper-next-<?php echo esc_attr($this->get_id()); ?>"> 
            <?php \Elementor\Icons_Manager::render_icon( $settings['right_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
    <?php endif ?>

<?php else : ?>
    <div class="bascart-product-brand-wrapper <?php echo esc_attr($style); ?>">
        <div class="bascart-grid <?php echo esc_attr($item_column_gap); ?>">
            <?php  foreach($cats as $value) : ?>
                <div class="single-brand-item ">
                    <?php 
                    if($style == 'style-1'){
                        $term = get_term($value,$taxonomy);
                        $thumbnail_id   = get_term_meta( $value->term_id, 'devmonsta_brand_image', true );
                        $image_url = wp_get_attachment_url( $thumbnail_id );
                        $widget_id = $value->term_id;
                    }else if($style == 'style-2'){
                        $term = get_term($value['single_category'],$taxonomy);
                        $thumbnail_id   = get_term_meta( $value['single_category'], 'devmonsta_brand_image', true );
                        $image_id = (!empty($value['cat_image']['id'])) ? $value['cat_image']['id'] : $thumbnail_id; 
                        $widget_id = $value['_id'];
                    }
                    $term_link = get_term_link($term->slug, $taxonomy);
                    ?>
                    <div class="product-brand-wrap elementor-repeater-item-<?php echo esc_attr($widget_id); ?>">
                        <a href="<?php echo esc_url($term_link); ?>">
                            <?php if($show_icon=='yes' && !empty($image_id) ){?>
                                <div class="brand-img">
                                    <?php echo wp_get_attachment_image($image_id, 'full'); ?>        
                                </div>
                            <?php }  ?>
                            <?php if($show_title == 'yes'){ ?>
                                <h3 class="product-brand-title">
                                    <?php echo esc_html($term->name); ?>
                                </h3>
                            <?php } ?>
                            <?php if($show_count =='yes'){ ?>
                                <p class="cat-count"> 
                                    <?php
                                        echo number_format_i18n( $term->count ) . esc_html__(' products ', 'bascart');
                                    ?>
                                </p>
                            <?php } ?>
                        </a>
                    </div> 
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
