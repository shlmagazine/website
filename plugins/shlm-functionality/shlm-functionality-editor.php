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
function remove_parent_theme_block_patterns() {
    unregister_block_pattern( 'twentytwentyfour/banner-hero' );
    unregister_block_pattern( 'twentytwentyfour/banner-project-description' );
    unregister_block_pattern( 'twentytwentyfour/cta-content-image-on-right' );
    unregister_block_pattern( 'twentytwentyfour/cta-pricing' );
    unregister_block_pattern( 'twentytwentyfour/cta-rsvp' );
    unregister_block_pattern( 'twentytwentyfour/cta-services-image-left' );
    unregister_block_pattern( 'twentytwentyfour/cta-subscribe-centered' );
    unregister_block_pattern( 'twentytwentyfour/footer-centered-logo-nav' );
    unregister_block_pattern( 'twentytwentyfour/footer-colophon-3-col' );
    unregister_block_pattern( 'twentytwentyfour/footer' );
    unregister_block_pattern( 'twentytwentyfour/gallery-full-screen-image' );
    unregister_block_pattern( 'twentytwentyfour/gallery-offset-images-grid-2-col' );
    unregister_block_pattern( 'twentytwentyfour/gallery-offset-images-grid-3-col' );
    unregister_block_pattern( 'twentytwentyfour/gallery-offset-images-grid-4-col' );
    unregister_block_pattern( 'twentytwentyfour/gallery-project-layout' );
    unregister_block_pattern( 'twentytwentyfour/hidden-404' );
    unregister_block_pattern( 'twentytwentyfour/hidden-comments' );
    unregister_block_pattern( 'twentytwentyfour/hidden-no-results' );
    unregister_block_pattern( 'twentytwentyfour/hidden-portfolio-hero' );
    unregister_block_pattern( 'twentytwentyfour/hidden-post-meta' );
    unregister_block_pattern( 'twentytwentyfour/hidden-post-navigation' );
    unregister_block_pattern( 'twentytwentyfour/hidden-posts-heading' );
    unregister_block_pattern( 'twentytwentyfour/hidden-search' );
    unregister_block_pattern( 'twentytwentyfour/hidden-sidebar' );
    unregister_block_pattern( 'twentytwentyfour/page-about-business' );
    unregister_block_pattern( 'twentytwentyfour/page-home-blogging' );
    unregister_block_pattern( 'twentytwentyfour/page-home-business' );
    unregister_block_pattern( 'twentytwentyfour/page-home-portfolio-gallery' );
    unregister_block_pattern( 'twentytwentyfour/page-home-portfolio' );
    unregister_block_pattern( 'twentytwentyfour/page-newsletter-landing' );
    unregister_block_pattern( 'twentytwentyfour/page-portfolio-overview' );
    unregister_block_pattern( 'twentytwentyfour/page-rsvp-landing' );
    unregister_block_pattern( 'twentytwentyfour/posts-1-col' );
    unregister_block_pattern( 'twentytwentyfour/posts-3-col' );
    unregister_block_pattern( 'twentytwentyfour/posts-grid-2-col' );
    unregister_block_pattern( 'twentytwentyfour/posts-images-only-3-col' );
    unregister_block_pattern( 'twentytwentyfour/posts-images-only-offset-4-col' );
    unregister_block_pattern( 'twentytwentyfour/posts-list' );
    unregister_block_pattern( 'twentytwentyfour/team-4-col' );
    unregister_block_pattern( 'twentytwentyfour/template-archive-blogging' );
    unregister_block_pattern( 'twentytwentyfour/template-archive-portfolio' );
    unregister_block_pattern( 'twentytwentyfour/template-home-blogging' );
    unregister_block_pattern( 'twentytwentyfour/template-home-business' );
    unregister_block_pattern( 'twentytwentyfour/template-home-portfolio' );
    unregister_block_pattern( 'twentytwentyfour/template-index-blogging' );
    unregister_block_pattern( 'twentytwentyfour/template-index-portfolio' );
    unregister_block_pattern( 'twentytwentyfour/template-search-blogging' );
    unregister_block_pattern( 'twentytwentyfour/template-search-portfolio' );
    unregister_block_pattern( 'twentytwentyfour/template-single-portfolio' );
    unregister_block_pattern( 'twentytwentyfour/testimonial-centered' );
    unregister_block_pattern( 'twentytwentyfour/text-alternating-images' );
    unregister_block_pattern( 'twentytwentyfour/text-centered-statement-small' );
    unregister_block_pattern( 'twentytwentyfour/text-centered-statement' );
    unregister_block_pattern( 'twentytwentyfour/text-faq' );
    unregister_block_pattern( 'twentytwentyfour/text-feature-grid-3-col' );
    unregister_block_pattern( 'twentytwentyfour/text-project-details' );
    unregister_block_pattern( 'twentytwentyfour/text-title-left-image-right' );
}
add_action( 'init', 'remove_parent_theme_block_patterns', 20 );