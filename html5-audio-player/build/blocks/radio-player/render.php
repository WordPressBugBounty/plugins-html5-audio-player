<?php

extract($attributes);

$uniqueId = wp_unique_id('h5ap-player-');

?>
<div
    id="<?php echo esc_attr($uniqueId) ?>"
    data-id="<?php echo esc_attr($uniqueId) ?>"
    data-attributes="<?php echo esc_attr(wp_json_encode($attributes)) ?>"
    data-nonce="<?php echo esc_attr(wp_create_nonce('wp_rest')) ?>"
    <?php echo wp_kses(get_block_wrapper_attributes(), []); ?>>
    <?php if ($loader) {
    ?>
        <div class='h5ap_lp'>
            <div class='bar bar-1'></div>
            <div class='bar bar-1'></div>
        </div>
    <?php
    } ?>
</div>