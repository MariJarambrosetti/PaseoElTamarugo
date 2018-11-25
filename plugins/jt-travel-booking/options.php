<?php
add_action( 'admin_menu', 'jt_travel_booking_add_admin_menu' );
add_action( 'admin_init', 'jt_travel_booking_settings_init' );


function jt_travel_booking_add_admin_menu(  ) { 

	add_submenu_page( 'edit.php?post_type=destinations_list', 'JT Travel Booking', 'Settings', 'manage_options', 'jt_travel_booking', 'jt_travel_booking_options_page' );

}


function jt_travel_booking_settings_init(  ) { 

	register_setting( 'travelBookingSettings', 'jt_travel_booking_settings' );
	register_setting( 'travelBookingTranslations', 'jt_travel_booking_translations' );
	register_setting( 'travelBookingAgency', 'jt_travel_booking_agency' );
	register_setting( 'travelBookingColors', 'jt_travel_booking_colors' );
	register_setting( 'travelBookingBookings', 'jt_travel_booking_bookings' );
	register_setting( 'travelBookingSupport', 'jt_travel_booking_support' );
	register_setting( 'travelBookingInfo', 'jt_travel_booking_info' );

	add_settings_section(
		'jt_travel_booking_travelBookingSettings_section', 
		__( 'General Options', 'jt-travel-booking' ), 
		'jt_travel_booking_settings_section_callback', 
		'travelBookingSettings'
	);
	
	add_settings_section(
		'jt_travel_booking_travelBookingAgency_section', 
		__( 'Agency Info', 'jt-travel-booking' ), 
		'jt_travel_booking_agency_section_callback', 
		'travelBookingAgency'
	);
	
	add_settings_section(
		'jt_travel_booking_travelBookingTranslations_section', 
		__( 'Translations', 'jt-travel-booking' ), 
		'jt_travel_booking_translations_section_callback', 
		'travelBookingTranslations'
	);
	add_settings_section(
		'jt_travel_booking_travelBookingBookings_section', 
		__( 'Bookings', 'jt-travel-booking' ), 
		'jt_travel_booking_bookings_section_callback', 
		'travelBookingBookings'
	);
	add_settings_section(
		'jt_travel_booking_travelBookingColors_section', 
		__( 'Colors', 'jt-travel-booking' ), 
		'jt_travel_booking_colors_section_callback', 
		'travelBookingColors'
	);
	
	add_settings_section(
		'jt_travel_booking_travelBookingSupport_section', 
		__( 'Support & FAQs', 'jt-travel-booking' ), 
		'jt_travel_booking_support_section_callback', 
		'travelBookingSupport'
	);
	
	add_settings_section(
		'jt_travel_booking_travelBookingInfo_section', 
		__( 'Info', 'jt-travel-booking' ), 
		'jt_travel_booking_info_section_callback', 
		'travelBookingInfo'
	);


	add_settings_field( 
		'jt_travel_booking_single_page_style', 
		__( 'Single Page Style', 'jt-travel-booking' ), 
		'jt_travel_booking_single_page_style_render', 
		'travelBookingSettings', 
		'jt_travel_booking_travelBookingSettings_section' 
	);
	add_settings_field( 
		'jt_travel_booking_archive_style', 
		__( 'Archive Style', 'jt-travel-booking' ), 
		'jt_travel_booking_archive_style_render', 
		'travelBookingSettings', 
		'jt_travel_booking_travelBookingSettings_section' 
	);
	add_settings_field( 
		'destinations_slug', 
		__( 'Slug for "destinations_list"', 'jt-travel-booking' ), 
		'destinations_slug_render', 
		'travelBookingSettings', 
		'jt_travel_booking_travelBookingSettings_section' 
	);
	add_settings_field( 
		'destinations_cat_slug', 
		__( 'Slug for "destinations_categories"', 'jt-travel-booking' ), 
		'destinations_cat_slug_render', 
		'travelBookingSettings', 
		'jt_travel_booking_travelBookingSettings_section' 
	);
	
	add_settings_field( 
		'jt_travel_booking_agency_info', 
		__( 'Agency Info', 'jt-travel-booking' ), 
		'jt_travel_booking_agency_info_render', 
		'travelBookingAgency', 
		'jt_travel_booking_travelBookingAgency_section' 
	);
	
	add_settings_field( 
		'jt_travel_booking_email_notification', 
		__( 'Email Notifications', 'jt-travel-booking' ), 
		'jt_travel_booking_email_notification_render', 
		'travelBookingBookings', 
		'jt_travel_booking_travelBookingBookings_section' 
	);
	add_settings_field( 
		'jt_travel_booking_email_notification_address', 
		__( 'Send notifications to', 'jt-travel-booking' ), 
		'jt_travel_booking_email_notification_address_render', 
		'travelBookingBookings', 
		'jt_travel_booking_travelBookingBookings_section' 
	);
	add_settings_field( 
		'jt_travel_booking_notify_customers', 
		__( 'Notify Users/Customers', 'jt-travel-booking' ), 
		'jt_travel_booking_notify_customers_render', 
		'travelBookingBookings', 
		'jt_travel_booking_travelBookingBookings_section' 
	);
	add_settings_field( 
		'jt_travel_booking_email_message', 
		__( 'Message', 'jt-travel-booking' ), 
		'jt_travel_booking_email_message_render', 
		'travelBookingBookings', 
		'jt_travel_booking_travelBookingBookings_section' 
	);
	
	add_settings_field( 
		'travel_destination_text', 
		__( 'Destination', 'jt-travel-booking' ), 
		'travel_destination_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_price_text', 
		__( 'Price', 'jt-travel-booking' ), 
		'travel_price_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_periods_text', 
		__( 'Periods', 'jt-travel-booking' ), 
		'travel_periods_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_transportation_text', 
		__( 'Transportation', 'jt-travel-booking' ), 
		'travel_transportation_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_transportation_icon_text', 
		__( 'Transportation Icon', 'jt-travel-booking' ), 
		'travel_transportation_icon_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_days_text', 
		__( 'days', 'jt-travel-booking' ), 
		'travel_days_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_starts_from_text', 
		__( 'Starts from', 'jt-travel-booking' ), 
		'travel_starts_from_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_basic_info_text', 
		__( 'Basic Info', 'jt-travel-booking' ), 
		'travel_basic_info_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_short_info_text', 
		__( 'Short Info', 'jt-travel-booking' ), 
		'travel_short_info_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_info_text', 
		__( 'Info', 'jt-travel-booking' ), 
		'travel_info_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_daily_program_text', 
		__( 'Daily Program', 'jt-travel-booking' ), 
		'travel_daily_program_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_provisions_text', 
		__( 'Provisions', 'jt-travel-booking' ), 
		'travel_provisions_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_hotels_text', 
		__( 'Hotels', 'jt-travel-booking' ), 
		'travel_hotels_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_things_to_do_text', 
		__( 'Things to do', 'jt-travel-booking' ), 
		'travel_things_to_do_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_booking_info_text', 
		__( 'Booking Info', 'jt-travel-booking' ), 
		'travel_booking_info_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_media_text', 
		__( 'Media', 'jt-travel-booking' ), 
		'travel_media_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	add_settings_field( 
		'travel_upload_text', 
		__( 'Upload', 'jt-travel-booking' ), 
		'travel_upload_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_video_text', 
		__( 'Video', 'jt-travel-booking' ), 
		'travel_video_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_departures_text', 
		__( 'Departures', 'jt-travel-booking' ), 
		'travel_departures_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_photo_gallery_text', 
		__( 'Photo Gallery', 'jt-travel-booking' ), 
		'travel_photo_gallery_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_book_this_tour_text', 
		__( 'Book This Tour', 'jt-travel-booking' ), 
		'travel_book_this_tour_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_book_now_text', 
		__( 'Book now and we will contact you as soon as possible to confirm your booking.', 'jt-travel-booking' ), 
		'travel_book_now_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_first_name_text', 
		__( 'First Name', 'jt-travel-booking' ), 
		'travel_first_name_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_last_name_text', 
		__( 'Last Name', 'jt-travel-booking' ), 
		'travel_last_name_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_email_text', 
		__( 'Email.', 'jt-travel-booking' ), 
		'travel_email_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_phone_number_text', 
		__( 'Phone Number', 'jt-travel-booking' ), 
		'travel_phone_number_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_number_of_persons_text', 
		__( 'Number of Persons', 'jt-travel-booking' ), 
		'travel_number_of_persons_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_departure_text', 
		__( 'Departure', 'jt-travel-booking' ), 
		'travel_departure_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_comments_text', 
		__( 'Additional Comments', 'jt-travel-booking' ), 
		'travel_comments_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_book_now_btn_text', 
		__( 'Book Now', 'jt-travel-booking' ), 
		'travel_book_now_btn_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_more_info', 
		__( 'More Info', 'jt-travel-booking' ), 
		'travel_more_info_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_more_destinations', 
		__( 'More Destinations', 'jt-travel-booking' ), 
		'travel_more_destinations_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'agency_info_text', 
		__( 'Agency\'s Info', 'jt-travel-booking' ), 
		'agency_info_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'search_destinations_text', 
		__( 'Search Destinations', 'jt-travel-booking' ), 
		'search_destinations_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'number_of_days_text', 
		__( 'Number of days', 'jt-travel-booking' ), 
		'number_of_days_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'price_range_text', 
		__( 'Price Range', 'jt-travel-booking' ), 
		'price_range_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'search_text', 
		__( 'Search', 'jt-travel-booking' ), 
		'search_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'search_results_for_text', 
		__( 'Search Results for', 'jt-travel-booking' ), 
		'search_results_for_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'no_destinations_text', 
		__( 'No destinations', 'jt-travel-booking' ), 
		'no_destinations_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_new_booking_for_text', 
		__( 'New booking for', 'jt-travel-booking' ), 
		'travel_new_booking_for_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_from_text', 
		__( 'from', 'jt-travel-booking' ), 
		'travel_from_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_received_booking_text', 
		__( 'We received your booking', 'jt-travel-booking' ), 
		'travel_received_booking_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_received_booking_for_text', 
		__( 'We received your booking for', 'jt-travel-booking' ), 
		'travel_received_booking_for_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	add_settings_field( 
		'travel_confirmation_message_text', 
		__( 'We will contact you as soon as possible to confirm it.', 'jt-travel-booking' ), 
		'travel_confirmation_message_text_render', 
		'travelBookingTranslations', 
		'jt_travel_booking_travelBookingTranslations_section' 
	);
	
	
	add_settings_field( 
		'travel_booking_basic_color', 
		__( 'Basic Color', 'jt-travel-booking' ), 
		'travel_booking_basic_color_render', 
		'travelBookingColors', 
		'jt_travel_booking_travelBookingColors_section' 
	);


}


