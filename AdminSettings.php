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

		include_once Wp_Meilisearch_DIR_PATH . '/views/dash.php';
	}

}