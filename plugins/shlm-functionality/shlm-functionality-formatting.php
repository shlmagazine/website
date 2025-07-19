<?php
// Replace many ellipses variants with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback(
        // Match "..." or "…" or spaced ". . ." variants
        // Look for start-of-string, <br>, or \n as possible line starts
        '/(?:(?<=^)|(?<=<br\s*\/?>)|(?<=\n))(\s*)(\.{3}|…|\.\s\.\s\.)(?!\.)|(\.{3}|…|\.\s\.\s\.)(?!\.)/iu',
        function ($matches) {
            $ellipsis = '.&nbsp;.&nbsp;.';
            
            if (!empty($matches[2])) {
                // Line-start version (match[2] comes from lookbehind branch)
                return $ellipsis;
            } elseif (!empty($matches[3])) {
                // Mid-line version
                return '&nbsp;' . $ellipsis;
            } else {
                return $matches[0]; // shouldn't happen, fallback
            }
        },
        $text
    );
}
add_filter('the_content', 'cmos_ellipses_everywhere', 20);
add_filter('the_excerpt', 'cmos_ellipses_everywhere', 20);
add_filter('comment_text', 'cmos_ellipses_everywhere', 20);
add_filter('widget_text', 'cmos_ellipses_everywhere', 20);

// function replace_ellipsis_after_texturize($text) {
//     return str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
// }
// add_filter('the_content', 'replace_ellipsis_after_texturize', 20);
// add_filter('the_excerpt', 'replace_ellipsis_after_texturize', 20);
// add_filter('comment_text', 'replace_ellipsis_after_texturize', 20);
// add_filter('widget_text', 'replace_ellipsis_after_texturize', 20);