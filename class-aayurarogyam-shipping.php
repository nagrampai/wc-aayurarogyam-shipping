<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class WC_Aayurarogyam_Shipping extends WC_Shipping_Method {

    public $cost;
    
    public function __construct( $instance_id = 0 ) {
        $this->id                  = 'wc_aayurarogyam_shipping';
        $this->instance_id         = absint( $instance_id );
        $this->method_title        = __( 'Aayurarogyam Shipping', 'wc-aayurarogyam-shipping' );
        $this->method_description  = __( 'Custom Shipping Methods for Aayurarogyam', 'wc-aayurarogyam-shipping' );
        $this->supports            = array(
            'shipping-zones',
            'instance-settings',
            'instance-settings-modal',
        );
        
        
        $this->init();
        add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
    }

    public function init() {
        $this->instance_form_fields = array(
            'enabled' => array(
                'title'   => __( 'Enable/Disable', 'wc-aayurarogyam-shipping' ),
                'type'    => 'checkbox',
                'label'   => __( 'Enable this shipping method', 'wc-aayurarogyam-shipping' ),
                'default' => 'yes',
            ),
            'title'   => array(
                'title'       => __( 'Method Title', 'wc-aayurarogyam-shipping' ),
                'type'        => 'text',
                'description' => __( 'This controls the title which the user sees during checkout.', 'wc-aayurarogyam-shipping' ),
                'default'     => __( 'Aayurarogyam Shipping', 'wc-aayurarogyam-shipping' ),
                'desc_tip'    => true,
            ),
            'cost'    => array(
                'title'       => __( 'Cost', 'wc-aayurarogyam-shipping' ),
                'type'        => 'text',
                'placeholder' => '',
                'description' => __( 'Cost of shipping', 'wc-aayurarogyam-shipping' ),
                'default'     => '50',
                'desc_tip'    => true,
            ),
        );

        $this->title = $this->get_option( 'title' );
        $this->cost  = $this->get_option( 'cost' );
        $this->enabled = $this->get_option( 'enabled' );    
    }

    public function calculate_shipping( $package = array() ) {
        $rate = array(
            'id'      => $this->id,
            'label'   => $this->title,
            'cost'    => $this->cost,
            'package' => $package,
        );

        $this->add_rate( $rate );
    }
}

