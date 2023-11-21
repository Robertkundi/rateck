<?php
/**
 * Class Api Settings
 *
 * @package Timetics
 */
namespace Timetics\Core\Settings;

use Timetics\Base\Api;
use Timetics\Utils\Singleton;

class Api_Settings extends Api {
    use Singleton;

    /**
     * Store api namespace
     *
     * @var string
     */
    protected $namespace = 'timetics/v1';

    /**
     * Store rest base
     *
     * @var string
     */
    protected $rest_base = 'settings';

    /**
     * Register rest route
     *
     * @return  void
     */
    public function register_routes() {
        register_rest_route(
            $this->namespace, $this->rest_base, [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_settings'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
                [
                    'methods'             => \WP_REST_Server::EDITABLE,
                    'callback'            => [$this, 'update_settings'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
            ]
        );

        register_rest_route(
            $this->namespace, $this->rest_base . '/business', [
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [$this, 'setup_business'],
                    'permission_callback' => function () {
                        return current_user_can( 'manage_options' );
                    },
                ],
            ]
        );

        register_rest_route(
            $this->namespace, $this->rest_base . '/business/categories', [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_busyness_categories'],
                    'permission_callback' => function () {
                        return current_user_can( 'manage_options' );
                    },
                ],
            ]
        );
    }

    /**
     * Get settings
     *
     * @return  JSON
     */
    public function get_settings() {
        $settings = apply_filters( 'timetics_settings', timetics_get_settings() );

        $data = [
            'status_code' => 200,
            'success'     => 1,
            'message'     => esc_html__( 'Get all settings', 'timetics' ),
            'data'        => $settings,
        ];

        return rest_ensure_response( $settings );
    }

    /**
     * Update settings
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  JSON
     */
    public function update_settings( $request ) {
        $options = json_decode( $request->get_body(), true );

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        $data = [
            'status_code' => 200,
            'success'     => 1,
            'message'     => esc_html__( 'Settings successfully updated', 'timetics' ),
            'data'        => timetics_get_settings(),
        ];

        if ( !empty($options['schedule']) && $options['schedule'] && apply_filters('timetics/staff/member/availability', false)) {
            return rest_ensure_response( apply_filters( 'timetics/admin/staff/error_data', $data, 'availability_update' ) );
        }

        if ( !empty($options['availability']) && $options['availability'] && apply_filters('timetics/staff/meeting/availability', false)) {
            return rest_ensure_response( apply_filters( 'timetics/admin/appointment/error_data', $data, 'availability_update' ) );
        }

        if ( ! empty( $options['custom_fields'] ) && apply_filters( 'timetics/admin/settings/custom_fields', false, $options['custom_fields'] ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'custom_fields', timetics_get_settings() ) );
        }

        if ( ! empty( $options['paypal_status'] ) && $options['paypal_status'] && apply_filters( 'timetics/admin/settings/paypal', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'paypal', timetics_get_settings() ) );
        }

        if ( ! empty( $options['zoom_client_secret'] ) && $options['zoom_client_secret'] && apply_filters( 'timetics/admin/settings/zoom', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'zoom', timetics_get_settings() ) );
        }

        if ( ! empty( $options['fluentcrm_webhook'] ) && $options['fluentcrm_webhook'] && apply_filters( 'timetics/admin/settings/fluentcrm_webhook', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'fluent_crm', timetics_get_settings() ) );
        }

        if ( ! empty( $options['pabbly_webhook'] ) && $options['pabbly_webhook'] && apply_filters( 'timetics/admin/settings/pabbly_webhook', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'pablly', timetics_get_settings() ) );
        }

        if ( ! empty( $options['zapier_webhook'] ) && $options['zapier_webhook'] && apply_filters( 'timetics/admin/settings/zapier_webhook', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'zapier', timetics_get_settings() ) );
        }

        if (!empty($options['google_app_client_id']) && $options['google_app_client_id'] && apply_filters('timetics/admin/settings/google_calendar', false)) {
            return rest_ensure_response(apply_filters('timetics/admin/settings/error_data', $data, 'google-calendar', timetics_get_settings()));
        }

        if ( ! empty( $options['google_app_client_secret'] ) && $options['google_app_client_secret'] && apply_filters( 'timetics/admin/settings/google-calendar', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'google-calendar', timetics_get_settings() ) );
        }
        
        if ( ! empty( $options['outlook_calendar'] ) && $options['outlook_calendar'] && apply_filters( 'timetics/admin/settings/outlook_calendar', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'outlook', timetics_get_settings() ) );
        }

        if ( ! empty( $options['apple_calendar'] ) && $options['apple_calendar'] && apply_filters( 'timetics/admin/settings/apple_calendar', false ) ) {
            return rest_ensure_response( apply_filters( 'timetics/admin/settings/error_data', $data, 'paypal', timetics_get_settings() ) );
        }

        if (!empty($options['twillo_message']) && $options['twillo_message'] && apply_filters('timetics/admin/settings/twillo_messaging', false)) {
            return rest_ensure_response(apply_filters('timetics/admin/settings/error_data', $data, 'twillo_messaging', timetics_get_settings()));
        }

        if ( $options ) {
            foreach ( $options as $key => $value ) {
                timetics_update_option( $key, $value );
            }
        }

        $data['data'] = timetics_get_settings();

        return rest_ensure_response( $data );
    }

    /**
     * Business setup
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  void
     */
    public function setup_business( $request ) {
        $data = json_decode( $request->get_body(), true );

        $email = ! empty( $data['email'] ) ? $data['email'] : '';

        $body = array(
            'email' => $email,
        );

        $response_user = wp_remote_post( 'https://arraytics.com/?fluentcrm=1&route=contact&hash=0d9cd3d1-514d-4e1a-9147-09dfd5f9e997', ['body' => $body] );

        $response = [
            'status'  => 200,
            'success' => 1,
            'message' => __( 'Successfully updated business', 'timetics' ),
        ];

        return rest_ensure_response( $response );
    }

    /**
     *  Get busyness categories
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  JSON
     */
    public function get_busyness_categories( $request ) {
        $busyness_categories = timetics_get_busyness_categories();

        $response = [
            'success'     => 1,
            'status_code' => 200,
            'data'        => $busyness_categories,
        ];

        return rest_ensure_response( $response );
    }
}
