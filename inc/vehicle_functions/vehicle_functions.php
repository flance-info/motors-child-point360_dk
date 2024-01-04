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
	return $meta;
}, 10, 3 );