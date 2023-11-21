<?php
/**
 * Booking related hooks
 *
 * @package Timetics
 */

namespace Timetics\Core\Bookings;

use Timetics\Core\Appointments\Appointment;
use Timetics\Core\Emails\Customer_Booking_Reminder_Email;
use Timetics\Core\Emails\Staff_Booking_Reminder_Email;
use Timetics\Utils\Singleton;

/**
 * Class Hooks
 */
class Hooks {
    use Singleton;

    /**
     * Initialization
     *
     * @return  void
     */
    public function init() {
        add_action( 'timetics_after_booking_create', [$this, 'register_schedule'] );
        add_action( 'init', [$this, 'run_booking_schedule'] );
        add_action( 'timetics_booking_clear_schedule', [$this, 'clear_booking_schedule'] );

        add_action( 'timetics_after_booking_create', [$this, 'reschedule_booking'], 10, 4 );

        add_action( 'init', [$this, 'register_booking_status'] );
    }

    /**
     * Register cron job for schedule a reminder email
     *
     * @param   integer  $booking_id
     *
     * @return  void
     */
    public function register_schedule( $booking_id ) {
        $booking = new Booking( $booking_id );

        $date = $booking->get_start_date();
        $time = $booking->get_start_time();

        $booking_timestamp = strtotime( $date . ' ' . $time );

        $reminder_time = timetics_get_option( 'remainder_time' );

        if ( ! $reminder_time ) {
            return;
        }

        foreach ( $reminder_time as $time ) {
            $timestamp = '';
            $duration  = $time['duration-time'];

            switch ( $time['custom_duration_type'] ) {
            case 'min':
                $timestamp = $duration * 60;
                break;
            case 'hour':
                $timestamp = $duration * 60 * 60;
                break;
            case 'day':
                $timestamp = ( $duration * 24 ) * 60 * 60;
                break;
            }

            $timestamp = $booking_timestamp - $timestamp;

            if ( ! wp_next_scheduled( 'timetics_booking_remainder_' . $booking_id ) ) {
                wp_schedule_single_event( $timestamp, 'timetics_booking_remainder_' . $booking_id, [$booking_id] );
            }
        }
    }

    /**
     * Booking schedule
     *
     * @return  void
     */
    public function run_booking_schedule() {
        $bookins = Booking::all();

        if ( ! $bookins ) {
            return;
        }

        // Run cron action.
        foreach ( $bookins['items'] as $booking ) {
            add_action( 'timetics_booking_remainder_' . $booking->ID, [$this, 'send_reminder_email'] );
        }
    }

    /**
     * Send booking reminder email
     *
     * @param   integer  $booking_id
     *
     * @return  void
     */
    public function send_reminder_email( $booking_id ) {
        $booking_reminder_customer = timetics_get_option( 'booking_reminder_customer' );
        $booking_reminder_host     = timetics_get_option( 'booking_reminder_host' );

        $booking = new Booking( $booking_id );

        if ( $booking_reminder_customer ) {
            $customer_reminder = new Customer_Booking_Reminder_Email( $booking );
            $customer_reminder->send();
        }

        if ( $booking_reminder_host ) {
            $staff_reminder = new Staff_Booking_Reminder_Email( $booking );
            $staff_reminder->send();
        }

    }

    /**
     * Clear cron job schedule
     *
     * @return
     */
    public function clear_booking_schedule() {
        $bookins = Booking::all();

        if ( ! $bookins ) {
            return;
        }

        // Run cron action.
        foreach ( $bookins['items'] as $booking ) {
            $timestamp = wp_next_scheduled( 'timetics_booking_remainder_' . $booking->ID );

            if ( $timestamp && $timestamp < time() ) {
                wp_unschedule_event( $timestamp, 'timetics_booking_remainder_' . $booking->ID );
            }
        }
    }

    /**
     * Update bookked entry if reschedule
     *
     * @param   integer  $booking_id
     * @param   integer  $customer_id
     * @param   integer  $meeting_id
     * @param   array  $data
     * @param   integer  $booking_entry
     *
     * @return  void
     */
    public function reschedule_booking( $booking_id, $customer_id, $meeting_id, $data ) {
        $reschedule    = ! empty( $data['reschedule'] ) ? $data['reschedule'] : false;
        $booking       = new Booking( $booking_id );
        $meeting       = new Appointment( $meeting_id );
        $booking_entry = new Booking_Entry();

        if ( ! $reschedule ) {
            return;
        }

        $entries = $booking_entry->find(
            [
                'staff_id'   => $booking->get_staff_id(),
                'meeting_id' => $meeting->get_id(),
                'date'       => $booking->get_start_date(),
                'start'      => $booking->get_start_time(),
            ]
        );

        if ( ! $entries ) {
            return;
        }

        $entry         = $booking_entry->first();
        $booked_seat   = ! empty( $booking->get_seat() ) ? $booking->get_seat() : [];
        $existing_seat = ! empty( $entry->get_seats() ) ? $entry->get_seats() : [];

        if ( 'one-to-one' === strtolower( $meeting->get_type() ) ) {
            $entry->delete();
        } else {
            $booked = intval( $entry->get_booked() ) - 1;

            $entry->update( [
                'booked' => $booked,
                'seats'  => array_values( array_diff( $existing_seat, $booked_seat ) ),
            ] );
        }
    }

    /**
     * Register booking statuses
     *
     * @return  void
     */
    public function register_booking_status() {
        $statuses = timetics_get_post_status();

        foreach ( $statuses as $status ) {

            register_post_status( $status, array(
                'public'                    => true,
                'exclude_from_search'       => false,
                'show_in_admin_all_list'    => false,
                'show_in_admin_status_list' => false,
                'label_count'               => _n_noop( "$status (%s)", "$status (%s)", 'timetics' ),
            ) );
        }
    }
}
