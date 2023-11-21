<?php
namespace Elementor;
if(!empty($settings['wishlist_url']['url'])) {
    $this->add_link_attributes('wishlist_url', $settings['wishlist_url']);
}
$show_wishlist_title = $settings['show_wishlist_title'];
$wishlist_widget_title = $settings['wishlist_title'];

if(class_exists('ShopEngine') && is_user_logged_in()) : 
$list = !empty(get_user_meta(get_current_user_id(), 'shopengine_wishlist', true)) ? get_user_meta(get_current_user_id(), 'shopengine_wishlist', true) : '0';
?>
    <a <?php echo $this->get_render_attribute_string('wishlist_url'); ?>>
        <div class="wishlist-content">
            <?php Icons_Manager::render_icon($settings['wishlist_icon'], ['aria-hidden' => 'true']); ?>
            <span class="wishlist-count">
                <?php
                    if(is_array($list) && count($list) > 0){
                        $list = $list;
                    }else{
                        $list = explode(',', $list);
                    }
                    echo count(array_filter($list)); 
                ?>
            </span>
        </div>
        <?php if($show_wishlist_title == 'yes') : ?>
            <p class="wishlist-widget-title"><?php echo esc_html($wishlist_widget_title)?></p>
        <?php endif;?>
    </a>
<?php else : ?>
    <a <?php echo $this->get_render_attribute_string('wishlist_url'); ?>>
        <div class="wishlist-content">
            <?php Icons_Manager::render_icon($settings['wishlist_icon'], ['aria-hidden' => 'true']); ?>
        </div>
        <?php if($show_wishlist_title == 'yes') : ?>
            <p class="wishlist-widget-title"><?php echo esc_html($wishlist_widget_title)?></p>
        <?php endif;?>
    </a>
<?php endif;