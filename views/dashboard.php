<?php
require_once Wp_Meilisearch_DIR_PATH . '/vendor/autoload.php';

use Meilisearch\Client;


if ( isset( $_POST['wp_meili_master_key_btn_submit'] ) ) {
	$master_key    = $_POST['wp_meili_master_key'];
	$wp_meili_url  = $_POST['wp_meili_url'];
	$wp_meili_name = 'wp_meli_master_key';

	add_option( $wp_meili_name, $master_key );
	add_option( 'wp_meili_url', $wp_meili_url );


	echo get_option( 'wp_meili_url' );
	echo get_option( $wp_meili_name );


}

if ( isset( $_POST['wp_meili_master_key_btn_update'] ) ) {
	$master_key   = $_POST['wp_meili_master_key'];
	$wp_meili_url = $_POST['wp_meili_url'];

	update_option( 'wp_meli_master_key', $master_key );

	update_option( 'wp_meili_url', $wp_meili_url );

	echo get_option( 'wp_meili_url' );
	echo get_option( 'wp_meli_master_key' );

}


function declareHelperClass() {
	/**
	 * wp-content/plugins/woocommerce/packages/woocommerce-rest-api/src/Controllers/Version3/class-wc-rest-orders-controller.php
	 */
	class WC_REST_Orders_Controller_Wrapper extends WC_REST_Orders_Controller {

		public function get_formatted_item_data( $data ) {
			return parent::get_formatted_item_data( $data );
		}
	}
}

declareHelperClass();

function wpMeiliIndex( $client ) {

	$index = $client->index( 'orders' );

	$orders = wc_get_orders( array( 'numberposts' => - 1 ) );

	foreach ( $orders as $order ) {
		$orderId = $order->get_id();

		$order = wc_get_order( $orderId );
		if ( ! $order ) {
			error_log( "Error: Cannot find order $orderId" );

			return false;
		}

		$ordersController = new WC_REST_Orders_Controller_Wrapper();
		$orderData        = $ordersController->get_formatted_item_data( $order );

		$index->addDocuments( $orderData );

		echo json_encode( $orderData, JSON_PRETTY_PRINT );

	}

}


$client = new Client( 'http://127.0.0.1:7700', get_option( 'wp_meli_master_key' ) );

wpMeiliIndex( $client );


?>

<form action="" method="post">

    <p>
        <label>
            MeiliSearch URL
        </label>
        <input type="url" name="wp_meili_url" placeholder="Enter your meilisearch url" required/>
    </p>

    <p>
        <label>
            MeiliSearch Master Key
        </label>
        <input type="text" name="wp_meili_master_key" placeholder="Enter your master key" required/>
    </p>


    <p>
        <button type="submit" name="wp_meili_master_key_btn_submit">Submit</button>
    </p>

	<?php if ( get_option( 'wp_meli_master_key' ) ): ?>
        <p>
            <button type="submit" name="wp_meili_master_key_btn_update">Update</button>
        </p>

	<?php endif; ?>

</form>