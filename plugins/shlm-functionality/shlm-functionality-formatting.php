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

function replace_ellipsis_after_texturize($text) {
    return str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
}
add_filter('the_content', 'replace_ellipsis_after_texturize', 20);