function jt_travel_booking_single_page_style_render(  ) { 

	$options = get_option( 'jt_travel_booking_settings' );
	?>
	<select name='jt_travel_booking_settings[jt_travel_booking_single_page_style]'>
		<option value='1' <?php selected( $options['jt_travel_booking_single_page_style'], 1 ); ?>>Style 1</option>
		<option value='2' <?php selected( $options['jt_travel_booking_single_page_style'], 2 ); ?>>Style 2</option>
		<option value='3' <?php selected( $options['jt_travel_booking_single_page_style'], 3 ); ?>>Style 3</option>
		<option value='4' <?php selected( $options['jt_travel_booking_single_page_style'], 4 ); ?>>Style 4</option>
	</select>

<?php

}
function jt_travel_booking_archive_style_render(  ) { 

	$options = get_option( 'jt_travel_booking_settings' );
	?>
	<select name='jt_travel_booking_settings[jt_travel_booking_archive_style]'>
		<option value='1' <?php selected( $options['jt_travel_booking_archive_style'], 1 ); ?>>Style 1</option>
		<option value='2' <?php selected( $options['jt_travel_booking_archive_style'], 2 ); ?>>Style 2</option>
	</select>

<?php

}

function destinations_slug_render(  ) { 

	$options = get_option( 'jt_travel_booking_settings' );
	?>
	<input type='text' name='jt_travel_booking_settings[destinations_slug]' value='<?php echo $options["destinations_slug"]; ?>' placeholder='destinations_list' />
	<?php

}
function destinations_cat_slug_render(  ) { 

	$options = get_option( 'jt_travel_booking_settings' );
	?>
	<input type='text' name='jt_travel_booking_settings[destinations_cat_slug]' value='<?php echo $options["destinations_cat_slug"]; ?>' placeholder='destinations_categories' />
	<?php

}

