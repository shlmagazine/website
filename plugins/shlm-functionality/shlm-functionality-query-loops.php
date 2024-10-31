<?php
function filter_query_loop_by_author( $query ) {
    // Only modify the main query for author archives and not in the admin dashboard
    if ( ! is_admin() && $query->is_main_query() && $query->is_author() ) {
        // Get the current author ID
        $author_id = get_queried_object_id();
        
        // Modify the query to filter posts by the current author
        $query->set( 'author', $author_id );
    }
}
add_action( 'pre_get_posts', 'filter_query_loop_by_author' );