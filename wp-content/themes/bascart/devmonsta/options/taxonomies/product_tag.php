<?php
use Devmonsta\Libs\Taxonomies;

class Product_Tag extends Taxonomies {
    public function register_controls() {
        $this->add_control( [
            'name'     => 'bascart_tag_bg_color',
            'type'     => 'color-picker',
            'label'    => esc_html__( 'Background Color', 'bascart' ),
            'desc'     => esc_html__( 'Background Color of this tag', 'bascart' ),
        ] );
    }
}