function jt_travel_booking_agency_info_render(  ) { 

	$options = get_option( 'jt_travel_booking_agency' );
	?>
	<textarea cols='80' rows='10' name='jt_travel_booking_agency[jt_travel_booking_agency_info]'> <?php echo $options["jt_travel_booking_agency_info"]; ?></textarea>

<?php

}

function jt_travel_booking_email_notification_render(  ) { 
	$options = get_option( 'jt_travel_booking_bookings' );
	?><label class="switch">
		<input type='checkbox' name='jt_travel_booking_bookings[jt_travel_booking_email_notification]' <?php checked( $options['jt_travel_booking_email_notification'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<p><?php echo __('Enable this option if you want to receive an email when a user makes a booking.', 'jt-travel-booking'); ?></p>
	<?php
}
function jt_travel_booking_email_notification_address_render(  ) { 

	$options = get_option( 'jt_travel_booking_bookings' );
	?>
	<input type='text' name='jt_travel_booking_bookings[jt_travel_booking_email_notification_address]' value='<?php echo $options["jt_travel_booking_email_notification_address"]; ?>' />
	<p><?php echo __('Your email address.', 'jt-travel-booking'); ?></p>
	<?php
}
function jt_travel_booking_notify_customers_render(  ) { 
	$options = get_option( 'jt_travel_booking_bookings' );
	?><label class="switch">
		<input type='checkbox' name='jt_travel_booking_bookings[jt_travel_booking_notify_customers]' <?php checked( $options['jt_travel_booking_notify_customers'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<p><?php echo __('Enable this option if you want to send users a notification after making a booking.', 'jt-travel-booking'); ?></p>
	<?php
}
function jt_travel_booking_email_message_render(  ) { 

	$options = get_option( 'jt_travel_booking_bookings' );
	?>
	<textarea cols='80' rows='10' name='jt_travel_booking_bookings[jt_travel_booking_email_message]'> <?php echo $options["jt_travel_booking_email_message"]; ?></textarea>
	<p><?php echo __('Use this field to send them a custom message. <strong>HTML code is not allowed</strong>.', 'jt-travel-booking'); ?></p>

<?php

}

function travel_days_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_days_text]' value='<?php echo $translations["travel_days_text"]; ?>' placeholder='days' />
	<?php

}

function travel_starts_from_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_starts_from_text]' value='<?php echo $translations["travel_starts_from_text"]; ?>' placeholder='Starts from:' />
	<?php

}

