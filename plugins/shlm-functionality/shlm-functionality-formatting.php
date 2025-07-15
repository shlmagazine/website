<?php
// Replace many ellipses variants with CMOS-compliant version
function spaced_ellipsis_everywhere($text) {
    // Replace the ellipsis character after wptexturize has done its thing
    return str_replace('…', '.&nbsp;.&nbsp;.', $text);
}
add_filter('the_content', 'spaced_ellipsis_everywhere', 12);
add_filter('the_excerpt', 'spaced_ellipsis_everywhere', 12);
add_filter('comment_text', 'spaced_ellipsis_everywhere', 12);
add_filter('widget_text', 'spaced_ellipsis_everywhere', 12);

// function spaced_ellipsis_wptexturize($replacements) {
//     // Replace the default ellipsis (…) with spaced version
//     $replacements['…'] = '&nbsp;.&nbsp;.&nbsp;.`';
//     $replacements['...'] = '&nbsp;.&nbsp;.&nbsp;.`';
//     $replacements[' . . .'] = '&nbsp;.&nbsp;.&nbsp;.`';

//     return $replacements;
// }
// add_filter('wptexturize_custom_replacements', 'spaced_ellipsis_wptexturize');