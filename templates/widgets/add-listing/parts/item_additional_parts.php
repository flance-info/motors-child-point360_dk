<?php

$_id  = stm_listings_input( 'item_id' );
$data = stm_get_single_car_listings();
$post_id = get_the_ID();  // 1755 is add car page id
if ($post_id  !== 1755){
	return;
}
$current_user = wp_get_current_user();

$display_section = false;
if (in_array('administrator', $current_user->roles) || in_array('stm_dealer', $current_user->roles)) {
	$display_section = true;
}

if ($display_section === false){
 return;
}




?>
<div class="stm_add_car_form_1">
	<div class="stm-car-listing-data-single stm-border-top-unit ">
		<div class="title heading-font"><?php esc_html_e( 'Optional Extras', 'motors-child' ); ?></div>
	</div>
	<?php
	if ( empty( $_id ) ) :
		?>


	<?php else: ?>

	<?php endif; ?>


</div>
