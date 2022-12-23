<?php

namespace WPMeilisearch;

use Meilisearch\Client;

class AdminAjaxHandler
{
	public function init()
	{
		add_action( 'wp_ajax_meili_ajax', [$this, 'handleAjaxCall'] );
	}

	public function handleAjaxCall()
	{
		switch ($_POST['task']) {
			case 'indexOrders':
				$this->indexOrders();
				break;
			case 'countOrders':
				$this->countOrders();
				break;
		}
	}

	private function indexOrders()
	{
		$page = $_POST['page'];
		$size = $_POST['limit'];
		$indexer = $this->getIndexer();
		$indexer->indexOrders('order', $page, $size);

		wp_send_json(['success' => true]);
	}

	private function getIndexer()
	{
		require_once __DIR__.'/Indexer.php';

		$client = new Client( 'http://127.0.0.1:7700', get_option( 'wp_meli_master_key' ) );
		$indexer = new Indexer($client);

		return $indexer;
	}

	private function countOrders()
	{
		global $wpdb;
		$results= $wpdb->get_results ("SELECT COUNT(id) AS x FROM wpkw_posts WHERE post_type='shop_order';");

		wp_send_json( [
			'count' => (int) ($results[0] -> x ),
		], 200 );
	}

}
