<?php

$_id     = stm_listings_input( 'item_id' );
$post_id = get_the_ID();  // 1755 is add car page id
if ( $post_id !== 1755 ) {
	return;
}
$current_user    = wp_get_current_user();
$display_section = false;
if ( in_array( 'administrator', $current_user->roles ) || in_array( 'stm_dealer', $current_user->roles ) ) {
	$display_section = true;
}
if ( $display_section === false ) {
	return;
}
if ( $custom_listing_type && $listing_types_options ) {
	$stm_title_price       = ( $listing_types_options[ $custom_listing_type . '_addl_price_title' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_price_title' ] : '';
	$stm_title_desc        = ( $listing_types_options[ $custom_listing_type . '_addl_price_desc' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_price_desc' ] : '';
	$show_sale_price_label = ( $listing_types_options[ $custom_listing_type . '_addl_show_sale_price_label' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_show_sale_price_label' ] : '';
	$show_custom_label     = ( $listing_types_options[ $custom_listing_type . '_addl_show_custom_label' ] ) ? $listing_types_options[ $custom_listing_type . '_addl_show_custom_label' ] : '';
} else {
	$show_price_label      = stm_me_get_wpcfto_mod( 'addl_price_label', '' );
	$stm_title_price       = stm_me_get_wpcfto_mod( 'addl_price_title', '' );
	$stm_title_desc        = stm_me_get_wpcfto_mod( 'addl_price_desc', '' );
	$show_sale_price_label = stm_me_get_wpcfto_mod( 'addl_sale_price', '' );
	$show_custom_label     = stm_me_get_wpcfto_mod( 'addl_custom_label', '' );
}
$car_price_form_label = '';
$price                = '';
$sale_price           = '';
$van_price            = '';
if ( ! empty( $_id ) ) {
	$car_price_form_label = get_post_meta( $_id, 'car_price_form_label', true );
	$price                = (int) getConverPrice( get_post_meta( $_id, 'price', true ) );
	$van_price            = (int) getConverPrice( get_post_meta( $_id, 'stm_van_price', true ) );
	$sale_price           = ( ! empty( get_post_meta( $_id, 'sale_price', true ) ) ) ? (int) getConverPrice( get_post_meta( $_id, 'sale_price', true ) ) : '';
}
$vars = array(
		'price'                 => $price,
		'sale_price'            => $sale_price,
		'stm_title_price'       => $stm_title_price,
		'stm_title_desc'        => $stm_title_desc,
		'show_sale_price_label' => $show_sale_price_label,
		'show_custom_label'     => $show_custom_label,
		'car_price_form_label'  => $car_price_form_label,
		'van_price'             => $van_price,
);

$add_van      = get_post_meta( $_id, 'stm_add_van', true );
$stm_van_vat      = get_post_meta( $_id, 'stm_van_vat', true );

?>

<div class="stm-form-price-edit">
	<div class="stm-car-listing-data-single stm-border-top-unit stm-row-flex">
		<div class="title heading-font"><?php esc_html_e( 'Add this Car as Van', 'motors-child' ); ?></div>
		<div class="stm-checkbox-flex">
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'Yes', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="radio" <?php echo ($add_van == 'yes') ? 'checked' : ''; ?> value="yes" name="stm_add_van">
						</span>
					</div>

				</label>
			</div>
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'No', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="radio" <?php echo ($add_van == 'no') ? 'checked' : ''; ?> value="no" name="stm_add_van">
						</span>
					</div>

				</label>
			</div>
		</div>
	</div>
	<div class="stm-vat-row">
		<div class="stm-checkbox-flex">
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'Van with Vat', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="radio" <?php echo ($stm_van_vat == 'yes') ? 'checked' : ''; ?> value="yes" name="stm_van_vat">
						</span>
					</div>

				</label>
			</div>
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'Van without Vat', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="radio" <?php echo ($stm_van_vat == 'no') ? 'checked' : ''; ?> value="no" name="stm_van_vat">
						</span>
					</div>

				</label>
			</div>
		</div>
	</div>
	<div class="row stm-relative">
		<?php
		STM_E_W\Helpers\Helper::stm_ew_load_template( 'widgets/add-listing/parts/item_price_templates/van_price', MOTORS_ELEMENTOR_WIDGETS_PATH, $vars );
		?>
	</div>
	<input type="hidden" name="btn-type"/>
</div>