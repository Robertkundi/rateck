<?php
$category_ids        = (is_array($settings['category']) && !empty($settings['category'])) ? $settings['category'] : '';
$single_cat_list     = $settings['single_cat_list'];
$show_count          = $settings['show_count'];
$show_icon           = $settings['show_icon'];
$style               = $settings['style'];
$column              =  $settings['column'];

$taxonomy            = 'product_cat';

$args_cat = array(
    'taxonomy' => $taxonomy,
    'limit' => '-1',
    'hide_empty' => true,
);
if ($style == 'style-1') {
    $args_cat['include'] = $category_ids;
    $cats = get_categories($args_cat);
    $row_class = 'row';
    $column_class = "col-md-{$column} col-lg-{$column}";
} else if ($style == 'style-2') {
    $cats = $single_cat_list;
    $row_class = 'category-parent-wrap';
    $column_class = 'cat-list-item';
} else if ($style == 'style-3' || $style == 'list-style-3') {
    $cats = $single_cat_list;
    $row_class = 'category-list-wrap bascart-grid';
    $column_class = 'single-cat-list-item';
} else if ($style == 'style-4') {
    $cats = $single_cat_list;
    $row_class = 'category-grid-wrap';
    $column_class = 'single-cat-grid-item';
} else if ($style == 'style-5') {
    $cats = $single_cat_list;
    $row_class = 'category-list-wrap-2';
    $column_class = 'single-cat-list-item'; 
} else if($style == 'grid-style-3') {
    $cats = $single_cat_list;
    $row_class = 'row';
    $column_class = "col-md-{$column} col-lg-{$column}";
} else {
    $cats = $single_cat_list;
    $row_class = 'category-grid-wrap';
    $column_class = 'single-cat-grid-item';
}
?>
<div class="bascart-product-category-wrapper <?php echo esc_attr($style); ?>">
    <div class="<?php echo esc_attr($row_class); ?>">

        <?php foreach ($cats as $value) :

            if ($style == 'style-1') {
                $term = get_term($value, $taxonomy);
                $thumbnail_id   = get_term_meta($value->term_id, 'thumbnail_id', true);
                $image_url = wp_get_attachment_url($thumbnail_id);
                $widget_id = $value->term_id;
                $show_description    = 'no';
            } else if ($style == 'style-2' || $style == 'style-4') {
                $term = get_term($value['single_category'], $taxonomy);
                $thumbnail_id   = get_term_meta($value['single_category'], 'thumbnail_id', true);
                $image_url = (!empty($value['cat_image']['url'])) ? $value['cat_image']['url'] : wp_get_attachment_url($thumbnail_id);
                $widget_id = $value['_id'];
                $show_description    = $value['show_description'];
                if ($style == 'style-2') {
                    echo ' <div class="grid-sizer"></div>';
                }
            } else if ($style == 'style-3' || $style == 'style-5' || $style == 'list-style-3' || $style == 'grid-style-3') {
                $term = get_term($value['single_category'], $taxonomy);
                $image_url = (!empty($value['cat_image']['url'])) ? $value['cat_image']['url'] : '';
                $widget_id = $value['_id'];
                $show_description    = $value['show_description'];
            }

            if($style == 'grid-style-3') {
                if (!empty($term)) : ?>
                <div class="<?php echo esc_attr($column_class); ?>">
                    <div class="grid-style-3-wrapper">
                        <a class="product-category-wrap elementor-repeater-item-<?php echo esc_attr($widget_id); ?>" href="<?php echo esc_url(get_term_link($term->slug, $taxonomy)); ?>" <?php if($style == 'grid-style-3'): ?> style="background-image: url(<?php echo esc_url($image_url); ?>)" <?php endif; ?>>
                            <h3 class="product-category-title">
                                <?php echo esc_html($term->name); ?>
                            </h3>
                            <?php if ($show_icon == 'yes') { ?>
                                <span class="cat-icon">
                                    <?php echo esc_html($settings['button_text']); ?>
                                    <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                </span>
                            <?php }  ?>
                        </a>
                    </div>
                </div>
                <?php endif;
            } else {
                if (!empty($term)) : ?>
                    <div class="<?php echo esc_attr($column_class); ?>">
                        <a class="bascart-product-category-item" href="<?php echo esc_url(get_term_link($term->slug, $taxonomy)); ?>">
                            <div class="product-category-wrap elementor-repeater-item-<?php echo esc_attr($widget_id); ?>" 
                                <?php if($style !== 'list-style-3'): ?>
                                    style="background-image: url(<?php echo esc_url($image_url); ?>)"
                                <?php endif; ?>
                            >   
                                <?php if($style === 'list-style-3'): ?>
                                    <div class="product-category-image">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_html($term->name); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="single-product-category">
                                    <?php
                                    $icon_class = '';
                                    $bg_color = '';
                                    if ( defined( 'DEVM' ) ) {
                                        $icon_class = '<i class="'.devm_taxonomy( $term->term_id, 'devmonsta_bascart_product_cat_icon_class', true).'"></i>';
                                        $bg_color = 'style="background-color: '.esc_attr(devm_taxonomy( $term->term_id, 'devmonsta_bascart_product_cat_bg_color', true)).';"';
                                    }
                                    ?>
                                    <h3 class="product-category-title" <?php if($style !== 'list-style-3') {echo bascart_kses($bg_color);}; ?>>
                                        <?php if($style !== 'style-5' && $style !== 'list-style-3') {
                                            echo bascart_kses($icon_class);
                                        }; ?>
                                        <?php echo esc_html($term->name); ?>
                                        <?php if($style == 'style-5') {
                                            echo bascart_kses($icon_class);
                                        }; ?>
                                    </h3>
                                    <?php if ($show_description == 'yes') { ?>
                                        <p class="category-description">
                                            <?php echo esc_html($term->description); ?>
                                        </p>
                                    <?php } ?>
                                    <?php if ($show_count == 'yes') { ?>
                                        <p class="cat-count">
                                            <?php
                                            echo number_format_i18n($term->count) . esc_html__(' products ', 'bascart');
                                            ?>
                                        </p>
                                    <?php } ?>
                                    <?php if ($show_icon == 'yes') { ?>
                                        <span class="cat-icon">
                                            <?php echo esc_html($settings['button_text']); ?>
                                            <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                    <?php }  ?>

                                    <!-- dot shap -->
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif;
            }


        endforeach; ?>

    </div>
</div>
<?php
