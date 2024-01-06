<?php

$current_url  = home_url( $_SERVER['REQUEST_URI'] );
$layout_param = filter_input( INPUT_GET, 'stm-layout', FILTER_SANITIZE_STRING );


?>

<div class="elementor-row stm-buttons">
	<?php if ( 'leasing' == $layout_param ) : ?>
		<div class="elementor-column">
			<a href="?" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS CAR', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=van" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS VAN', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=leasing_van" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS LEASING VAN', 'motors-child' ); ?></span>
			</a>
		</div>
	<?php elseif ( 'van' == $layout_param ) : ?>
		<div class="elementor-column">
			<a href="?" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS CAR', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=leasing" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS LEASING CAR', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=leasing_van" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS LEASING VAN', 'motors-child' ); ?></span>
			</a>
		</div>
	<?php elseif ( 'leasing_van' == $layout_param ) : ?>

		<div class="elementor-column">
			<a href="?" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS CAR', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=van" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS VAN', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=leasing" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS LEASING CAR', 'motors-child' ); ?></span>
			</a>
		</div>
	<?php else : ?>
		<div class="elementor-column">
			<a href="?stm-layout=van" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS VAN', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=leasing" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS LEASING CAR', 'motors-child' ); ?></span>
			</a>
		</div>
		<div class="elementor-column">
			<a href="?stm-layout=leasing_van" class="elementor-button elementor-size-md black-button">
				<span class="elementor-button-text"><?php esc_html_e( 'SHOW AS LEASING VAN', 'motors-child' ); ?></span>
			</a>
		</div>
	<?php endif; ?>
</div>



