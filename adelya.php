<?php
/*
* Plugin Name: Web2Store from Adelya
* Plugin URI: http://www.adelya.com
* Description: Integration Web2Store
* Author: Adelya Loyalty Operator
* Version: 1.0
* License: license GNU General Public License v2
*/


// Security
if(!defined('ABSPATH')){
	exit;
}


// Call CSS file
function w2s_custom_css(){
	wp_register_style('style', plugins_url('css/style.css', __FILE__));
	wp_enqueue_style('style');
}

add_action('admin_enqueue_scripts', 'w2s_custom_css');


// Create Newsletter
require_once('newsletterWidget.php'); // Call processing page
add_filter('widget_text', 'do_shortcode'); // Include shortcode in Widget
add_action( 'widgets_init', 'register_adelya_widget' ); // Function widget start

// Create Shortcode
require_once('shortcode.php'); // Call processing page
add_shortcode('adelya', 'w2s_shortcodeAdelya'); // Function shortcode start


// Link behavior
function w2s_display_menu(){
	if(function_exists('add_options_page')){
		$plugin_page_options = add_options_page('AdelyaAdmin', 'Adelya', 'administrator', 'adminAdelya', 'w2s_optionAdelya');
	}
}

//Add link to menu
add_action('admin_menu', 'w2s_display_menu');


// Create plugin option
function w2s_optionAdelya(){
	if(!current_user_can('administrator')){
		wp_die(_( $json_lang->permission ));
	}


// Calling up useful files
	echo '<div class="wrap">';
	 	include('form.php'); // Insertion of the page "Form"
		include('shortcode_list.php'); // Insertion of the page "Shortcode List"
		include('newsletter.php'); // Insertion of the page "Newsletter"
	 	include('resize.php'); // Insertion of the page "param"
		include('translate.php');
	 echo '</div>';
}
?>