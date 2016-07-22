<?php
/**
 * Plugin Name: Woo Add Custom Fee
 * Plugin URI: https://wooexpert.com/
 * Description: A simple plugin to add custom fee at your cart
 * Author: Wooexpert
 * Author URI: http://wooexpert.com/
 * Version: 1.0
 * Text Domain: wacf
 */

// WACF Main file 
require_once('classes/wacf_functions.php');

// WACF Back-End Settings
require_once('classes/wacf_settings.php');


add_action( 'admin_init', 'wacf_check_woocommerce_plugin' );

function wacf_check_woocommerce_plugin() {

	/**
	 * Check if WooCommerce is active
	 **/
	 
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

		deactivate_plugins( plugin_basename( __FILE__ ) );
		
		if ( isset( $_GET['activate'] ) )
						unset( $_GET['activate'] );
		
		wp_die( '<b>'.__('Woo Add Custom Fee','wacf').'</b> '.__('requires you to install & activate','wacf').'<b> '.__('WooCommerce Plugin','wacf').'</b> '.__('before activating it!','wacf').'<br><br><a href="javascript:history.back()"><< '.__('Go Back To Plugins Page','wacf').'</a>' );
		
	}		

}

