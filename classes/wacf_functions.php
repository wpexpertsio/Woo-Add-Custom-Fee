<?php
/*
 * @author Mohammad Mursaleen
 * Class containing all function for Woo Add Custom Fee plugin
 */
class WACF_Funcitons {

    /**
     * required actions & filters.
     */
    public static function init() {
        //hook function to add custom fee to cart
		add_action( 'woocommerce_cart_calculate_fees',  __CLASS__ . '::add_fee' );

    }

    /**
	 * Function to add Custom Fee
	 */
	public static function add_fee() {
        global $woocommerce;
        if( get_option('wacf_enable', 'no' ) != 'yes' )
            return;
        $minimum = get_option('wacf_minimum' , 0 ) ;
        $maximum = get_option('wacf_maximum', 0);
        $cart_total =  preg_replace("/([^0-9\\.])/i", "", $woocommerce->cart->get_cart_total() ) ;
        if( get_option('wacf_enable_min', true )=='yes' && get_option('wacf_enable_max', true )=='yes' && get_option('wacf_enable', true )=='yes') {
            if ($cart_total >= $minimum && $cart_total < $maximum) {
                $woocommerce->cart->add_fee(get_option('wacf_fee_label', __('Custom Fee', 'wacf')), get_option('wacf_fee_charges', 0), get_option('wacf_taxable', false), get_option('wacf_tax_class', ''));
            } else {

                preg_replace("/([^0-9\\.])/i", "", $woocommerce->cart->get_cart_total() ) ;
            }
        } elseif ( get_option('wacf_enable', true )=='yes' && get_option('wacf_enable_min', true )=='yes'  ) {
            if ($cart_total >= $minimum) {
                $woocommerce->cart->add_fee(get_option('wacf_fee_label', __('Custom Fee', 'wacf')), get_option('wacf_fee_charges', 0), get_option('wacf_taxable', false), get_option('wacf_tax_class', ''));
                }
        }
        elseif( get_option('wacf_enable', true )=='yes' && get_option('wacf_enable_max', true )=='yes' ) {

            if ( $cart_total < $maximum) {
                $woocommerce->cart->add_fee(get_option('wacf_fee_label', __('Custom Fee', 'wacf')), get_option('wacf_fee_charges', 0), get_option('wacf_taxable', false), get_option('wacf_tax_class', ''));
            }
        } else {
            if ($cart_total >= $minimum) {
                $woocommerce->cart->add_fee(get_option('wacf_fee_label', __('Custom Fee', 'wacf')), get_option('wacf_fee_charges', 0), get_option('wacf_taxable', false), get_option('wacf_tax_class', ''));
            }
        }
	}

}

WACF_Funcitons::init();






