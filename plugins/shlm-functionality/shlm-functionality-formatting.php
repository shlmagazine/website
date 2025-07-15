<?php
// Replace many ellipses variants with CMOS-compliant version
function cmos_ellipsis_everywhere($text) {
    // Match:
    // - "..." (not part of "....")
    // - "…"
    // - any variant with spaces (e.g., ". . .", " . . . ", etc.)
    return preg_replace('/(?<!\.)\.{3}(?!\.)|…|\s?\.\s\.\s\.\s?/u', '&nbsp;.&nbsp;.&nbsp;.', $text);
}

add_filter('the_content', 'cmos_ellipsis_everywhere', 12);
add_filter('the_excerpt', 'cmos_ellipsis_everywhere', 12);
add_filter('comment_text', 'cmos_ellipsis_everywhere', 12);
add_filter('widget_text', 'cmos_ellipsis_everywhere', 12);

// function spaced_ellipsis_wptexturize($replacements) {
//     // Replace the default ellipsis (…) with spaced version
//     $replacements['…'] = '&nbsp;.&nbsp;.&nbsp;.`';
//     $replacements['...'] = '&nbsp;.&nbsp;.&nbsp;.`';
//     $replacements[' . . .'] = '&nbsp;.&nbsp;.&nbsp;.`';

//     return $replacements;
// }
// add_filter('wptexturize_custom_replacements', 'spaced_ellipsis_wptexturize');