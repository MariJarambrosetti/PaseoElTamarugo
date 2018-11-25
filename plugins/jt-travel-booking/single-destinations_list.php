<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package A+
 */

  $translate = get_option('jt_travel_booking_translations');
  include ( dirname( __FILE__ ) . '/options/variables.php');
  include ( dirname( __FILE__ ) . '/options/strings.php');

  //response generation function
  $response = "";
 
  //function to generate response
  function book_trip_form_generate_response($type, $message){
 
    global $response;
 
    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";
 
  }

	//response messages
	$missing_content = __("Please supply all information.", 'jt-travel-booking');
	$email_invalid   = __("Email Address Invalid.", 'jt-travel-booking');
	$message_unsent  = __("Message was not sent. Try Again.", 'jt-travel-booking');
	$message_sent    = __("Thanks! Your message has been sent.", 'jt-travel-booking');

	//user posted variables
	$destination = $_POST['booking_destination'];
	$price = $_POST['booking_price'];
	$first_name = $_POST['booking_first_name'];
	$last_name = $_POST['booking_last_name'];
	$email = $_POST['booking_email'];
	$phone_number = $_POST['booking_phone_number'];
	$persons = $_POST['booking_persons'];
	$departure = $_POST['booking_departure'];
	$comments = $_POST['booking_additional_comments'];
	$submit = $_POST['booking_submit'];

	//php mailer variables
	
	$subject = $travel_new_booking_for_text . " " . $destination . " " . $travel_from_text . " " .get_bloginfo('name');
	$headers[] = 'From: '. $email . "\r\n";
	$headers[] = 'Reply-To: ' . $email . "\r\n";

	if ($submit) {
		
		$post_information = array(
			'post_title' => wp_strip_all_tags( $_POST['booking_first_name'] . ' ' . $_POST['booking_last_name']  . ' - ' . $_POST['booking_destination'] ),
			'post_type' => 'destinations_booking',
			'post_status' => 'pending',
		);

		$post_id = wp_insert_post( $post_information );
		add_post_meta( $post_id, 'destination', esc_attr($destination), true );
		add_post_meta( $post_id, 'price', esc_attr($price), true );
		add_post_meta( $post_id, 'first_name', esc_attr($first_name), true );
		add_post_meta( $post_id, 'last_name', esc_attr($last_name), true );
		add_post_meta( $post_id, 'email', esc_attr($email), true );
		add_post_meta( $post_id, 'phone_number', esc_attr($phone_number), true );
		add_post_meta( $post_id, 'persons', esc_attr($persons), true );
		add_post_meta( $post_id, 'departure', esc_attr($departure), true );
		add_post_meta( $post_id, 'additional_comments', esc_attr($comments), true );
		
		$bookings = get_option( 'jt_travel_booking_bookings' );
		$to = $bookings[jt_travel_booking_email_notification_address];
		
		if ($bookings[jt_travel_booking_email_notification] == 1) {
			//validate presence of fields
			if(empty($first_name) || empty($last_name) || empty($phone_number) || empty($persons) || empty($comments)){
				book_trip_form_generate_response("error", $missing_content);
			}
			else {
				$message = $travel_destination_text . ": " . $destination . "\r\n\r\nName: " . $first_name . " " . $last_name . " \r\n" . $travel_email_text . ": " . $email . " \r\n" . $travel_phone_number_text . ": " . $phone_number . " \r\n" . $travel_number_of_persons_text . ": " . $persons . "\r\n" . $travel_departure_text. ": " . $departure . " \r\n\r\n" . $travel_comments_text . ": \r\n" . $comments; 
				$sent = wp_mail($to, $subject, strip_tags($message), $headers);
				if($sent) {
					book_trip_form_generate_response("success", $message_sent); //message sent!
				}
				else {
					book_trip_form_generate_response("error", $message_unsent); //message wasn't sent
				}
			}
		}
		if ($bookings[jt_travel_booking_notify_customers] == 1) {
			$subject = $travel_received_booking_text . " - " .get_bloginfo('name');
			$headers[] = 'From: '. $to . "\r\n";
			$headers[] = 'Reply-To: ' . $to . "\r\n";
			
			if (!empty ($bookings[jt_travel_booking_email_message])) {
				$customer_message = $bookings[jt_travel_booking_email_message];
			}
			else {
				$customer_message = $travel_received_booking_for_text . " " . $destination . ". " . $travel_confirmation_message_text;
			}
			$sent = wp_mail($email, $subject, strip_tags($customer_message), $headers);
		}
		echo "<script type='text/javascript'>
        	window.location=document.location.href;
		</script>";
	}

get_header(); ?>

		<?php
			$options = get_option( 'jt_travel_booking_settings' );
			define('jt_travel_booking_single_page_style', 'jt_travel_booking_single_page_style'); 
			
			if ($options[jt_travel_booking_single_page_style] == '1') {
				include ( plugin_dir_path( __FILE__ ) . '/pages/style-1.php');
			}
			else if ($options[jt_travel_booking_single_page_style] == '2') {
				include ( plugin_dir_path( __FILE__ ) . '/pages/style-2.php');
			}
			else if ($options[jt_travel_booking_single_page_style] == '3') {
				include ( plugin_dir_path( __FILE__ ) . '/pages/style-3.php');
			}
			else if ($options[jt_travel_booking_single_page_style] == '4') {
				include ( plugin_dir_path( __FILE__ ) . '/pages/style-4.php');
			}
			else {
				include ( plugin_dir_path( __FILE__ ) . '/pages/style-3.php');
			}
		?>
		
<?php
get_footer();
