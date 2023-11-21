<?php
/**
 * Core email class
 *
 * @package Timetics
 */

namespace Timetics\Core\Emails;

/**
 * Class Email
 */
abstract class Email {
    /**
     * Constructor for core email class
     *
     * @return  void
     */
    public function __construct() {
        add_action( 'timetics-email-header', [$this, 'add_email_header'] );
        add_action( 'timetics-email-footer', [$this, 'add_email_footer'] );
        add_action( 'timetics-email-body', [$this, 'add_email_body'] );
    }

    /**
     * Get email subject
     *
     * @return  string
     */
    abstract public function get_subject();

    /**
     * Get email html template
     *
     * @return string
     */
    abstract public function get_template();

    /**
     * Get email recipent
     *
     * @return string
     */
    abstract public function get_recipient();

    /**
     * Get email header
     *
     * @return  string
     */
    public function get_headers() {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        return $headers;
    }

    /**
     * Add email header
     *
     * @return void
     */
    public function add_email_header() {
        include TIMETICS_PLUGIN_DIR . '/templates/emails/email-header.php';
    }

    /**
     * Add email body
     *
     * @return void
     */
    public function add_email_body() {
        $template = $this->get_template();

        if ( file_exists( $template ) ) {
            ob_start(); // Start output buffering
            include $template;
            $body = ob_get_clean(); // Retrieve and clean output buffer
            echo wp_kses_post( $body ); // Output the email body
        }
    }

    /**
     * Add email footer
     *
     * @return  void
     */
    public function add_email_footer() {
        include TIMETICS_PLUGIN_DIR . '/templates/emails/email-footer.php';
    }

    /**
     * Get email content
     *
     * @return string
     */
    public function get_template_content() {
        ob_start();
        $this->add_email_body();
        $template = ob_get_clean();

        return $template;

    }

    /**
     * Send email using email template
     *
     * @return  bool
     */
    public function send() {
        $headers = $this->get_headers();
        $subject = $this->get_subject();
        $to      = $this->get_recipient();
        $message = $this->get_template_content();

        /**
         * Added temporary for leagacy sass. It will remove in future.
         */
        $data = apply_filters( 'timetics/admin/email/send', [$to, $subject, $message, $headers] );

        return wp_mail( ...$data );
    }
}
