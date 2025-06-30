<?php

namespace H5APPlayer\Core;

class Ajax
{
    public function __construct()
    {
        add_action('wp_ajax_h5ap_get_stream_data', [$this, 'getStreamData']);
        add_action('wp_ajax_nopriv_h5ap_get_stream_data', [$this, 'getStreamData']);
    }

    public function getStreamData()
    {
        $nonce = sanitize_text_field(stripslashes($_POST['nonce']));
        if (!wp_verify_nonce($nonce, 'wp_rest')) {
            wp_send_json_error('Invalid nonce');
        }
        // wp_send_json_success('success');
        $streamUrl = sanitize_url(stripslashes($_POST['url']));

        $stream = new Stream();
        $streamData = $stream->getStreamData($streamUrl);
        if ($streamData) {
            wp_send_json_success($streamData);
        }
        // $streamData = [];
        wp_send_json_success($streamUrl);
    }
}
