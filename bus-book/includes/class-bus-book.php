<?php
/**
 * The core Bus_Book class.
 *
 * This is used to define public-facing, admin-specific hooks, and
 *  internationalization site hooks.
 *
 * @package    Bus_Book
 * @subpackage Bus_Book/includes
 */
class Bus_Book {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the Bus_Book.
	 *
	 * @access   protected
	 * @var      Bus_Book_Loader    $loader    Maintains and registers all hooks for the Bus_Book.
	 */
	protected $loader;

	/**
	 * The unique identifier of the Bus_Book.
	 *
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify the Bus_Book.
	 */
	protected $plugin_name;

	/**
	 * The current version of the Bus_Book.
	 *
	 * @access   protected
	 * @var      string    $version    The current version of the Bus_Book.
	 */
	protected $version;

	/**
	 * Define the core functionality of the Bus_Book.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 */
	public function __construct() {
		if ( defined( 'BUS_BOOK_VERSION' ) ) {
			$this->version = BUS_BOOK_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'bus-book';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_shortcodes_hooks();

	}

	/**
	 * Load the required dependencies for the Bus_Book.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core Bus_Book.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bus-book-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the Bus_Book.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bus-book-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bus-book-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-bus-book-public.php';

		/**
		 * The class responsible for creating shortcodes
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bus-book-shortcodes.php';
		

		$this->loader = new Bus_Book_Loader();

	}

	/**
	 * Define the locale for the plugin for internationalization.
	 *
	 * Uses the Bus_Book_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Bus_Book_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Bus_Book_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Bus_Book_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_post_bus_book_action',  $plugin_public, 'bus_book_action_hook_function'); //logged in
		$this->loader->add_action( 'admin_post_nopriv_bus_book_action', $plugin_public, 'bus_book_action_hook_function' ); //not logged in
		$this->loader->add_action( 'template_notices', $plugin_public, 'bus_booking_action_template_notices'); 

	}

	/**
	 * Register all of the hooks related to the shortcodes functionality
	 * of the Bus_Book.
	 *
	 * @access   private
	 */
	private function define_shortcodes_hooks() {

		$plugin_shortcode = new Bus_Book_Shortcodes( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_shortcode, 'init' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin Bus_Book.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the Bus_Book.
	 *
	 * @return    Bus_Book_Loader    Orchestrates the hooks of the Bus_Book.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the Bus_Book.
	 *
	 * @return    string    The version number of the Bus_Book.
	 */
	public function get_version() {
		return $this->version;
	}

}
