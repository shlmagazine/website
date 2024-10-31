<?php
// Remove ShortPixel Critical CSS meta box (plugin deleted by WP, and additionally removes excerpt editing functionality)
/*
function cc_gutenberg_register_files() {
    // script file
    wp_register_script(
        'cc-block-script',
        get_stylesheet_directory_uri() .'/block-script.js', // adjust the path to the JS file
        array( 'wp-blocks', 'wp-edit-post' )
    );
    // register block editor script
    register_block_type( 'cc/ma-block-files', array(
        'editor_script' => 'cc-block-script'
    ) );

}
add_action( 'init', 'cc_gutenberg_register_files' );
*/

// Remove items from top admin menu bar (already done by Adminimize plugin)
/*
function remove_toolbar_items($wp_adminbar) {
  $wp_adminbar->remove_node('wp-logo');
  $wp_adminbar->remove_node('comments');
  $wp_adminbar->remove_node('rank-math');
  $wp_adminbar->remove_node('updraft_admin_node');
}
add_action('admin_bar_menu', 'remove_toolbar_items', 999);
*/