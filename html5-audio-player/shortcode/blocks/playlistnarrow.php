<?php

$block = [
    'blockName' => 'h5ap/playlistnarrow',
    'attrs' => [
        'align'            => '',
        'alignment'        => $meta('plp_align', 'left'),
        'audios'           => $tracks,
        'theme'            => $player_theme,
        'hideDownload'     => $meta('playlist_hide_download', false, true),
        'width'            => $plp_width . 'px',
        'brandColor'       => $meta('narrow_custom_brand_color'),
        'bgColor'          => $meta('narrow_custom_bg'),
        'textColor'        => $meta('narrow_custom_color'),
        'hoverBgColor'     => $meta('narrow_custom_hover_bg'),
        'hoverTextColor'   => $meta('narrow_custom_hover_color'),
        'oddBgColor'       => $meta('narrow_odd_bg'),
        'evenBgColor'      => $meta('narrow_even_bg'),
        'borderRadius'     => ['top' => $meta('narrow_radius') . 'px'],
        'controls'     => array_fill_keys($meta('narrow_controls', ['play', 'progress', 'current-time', 'mute', 'volume', 'settings']), true),
        'options' => [
            'volume' => $meta('plp_volume'),
        ],
        'data' => [
            'forward_rewind_change_audio' => $meta('forward_rewind_change_audio', false, true),
            'initialVolume' => $meta('plp_volume'),
        ]
    ],
    'innerBlocks' => [],
    'innerHTML' => '',
    'innerContent' => [],
];
