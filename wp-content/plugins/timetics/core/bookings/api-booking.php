<?php
/**
 * Booking api
 *
 * @package Timetics
 */
namespace Timetics\Core\Bookings;

use Timetics\Base\Api;
use Timetics\Core\Appointments\Appointment;
use Timetics\Core\Customers\Customer;
use Timetics\Core\Emails\Cancel_Event_Email;
use Timetics\Core\Emails\New_Event_Customer_Email;
use Timetics\Core\Emails\New_Event_Email;
use Timetics\Core\Emails\Update_Event_Customer_Email;
use Timetics\Core\Emails\Update_Event_Email;
use Timetics\Core\Staffs\Staff;
use Timetics\Utils\Singleton;
use WP_Error;
use WP_HTTP_Response;
use WP_Query;

class Api_Booking extends Api {
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
    protected $rest_base = 'bookings';

    /**
     * Register rest routes
     *
     * @return  void
     */
    public function register_routes() {
        /**
         * Register route
         *
         * @var void
         */
        register_rest_route(
            $this->namespace, $this->rest_base, [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_items'],
                    'permission_callback' => function () {
                        return current_user_can( 'manage_timetics' );
                    },
                ],
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [$this, 'create_item'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
                [
                    'methods'             => \WP_REST_Server::DELETABLE,
                    'callback'            => [$this, 'bulk_delete'],
                    'permission_callback' => function () {
                        return current_user_can( 'edit_booking' );
                    },
                ],
            ]
        );

        /**
         * Register route
         *
         * @var void
         */
        register_rest_route(
            $this->namespace, '/' . $this->rest_base . '/(?P<booking_id>[\d]+)', [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_item'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
                [
                    'methods'             => \WP_REST_Server::EDITABLE,
                    'callback'            => [$this, 'update_item'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
                [
                    'methods'             => \WP_REST_Server::DELETABLE,
                    'callback'            => [$this, 'delete_item'],
                    'permission_callback' => function () {
                        return current_user_can( 'edit_booking' );
                    },
                ],
            ]
        );

        register_rest_route(
            $this->namespace, '/' . $this->rest_base . '/(?P<booking_id>[\d]+)/payment', [
                [
                    'methods'             => \WP_REST_Server::EDITABLE,
                    'callback'            => [$this, 'make_payment'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
            ]
        );

        register_rest_route(
            $this->namespace, $this->rest_base . '/search', [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'search_items'],
                    'permission_callback' => function () {
                        return current_user_can( 'edit_posts' );
                    },
                ],
            ]
        );

        register_rest_route(
            $this->namespace, $this->rest_base . '/entries', [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_entries'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
            ]
        );

        register_rest_route(
            $this->namespace, $this->rest_base . '/payment_methods', [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_payment_methods'],
                    'permission_callback' => function () {
                        return true;
                    },
                ],
            ]
        );
    }

    /**
     * Get all bookings
     *
     * @param   WP_Rest_Request  $request
     *
     * @return JSON
     */
    public function get_items( $request ) {
        $per_page   = ! empty( $request['per_page'] ) ? intval( $request['per_page'] ) : 20;
        $paged      = ! empty( $request['paged'] ) ? intval( $request['paged'] ) : 1;
        $meeting_id = ! empty( $request['meeting_id'] ) ? intval( $request['meeting_id'] ) : 0;
        $start_date = ! empty( $request['start_date'] ) ? $request['start_date'] : '';
        $staff_id   = ! current_user_can( 'edit_booking' ) ? get_current_user_id() : 0;

        $args = [
            'posts_per_page' => $per_page,
            'paged'          => $paged,
            'meeting'        => $meeting_id,
            'staff'          => $staff_id,
        ];

        if ( $start_date ) {
            $args['start_date'] = $start_date;
        }

        $appoint = Booking::all( $args );

        $items = [];

        foreach ( $appoint['items'] as $item ) {
            $items[] = $this->prepare_item( $item->ID );
        }

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        $items = apply_filters( 'timetics/admin/booking/get_items', $items );

        $data = [
            'success'     => 1,
            'status_code' => 200,
            'data'        => [
                'total' => $appoint['total'],
                'items' => $items,
            ],
        ];

        return rest_ensure_response( $data );
    }

    /**
     * Get single booking
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  JSON
     */
    public function get_item( $request ) {
        $booking_id = (int) $request['booking_id'];
        $booking    = new Booking( $booking_id );

        if ( ! $booking->is_booking() ) {
            return [
                'success'     => 0,
                'status_code' => 404,
                'message'     => esc_html__( 'Invalid booking id.', 'timetics' ),
                'data'        => [],
            ];
        }

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        do_action( 'timetics/admin/booking/get_item', $this->prepare_item( $booking ) );

        $data = [
            'success'     => 1,
            'status_code' => 200,
            'data'        => $this->prepare_item( $booking ),
        ];

        return rest_ensure_response( $data );
    }

    /**
     * Create booking
     *
     * @param   WP_Rest_Request  $request
     *
     * @return JSON
     */
    public function create_item( $request ) {
        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        $bookings_count = Booking::all();

        $response = [
            'success'     => 0,
            'status_code' => 502,
            'message'     => esc_html__( 'Something went wrong', 'timetics' ),
            'data'        => [],
        ];

        if ( apply_filters( 'timetics/staff/booking/count_check', false, $bookings_count ) == true ) {
            return new WP_HTTP_Response( apply_filters( 'timetics/admin/booking/error_data', $response, 'count_check' ), 403 );
        }

        $data = json_decode( $request->get_body(), true );

        if ( apply_filters( 'timetics/booking/appointment/type_check', false, $request ) == true ) {
            return new WP_HTTP_Response( apply_filters( 'timetics/admin/booking/error_data', $response, 'type_check' ), 403 );
        }

        $recurring_booking = ! empty( $data['recurring_dates'] ) ? $data['recurring_dates'] : [];

        if ( $recurring_booking && apply_filters( 'timetics/booking/appointment/recurring_check', false, $recurring_booking ) == true ) {
            $response = [
                'status_code' => 403,
                'success'     => 0,
                'message'     => esc_html__( 'Recurring booking limit exit', 'timetics' ),
            ];

            return new WP_HTTP_Response( $response, 403 );
        } // End.

        return $this->save_bookings( $request );
    }

    /**
     * Update booking
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  JSON
     */
    public function update_item( $request ) {
        $booking_id = (int) $request['booking_id'];
        $booking    = new Booking( $booking_id );

        if ( ! $booking->is_booking() ) {
            return [
                'status_code' => 404,
                'message'     => esc_html__( 'Invalid booking id.', 'timetics' ),
                'data'        => [],
            ];
        }

        if ( apply_filters( 'timetics/booking/appointment/custom_form_data', false, $request ) == true ) {
            $response = [
                'status_code' => 409,
                'success'     => 0,
                'message'     => esc_html__( 'Custom Field Booking Restricted ', 'timetics' ),
            ];

            return new WP_HTTP_Response( $response, 403 );
        }

        return $this->save_bookings( $request, $booking_id );
    }

    /**
     * Delete booking
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  JSON
     */
    public function delete_item( $request ) {
        $booking_id = (int) $request['booking_id'];

        $delete = $this->delete( $booking_id );

        if ( ! $delete ) {
            $data = [
                'success'     => 1,
                'status_code' => 409,
                'message'     => esc_html__( 'Something went wrong, Please try again.', 'timetics' ),
                'data'        => [],
            ];

            return new WP_HTTP_Response( $data, 409 );
        }

        $data = [
            'success'     => 1,
            'status_code' => 200,
            'message'     => esc_html__( 'Successfully deleted booking', 'timetics' ),
            'data'        => [],
        ];

        return rest_ensure_response( $data );
    }

    /**
     * Delete multiples
     *
     * @param   WP_Rest_Request  $request
     *
     * @return JSON
     */
    public function bulk_delete( $request ) {
        $bookings = json_decode( $request->get_body(), true );

        foreach ( $bookings as $booking ) {
            $delete = $this->delete( $booking );

            if ( ! $delete ) {
                return [
                    'success'     => 0,
                    'status_code' => 404,
                    'message'     => esc_html__( 'Invalid booking id.', 'timetics' ),
                    'data'        => [],
                ];
            }
        }

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        do_action( 'timetics/admin/booking/bulk_delete', $bookings );

        return [
            'success'     => 1,
            'status_code' => 200,
            'message'     => esc_html__( 'Successfully deleted booking', 'timetics' ),
        ];
    }

    /**
     * Get payment methods
     *
     * @return array
     */
    public function get_payment_methods() {

        $payment_methods = timetics_get_payment_methods();

        return [
            'success'     => 1,
            'status_code' => 200,
            'data'        => $payment_methods,
        ];
    }

    /**
     * Search bookings
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  JSON
     */
    public function search_items( $request ) {
        // Prepare search args.
        $per_page = ! empty( $request['per_page'] ) ? intval( $request['per_page'] ) : 20;
        $paged    = ! empty( $request['paged'] ) ? intval( $request['paged'] ) : 1;
        $search   = ! empty( $request['search'] ) ? sanitize_text_field( $request['search'] ) : '';

        // Get search.
        $booking = new WP_Query(
            array(
                'post_type'      => 'timetics-booking',
                'posts_per_page' => $per_page,
                'paged'          => $paged,
                'post_status'    => 'any',

                // @codingStandardsIgnoreStart
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key'     => '_tt_booking_customer_fname',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_customer_lname',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_customer_email',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_customer_phone',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_staff_fname',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_staff_lname',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_staff_email',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_meeting_name',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_meeting_description',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_tt_booking_meeting_type',
                        'value'   => $search,
                        'compare' => 'LIKE',
                    ),
                ),
                // @codingStandardsIgnoreEnd
            )
        );

