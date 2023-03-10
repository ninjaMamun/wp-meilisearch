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
define( "Wp_Meilisearch_DIR_PATH", plugin_dir_path( __FILE__ ) );

require_once __DIR__ . "/vendor/autoload.php";

require_once __DIR__ . "/AdminSettings.php";
require_once __DIR__ . "/AdminAjaxHandler.php";
require_once __DIR__ . "/AdminSearch.php";
require_once __DIR__ . "/ClientFactory.php";
//require_once __DIR__."/Indexer.php";


$admin = new \WPMeilisearch\AdminSettings();
$admin->init();

$ajaxHandler = new \WPMeilisearch\AdminAjaxHandler();
$ajaxHandler->init();

$adminSearch = new \WPMeilisearch\AdminSearch();
$adminSearch->init();


wp_enqueue_style( 'wp_meili_style', plugins_url( '/css/wp_meili_style.css', __FILE__ ), false, '1.0', 'all' );
