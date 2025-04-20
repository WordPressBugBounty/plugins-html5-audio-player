<?php

namespace H5APPlayer\Services;

use H5APPlayer\Helper\Functions;

class Shortcode
{
    protected static $_instance = null;

    /**
     * construct function
     */
    function register()
    {
        add_shortcode('audio_player', [$this, 'audioPlayer']);
        // add_shortcode('player', [$this, 'player']);
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
    function audioPlayer($attrs)
    {
        extract(shortcode_atts(array(
            'id' => null,
            'file' => null,
            'src' => null,
            'width' => '100%',
            'controls' => null
        ), $attrs));

        wp_enqueue_style('h5ap-player');
        wp_enqueue_script('h5ap-player');

        $code_controls = $controls ? explode(',', $controls) : null;

        ob_start();

        if (empty($id)) {
            $id = uniqid();
        }

        if ($file) {
            $src = $file;
        }

        if (empty($src)) {
            return false;
        }

        $repeat = '';
        $autoplay = '';
        $preload = 'metadata';
        $muted = '';

        $controls = ['play', 'progress', 'current-time', 'mute', 'volume', 'settings'];

        $options = array(
            'controls' => $controls,
        );

?>
        <div class="skin_default" id="skin_default">
            <div class="h5ap_quick_player" data-options='<?php echo esc_html(wp_json_encode($options)) ?>' style="width:<?php echo esc_html($width); ?>">
                <audio playsinline controls class="player<?php echo esc_attr($id); ?>" preload="<?php echo esc_html($preload); ?>" <?php echo esc_html($repeat . $autoplay . $muted); ?>>
                    <source src="<?php echo esc_html($src); ?>" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
        <?php $output = ob_get_clean();
        return $output; ?>
<?php
    }

    function player($atts)
    {
        extract(shortcode_atts(array(
            'id' => null,
        ), $atts));

        $id = esc_html($id);

        $post_id = esc_html($atts['id']);
        $post = get_post($post_id);
        if (!$post) {
            return '';
        }
        if (post_password_required($post)) {
            return get_the_password_form($post);
        }
        switch ($post->post_status) {
            case 'publish':
                return $this->displayContent($post);
            case 'private':
                if (current_user_can('read_private_posts')) {
                    return $this->displayContent($post);
                }
                return '';
            case 'draft':
            case 'pending':
            case 'future':
                if (current_user_can('edit_post', $post_id)) {
                    return $this->displayContent($post);
                }
                return '';
            default:
                return '';
        }
    }

    public function displayContent($post_id)
    {
        $player_type = Functions::playerMeta($post_id, 'h5ap_player_type', 'opt-1');
        if ($player_type === '') {
            $player_type = 'opt-1';
        }

        $align = Functions::playerMeta($post_id, 'plp_align', 'center');
        $alignCSS = '';
        if ($align === 'start') {
            $alignCSS = "margin-left: 0;";
        } else if ($align === 'end') {
            $alignCSS = "margin-left: auto;";
        } else if ($align === 'center') {
            $alignCSS = "margin: 0 auto;";
        }
        ob_start();

        if (file_exists(__DIR__ . '/player/' . $player_type . '.php')) {
            include __DIR__ . '/player/' . $player_type . '.php';
        }

        wp_enqueue_style('h5ap-player');
        wp_enqueue_script('h5ap-player');

        $output = ob_get_clean();
        return $output;
    }
}
