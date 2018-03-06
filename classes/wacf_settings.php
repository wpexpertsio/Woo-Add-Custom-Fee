<?php
/**
 * @author Mohammad Mursaleen
 * Class for Woo Add Custom Fee Back end settings
 */
class WACF_Settings {
    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
        add_action( 'woocommerce_settings_tabs_settings_wacf', __CLASS__ . '::settings_tab' );
        add_action( 'woocommerce_update_options_settings_wacf', __CLASS__ . '::update_settings' );
    }
    
    
    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Custom Fee tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Custom Fee tab.
     */
    public static function add_settings_tab( $settings_tabs ) {
        $settings_tabs['settings_wacf'] = __( 'Custom Fee', 'wacf' );
        return $settings_tabs;
    }
    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields( self::get_settings() );
    }
    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options( self::get_settings() );
    }
    /**
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {

        $settings = array(
            'section_title' => array(
                'name'     => __( 'Woo Add Custom Fee', 'wacf' ),
                'type'     => 'title',
                'desc'     => '',
                'id'       => 'wdvc_tab_demo_section_title',
                'desc_tip' => true,
            ),

            'enable' => array(
                'name'     => __( 'Enable ', 'wacf' ),
                'type' => 'checkbox',
                'desc'     => __( '', 'wacf' ),
                'id'       => 'wacf_enable',
                'desc_tip' => true,
            ),

            'label' => array(
                'name'     => __( 'Custom Fee Label', 'wacf' ),
                'type' => 'text',
                'desc'     => __( 'Enter text for Custom Fee label', 'wacf' ),
                'id'       => 'wacf_fee_label',
                'desc_tip' => true,
            ),

            'charges' => array(
                'name'     => __( 'Custom Fee charges', 'wacf' ),
                'type' => 'text',
                'desc'     => __( 'Enter amount for Custom Fee charges', 'wacf' ),
                'id'       => 'wacf_fee_charges',
                'desc_tip' => true,
            ),

            'taxable' => array(
                'name'     => __( 'Taxable', 'wacf' ),
                'type'     => 'select',
                'desc'     => __( 'Check this box if would like to add tax to Custom Fee', 'wacf' ),
                'id'       => 'wacf_taxable',
                'desc_tip' => true,
                'options'  => array(
                    true => 'Yes',
                    false => 'No',
                ),
            ),


            'tax_class' => array(
                'name'     => __( 'Tax Class', 'wacf' ),
                'type'     => 'select',
                'desc'     => __( 'Select Tax Class if tax is enabled', 'wacf' ),
                'id'       => 'wacf_tax_class',
                'desc_tip' => true,
                'options'  => self::get_tax_options(),
            ),
            'enable_min' => array(
                'name'     => __( 'Use Minimum threshold value ', 'wacf' ),
                'type' => 'checkbox',
                'desc'     => __( '', 'wacf' ),
                'id'       => 'wacf_enable_min',
                'desc_tip' => true,
            ),
            'minimum' => array(
                'name'     => __( 'Minimum Cart Amount', 'wacf' ),
                'type' => 'text',
                'desc'     => __( 'Set Minimum total cart amount on which you would like to apply Custom Fee', 'wacf' ),
                'id'       => 'wacf_minimum',
                'desc_tip' => true,
            ),
            'enable_max' => array(
                'name'     => __( 'Use Maximum threshold value ', 'wacf' ),
                'type' => 'checkbox',
                'desc'     => __( '', 'wacf' ),
                'id'       => 'wacf_enable_max',
                'desc_tip' => true,
            ),
            'maximum' => array(
                'name'     => __( 'Maximum  Cart Amount', 'wacf' ),
                'type' => 'text',
                'desc'     => __( 'Set Maximum total cart amount on which you would like to apply Custom Fee', 'wacf' ),
                'id'       => 'wacf_maximum',
                'desc_tip' => true,
            ),

            // TODO - Add multiselect option to apply to only selected products

            'section_end' => array(
                 'type' => 'sectionend',
                 'id' => 'wacf_section_end',
            )
        );

        return apply_filters( 'wc_settings_wdvc_settings', $settings );
    }

    public static function get_tax_options() {

        $tax_options = array();
        $tax_classes = WC_Tax::get_tax_classes();
        foreach($tax_classes as $tax_class)
            $tax_options[$tax_class] = $tax_class;

        return $tax_options;

    }
}


WACF_Settings::init();