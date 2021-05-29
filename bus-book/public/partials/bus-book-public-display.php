<?php
/**
 * Provide a public-facing view
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package    Bus_Book
 * @subpackage Bus_Book/public/partials
 */

global $wpdb;

$get_today_record = $wpdb->get_results(
	"SELECT * FROM {$wpdb->prefix}bus_book WHERE date(created_at) = CURDATE()"
);
$count = count($get_today_record);
$booked = true;
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h2>Bus ticket booking</h2>
<br>
<?php //do_action( 'bus_booking_action_template_notices');
	if(isset( $_SESSION['message'])){
    echo $_SESSION['message'];
    unset( $_SESSION['message']);
	}
?>
<form id="bus_booking_form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
	<table width="200" border="1">
	<?php for($i =1; $i<=35; $i++){
		$disabled_checked = '';
		if($count && $get_today_record[0]->{'seat_'.$i}){
			$disabled_checked = 'checked disabled';
		} else {
			$booked = false;
		}		
		if (($i-1) == 0) echo '<tr>';
    	if (($i-1) % 3 == 0) echo '</tr><tr>';
	?>
	<td align="center">
  	<input type="checkbox" class="bus_seat_box" id="seat<?php echo $i; ?>" name="seat[<?php echo $i; ?>]" value="<?php echo $i; ?>" <?php echo $disabled_checked;?> >
 	 <label for="seat<?php echo $i; ?>"> Bus Seat <?php echo $i; ?></label>
 	 </td>
	<?php } ?>
	</table>
	<input type="hidden" name="action" value="bus_book_action"><br>
	<?php if($booked){ ?>
		<div class="wp-block-button"><a class="wp-block-button__link" disabled>Fully Booked. Today Booking Closed.</a></div>
	<?php } else { ?>
  		<input  type="submit" value="Submit" >
	<?php } ?>
</form>
