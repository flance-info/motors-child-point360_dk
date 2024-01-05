/*Butterbean fields*/
( function($) {

    $('body').on('click','.stm_vehicles_listing_icons .inner .stm_font_nav a',function(e){
        e.preventDefault();
        $('.stm_vehicles_listing_icons .inner .stm_font_nav a').removeClass('active');
        $(this).addClass('active');
        var tabId = $(this).attr('href');
        $('.stm_theme_font').removeClass('active');
        $(tabId).addClass('active');
    });

    /*Open/Delete icons*/
    $(document).on('click', '.stm_info_group_icon .stm_delete_icon', function(e){
        $(this).parent().find('input').val('').trigger('change');
        $(this).parent().find('i').removeAttr('class').attr('class', 'hidden');
    });

    var currentTarget = '';
    $(document).on('click', '.stm_info_group_icon .icon', function(e){
        e.preventDefault();
        currentTarget = $(this).parent();

        $('.stm_vehicles_listing_icons').addClass('visible');
        $('.stm-listings-pick-icon').removeClass('chosen');
        $('.stm_vehicles_listing_icons').closest('.stm-listings-pick-icon').addClass('chosen');
    });

    $('body').on('click', '.stm_vehicles_listing_icons .inner td.stm-listings-pick-icon i', function(){
        var stmClass = $(this).attr('class').replace(' big_icon', '');
        currentTarget.find('input').val(stmClass).trigger('change');
        currentTarget.find('.icon i').removeClass('hidden').attr('class', stmClass);

        currentTarget.find('.stm_info_group_icon').addClass('stm_icon_given');

        stm_listings_close_icons();
    });

    $('body').on('click', '.stm_vehicles_listing_icons .overlay', function(){
        $('.stm_vehicles_listing_icons').removeClass('visible');
    });

    function stm_listings_close_icons() {
        $('.stm_vehicles_listing_icons').removeClass('visible');
    }

    /*Multiselect*/
    /*
    butterbean.views.register_control( 'multiselect', {

        // Adds custom events.
        events : {
            'keydown .stm-multiselect-wrapper .stm_add_new_optionale input'    : 'preventsubmit',
            'click .stm-multiselect-wrapper .fa-plus'    : 'addfield',
            'click .stm-multiselect-wrapper .fa-plus'    : 'addfield',
        },

        ready: function() {
            jQuery("#butterbean-control-stm_rental_office").find('.stm_add_new_optionale').hide();
        },

        preventsubmit: function(e) {
            if( (event.keyCode == 13) ) {
                event.preventDefault();
                this.addfield(e);

                jQuery('.stm_checkbox_adder').focus();

                return false;
            }
        },

        addfield: function(m) {
            var $ = jQuery;
            var $input = $(m.currentTarget).closest('.stm_add_new_inner').find('input');
            var inputVal = $input.val();
            var $preloader = $input.closest('.stm_add_new_inner').find('i');

		    if(inputVal !== '') {
                $.ajax({
                    url: ajaxurl,
                    dataType: 'json',
                    context: this,
                    data: 'term=' + inputVal + '&category=' + this.model.attributes.name + '&action=stm_listings_add_category_in',
                    beforeSend: function () {
                        $input.closest('.stm-multiselect-wrapper').addClass('stm_loading');
                        $preloader.addClass('fa-pulse fa-spinner');
                    },
                    complete: $.proxy(function(data) {
                        data = data.responseJSON;
                        $input.closest('.stm-multiselect-wrapper').removeClass('stm_loading');
                        $input.val('');
                        $preloader.removeClass('fa-pulse fa-spinner');
						jQuery(this.el).find('select').multiSelect('addOption', { value: data.slug, text: data.name});
						jQuery(this.el).find('select').multiSelect('select', [data.slug]);
                    })
                })
            }
        }

    } );
    */


} )(jQuery);

