<?php

add_filter(
	'motors_get_all_wpcfto_config',
	function ( $global_conf ) {

		$conf      = [];
		$conf_name = ( apply_filters( 'stm_is_elementor_demo', false ) ) ? 'Single Listing Van Templates' : 'Single Listing Van';
		$conf = array(
			'name'   => $conf_name,
			'fields' => apply_filters( 'me_van_car_settings_conf', $conf ),
		);
		$global_conf[ stm_me_modify_key( $conf['name'] ) ] = $conf;

		return $global_conf;
	},
	40,
	1
);
