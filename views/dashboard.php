<?php

if ( isset( $_POST['wp_meili_master_key_btn_submit'] ) ) {
	$master_key    = $_POST['wp_meili_master_key'];
	$wp_meili_name = 'wp_meli_master_key';

    add_option($wp_meili_name, $master_key);

    echo get_option($wp_meili_name);




}

?>

<form action="" method="post">

    <p>
        <label>
            MeiliSearch Master Key
        </label>
        <input type="text" name="wp_meili_master_key" placeholder="Enter your master key" required/>
    </p>

    <p>
        <button type="submit" name="wp_meili_master_key_btn_submit">Submit</button>
    </p>

</form>