<?php
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function show_stock() {
	global $product;
	if ( rwmb_meta( 'gskon_raffle', null, get_the_ID() ) === '1' ) {
		echo '<p class="remaining-raffle">Raffle</p>';
		echo '<span class="posted_on">', date( 'F j, Y', rwmb_meta( 'gskraffle_time', null, get_the_ID() ) ), '</span>';
	}
	elseif ( $product->get_stock_quantity() ) { // if manage stock is enabled 
		if ( number_format($product->get_stock_quantity(),0,'','') < 3 ) { // if stock is low
			echo '<p class="remaining">Only ' . number_format($product->get_stock_quantity(),0,'','') . '</p>';
		} else {
			echo '<p class="remaining">Available: <span>' . number_format($product->get_stock_quantity(),0,'','') . '</span></p>'; 
		}
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'show_stock', 20 );

// edit account
add_action( 'woocommerce_save_account_details', 'save_user_extra_info', 12, 1 );
function save_user_extra_info( $user_id ) {
    // For Favorite color
    if( isset( $_POST['favorite_color'] ) )
        update_user_meta( $user_id, 'favorite_color', sanitize_text_field( $_POST['favorite_color'] ) );

    // For Billing email (added related to your comment)
    if( isset( $_POST['account_email'] ) )
        update_user_meta( $user_id, 'billing_email', sanitize_text_field( $_POST['account_email'] ) );
}
