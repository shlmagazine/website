<?php
// Replace ellipsis characters with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback('/
            # Ellipsis is the only character on a line, except quote marks
            (?<alone_with_quotes>
                “\ *…\ *”
            )
            
            # Ellipsis is the only character on a line
            |(?<alone_on_line>
                ^(?<alone_on_line_start_tag><.*>)
                \ *…\ *
                (?<alone_on_line_end_tag><\/.*>)$
            )
            
            # Ellipsis begins a line
            |(?<start_of_line>
                ^(?<start_of_line_start_tag><.*>)
                \ *…\ *(?<start_of_line_character>.)
            )
            
            # An opening quote mark and an ellipsis begin a line
            |(?<start_of_quote>
                ^“\ *…\ *(.)
            )
            
            # Ellipsis is followed by a punctuation mark
            |
            (?<punctuation>
                \ *…\ *([.,:;?!])
            )
            
            # All other ellipsis cases
            |
            (?<general>
                \ *…
            )
        /mx',
        function ($matches) {
            // return '<pre>' . print_r($matches, true) . '</pre>';

            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $nbsp = '&nbsp;';

            return match (true) {
                !empty($matches['alone_with_quotes']) => '“' . $base_ellipsis . '”' . ' g1',
                !empty($matches['alone_on_line']) => $matches['alone_on_line_start_tag'] . $base_ellipsis . $matches['alone_on_line_end_tag'] . ' g2',
                !empty($matches['start_of_line']) => $matches['start_of_line_start_tag'] . $base_ellipsis . $nbsp . $matches['start_of_line_character'] . ' g3',
                // !empty($matches[5]) => '“' . $base_ellipsis . $nbsp . $matches[6] . ' g5',
                // !empty($matches[7]) => $nbsp . $base_ellipsis . $nbsp . $matches[8] . ' g7',
                // !empty($matches[9]) => $base_ellipsis . ' g9',
                default => $matches[0] . ' g0', // fallback
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