<?php
/**
Plugin Name: WC Checkout Custom Billing Phone Field
Plugin URI: https://github.com/FunkeMakanjuola/WC-Checkout-Custom-Billing-Phone-Field
Description: Plugin will customize WooCommerce checkout phone field
Version: 1.0.0
Author: Funke Makanjuola
Author URI:
License: GPLv2

WC CHECKOUT CUSTOM BILLING PHONE FIELD
Copyright (C) 2018, https://github.com/FunkeMakanjuola/WC-Checkout-Custom-Billing-Phone-Field
*/

//register javascripts

add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );
function wpb_adding_scripts()
{
    wp_register_script('jQuery', 'https://code.jquery.com/jquery-1.7.1.min.js', array('jquery'), '1.7.1', true);
    wp_enqueue_script('jQuery');
    wp_register_script('maskedinput', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js', array('jquery'), '1.4.1', true);
    wp_enqueue_script('maskedinput');
    wp_register_script('maskphone', plugins_url('assets/js/maskphone.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_script('maskphone');
}

//Validate  phone number
add_action('woocommerce_checkout_process', 'wc_validate_billing_phone_number');
function wc_validate_billing_phone_number()
{
    $is_correct = preg_match('/^(\+1[\(]{1}[0-9]{3}[\)]{1}[ |\-]{0,1}|^[0-9]{3}[\-| ])?[0-9]{3}(\-| ){1}[0-9]{4}$/', $_POST['billing_phone']);
    if ($_POST['billing_phone'] && !$is_correct) {
        wc_add_notice(__('Valid phone number format is  +1(xxx) xxx-xxxx'), 'error');
    }
}

//add placeholder
add_filter( 'woocommerce_billing_fields', 'wc_phone_placeholder', 10, 1 );
function wc_phone_placeholder( $address_fields ) {
    $address_fields['billing_phone']['placeholder'] = '+1(xxx) xxx-xxxx';
    return $address_fields;


}


