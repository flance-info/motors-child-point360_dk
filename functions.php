<?php
    require_once __DIR__ . '/inc/butterbean_metabox_child.php';
    require_once __DIR__ . '/inc/vehicle_functions_child.php';
    require_once __DIR__ . '/inc/custom_field.php';
    require_once STM_MOTORS_EXTENDS_PATH . '/inc/wpcfto_conf/layout_conf/sell_a_car.php';

    /* Additional options in single car */
    require_once __DIR__ . '/inc/widgets_init.php';
    new Motors\Elementor\Widgets\Init;


    add_action('wp_enqueue_scripts', function () {
    //    wp_deregister_script('stm-theme-sell-a-car');
    //    wp_dequeue_script('stm-theme-sell-a-car');
    });
    add_action('wp_enqueue_scripts', 'stm_enqueue_parent_styles', 20);
    function stm_enqueue_parent_styles()
    {

        wp_deregister_script('stm-theme-sell-a-car');
        wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('stm-theme-style'));
        wp_enqueue_script('stm-theme-sell-a-car', get_stylesheet_directory_uri() . '/assets/js/sell-a-car-child.js', array( 'jquery-ui-droppable', 'jquery', 'load-image' ), STM_THEME_VERSION, true);

    }



    if (!function_exists('stm_is_dealer_two')) {
        remove_filter('stm_is_dealer_two', 'stm_is_dealer_two');
        add_filter('stm_is_dealer_two', 'stm_is_dealer_two', 20);
        function stm_is_dealer_two()
        {
            $dealer = get_stm_theme_demo_layout();
            if ($dealer) {
                if ('car_dealer_two' === $dealer || 'car_dealer_two_elementor' === $dealer || 'listing_three_elementor') {
                    $dealer = true;
                } else {
                    $dealer = false;
                }
            }
            return $dealer;
        }
    }


    if (!function_exists('write_log')) {

        function write_log($log)
        {
            if (true === WP_DEBUG) {
                if (is_array($log) || is_object($log)) {
                    error_log(print_r($log, true));
                } else {
                    error_log($log);
                }
            }
        }

    }

    add_action('save_post', function ($post_id, WP_Post $post) {
        if ($post->post_type !== 'listings') return;

        update_post_meta($post_id, 'car_mark_woo_online', 'on');
        update_post_meta($post_id, 'stm_car_stock', 1);

    }, 99, 2);

//    add_filter('woocommerce_add_to_cart_validation', 'bbloomer_only_one_in_cart', 9999, 2);

//    function bbloomer_only_one_in_cart($passed, $added_product_id)
//    {
//        wc_empty_cart();
//        return $passed;
//    }