(function($) {

    $(document).ready(function () {
        jQuery('.stm-multiselect').multiSelect({
			'keepOrder' : true
		});
        var elements = '.stm_checkbox_adder,' +
            '.butterbean-datepicker,' +
            'select,input[type="text"].widefat,' +
            '.stm_repeater_inputs input[type="text"]';
        $(elements).each(function () {
            if ($(this).val()) {
                $(this).addClass('has-value');
            }
            $(document).on('change', elements, function () {
                if ($(this).val()) {
                    $(this).addClass('has-value');
                } else {
                    $(this).removeClass('has-value');
                }
            })
        });


        /*PREVIEW*/
        $(document).on('click', '.image_preview', function(){
            var stmImage = $(this).find('span').data('preview');

            $('.image-preview').addClass('visible').append('<img src="' + stmImage + '" />');
        });

        $(document).on('click', '.image-preview .overlay', function(){
            $('.image-preview').removeClass('visible').find('img').remove();
        });

        /*Reset amount*/
        $(document).on('click', '.reset_field', function(e){
            e.preventDefault();

            if($(this).data('type') == 'stm_car_views') {
                $('input[name="butterbean_stm_car_manager_setting_stm_car_views"]').val('');
            } else if($(this).data('type') == 'stm_phone_reveals') {
                $('input[name="butterbean_stm_car_manager_setting_stm_phone_reveals"]').val('');
            }
        });

        $('input[name="butterbean_stm_car_manager_setting_car_mark_woo_online"]').on('change', function(){
            $('input[name="butterbean_stm_car_manager_setting_stm_car_stock"]').val(1);
        });

        $('input[name="butterbean_stm_car_manager_setting_car_mark_as_sold"]').on('change', function(){
            if($(this).is(':checked')) {
                $('input[name="butterbean_stm_car_manager_setting_stm_car_stock"]').val(1);
                $('input[name="butterbean_stm_car_manager_setting_car_mark_woo_online"]').prop('checked', false);
                $('#butterbean-control-stm_car_stock').hide();
            }
        });
    });

    $(window).load(function(){

        $('[data-dep]').each(function(){
            var $stmThis = $(this);

            var managerName = 'stm_car_manager_setting_';

            var elementDepended = $stmThis.data('dep');

            $(document).on('change', 'input[name="butterbean_' + managerName + elementDepended + '"]', function(){
                stmHideUseless(managerName, elementDepended, $stmThis);
            });

            stmHideUseless(managerName, elementDepended, $stmThis);
        });

        // compatibility for multilisting
        // are we on multilisting type edit/add screen?
        if ( typeof multilisting_current_type_admin_js !== 'undefined' && multilisting_current_type_admin_js != 'listings' ) {
            // do we have any multilisting types registred?
            if ( typeof multilisting_types_admin_js !== 'undefined' && multilisting_types_admin_js.length > 0 ) {
                $.each(multilisting_types_admin_js, function( index, listing_type ) {

                    // toggling dependencies
                    $('[data-dep]').each(function(){
                        var $stmThis = $(this);
            
                        var managerName = listing_type + '_manager_setting_';
            
                        var elementDepended = $stmThis.data('dep');
            
                        $(document).on('change', 'input[name="butterbean_' + managerName + elementDepended + '"]', function(){
                            stmHideUseless(managerName, elementDepended, $stmThis);
                        });
            
                        stmHideUseless(managerName, elementDepended, $stmThis);
                    });

                    // resetting phone/listing view counters
                    $(document).on('click', '.reset_field', function(e){
                        e.preventDefault();

                        if($(this).data('type') == 'stm_car_views') {
                            $('input[name="butterbean_'+ listing_type +'_manager_setting_stm_car_views"]').val('');
                        } else if($(this).data('type') == 'stm_phone_reveals') {
                            $('input[name="butterbean_'+ listing_type +'_manager_setting_stm_phone_reveals"]').val('');
                        }
                    });
                });
            }
        }

        function stmHideUseless(managerName, elementDepended, stm_this) {

            var depValue = stm_this.data('value').toString();

            var $elementDepended = stm_this.closest('.butterbean-control');

            var $elementDependsInput = $('input[name="butterbean_' + managerName + elementDepended + '"]');

            var elementDependsValue = '';
            if($elementDependsInput.attr('type') == 'checkbox') {
                elementDependsValue = $elementDependsInput.prop('checked');
            } else {
                elementDependsValue = $elementDependsInput.val();
            }

            if ( typeof elementDependsValue === 'undefined' ) return;

            elementDependsValue = elementDependsValue.toString();

            if(depValue !== elementDependsValue) {
                $elementDepended.slideUp();
            } else {
                $elementDepended.slideDown();
            }
        }

        if($('input[name="butterbean_stm_car_manager_setting_car_mark_as_sold"]').is(':checked')) {
            $('input[name="butterbean_stm_car_manager_setting_stm_car_stock"]').val(1);
            $('input[name="butterbean_stm_car_manager_setting_car_mark_woo_online"]').prop('checked', false);
            $('#butterbean-control-stm_car_stock').hide();
        }

    });
})(jQuery);