function travel_info_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_info_text]' value='<?php echo $translations["travel_info_text"]; ?>' placeholder='Info' />
	<?php

}

function travel_daily_program_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_daily_program_text]' value='<?php echo $translations["travel_daily_program_text"]; ?>' placeholder='Daily Program' />
	<?php

}

function travel_hotels_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_hotels_text]' value='<?php echo $translations["travel_hotels_text"]; ?>' placeholder='Hotels' />
	<?php

}

function travel_provisions_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_provisions_text]' value='<?php echo $translations["travel_provisions_text"]; ?>' placeholder='Provisions' />
	<?php

}

function travel_things_to_do_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_things_to_do_text]' value='<?php echo $translations["travel_things_to_do_text"]; ?>' placeholder='Things to do' />
	<?php

}

function travel_booking_info_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_booking_info_text]' value='<?php echo $translations["travel_booking_info_text"]; ?>' placeholder='Booking Info' />
	<?php

}

function travel_video_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_video_text]' value='<?php echo $translations["travel_video_text"]; ?>' placeholder='Video' />
	<?php

}

function travel_departures_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_departures_text]' value='<?php echo $translations["travel_departures_text"]; ?>' placeholder='Departures' />
	<?php

}

function travel_photo_gallery_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_photo_gallery_text]' value='<?php echo $translations["travel_photo_gallery_text"]; ?>' placeholder='Photo Gallery' />
	<?php

}

