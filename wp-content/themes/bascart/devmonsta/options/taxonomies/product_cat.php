<?php
use Devmonsta\Libs\Taxonomies;

class Product_Cat extends Taxonomies {
    public function register_controls() {
        $this->add_control( [
            'name'     => 'bascart_product_cat_icon_class',
            'type'     => 'text',
            'label'    => esc_html__( 'Icon Class Name', 'bascart' ),
            'desc'     => esc_html__( 'Select icon', 'bascart' ),
        ] );
        $this->add_control( [
            'name'     => 'bascart_product_cat_bg_color',
            'type'     => 'color-picker',
            'label'    => esc_html__( 'Background Color', 'bascart' ),
            'desc'     => esc_html__( 'Background Color of this category', 'bascart' ),
            'default'  => '#E4E8F8'
        ] );
    }
}
