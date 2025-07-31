<?php
// Unload Contact Form 7 and Conditional Fields from all pages
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );
add_filter( 'wpcf7cf_load_js', '__return_false' );
add_filter( 'wpcf7cf_load_css', '__return_false' );

// Load Contact Form 7 and Conditional Fields only on pages that need them
add_action('wp_enqueue_scripts', 'load_wpcf7_scripts');
function load_wpcf7_scripts() {
  if ( is_page('author-info') ) {
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
      wpcf7_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
      wpcf7_enqueue_styles();
    }
    if ( function_exists( 'wpcf7cf_enqueue_scripts' ) ) {
      wpcf7cf_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7cf_enqueue_styles' ) ) {
      wpcf7cf_enqueue_styles();
    }
  }
  if ( is_page('submit') ) {
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
      wpcf7_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
      wpcf7_enqueue_styles();
    }
    if ( function_exists( 'wpcf7cf_enqueue_scripts' ) ) {
      wpcf7cf_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7cf_enqueue_styles' ) ) {
      wpcf7cf_enqueue_styles();
    }
  }
  if ( is_page('pending-submit') ) {
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
      wpcf7_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
      wpcf7_enqueue_styles();
    }
    if ( function_exists( 'wpcf7cf_enqueue_scripts' ) ) {
      wpcf7cf_enqueue_scripts();
    }
    if ( function_exists( 'wpcf7cf_enqueue_styles' ) ) {
      wpcf7cf_enqueue_styles();
    }
  }
}

// Remap Contact Form 7 user roles so that they show up in the User Role Editor plugin
// https://www.role-editor.com/contact-form-7-plugin-menu-access/
add_filter('wpcf7_map_meta_cap', 'change_cf7_capabilities',10,1);

function change_cf7_capabilities($meta_caps) {
    
    $meta_caps = array(
        'wpcf7_edit_contact_form' => 'cf7_edit_forms',
    	'wpcf7_edit_contact_forms' => 'cf7_edit_forms',
    	'wpcf7_read_contact_forms' => 'cf7_read_forms',
    	'wpcf7_delete_contact_form' => 'cf7_delete_forms',
    	'wpcf7_manage_integration' => 'cf7_manage_integration' );

    return $meta_caps;

}