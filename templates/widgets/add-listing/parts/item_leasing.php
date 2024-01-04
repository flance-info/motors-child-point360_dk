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
if ( empty( $_id ) ) :
	?>
	<div class="stm-form-4-videos clearfix">
		<div class="stm-car-listing-data-single stm-border-top-unit ">
			<div class="title heading-font"><?php esc_html_e( 'Add Videos', 'motors' ); ?></div>
		</div>
		<div class="stm-add-videos-unit">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="stm-video-units">
						<div class="stm-video-link-unit-wrap">
							<div class="heading-font">
								<span class="video-label"><?php esc_html_e( 'Video link', 'motors' ); ?></span> <span
										class="count">1</span></div>
							<div class="stm-video-link-unit">
								<input type="text" name="stm_video[]"/>
								<div class="stm-after-video"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="stm-simple-notice">
						<i class="fas fa-info-circle"></i>
						<?php echo wp_kses_post( stm_me_get_wpcfto_mod( 'addl_video_content', '' ) ); ?>
					</div>
				</div>
			</div>
		</div>


		<div class="stm-add-videos-unit stm">
			<div style="position: relative;">
				<input type="file" name="stm_video_preview[]" id="stm_video_preview_1" multiple="">
				<a href="#" class="button stm_fake_button">Choose video thumbnail</a>
			</div>
		</div>
	</div>


<?php else : ?>
	<?php $video = get_post_meta( $_id, 'gallery_video', true ); ?>

	<div class="stm-form-4-videos clearfix">
		<div class="stm-car-listing-data-single stm-border-top-unit ">
			<div class="title heading-font"><?php esc_html_e( 'Add Videos', 'motors' ); ?></div>
			<span class="step_number step_number_4 heading-font"><?php esc_html_e( 'step', 'motors' ); ?> 4</span>
		</div>
		<?php $has_videos = false; ?>
		<div class="stm-add-videos-unit">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="stm-video-units">
						<div class="stm-video-link-unit-wrap">
							<div class="heading-font">
								<span class="video-label"><?php esc_html_e( 'Video link', 'motors' ); ?></span> <span
										class="count">1</span>
							</div>
							<?php
							$video = get_post_meta( $_id, 'gallery_video', true );
							if ( empty( $video ) ) {
								$video = '';
							} else {
								$has_videos = true;
							}
							?>
							<div class="stm-video-link-unit">
								<input type="text" name="stm_video[]" value="<?php echo esc_url( $video ); ?>"/>
								<div class="stm-after-video active"></div>
							</div>
							<?php
							if ( $has_videos ) :
								$gallery_videos = get_post_meta( $_id, 'gallery_videos', true );
								if ( ! empty( $gallery_videos ) ) :
									foreach ( $gallery_videos as $gallery_video ) :
										?>
										<div class="stm-video-link-unit">
											<input type="text" name="stm_video[]"
												   value="<?php echo esc_url( $gallery_video ); ?>"/>
											<div class="stm-after-video active"></div>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>

				</div>


				<div class="col-md-6 col-sm-12">
					<div class="stm-simple-notice">
						<i class="fas fa-info-circle"></i>
						<?php echo wp_kses_post( stm_me_get_wpcfto_mod( 'addl_video_content', '' ) ); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="stm-add-videos-unit stm">
			<div style="position: relative;">
				<input type="file" name="stm_video_preview[]" id="stm_video_preview_1" multiple="">
				<a href="#" class="button stm_fake_button">Choose video thumbnail</a>
			</div>
		</div>

	</div>
<?php endif; ?>

