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
            
            # Ellipsis begin a quote
            |(?<start_of_quote>
                “\ *…\ *(?<start_of_quote_character>.)
            )
            
            # Ellipsis is followed by a punctuation mark
            |
            (?<punctuation>
                \ *…\ *(?<punctuation_mark>[.,:;?!])
            )
            
            # All other ellipsis cases
            |
            (?<general>
                \ *…\ *
            )
        /mx',
        function ($matches) {
            // return '<pre>' . print_r($matches, true) . '</pre>';

            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $nbsp = '&nbsp;';

            // Todo: Add case for trailing ellipses
            // Todo: Add case for trailing ellipses with end quotes

            return match (true) {
                !empty($matches['alone_with_quotes']) => '“' . $base_ellipsis . '”',
                !empty($matches['alone_on_line']) => $matches['alone_on_line_start_tag'] . $base_ellipsis . $matches['alone_on_line_end_tag'],
                !empty($matches['start_of_line']) => $matches['start_of_line_start_tag'] . $base_ellipsis . $nbsp . $matches['start_of_line_character'],
                !empty($matches['start_of_quote']) => '“' . $base_ellipsis . $nbsp . $matches['start_of_quote_character'],
                !empty($matches['punctuation']) => $nbsp . $base_ellipsis . $nbsp . $matches['punctuation_mark'],
                !empty($matches['general']) => $nbsp . $base_ellipsis . ' ',
                default => $matches[0], // fallback
            };
        },
        $text
    );
}
function cmos_ellipses_conditionally() {
    if (is_page('test-ellipses')) {
        add_filter('the_content', 'cmos_ellipses_everywhere');
    }
}
add_action('template_redirect', 'cmos_ellipses_conditionally');

// function replace_ellipsis_after_texturize($text) {
//     return str_replace('…', '&nbsp;.&nbsp;.&nbsp;.', $text);
// }
// add_filter('the_content', 'replace_ellipsis_after_texturize', 20);