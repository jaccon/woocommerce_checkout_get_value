<?php

// Checkout Rotary 4563 Data Propagation
add_filter( 'woocommerce_checkout_get_value' , 'custom_checkout_get_value', 20, 2 );
function custom_checkout_get_value( $value, $imput ) {

    if(isset($_GET['billing_ri']) && ! empty($_GET['billing_ri']) && $imput == 'billing_ri' )
		$value = esc_attr( $_GET['billing_ri'] );
		
    if(isset($_GET['billing_first_name']) && ! empty($_GET['billing_first_name']) && $imput == 'billing_first_name' )
		$value = esc_attr( $_GET['billing_first_name'] );

	if(isset($_GET['billing_last_name']) && ! empty($_GET['billing_last_name']) && $imput == 'billing_last_name' )
        $value = esc_attr( $_GET['billing_last_name'] );
		
    if(isset($_GET['billing_email']) && ! empty($_GET['billing_email']) && $imput == 'billing_email' )
		$value = esc_attr( $_GET['billing_email'] );
		
    if(isset($_GET['billing_fundacao']) && ! empty($_GET['billing_fundacao']) && $imput == 'billing_fundacao' )
        $value = esc_attr( $_GET['billing_fundacao'] );

    if(isset($_GET['billing_clube']) && ! empty($_GET['billing_clube']) && $imput == 'billing_clube' )
		$value = esc_attr( $_GET['billing_clube'] );
		
    return $value;
}

// Add product to cart and redirect with populate the user data in checkout
add_filter ('add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    if ( ! empty( $_REQUEST['billing_first_name'] ) ) {

        $billing_first_name = $_REQUEST['billing_first_name'];
        $billing_ri = $_REQUEST['billing_ri'];
        $billing_clube = $_REQUEST['billing_clube'];
		$billing_email = $_REQUEST['billing_email'];

		// Redirect cart Page
		// $checkout_url = esc_url( add_query_arg('billing_first_name', $billing_first_name, $checkout_url ) );
		$checkout_url = add_query_arg(
			array( 
				'billing_first_name' => $billing_first_name,
				'billing_ri' => $billing_ri,
				'billing_email' => $billing_email,
				'billing_clube' => $billing_clube,
			), 
			$checkout_url
		);
    }
    return $checkout_url;
}


?>