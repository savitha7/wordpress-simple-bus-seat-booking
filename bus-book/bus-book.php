<?php
/**
 * Plugin Name:     Bus Book
 * Plugin URI:      http://example.com
 * Description:     Wordpress bus booking plugin
 * Author:          Savitha Rohin K
 * Author URI:      http://example.com
 * Text Domain:     bus-book
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Bus_Book
 */

defined( 'ABSPATH' ) || exit;

/**
 * plugin version.
 */
define( 'BUS_BOOK_VERSION', '1.0.0' );


if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
	define( 'WC_PLUGIN_FILE', __FILE__ );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bus-book-activator.php
 */
function activate_bus_book() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bus-book-activator.php';
	Bus_Book_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bus-book-deactivator.php
 */
function deactivate_bus_book() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bus-book-deactivator.php';
	Bus_Book_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bus_book' );
register_deactivation_hook( __FILE__, 'deactivate_bus_book' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bus-book.php';

/**
 * Begins execution of the plugin.
 */
function run_bus_book() {

	$bus_book = new Bus_Book();
	$bus_book->run();

}
run_bus_book();