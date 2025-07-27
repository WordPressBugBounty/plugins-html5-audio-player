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
    'blockName' => 'h5ap/playlistextensive',
    'attrs' => [
        'align'            => '',
        'alignment'        => $meta('plp_align', 'left'),
        'audios'           => $tracks,
        'theme'            => $player_theme,
        'hideDownload'     => false,
        'width'            => $plp_width . 'px',
        'brandColor'       => $meta('narrow_custom_brand_color'),
        'bgColor'          => $meta('narrow_custom_bg'),
        'textColor'        => $meta('narrow_custom_color'),
        'hoverBgColor'     => $meta('narrow_custom_hover_bg'),
        'hoverTextColor'   => $meta('narrow_custom_hover_color'),
        'oddBgColor'       => $meta('narrow_odd_bg'),
        'evenBgColor'      => $meta('narrow_even_bg'),
        'borderRadius'     => ['top' => $narrow_radius . 'px']
    ],
    'innerBlocks' => [],
    'innerHTML' => '',
    'innerContent' => [''],
];
