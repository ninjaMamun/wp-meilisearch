<?php

namespace WPMeilisearch;

class WcOrderMeilisearchStoreCPT extends \WC_Order_Data_Store_CPT
{
    public function search_orders($term)
    {
        $client = ClientFactory::create();
        $index = $client->index('orders');

        $result = $index->search($term);
        $documents = $result->getHits();

        $order_ids = array_map(function($document) {
            return $document['ID'];
        }, $documents);
        $order_ids = array_values(array_unique($order_ids));

        return apply_filters( 'woocommerce_shop_order_search_results', $order_ids, $term, [] );
    }

}