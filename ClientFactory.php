<?php

namespace WPMeilisearch;

use Meilisearch\Client;

class ClientFactory
{
    public static function create()
    {
        return new Client( 'http://127.0.0.1:7700', get_option( 'wp_meli_master_key' ) );
    }
}