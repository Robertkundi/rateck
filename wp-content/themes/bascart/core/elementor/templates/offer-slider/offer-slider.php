<?php 
    $show_nav_controls = $settings['show_nav_controls'];
    $show_pagination = $settings['show_pagination'];
    $swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
?>

<div class="offer-slider <?php echo esc_attr($swiper_class); ?>">
    <div class="swiper-wrapper">
    <?php foreach($slider_items as $items): ?>  
        <?php 
            $offer_img = $items['offer_image']['url'];
            $offer_url = $items['offer_link']['url'];
            $target = $items['offer_link']['is_external'] ? ' target=_blank' : '';
            $nofollow = $items['offer_link']['nofollow'] ? ' rel=nofollow' : '';
        ?>
        <div class="swiper-slide">
            <div class="offer-wrapper">
                <a href="<?php echo esc_url($offer_url); ?>" <?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>>
                    <div class="offer-thumb">
                        <img src="<?php echo esc_url($offer_img); ?>" alt="<?php echo esc_html($items['offer_title']); ?>">
                    </div>
                    <div class="offer-content">
                        <div class="offer">
                            <?php echo esc_html($items['offer_title']); ?>
                            <span class="offer-amount"><?php echo esc_html($items['offer_amount']); ?></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php if($show_nav_controls =='yes'){ ?>
        <!-- next / prev arrows -->
        <div class="swiper-button-next"> 
            <?php \Elementor\Icons_Manager::render_icon( $settings['right_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="swiper-button-prev">
            <?php \Elementor\Icons_Manager::render_icon( $settings['left_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <!-- !next / prev arrows -->
    <?php } ?>

    <?php if($show_pagination =='yes'){ ?>
            <div class="swiper-pagination"></div>
    <?php } ?>
</div>