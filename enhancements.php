<?php 
/*
Plugin Name: Contact Form 7 Enhancements
Plugin URI: https://github.com/thednp/contact-form-7-enhancements
Description: A simple plugin to replace the submit &lt;input&gt; with &lt;button&gt; and add placeholder support for quizzes.
Author: thednp
Author URI: https://github.com/thednp
Text Domain: cf7e
Domain Path: /languages/
Version: 1.0.1
*/

//plugin language file
function dnp_cf7e_lang(){
	load_plugin_textdomain('cf7e', false, basename( dirname( __FILE__ ) ) . '/languages');
}
add_action('admin_head','dnp_cf7e_lang');		

// replace cf7 form submit with button
function dnp_cf7_submit() {
	if(function_exists('wpcf7_remove_form_tag')) {
		remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_submit' );
		require_once 'submit.php';
	}
}
add_action('after_setup_theme','dnp_cf7_submit');

// replace cf7 quiz
function dnp_cf7_quiz() {
	if(function_exists('wpcf7_remove_form_tag')) {
		remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_quiz' ); 
		require_once 'quiz.php';
	}
}
add_action('after_setup_theme','dnp_cf7_quiz');

// add the script
function dnp_enque_cf7e_script() {
	if(function_exists('wpcf7_remove_form_tag')) {
		wp_enqueue_script( 'cf7e', plugins_url('/assets/js/cf7e.js', __FILE__), false, null, true );
	}
}
add_action('wp_enqueue_scripts','dnp_enque_cf7e_script');
