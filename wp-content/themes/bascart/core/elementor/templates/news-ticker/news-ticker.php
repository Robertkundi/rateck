<?php if ($posts) : ?>
    <div class="tranding-bg-white">
        <div class="tranding-bar">
            <div id="tredingcarousel" class="trending-slide trending-slide-bg">
                <?php if ($title != '') { ?>
                    <p class="trending-title"><?php echo esc_html($title); ?></p>
                <?php } ?>
                <div class="swiper-container bascart-<?php echo esc_attr($this->get_name()); ?>" data-widget_settings='<?php echo json_encode($settings); ?>' ">
                    <div class="swiper-wrapper">
                        <?php foreach ($posts as $post): ?>
                            <div class="swiper-slide">
                                <div class="post-content">
                                    <p class="post-title title-small">
                                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                            <?php
                                            echo esc_html(wp_trim_words(get_the_title($post->ID), $post_title_crop, ''));?>
                                        </a>
                                    </p>
                                </div><!--/.post-content -->
                            </div><!--/.swiper-slide -->
                        <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    </div> <!--/.swiper-wrapper-->

                    <?php if ($newsticker_nav_enable == 'yes'): ?>
                        <div class="swiper-navigation-wrapper">
                            <div class="swiper-button-prev">
                                <i class="xts-icon xts-chevron-left"></i>
                            </div>
                            <div class="swiper-button-next">
                                <i class="xts-icon xts-chevron-right"></i>
                            </div>
                        </div>
                    <?php endif; ?>
                </div><!--/.swiper-container-->
            </div>
        </div> <!--/.tranding-bar-->
    </div>
<?php endif; ?>