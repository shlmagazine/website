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
    unregister_block_pattern( 'banner-hero.php' );
    unregister_block_pattern( 'banner-project-description.php' );
    unregister_block_pattern( 'cta-content-image-on-right.php' );
    unregister_block_pattern( 'cta-pricing.php' );
    unregister_block_pattern( 'cta-rsvp.php' );
    unregister_block_pattern( 'cta-services-image-left.php' );
    unregister_block_pattern( 'cta-subscribe-centered.php' );
    unregister_block_pattern( 'footer-centered-logo-nav.php' );
    unregister_block_pattern( 'footer-colophon-3-col.php' );
    unregister_block_pattern( 'footer.php' );
    unregister_block_pattern( 'gallery-full-screen-image.php' );
    unregister_block_pattern( 'gallery-offset-images-grid-2-col.php' );
    unregister_block_pattern( 'gallery-offset-images-grid-3-col.php' );
    unregister_block_pattern( 'gallery-offset-images-grid-4-col.php' );
    unregister_block_pattern( 'gallery-project-layout.php' );
    unregister_block_pattern( 'hidden-404.php' );
    unregister_block_pattern( 'hidden-comments.php' );
    unregister_block_pattern( 'hidden-no-results.php' );
    unregister_block_pattern( 'hidden-portfolio-hero.php' );
    unregister_block_pattern( 'hidden-post-meta.php' );
    unregister_block_pattern( 'hidden-post-navigation.php' );
    unregister_block_pattern( 'hidden-posts-heading.php' );
    unregister_block_pattern( 'hidden-search.php' );
    unregister_block_pattern( 'hidden-sidebar.php' );
    unregister_block_pattern( 'page-about-business.php' );
    unregister_block_pattern( 'page-home-blogging.php' );
    unregister_block_pattern( 'page-home-business.php' );
    unregister_block_pattern( 'page-home-portfolio-gallery.php' );
    unregister_block_pattern( 'page-home-portfolio.php' );
    unregister_block_pattern( 'page-newsletter-landing.php' );
    unregister_block_pattern( 'page-portfolio-overview.php' );
    unregister_block_pattern( 'page-rsvp-landing.php' );
    unregister_block_pattern( 'posts-1-col.php' );
    unregister_block_pattern( 'posts-3-col.php' );
    unregister_block_pattern( 'posts-grid-2-col.php' );
    unregister_block_pattern( 'posts-images-only-3-col.php' );
    unregister_block_pattern( 'posts-images-only-offset-4-col.php' );
    unregister_block_pattern( 'posts-list.php' );
    unregister_block_pattern( 'team-4-col.php' );
    unregister_block_pattern( 'template-archive-blogging.php' );
    unregister_block_pattern( 'template-archive-portfolio.php' );
    unregister_block_pattern( 'template-home-blogging.php' );
    unregister_block_pattern( 'template-home-business.php' );
    unregister_block_pattern( 'template-home-portfolio.php' );
    unregister_block_pattern( 'template-index-blogging.php' );
    unregister_block_pattern( 'template-index-portfolio.php' );
    unregister_block_pattern( 'template-search-blogging.php' );
    unregister_block_pattern( 'template-search-portfolio.php' );
    unregister_block_pattern( 'template-single-portfolio.php' );
    unregister_block_pattern( 'testimonial-centered.php' );
    unregister_block_pattern( 'text-alternating-images.php' );
    unregister_block_pattern( 'text-centered-statement-small.php' );
    unregister_block_pattern( 'text-centered-statement.php' );
    unregister_block_pattern( 'text-faq.php' );
    unregister_block_pattern( 'text-feature-grid-3-col.php' );
    unregister_block_pattern( 'text-project-details.php' );
    unregister_block_pattern( 'text-title-left-image-right.php' );
}
add_action( 'init', 'remove_parent_theme_block_patterns', 20 );