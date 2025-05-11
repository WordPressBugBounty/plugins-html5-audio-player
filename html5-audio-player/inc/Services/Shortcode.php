<?php

namespace H5APPlayer\Services;

use H5APPlayer\Helper\Functions;

class Shortcode
{
    protected static $_instance = null;

    public function __construct()
    {
        add_shortcode('audio_player', [$this, 'audioPlayer']);
        add_shortcode('bypass_audio_player', [$this, 'audioPlayer']);
    }

    /**
     * construct function
     */
    function register()
    {
        self::instance();
    }

    /**
     * Create instance function
     */
    static function instance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * [audio_player] shotcode
     */
    public function audioPlayer($atts)
    {
        extract(shortcode_atts(array(
            'id' => null,
            'file' => null,
            'src' => null,
            'width' => null,
            'controls' => null,
            'preload' => null,
            'repeat' => null,
            'start_time' => 0,
        ), $atts));


        ob_start();

        if (empty($id)) {
            $id = uniqid();
        }

        if (empty($file)) {
            $file = get_post_meta($id, '_ahp_quick-audio-file', true);
        }

        $width = $width ? $width : Functions::settings('h5ap_player_width', ['width' => '100', 'unit' => '%']);
        $repeat = $repeat ? ($repeat === 'true' ? ' loop' : '')  : (Functions::settings('h5ap_repeat', 'loop') === 'loop' ? ' loop ' : '');
        $autoplay = Functions::settings('h5ap_autoplay', '0') === '1' ? ' autoplay ' : '';
        $preload = $preload ? $preload : Functions::settings('h5ap_preload', 'metadata');
        $muted = Functions::settings('h5ap_muted', '0') === '1' ? ' muted ' : '';
        $stime = (int)Functions::settings('h5ap_seektime', '10');

        if ($file) {
            $src = $file;
        }

        if (empty($src)) {
            return false;
        }

        if (is_array($width) && isset($width['width'])) {
            if ($width['width'] === 0) {
                $width = '100%';
            } else {
                $width = $width['width'] . $width['unit'];
            }
        }

        $code_controls = $controls ? explode(',', $controls) : null;
        $final_controls = [];

        if (is_array($code_controls)) {
            foreach ($code_controls as $control) {
                array_push($final_controls, trim($control));
            }
        }

        $controls = $final_controls ? $final_controls : Functions::settings('h5ap_controls', ['play', 'progress', 'current-time', 'mute', 'volume', 'settings']);

        $block  = [
            'blockName' => 'h5ap/audioplayer',
            'attrs' => [
                'source'        => $src,
                'controls' => array_fill_keys($controls, true),
                'width' => $width,
                'seekTime' => $stime,
                'repeat' => (bool)$repeat,
                'autoplay' => $autoplay,
                'preload' => $preload,
                'muted' => $muted,
                'startTime' => (int)$start_time
            ]
        ];

        return render_block($block);
    }
}
