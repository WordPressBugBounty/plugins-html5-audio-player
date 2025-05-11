<?php

use H5APPlayer\Helper\LocalizeScript;

$standard_skin = $meta('standard_skin');
$background = $meta('background', '#161616');
$sticky_simple_background     = $meta('sticky_simple_background');
$control_color     = $meta('control_color', '#fff');
$primary_color     = $meta('primary_color', '#195FF5');
$sticky_download     = $meta('sticky_download', false);
$download     = $meta('fusion_download', false, true);
$sticky_skin = $meta('sticky_skin');

// settings
$settings = h5ap_get_settings('h5ap_settings', []);
$settings_primary_color = $settings('h5ap_primary_color');
$settings_background = $settings('h5ap_background_color');


$bgColor = $background;
if ($type === 'opt-3') {
    $bgColor = $sticky_simple_background;
    $download = $sticky_download;
}

if ($standard_skin === 'default' && $primary_color === '#195FF5') {
    $bgColor = $settings_background;
    $control_color = $settings_primary_color;
}

$block = [
    'blockName' => 'h5ap/audioplayer',
    'attrs' => [
        'uniqueId'      => "player$post_id",
        'clientId'      => '',
        'align'         => '',
        'alignment'         => $meta('plp_align', 'left'),
        'source'        => $h5vp_default_audio,
        'poster'        => $meta('sticky_poster'),
        'title'         => $meta('title'),
        'artist'        => $meta('author'),
        'color'         => $meta('color', '#fff'),
        'textColor'     => $meta('color', '#fff'),
        'primaryColor'  => $primary_color,
        'hoverColor'    => '#00B3FF',
        'controlColor'  =>  $control_color,
        'bgColor'       => $bgColor,
        'skin'          => $type === 'opt-1' ? ucfirst($standard_skin) : ($sticky_skin === 'simple' ? 'Simple-3' : (ucfirst($sticky_skin))),
        'repeat'        => $meta('repeat', false, true),
        'autoplay'      => $meta('autoplay', false, true),
        'isSticky'      => $type === 'opt-3' || $meta('enable_sticky', false),
        'muted'         => false,
        'loader'        => !$meta('disable_loader', true, true),
        'saveState'     => $meta('save_state', false, true),
        'disablePause'  => $meta('disable_pause', false, true),
        'seekTime'      => (int) $meta('seektime', 10),
        'startTime'     => (int)$meta('startTime', 0),
        'preload'       => $meta('preload', 'metadata', true),
        'download'      => $download,
        'width'         => $width['width'] . $width['unit'],
        'radius'        => $type === 'opt-3' ? 0 : $meta('radius') . 'px',
        'controls'      => array_fill_keys($meta('controls', ['play', 'progress', 'current-time', 'duration', 'mute', 'volume']), true),
        'style'         => null,
        'CSS'           => '',
        'i18n'          => LocalizeScript::translatedText(),
        'speed'         =>  $settings('h5ap_speed', '0.5, 0.75, 1, 1.25, 1.5, 1.75, 2, 4'),
    ],
    'innerBlocks' => [],
    'innerHTML' => '',
    'innerContent' => [],
];
