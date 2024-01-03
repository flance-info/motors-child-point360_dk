<div class="section-pricing">
	<div class="stm-form-plans">
		<div class="pricing-plans">
			<div class="row">
				<?php
				if ( class_exists( 'WooCommerce' ) ) {


					$product_ids = array( 94151, 94153, 94156 );
					// Start output buffering
					ob_start();
					// Loop through each product ID
					foreach ( $product_ids as $product_id ) {

						// Get the product
						$product = wc_get_product( $product_id );
						// Check if the product exists
						if ( $product ) {

							// Get the product description
							$description = $product->get_description();
							// Get the product price
							$price = wc_price( $product->get_price() );
							// Output the product information
							?>

							<div class="col-12 col-sm-6 col-lg-4 col-xl-4">
								<div class="pricing-item" data-option="<?php echo $product_id; ?>">
									<div>
										<h4><?php echo $product->get_name(); ?></h4>
										<h3> <?php echo $price; ?></h3>
										<div><?php echo $description; ?></div>

									</div>
									<div class="pricing-item-actions-block">
										<label class="choose-label" for="choose-<?php echo $product_id; ?>">
											<input type="radio" id="choose-<?php echo $product_id; ?>" name="pricing_option" value="<?php echo $product_id; ?>">
											<?php esc_html_e( 'CHOOSE', 'motors-child' ); ?>
										</label>
									</div>
								</div>
							</div>
							<?php
						} else {
							?>
							<p>Product with ID <?php echo $product_id; ?> not found.</p>
							<?php
						}
					}
					// Get the buffered output
					$output = ob_get_clean();
					// Print or use the output as needed
					echo $output;
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="section-pricing stm-middle">
	<div class="stm-form-plans">
		<div class="pricing-plans">
			<div class="row">
				<?php
				if ( class_exists( 'WooCommerce' ) ) {

					$product_ids = array( 94151, 94153 );
					// Start output buffering
					ob_start();
					// Loop through each product ID
					foreach ( $product_ids as $product_id ) {

						// Get the product
						$product = wc_get_product( $product_id );
						// Check if the product exists
						if ( $product ) {


							$description = $product->get_description();
							// Get the product price
							$price = wc_price( $product->get_price() );
							// Output the product information
							?>

							<div class="col-12 col-sm-6 col-lg-4 col-xl-4">
								<div class="pricing-item" data-option="<?php echo $product_id; ?>">
									<div>
										<h4><?php echo $product->get_name(); ?></h4>
										<h3> <?php echo $price; ?></h3>
										<div><?php echo $description; ?></div>

									</div>
									<div class="pricing-item-actions-block">
										<label class="choose-label" for="choose-<?php echo $product_id; ?>">
											<input type="radio" id="choose-<?php echo $product_id; ?>" name="set_pricing_option" value="<?php echo $product_id; ?>">
											<?php esc_html_e( 'CHOOSE', 'motors-child' ); ?>
										</label>
									</div>
								</div>
							</div>
							<?php
						} else {
							?>
							<p>Product with ID <?php echo $product_id; ?> not found.</p>
							<?php
						}
					}
					// Get the buffered output
					$output = ob_get_clean();
					// Print or use the output as needed
					echo $output;
				}
				?>
			</div>
		</div>
	</div>
</div>


<script>
	jQuery(document).ready(function ($) {
		$('input[name="pricing_option"]').change(function () {
			var selectedOption = $(this).val();
			$('.pricing-item').removeClass('active');
			$('.pricing-item[data-option="' + selectedOption + '"]').addClass('active');
		});

		$('input[name="set_pricing_option"]').change(function () {
			var selectedOption = $(this).val();
			$('.pricing-item').removeClass('active');
			$('.pricing-item[data-option="' + selectedOption + '"]').addClass('active');
		});
	});
</script>