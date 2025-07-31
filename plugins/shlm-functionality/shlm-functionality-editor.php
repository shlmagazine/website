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

add_filter( 'should_load_remote_block_patterns', '__return_false' );