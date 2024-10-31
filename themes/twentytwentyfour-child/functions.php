<?php
// Link child theme to parent
add_action( 'wp_enqueue_scripts', 'twentytwentyfourchild_enqueue_styles' );
function twentytwentyfourchild_enqueue_styles() {
	wp_enqueue_style( 
		'twentytwentyfour-child-style', 
		get_stylesheet_uri()
	);
}