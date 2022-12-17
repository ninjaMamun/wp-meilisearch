<?php
/*
Plugin Name:  Wp Meilisearch
Plugin URI:   https://www.google.com
Description:  Will put later. what i put will show in admin plugin area
Version:      1.0
Author:       Saidul Islam, Shahriyar Mamun
Author URI:   https://www.google.com
License:      GPL2
License URI:
Text Domain:  wp_meili
Domain Path:  /languages
*/
/**
 *enqueue scripts and styles
 */
function wp_meili_enqueue_style_script() {

//    wp_enqueue_style( 'style-name', get_stylesheet_uri() );
//    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );

    wp_enqueue_style( 'wp_meili_style', plugins_url('css/wp_meili_style.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'wp_meili_enqueue_style_script' );