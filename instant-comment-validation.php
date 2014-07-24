<?php
/*
Plugin Name: Instant Comment Validation
Plugin URI: http://wordpress.org/plugins/instant-comment-validation/
Description: Add a instant validator for WordPress comment form, instead of sending users to default error page.
Author: Mrinal Kanti Roy
Version: 1.0.1
Author URI: http://profiles.wordpress.org/mkrdip/
License: GPLv2 or later
*/

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;
add_action('wp_footer', 'instant_comment_validation_init');	
function instant_comment_validation_init() {
	//load files only in single posts & if comments are open
	if(is_singular() && comments_open() ) { 	
	wp_enqueue_style( 'commentvalidation', WP_PLUGIN_URL . '/instant-comment-validation/assets/css/instant-comment-validation.css');
	wp_enqueue_script('jqueryvalidate', WP_PLUGIN_URL . '/instant-comment-validation/assets/js/jquery.validate.min.js', array('jquery'));
	wp_enqueue_script('commentvalidation', WP_PLUGIN_URL . '/instant-comment-validation/assets/js/instant-comment-validation.js', array('jquery','jqueryvalidate'));
	}
}

function my_wp_die_handler_function($function) {
    return 'my_skip_dupes_function'; //use our "die" handler instead (where we won't die)
}
//addition/patch by ujoseph to prevent 500 errors, 
add_filter( 'wp_die_handler', 'my_wp_die_handler_function', 9 ); //9 means you can unhook the default before it fires
//check to make sure we're only filtering out die requests for the "Duplicate" error we care about
function my_skip_dupes_function( $message, $title, $args ) {
    if (strpos( $message, 'Duplicate comment detected' ) === 0 ) { //make sure we only prevent death on the $dupe check
	remove_filter( 'wp_die_handler', '_default_wp_die_handler' ); //don't die
    }
    return; //nothing will happen
}

?>
