<?php 
    use \ElementsKit_Lite\Modules\Controls\Widget_Area_Utils as Widget_Area_Utils;
    $ekit_tab_items = $settings['tab_items'];
    $show_nav_controls = $settings['show_nav_controls'];
    $show_pagination = $settings['show_pagination'];
    $effect_style = $settings['effect_style'];
    $widget_id = $settings['widget_id'];
    $settings['widget_id'] = $this->get_id();
    $swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
?>
<div class="bascart-slider-wrapper <?php echo esc_attr($swiper_class); ?>" data-effect="<?php echo esc_attr($effect_style); ?>">
    <div class="swiper-wrapper">
        <?php foreach ($ekit_tab_items as $i=>$tab) : ?>
            <div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $tab[ '_id' ] ); ?>">
                <?php  echo Widget_Area_Utils::parse( $tab['tab_content'], $widget_id, ($i + 1) ); ?>
            </div>

        <?php endforeach; ?>
    </div>
    <?php if($show_nav_controls =='yes'){ ?>
        <!-- next / prev arrows -->
        <div class="swiper-button-next swiper-next-<?php echo esc_attr($this->get_id()); ?>"> 
            <?php \Elementor\Icons_Manager::render_icon( $settings['right_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="swiper-button-prev swiper-prev-<?php echo esc_attr($this->get_id()); ?>">
            <?php \Elementor\Icons_Manager::render_icon( $settings['left_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <!-- !next / prev arrows -->
    <?php } ?>
    <?php if($show_pagination =='yes'){ ?>
            <div class="swiper-pagination"></div>
    <?php } ?>

</div>