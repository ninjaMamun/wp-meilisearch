<form action="" method="post" class="meiliForm">

    <p>
        <label>
            MeiliSearch URL:
        </label>
        <input type="url" name="wp_meili_url" placeholder="Enter your meilisearch url" required/>
    </p>

    <p>
        <label>
            MeiliSearch Master Key:
        </label>
        <input type="text" name="wp_meili_master_key" placeholder="Enter your master key" required/>
    </p>

	<?php if ( get_option( 'wp_meli_master_key' ) == null ): ?>

        <p>
            <button type="submit" name="wp_meili_master_key_btn_submit">Submit</button>
        </p>

	<?php endif; ?>


	<?php if ( get_option( 'wp_meli_master_key' ) ): ?>
        <p>
            <button type="submit" name="wp_meili_master_key_btn_update">Update</button>
        </p>

	<?php endif; ?>

</form>


<?php

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

