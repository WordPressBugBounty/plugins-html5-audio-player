<?php

$narrow_custom_brand_color      = $meta('narrow_custom_brand_color');
$narrow_custom_bg               = $meta('narrow_custom_bg');
$narrow_custom_color            = $meta('narrow_custom_color');
$narrow_custom_hover_bg         = $meta('narrow_custom_hover_bg');
$narrow_custom_hover_color      = $meta('narrow_custom_hover_color');
$narrow_odd_bg                  = $meta('narrow_odd_bg');
$narrow_even_bg                 = $meta('narrow_even_bg');
$narrow_radius                  = $meta('narrow_radius');


$block = [
    'blockName' => 'h5ap/playlistnarrow',
    'attrs' => [
        'align'            => '',
        'alignment'        => 'left',
        'audios'           => $tracks,
        'theme'            => $player_theme,
        'hideDownload'     => false,
        'width'            => [
            'number' => 100,
            'unit'   => '%'
        ],
        'brandColor'       => $narrow_custom_brand_color,
        'bgColor'          => $narrow_custom_bg,
        'textColor'        => $narrow_custom_color,
        'hoverBgColor'     => $narrow_custom_hover_bg,
        'hoverTextColor'   => $narrow_custom_hover_color,
        'oddBgColor'       => $narrow_odd_bg,
        'evenBgColor'      => $narrow_even_bg,
        'borderRadius'     => ['top' => $narrow_radius . 'px']
    ],
    'innerBlocks' => [],
    'innerHTML' => '',
    'innerContent' => [],
];
