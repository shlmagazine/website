<?php
function example_enqueue_block_variations() {
	wp_enqueue_script(
		'example-enqueue-block-variations',
		get_template_directory_uri() . '/assets/js/variations.js',
		array( 'wp-blocks', 'wp-dom-ready' ),
		wp_get_theme()->get( 'Version' ),
		false
	);
}
add_action( 'enqueue_block_editor_assets', 'example_enqueue_block_variations' );

function include_feature_image_caption($block_content, $block){
    if ( isset($block['attrs']['className']) && $block['attrs']['className'] === 'sotp-post-featured-image') {
        $caption = '<figcaption class="wp-element-caption">' . get_the_post_thumbnail_caption() . '</figcaption>';
        $block_content = str_replace('</figure>', $caption . '</figure>', $block_content);
    }
    return $block_content;
}
add_filter( 'render_block_core/post-featured-image', 'include_feature_image_caption', 10, 2 );