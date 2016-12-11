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
		wpcf7_remove_form_tag('submit');
		remove_action( 'wpcf7_init', 'wpcf7_add_tag_generator_submit', 55 );
		require_once 'submit.php';
	}
}
add_action('after_setup_theme','dnp_cf7_submit');

// replace cf7 quiz
function dnp_cf7_quiz() {
	if(function_exists('wpcf7_remove_form_tag')) {
		wpcf7_remove_form_tag('quiz');
		remove_action( 'wpcf7_init', 'wpcf7_add_tag_generator_quiz', 55 ); 
		require_once 'quiz.php';
	}
}
add_action('after_setup_theme','dnp_cf7_quiz');
