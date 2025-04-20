<?php

// use H5APPlayer\Helper\Functions;
//Lets register Shortcode 
// function h5ap_cpt_content_func($atts)
// {
//   extract(shortcode_atts(array(
//     'id' => null,
//   ), $atts));


//   $post_id = esc_html($atts['id']);
//   $post = get_post($id);
//   if (!$post) {
//     return '';
//   }


//   wp_enqueue_style('h5ap-player');
//   wp_enqueue_script('h5ap-player');
//   $player_type = Functions::playerMeta($id, 'h5ap_player_type', 'opt-1');
//   if ($player_type === '') {
//     $player_type = 'opt-1';
//   }

//   $align = Functions::playerMeta($id, 'plp_align', 'center');
//   $alignCSS = '';
//   if ($align === 'start') {
//     $alignCSS = "margin-left: 0;";
//   } else if ($align === 'end') {
//     $alignCSS = "margin-left: auto;";
//   } else if ($align === 'center') {
//     $alignCSS = "margin: 0 auto;";
//   }
//   // used on included files


//   if (post_password_required($post)) {
//     return get_the_password_form($post);
//   }
//   switch ($post->post_status) {
//     case 'publish':
//       ob_start();
//       if (file_exists(__DIR__ . '/player/' . $player_type . '.php')) {
//         include __DIR__ . '/player/' . $player_type . '.php';
//       }
//       return ob_get_clean();
//     case 'private':
//       if (current_user_can('read_private_posts')) {
//         ob_start();
//         if (file_exists(__DIR__ . '/player/' . $player_type . '.php')) {
//           include __DIR__ . '/player/' . $player_type . '.php';
//         }
//         return ob_get_clean();
//       }
//       return '';
//     case 'draft':
//     case 'pending':
//     case 'future':
//       if (current_user_can('edit_post', $post_id)) {
//         ob_start();
//         if (file_exists(__DIR__ . '/player/' . $player_type . '.php')) {
//           include __DIR__ . '/player/' . $player_type . '.php';
//         }
//         return ob_get_clean();
//       }
//       return '';
//     default:
//       return '';
//   }
// }
// add_shortcode('playerr', 'h5ap_cpt_content_func');

add_shortcode('player', function ($atts) {
  extract(shortcode_atts(array(
    'id' => null,
  ), $atts));


  $post_id = esc_html($atts['id']);
  $post = get_post($id);
  if (!$post) {
    return '';
  }

  if (post_password_required($post)) {
    return get_the_password_form($post);
  }
  switch ($post->post_status) {
    case 'publish':
      return h5ap_player_shortcode_content($post_id);
    case 'private':
      if (current_user_can('read_private_posts')) {
        return h5ap_player_shortcode_content($post_id);
      }
      return '';
    case 'draft':
    case 'pending':
    case 'future':
      if (current_user_can('edit_post', $post_id)) {
        return h5ap_player_shortcode_content($post_id);
      }
      return '';
    default:
      return '';
  }
});

if (!function_exists('h5ap_player_shortcode_content')) {
  function h5ap_player_shortcode_content($post_id)
  {

    $meta = h5ap_get_post_meta($post_id, '_h5ap_plyr');
    $type = $meta('h5ap_player_type');
    $player_theme = $meta('player_theme');
    $player_skin = $meta('player_skin');
    $h5vp_default_audio = $meta('h5vp_default_audio');
    $title = $meta('title');
    $author = $meta('author');
    $width = $meta('width', ['width: 100', 'unit: %']);
    $playlist_type = $meta('playlist_type');
    $playlist_in_metabox = $meta('playlist_in_metabox', []);
    $sticky_skin = $meta('sticky_skin');
    $sticky_poster = $meta('sticky_poster');
    $sticky_simple_background = $meta('sticky_simple_background');
    $forward_rewind_change_audio     = $meta('forward_rewind_change_audio');
    $plp_width                      = $meta('plp_width');
    $plp_align                      = $meta('plp_align');
    $plp_volume                     = $meta('plp_volume');
    $save_state                     = $meta('save_state', false, true);
    $sticky_download                = $meta('sticky_download');
    $fusion_download                = $meta('fusion_download');
    $sticky_volume                  = $meta('sticky_volume');
    $selected_audio                 = $meta('selected_audio');

    $tracks = [];


    if ($playlist_type !== 'create') {
      foreach ($selected_audio as $id) {
        $playlist_ids = get_post_meta($id, '_h5applaylist');

        foreach ($playlist_ids as $audios) {
          foreach ($audios as $audio) {
            if ($audio['audio'] !== '') {
              $tracks[] = wp_parse_args(['source' => $audio['audio']], $audio);
            }
          }
        }
      }
    } else {
      if (is_array($playlist_in_metabox) && !empty($playlist_in_metabox)) {
        foreach ($playlist_in_metabox as $audio) {
          $tracks[] = [
            'title' => $audio['pl_audio_title'],
            'source' => $audio['pl_audio_file'],
            'poster' => $audio['pl_audio_poster'],
            'artist' => $audio['pl_audio_artist']
          ];
        }
      } // if array is not empty (has data)
      // if(!empty($playlist_in_metabox)) // if array is not empty (has data) 
    }


    $block_types = [
      'opt-1' => 'audioplayer',
      'opt-2' => 'playlist' . $player_skin,
      'opt-3' => 'audioplayer',
    ];

    // return __DIR__ . '/blocks/' . $block_types[$type] . '.php';
    if (file_exists(__DIR__ . '/blocks/' . $block_types[$type] . '.php')) {
      $block = [];
      include __DIR__ . '/blocks/' . $block_types[$type] . '.php';
      // return $narrow_radius;
      return render_block($block);
    }



    ob_start();

    echo '<pre>';
    print_r($block);
    echo '</pre>';
    // // echo '<pre>';
    // // print_r($b[0]);
    // // echo '</pre>';

    return ob_get_clean();

    return render_block($block);
  }
}
