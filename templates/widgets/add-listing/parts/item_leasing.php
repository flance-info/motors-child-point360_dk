<?php

$_id     = stm_listings_input( 'item_id' );
$post_id = get_the_ID();  // 1755 is add car page id
if ( $post_id !== 1755 ) {
	return;
}
$current_user = wp_get_current_user();
$display_section = false;
if ( in_array( 'administrator', $current_user->roles ) || in_array( 'stm_dealer', $current_user->roles ) ) {
	$display_section = true;
}
if ( $display_section === false ) {
	return;
}
?>
<div class="stm-form-leasing-edit">
	<div class="stm-car-listing-data-single stm-border-top-unit stm-row-flex">
		<div class="title heading-font"><?php esc_html_e( 'Add this Car to Leasing', 'motors-child' ); ?></div>
		<div class="stm-checkbox-flex">
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'Yes', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="checkbox" value="yes" name="stm_add_leasing">
						</span>
					</div>

				</label>
			</div>
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'No', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="checkbox" value="no" name="stm_add_leasing">
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
					<span><?php esc_html_e( 'Car incl. VAT', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="checkbox" value="yes" name="stm_car_leasing_vat">
						</span>
					</div>

				</label>
			</div>
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'Car plus. VAT', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="checkbox" value="no" name="stm_car_leasing_vat">
						</span>
					</div>

				</label>
			</div>
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'Van incl. VAT', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="checkbox" value="no" name="stm_van_leasing_vat">
						</span>
					</div>

				</label>
			</div>
			<div class="feature-single stm-radio">
				<label>
					<span><?php esc_html_e( 'Van excl. VAT', 'motors-child' ); ?></span>
					<div class="checker">
						<span>
							<input type="checkbox" value="no" name="stm_van_leasing_vat">
						</span>
					</div>

				</label>
			</div>

		</div>
	</div>

</div>

