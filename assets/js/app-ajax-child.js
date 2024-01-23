"use strict";

(function ($) {
	$(document).ajaxComplete(function (event, xhr, settings) {
		if ((settings.url === ajaxurl && settings.data.indexOf('action=stm_custom_register') !== -1) ||
		settings.url === ajaxurl && settings.data.indexOf('action=stm_custom_login') !== -1) {
			if (xhr.status === 200 && xhr.responseJSON) {
				let data = xhr.responseJSON;
				console.log('Success response:', data);
				if (data.user_html) {
					$('.stm-login-display').show();
					$('.stm-login-hide').hide();
				}
			}
		}
	});
})(jQuery);