function travel_book_this_tour_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_book_this_tour_text]' value='<?php echo $translations["travel_book_this_tour_text"]; ?>' placeholder='Book This Tour' />
	<?php

}

function travel_book_now_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' size="100" name='jt_travel_booking_translations[travel_book_now_text]' value='<?php echo $translations["travel_book_now_text"]; ?>' placeholder='Book now and we will contact you as soon as possible to confirm your booking.' />
	<?php

}

function travel_first_name_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_first_name_text]' value='<?php echo $translations["travel_first_name_text"]; ?>' placeholder='First Name' />
	<?php

}

function travel_last_name_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_last_name_text]' value='<?php echo $translations["travel_last_name_text"]; ?>' placeholder='Last Name' />
	<?php

}

function travel_email_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_email_text]' value='<?php echo $translations["travel_email_text"]; ?>' placeholder='Email' />
	<?php

}

function travel_phone_number_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_phone_number_text]' value='<?php echo $translations["travel_phone_number_text"]; ?>' placeholder='Phone Number' />
	<?php

}

function travel_number_of_persons_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_number_of_persons_text]' value='<?php echo $translations["travel_number_of_persons_text"]; ?>' placeholder='Number of Persons' />
	<?php

}

function travel_departure_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_departure_text]' value='<?php echo $translations["travel_departure_text"]; ?>' placeholder='Departure' />
	<?php

}

function travel_comments_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_comments_text]' value='<?php echo $translations["travel_comments_text"]; ?>' placeholder='Additional Comments' />
	<?php

}

function travel_book_now_btn_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_book_now_btn_text]' value='<?php echo $translations["travel_book_now_btn_text"]; ?>' placeholder='Book Now' />
	<?php

}

function travel_more_info_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_more_info]' value='<?php echo $translations["travel_more_info"]; ?>' placeholder='More Info' />
	<?php

}

function travel_more_destinations_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_more_destinations]' value='<?php echo $translations["travel_more_destinations"]; ?>' placeholder='More Destinations' />
	<?php

}

function agency_info_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[agency_info_text]' value='<?php echo $translations["agency_info_text"]; ?>' placeholder="Agency's Info" />
	<?php

}

function search_destinations_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[search_destinations_text]' value='<?php echo $translations["search_destinations_text"]; ?>' placeholder='Search Destinations' />
	<?php

}

function number_of_days_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[number_of_days_text]' value='<?php echo $translations["number_of_days_text"]; ?>' placeholder="Number of days" />
	<?php

}

function price_range_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[price_range_text]' value='<?php echo $translations["price_range_text"]; ?>' placeholder="Price Range" />
	<?php

}

function search_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[search_text]' value='<?php echo $translations["search_text"]; ?>' placeholder="Search" />
	<?php

}

function search_results_for_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[search_results_for_text]' value='<?php echo $translations["search_results_for_text"]; ?>' placeholder="Search Results for" />
	<?php

}

