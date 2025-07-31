<?php
// Keep only h2 and h3
function restrict_heading_levels( $args, $block_type ) {

    if ( 'core/heading' !== $block_type ) {
        return $args;
    }

    $args['attributes']['levelOptions']['default'] = [ 2, 3 ];

    return $args;
}
add_filter( 'register_block_type_args', 'restrict_heading_levels', 10, 2 );

// Disable default pattern directory
function theme_support() {
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'theme_support', 11 );