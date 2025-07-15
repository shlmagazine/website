<?php
// Shortcode for adding a CMOS-compliant ellipsis, featuring nonbreaking spaces
function cmos_ellipsis_shortcode() {
    return '&nbsp;.&nbsp;.&nbsp;.';
}
add_shortcode( 'cmos_ellipsis', 'cmos_ellipsis_shortcode' );

// Enable shortcode parsing in Custom HTML blocks, for social media links in author bio boxes
function parse_shortcodes_in_custom_html_blocks($block_content, $block) {
    // Check if this is a Custom HTML block (core/html block)
    if ($block['blockName'] === 'core/html') {
        // Apply do_shortcode to the content inside the block
        $block_content = do_shortcode($block_content);
    }
    return $block_content;
}

// Hook into the block rendering process
add_filter('render_block', 'parse_shortcodes_in_custom_html_blocks', 10, 2);

// Explanation from ChatGPT
/*
render_block: This filter allows you to manipulate the content of a block before it gets rendered.
$block['blockName'] === 'core/html': This checks if the block is a Custom HTML block.
do_shortcode($block_content): This ensures that shortcodes within the Custom HTML block get processed and output the correct content (e.g., replacing [linkedin_link] with the actual URL).
*/