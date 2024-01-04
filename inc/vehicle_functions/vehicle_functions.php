<?php

add_filter( 'stm_add_car_validation', 'stm_child_replace_add_listing_notifications_item' );

function stm_child_replace_add_listing_notifications_item( $validation ) {
	$custom_listing_type = esc_attr( $_REQUEST['custom_listing_type'] );
	if ( ! empty( $custom_listing_type ) ) {
		return $validation;
	}
	$check_plans = [
		'stm_set_pricing_option' => esc_html( 'Plan Point 1, Point 2 Or Point 3', 'motors-child' ),
		'stm_pricing_option'     => esc_html( 'Plan Point360.dk or DBA & Billbasen', 'motors-child' ),
	];
	foreach ( $check_plans as $check_plan => $check_plan_title ) {
		if ( empty( $_REQUEST[ $check_plan ] ) ) {
			$validation['error']    = true;
			$validation['response'] = [ 'message' => esc_html( 'Please select ', 'motors-child' ) . $check_plan_title ];
		}
	}

	return $validation;
}

add_filter( 'stm_listing_save_post_meta', function ( $meta, $post_id, $update ) {
	$custom_listing_type = esc_attr( $_REQUEST['custom_listing_type'] );
	if ( ! empty( $custom_listing_type ) ) {
		return $meta;
	}
	$check_plans = [
		'stm_set_pricing_option' => esc_html( 'Plan Point 1, Point 2 Or Point 3', 'motors-child' ),
		'stm_pricing_option'     => esc_html( 'Plan Point360.dk or DBA & Billbasen', 'motors-child' ),
	];
	foreach ( $check_plans as $check_plan => $check_plan_title ) {
		if ( ! empty( $_REQUEST[ $check_plan ] ) ) {
			$value = esc_attr( $_REQUEST[ $check_plan ] );
			update_post_meta( $post_id, $check_plan, $value );
		}
	}
	if (!empty($_REQUEST[ 'stm_pricing_option' ])) 	$_SESSION["safeproduct"] = $_REQUEST[ 'stm_pricing_option' ];

	return $meta;
}, 10, 3 );

function stm_add_safe_product( ) {

	$plan_id = $_SESSION["safeproduct"];

	if (is_numeric($plan_id)){
		WC()->cart->add_to_cart( $plan_id, 1, 0, array(), array( 'safe_custom_price' => $_SESSION["safeprice"] ) );
		return;
	}

	switch ($_SESSION["safeproduct"])
	{
		case 'Basic 100':
			WC()->cart->add_to_cart( 93708, 1, 0, array(), array( 'safe_custom_price' => $_SESSION["safeprice"] ) );
			break;
		case 'Comfort 100':
			WC()->cart->add_to_cart( 93884, 1, 0, array(), array( 'safe_custom_price' => $_SESSION["safeprice"] ) );
			break;
		case 'Comfort plus 100':
			WC()->cart->add_to_cart( 93886, 1, 0, array(), array( 'safe_custom_price' => $_SESSION["safeprice"] ) );
			break;
		case 'Comfort plus 150':
			WC()->cart->add_to_cart( 93887, 1, 0, array(), array( 'safe_custom_price' => $_SESSION["safeprice"] ) );
			break;
		default:
			WC()->cart->add_to_cart( 93887, 1, 0, array(), array( 'safe_custom_price' => $_SESSION["safeprice"] ) );
			break;
	}
}

remove_action( 'woocommerce_before_checkout_form', 'add_safe_product' );
add_action( 'woocommerce_before_checkout_form', 'stm_add_safe_product' );

/**
 * Code for enabling custom price.
 * Used for safe products
 */

 function stm_safe_custom_price_refresh( $cart_object ) {
	$plan_id = $_SESSION["safeproduct"];
	if (is_numeric($plan_id)){
		WC()->cart->add_to_cart( $plan_id, 1, 0, array(), array( 'safe_custom_price' => $_SESSION["safeprice"] ) );
		return;
	}

	$name = 'Safe ' . $_SESSION["safeproduct"] . ' - ' . $_SESSION["safepmonths"] . ' Måneder';
	foreach ( $cart_object->get_cart() as $item ) {

		if( array_key_exists( 'safe_custom_price', $item ) ) {
			$item[ 'data' ]->set_price( $item[ 'safe_custom_price' ] );
			$item[ 'data' ]->set_name( $name );
		}
	}
}
 //remove_action( 'woocommerce_before_calculate_totals', 'safe_custom_price_refresh' );
 //add_action( 'woocommerce_before_calculate_totals', 'stm_safe_custom_price_refresh' );
