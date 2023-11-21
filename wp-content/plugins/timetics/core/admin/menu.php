<?php

/**
 * Admin meni class
 *
 * @package Timetics
 */

namespace Timetics\Core\Admin;

/**
 * Class Menu
 */
class Menu
{

    use \Timetics\Utils\Singleton;

    /**
     * Initialize
     *
     * @return void
     */
    public function init()
    {
        add_action('admin_menu', array($this, 'register_admin_menu'));

        add_action('timetics_menu', array($this, 'add_pro_admin_menu'));

    }


    /**
     * Register admin menu
     *
     * @return void
     */

    public function register_admin_menu()
    {
        global $submenu;
        $capability = 'manage_timetics';
        $slug       = 'timetics';
        $url        = 'admin.php?page=' . $slug . '#';
        $timetics_menu_position = 'timetics_menu_position_';
        $timetics_menu_permission = 'timetics_menu_permission_';

        $menu_items = array(
            [   'id'         => 'overview',
                'title'      => esc_html__('Overview', 'timetics'),
                'link'       => '/',
                'capability' => apply_filters( $timetics_menu_permission . 'overview', $capability ),
                'position'   => apply_filters( $timetics_menu_position . 'overview', 1 ),
            ],
            [
                'id'         => 'meeting',
                'title'      => esc_html__('Meetings', 'timetics'),
                'link'       => '/meetings',
                'capability' => apply_filters( $timetics_menu_permission . 'meeting', 'read_booking' ),
                'position'   => apply_filters( $timetics_menu_position . 'meeting', 2 ),
            ],
            [
                'id'         => 'staff',
                'title'      => esc_html__('Staff Members', 'timetics'),
                'link'       => '/staff',
                'capability' => apply_filters( $timetics_menu_permission . 'staff', 'edit_staff' ),
                'position'   => apply_filters( $timetics_menu_position . 'staff', 3 ),
            ],

            [
                'id'         => 'booking',
                'title'      => esc_html__('Bookings', 'timetics'),
                'link'       => '/bookings',
                'capability' => apply_filters( $timetics_menu_permission . 'booking', 'read_booking' ),
                'position'   => apply_filters( $timetics_menu_position . 'booking', 4 ),
            ],
            [
                'id'         => 'customer',
                'title'      => esc_html__('Customers', 'timetics'),
                'link'       => '/customers',
                'capability' => apply_filters( $timetics_menu_permission . 'customer', 'manage_options' ),
                'position'   => apply_filters( $timetics_menu_position . 'customer', 5 ),
            ],
            [
                'id'         => 'settings',
                'title'      => esc_html__('Settings', 'timetics'),
                'link'       => '/settings',
                'capability' => apply_filters( $timetics_menu_permission . 'settings', 'manage_options' ),
                'position'   => apply_filters( $timetics_menu_position . 'settings', 6 ),
            ],
            [   'id'         => 'my-profile',
                'title'      => esc_html__('My Profile', 'timetics'),
                'link'       => '/my-profile',
                'capability' => apply_filters( $timetics_menu_permission . 'my-profile', 'edit_profile' ),
                'position'   => apply_filters( $timetics_menu_position . 'my-profile', 7 ),
            ],
            [
                'id'         => 'shortcode',
                'title'      => esc_html__('Shortcodes', 'timetics'),
                'link'       => '/shortcodes',
                'capability' => apply_filters( $timetics_menu_permission . 'shortcode', 'manage_options' ),
                'position'   => apply_filters( $timetics_menu_position . 'shortcode', 8 ),
            ],
            [
                'id'         => 'onboard',
                'title'      => esc_html__('Setup Wizard', 'timetics'),
                'link'       => '/onboard',
                'capability' => apply_filters( $timetics_menu_permission . 'onboard', 'manage_options' ),
                'position'   => apply_filters( $timetics_menu_position . 'onboard', 9 ),
            ],
        );

        add_menu_page(
            esc_html__('Timetics', 'timetics'),
            esc_html__('Timetics', 'timetics'),
            $capability,
            $slug,
            array($this, 'timetics_dashboard_view'),
            "data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTE0OCIgaGVpZ2h0PSIxMTQ4IiB2aWV3Qm94PSIwIDAgMTE0OCAxMTQ4IiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8cGF0aCBkPSJNODQ2Ljc1MyA5NzAuNTQ1QzgxNS41MDMgOTk1LjAzOCA3NzEuMTE4IDk4Mi40NjggNzUxLjgzNCA5NDcuNzY1QzczMi44NTYgOTEzLjYxMyA3NDUuNjI5IDg3MS4wNDMgNzc1LjE4MiA4NDUuNDgxQzg0OC4yNjkgNzgyLjI2MyA4OTMuMjcgNjkwLjcyMSA4OTMuMjcgNTkwLjE4MUM4OTMuMjcgNDA1LjI1NiA3NDAuNjY2IDI1Mi42OTMgNTU1LjY5MyAyNTIuNjkzQzQ1My42ODYgMjUyLjY5MyAzNTcuODUzIDI5OC45OCAyOTMuNDEgMzc2LjQyNkMyNjkuMjIyIDQwNS40OTUgMjI4LjE1OCA0MTguNDg2IDE5NC44NTYgNDAwLjU1OUMxNjEuNjYzIDM4Mi42OTEgMTQ4LjczIDM0MS4wMTQgMTcwLjg4IDMxMC41MTVDMjYwLjEwOCAxODcuNjUxIDQwMi42MzggMTE0IDU1NS42OTMgMTE0QzgxOS4yOCAxMTQgMTAzMiAzMjYuNjYzIDEwMzIgNTkwLjE4MUMxMDMyIDc0MS41MzUgOTYzLjM1MSA4NzkuMTY0IDg0Ni43NTMgOTcwLjU0NVoiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0xODUuOTYyIDUyNi41MzFINjI0LjYwNFY5NjUuMDU3QzYyNC42MDQgMTAwMy4xMyA1OTMuNzI5IDEwMzQgNTU1LjY0MiAxMDM0QzUxNy41NTYgMTAzNCA0ODYuNjgxIDEwMDMuMTMgNDg2LjY4MSA5NjUuMDU3VjY2NC40MThIMTg1Ljk2MkMxNDcuODc1IDY2NC40MTggMTE3IDYzMy41NTEgMTE3IDU5NS40NzRDMTE3IDU1Ny4zOTggMTQ3Ljg3NSA1MjYuNTMxIDE4NS45NjIgNTI2LjUzMVoiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=",
            10
        );

        $menu_items = apply_filters('timetics_menu', $menu_items);
        $position   = array_column($menu_items, 'position');

        array_multisort($position, SORT_ASC, $menu_items);

        foreach ($menu_items as $item) {
            $external = ! empty( $item['external_link'] ) ? $item['external_link'] : false;

            $link = ! $external ? $url . $item['link'] : $item['link'];
            $submenu[$slug][] = [$item['title'], $item['capability'], $link]; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        }
    }

    /**
     * Admin dashboard view
     *
     * @return void
     */
    public function timetics_dashboard_view()
    {
?>
        <div class="wrap" id="time_tics_dashboard">
        </div>
<?php
    }

    // Add submenu page under "Settings"
    public function add_pro_admin_menu( $menu_items )
    {
        if ( class_exists('TimeticsPro') ) {
            return $menu_items;
        }

        $menu_items[] = [
            'id'         => 'go-pro',
            'title'      => esc_html__('Go Pro', 'timetics'),
            'link'       => 'https://arraytics.com/timetics',
            'external_link' => true,
            'capability' => 'manage_options',
            'position'   => 9,
        ];

        return $menu_items;
    }
}
