<?php
/**
 * Shortcodes
 *
 * @package    Bus_Book
 * @subpackage Bus_Book/includes
 */

defined( 'ABSPATH' ) || exit;

/**
 * Bus Book Shortcodes class.
 */
class Bus_Book_Shortcodes {

	/**
	 * Init shortcodes.
	 */
	public static function init() {		
		add_shortcode( 'bus_book_form', __CLASS__ . '::shortcode_wrapper' );
	}

	/**
	 * Shortcode Wrapper.
	 *
	 * @return string
	 */
	public static function shortcode_wrapper() {
		ob_start();

		echo '<div>';
		self::get_form();
		echo '</div>';

		return ob_get_clean();
	}

	/**
	 * get the form.
	 *
	 */
	public static function get_form() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/bus-book-public-display.php';
	}

}