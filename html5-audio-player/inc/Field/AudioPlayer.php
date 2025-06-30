<?php

namespace H5APPlayer\Field;

class AudioPlayer
{

  public function register()
  {
    add_action('init', [$this, 'init'], 0);
  }

  public function init()
  {
    if (!class_exists('CSF')) {
      return false;
    }

    $prefix = '_h5ap_plyr';
    \CSF::createMetabox($prefix, array(
      'title' => 'Player Configuration',
      'post_type' => 'audioplayer',
    ));

    \CSF::createMetabox('_h5ap_plyr_skins', array(
      'title' => 'Player Skins',
      'post_type' => 'audioplayer',
      'context' => 'side',
    ));

    $this->configure($prefix);
  }

  public function configure($prefix)
  {

    \CSF::createSection(
      $prefix,
      array(
        'fields' => array(
          array(
            'id' => 'h5ap_player_type',
            'type' => 'button_set',
            'title' => 'Player Type',
            'class' => 'abu-button-set-trigger bplugins-meta-readonly', // IMPORTANT Add a classname to button set.
            'options' => array(
              'opt-1' => 'Standard Player',
              'opt-2' => 'Playlist Player',
              'opt-3' => 'Sticky Player',
            ),
            'default' => 'opt-1',
          ),
          array(
            'id' => 'h5vp_default_audio',
            'type' => 'upload',
            'title' => 'Audio source',
            'library' => 'audio',
            'dependency' => array(
              'h5ap_player_type',
              '!=',
              'opt-2'
            ),
            'placeholder' => 'http://',
            'button_title' => 'Add Audio',
            'remove_title' => 'Remove Audio',
          ),
          array(
            'id' => 'width',
            'type' => 'dimensions',
            'height' => false,
            'units' => array(
              'px',
              '%'
            ),
            'title' => 'Player Width',
            'default' => array(
              'width' => '100',
              'unit' => '%',
            ),
            'dependency' => array(
              'h5ap_player_type',
              '==',
              'opt-1',
              'all'
            )
          ),

          array(
            'id' => 'autoplay',
            'type' => 'switcher',
            'title' => 'AutoPlay',
            'desc' => 'AutoPlay will only work if you keep the player muted according the the latest autoplay policy. <a href="https://developers.google.com/web/updates/2017/09/autoplay-policy-changes" target="_blank" >Read More</a>',
            'default' => false,
            'dependency' => array('h5ap_player_type', '==', 'opt-1')
          ),
          array(
            'id' => 'repeat',
            'type' => 'switcher',
            'title' => 'Repeat',
            'default' => '0',
            'dependency' => array(
              'h5ap_player_type',
              '!=',
              'opt-2',
              'all'
            ),
          ),

          array(
            'id' => 'disable_loader',
            'type' => 'switcher',
            'title' => 'Disable Loader',
            'desc' => 'Enable this option if you want to disable the loading animation',
            'default' => '0',
            'dependency' => array('h5ap_player_type', '==', 'opt-1')
          ),


          array(
            'id' => 'sticky_poster',
            'type' => 'upload',
            'class' => 'bplugins-meta-readonly',
            'library' => 'image',
            'title' => 'Poster',
            'button_title' => 'Add or Upload Poster Image',
            'remove_title' => 'Remove',
            'desc' => '100x100 px photo is the standard poster size, accepted file type .png, .jpeg, .jpg ',
            'dependency' => array(
              'h5ap_player_type',
              '!=',
              'opt-2'
            ),
          ),
          array(
            'id' => 'title',
            'type' => 'text',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Title',
            'default' => 'Audio Title',
            'desc' => 'Enter the title of the audio',
            'dependency' => array(
              'h5ap_player_type',
              '!=',
              'opt-2'
            ),
          ),
          array(
            'id' => 'author',
            'type' => 'text',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Author',
            'default' => 'Author Name',
            'desc' => 'Enter the author of the audio',
            'dependency' => array(array('h5ap_player_type', '==', 'opt-1'), array('standard_skin', '==', 'wave')),
          ),
          array(
            'id' => 'standard_skin',
            'type' => 'button_set',
            'title' => 'Player Skin',
            'class' => 'bplugins-meta-readonly',
            'options' => array(
              'default' => 'Default',
              'fusion' => 'Fusion',
              'stamp' => 'Stamp',
              'wave' => 'Wave',
              'Card-1' => 'Card 1',
              'Card-2' => 'Card 2',
              'Simple-1' => 'Simple 1',
              'Simple-2' => 'Simple 2',
              'Player9' => 'Player 9',
              'Player10' => 'Player 10',
              'Player11' => 'Player 11',
            ),
            'default' => 'default',
          ),
          array(
            'id' => 'background',
            'type' => 'color',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Background color',
            'default' => '#333',
            'dependency' => array(
              'h5ap_player_type|standard_skin',
              '==|any',
              'opt-1|wave'
            ),
          ),


          array(
            'id' => 'disable_pause',
            'type' => 'switcher',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Disable Pause',
            'desc' => 'Enable this option if you want user can\'t pause the audio',
            'default' => '0',
            'dependency' => array('h5ap_player_type', '==', 'opt-1')
          ),


          array(
            'id' => 'controls',
            'type' => 'button_set',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Control buttons and Components',
            'multiple' => true,
            'options' => array(
              'restart' => 'Restart',
              'rewind' => 'Rewind',
              'play' => 'Play',
              'fast-forward' => 'Fast Forwards',
              'progress' => 'Progressbar',
              'duration' => 'Duration',
              'current-time' => 'Current Time',
              'mute' => 'Mute Button',
              'volume' => 'Volume Control',
              'settings' => 'Setting Button',
              'download' => 'Download Button',
            ),
            'default' => array(
              'play',
              'progress',
              'duration',
              'mute',
              'volume',
              'settings'
            ),
            'help' => 'Click on the item to turn ON/OFF',
            'dependency' => array(
              'h5ap_player_type|standard_skin',
              '==|==',
              'opt-1|default',
              'all'
            )
          ),

          array(
            'id' => 'seektime',
            'type' => 'number',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Seek time',
            'unit' => 'sec',
            'output' => '.heading',
            'output_mode' => 'width',
            'default' => 500,
            'default' => 10,
            'dependency' => array(
              'h5ap_player_type',
              '==',
              'opt-1',
              'all'
            ),
            'help' => 'The time, in seconds, to seek when a user hits fast forward or rewind. Deafult value is 10 Sec',
            'desc' => 'The time, in seconds, to seek when a user hits fast forward or rewind. Deafult value is 10 Sec'
          ),
          array(
            'id' => 'preload',
            'type' => 'radio',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Preload',
            'options' => array(
              'auto' => 'Auto - Browser should load the entire audio file when the page loads.',
              'metadata' => 'Metadata - Browser should load only metadata when the page loads.',
              'none' => 'None - Browser should NOT load the audio file when the page loads.',
            ),
            'default' => 'auto',
            'dependency' => array('h5ap_player_type', '==', 'opt-1')
          ),

          array(
            'id' => 'radius',
            'type' => 'slider',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Border radius',
            'desc' => 'Defines the radius of the Player\'s corners.',
            'min' => 0,
            'max' => 50,
            'step' => 1,
            'unit' => 'px',
            'default' => 10,
            'dependency' => array('h5ap_player_type', '==', 'opt-1')
          ),
          array(
            'id' => 'plp_align',
            'type' => 'button_set',
            'class' => 'bplugins-meta-readonly',
            'title' => 'Player Aligment',
            'options' => [
              'start' => 'Left',
              'center' => 'Center',
              'end' => 'Right'
            ],
            'default' => 'center'
          ),
        )
      )
    );

    \CSF::createSection('_h5ap_plyr_skins', array(
      'title' => \__(' ', 'h5ap'),
      'post_type' => 'audioplayer',
      'context' => 'side',
      'fields' => array(
        array(
          'id' => 'standard_skin',
          'type' => 'content',
          'content' => '
          <div class="h5ap-skin-box">
          <style>.h5ap-skin-box {text-align:center;} img{max-width:100%;} h3 {margin-bottom:5px;text-align:center;}</style>
            <h3>Default</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/default.png" alt="Standard">
            <h3>Fusion</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/fusion.png" alt="Standard">
            <h3>Stamp</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/stamp.png" alt="Standard">
            <h3>Wave</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/wave.png" alt="Standard">
            <h3>Card 1</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/card-1.png" alt="Standard">
            <h3>Card 2</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/card-2.png" alt="Standard">
            <h3>Simple 1</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/simple-1.png" alt="Standard">
            <h3>Simple 2</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/simple-2.png" alt="Standard">
            <h3>Player 9</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/player-9.png" alt="Standard">
            <h3>Player 10</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/player-10.png" alt="Standard">
            <h3>Player 11</h3>
            <img src="' . H5AP_PRO_PLUGIN_DIR . 'assets/images/skins/player-11.png" alt="Standard">
          </div>  
          ',
        )
      )
    ));
  }
}
