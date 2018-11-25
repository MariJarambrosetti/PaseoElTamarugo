<?php
	get_header();

	$option = get_option('jt_travel_booking_settings');
	include ( dirname( __FILE__ ) . '/options/variables.php');
	include ( dirname( __FILE__ ) . '/options/strings.php');

	if ($option[jt_travel_booking_archive_style] == '1') {
		include ( plugin_dir_path( __FILE__ ) . '/styles/archive/style-1.php');
	}
	else if ($option[jt_travel_booking_archive_style] == '2') {
		include ( plugin_dir_path( __FILE__ ) . '/styles/archive/style-2.php');
	}

	get_footer();
?>