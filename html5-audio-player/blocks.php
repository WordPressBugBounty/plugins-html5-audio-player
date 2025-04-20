<?php
if (!defined('ABSPATH')) {
    return;
}

use H5APPlayer\Helper\Functions;

if (!class_exists('H5AP_Block')) {
    class H5AP_Block
    {
        function __construct()
        {
            add_action('init', [$this, 'init']);
            add_action('enqueue_block_assets', [$this, 'enqueue_block_assets']);
            add_action('enqueue_block_editor_assets', [$this, 'enqueue_block_editor_assets']);
        }

        function enqueue_block_editor_assets()
        {
            // wp_register_style('h5ap-blocks', H5AP_PRO_PLUGIN_DIR . 'dist/blocks.css', array('bplugins-plyrio', 'h5ap-player'), H5AP_PRO_VERSION);

            wp_localize_script('h5ap-audioplayer-editor-script', 'h5apPlayer', [
                'speed' => explode(',', Functions::getSetting('speed', '0.5, 1, 1.5, 2.0, 2.5')),
                'multipleAudio' => (bool) Functions::getSetting('multipleAudio', false),
                'plyrio_js' => H5AP_PRO_PLUGIN_DIR . 'assets/js/plyr-v3.7.2.js',
                'plyr_js' => H5AP_PRO_PLUGIN_DIR . 'build/player.js',
                'isPipe' => h5ap_fs()->can_use_premium_code()
            ]);
        }

        function enqueue_block_assets()
        {
            // mp3 player
            wp_register_script('bpmp-mp3-player-script', plugins_url('build/script.js', __FILE__), [], H5AP_PRO_VERSION, true); // Frontend Script
            // wp_register_style('bpmp-mp3-player-style', plugins_url('audio-player-block-pro/build/style.css', __FILE__), [], H5AP_PRO_VERSION); // Style
            // wp_register_style('bpmp-mp3-player-editor-style', plugins_url('build/editor.css', __FILE__), ['bpmp-mp3-player-style'], H5AP_PRO_VERSION); // Backend Style


            // plyrio library 
            wp_register_script('bplugins-plyrio', H5AP_PRO_PLUGIN_DIR . 'assets/js/plyr-v3.7.2.js', array(), '3.7.2', false);
            wp_register_style('bplugins-plyrio', H5AP_PRO_PLUGIN_DIR . 'assets/css/plyr-v3.7.2.css', array(), '3.7.2', 'all');

            // single player
            // wp_register_script('h5ap-player', H5AP_PRO_PLUGIN_DIR . 'build/player.js', array('jquery', 'bplugins-plyrio'), H5AP_PRO_VERSION, true);
            // wp_register_style('h5ap-player', H5AP_PRO_PLUGIN_DIR . 'build/player.css', array('bplugins-plyrio'), H5AP_PRO_VERSION);



            // playlist
            wp_register_script('h5ap-playlist', H5AP_PRO_PLUGIN_DIR . 'build/playlist.js', ['bplugins-plyrio'], H5AP_PRO_VERSION);
            wp_register_style('h5ap-playlist', H5AP_PRO_PLUGIN_DIR . 'build/playlist.css', ['bplugins-plyrio'], H5AP_PRO_VERSION);

            wp_localize_script('h5ap-player', 'h5apPlayer', [
                'speed' => explode(',', Functions::getSetting('speed', '0.5, 1, 1.5, 2.0, 2.5')),
                'multipleAudio' => (bool) Functions::getSetting('multipleAudio', false),
                'plyrio_js' => H5AP_PRO_PLUGIN_DIR . 'assets/js/plyr-v3.7.2.js',
                'plyr_js' => H5AP_PRO_PLUGIN_DIR . 'build/player.js',
                'isPipe' => h5ap_fs()->can_use_premium_code()
            ]);
        }

        function init()
        {
            register_block_type(__DIR__ . '/build/blocks/audioplayer');
            if (h5ap_fs()->can_use_premium_code()) {
                register_block_type(__DIR__ . '/build/blocks/audioplaylist');
                register_block_type(__DIR__ . '/build/blocks/playlist-narrow');
                register_block_type(__DIR__ . '/build/blocks/playlist-extensive');
            }

            if (class_exists('Functions')) {
                wp_localize_script('h5ap-blocks', 'h5apPlayer', [
                    'speed' => explode(',', Functions::getSetting('speed', '0.5, 1, 1.5, 2.0, 2.5')),
                    'multipleAudio' => (bool) Functions::getSetting('multipleAudio', false),
                ]);

                wp_localize_script('h5ap-playlist', 'h5apPlayer', [
                    'speed' => explode(',', Functions::getSetting('speed', '0.5, 1, 1.5, 2.0, 2.5')),
                    'multipleAudio' => (bool) Functions::getSetting('multipleAudio', false),
                ]);
            }
        }
    }

    new H5AP_Block();
}
