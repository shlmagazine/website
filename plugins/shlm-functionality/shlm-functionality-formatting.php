<?php
// Replace ellipsis characters with CMOS-compliant version
function cmos_ellipses_everywhere($text) {
    return preg_replace_callback('/
            # Ellipsis is the only character on a line, except quote marks
            (?<alone_with_quotes>
                (?<=“)
                \ *…\ *
                (?=”)
            )

            # Ellipsis is the only character on a line
            |(?<alone_on_line>
                ^(?<alone_on_line_start_tag><.+>)
                \ *…\ *
                (?=<\/.+>$)
            )

            # Ellipsis begins a line
            |(?<start_of_line>
                (?<start_of_line_start_tag><.+?>)
                \ *…\ *
            )

            # Ellipsis begin a quote
            |(?<start_of_quote>
                (?<=“)
                \ *…\ *
            )

            # Ellipsis is followed by a punctuation mark
            |(?<punctuation>
                \ *…\ *
                (?=[.,:;?!])
            )

            # Ellipsis ends a line
            |(?<end_of_line>
                \ *…\ *
                (?=<\/.+>$)
            )

            # Ellipsis ends a quote
            |(?<end_of_quote>
                \ *…\ *
                (?=”)
            )

            # All other ellipsis cases
            |(?<general>
                \ *…\ *
            )
        /mx',
        function ($matches) {
            $base_ellipsis = '.&nbsp;.&nbsp;.';
            $nbsp = '&nbsp;';

            return match (true) {
                !empty($matches['alone_with_quotes'])
                    => $base_ellipsis,
                !empty($matches['alone_on_line'])
                    => $matches['alone_on_line_start_tag'] . $base_ellipsis,
                !empty($matches['start_of_line'])
                    => $matches['start_of_line_start_tag'] . $base_ellipsis . $nbsp,
                !empty($matches['start_of_quote'])
                    => $base_ellipsis . $nbsp,
                !empty($matches['punctuation'])
                    => $nbsp . $base_ellipsis . $nbsp,
                !empty($matches['end_of_line'])
                    => $nbsp . $base_ellipsis,
                !empty($matches['end_of_quote'])
                    => $nbsp . $base_ellipsis,
                !empty($matches['general'])
                    => $nbsp . $base_ellipsis . ' ',
                default
                    => $matches[0], // fallback
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