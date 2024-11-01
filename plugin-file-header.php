<?php
/*
Plugin Name:   User Quick Tags
Plugin URI:    https://kierantaylor.io/user-quick-tags/
Description:   Adds the ability to replace tags with logged in users information
Version:       1.0
Text Domain:   uiqt-core
Author:        Kieran Taylor
Author URI:    https://kierantaylor.io
*/


// Exit if accessed directly

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

// Start building user quick tags

function uiqt_replace_tags($text) {
    
    // Get current user
    
    $current_user = wp_get_current_user();
    
    // Text to replace with user information
    
	$text = str_replace('{username}', $current_user->user_login, $text);
    $text = str_replace('{email}', $current_user->user_email, $text);
    $text = str_replace('{firstname}', $current_user->user_firstname, $text);
    $text = str_replace('{lastname}', $current_user->user_lastname, $text);
    $text = str_replace('{displayname}', $current_user->display_name, $text);
    $text = str_replace('{userid}', $current_user->ID, $text);
	return $text;
}

// Enable within the content

add_filter('the_content', 'uiqt_replace_tags');

// Enable within the menu

add_filter('walker_nav_menu_start_el', 'uiqt_replace_tags');

?>