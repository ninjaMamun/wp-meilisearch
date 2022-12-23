<?php

namespace WPMeilisearch;

use Meilisearch\Client;
use WC_REST_Orders_Controller;

class Indexer
{
	private $client;

	public function __construct( Client $client ) {
		$this->client = $client;
	}

	public function indexOrders($indexName, $page, $batchSize = 100)
	{
		$index = $this->client->index( $indexName );

		$orders = wc_get_orders([
			'numberposts' => $batchSize,
			'page' => $page
		]);

		$helper = $this->getOrderHelper();
		$documents = [];
		foreach ( $orders as $order ) {
			$orderData        = $helper->get_formatted_item_data( $order );

			$documents[] = $orderData;
		}

		$index->addDocuments( $documents );
	}


	private function getOrderHelper()
	{
		return new WC_REST_Orders_Controller_Wrapper();
	}
}

class WC_REST_Orders_Controller_Wrapper extends WC_REST_Orders_Controller {

	public function get_formatted_item_data( $data ) {
		return parent::get_formatted_item_data( $data );
	}
}