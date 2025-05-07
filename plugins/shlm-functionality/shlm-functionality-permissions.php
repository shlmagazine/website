<?php
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

// To edit TNP roles, go to Newsletter > Settings > Advanced Settings > Allowed roles