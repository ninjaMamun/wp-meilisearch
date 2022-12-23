<?php

namespace WPMeilisearch;

class AdminSearch {
	public function init()
    {
        add_filter('woocommerce_order_data_store', [$this, 'overrideOrderStore'], 10, 1);
	}

    public function overrideOrderStore($className)
    {
        require_once __DIR__.'/WcOrderMeilisearchStoreCPT.php';


        return WcOrderMeilisearchStoreCPT::class;

        //return $className;
    }
}