<?php
// Replace ellipsis characters with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback(
        // Group 1: Ellipsis is the only character on a line, wrapped in quotes
        // Group 2: Ellipsis is the only character on a line
        // Group 3: Ellipsis begins a line
        // Group 4: Group 3's following character
        // Group 5: An opening quote mark and an ellipsis begin a line
        // Group 6: Group 5's following character
        // Group 7: Ellipsis is followed by punctuation (except closing quote mark)
        // Group 8: Group 7's punctuation mark
        // Group 9: All other ellipsis cases
        '/(^“ *… *”$)              # Group 1
        | (^ *… *$)               # Group 2
        | (^ *… *(.))             # Group 3, 4
        | (^\W *… *(.))           # Group 5, 6
        | ( *… *([^a-zA-Z0-9”\s]))# Group 7, 8
        | ( *…)                   # Group 9
        /mx',
        function ($matches) {
            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $nbsp = '&nbsp;';

            return match (true) {
                isset($matches[1]) => '“' . $base_ellipsis . '”' . ' g1', // quoted line
                isset($matches[2]) => $base_ellipsis . ' g2',             // just ellipsis on a line
                isset($matches[3]) => $base_ellipsis . $nbsp . $matches[4] . ' g3', // line-start
                isset($matches[5]) => '“' . $base_ellipsis . $nbsp . $matches[6] . ' g5', // quote + start
                isset($matches[7]) => $nbsp . $base_ellipsis . $nbsp . $matches[8] . ' g7', // punctuation follows
                isset($matches[9]) => preg_replace('~…~', $base_ellipsis, $matches[9]) . ' g9', // fallback
                default => $matches[0] . ' g0', // shouldn’t happen
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