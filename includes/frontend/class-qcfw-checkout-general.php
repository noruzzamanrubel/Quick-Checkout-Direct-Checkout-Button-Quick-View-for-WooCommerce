<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-general-setting.php';


class Qcfw_Checkout_General {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
     * Register plugin frontend.
     */
	public function register_qcfw_checkout_general(){
		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'qcwf_add_to_cart_redirect' ) );
	}

	/**
	 * Add to cart redirect
	 */
	public function qcwf_add_to_cart_redirect() {
		//Buy now button redirect
		if(isset($_POST['qcfw_checkout']) || isset($_GET['qcfw_checkout'])){
			$redirect_link = Qcfw_Checkout_Buy_Now::qcwf_checkout_shop_buy_now_btn_redirect();
			return $redirect_link;
		}

		//Global Redirect
		$redirect_url = get_option( 'qcwf_checkout_general_cart_redirect_url', 'checkout' );
		switch ( $redirect_url ) {
			case 'cart':
				return wc_get_cart_url();
			case 'checkout':
				return wc_get_checkout_url();
			default:
				return wc_get_checkout_url();
		}
	}

	/**
	 * Instance
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

}