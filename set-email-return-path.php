<?php
/**
 * Plugin Name:         Set Email Return-Path
 * Description:         Sets the Return-Path header of outgoing emails to the from email address. This helps solve issues when emails are sent from your hosts domain or IP address, and makes it look like your emails are spam.
 * Version:             1.0.0
 * License:             GPLv3+
 * Requires at least:   5.0
 * Requires PHP:        7.0
 * Author:              James Hunt
 * Author URI:          https://www.thetwopercent.co.uk
 **/

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

// Load.
add_action( 'plugins_loaded', array( 'Set_Email_Return_Path', 'init' ), 1 );

 /**
  * Set Email Return Path
  *
  * @since 1.0.0
  */
class Set_Email_Return_Path {

	/**
	 * Instance of the class
	 *
	 * @static
	 * @access protected
	 * @var object
	 */
	protected static $instance;

	/**
	 * Instantiates the class.
	 *
	 * @return object $instance
	 */
	public static function init() {
		is_null( self::$instance ) && self::$instance = new self();
		return self::$instance;
	}

	/**
	 * Add to PHP mailer.
	 */
	public function __construct() {
		add_action( 'phpmailer_init', array( $this, 'set_from' ) );
	}
	/**
	 * Change the sender.
	 *
	 * @param array $phpmailer PHP Mailer options.
	 */
	public function set_from( $phpmailer ) {
		$phpmailer->Sender = $phpmailer->From; //phpcs:ignore
	}
}
