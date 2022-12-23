<?php

namespace WPMeilisearch;

use Meilisearch\Client;
use WC_REST_Orders_Controller;

class Indexer
{
	private const ORDER_INDEX = 'order';
	private $client;

	public function __construct( Client $client )
	{
		$this->client = $client;
	}

	public function indexOrdersByPage( $indexName, $page, $batchSize = 100 )
	{
		$orders = wc_get_orders( [
			'numberposts' => $batchSize,
			'page'        => $page
		] );

		$this->indexOrders($orders);
	}


	public function indexOrderByPostIds( array $postIds )
	{
		$orders = array_map(function($postId) {
			return wc_get_order( $postId );
		}, $postIds);

		$this->indexOrders($orders);

	}

	private function indexOrders(array $orders)
	{
		$helper    = $this->getOrderHelper();
		$documents = [];
		foreach ( $orders as $order ) {
			$orderData = $helper->get_formatted_item_data( $order );
			$documents[] = $orderData;
		}


		$this->indexDocuments(static::ORDER_INDEX, $documents);
	}

	private function indexDocuments(string $indexName, array $documents)
	{
		$index = $this->client->index( $indexName );

		$index->addDocuments( $documents );
	}


	private function getOrderHelper() {
		return new WC_REST_Orders_Controller_Wrapper();
	}
}

class WC_REST_Orders_Controller_Wrapper extends WC_REST_Orders_Controller {

	public function get_formatted_item_data( $data ) {
		return parent::get_formatted_item_data( $data );
	}
}