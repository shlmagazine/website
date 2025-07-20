<?php
// Replace many ellipses variants with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    $base_ellipsis = '.&nbsp;.&nbsp;.';

    // Pass 1: Ellipses at line-start or alone on line
    $text = preg_replace_callback(
        '/(^|\n|<br\s*\/?>)\s*(["“”‘’\'"]?)\s*(\.{3,4}|…|\.\s\.\s\.)(?!\.)\s*(["“”‘’\'"]?)(?=$|\n|<br\s*\/?>)/',
        function ($matches) use ($base_ellipsis) {
            $line_start     = $matches[1]; // newline or <br>
            $open_quote     = $matches[2] ?? '';
            $ellipsis_token = trim($matches[3]);
            $close_quote    = $matches[4] ?? '';
            $trailing_dot   = ($ellipsis_token === '....') ? '.' : '';

            return $line_start . $open_quote . $base_ellipsis . $trailing_dot . $close_quote;
        },
        $text
    );

    // Pass 2: Inline ellipses — ensure leading &nbsp;
    $text = preg_replace_callback(
        '/(?<![\.\n\r>])(\.{3,4}|…|\.\s\.\s\.)(?!\.)/',
        function ($matches) use ($base_ellipsis) {
            $ellipsis_token = trim($matches[1]);
            $trailing_dot = ($ellipsis_token === '....') ? '.' : '';
            return '&nbsp;' . $base_ellipsis . $trailing_dot;
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