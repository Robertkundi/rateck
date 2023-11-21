<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * includes all files and trigger the action hook by load
 */
class Bascart_Theme_Includes {
    private static $rel_path	 = null;
    private static $initialized	 = false;
    private static $customizer	 = [];

    // auto load
    // ----------------------------------------------------------------------------------------
    public static function init() {
        if ( self::$initialized ) {
            return;
        } else {
            self::$initialized = true;
        }
        self::_action_init();

        if(!is_admin()){
            // for frontend
            add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ), 20	);
        } 

        if(is_admin()){
            // For admin Dashboard
            function bascart_admin_style() {
                wp_enqueue_style( 'admin-css', BASCART_CSS . '/admin/style.css', null, BASCART_VERSION );
            }
            add_action( 'admin_enqueue_scripts', 'bascart_admin_style');
        }
    }

    // include method, using file prefix
    // ----------------------------------------------------------------------------------------
    public static function include_isolated( $file = null, $directory = 'core' ) {
        if($file != null){
            $filename = $directory . $file;

            require_once trailingslashit( get_template_directory() ). $filename ;
        }
    }

    /******************************************************************************************
     ** starts include section
     ** add all files bellow, they will be included by load.
     ** all include files should be mentioned here.
     ** DO NOT use include() function anywhere else except init.php nd the theme functions.php
     ******************************************************************************************/

    // include all necessary files for hooks
    // ----------------------------------------------------------------------------------------
    public static function _action_init() {

        // helper files:functions
        self::include_isolated( '/helpers/functions/global.php' );
        self::include_isolated( '/helpers/functions/template.php' );
        self::include_isolated( '/helpers/functions/menu-functions.php' );

        // helper files:classes
        self::include_isolated( '/helpers/classes/global.php' );

        // lib files
        self::include_isolated( '/libs/class-tgm-plugin-activation.php' );

        // setup related files
        self::include_isolated( '/hooks/tgmpa-plugins.php' );

        // gogole font
        self::include_isolated( '/hooks/devm-google-fonts.php' );

        // register widget areas
        self::include_isolated( '/hooks/widget-areas.php' );

        // register widget areas
        self::include_isolated( '/hooks/cpt.php' );

        //woocommerce file
        self::include_isolated( '/hooks/woocommerce.php' );

        // theme-demos file
        self::include_isolated( '/hooks/theme-demos.php' );
    }


    // add all enqueue files here, for frontend
    // ----------------------------------------------------------------------------------------
    public static function _action_enqueue_scripts() {
        self::include_isolated( '/enqueues/frontend/static.php' );
        self::include_isolated( '/enqueues/frontend/dynamic.php' );
    }
}

Bascart_Theme_Includes::init();