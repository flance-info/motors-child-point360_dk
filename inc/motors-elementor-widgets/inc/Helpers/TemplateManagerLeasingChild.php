<?php

namespace Motors_E_W\Helpers;

use Elementor\Plugin;
use Motors_E_W\Helpers\TemplateManager;

class TemplateManagerLeasingChild extends TemplateManager {

	private static $post_type = 'listing_template_leasing';
	private static $plural = 'Leasing Templates';
	private static $single = 'Leasing Template';
	private static $setting_name = 'single_listing_template_leasing';
	private static $data_for_select;
	public static $selected_template_id;

	public static function init() {

		self::motors_get_templates_list();

		add_action( 'init', array( self::class, 'motors_register_post_type' ) );
		add_action( 'wp_enqueue_scripts', array( self::class, 'remove_mew_button_component_script' ), 999 );
		add_filter( 'me_leasing_car_settings_conf', array( self::class, 'motors_car_settings_conf' ) );
		add_filter( 'wpcfto_field_mew-repeater-radio-leasing', array( self::class, 'motors_register_wpcfto_repeater_radio' ) );

	}

	public static function remove_mew_button_component_script() {
		wp_dequeue_script( 'mew-button-component' );
		wp_deregister_script( 'mew-button-component' );
	}

	public static function motors_register_post_type() {

		self::$selected_template_id = stm_me_get_wpcfto_mod( self::$setting_name, null );

		if ( null === self::$selected_template_id ) {
			self::$selected_template_id = array_key_first( self::$data_for_select );
		}

		// @codingStandardsIgnoreStart
		$labels = array(
			'name'               => __( self::$plural, 'motors-elementor-widgets' ),
			'singular_name'      => __( self::$single, 'motors-elementor-widgets' ),
			'add_new'            => __( 'Add New', 'motors-elementor-widgets' ),
			'add_new_item'       => __( 'Add New ' . self::$single, 'motors-elementor-widgets' ),
			'edit_item'          => __( 'Edit ' . self::$single, 'motors-elementor-widgets' ),
			'new_item'           => __( 'New ' . self::$single, 'motors-elementor-widgets' ),
			'all_items'          => __( 'All ' . self::$plural, 'motors-elementor-widgets' ),
			'view_item'          => __( 'View ' . self::$single, 'motors-elementor-widgets' ),
			'search_items'       => __( 'Search ' . self::$plural, 'motors-elementor-widgets' ),
			'not_found'          => __( 'No ' . self::$plural . ' found', 'motors-elementor-widgets' ),
			'not_found_in_trash' => __( 'No ' . self::$plural . '  found in Trash', 'motors-elementor-widgets' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( self::$plural, 'motors-elementor-widgets' ),
		);
		// @codingStandardsIgnoreEnd

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => null,
			'supports'           => array( 'title', 'editor' ),
		);

		register_post_type( self::$post_type, $args );

	}

	public static function motors_register_wpcfto_repeater_radio() {
		return MOTORS_CHILD_ELEMENTOR_WIDGETS_PATH . '/inc/wpcfto/mew-repeater-radio-leasing.php';
	}

	public static function motors_car_settings_conf( $conf ) {
		$conf[ self::$setting_name ] = array(
			'label'       => esc_html__( 'Leasing Listing Page Template', 'motors-child' ),
			'type'        => 'mew-repeater-radio-leasing',
			'description' => __( 'Select Leasing listing page template', 'motors-child' ),
			'fields'      => self::$data_for_select,
			'value'       => array_key_first( self::$data_for_select ),
		);

		return $conf;
	}

	public static function motors_get_templates_list() {
		$args = array(
			'post_type'      => self::$post_type,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
		);
		$posts = new \WP_Query( $args );
		$for_select = array();
		foreach ( $posts->posts as $post ) {
			$for_select[] = array(
				'post_id'   => $post->ID,
				'title'     => $post->post_title,
				'edit_link' => get_admin_url( null, 'post.php?post=' . $post->ID . '&action=elementor' ),
				'view_link' => get_the_permalink( $post->ID ),
			);
		}
		self::$data_for_select = $for_select;
		wp_reset_postdata();
	}

	public static function motors_display_template_leasing() {
		global $post;
		$special_listing_template = get_post_meta( $post->ID, 'special_listing_template', true );
		flance_write_log($special_listing_template, 'logs/special_listing_template.log');
		$template_listing_id      = ( $special_listing_template ) ? $special_listing_template : self::$selected_template_id;

		flance_write_log($template_listing_id, 'logs/template_listing_id_logs.log');
		$template_listing         = get_post( $template_listing_id );
		setup_postdata( $template_listing );
		//phpcs:ignore
		echo Plugin::instance()->frontend->get_builder_content_for_display( $template_listing->ID );
		wp_reset_postdata();
	}
}

TemplateManagerLeasingChild::init();
