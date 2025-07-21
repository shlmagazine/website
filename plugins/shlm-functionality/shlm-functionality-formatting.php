<?php
// Replace ellipsis characters with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback(
        // Group 1: Ellipsis is followed by a punctuation mark (except a closing quote mark)
        // Group 2: Group 1's punctuation mark
        // Group 3: Ellipsis is the only character on a line, except quote marks
        // Group 4: Ellipsis is the only character on a line
        // Group 5: Ellipsis begins a line
        // Group 6: Group 5's following character
        // Group 7: An opening quote mark and an ellipsis begin a line
        // Group 8: Group 7's following character
        // Group 9: All other ellipsis cases
        '/( *… *([^a-zA-Z0-9”\s]))|(^“ *… *”$)|(^ *… *$)|(^ *… *(.))|(^\W *… *(.))|( *…)/',
        function ($matches) {
            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $nbsp = '&nbsp;';

            return match (true) {
                isset($matches[1]) => $nbsp . $base_ellipsis . $nbsp . $matches[2] . ' g1',
                isset($matches[3]) => '“' . $base_ellipsis . '”' . ' g3',
                isset($matches[4]) => $base_ellipsis . ' g4',
                isset($matches[5]) => $base_ellipsis . $nbsp . $matches[6] . ' g5',
                isset($matches[7]) => '“' . $base_ellipsis . $nbsp . $matches[8] . ' g7',
                isset($matches[9]) => $base_ellipsis . ' g9',
                default => $matches[0] . ' g0', // fallback
            };
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