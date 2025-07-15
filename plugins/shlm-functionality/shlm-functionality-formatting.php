<?php
// Replace many ellipses variants with CMOS-compliant version
function spaced_ellipsis_wptexturize($replacements) {
    // Replace the default ellipsis (…) with spaced version
    $replacements['…'] = '&nbsp;.&nbsp;.&nbsp;.`';
    $replacements['...'] = '&nbsp;.&nbsp;.&nbsp;.`';
    $replacements[' . . .'] = '&nbsp;.&nbsp;.&nbsp;.`';

    return $replacements;
}
add_filter('wptexturize_custom_replacements', 'spaced_ellipsis_wptexturize');