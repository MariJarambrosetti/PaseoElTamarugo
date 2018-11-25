<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header(); 

$option = get_option('jt_settings');
$translations = get_option('jt_event_translations');
$registration = get_option('jt_event_registration');

include ( dirname( __FILE__ ) . '/settings/variables.php');

$event_title = (isset($_POST['event_title']) ? $_POST['event_title'] : null);
$firstname = (isset($_POST['first_name']) ? $_POST['first_name'] : null);
$lastname = (isset($_POST['last_name']) ? $_POST['last_name'] : null);
$email = (isset($_POST['email']) ? $_POST['email'] : null);
$phone = (isset($_POST['phone_number']) ? $_POST['phone_number'] : null);
$persons = (isset($_POST['num_of_persons']) ? $_POST['num_of_persons'] : null);
$day = (isset($_POST['event_day']) ? $_POST['event_day'] : null);
$time = (isset($_POST['event_hour']) ? $_POST['event_hour'] : null);
$seats = (isset($_POST['event_seats']) ? $_POST['event_seats'] : null);
$id = (isset($_POST['event_id']) ? $_POST['event_id'] : null);
$submit = (isset($_POST['submit']) ? $_POST['submit'] : null);

if ($submit) {
	
	$post_information = array(
		'post_title' => wp_strip_all_tags( $_POST['first_name'] . ' ' . $_POST['last_name']  . ' - ' . $_POST['event_title'] ),
		'post_type' => 'event_registrations',
		'post_status' => 'pending',
	);

	$post_id = wp_insert_post( $post_information );
	
	$new_seats = $seats - $persons;
	$update_seats = update_post_meta( $id, 'event_available_seats', $new_seats );
	
	if ($registration[email_notification] == 1) {
		$to = $registration[recipient_email];
		$subject = "New registration: " . $event_title;
		$headers[] = 'From: '. $email . "\r\n";
		$headers[] = 'Reply-To: ' . $email . "\r\n";

		$message = "Event: " . $event_title . "\r\n\r\nName: " . $firstname . " " . $lastname . " \r\nEmail: " . $email . " \r\nPhone Number: " . $phone . " \r\nNumber of persons: " . $persons . "\r\nDay: " . $day . " \r\nTime: " . $time; 
		$sent = wp_mail($to, $subject, strip_tags($message), $headers);
	}
}
?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php

				while ( have_posts() ) : the_post();
					$post_id = get_the_ID();

					if ($option[event_page_style] == 'style-1') {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-1.php');
					}
					else if ($option[event_page_style] == 'style-2') {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-2.php');
					}
					else if ($option[event_page_style] == 'style-3') {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-3.php');
					}
					else if ($option[event_page_style] == 'style-4') {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-4.php');
					}
					else if ($option[event_page_style] == 'style-5') {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-5.php');
					}
					else {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-1.php');
					}

				endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

<?php
get_footer();