function no_destinations_text_render(  ) { 

	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[no_destinations_text]' value='<?php echo $translations["no_destinations_text"]; ?>' placeholder="0 destinations found based on your search query. Please, try something else." />
	<?php

}
function travel_price_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_price_text]' value='<?php echo $translations["travel_price_text"]; ?>' placeholder="Price" />
	<?php
}
function travel_periods_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_periods_text]' value='<?php echo $translations["travel_periods_text"]; ?>' placeholder="Periods" />
	<?php
}
function travel_transportation_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_transportation_text]' value='<?php echo $translations["travel_transportation_text"]; ?>' placeholder="Transportation" />
	<?php
}
function travel_transportation_icon_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_transportation_icon_text]' value='<?php echo $translations["travel_transportation_text"]; ?>' placeholder="Transportation Icon" />
	<?php
}
function travel_media_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_media_text]' value='<?php echo $translations["travel_media_text"]; ?>' placeholder="Media" />
	<?php
}
function travel_basic_info_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_basic_info_text]' value='<?php echo $translations["travel_basic_info_text"]; ?>' placeholder="Basic Info" />
	<?php
}
function travel_short_info_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_short_info_text]' value='<?php echo $translations["travel_short_info_text"]; ?>' placeholder="Short Info" />
	<?php
}
function travel_upload_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_upload_text]' value='<?php echo $translations["travel_upload_text"]; ?>' placeholder="Upload" />
	<?php
}
function travel_destination_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_destination_text]' value='<?php echo $translations["travel_destination_text"]; ?>' placeholder="Destination" />
	<?php
}
function travel_new_booking_for_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_new_booking_for_text]' value='<?php echo $translations["travel_new_booking_for_text"]; ?>' placeholder="New booking for" />
	<?php
}
function travel_from_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_from_text]' value='<?php echo $translations["travel_from_text"]; ?>' placeholder="from" />
	<?php
}
function travel_received_booking_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_received_booking_text]' value='<?php echo $translations["travel_received_booking_text"]; ?>' placeholder="We received your booking" />
	<?php
}
function travel_received_booking_for_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_received_booking_for_text]' value='<?php echo $translations["travel_received_booking_for_text"]; ?>' placeholder="We received your booking for" />
	<?php
}
function travel_confirmation_message_text_render(  ) { 
	$translations = get_option( 'jt_travel_booking_translations' );
	?>
	<input type='text' name='jt_travel_booking_translations[travel_confirmation_message_text]' value='<?php echo $translations["travel_confirmation_message_text"]; ?>' placeholder="We will contact you as soon as possible to confirm it." />
	<?php
}

function travel_booking_basic_color_render(  ) { 
	$colors = get_option( 'jt_travel_booking_colors' );
	?>
	<input type='color' class="color-field" name='jt_travel_booking_colors[travel_booking_basic_color]' value='<?php echo $colors["travel_booking_basic_color"]; ?>' />
	<?php
}


function jt_travel_booking_settings_section_callback(  ) { 

	echo __( 'Basic Settings for "JT Travel Booking" plugin', 'jt-travel-booking' );

}

function jt_travel_booking_agency_section_callback(  ) { 

	echo __( 'Add your agency\'s info using the field below. For example, you can add Phone Number, Address, Website etc. <strong>HTML code is allowed!</strong>', 'jt-travel-booking' );

}

function jt_travel_booking_bookings_section_callback(  ) { 

	echo __( '', 'jt-travel-booking' );

}

function jt_travel_booking_translations_section_callback(  ) { 

	echo __( 'Use these fields in order to change/rename the text of "JT Travel Booking" plugin', 'jt-travel-booking' );

}

function jt_travel_booking_colors_section_callback(  ) { 

	echo __( 'Change the basic color of "JT Travel Booking" plugin', 'jt-travel-booking' );

}

function jt_travel_booking_info_section_callback(  ) { 

	echo __( '', 'jt-travel-booking' );

}

