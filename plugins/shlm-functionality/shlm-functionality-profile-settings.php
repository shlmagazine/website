<?php
// Remove sections in profile settings
function remove_custom_fields($user) {
    ?>
    <style>
        /* Remove Rank Math stuff */
        tr:has(h2[style="margin: 0;"]),
        .user-twitter-wrap,
        .user-facebook-wrap,
        .user-additional_profile_urls-wrap,
        .rank-math-metabox-wrap {
            display: none;
        }
    </style>
    <?php
}
add_action('show_user_profile', 'remove_custom_fields');
add_action('edit_user_profile', 'remove_custom_fields');

// Add the social media fields to the user profile page
function add_social_media_fields($user) {
    ?>
    <h2>Social Media Links</h2>
    <table class="form-table">
        <tr>
            <th><label for="linkedin-link">LinkedIn</label></th>
            <td>
                <input type="text" name="linkedin-link" id="linkedin-link" value="<?php echo esc_attr( get_the_author_meta( 'linkedin_link', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="instagram-link">Instagram</label></th>
            <td>
                <input type="text" name="instagram-link" id="instagram-link" value="<?php echo esc_attr( get_the_author_meta( 'instagram_link', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="facebook-link">Facebook</label></th>
            <td>
                <input type="text" name="facebook-link" id="facebook-link" value="<?php echo esc_attr( get_the_author_meta( 'facebook_link', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="x-link">X / Twitter</label></th>
            <td>
                <input type="text" name="x-link" id="x-link" value="<?php echo esc_attr( get_the_author_meta( 'x_link', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="mastodon-link">Mastodon</label></th>
            <td>
                <input type="text" name="mastodon-link" id="mastodon-link" value="<?php echo esc_attr( get_the_author_meta( 'mastodon_link', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'show_user_profile', 'add_social_media_fields', -100 ); // Bring up as high as possible
add_action( 'edit_user_profile', 'add_social_media_fields', -100 ); // Bring up as high as possible

// Save the social media fields when the profile is updated
function save_social_media_fields($user_id) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    
    update_user_meta( $user_id, 'linkedin_link', $_POST['linkedin-link'] );
    update_user_meta( $user_id, 'instagram_link', $_POST['instagram-link'] );
    update_user_meta( $user_id, 'facebook_link', $_POST['facebook-link'] );
    update_user_meta( $user_id, 'x_link', $_POST['x-link'] );
    update_user_meta( $user_id, 'mastodon_link', $_POST['mastodon-link'] );
}

// Hook into the profile update actions
add_action( 'personal_options_update', 'save_social_media_fields' );
add_action( 'edit_user_profile_update', 'save_social_media_fields' );

// Add shortcodes to display social media links
function get_author_social_media_link($platform) {
    // https://stackoverflow.com/questions/67144437/how-to-access-author-meta-get-the-author-meta-in-wp-head
    // https://stackoverflow.com/questions/4893435/getting-the-wordpress-post-id-of-current-post
    $post_id = get_the_ID();
    $author_id = get_post_field('post_author', $post_id);
    if ($platform === 'website') {
        $link = get_the_author_meta('user_url', $author_id);
    }
    else {
        $link = get_user_meta($author_id, $platform . '_link', true);
    }
    return $link ? esc_url($link) : '#';
}

function register_social_media_shortcodes() {
    $platforms = array('linkedin', 'instagram', 'facebook', 'x', 'mastodon', 'website');
    foreach ($platforms as $platform) {
        add_shortcode($platform . '_link', function() use ($platform) {
            return get_author_social_media_link($platform);
        });
    }
}
add_action('init', 'register_social_media_shortcodes');

function plugin_note($user) {
    ?>
    <h2>Something off?</h2>
    <p>If you see something you don’t expect (or don’t see something you expect), let Yiu-On know. He’ll head to cPanel and check <code>shlm-functionality-profile-page.php</code> in the plugins folder.</p>
    <?php
}
add_action( 'show_user_profile', 'plugin_note' );
add_action( 'edit_user_profile', 'plugin_note' );