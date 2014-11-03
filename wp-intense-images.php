<?php
/*
Plugin Name: WP Intense Images
Plugin URI: http://tholman.com/intense-images/
Description: A stand alone javascript library for viewing images on the full, full screen.
Version: 0.0.1
Author: Dylan Ryan
Author URI:
License: MIT
*/

/*
 * Deny Direct Access
 */
if(!defined('WPINC')){
	die;
}

/*
 * Register Shortcode
 */
add_action('init', 'intense_register_shortcode');
function intense_register_shortcode(){
	add_shortcode('intense', 'intense_shortcode');
}

/*
 * Main Function
 */
function intense_shortcode($atts){

	$output = '';

	$intense_atts = shortcode_atts( array (
		'src'       =>  '',
		'title'     =>  '',
		'caption'   =>  ''
	), $atts);

	$output .= '<img class="intense" src="'.esc_attr($intense_atts['src']).'" data-title="'.esc_attr($intense_atts['title']).'" data-caption="'.esc_attr($intense_atts['caption']).'"/>';

	return $output;
}

/*
 * Enqueue Scripts
 */
add_action('wp_enqueue_scripts', 'intense_enqueue_script');
function intense_enqueue_script(){
	wp_enqueue_script('intense-js', plugins_url('js/intense.js',__FILE__));
	wp_enqueue_script('wp-intense-js', plugins_url('js/wp-intense.js',__FILE__), array(), '0.0.1', true);
	wp_enqueue_style('intense-css', plugins_url('css/intense.css',__FILE__));
}