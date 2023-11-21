<?php 
    $profile_urls = '';
    $custom_link_show = $settings['custom_link_show'];
    $user_custom_link = $settings['user_custom_link'];
    $icon_with_text_show = $settings['icon_with_text_show'];
    $icon_with_text = $settings['icon_with_text'];
    // $target = $settings['user_custom_link']['is_external'] ? ' target="_blank"' : '';
    // $nofollow = $settings['user_custom_link']['nofollow'] ? ' rel="nofollow"' : '';
    $profile_url = '#';
?>
<div class="login-user">
    <?php 
        
        $profile_url = get_option( 'woocommerce_myaccount_page_id' );
        if ( $profile_url ) {
            $profile_url = get_permalink( $profile_url );
        }
        ?>

        <a href="<?php echo esc_url($profile_url); ?>">
            
            <?php \Elementor\Icons_Manager::render_icon( $settings['user_login_icon'], [ 'aria-hidden' => 'true' ] ); ?>

            <?php if ($icon_with_text_show == 'yes') : ?>
                <?php if (is_user_logged_in()) { ?>
                    <span><?php echo esc_html__('My account', 'bascart'); ?></span>
                <?php } else { ?>
                    <span><?php echo esc_html($icon_with_text); ?></span>
                <?php } ?>
            <?php endif; ?>
        </a>
        <?php if (is_user_logged_in()) { ?>
            <div class="menu-list">
                <a href="<?php echo esc_url($profile_url); ?>">
                    <?php if (is_user_logged_in()) { ?>
                        <span><?php echo esc_html__('My account', 'bascart'); ?></span>
                    <?php } else { ?>
                        <span><?php echo esc_html($icon_with_text); ?></span>
                    <?php } ?>
                </a>
                <!-- login menu-list --> 
                <?php
                if($settings['select_menu'] != '' && wp_get_nav_menu_items($settings['select_menu']) !== false && count(wp_get_nav_menu_items($settings['select_menu'])) > 0){
                    $args = [
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'container'       => 'div',
                        'container_id'    => '',
                        'container_class' => 'list-menu-container',
                        'menu_id'         => 'list-menu',
                        'menu'         	  => $settings['select_menu'],
                        'menu_class'      => 'menu-item-wrap list-unstyled',
                        'depth'           => 1,
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                    ];
                    wp_nav_menu($args);
                }
                ?>
                <!-- login list end -->
            </div>
    <?php } ?>
</div>