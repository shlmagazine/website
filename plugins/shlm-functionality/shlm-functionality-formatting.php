<?php
// Replace ellipsis characters with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback(
        '/(^“ *… *”$)              # Group 1: full quoted line
        | (^ *… *$)                # Group 2: ellipsis alone on line
        | (^ *… *(.))              # Group 3, 4: starts line
        | (^\W *… *(.))            # Group 5, 6: quote + starts line
        | ( *… *([^a-zA-Z0-9”\s])) # Group 7, 8: ellipsis + punctuation
        | ( *…)                    # Group 9: all other ellipsis
        /mx',
        function ($matches) {
            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $nbsp = '&nbsp;';

            return match (true) {
                isset($matches[1]) => '“' . $base_ellipsis . '”' . ' g1',
                isset($matches[2]) => $base_ellipsis . ' g2',
                isset($matches[3]) => $base_ellipsis . $nbsp . $matches[4] . ' g3',
                isset($matches[5]) => '“' . $base_ellipsis . $nbsp . $matches[6] . ' g4',
                isset($matches[7]) => $nbsp . $base_ellipsis . $nbsp . $matches[8] . ' g7',
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