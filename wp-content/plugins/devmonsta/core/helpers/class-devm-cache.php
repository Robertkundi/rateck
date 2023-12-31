<?php
if ( !defined( 'DEVM' ) ) {
    die( 'Forbidden' );
}

class Devm_Cache {
    /**
     * The actual cache
     * @var array
     */
    protected static $cache = [];

    protected static $min_free_memory = 10485760;

    protected static $not_found_value;

    protected static $hits = 0;

    protected static $misses = 0;

    protected static $freed = 0;

    protected static function get_memory_limit() {
        $memory_limit = ini_get( 'memory_limit' );

        if ( $memory_limit === '-1' ) { // This happens in WP CLI
            return 256 * 1024 * 1024;
        }

        switch ( substr( $memory_limit, -1 ) ) {
        case 'M':return intval( $memory_limit ) * 1024 * 1024;
        case 'K':return intval( $memory_limit ) * 1024;
        case 'G':return intval( $memory_limit ) * 1024 * 1024 * 1024;
        default:return intval( $memory_limit ) * 1024 * 1024;
        }

    }

    protected static function memory_exceeded() {
        return memory_get_usage( false ) >= self::get_memory_limit() - self::$min_free_memory;

    }

    /**
     * @internal
     */
    public static function init_static() {
        self::$not_found_value = new Devm_Cache_Not_Found_Exception();

        foreach ( [
            'query'                     => true,
            'plugins_loaded'            => true,
            'wp_get_object_terms'       => true,
            'created_term'              => true,
            'wp_upgrade'                => true,
            'added_option'              => true,
            'updated_option'            => true,
            'deleted_option'            => true,
            'wp_after_admin_bar_render' => true,
            'http_response'             => true,
            'oembed_result'             => true,
            'customize_post_value_set'  => true,
            'customize_save_after'      => true,
            'customize_render_panel'    => true,
            'customize_render_control'  => true,
            'customize_render_section'  => true,
            'role_has_cap'              => true,
            'user_has_cap'              => true,
            'theme_page_templates'      => true,
            'pre_get_users'             => true,
            'request'                   => true,
            'send_headers'              => true,
            'updated_usermeta'          => true,
            'added_usermeta'            => true,
            'image_memory_limit'        => true,
            'upload_dir'                => true,
            'wp_head'                   => true,
            'wp_footer'                 => true,
            'wp'                        => true,
            'wp_init'                   => true,
            'devm_init'                 => true,
            'init'                      => true,
            'updated_postmeta'          => true,
            'deleted_postmeta'          => true,
            'setted_transient'          => true,
            'registered_post_type'      => true,
            'wp_count_posts'            => true,
            'wp_count_attachments'      => true,
            'after_delete_post'         => true,
            'post_updated'              => true,
            'wp_insert_post'            => true,
            'deleted_post'              => true,
            'clean_post_cache'          => true,
            'wp_restore_post_revision'  => true,
            'wp_delete_post_revision'   => true,
            'get_term'                  => true,
            'edited_term_taxonomies'    => true,
            'deleted_term_taxonomy'     => true,
            'edited_terms'              => true,
            'created_term'              => true,
            'clean_term_cache'          => true,
            'edited_term_taxonomy'      => true,
            'switch_theme'              => true,
            'wp_get_update_data'        => true,
            'clean_user_cache'          => true,
            'process_text_diff_html'    => true,
        ] as $hook => $tmp ) {
            add_filter( $hook, [ __CLASS__, 'free_memory' ], 1 );
        }

        foreach ( [
            'switch_blog'               => true,
            'upgrader_post_install'     => true,
            'upgrader_process_complete' => true,
            'switch_theme'              => true,
        ] as $hook => $tmp ) {
            add_filter( $hook, [ __CLASS__, 'clear' ], 1 );
        }

    }

    public static function is_enabled() {
        return true;
    }

    /**
     * @param mixed $dummy
     * @return mixed
     */
    public static function free_memory( $dummy = null ) {

        while ( self::memory_exceeded() && !empty( self::$cache ) ) {
            reset( self::$cache );

            $key = key( self::$cache );

            unset( self::$cache[$key] );
        }

        ++self::$freed;

        return $dummy;
    }

    /**
     * @param $keys
     * @param $value
     * @param $keys_delimiter
     */
    public static function set( $keys, $value, $keys_delimiter = '/' ) {

        if ( !self::is_enabled() ) {
            return;
        }

        self::free_memory();

        devm_array_key_set( $keys, $value, self::$cache, $keys_delimiter );

        self::free_memory();
    }

    /**
     * Unset key from cache
     * @param $keys
     * @param $keys_delimiter
     */
    public static function del( $keys, $keys_delimiter = '/' ) {
        devm_array_key_unset( $keys, self::$cache, $keys_delimiter );

        self::free_memory();
    }

    /**
     * @param $keys
     * @param $keys_delimiter
     * @return mixed
     * @throws Devm_Cache_Not_Found_Exception
     */
    public static function get( $keys, $keys_delimiter = '/' ) {
        $keys     = (string) $keys;
        $keys_arr = explode( $keys_delimiter, $keys );

        $key = $keys_arr;
        $key = array_shift( $key );

        if ( $key === '' || $key === null ) {
            trigger_error( 'First key must not be empty', E_USER_ERROR );
        }

        self::free_memory();

        $value = devm_array_key_get( $keys, self::$cache, self::$not_found_value, $keys_delimiter );

        self::free_memory();

        if ( $value === self::$not_found_value ) {
            ++self::$misses;

            throw new Devm_Cache_Not_Found_Exception();
        } else {
            ++self::$hits;

            return $value;
        }

    }

    /**
     * Empty the cache
     * @param mixed $dummy When method is used in add_filter()
     * @return mixed
     */
    public static function clear( $dummy = null ) {
        self::$cache = [];

        /**
         * This method is used in add_filter() so to not break anything return filter value
         */
        return $dummy;
    }

    /**
     * Debug information
     * <?php add_action('admin_footer', function(){ Devm_Cache::stats(); });
     * @since 2.4.17
     */
    public static function stats() {
        echo '<div style="z-index: 10000; position: relative; background: #fff; padding: 15px;">';
        echo '<p>';
        echo '<strong>Cache Hits:</strong> ' . esc_html( self::$hits ) . '<br />';
        echo '<strong>Cache Misses:</strong> ' . esc_html( self::$misses ) . '<br />';
        echo '<strong>Cache Freed:</strong> ' . esc_html( self::$freed ) . '<br />';
        echo '<strong>PHP Memory Peak Usage:</strong> ' . devm_human_bytes( memory_get_peak_usage( false ) ) . '<br />';
        echo '</p>';
        echo '<ul>';

        foreach ( self::$cache as $group => $cache ) {
            echo "<li><strong>Group:</strong>
				$group - ( " . number_format( strlen( serialize( $cache ) ) / KB_IN_BYTES, 2 ) . 'k )
				</li>';
        }

        echo '</ul>';
        echo '</div>';
    }

}

class Devm_Cache_Not_Found_Exception extends Exception {}

Devm_Cache::init_static();