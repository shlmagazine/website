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

// Disable default core patterns
function theme_support() {
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'theme_support', 11 );

// Disable default theme patterns
function remove_parent_theme_patterns() {
    $registry = WP_Block_Patterns_Registry::get_instance();
    foreach ( $registry->get_all_registered() as $slug => $pattern ) {
        if ( str_starts_with( $slug, 'twentytwentyfour/' ) ) {
            unregister_block_pattern( $slug );
        }
    }
}
add_action( 'init', 'remove_parent_theme_patterns', 20 );