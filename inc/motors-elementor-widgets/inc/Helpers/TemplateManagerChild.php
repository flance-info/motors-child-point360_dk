<?php

namespace Motors_E_W\Helpers;

use Elementor\Plugin;
use Motors_E_W\Helpers\TemplateManager;

class TemplateManagerChild extends TemplateManager {

	public static function init() {
		remove_filter('wpcfto_field_mew-repeater-radio', array(TemplateManager::class, 'motors_register_wpcfto_repeater_radio'));
		add_filter( 'wpcfto_field_mew-repeater-radio', array( self::class, 'motors_register_wpcfto_repeater_radio' ) );
	}

	public static function motors_register_wpcfto_repeater_radio() {
		return MOTORS_CHILD_ELEMENTOR_WIDGETS_PATH . '/inc/wpcfto/mew-repeater-radio.php';
	}

}

add_action('init', function () {
    TemplateManagerChild::init();
});
