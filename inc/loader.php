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

wp_enqueue_style( 'general-style', get_stylesheet_directory_uri(). '/assets/css/new-style.css', [], time() );