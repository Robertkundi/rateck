<?php
if(class_exists('WeDevs_Dokan')) :
	$sellers = dokan_get_sellers();
	$show_banner = $settings['show_banner'];
	$show_avatar = $settings['show_avatar'];
	$show_button = $settings['show_button'];
	?>
    <div class="ts-vendor-grid-wrapper">
		<?php foreach($sellers['users'] as $seller) : ?>
            <div class="ts-single-vendor">
				<?php
				$vendor            = dokan()->vendor->get($seller->ID);
				$store_banner_id   = $vendor->get_banner_id();
				$store_name        = $vendor->get_shop_name();
				$store_url         = $vendor->get_shop_url();
				$is_store_featured = $vendor->is_featured();
				$store_phone       = $vendor->get_phone();
				$store_info        = dokan_get_store_info($seller->ID);
				$store_address     = dokan_get_seller_short_address($seller->ID);
				$store_banner_url  = $store_banner_id ? wp_get_attachment_image_src($store_banner_id, 'full') : DOKAN_PLUGIN_ASSEST . '/images/default-store-banner.png';
				?>
                <div class="store-wrapper">

                    <div class="store-header">
						<?php if('yes' === $show_banner) : ?>
                            <div class="store-banner">
                                <a href="<?php echo esc_url($store_url); ?>">
                                    <img src="<?php echo is_array($store_banner_url) ? esc_attr($store_banner_url[0]) : esc_attr($store_banner_url); ?>">
                                </a>
                            </div>
						<?php endif; ?>
						<?php if('yes' === $show_avatar) : ?>
                            <div class="seller-avatar">
                                <a href="<?php echo esc_url($store_url); ?>">
                                    <img src="<?php echo esc_url($vendor->get_avatar()) ?>"
                                         alt="<?php echo esc_attr($vendor->get_shop_name()) ?>"
                                         size="150">
                                </a>
                            </div>
						<?php endif; ?>
                    </div>

                    <div class="store-content <?php echo !$store_banner_id ? esc_attr('default-store-banner') : '' ?>">
                        <div class="store-data-container">

                            <div class="store-data">
                                <h2 class="vendor-title">
                                    <a href="<?php echo esc_attr($store_url); ?>"><?php echo esc_html($store_name); ?></a> <?php apply_filters('dokan_store_list_loop_after_store_name', $vendor); ?>
                                </h2>

								<?php if(!dokan_is_vendor_info_hidden('address') && $store_address): ?>
									<?php
									$allowed_tags = array(
										'span' => array(
											'class' => array(),
										),
										'br'   => array()
									);
									?>
                                    <p class="store-address"><i aria-hidden="true"
                                                                class="xts-icon xts-map"></i><?php echo wp_kses($store_address, $allowed_tags); ?>
                                    </p>
								<?php endif ?>
                            </div>
                        </div>
						<?php if('yes' === $show_button) : ?>
                            <div class="store-footer">
                                <a class="ts-vendor-button" href="<?php echo esc_url($store_url); ?>"
                                   title="<?php esc_attr_e('Visit Store', 'dokan-lite'); ?>">
                                    <i aria-hidden="true" class="xts-icon xts-chevron-right"></i>
                                </a>
                            </div>
						<?php endif; ?>
                    </div>
                </div>

            </div>
		<?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="ts-notice"><?php esc_html_e('Pleae install and active Dokan Multivendor Plugin to use this widget.', 'bascart'); ?></div>
<?php endif; ?>