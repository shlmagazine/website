<?php
// Replace many ellipses variants with CMOS-compliant version
function cmos_ellipsis_everywhere($text) {
    // Match:
    // - "..." (not part of "....")
    // - "…"
    // - any variant with spaces (e.g., ". . .", " . . . ", etc.)
    return preg_replace('/(?<!\.)\.{3}(?!\.)|…|...|\s?\.\s\.\s\.\s?/u', '&nbsp;.&nbsp;.&nbsp;.', $text);
}

add_filter('the_content', 'cmos_ellipsis_everywhere', 12);
add_filter('the_excerpt', 'cmos_ellipsis_everywhere', 12);
add_filter('comment_text', 'cmos_ellipsis_everywhere', 12);
add_filter('widget_text', 'cmos_ellipsis_everywhere', 12);

// Replace three-dot ellipsis variant
// function replace_all_ellipses($text) {
//     $text = str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
//     return $text;
// }
// add_filter('the_content', 'replace_all_ellipses', 12);
// add_filter('the_excerpt', 'replace_all_ellipses', 12);
// add_filter('comment_text', 'replace_all_ellipses', 12);
// add_filter('widget_text', 'replace_all_ellipses', 12);