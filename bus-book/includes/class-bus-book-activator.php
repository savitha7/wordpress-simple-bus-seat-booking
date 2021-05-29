<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    Bus_Book
 * @subpackage Bus_Book/includes
 */

class Bus_Book_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 */
	public static function activate() {

		global $wpdb;

		$table_name = $wpdb->prefix . 'bus_book';
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
			seat_1 tinyint(1) NOT NULL DEFAULT '0',
			seat_2 tinyint(1) NOT NULL DEFAULT '0',
			seat_3 tinyint(1) NOT NULL DEFAULT '0',
			seat_4 tinyint(1) NOT NULL DEFAULT '0',
			seat_5 tinyint(1) NOT NULL DEFAULT '0',
			seat_6 tinyint(1) NOT NULL DEFAULT '0',
			seat_7 tinyint(1) NOT NULL DEFAULT '0',
			seat_8 tinyint(1) NOT NULL DEFAULT '0',
			seat_9 tinyint(1) NOT NULL DEFAULT '0',
			seat_10 tinyint(1) NOT NULL DEFAULT '0',
			seat_11 tinyint(1) NOT NULL DEFAULT '0',
			seat_12 tinyint(1) NOT NULL DEFAULT '0',
			seat_13 tinyint(1) NOT NULL DEFAULT '0',
			seat_14 tinyint(1) NOT NULL DEFAULT '0',
			seat_15 tinyint(1) NOT NULL DEFAULT '0',
			seat_16 tinyint(1) NOT NULL DEFAULT '0',
			seat_17 tinyint(1) NOT NULL DEFAULT '0',
			seat_18 tinyint(1) NOT NULL DEFAULT '0',
			seat_19 tinyint(1) NOT NULL DEFAULT '0',
			seat_20 tinyint(1) NOT NULL DEFAULT '0',
			seat_21 tinyint(1) NOT NULL DEFAULT '0',
			seat_22 tinyint(1) NOT NULL DEFAULT '0',
			seat_23 tinyint(1) NOT NULL DEFAULT '0',
			seat_24 tinyint(1) NOT NULL DEFAULT '0',
			seat_25 tinyint(1) NOT NULL DEFAULT '0',
			seat_26 tinyint(1) NOT NULL DEFAULT '0',
			seat_27 tinyint(1) NOT NULL DEFAULT '0',
			seat_28 tinyint(1) NOT NULL DEFAULT '0',
			seat_29 tinyint(1) NOT NULL DEFAULT '0',
			seat_30 tinyint(1) NOT NULL DEFAULT '0',
			seat_31 tinyint(1) NOT NULL DEFAULT '0',
			seat_32 tinyint(1) NOT NULL DEFAULT '0',
			seat_33 tinyint(1) NOT NULL DEFAULT '0',
			seat_34 tinyint(1) NOT NULL DEFAULT '0',
			seat_35 tinyint(1) NOT NULL DEFAULT '0',
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  			updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		add_option( 'bus_book_db_version', BUS_BOOK_VERSION);

	}

}
