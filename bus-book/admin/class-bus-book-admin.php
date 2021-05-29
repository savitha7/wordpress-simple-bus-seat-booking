<?php
/**
 * The admin-specific functionality of the Bus_Book.
 *
 * Defines the plugin name, version, and hooks like to
 * enqueue the admin-specific stylesheet, JavaScript etc.
 *
 * @package    Bus_Book
 * @subpackage Bus_Book/admin
 */
class Bus_Book_Admin {

	/**
	 * The ID of the Bus_Book.
	 *
	 * @access   private
	 * @var      string    $plugin_name    The ID of the Bus_Book.
	 */
	private $plugin_name;

	/**
	 * The version of the Bus_Book.
	 *
	 * @access   private
	 * @var      string    $version    The current version of the Bus_Book.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param      string    $plugin_name       The name of the Bus_Book.
	 * @param      string    $version    The version of the Bus_Book.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bus-book-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bus-book-admin.js', array( 'jquery' ), $this->version, false );

	}

}
