<?php
// https://wordpress.stackexchange.com/questions/314175/how-can-i-change-the-title-of-an-add-new-page-in-admin-for-custom-post-type

/*
function register_poetry_post_type() {
    register_post_type('poetry',
        array(
            'labels'      => array(
                'name'               => _x('Poetry', 'post type general name'),
                'add_new'            => __('Add New Poetry'),
                'add_new_item'       => __('Add New Poetry'),
                'edit_item'          => __('Edit Poetry'),
                'new_item'           => __('New Poetry'),
                'view_item'          => __('View Poetry'),
                'search_items'       => __('Search Poetry'),
                'not_found'          => __('No poetry found.'),
                'not_found_in_trash' => __('No poetry found in Trash.'),
            ),
                'public'             => true, // Whether it's publicly accessible
                'has_archive'        => true, // Enable archive pages for the CPT
                'publicly_queryable' => true, // Can query publicly
                'show_in_menu'       => true, // Show in admin menu
                'show_in_rest'       => true, // For Gutenberg editor
                'supports'           => array('title', 'editor', 'revisions', 'author', 'thumbnail', 'excerpt', 'comments'),  // Enable standard fields
                // 'menu_position'      => 5,     // Position in the admin menu
                'menu_icon'          => 'dashicons-format-quote',  // Set a custom dashicon
                // 'rewrite'            => array( 'slug' => 'books' ), // Custom slug in URLs
                'capability_type'    => 'post', // Use post-like capabilities
                'taxonomies'         => false, // Disable 'category' taxonomy
        )
    );
}
add_action('init', 'register_poetry_post_type');

function register_prose_post_type() {
    register_post_type('prose',
        array(
            'labels'      => array(
                'name'               => _x('Prose', 'post type general name'),
                'add_new'            => __('Add New Prose'),
                'add_new_item'       => __('Add New Prose'),
                'edit_item'          => __('Edit Prose'),
                'new_item'           => __('New Prose'),
                'view_item'          => __('View Prose'),
                'search_items'       => __('Search Prose'),
                'not_found'          => __('No prose found.'),
                'not_found_in_trash' => __('No prose found in Trash.'),
            ),
                'public'             => true, // Whether it's publicly accessible
                'has_archive'        => true, // Enable archive pages for the CPT
                'publicly_queryable' => true, // Can query publicly
                'show_in_menu'       => true, // Show in admin menu
                'show_in_rest'       => true, // For Gutenberg editor
                'supports'           => array('title', 'editor', 'revisions', 'author', 'thumbnail', 'excerpt', 'comments'),  // Enable standard fields
                // 'menu_position'      => 5,     // Position in the admin menu
                'menu_icon'          => 'dashicons-text',  // Set a custom dashicon
                // 'rewrite'            => array( 'slug' => 'books' ), // Custom slug in URLs
                'capability_type'    => 'post', // Use post-like capabilities
                'taxonomies'         => false, // Disable 'category' taxonomy
        )
    );
}
add_action('init', 'register_prose_post_type');
*/

add_filter( 'featured_audio_post_types', 'prefix_featured_audio_post_types' );
function prefix_featured_audio_post_types( $post_types ) {
    // Add support to the sheet_music post type.
    // $post_types[] = 'sheet_music';

    // Overwrite the entire list to remove support on pages.
    $post_types = array( 'post', 'story', 'review' );

    return $post_types;
}