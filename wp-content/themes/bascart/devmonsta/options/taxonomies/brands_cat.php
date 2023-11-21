<?php
use Devmonsta\Libs\Taxonomies;

class Brands_Cat extends Taxonomies {
    public function register_controls() {
        $this->add_control( [
            'name'     => 'brand_image',
            'type'     => 'upload',
            'label'    => esc_html__( 'Brand Image', 'bascart' ),
            'desc'     => esc_html__( 'Brand Image of this category', 'bascart' ),
        ] );
    }
}