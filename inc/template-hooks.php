<?php
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function show_stock() {
    global $product;
    if ( $product->get_stock_quantity() ) { // if manage stock is enabled 
        if ( number_format($product->get_stock_quantity(),0,'','') < 3 ) { // if stock is low
            echo '<p class="remaining">Only ' . number_format($product->get_stock_quantity(),0,'','') . '</p>';
        } else {
            echo '<p class="remaining">Available: <span>' . number_format($product->get_stock_quantity(),0,'','') . '</span></p>'; 
        }
    }
}
    
add_action( 'woocommerce_before_shop_loop_item_title', 'show_stock', 20 );