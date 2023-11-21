<?php
class Customizer extends \Devmonsta\Libs\Customizer
{

    public function register_controls()
    {

        /**
         * Add parent panels
         */

        $this->add_panel([
            'id'             => 'xs_theme_option_panel',
            'priority'       => 0,
            'theme_supports' => '',
            'title'          => esc_html__('Theme settings', 'bascart'),
            'description'    => esc_html__('Theme options panel', 'bascart'),
        ]);

        /*******************************************
         * Shop swatch settings here
         ******************************************/
        $this->add_section([
            'id'       => 'xs_swatch_settings_section',
            'title'    => esc_html__('WooCommerce Settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 1,
        ]);

        $this->add_control([
            'id'      => 'show_swatch',
            'type'    => 'switcher',
            'default' => 'no',
            'label'   => esc_html__('Show Swatches?', 'bascart'),
            'desc'    => esc_html__('Show or hide Swatches', 'bascart'),
            'section' => 'xs_swatch_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        /*******************************************
         * Header settings here
         ******************************************/
        $this->add_section([
            'id'       => 'xs_header_settings_section',
            'title'    => esc_html__('Header Settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 1,
        ]);

        /**
         * Header builder switch here
         */
        $this->add_control([
            'id'      => 'header_builder_enable',
            'type'    => 'switcher',
            'default' => 'no',
            'label'   => esc_html__('Header builder Enable ?', 'bascart'),
            'desc'    => esc_html__('Do you want to enable n in header ?', 'bascart'),
            'section' => 'xs_header_settings_section',
            'attr'    => ['class' => 'xs_header_builder_switch'],
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);
        
        $this->add_control([
            'id'      => 'header_builder_select_html',
            'section' => 'xs_header_settings_section',
            'type'    => 'html',
            'value'   => '<h2 class="header_builder_edit"><a class="xs_builder_edit_link" style="text-transform: uppercase; color:green; margin: 0 0 10px;"  target="_blank" href="'.esc_url(admin_url('edit.php?post_type=elementskit_template')).'">'. esc_html('Go to Header Builder.'). '</a><h2><h3><a style="text-transform: uppercase; color:#17a2b8" target="_blank" href="https://support.xpeedstudio.com/knowledgebase/customize-carrental-header-and-footer-builder/">'. esc_html__('How to edit header', 'bascart'). '</a><h3>',
            'attr'    => ['class' => 'xs_header_builder_html'],
            // 'conditions' => [
            //     [
            //         'control_name'  => 'header_builder_enable',
            //         'operator' => '==',
            //         'value'    => "yes",
            //     ]
            // ],
        ]);
        $this->add_control([
            'id'      => 'header_nav_search_section',
            'type'    => 'switcher',
            'default' => 'right-choice',
            'label'   => esc_html__('Search button show', 'bascart'),
            'desc'    => esc_html__('Do you want to show search button in header?', 'bascart'),
            'section' => 'xs_header_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        /*********************************************************
         * General settings
        *********************************************************/

        $this->add_section([
            'id'       => 'general_settings_section',
            'title'    => esc_html__( 'General settings', "bascart" ),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 0
        ]);

        $this->add_control([
            'id'          => 'main_logo',
            'type'        => 'media',
            'section'     => 'general_settings_section',
            'label'       => esc_html__('Main Logo', 'bascart'),
            'description' => esc_html__('This is default logo. Our most of the menu built with elemnetsKit header builder. Go to header settings->Header builder enable->  and click "edit header content" to change the logo', 'bascart'),
        ]);

        $this->add_control([
            'id'      => 'preloader_show',
            'type'    => 'switcher',
            'default' => 'no',
            'label'   => esc_html__( 'Preloader show', 'bascart' ),
            'desc'    => esc_html__( 'Do you want to show preloader on your site ?', 'bascart' ),
            'section' => 'general_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'preloader_logo',
            'type'    => 'media',
            'section' => 'general_settings_section',
            'label'   => esc_html__( 'Preloader logo', 'bascart' ),
        ]);
        
        /********************************************************
        * banner settings
        *********************************************************/

        $this->add_panel([
            'id'             => 'banner_settings_section',
            'title'          => esc_html__( 'Banner settings', "bascart" ),
            'panel'          => 'xs_theme_option_panel',
            'priority'       => 5,
        ]);

        $this->add_section([
            'id'       => 'banner_page_settings',
            'title'    => esc_html__( 'Page banner', "bascart" ),
            'panel'    => 'banner_settings_section',
        ]);

        /**
         * page banner control start here
        */

        $this->add_control([
            'id'      => 'page_show_banner',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Show banner?', 'bascart'),
            'desc'    => esc_html__('Show or hide the banner', 'bascart'),
            'section' => 'banner_page_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'page_show_breadcrumb',
            'type'    => 'switcher',
            'default' => 'right-choice',
            'label'   => esc_html__('Show Breadcrumb?', 'bascart'),
            'desc'    => esc_html__('Show or hide the Breadcrumb', 'bascart'),
            'section' => 'banner_page_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'    => 'page_banner_title',
            'type'  => 'text',
            'label' => esc_html__('Banner Title', 'bascart'),
            'section' => 'banner_page_settings',
        ]);

        $this->add_control([
            'id'      => 'banner_page_image',
            'type'    => 'media',
            'section' => 'banner_page_settings',
            'label'   => esc_html__('Banner Background', 'bascart'),
        ]);
        $this->add_control([
            'id'       => 'page_banner_title_color',
            'section'  => 'banner_page_settings',
            'type'     => 'color-picker',
            'default' => '#fff',

            'label'    => esc_html__('Title Color', 'bascart'),
        ]);

        $this->add_control([
            'id'       => 'page_banner_breadcrumb_color',
            'section'  => 'banner_page_settings',
            'type'     => 'color-picker',
            'default' => '#fff',

            'label'    => esc_html__('Breadcrumb Color', 'bascart'),
        ]);

        $this->add_control([
            'id'      => 'title_breadcrumb_center_align',
            'type'    => 'switcher',
            'default' => 'left-choice',
            'label'   => esc_html__('Title & Breadcrumb Center?', 'bascart'),
            'desc'    => esc_html__('Breadcrumb Center ', 'bascart'),
            'section' => 'banner_page_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);
        
        $this->add_control([
            'id'       => 'page_banner_overlay_color',
            'section'  => 'banner_page_settings',
            'type'     => 'rgba-color-picker',
            'default' => 'rgba(0,0,0, .02)',
            'label'    => esc_html__('Overlay Color', 'bascart'),
        ]);


        /**
         * blog banner panel
         */

        $this->add_section([
            'id'       => 'banner_blog_settings',
            'title'    => esc_html__( 'Blog banner', "bascart" ),
            'panel'    => 'banner_settings_section',
        ]);

        /**
         * blog banner control start here
         */

        $this->add_control([
            'id'      => 'blog_show_banner',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Show banner?', 'bascart'),
            'desc'    => esc_html__('Show or hide the banner', 'bascart'),
            'section' => 'banner_blog_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_show_breadcrumb',
            'type'    => 'switcher',
            'default' => 'right-choice',
            'label'   => esc_html__('Show Breadcrumb?', 'bascart'),
            'desc'    => esc_html__('Show or hide the Breadcrumb', 'bascart'),
            'section' => 'banner_blog_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'    => 'blog_banner_title',
            'type'  => 'text',
            'default' => esc_html__( 'Blog', 'bascart' ),
            'label' => esc_html__('Banner Title', 'bascart'),
            'section' => 'banner_blog_settings',
        ]);
        
        $this->add_control([
            'id'      => 'banner_blog_image',
            'type'    => 'media',
            'section' => 'banner_blog_settings',
            'label'   => esc_html__('Banner Background', 'bascart'),
        ]);


        $this->add_control([
            'id'       => 'banner_title_color',
            'section'  => 'banner_blog_settings',
            'type'     => 'color-picker',
            'default' => '#fff',

            'label'    => esc_html__('Title Color', 'bascart'),
        ]);
        
        $this->add_control([
            'id'       => 'banner_overlay_color',
            'section'  => 'banner_blog_settings',
            'type'     => 'rgba-color-picker',
            'default' => 'rgba(0,0,0, .02)',

            'label'    => esc_html__('Overlay Color', 'bascart'),
        ]);



        /**
         * blog single banner panel
         */

        $this->add_section([
            'id'       => 'banner_blog_single_settings',
            'title'    => esc_html__( 'Blog single banner', "bascart" ),
            'panel'    => 'banner_settings_section',
        ]);

        /**
         * blog banner single control start here
         */

        $this->add_control([
            'id'      => 'blog_single_show_banner',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Show banner?', 'bascart'),
            'desc'    => esc_html__('Show or hide the banner', 'bascart'),
            'section' => 'banner_blog_single_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'    => 'blog_single_banner_title',
            'type'  => 'text',
            'default' => esc_html__( 'Blog Single', 'bascart' ),
            'label' => esc_html__('Banner Title', 'bascart'),
            'section' => 'banner_blog_single_settings',
        ]);

        $this->add_control([
            'id'      => 'blog_single_show_breadcrumb',
            'type'    => 'switcher',
            'default' => 'right-choice',
            'label'   => esc_html__('Show Breadcrumb?', 'bascart'),
            'desc'    => esc_html__('Show or hide the Breadcrumb', 'bascart'),
            'section' => 'banner_blog_single_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'banner_blog_single_image',
            'type'    => 'media',
            'section' => 'banner_blog_single_settings',
            'label'   => esc_html__('Banner Background', 'bascart'),
        ]);

        $this->add_control([
            'id'       => 'details_banner_title_color',
            'section'  => 'banner_blog_single_settings',
            'type'     => 'color-picker',
            'default' => '#fff',
            'label'    => esc_html__('Title Color', 'bascart'),
        ]);
        
        $this->add_control([
            'id'       => 'details_banner_overlay_color',
            'section'  => 'banner_blog_single_settings',
            'type'     => 'rgba-color-picker',
            'default' => 'rgba(0,0,0, .02)',

            'label'    => esc_html__('Overlay Color', 'bascart'),
        ]);

         /**
         * woo banner panel
         */

        $this->add_section([
            'id'       => 'banner_woo_settings',
            'title'    => esc_html__( 'WooCommerce banner', "bascart" ),
            'panel'    => 'banner_settings_section',
        ]);

        /**
         * blog banner control start here
         */

        $this->add_control([
            'id'      => 'woo_show_banner',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Show banner?', 'bascart'),
            'desc'    => esc_html__('Show or hide the banner', 'bascart'),
            'section' => 'banner_woo_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'woo_show_breadcrumb',
            'type'    => 'switcher',
            'default' => 'right-choice',
            'label'   => esc_html__('Show Breadcrumb?', 'bascart'),
            'desc'    => esc_html__('Show or hide the Breadcrumb', 'bascart'),
            'section' => 'banner_woo_settings',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'    => 'woo_banner_title',
            'type'  => 'text',
            'default' => esc_html__( 'Products', 'bascart' ),
            'label' => esc_html__('Banner Title', 'bascart'),
            'section' => 'banner_woo_settings',
        ]);
        
        $this->add_control([
            'id'      => 'banner_woo_image',
            'type'    => 'media',
            'section' => 'banner_woo_settings',
            'label'   => esc_html__('Banner Background', 'bascart'),
        ]);


        $this->add_control([
            'id'       => 'woo_banner_title_color',
            'section'  => 'banner_woo_settings',
            'type'     => 'color-picker',
            'default' => '#fff',

            'label'    => esc_html__('Title Color', 'bascart'),
        ]);
        
        $this->add_control([
            'id'       => 'woo_banner_overlay_color',
            'section'  => 'banner_woo_settings',
            'type'     => 'rgba-color-picker',
            'default' => 'rgba(0,0,0, .02)',
            'label'    => esc_html__('Overlay Color', 'bascart'),
        ]);


        

        /***********************************
         * Typography settings here
         ************************************/
        $this->add_section([
            'id'       => 'typography_settings_section',
            'title'    => esc_html__('Style settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 0,

        ]);

        /**
         * body background control
         */
        $this->add_control([
            'id'      => 'style_body_bg',
            'label'   => esc_html__('Body background', 'bascart'),
            'type'    => 'color-picker',
            'section' => 'typography_settings_section',
            'default' => '#FFFFFF',
        ]);

        /**
         * primary color control
         */
        $this->add_control([
            'id'      => 'style_primary',
            'label'      => esc_html__('Primary color', 'bascart'),
            'type'    => 'color-picker',
            'section' => 'typography_settings_section',
            'default' => '#ee4d4d',
        ]);

        /**
         * secondary color control
         */
        $this->add_control([
            'id'      => 'secondary_color',
            'label'      => esc_html__('Secondary color', 'bascart'),
            'type'    => 'color-picker',
            'section' => 'typography_settings_section',
            'default' => '#a352ff',
        ]);

        $this->add_control([
            'id'      => 'google_fonts_load',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Google Fonts Load?', 'bascart'),
            'desc'    => esc_html__('Do you want to load google fonts?', 'bascart'),
            'section' => 'typography_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        /**
         * Control for body Typography Input
         */

        $this->add_control([
            'id'         => 'body_font',
            'section'    => 'typography_settings_section',
            'type'       => 'typography',
            'value'      => [
                'family'         => 'Inter',
                'weight'         => 400,
                'size'           => 16,
                'line_height'    => 26,
                'color'          => '#404040',
                'letter_spacing' => 0
            ],
            'components' => [
                'family'         => true,
                'size'           => true,
                'line-height'    => true,
                'letter-spacing' => true,
                'weight'         => true,
                'color'          => true,
            ],
            'label'      => esc_html__('Body Typhography', 'bascart'),
        ]);

        /**
         * Control for H1 Typography Input
         */
        $this->add_control([
            'id'         => 'heading_font_one',
            'section'    => 'typography_settings_section',
            'type'       => 'typography',
            'value'      => [
                'family'         => 'Inter',
                'weight'         => 700,
                'size'           => 36,
            ],
            'components' => [
                'family'         => true,
                'size'           => true,
                'line-height'    => true,
                'letter-spacing' => true,
                'weight'         => true,
                'color'          => true,
            ],
            'label'      => esc_html__('Heading H1 Typhography', 'bascart'),
        ]);

        /**
         * Control for H2 Typography Input
         */
        $this->add_control([
            'id'         => 'heading_font_two',
            'section'    => 'typography_settings_section',
            'type'       => 'typography',
            'value'      => [
                'family'         => 'Inter',
                'weight'         => 700,
                'size'           => 30,
            ],
            'components' => [
                'family'         => true,
                'size'           => true,
                'line-height'    => true,
                'letter-spacing' => true,
                'weight'         => true,
                'color'          => true,
            ],
            'label'      => esc_html__('Heading H2 Typhography', 'bascart'),
        ]);

        /**
         * Control for H3 Typography Input
         */
        $this->add_control([
            'id'         => 'heading_font_three',
            'section'    => 'typography_settings_section',
            'type'       => 'typography',
            'value'      => [
                'family'         => 'Inter',
                'weight'         => 700,
                'size'           => 24,
            ],
            'components' => [
                'family'         => true,
                'size'           => true,
                'line-height'    => true,
                'letter-spacing' => true,
                'weight'         => true,
                'color'          => true,
            ],
            'label'      => esc_html__('Heading H3 Typhography', 'bascart'),
        ]);

        /**
         * Control for H4 Typography Input
         */
        $this->add_control([
            'id'         => 'heading_font_four',
            'section'    => 'typography_settings_section',
            'type'       => 'typography',
            'value'      => [
                'family'         => 'Inter',
                'weight'         => 700,
                'size'           => 18,
            ],
            'components' => [
                'family'         => true,
                'size'           => true,
                'line-height'    => true,
                'letter-spacing' => true,
                'weight'         => true,
                'color'          => true,
            ],
            'label'      => esc_html__('Heading H4 Typhography', 'bascart'),
        ]);

        /**
         * Control for H5 Typography Input
         */
        $this->add_control([
            'id'         => 'heading_font_five',
            'section'    => 'typography_settings_section',
            'type'       => 'typography',
            'value'      => [
                'family'         => 'Inter',
                'weight'         => 700,
                'size'           => 16,
            ],
            'components' => [
                'family'         => true,
                'size'           => true,
                'line-height'    => true,
                'letter-spacing' => true,
                'weight'         => true,
                'color'          => true,
            ],
            'label'      => esc_html__('Heading H5 Typhography', 'bascart'),
        ]);

        /**
         * Control for H6 Typography Input
         */
        $this->add_control([
            'id'         => 'heading_font_six',
            'section'    => 'typography_settings_section',
            'type'       => 'typography',
            'value'      => [
                'family'         => 'Inter',
                'weight'         => 700,
                'size'           => 14,
            ],
            'components' => [
                'family'         => true,
                'size'           => true,
                'line-height'    => true,
                'letter-spacing' => true,
                'weight'         => true,
                'color'          => true,
            ],
            'label'      => esc_html__('Heading H6 Typhography', 'bascart'),
        ]);


        /**
         * Blog settings here
         */
        $this->add_section([
            'id'       => 'blog_settings_section',
            'title'    => esc_html__('Blog settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 10,
        ]);

        /**
         * Blog settings body controls here
         */
        $this->add_control([
            'id'      => 'blog_sidebar',
            'type'    => 'select',
            'value'   => 'right-sidebar',
            'label' => esc_html__('Sidebar', 'bascart'),
            'section' => 'blog_settings_section',
            'choices' => [
                'no-sidebar' => esc_html__('No sidebar', 'bascart'),
                'left-sidebar' => esc_html__('Left Sidebar', 'bascart'),
                'right-sidebar' => esc_html__('Right Sidebar', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_author_show',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Blog author', 'bascart'),
            'desc'    => esc_html__('Do you want to show blog author?', 'bascart'),
            'section' => 'blog_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_date_show',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Blog Date Show', 'bascart'),
            'desc'    => esc_html__('Do you want to show blog Date?', 'bascart'),
            'section' => 'blog_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_category_show',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Category Show', 'bascart'),
            'desc'    => esc_html__('Do you want to show blog Category?', 'bascart'),
            'section' => 'blog_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);



        /**
         * Blog settings here
         */
        $this->add_section([
            'id'       => 'blog_details_settings_section',
            'title'    => esc_html__('Blog Details settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 10,
        ]);

        /**
         * Blog settings body controls here
         */
        $this->add_control([
            'id'      => 'blog_details_sidebar',
            'type'    => 'select',
            'value'   => 'no-sidebar',
            'label' => esc_html__('Sidebar', 'bascart'),
            'section' => 'blog_details_settings_section',
            'choices' => [
                'no-sidebar' => esc_html__('No sidebar', 'bascart'),
                'left-sidebar' => esc_html__('Left Sidebar', 'bascart'),
                'right-sidebar' => esc_html__('Right Sidebar', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_details_author_show',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Blog author', 'bascart'),
            'desc'    => esc_html__('Do you want to show blog author?', 'bascart'),
            'section' => 'blog_details_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_details_date_show',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Blog Date Show', 'bascart'),
            'desc'    => esc_html__('Do you want to show blog Date?', 'bascart'),
            'section' => 'blog_details_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_details_category_show',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Category Show', 'bascart'),
            'desc'    => esc_html__('Do you want to show blog Category?', 'bascart'),
            'section' => 'blog_details_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);
        $this->add_control([
            'id'      => 'blog_details_Comments_show',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Comments Show', 'bascart'),
            'desc'    => esc_html__('Do you want to show blog Comments?', 'bascart'),
            'section' => 'blog_details_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_related_post',
            'type'    => 'switcher',
            'default' => 'no',
            'label'      => esc_html__('Blog related post', 'bascart'),
            'desc'      => esc_html__('Do you want to show single blog related post?', 'bascart'),
            'section' => 'blog_details_settings_section',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'blog_related_post_number',
            'type'    => 'text',
            'label'   => esc_html__('Related post count', 'bascart'),
            'default' => '3',
            'section' => 'blog_details_settings_section',
        ]);


        /**
         * Footer Settings here
         */
        $this->add_section([
            'id'       => 'footer_settings_section',
            'title'    => esc_html__('Footer settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 10,
        ]);

        /**
         * Header builder switch here
         */
        $this->add_control([
            'id'      => 'footer_builder_control_enable',
            'type'    => 'switcher',
            'default' => 'no',
            'label'   => esc_html__('Footer builder Enable ?', 'bascart'),
            'desc'    => esc_html__('Do you want to enable footer builder ?', 'bascart'),
            'section' => 'footer_settings_section',
            'attr'    => ['class' => 'xs_footer_builder_switch'],
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'footer_builder_select_html',
            'section' => 'footer_settings_section',
            'type'    => 'html',
            'value'   => '<h2 class="header_builder_edit"><a class="xs_builder_edit_link" style="text-transform: uppercase; color:green; margin: 0 0 10px;"  target="_blank" href="'.esc_url(admin_url('edit.php?post_type=elementskit_template')).'">'. esc_html('Go to Footer Builder.'). '</a><h2><h3><a style="text-transform: uppercase; color:#17a2b8" target="_blank" href="https://support.xpeedstudio.com/knowledgebase/customize-carrental-header-and-footer-builder/">'. esc_html__('How to edit footer', 'bascart'). '</a><h3>',
            'attr'    => ['class' => 'xs_footer_builder_html'],
            // 'conditions' => [
            //     [
            //         'control_name'  => 'footer_builder_control_enable',
            //         'operator' => '==',
            //         'value'    => "yes",
            //     ]
            // ],
        ]);

        /**
         * Footer bg control
         * */
        $this->add_control([
            'id'       => 'footer_bg_color',
            'label'    => esc_html__('Background color', 'bascart'),
            'type'     => 'color-picker',
            'section'  => 'footer_settings_section',
            'default'  => '#f8f8fc',
            'desc'     => esc_html__('Footer background color of rgba-color-picker goes here', 'bascart'),
        ]);

        /**
         * Footer text control
         * */
        $this->add_control([
            'id'      => 'footer_text_color',
            'label'   => esc_html__('Text color', 'bascart'),
            'type'    => 'color-picker',
            'section' => 'footer_settings_section',
            'default' => '#666',
            'desc'    => esc_html__('You can change the text color with rgba color or solid color', 'bascart'),
        ]);

        /**
         * Footer link control
         * */
        $this->add_control([
            'id'         => 'footer_link_color',
            'label'      => esc_html__('Link Color', 'bascart'),
            'type'       => 'color-picker',
            'section'    => 'footer_settings_section',
            'default'    => '#666',
            'desc'       => esc_html__('You can change the link color with rgba color or solid color', 'bascart'),
        ]);

        /**
         * Footer widget title control
         * */
        $this->add_control([
            'id'        => 'footer_widget_title_color',
            'label'     => esc_html__('Widget Title Color', 'bascart'),
            'type'      => 'color-picker',
            'section'   => 'footer_settings_section',
            'default'   => '#142355',
            'desc'      => esc_html__('You can change the widget title color with rgba color or solid color', 'bascart'),
        ]);

        /**
         * Footer copyright bg control
         * */
        $this->add_control([
            'id'        => 'copyright_bg_color',
            'label'     => esc_html__('Copyright Background Color', 'bascart'),
            'type'      => 'color-picker',
            'section'   => 'footer_settings_section',
            'default'   => '#09090a',
            'desc'      => esc_html__('You can change the copyright background color with rgba color or solid color', 'bascart'),

        ]);

        /**
         * Footer copyright color control
         * */
        $this->add_control([
            'id'        => 'footer_copyright_color',
            'label'     => esc_html__('Copyright Text Color', 'bascart'),
            'type'      => 'color-picker',
            'default'   => '#FFFFFF',
            'section'   => 'footer_settings_section',
            'desc'      => esc_html__('You can change the copyright tet color with rgba color or solid color', 'bascart'),
        ]);

        /**
         * Footer copyright text control
         * */
        $this->add_control([
            'id'          => 'footer_copyright',
            'type'        => 'textarea',
            'section'     => 'footer_settings_section',
            'label'       => esc_html__('Copyright text', 'bascart'),
            'description' => esc_html__('This text will be shown at the footer of all pages.', 'bascart'),
        ]);

        /**
         * Footer spacing top control
         * */
        $this->add_control([
            'id'          => 'footer_padding_top',
            'label'       => esc_html__('Footer Padding Top', 'bascart'),
            'description' => esc_html__('Use Footer Padding Top', 'bascart'),
            'type'        => 'text',
            'section'     => 'footer_settings_section',
            'default'     => '100px',
        ]);

        /**
         * Footer spaceing bottom control
         * */
        $this->add_control([
            'id'          => 'footer_padding_bottom',
            'label'	      => esc_html__( 'Footer Padding Bottom', 'bascart' ),
            'description' => esc_html__( 'Use Footer Padding Bottom', 'bascart' ),
            'type'        => 'text',
            'section'     => 'footer_settings_section',
            'default'     => '100px',
        ]);
        
        /**
         * Instagram Settings here
         */
        
        $this->add_section([
            'id'       => 'instagram_settings_section',
            'title'    => esc_html__('Instagram settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 10,
        ]);

        $this->add_control([
            'id'          => 'instagram_username',
            'label'       => esc_html__('Username', 'bascart'),
            'description' => esc_html__('Your instagram username', 'bascart'),
            'type'        => 'text',
            'section'     => 'instagram_settings_section',
            'default'     => '',
        ]);

        $this->add_control([
            'id'          => 'instagram_client_id',
            'label'       => esc_html__('Client ID', 'bascart'),
            'description' => esc_html__('Your instagram client ID', 'bascart'),
            'type'        => 'text',
            'section'     => 'instagram_settings_section',
            'default'     => '',
        ]);

        $this->add_control([
            'id'          => 'instagram_secret_key',
            'label'       => esc_html__('Access token', 'bascart'),
            'description' => esc_html__('Your instagram access token', 'bascart'),
            'type'        => 'text',
            'section'     => 'instagram_settings_section',
            'default'     => '',
        ]);

        /**
         * Optimization Settings here
         */
        $this->add_section([
            'id'       => 'optimization_settings_section',
            'title'    => esc_html__('Optimization settings', 'bascart'),
            'panel'    => 'xs_theme_option_panel',
            'priority' => 10,
        ]);

        /**
         * Font awesome icons here
         */
        $this->add_control([
            'id'      => 'optimization_fontawesome_enable',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Load Fontawesome icons ?', 'bascart'),
            'desc'    => esc_html__('Do you want to load font awesome icons ?', 'bascart'),
            'section' => 'optimization_settings_section',
            'attr'    => '',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'optimization_blocklibrary_enable',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Load Block Library css files ?', 'bascart'),
            'desc'    => esc_html__('Do you want to load block library css files ?', 'bascart'),
            'section' => 'optimization_settings_section',
            'attr'    => '',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'optimization_elementoricons_enable',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Load Elementor Icons?', 'bascart'),
            'desc'    => esc_html__('Do you want to load elementor icons?', 'bascart'),
            'section' => 'optimization_settings_section',
            'attr'    => '',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'optimization_elementkitsicons_enable',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Load Elementskit Icons?', 'bascart'),
            'desc'    => esc_html__('Do you want to load elementskit icons?', 'bascart'),
            'section' => 'optimization_settings_section',
            'attr'    => '',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'optimization_socialicons_enable',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Load WP Social Icons?', 'bascart'),
            'desc'    => esc_html__('Do you want to load wp social icons?', 'bascart'),
            'section' => 'optimization_settings_section',
            'attr'    => '',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);

        $this->add_control([
            'id'      => 'optimization_dashicons_enable',
            'type'    => 'switcher',
            'default' => 'yes',
            'label'   => esc_html__('Load Dash Icons?', 'bascart'),
            'desc'    => esc_html__('Do you want to load dash icons?', 'bascart'),
            'section' => 'optimization_settings_section',
            'attr'    => '',
            'left-choice'  => [
                'no' => esc_html__('No', 'bascart'),
            ],
            'right-choice' => [
                'yes' => esc_html__('Yes', 'bascart'),
            ],
        ]);
    }
}