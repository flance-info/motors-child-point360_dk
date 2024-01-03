<div class="elementor elementor-1755">
	<div class="elementor-container elementor-column-gap-default">
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


					$description = $product->get_description();
					// Get the product price
					$price = wc_price( $product->get_price() );
					// Output the product information
					?>
					<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-ad2c09 pricing-item" data-option="<?php echo $product_id; ?>" data-element_type="column">
						<div class="elementor-widget-wrap elementor-element-populated">
							<div class="elementor-element elementor-element-4895c2d9 elementor-widget elementor-widget-motors-pricing-plan" data-id="76b79860" data-element_type="widget" data-widget_type="motors-pricing-plan.default">
								<div class="elementor-widget-container">

									<div class="stm-pricing-plan" data-option="<?php echo $product_id; ?>">
										<div class="stm-pricing-plan__wrapper text-align-center">
											<div class="stm-pricing-plan__header">
												<div class="stm-pricing-plan__header__wrapper icon-position-none">
													<div class="stm-pricing-plan__header-text">
														<div class="stm-pricing-plan__header-text__title">
															<?php echo $product->get_name(); ?>
														</div>
														<div class="stm-pricing-plan__header-text__subtitle">
														</div>
													</div>
												</div>
											</div>
											<div class="stm-pricing-plan__separator stm-pricing-plan__separator__title">
												<div class="stm-pricing-plan__separator__element"></div>
											</div>
											<div class="stm-pricing-plan__price-section">
												<div class="stm-pricing-plan__price">
													<sup class="stm-pricing-plan__price__position-left"></sup>
													<span class="stm-pricing-plan__price__text">
										<?php echo $price; ?>
									</span>
												</div>
												<div class="stm-pricing-plan__period_text">
													DKK
												</div>
											</div>
											<?php echo $description; ?>

											<div class="stm-pricing-plan__button">
												<label class="choose-label" for="choose-<?php echo $product_id; ?>">
													<input type="radio" id="choose-<?php echo $product_id; ?>" name="set_pricing_option" value="<?php echo $product_id; ?>">
													<?php esc_html_e( 'CHOOSE', 'motors-child' ); ?>
												</label>
											</div>
											<div class="stm-pricing-plan__separator stm-pricing-plan__separator__bottom_line">
												<div class="stm-pricing-plan__separator__element"></div>
											</div>
										</div>
									</div>
								</div>
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
			$output = ob_get_clean();
			echo $output;
		}
		?>
	</div>
</div>


<div class="elementor elementor-1755">
	<div class="elementor-container elementor-column-gap-default">
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
					<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-ad2c09 pricing-item" data-option="<?php echo $product_id; ?>" data-element_type="column">
						<div class="elementor-widget-wrap elementor-element-populated">
							<div class="elementor-element elementor-element-4895c2d9 elementor-widget elementor-widget-motors-pricing-plan" data-id="76b79860" data-element_type="widget" data-widget_type="motors-pricing-plan.default">
								<div class="elementor-widget-container">

									<div class="stm-pricing-plan" data-option="<?php echo $product_id; ?>">
										<div class="stm-pricing-plan__wrapper text-align-center">
											<div class="stm-pricing-plan__header">
												<div class="stm-pricing-plan__header__wrapper icon-position-none">
													<div class="stm-pricing-plan__header-text">
														<div class="stm-pricing-plan__header-text__title">
															<?php echo $product->get_name(); ?>
														</div>
														<div class="stm-pricing-plan__header-text__subtitle">
														</div>
													</div>
												</div>
											</div>
											<div class="stm-pricing-plan__separator stm-pricing-plan__separator__title">
												<div class="stm-pricing-plan__separator__element"></div>
											</div>
											<div class="stm-pricing-plan__price-section">
												<div class="stm-pricing-plan__price">
													<sup class="stm-pricing-plan__price__position-left"></sup>
													<span class="stm-pricing-plan__price__text">
										<?php echo $price; ?>
									</span>
												</div>
												<div class="stm-pricing-plan__period_text">
													DKK
												</div>
											</div>
											<?php echo $description; ?>

											<div class="stm-pricing-plan__button">
												<label class="choose-label" for="choose-<?php echo $product_id; ?>">
													<input type="radio" id="choose-<?php echo $product_id; ?>" name="pricing_option" value="<?php echo $product_id; ?>">
													<?php esc_html_e( 'CHOOSE', 'motors-child' ); ?>
												</label>
											</div>
											<div class="stm-pricing-plan__separator stm-pricing-plan__separator__bottom_line">
												<div class="stm-pricing-plan__separator__element"></div>
											</div>
										</div>
									</div>
								</div>
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
			$output = ob_get_clean();
			echo $output;
		}
		?>
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