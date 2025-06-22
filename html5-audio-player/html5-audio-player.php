<?php

/*
 * Plugin Name: Html5 Audio Player
 * Plugin URI:  https://bplugins.com/products/html5-audio-player/
 * Description: You can easily integrate html5 audio player in your WordPress website using this plugin.
 * Version: 2.3.3
 * Author: bPlugins
 * Author URI: http://bPlugins.com
 * License: GPLv3
 * Text Domain: h5ap
 */
if ( function_exists( 'h5ap_fs' ) ) {
    h5ap_fs()->set_basename( false, __FILE__ );
} else {
    if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
        require_once dirname( __FILE__ ) . '/vendor/autoload.php';
    }
    // DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    if ( !function_exists( 'h5ap_fs' ) ) {
        if ( !function_exists( 'h5ap_fs' ) ) {
            // Create a helper function for easy SDK access.
            function h5ap_fs() {
                global $h5ap_fs;
                if ( !isset( $h5ap_fs ) ) {
                    // Include Freemius SDK.
                    $h5ap_fs = fs_dynamic_init( array(
                        'id'              => '14260',
                        'slug'            => 'html5-audio-player',
                        'premium_slug'    => 'html5-audio-player-pro',
                        'type'            => 'plugin',
                        'public_key'      => 'pk_ea4da01be073820a5edf59346b675',
                        'is_premium'      => false,
                        'premium_suffix'  => 'Pro',
                        'has_addons'      => false,
                        'has_paid_plans'  => true,
                        'has_affiliation' => 'selected',
                        'menu'            => array(
                            'slug'    => 'edit.php?post_type=audioplayer',
                            'support' => false,
                        ),
                        'is_live'         => true,
                    ) );
                }
                return $h5ap_fs;
            }

            // Init Freemius.
            h5ap_fs();
            // Signal that SDK was initiated.
            do_action( 'h5ap_fs_loaded' );
        }
    }
    /*Some Set-up*/
    define( 'H5AP_PRO_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
    define( 'H5AP_PRO_FILE_BASENAME', plugin_basename( __FILE__ ) );
    define( 'H5AP_PRO_DIR_BASENAME', plugin_basename( __DIR__ ) );
    define( 'H5AP_PRO_VERSION', ( $_SERVER['HTTP_HOST'] ?? null === 'localhost' ? time() : '2.3.3' ) );
    defined( 'H5AP_PRO_PATH' ) or define( 'H5AP_PRO_PATH', plugin_dir_path( __FILE__ ) );
    if ( !function_exists( 'h5ap_get_post_meta' ) ) {
        function h5ap_get_post_meta(  $id, $key  ) {
            $meta = get_post_meta( $id, $key, true );
            return function (
                $key,
                $default = null,
                $isBoolean = false,
                $key2 = null
            ) use(&$meta) {
                //If $key2 is provided, check for nested key
                if ( $key2 !== null ) {
                    if ( isset( $meta[$key][$key2] ) ) {
                        return ( $isBoolean ? (bool) $meta[$key][$key2] : $meta[$key][$key2] );
                    }
                    return $default;
                }
                // If only $key is provided, check in $meta
                if ( isset( $meta[$key] ) ) {
                    return ( $isBoolean ? (bool) $meta[$key] : $meta[$key] );
                }
                return $default;
            };
        }

    }
    if ( !function_exists( 'h5ap_get_settings' ) ) {
        function h5ap_get_settings(  $key, $default = null  ) {
            $settings = get_option( $key, $default );
            return function ( $key, $default = null ) use(&$settings) {
                if ( isset( $settings[$key] ) ) {
                    return $settings[$key];
                }
                return $default;
            };
        }

    }
    function h5ap_get_audio_type(  $src  ) {
        $ext = pathinfo( $src, PATHINFO_EXTENSION );
        if ( $ext === 'm4a' ) {
            return 'audio/mp4';
        }
        return "audio/{$ext}";
    }

    if ( !class_exists( 'CSF' ) ) {
        require_once 'admin/codestar-framework/codestar-framework.php';
    }
    if ( class_exists( 'H5APPlayer\\Init' ) ) {
        H5APPlayer\Init::register_services();
    }
    add_action( 'plugins_loaded', function () {
        require_once 'shortcode/player.php';
        // require_once (__DIR__.'/inc/Elementor/Widgets/Widgets.php');
        if ( h5ap_fs()->can_use_premium_code() ) {
            if ( file_exists( __DIR__ . '/inc/Widget/widget.php' ) ) {
                require_once __DIR__ . '/inc/Widget/widget.php';
            }
            if ( file_exists( __DIR__ . '/inc/Widget/SearchForm.php' ) ) {
                require_once __DIR__ . '/inc/Widget/SearchForm.php';
            }
        }
        /*-------------------------------------------------------------------------------*/
        /*   CMB2 + OTHER INC
        		/*-------------------------------------------------------------------------------*/
        require_once 'tinymce/ewic-tinymce.php';
        add_filter( 'template_include', 'h5ap_search_template' );
        function h5ap_search_template(  $template  ) {
            global $wp_query;
            if ( !isset( $_GET['bps'] ) ) {
                return $template;
            }
            return dirname( __FILE__ ) . '/inc/Template/search.php';
        }

        /*UPDATE: there was a missing ";" after $template*/
        require_once __DIR__ . '/blocks.php';
        require_once __DIR__ . '/blocks/init.php';
        if ( file_exists( __DIR__ . '/audio-player-block-pro/plugin.php' ) ) {
            require_once __DIR__ . '/audio-player-block-pro/plugin.php';
        }
    } );
}