function jt_travel_booking_options_page(  ) { 

	?>

		<h2>JT Travel Booking</h2>

		<div class="jtplugin-options">
			<div class="uk-grid">
				<div class="uk-width-7-10">
					<ul class="uk-tab uk-tab-left jtplugin-options-tabs" data-uk-tab="{connect:'#jtplugin-options'}">
						<li>General Options</li>
						<li>Agency Info</li>
						<li>Bookings</li>
						<li>Translations</li>
						<li>Colors</li>
					</ul>

					<ul id="jtplugin-options" class="uk-switcher">
						<li>
							<form action='options.php' method='post'>
								<?php
									settings_fields( 'travelBookingSettings' );
									do_settings_sections( 'travelBookingSettings' );
									submit_button();
								?>
							</form>
						</li>
						<li>
							<form action="options.php" method="post">
								<?php
									settings_fields( 'travelBookingAgency' );
									do_settings_sections( 'travelBookingAgency' );
									submit_button();
								?>
							</form>
						</li>
						<li>
							<form action="options.php" method="post">
								<?php
									settings_fields( 'travelBookingBookings' );
									do_settings_sections( 'travelBookingBookings' );
									submit_button();
								?>
							</form>
						</li>
						<li>
							<form action='options.php' method='post'>
								<?php
									settings_fields( 'travelBookingTranslations' );
									do_settings_sections( 'travelBookingTranslations' );
									submit_button();
								?>
							</form>
						</li>
						<li>
							<form action='options.php' method='post'>
								<?php
									settings_fields( 'travelBookingColors' );
									do_settings_sections( 'travelBookingColors' );
									submit_button();
								?>
							</form>
						</li>
					</ul>
				</div>
				
				<div class="uk-width-3-10">
					<div class="jt-plugin-info">
						<?php
							settings_fields( 'travelBookingInfo' );
							do_settings_sections( 'travelBookingInfo' );
						?>
						<p>Thank you very much for purchasing JT Travel Booking from CodeCanyon.</p>
						<p>Currently, you are using version <strong>6.0.2</strong>. Please, <a href="https://jsquare-themes.com/demo/jt-travel-booking/changelog" target="_blank">check this page</a> to ensure that you are using the latest version with all bug fixes and new features.</p>
					</div>
					
					<div class="jt-plugin-info">
						<h2>Support</h2>
						<p>Visit the <a href="http://jsquare-themes.com/hc">Help Center</a></p>
						<p><a href="http://jsquare-themes.com/support/submit-a-ticket">Submit a ticket</a></p>
					</div>
					
					<div class="jt-plugin-info">
						<h2>More items from JSquare Themes</h2>
						<a href="https://codecanyon.net/item/jt-recipes/20034198" target="_blank" title="JT Recipes - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-recipes.png"></a>
						<a href="https://codecanyon.net/item/jt-event-calendar/19287451" target="_blank" title="JT Event Calendar - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-event-calendar.png"></a>
						<a href="https://codecanyon.net/item/jt-staff-profiles/19716313" target="_blank" title="JT Staff Profiles - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-staff-profiles.png"></a>
					</div>
				</div>
			</div>
	<?php

}


function jt_travel_booking_options_scripts() {
   	wp_register_script( 'travelBooking-uikit', plugin_dir_url( __FILE__ ) . 'options/js/uikit.min.js', array('jquery') );
	wp_enqueue_script( 'travelBooking-uikit' );
   	wp_register_script( 'travelBooking-switcher', plugin_dir_url( __FILE__ ) . 'options/js/switcher.min.js', array('jquery') );
	wp_enqueue_script( 'travelBooking-switcher' );
	wp_register_script( 'travelBooking-accordion', plugin_dir_url(__FILE__).'js/accordion.min.js', array('jquery') );
    wp_enqueue_script( 'travelBooking-accordion' );
	
   	wp_register_style( 'travelBooking-options', plugin_dir_url( __FILE__ ) . 'options/css/plugin-options.css' );
	wp_enqueue_style( 'travelBooking-options' );
    wp_register_style( 'travelBooking-accordion', plugin_dir_url(__FILE__).'css/accordion.min.css' );
    wp_enqueue_style( 'travelBooking-accordion' );
}
add_action( 'admin_enqueue_scripts','jt_travel_booking_options_scripts');

?>