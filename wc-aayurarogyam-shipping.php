<?php
/**
 * Plugin Name: Aayurarogyam Custom Shipping Rules
 * Plugin URI: https://example.com/
 * Description: This plugin provides custom shipping methods for Aayurarogyam.
 * Version: 1.0.0
 * Author: Nagesh Pai and Shwetha Maiyya
 * Author URI: https://aayurarogyam.com/        
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wc-aayurarogyam-shipping
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    return; // Exit if WooCommerce is not active
}

function wc_aayurarogyam_shipping_init() {
    require_once 'class-aayurarogyam-shipping.php';
}
add_action( 'woocommerce_shipping_init', 'wc_aayurarogyam_shipping_init' );

function wc_aayurarogyam_shipping_method( $methods ) {
    $methods[ 'wc_aayurarogyam_shipping' ] = 'WC_Aayurarogyam_Shipping';
    return $methods;
}
add_filter( 'woocommerce_shipping_methods', 'wc_aayurarogyam_shipping_method' ); 