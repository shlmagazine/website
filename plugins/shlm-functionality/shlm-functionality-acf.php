<?php
add_action( 'acf/init', 'set_acf_settings' );
function set_acf_settings() {
    acf_update_setting( 'enable_shortcode', true );
}

// Manually move Featured Audio plugin
// Do this after learning more about WordPress development and PHP templating
// add_theme_support( 'featured-audio' );