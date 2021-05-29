<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for the Bus_Book
 * so that it is ready for translation.
 *
 * @package    Bus_Book
 * @subpackage Bus_Book/includes
 */
class Bus_Book_i18n {


	/**
	 * Load the Bus_Book text domain for translation.
	 *
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bus-book',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
