<?php
// Replace many ellipses variants with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback(
        // Match line-start context: start of string, \n, or <br>
        // Then optional whitespace and optional quotes
        // Then one of: ...., ..., …, or . . .
        // Then optional closing quote and whitespace
        // End of line or <br> ensures it's alone on line
        '/(^|\n|<br\s*\/?>)?\s*(["“”‘’\']?)\s*(\.{4}|\.{3}|…\s?|…|\.\s\.\s\.)\s*(["“”‘’\']?)\s*(?=$|\n|<br\s*\/?>)/u',
        function ($matches) {
            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $trailing_dot = '';
            $open_quote  = $matches[2] ?? '';
            $raw_ellipsis = trim($matches[3] ?? '');
            $close_quote = $matches[4] ?? '';

            // Handle "...."
            if ($raw_ellipsis === '....') {
                $trailing_dot = '.';
            }

            // Case: ellipsis is the only thing on the line (possibly wrapped in quotes)
            return $open_quote . $base_ellipsis . $trailing_dot . $close_quote;
        },
        $text
    );
}
add_filter('the_title', 'cmos_ellipses_everywhere', 12);
add_filter('the_content', 'cmos_ellipses_everywhere', 12);
add_filter('pre_get_document_title', 'cmos_ellipses_everywhere', 20);

// function replace_ellipsis_after_texturize($text) {
//     return str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
// }
// add_filter('the_content', 'replace_ellipsis_after_texturize', 20);