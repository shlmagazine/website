<?php
// Replace ellipsis characters with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback(
        // Group 1: Ellipsis is the only character on a line, except quote marks
        // Group 2: Ellipsis is the only character on a line
        // Group 3: Ellipsis begins a line
        // Group 4: Group 3's following character
        // Group 5: An opening quote mark and an ellipsis begin a line
        // Group 6: Group 5's following character
        // Group 7: Ellipsis is followed by a punctuation mark
        // Group 8: Group 7's punctuation mark
        // Group 9: All other ellipsis cases
        '/(“ *… *”)|((<.*>) *… *(<\/.*>))|(^ *… *(.))|(^“ *… *(.))|( *… *([.,:;?!]))|( *…)/m',
        function ($matches) {
            // return '<pre>' . print_r($matches, true) . '</pre>';

            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $nbsp = '&nbsp;';

            // return match (true) {
            //     !empty($matches[1]) => $nbsp . $base_ellipsis . $nbsp . $matches[2] . ' g1',
            //     !empty($matches[3]) => '“' . $base_ellipsis . '”' . ' g3',
            //     !empty($matches[4]) => $base_ellipsis . ' g4',
            //     !empty($matches[5]) => $base_ellipsis . $nbsp . $matches[6] . ' g5',
            //     !empty($matches[7]) => '“' . $base_ellipsis . $nbsp . $matches[8] . ' g7',
            //     // !empty($matches[9]) => $base_ellipsis . ' g9',
            //     default => $matches[0] . ' g0', // fallback
            // };
            switch (true) {
                case !empty($matches[1]):
                    return '“' . $base_ellipsis . '”' . ' g1';
                case !empty($matches[2]):
                    return $matches[3] . $base_ellipsis . $matches[4] . ' g2';
                // case !empty($matches[3]):
                //     return $base_ellipsis . $nbsp . $matches[4] . ' g3';
                // case !empty($matches[5]):
                //     return '“' . $base_ellipsis . $nbsp . $matches[6] . ' g5';
                // case !empty($matches[7]):
                //     return $nbsp . $base_ellipsis . $nbsp . $matches[8] . ' g7';
                // case !empty($matches[9]):
                //     return $base_ellipsis . ' g9';
                default:
                    return $matches[0] . ' g0'; // fallback
            };
        },
        $text
    );
}
function cmos_ellipses_conditionally() {
    if (is_page('brand')) {
        add_filter('the_content', 'cmos_ellipses_everywhere');
    }
}
add_action('template_redirect', 'cmos_ellipses_conditionally');

// function replace_ellipsis_after_texturize($text) {
//     return str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
// }
// add_filter('the_content', 'replace_ellipsis_after_texturize', 20);