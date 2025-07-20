<?php
// Replace many ellipses variants with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    global $cmos_ellipses_text;
    $cmos_ellipses_text = $text; // Save for reference

    $base_ellipsis = '.&nbsp;.&nbsp;.';

    // Pass 1: Ellipses alone on a line, possibly in quotes
    $text = preg_replace_callback(
        '/(^|\n|<br\s*\/?>)?\s*(["“”‘’\']?)\s*(\.{4}|\.{3}|…|\.\s\.\s\.)\s*(["“”‘’\']?)\s*(?=$|\n|<br\s*\/?>)/',
        function ($matches) use ($base_ellipsis) {
            $trailing_dot = '';
            $ellipsis = trim($matches[3]);

            if ($ellipsis === '....') {
                $trailing_dot = '.';
            }

            $open_quote = $matches[2] ?? '';
            $close_quote = $matches[4] ?? '';

            return $open_quote . $base_ellipsis . $trailing_dot . $close_quote;
        },
        $text
    );

    // Pass 2: Inline ellipses (not alone on line)
    $text = preg_replace_callback(
        '/(?<!\.)\.{3}(?!\.)|…|\.\s\.\s\./',
        function ($m) use ($base_ellipsis) {
            // Check match offset using global reference
            $match = $m[0];
            $pos = strpos($GLOBALS['cmos_ellipses_text'], $match);

            if ($pos === 0 || preg_match('/(\n|<br\s*\/?>)\s*$/u', substr($GLOBALS['cmos_ellipses_text'], 0, $pos))) {
                return $base_ellipsis;
            } else {
                return '&nbsp;' . $base_ellipsis;
            }
        },
        $text
    );

    return $text;
}
add_filter('the_title', 'cmos_ellipses_everywhere', 12);
add_filter('the_content', 'cmos_ellipses_everywhere', 12);
add_filter('pre_get_document_title', 'cmos_ellipses_everywhere', 20);

// function replace_ellipsis_after_texturize($text) {
//     return str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
// }
// add_filter('the_content', 'replace_ellipsis_after_texturize', 20);