<?php
// Replace many ellipses variants with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback(
        // Match line-start (start of string, <br>, or \n)
        // Then match: "....", "…", "...", ". . ."
        '/(^|\n|<br\s*\/?>)?\s*(\.{4}|\.{3}|…|\.\s\.\s\.)(?!\.)/',
        function ($matches) {
            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $trailing_dot = '';
            
            // If matched "....", add an extra literal period
            if (isset($matches[2]) && $matches[2] === '....') {
                $trailing_dot = '.';
            }
            if (isset($matches[3]) && $matches[3] === '....') {
                $trailing_dot = '.';
            }

            if (!empty($matches[2])) {
                // Line-start version (no leading nbsp)
                return $base_ellipsis . $trailing_dot . '&nbsp;';
            } elseif (!empty($matches[3])) {
                // Mid-line version (leading nbsp)
                return '&nbsp;' . $base_ellipsis . $trailing_dot;
            } else {
                return $matches[0]; // fallback
            }
        },
        $text
    );
}
add_filter('the_title', 'cmos_ellipses_everywhere', 12);
add_filter('wp_title', 'cmos_ellipses_everywhere', 12);
add_filter('pre_get_document_title', 'cmos_ellipses_everywhere', 12);
add_filter('the_content', 'cmos_ellipses_everywhere', 12);

// function replace_ellipsis_after_texturize($text) {
//     return str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
// }
// add_filter('the_content', 'replace_ellipsis_after_texturize', 20);