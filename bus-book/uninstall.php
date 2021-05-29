<?php
/**
 * Bus_Book Uninstall
 *
 * Uninstalling Bus_Book deletes tables, and options.
 *
 * @package Bus_Book
 * @version 1.0.0
 */

// If uninstall not called from WordPress, then exit.
defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

function wp_bus_book_delete_plugin() {
	global $wpdb;

	delete_option( 'bus_book_db_version');

	$wpdb->query( sprintf( "DROP TABLE IF EXISTS %s",
		$wpdb->prefix . 'bus_book' ) );
}

wp_bus_book_delete_plugin();