        // Prepare items for response.
        $items = [];

        foreach ( $booking->posts as $item ) {
            $items[] = $this->prepare_item( $item->ID );
        }

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        $items = apply_filters( 'timetics/admin/booking/search_items', $items );

        $data = [
            'success' => 1,
            'status'  => 200,
            'data'    => [
                'total' => $booking->found_posts,
                'items' => $items,
            ],
        ];

        return rest_ensure_response( $data );
    }

    /**
     * Get all booking entries
     *
     * @param   WP_Rest_Request  $request
     *
     * @return JSON
     */
    public function get_entries( $request ) {
        $staff_id   = ! empty( $request['staff_id'] ) ? intval( $request['staff_id'] ) : 0;
        $meeting_id = ! empty( $request['meeting_id'] ) ? intval( $request['meeting_id'] ) : 0;
        $start_date = ! empty( $request['start_date'] ) ? sanitize_text_field( $request['start_date'] ) : 0;
        $timezone   = ! empty( $request['timezone'] ) ? sanitize_text_field( $request['timezone'] ) : 0;
        $end_date   = ! empty( $request['end_date'] ) ? sanitize_text_field( $request['end_date'] ) : 0;

        $meeting = new Appointment( $meeting_id );

        // Validate timezone.
        if ( ! timetics_is_valid_timezone( $timezone ) ) {
            return new WP_Error( 'timezone_error', __( 'Your booking timezone is invalid', 'timetics' ) );
        }

        // Validate meeting timezone.
        if ( ! timetics_is_valid_timezone( $meeting->get_timezone() ) ) {
            return new WP_Error( 'timezone_error', __( 'Your meeting timezone is invalid. Please update your meeting timezone with proper timezone.', 'timetics' ) );
        }

        $days = $meeting->prepare_schedule( $start_date, $end_date, $staff_id, $timezone );

        $data = [
            'today'                 => gmdate( 'Y-m-d' ),
            'availability_timezone' => $meeting->get_timezone(),
            'days'                  => $days,
        ];

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        $data = apply_filters( 'timetics/admin/booking/get_entries', $data );

        return [
            'success'     => true,
            'status_code' => 200,
            'message'     => esc_html__( 'Get all entries', 'timetics' ),
            'data'        => $data,
        ];
    }

    /**
     * Make payment transaction for the current booking
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  JSON
     */
    public function make_payment( $request ) {
        $booking_id      = intval( $request['booking_id'] );
        $booking         = new Booking( $booking_id );
        $data            = json_decode( $request->get_body(), true );
        $status          = ! empty( $data['status'] ) ? sanitize_text_field( $data['status'] ) : '';
        $default_booking_status = timetics_get_option( 'default_booking_status', 'approved' );
        $post_status     = 'succeeded' === $status ? $default_booking_status : 'pending';
        $payment_method  = ! empty( $data['payment_method'] ) ? sanitize_text_field( $data['payment_method'] ) : '';
        $payment_details = ! empty( $data['payment_details'] ) ? $data['payment_details'] : '';

        if ( ! $booking->is_booking() ) {
            return [
                'status_code' => 404,
                'message'     => esc_html__( 'Invalid booking id.', 'timetics' ),
                'data'        => [],
            ];
        }

        $update = $booking->update(
            [
                'post_status'     => $post_status,
                'payment_status'  => $status,
                'payment_details' => $payment_details,
                'payment_method'  => $payment_method,
            ]
        );

        if ( is_wp_error( $update ) ) {
            $data = [
                'success'     => 0,
                'status_code' => 409,
                /* translators: Action */
                'message'     => $update->get_error_message(),
            ];

            return new WP_HTTP_Response( $data, 409 );
        }

        if ( $default_booking_status === $post_status ) {
            $booking->create_event();
            $new_event_email = new New_Event_Email( $booking );
            $new_event_email->send();

            $new_event_customer_email = new New_Event_Customer_Email( $booking );
            $new_event_customer_email->send();

            do_action( 'timetics_booking_payment', $booking );
        }

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        do_action( 'timetics/admin/booking/make_payment', $post_status );

        $data = [
            'success'     => 1,
            'status_code' => 200,
            /* translators: Action */
            'message'     => sprintf( esc_html__( 'Payment %s', 'timetics' ), $post_status ),
        ];

        return new WP_HTTP_Response( $data, 200 );
    }

    /**
     * Save booking
     *
     * @param   WP_Rest_Request  $request
     * @param   integer  $id       Booking id
     *
     * @return  JSON
     */
    public function save_bookings( $request, $id = 0 ) {
        $data = json_decode( $request->get_body(), true );

        $first_name      = ! empty( $data['first_name'] ) ? sanitize_text_field( $data['first_name'] ) : '';
        $last_name       = ! empty( $data['last_name'] ) ? sanitize_text_field( $data['last_name'] ) : '';
        $email           = ! empty( $data['email'] ) ? sanitize_text_field( $data['email'] ) : '';
        $phone           = ! empty( $data['phone'] ) ? sanitize_text_field( $data['phone'] ) : '';
        $city            = ! empty( $data['city'] ) ? sanitize_text_field( $data['city'] ) : '';
        $state           = ! empty( $data['state'] ) ? sanitize_text_field( $data['state'] ) : '';
        $post_code       = ! empty( $data['post_code'] ) ? sanitize_text_field( $data['post_code'] ) : '';
        $country         = ! empty( $data['country'] ) ? sanitize_text_field( $data['country'] ) : '';
        $payment_method  = ! empty( $data['payment_method'] ) ? sanitize_text_field( $data['payment_method'] ) : '';
        $address_1       = ! empty( $data['address_1'] ) ? sanitize_text_field( $data['address_1'] ) : '';
        $address_2       = ! empty( $data['address_2'] ) ? sanitize_text_field( $data['address_2'] ) : '';
        $appointment     = ! empty( $data['appointment'] ) ? intval( $data['appointment'] ) : 0;
        $staff           = ! empty( $data['staff'] ) ? intval( $data['staff'] ) : 0;
        $start_date      = ! empty( $data['start_date'] ) ? sanitize_text_field( $data['start_date'] ) : '';
        $date            = ! empty( $data['date'] ) ? sanitize_text_field( $data['date'] ) : '';
        $end_date        = ! empty( $data['end_date'] ) ? sanitize_text_field( $data['end_date'] ) : $start_date;
        $start_time      = ! empty( $data['start_time'] ) ? sanitize_text_field( $data['start_time'] ) : '';
        $end_time        = ! empty( $data['end_time'] ) ? sanitize_text_field( $data['end_time'] ) : '';
        $order_total     = ! empty( $data['order_total'] ) ? intval( $data['order_total'] ) : 0;
        $status          = ! empty( $data['status'] ) ? sanitize_text_field( $data['status'] ) : timetics_get_option( 'default_booking_status', 'approved' );
        $location        = ! empty( $data['location'] ) ? sanitize_text_field( $data['location'] ) : '';
        $location_type   = ! empty( $data['location_type'] ) ? sanitize_text_field( $data['location_type'] ) : '';
        $description     = ! empty( $data['description'] ) ? sanitize_text_field( $data['description'] ) : '';
        $timezone        = ! empty( $data['timezone'] ) ? sanitize_text_field( $data['timezone'] ) : '';
        $recurring_dates = ! empty( $data['recurring_dates'] ) ? $data['recurring_dates'] : [];
        $action          = $id ? 'updated' : 'created';

        $validate = $this->validate(
            $data, [
                'first_name',
                'email',
                'payment_method',
                'appointment',
                'start_date',
                'start_time',
                'end_time',
            ]
        );

        if ( is_wp_error( $validate ) ) {
            $data = [
                'status_code' => 403,
                'success'     => 0,
                'message'     => $validate->get_error_messages(),
            ];
            return new WP_HTTP_Response( $data, 403 );
        }

        $customer      = new Customer();
        $meeting       = new Appointment( $appointment );
        $staff         = new Staff( $staff );
        $booking       = new Booking( $id );
        $booking_entry = new Booking_Entry();

        if ( 'created' === $action && ! $this->is_available_slot( $meeting, [
            'staff_id'   => $staff->get_id(),
            'start_date' => $start_date,
            'start_time' => $start_time,
            'timezone'   => $timezone,
        ] ) ) {
            return new WP_Error( 'time_slot_error', sprintf( __( '%s time slot is not available', 'timetics' ), $start_time ) );
        }

        if ( $meeting->is_recurring() ) {
            $valid_recurrence = apply_filters( 'timetics_validate_recurring_booking', $recurring_dates, $start_time, $staff->get_id(), $meeting->get_id() );

            if ( ! $valid_recurrence ) {
                $recurring_error = [
                    'status_code' => 403,
                    'success'     => 0,
                    'message'     => __( 'Couldn\'t possible to book. Plese try another time.', 'timetics' ),
                ];

                return new WP_HTTP_Response( $recurring_error, 403 );
            }
        }

        $customer->make(
            [
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
                'phone'      => $phone,
            ]
        );

        // Update booking schedule.
        if ( $id ) {
            $entries = $booking_entry->find(
                [
                    'staff_id'   => $booking->get_staff_id(),
                    'meeting_id' => $booking->get_appointment(),
                    'date'       => $booking->get_start_date(),
                    'start'      => $booking->get_start_time(),
                ]
            );

            if ( $entries ) {
                $entry = $booking_entry->first();

                if ( 'one-to-one' == strtolower( $meeting->get_type() ) ) {
                    $entry->delete();
                } else {
                    $booked      = intval( $entry->get_booked() ) - 1;
                    $booked_data = apply_filters( 'timetics_booking_update_schedule', $entry, ['booked' => $booked], $data, $booking );
                    $entry->update( $booked_data );
                }
            }
        }

        if ( $id && $booking->get_status() == 'cancel' && $status == 'cancel' ) {
            return new WP_Error( 'booking_cancel_error', __( 'This booking alreay canceled', 'timetics' ) );
        }

        $booking->set_props(
            [
                'customer'            => $customer->get_id(),
                'appointment'         => $meeting->get_id(),
                'appointment_name'    => $meeting->get_name(),
                'staff'               => $staff->get_id(),
                'customer_fname'      => $customer->get_first_name(),
                'customer_lname'      => $customer->get_last_name(),
                'customer_email'      => $customer->get_email(),
                'customer_phone'      => $customer->get_phone(),
                'staff_fname'         => $staff->get_first_name(),
                'staff_lname'         => $staff->get_last_name(),
                'staff_email'         => $staff->get_email(),
                'meeting_name'        => $meeting->get_name(),
                'meeting_description' => $meeting->get_description(),
                'meeting_type'        => $meeting->get_type(),
                'description'         => $description,
                'start_date'          => $start_date,
                'date'                => $date,
                'end_date'            => $end_date,
                'start_time'          => $start_time,
                'end_time'            => $end_time,
                'order_total'         => $order_total,
                'post_status'         => $status,
                'location'            => $location,
                'location_type'       => $location_type,
                'timezone'            => $timezone,
            ]
        );

        $booking->save();

        // Fire when booking is completed.
        do_action( 'timetics_after_booking_create', $booking->get_id(), $customer->get_id(), $meeting->get_id(), $data );

        // Create or update calendar event.
        if ( $id ) {
            if ( 'cancel' === $status ) {
                $booking->delete_event();
                $cancel_event_email = new Cancel_Event_Email( $booking );
                $cancel_event_email->send();

                /**
                 * Added temporary for leagacy sass. It will remove in future.
                 */
                do_action( 'timetics/admin/booking/after_delete_item', $booking );
            } else {
                $booking->update_event();
                $update_event_email = new Update_Event_Email( $booking );
                $update_event_email->send();

                $update_event_customer_email = new Update_Event_Customer_Email( $booking );
                $update_event_customer_email->send();
            }
        }

        // Convert booking time to staff/meeting time.
        $date_time = timetics_convert_timezone( $start_date .' '. $start_time, $timezone, $meeting->get_timezone() );
        $end_time   = timetics_convert_timezone( $start_date . ' ' . $end_time, $timezone, $meeting->get_timezone() );

        // Create booking schedule.
        $entries = $booking_entry->find(
            [
                'staff_id'   => $staff->get_id(),
                'meeting_id' => $meeting->get_id(),
                'date'       => $date_time->format('Y-m-d'),
                'start'      => $date_time->format('h:i a'),
            ]
        );

        if ( $entries ) {
            $entry = $booking_entry->first();

            if ( 'cancel' === $status ) {
                $booked = intval( $entry->get_booked() ) - 1;
            } else {
                $booked = intval( $entry->get_booked() ) + 1;
            }

            $booked_data = apply_filters( 'timetics_booking_update_schedule', $entry, ['booked' => $booked], $data, $booking );

            if ( 'cancel' === $status && 'one-to-one' == strtolower( $meeting->get_type() ) ) {
                $entry->delete();
            } else {
                $entry->update( $booked_data );
            }

        } else {
            $book_entry_data = [
                'meeting_id'  => $meeting->get_id(),
                'staff_id'    => $staff->get_id(),
                'customer_id' => $customer->get_id(),
                'booking_id'  => $booking->get_id(),
                'booked'      => 1,
                'date'       => $date_time->format('Y-m-d'),
                'start'      => $date_time->format('h:i a'),
                'end'        => $end_time->format('h:i a'),
            ];

            $book_entry_data = apply_filters( 'timetics_booking_schedule', $book_entry_data, $data );
            $booking_entry->create( $book_entry_data );
        }

        // Fire after booking schedule create.
        do_action( 'timetics_after_booking_schedule', $booking->get_id(), $customer->get_id(), $meeting->get_id(), $data );

        $data = [
            'success'     => 1,
            'status_code' => 200,
            /* translators: Action */
            'message'     => sprintf( esc_html__( 'Successfully %s booking', 'timetics' ), $action ),
            'data'        => $this->prepare_item( $booking ),
        ];

        return new WP_HTTP_Response( $data, 200 );
    }

    /**
     * Prepare item for response
     *
     * @param   integer  $booking_id
     *
     * @return array
     */
    public function prepare_item( $booking_id ) {
        $booking          = new Booking( $booking_id );
        $appointment      = new Appointment( $booking->get_appointment() );
        $staff            = new Staff( $booking->get_staff_id() );
        $customer         = new Customer( $booking->get_customer_id() );
        $meeting_timezone = $appointment->get_timezone();
        $booking_timezone = $booking->get_timezone();

        $start_date_time = timetics_convert_timezone( $booking->get_start_date() . ' ' . $booking->get_start_time(), $booking_timezone, $meeting_timezone );
        $end_date_time   = timetics_convert_timezone( $booking->get_end_date() . ' ' . $booking->get_end_time(), $booking_timezone, $meeting_timezone );
        $date            = timetics_datetime( 'Y-m-d', $booking->get_date(), $meeting_timezone );

        $event     = $booking->get_event();
        $join_link = 'google-meet' === $booking->get_location_type() && ! empty( $event['hangoutLink'] ) ? $event['hangoutLink'] : '';

        $booking_title = $appointment->is_appointment() ? $appointment->get_name() : $booking->get_appointment_name();

        $response = [
            'id'            => $booking->get_id(),
            'random_id'     => $booking->get_random_id(),
            'status'        => $booking->get_status(),
            'order_total'   => $booking->get_total(),
            'start_date'    => $start_date_time->format( 'Y-m-d' ),
            'end_date'      => $end_date_time->format( 'Y-m-d' ),
            'date'          => $date,
            'start_time'    => $start_date_time->format( 'h:i a' ),
            'end_time'      => $end_date_time->format( 'h:i a' ),
            'location'      => $booking->get_location(),
            'location_type' => $booking->get_location_type(),
            'description'   => $booking->get_description(),
            'customer'      => [
                'id'         => $customer->get_id(),
                'full_name'  => $customer->get_display_name(),
                'first_name' => $customer->get_first_name(),
                'last_name'  => $customer->get_last_name(),
                'email'      => $customer->get_email(),
                'phone'      => $customer->get_phone(),
            ],
            'appointment'   => [
                'id'        => $appointment->get_id(),
                'name'      => $booking_title,
                'duration'  => $appointment->get_duration(),
                'type'      => $appointment->get_type(),
                'price'     => $appointment->get_price(),
                'locations' => $appointment->get_locations(),
                'timezone'  => $appointment->get_timezone(),
                'permalink' => $appointment->get_appointment_permalink(),
            ],
            'staff'         => [
                'id'         => $staff->get_id(),
                'full_name'  => $staff->get_display_name(),
                'first_name' => $staff->get_first_name(),
                'last_name'  => $staff->get_last_name(),
                'email_name' => $staff->get_email(),
                'phone'      => $staff->get_phone(),
                'image'      => $staff->get_image(),
            ],
        ];

        if ( $join_link ) {
            $response['meeting_link'] = $join_link;
        }

        return apply_filters( 'timetics_booking_json_data', $response, $booking );
    }

    /**
     * Delete booking
     *
     * @param   integer  $booking_id
     *
     * @return  bool
     */
    private function delete( $booking_id ) {
        $booking = new Booking( $booking_id );
        $meeting = new Appointment( $booking->get_appointment() );

        if ( ! $booking->is_booking() ) {
            return false;
        }

        $current_user_id = get_current_user_id();

        if (
            $meeting->is_appointment()
            && ! user_can( $current_user_id, 'manage_options' )
            && $meeting->get_author() != $current_user_id
            ) {
            $data = [
                'success' => 0,
                'message' => __( 'You are not allowed to delete this booking.', 'timetics' ),
            ];

            return new WP_HTTP_Response( $data, 403 );
        }

        $booking_entry = new Booking_Entry();

        $date_time = timetics_convert_timezone( $booking->get_start_date() . ' ' . $booking->get_start_time(), $booking->get_timezone(), $meeting->get_timezone() );

        $entries = $booking_entry->find(
            [
                'staff_id'   => $booking->get_staff_id(),
                'meeting_id' => $booking->get_appointment(),
                'date'       => $date_time->format('Y-m-d'),
                'start'      => $date_time->format('h:i a'),
            ]
        );

        if ( $entries ) {
            $entry = $booking_entry->first();

            if ( 'one-to-one' == strtolower( $meeting->get_type() ) ) {
                $entry->delete();
            } else {
                $booked        = intval( $entry->get_booked() ) - 1;
                $booked_seat   = ! empty( $booking->get_seat() ) ? $booking->get_seat() : [];
                $existing_seat = ! empty( $entry->get_seats() ) ? $entry->get_seats() : [];

                $entry->update( [
                    'booked' => $booked,
                    'seats'  => array_values( array_diff( $existing_seat, $booked_seat ) ),
                ] );
            }
        }

        $recurrences = $booking->get_recurrence();
        $booking->delete_event();
        $booking->delete();
        $cancel_event_email = new Cancel_Event_Email( $booking );
        $cancel_event_email->send();

        do_action( 'timetics_after_booking_delete', $recurrences );

        return true;
    }

    public function is_available_slot( $meeting, $booking_data = [] ) {
        $start_date       = $booking_data['start_date'];
        $start_time       = $booking_data['start_time'];
        $booking_timezone = $booking_data['timezone'];
        $booking_entry    = new Booking_Entry();
        $meeting_id       = $meeting->get_id();
        $staff_id         = $booking_data['staff_id'];

        $time            = is_string( $start_time ) ? strtotime( $start_time ) : $start_time;
        $time            = gmdate( 'H:i', $time );
        $booking_entries = new Booking_Entry();
        $meeting         = new Appointment( $meeting_id );

        $entries = $booking_entries->find( [
            'meeting_id' => $meeting_id,
            'staff_id'   => $staff_id,
            'date'       => $start_date,
        ] );

        $booked = false;

        foreach ( $entries as $entry ) {
            $booking      = new Booking( $entry->get_booking_id() );
            $booking_time = timetics_convert_timezone( $booking->get_start_date() . ' ' . $entry->get_start(), $booking->get_timezone(), $booking_timezone )->format( 'H:i' );

            if ( $booking_time == $time ) {
                $booked = $entry;
                break;
            }
        }

        if ( $booked && $booked->get_booked() >= $meeting->get_capacity() ) {
            return false;
        }

        return true;
    }
}
