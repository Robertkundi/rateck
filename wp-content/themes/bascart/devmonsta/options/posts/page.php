<?php
use Devmonsta\Libs\Posts;
class Page extends Posts
{

    public function register_controls()
    {
        $this->add_box([
            'id' => 'page_post_meta',
            'post_type' => 'page',
            'title' => esc_html__('Page Settings', 'bascart'),
        ]);
        /**
         * control for text input
         */

        $this->add_control( [
            'box_id' => 'page_post_meta',
            'type'   => 'switcher',
            'name'   => 'page_meta_show_banner',
            'value'  => 'yes',
            'label'  => esc_html__('Show banner?', 'bascart'),
            'desc'   => esc_html__('Show or hide the banner', 'bascart'),
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control( [
            'box_id' => 'page_post_meta',
            'type'   => 'switcher',
            'name'   => 'page_meta_show_breadcumb',
            'value'  => 'yes',
            'label'  => esc_html__('Show Breadcumb?', 'bascart'),
            'desc'   => esc_html__('Show or hide the breadcumb', 'bascart'),
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control( [
            'box_id' => 'page_post_meta',
            'type'   => 'switcher',
            'name'   => 'page_meta_title_breadcumb_align',
            'value'  => 'no',
            'label'  => esc_html__('Title & Breadcrumb Center?', 'bascart'),
            'desc'   => esc_html__('Title & Breadcrumb Center Alignment?', 'bascart'),
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'box_id' => 'page_post_meta',
            'type'   => 'text',
            'name'   => 'header_title',
            'desc'   => esc_html__('Add your Page hero title', 'bascart'),
            'label'  => esc_html__('Banner Title', 'bascart'),
        ]);

        $this->add_control([
            'box_id' => 'page_post_meta',
            'section'  => 'banner_page_settings',
            'name' => 'page_meta_banner_title_color',
            'desc'   => esc_html__('Add your Page hero title Color', 'bascart'),
            'type'     => 'color-picker',
            'default' => '',
            'label'    => esc_html__('Banner Title Color', 'bascart'),
        ]);

        $this->add_control([
            'box_id' => 'page_post_meta',
            'section'  => 'banner_page_settings',
            'name' => 'page_meta_breadcrumb_color',
            'desc'   => esc_html__('Add your Page Breadcrumb Color', 'bascart'),
            'type'     => 'color-picker',
            'default' => '',
            'label'    => esc_html__('Breadcrumb Color', 'bascart'),
        ]);


        $this->add_control([
            'box_id' => 'page_post_meta',
            'type'   => 'upload',
            'name'   => 'header_image',
            'desc'   => esc_html__('Upload a page header image', 'bascart'),
            'label'  => esc_html__('Banner image', 'bascart'),
        ]);
    }
}
