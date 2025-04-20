<?php

$autoplay = $meta('autoplay', false, true);
$repeat = $meta('repeat', false, true);
$standard_skin = $meta('standard_skin');
$color = $meta('color');
$background = $meta('background');
$controls = $meta('controls', ['play', 'progress', 'current-time', 'duration', 'mute', 'volume']);
$seek_time = (int) $meta('seektime', 10);
$start_time = (int)$meta('startTime', 0);
$preload = $meta('preload', 'metadata', true);
$radius = $meta('radius') . 'px';
$disable_pause      = $meta('disable_pause', false, true);
$disable_loader     = $meta('disable_loader', true, true);
$sticky_simple_background     = $meta('sticky_simple_background');

$settings = get_option('h5ap_settings', []);




$block = [
    'blockName' => 'h5ap/audioplayer',
    'attrs' => [
        'uniqueId'      => 'uniqueId',
        'clientId'      => '',
        'align'         => '',
        'source'        => $h5vp_default_audio,
        'poster'        => $sticky_poster,
        'title'         => $title,
        'artist'        => $author,
        'color'         => $color,
        'primaryColor'  => '#1aafff',
        'hoverColor'    => '#00B3FF',
        'controlColor'  =>  $standard_skin != 'default' ?  $color : 'var(--plyr-audio-control-color,#4a5464)',
        'bgColor'       => ($type === 'opt-1' || $type === 'opt-3') ? $sticky_simple_background : $background,
        'skin'          => $type === 'opt-1' ? ucfirst($standard_skin) : ($sticky_skin === 'simple' ? 'Simple-3' : (ucfirst($sticky_skin))),
        'repeat'        => $repeat,
        'autoplay'      => $autoplay,
        'isSticky'      => $type === 'opt-3' ? true : false,
        'muted'         => false,
        'loader'        => !$disable_loader,
        'saveState'     => $save_state,
        'seekTime'      => $seek_time,
        'startTime'     => $start_time,
        'preload'       => $preload,
        'download'      => true,
        'width'         => $width['width'] . $width['unit'],
        'radius'        => $type === 'opt-3' ? 0 : $radius,
        'controls'      => array_fill_keys($controls, true),
        'style'         => null,
        'CSS'           => ''
    ],
    'innerBlocks' => [],
    'innerHTML' => '',
    'innerContent' => [],
];
