<?php
function flance_write_log( $message, $file = 'logs/logfile.log' ) {

	ob_start();
	print_r( $message );
	$message         = ob_get_clean();
	$theme_directory = get_stylesheet_directory();
	$log_file_path = $theme_directory . '/' . $file;
	$log_directory = dirname( $log_file_path );
	if ( ! file_exists( $log_directory ) ) {
		mkdir( $log_directory, 0755, true );
	}
	file_put_contents( $log_file_path, ' ' . $message . "\n",  LOCK_EX );
}


require_once 'motors-elementor-widgets/loader.php';
require_once 'stm-motors-extends/loader.php';
require_once 'vehicle_functions/vehicle_functions.php';
require_once(STM_LISTINGS_PATH . '/includes/admin/butterbean/butterbean.php');
wp_enqueue_style( 'general-style', get_stylesheet_directory_uri(). '/assets/css/new-style.css', [], time() );

wp_enqueue_script('stm-butterbean', STM_LISTINGS_URL . "/includes/admin/butterbean/js/stm_butterbean_fields_child.js", array(), time(), true);

wp_enqueue_script( 'stm-theme-multiselect', STM_LISTINGS_URL . '/assets/js/jquery.multi-select.js', array( 'jquery' ) );
wp_enqueue_script( 'stm-listings-js', STM_LISTINGS_URL . '/assets/js/vehicles-listing.js', array( 'jquery', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-sortable' ), '6.5.8.1' );

