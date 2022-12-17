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
define("Wp_Meilisearch_DIR_PATH", plugin_dir_path(__FILE__));

function wp_meili_menu()
{
    add_menu_page("Wp Meilisearch", "Wp Meilisearch", "manage_options", "wp-meilisearch", "wp_meili_list_call");
}

add_action("admin_menu", "wp_meili_menu");

function wp_meili_list_call()
{
    include_once Wp_Meilisearch_DIR_PATH . '/views/dashboard.php';
}


/**
 *enqueue scripts and styles
 */
function wp_meili_enqueue_style_script()
{

//    wp_enqueue_style( 'style-name', get_stylesheet_uri() );
//    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );

    wp_enqueue_style('wp_meili_style', plugins_url('css/wp_meili_style.css', __FILE__));

    wp_enqueue_script('wp_meili_script', plugins_url('js/wp_meili_script.js', __FILE__), array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'wp_meili_enqueue_style_script');