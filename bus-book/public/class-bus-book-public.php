<?php
/**
 * The public-facing functionality of the Bus_Book.
 *
 * Defines the plugin name, version, and hooks like to
 * enqueue the public-facing stylesheet, JavaScript etc.
 *
 * @package    Bus_Book
 * @subpackage Bus_Book/public
 */
class Bus_Book_Public {

	/**
	 * The ID of Bus_Book.
	 *
	 * @access   private
	 * @var      string    $plugin_name    The ID of Bus_Book.
	 */
	private $plugin_name;

	/**
	 * The version of Bus_Book.
	 *
	 * @access   private
	 * @var      string    $version    The current version of Bus_Book.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of the plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bus-book-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bus-book-public.js', array( 'jquery' ), $this->version, false );

	}

	
	/**
	 * Action function for bus booking 
	 *
	 * @return void
	 */
	public function bus_book_action_hook_function() {
		if($_POST && isset($_POST['seat'])) {
	        $seats = array_map(function($val) { return 'seat_'.$val;} , $_POST['seat']);

		    $this->update_bus_booking($seats);do_action( 'template_notices');
		    session_start();
    		$_SESSION['message'] = __( 'Thank you. Your booking has been confirmed.' );
		    //wp_safe_redirect($_SERVER['HTTP_REFERER']);
		    header("Location: ".$_SERVER['HTTP_REFERER']);
		    exit;
		}
	}	

	/**
	 * Update bus booking 
	 *
	 * @param  array $postData  The post data.
	 * @return void
	 */
	public function update_bus_booking($postData=[]) {

		global $wpdb;
		$table_bus_book = $wpdb->prefix . 'bus_book';

		$get_today_record = $wpdb->get_results(
			"SELECT * FROM {$table_bus_book} WHERE date(created_at) = CURDATE()"
		);

		if(count($get_today_record)){
			$id = $get_today_record[0]->id;
			$set = implode( '=1, ', $postData ).'=1';
			$wpdb->query(
				$wpdb->prepare(
					"UPDATE {$table_bus_book}
					SET  {$set}
					WHERE date(created_at) = CURDATE()
					AND id = %d",
					$id
				)
			);
		} else {
			$wpdb->query(
				$wpdb->prepare(
					"INSERT INTO {$table_bus_book} (". implode( ', ', $postData ) .")
					VALUES (" . implode(',', array_fill(0, count($postData), 1)).")"
				)
			);
		}
	}

	/**
	 * Booking action template notices
	 *
	 * @return void
	 */
	public function bus_booking_action_template_notices() {
		echo 'Thank you. Your booking has been confirmed.';
	}

}
