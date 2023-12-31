<?php

class Devm_Dumper {
    private static $_objects;
    private static $_output;
    private static $_depth;

    public static function dump( $var, $depth = 10 ) {
        self::reset_internals();

        self::$_depth = $depth;
        self::dump_internal( $var, 0 );

        $output = self::$_output;

        self::reset_internals();

        return $output;
    }

    private static function reset_internals() {
        self::$_output  = '';
        self::$_objects = [];
        self::$_depth   = 10;
    }

    private static function dump_internal( $var, $level ) {

        switch ( gettype( $var ) ) {
        case 'boolean':
            self::$_output .= $var ? 'true' : 'false';
            break;
        case 'integer':
            self::$_output .= "$var";
            break;
        case 'double':
            self::$_output .= "$var";
            break;
        case 'string':
            self::$_output .= "'$var'";
            break;
        case 'resource':
            self::$_output .= '{resource}';
            break;
        case 'NULL':
            self::$_output .= "null";
            break;
        case 'unknown type':
            self::$_output .= '{unknown}';
            break;
        case 'array':

            if ( self::$_depth <= $level ) {
                self::$_output .= 'array(...)';
            } else

            if ( empty( $var ) ) {
                self::$_output .= 'array()';
            } else {
                $keys   = array_keys( $var );
                $spaces = str_repeat( ' ', $level * 4 );
                self::$_output .= "array\n" . $spaces . '(';

                foreach ( $keys as $key ) {
                    self::$_output .= "\n" . $spaces . "    [$key] => ";
                    self::$_output .= self::dump_internal( $var[$key], $level + 1 );
                }

                self::$_output .= "\n" . $spaces . ')';
            }

            break;
        case 'object':

            if (  ( $id = array_search( $var, self::$_objects, true ) ) !== false ) {
                self::$_output .= get_class( $var ) . '(...)';
            } else

            if ( self::$_depth <= $level ) {
                self::$_output .= get_class( $var ) . '(...)';
            } else {
                $id         = array_push( self::$_objects, $var );
                $class_name = get_class( $var );
                $members    = (array) $var;
                $keys       = array_keys( $members );
                $spaces     = str_repeat( ' ', $level * 4 );
                self::$_output .= "$class_name\n" . $spaces . '(';

                foreach ( $keys as $key ) {
                    $key_display = strtr( trim( $key ), ["\0" => ':'] );
                    self::$_output .= "\n" . $spaces . "    [$key_display] => ";
                    self::$_output .= self::dump_internal( $members[$key], $level + 1 );
                }

                self::$_output .= "\n" . $spaces . ')';
            }

            break;
        }

    }

}
