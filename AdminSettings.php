<?php

namespace WPMeilisearch;

class AdminSettings {
	public function init() {
		add_action( "admin_menu", function () {
			add_menu_page( "Wp Meilisearch", "Wp Meilisearch", "manage_options", "wp-meilisearch", [
				$this,
				'renderPage'
			] );
		} );

	}

	public function renderPage() {
		include_once Wp_Meilisearch_DIR_PATH . '/views/meiliInfo.php';
		if ( get_option( 'wp_meili_url' ) && get_option( 'wp_meli_master_key' ) != null ) {
			include_once Wp_Meilisearch_DIR_PATH . '/views/dash.php';

		}

	}

}