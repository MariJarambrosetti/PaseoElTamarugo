<?php

add_action( 'admin_menu', 'jt_add_admin_menu' );
add_action( 'admin_init', 'jt_settings_init' );


function jt_add_admin_menu(  ) { 

	add_submenu_page( 'edit.php?post_type=events_list', 'JT Event Calendar', 'Settings', 'manage_options', 'jt_event_calendar', 'jt_options_page' );

}

function jt_settings_init(  ) { 
	
	register_setting( 'pluginPage', 'jt_settings' );
	register_setting( 'jtEventTranslations', 'jt_event_translations' );
	register_setting( 'jtEventRegistration', 'jt_event_registration' );
	register_setting( 'jtEventInfo', 'jt_event_info' );

	add_settings_section(
		'jt_pluginPage_section', 
		__( 'General Options', 'jt-event-calendar' ), 
		'jt_settings_section_callback', 
		'pluginPage'
	);
	
	add_settings_section(
		'jt_eventTranslations_section', 
		__( 'Translations', 'jt-event-calendar' ), 
		'jt_eventTranslations_section_callback', 
		'jtEventTranslations'
	);
	add_settings_section(
		'jt_eventRegistration_section', 
		__( 'Registration Form', 'jt-event-calendar' ), 
		'jt_eventRegistration_section_callback', 
		'jtEventRegistration'
	);
	add_settings_section(
		'jt_eventSupport_section', 
		__( 'Support', 'jt-event-calendar' ), 
		'jt_eventSupport_section_callback', 
		'jtEventSupport'
	);
	add_settings_section(
		'jt_eventInfo_section', 
		__( 'Info', 'jt-event-calendar' ), 
		'jt_eventInfo_section_callback', 
		'jtEventInfo'
	);
	
	add_settings_field( 
		'display_past_events', 
		__( 'Display past events', 'jt-event-calendar' ), 
		'display_past_events_render', 
		'pluginPage', 
		'jt_pluginPage_section' 
	);
	
	add_settings_field( 
		'event_page', 
		__( 'Enable "Event Page"', 'jt-event-calendar' ), 
		'event_page_render', 
		'pluginPage', 
		'jt_pluginPage_section' 
	);
	
	add_settings_field( 
		'event_page_style', 
		__( '"Event Page" Style', 'jt-event-calendar' ), 
		'event_page_style_render', 
		'pluginPage', 
		'jt_pluginPage_section' 
	);

	add_settings_field( 
		'date_format', 
		__( 'Date Format', 'jt-event-calendar' ), 
		'date_format_render', 
		'pluginPage', 
		'jt_pluginPage_section' 
	);
	
	add_settings_field( 
		'events_slug', 
		__( 'Slug for events_list', 'jt-event-calendar' ), 
		'events_slug_render', 
		'pluginPage', 
		'jt_pluginPage_section' 
	);
	
	add_settings_field( 
		'event_tickets', 
		__( 'Tickets', 'jt-event-calendar' ), 
		'event_tickets_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_video', 
		__( 'Video', 'jt-event-calendar' ), 
		'event_video_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_free_entrance_text', 
		__( 'Free Entrance', 'jt-event-calendar' ), 
		'event_free_entrance_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_sold_out_text', 
		__( 'Sold Out', 'jt-event-calendar' ), 
		'event_sold_out_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'search_events_text', 
		__( 'Search Events', 'jt-event-calendar' ), 
		'search_events_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_search_text', 
		__( 'Search', 'jt-event-calendar' ), 
		'event_search_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_from_text', 
		__( 'From', 'jt-event-calendar' ), 
		'event_from_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_to_text', 
		__( 'To', 'jt-event-calendar' ), 
		'event_to_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_location_text', 
		__( 'Location', 'jt-event-calendar' ), 
		'event_location_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_all_locations_text', 
		__( 'All location', 'jt-event-calendar' ), 
		'event_all_locations_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'no_events_text', 
		__( 'No Events Found', 'jt-event-calendar' ), 
		'no_events_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'info_text', 
		__( 'Info', 'jt-event-calendar' ), 
		'info_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'tickets_text', 
		__( 'Tickets', 'jt-event-calendar' ), 
		'tickets_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'special_guests_text', 
		__( 'Special Guests', 'jt-event-calendar' ), 
		'special_guests_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'schedule_text', 
		__( 'Schedule', 'jt-event-calendar' ), 
		'schedule_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'photo_gallery_text', 
		__( 'Photo Gallery', 'jt-event-calendar' ), 
		'photo_gallery_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'sponsors_text', 
		__( 'Sponsors', 'jt-event-calendar' ), 
		'sponsors_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'media_sponsors_text', 
		__( 'Media Sponsors', 'jt-event-calendar' ), 
		'media_sponsors_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'more_events_text', 
		__( 'More Events', 'jt-event-calendar' ), 
		'more_events_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'available_seats_text', 
		__( 'Available Seats', 'jt-event-calendar' ), 
		'available_seats_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'register_now_text', 
		__( 'Register Now', 'jt-event-calendar' ), 
		'register_now_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'event_title_text', 
		__( 'Event', 'jt-event-calendar' ), 
		'event_title_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'firstname_text', 
		__( 'First Name', 'jt-event-calendar' ), 
		'firstname_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'lastname_text', 
		__( 'Last Name', 'jt-event-calendar' ), 
		'lastname_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'email_text', 
		__( 'Email', 'jt-event-calendar' ), 
		'email_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'phone_number_text', 
		__( 'Phone Number', 'jt-event-calendar' ), 
		'phone_number_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'day_text', 
		__( 'Day', 'jt-event-calendar' ), 
		'day_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'time_text', 
		__( 'Time', 'jt-event-calendar' ), 
		'time_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'num_of_persons_text', 
		__( 'Number of Persons', 'jt-event-calendar' ), 
		'num_of_persons_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'register_text', 
		__( 'Register', 'jt-event-calendar' ), 
		'register_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_basic_info_text', 
		__( 'Basic Info', 'jt-event-calendar' ), 
		'event_basic_info_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_short_info_text', 
		__( 'Short Info', 'jt-event-calendar' ), 
		'event_short_info_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_starts_text', 
		__( 'Starts', 'jt-event-calendar' ), 
		'event_starts_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_ends_text', 
		__( 'Ends', 'jt-event-calendar' ), 
		'event_ends_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_eg_text', 
		__( 'e.g.', 'jt-event-calendar' ), 
		'event_eg_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_time_text', 
		__( 'Time', 'jt-event-calendar' ), 
		'event_time_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_map_text', 
		__( 'Map (Embed Code)', 'jt-event-calendar' ), 
		'event_map_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_link_text', 
		__( 'Link Text', 'jt-event-calendar' ), 
		'event_link_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_link_url_text', 
		__( 'Link URL', 'jt-event-calendar' ), 
		'event_link_url_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_yes_text', 
		__( 'Yes', 'jt-event-calendar' ), 
		'event_yes_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_no_text', 
		__( 'No', 'jt-event-calendar' ), 
		'event_no_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_media_text', 
		__( 'Media', 'jt-event-calendar' ), 
		'event_media_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_image_text', 
		__( 'Image', 'jt-event-calendar' ), 
		'event_image_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_video_url_text', 
		__( 'Video URL', 'jt-event-calendar' ), 
		'event_video_url_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_video_embed_text', 
		__( 'Video (Embed Code)', 'jt-event-calendar' ), 
		'event_video_embed_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_upload_text', 
		__( 'Upload', 'jt-event-calendar' ), 
		'event_upload_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_sponsor_text', 
		__( 'Sponsor', 'jt-event-calendar' ), 
		'event_sponsor_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_media_sponsor_text', 
		__( 'Media Sponsor', 'jt-event-calendar' ), 
		'event_media_sponsor_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_add_special_guests_text', 
		__( 'Add your Event\'s Special Guests as:', 'jt-event-calendar' ), 
		'event_add_special_guests_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_add_schedule_text', 
		__( 'Add your Event\'s Schedule as:', 'jt-event-calendar' ), 
		'event_add_schedule_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_schedule_file_text', 
		__( 'Event\'s Schedule File', 'jt-event-calendar' ), 
		'event_schedule_file_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_settings_text', 
		__( 'Settings', 'jt-event-calendar' ), 
		'event_settings_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_countdown_timer_text', 
		__( 'Enable Countdown Timer', 'jt-event-calendar' ), 
		'event_countdown_timer_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_enable_registration_text', 
		__( 'Enable Registration Form', 'jt-event-calendar' ), 
		'event_enable_registration_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_custom_registration_text', 
		__( 'Custom Registration Form', 'jt-event-calendar' ), 
		'event_custom_registration_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_custom_form_shortcode_text', 
		__( 'Shortcode of Custom Form', 'jt-event-calendar' ), 
		'event_custom_form_shortcode_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_logo_text', 
		__( 'Logo', 'jt-event-calendar' ), 
		'event_logo_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_website_text', 
		__( 'Website (URL)', 'jt-event-calendar' ), 
		'event_website_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_category_text', 
		__( 'Category', 'jt-event-calendar' ), 
		'event_category_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_guest_name_text', 
		__( 'Full Name | Specialty', 'jt-event-calendar' ), 
		'event_guest_name_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_example_text', 
		__( 'Example', 'jt-event-calendar' ), 
		'event_example_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_featured_image_text', 
		__( 'Featured Image', 'jt-event-calendar' ), 
		'event_featured_image_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_submit_text', 
		__( 'Submit Event', 'jt-event-calendar' ), 
		'event_submit_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_image_title_text', 
		__( 'Event\'s Image', 'jt-event-calendar' ), 
		'event_image_title_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_login_message_text', 
		__( 'Must Login Message', 'jt-event-calendar' ), 
		'event_login_message_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_starts_in_text', 
		__( 'Event starts in', 'jt-event-calendar' ), 
		'event_starts_in_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_starts_today_text', 
		__( 'The event starts today', 'jt-event-calendar' ), 
		'event_starts_today_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_has_expired_text', 
		__( 'Event has expired', 'jt-event-calendar' ), 
		'event_has_expired_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_countdown_days_text', 
		__( 'Days', 'jt-event-calendar' ), 
		'event_countdown_days_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_countdown_hours_text', 
		__( 'Hours', 'jt-event-calendar' ), 
		'event_countdown_hours_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_countdown_min_text', 
		__( 'Minutes', 'jt-event-calendar' ), 
		'event_countdown_min_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	add_settings_field( 
		'event_countdown_sec_text', 
		__( 'Seconds', 'jt-event-calendar' ), 
		'event_countdown_sec_text_render', 
		'jtEventTranslations', 
		'jt_eventTranslations_section' 
	);
	
	add_settings_field( 
		'day_field', 
		__( 'Display "Day" field', 'jt-event-calendar' ), 
		'day_field_render', 
		'jtEventRegistration', 
		'jt_eventRegistration_section' 
	);
	add_settings_field( 
		'time_field', 
		__( 'Display "Time" field', 'jt-event-calendar' ), 
		'time_field_render', 
		'jtEventRegistration', 
		'jt_eventRegistration_section' 
	);
	add_settings_field( 
		'email_notification', 
		__( 'Email Notification', 'jt-event-calendar' ), 
		'email_notification_render', 
		'jtEventRegistration', 
		'jt_eventRegistration_section' 
	);
	add_settings_field( 
		'recipient_email', 
		__( 'Recipient\'s Email', 'jt-event-calendar' ), 
		'recipient_email_render', 
		'jtEventRegistration', 
		'jt_eventRegistration_section' 
	);

}


function display_past_events_render(  ) { 

	$options = get_option( 'jt_settings' );
	?><label class="switch">
		<input type='checkbox' name='jt_settings[display_past_events]' <?php checked( $options['display_past_events'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<?php

}

function event_page_render(  ) { 

	$options = get_option( 'jt_settings' );
	?><label class="switch">
		<input type='checkbox' name='jt_settings[event_page]' <?php checked( $options['event_page'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<p>By selecting this option, the plugin will create a new page for every event with the info you provided when you added the events. Also, <strong>"JT Events"</strong> widget will replace all event titles with a link to these pages.</p>
	<?php

}


function date_format_render(  ) { 

	$options = get_option( 'jt_settings' );
	?>
	<select name='jt_settings[date_format]'>
		<option value='dFY' <?php selected( $options['date_format'], 'dFY' ); ?>>01 January 2017</option>
		<option value='dF' <?php selected( $options['date_format'], 'dF' ); ?>>01 January</option>
		<option value='Fd' <?php selected( $options['date_format'], 'Fd' ); ?>>January 01</option>
		<option value='dMY' <?php selected( $options['date_format'], 'dMY' ); ?>>01 Jan 2017</option>
		<option value='dM' <?php selected( $options['date_format'], 'dM' ); ?>>01 Jan</option>
		<option value='Md' <?php selected( $options['date_format'], 'Md' ); ?>>Jan 01</option>
		<option value='dmY' <?php selected( $options['date_format'], 'dmY' ); ?>>01/02/2017 (DD/MM/YYYY)</option>
		<option value='mdY' <?php selected( $options['date_format'], 'mdY' ); ?>>02/01/2017 (MM/DD/YYYY)</option>
	</select>
	<p>Select the date format for the event's page. Note that this date format can be different from the date format you define when you add a <strong>JT Events</strong> widget.</p>

<?php

}

function event_page_style_render(  ) { 

	$options = get_option( 'jt_settings' );
	?>
	<select name='jt_settings[event_page_style]'>
		<option value='style-1' <?php selected( $options['event_page_style'], 'style-1' ); ?>>Style 1</option>
		<option value='style-2' <?php selected( $options['event_page_style'], 'style-2' ); ?>>Style 2</option>
		<option value='style-3' <?php selected( $options['event_page_style'], 'style-3' ); ?>>Style 3</option>
		<option value='style-4' <?php selected( $options['event_page_style'], 'style-4' ); ?>>Style 4</option>
		<option value='style-5' <?php selected( $options['event_page_style'], 'style-5' ); ?>>Style 5</option>
	</select>
<?php
}

function events_slug_render(  ) { 

	$options = get_option( 'jt_settings' );
	?>
	<input name='jt_settings[events_slug]' type='text' value='<?php echo $options["events_slug"]; ?>' placeholder='events_list' />

<?php

}

function event_tickets_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_tickets]' type='text' value='<?php echo $translations["event_tickets"]; ?>' placeholder='Tickets' />

<?php

}

function event_video_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_video]' type='text' value='<?php echo $translations["event_video"]; ?>' placeholder='Video' />

<?php

}

function event_free_entrance_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_free_entrance_text]' type='text' value='<?php echo $translations["event_free_entrance_text"]; ?>' placeholder='Free Entrance' />

<?php

}

function event_sold_out_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_sold_out_text]' type='text' value='<?php echo $translations["event_sold_out_text"]; ?>' placeholder='Sold Out' />

<?php

}

function search_events_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[search_events_text]' type='text' value='<?php echo $translations["search_events_text"]; ?>' placeholder='Search Events' />

<?php

}

function event_search_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_search_text]' type='text' value='<?php echo $translations["event_search_text"]; ?>' placeholder='Search' />

<?php

}

function event_from_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_from_text]' type='text' value='<?php echo $translations["event_from_text"]; ?>' placeholder='From' />

<?php

}

function event_to_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_to_text]' type='text' value='<?php echo $translations["event_to_text"]; ?>' placeholder='To' />

<?php

}

function event_location_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_location_text]' type='text' value='<?php echo $translations["event_location_text"]; ?>' placeholder='Location' />

<?php

}

function event_all_locations_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_all_locations_text]' type='text' value='<?php echo $translations["event_all_locations_text"]; ?>' placeholder='All locations' />

<?php

}

function no_events_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[no_events_text]' type='text' value='<?php echo $translations["no_events_text"]; ?>' placeholder='0 events found based on your criteria. Please, try again.' />

<?php

}

function available_seats_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[available_seats_text]' type='text' value='<?php echo $translations["available_seats_text"]; ?>' placeholder='Available Seats' />

<?php

}

function register_now_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[register_now_text]' type='text' value='<?php echo $translations["register_now_text"]; ?>' placeholder='Register Now' />

<?php

}

function event_title_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_title_text]' type='text' value='<?php echo $translations["event_title_text"]; ?>' placeholder='Event' />

<?php

}

function firstname_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[firstname_text]' type='text' value='<?php echo $translations["firstname_text"]; ?>' placeholder='First Name' />

<?php

}

function lastname_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[lastname_text]' type='text' value='<?php echo $translations["lastname_text"]; ?>' placeholder='Last Name' />

<?php

}

function email_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[email_text]' type='text' value='<?php echo $translations["email_text"]; ?>' placeholder='Email' />

<?php

}

function phone_number_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[phone_number_text]' type='text' value='<?php echo $translations["phone_number_text"]; ?>' placeholder='Phone Number' />

<?php

}

function day_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[day_text]' type='text' value='<?php echo $translations["day_text"]; ?>' placeholder='Day' />

<?php

}

function time_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[time_text]' type='text' value='<?php echo $translations["time_text"]; ?>' placeholder='Time' />

<?php

}

function num_of_persons_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[num_of_persons_text]' type='text' value='<?php echo $translations["num_of_persons_text"]; ?>' placeholder='Number of Persons' />

<?php

}

function register_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[register_text]' type='text' value='<?php echo $translations["register_text"]; ?>' placeholder='Register' />

<?php

}

function info_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[info_text]' type='text' value='<?php echo $translations["info_text"]; ?>' placeholder='Info' />

<?php

}

function tickets_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[tickets_text]' type='text' value='<?php echo $translations["tickets_text"]; ?>' placeholder='Tickets' />

<?php

}

function special_guests_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[special_guests_text]' type='text' value='<?php echo $translations["special_guests_text"]; ?>' placeholder='Special Guests' />

<?php

}

function schedule_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[schedule_text]' type='text' value='<?php echo $translations["schedule_text"]; ?>' placeholder='Schedule' />

<?php

}

function photo_gallery_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[photo_gallery_text]' type='text' value='<?php echo $translations["photo_gallery_text"]; ?>' placeholder='Photo Gallery' />

<?php

}

function more_events_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[more_events_text]' type='text' value='<?php echo $translations["more_events_text"]; ?>' placeholder='More Events' />

<?php

}

function sponsors_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[sponsors_text]' type='text' value='<?php echo $translations["sponsors_text"]; ?>' placeholder='Sponsors' />

<?php

}

function media_sponsors_text_render(  ) { 

	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[media_sponsors_text]' type='text' value='<?php echo $translations["media_sponsors_text"]; ?>' placeholder='Media Sponsors' />

<?php

}
function event_basic_info_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_basic_info_text]' type='text' value='<?php echo $translations["event_basic_info_text"]; ?>' placeholder='Basic Info' />
<?php
}
function event_short_info_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_short_info_text]' type='text' value='<?php echo $translations["event_short_info_text"]; ?>' placeholder='Short Info' />
<?php
}
function event_starts_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_starts_text]' type='text' value='<?php echo $translations["event_starts_text"]; ?>' placeholder='Starts' />
<?php
}
function event_ends_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_ends_text]' type='text' value='<?php echo $translations["event_ends_text"]; ?>' placeholder='Ends' />
<?php
}
function event_eg_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_eg_text]' type='text' value='<?php echo $translations["event_eg_text"]; ?>' placeholder='e.g.' />
<?php
}
function event_time_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_time_text]' type='text' value='<?php echo $translations["event_time_text"]; ?>' placeholder='Time' />
<?php
}
function event_map_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_map_text]' type='text' value='<?php echo $translations["event_map_text"]; ?>' placeholder='Map (Embed Code)' />
<?php
}
function event_link_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_link_text]' type='text' value='<?php echo $translations["event_link_text"]; ?>' placeholder='Link Text' />
<?php
}
function event_link_url_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_link_url_text]' type='text' value='<?php echo $translations["event_link_url_text"]; ?>' placeholder='Link URL' />
<?php
}
function event_yes_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_yes_text]' type='text' value='<?php echo $translations["event_yes_text"]; ?>' placeholder='Yes' />
<?php
}
function event_no_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_no_text]' type='text' value='<?php echo $translations["event_no_text"]; ?>' placeholder='No' />
<?php
}
function event_add_special_guests_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_add_special_guests_text]' type='text' value='<?php echo $translations["event_add_special_guests_text"]; ?>' placeholder="Add you Event's Special Guests as" />
<?php
}
function event_add_schedule_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_add_schedule_text]' type='text' value='<?php echo $translations["event_add_schedule_text"]; ?>' placeholder="Add your Event's Schedule as" />
<?php
}
function event_media_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_media_text]' type='text' value='<?php echo $translations["event_media_text"]; ?>' placeholder='Media' />
<?php
}
function event_image_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_image_text]' type='text' value='<?php echo $translations["event_image_text"]; ?>' placeholder='Image' />
<?php
}
function event_video_url_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_video_url_text]' type='text' value='<?php echo $translations["event_video_url_text"]; ?>' placeholder='Video URL' />
<?php
}
function event_video_embed_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_video_embed_text]' type='text' value='<?php echo $translations["event_video_embed_text"]; ?>' placeholder='Video (Embed Code)' />
<?php
}
function event_upload_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_upload_text]' type='text' value='<?php echo $translations["event_upload_text"]; ?>' placeholder='Upload' />
<?php
}
function event_sponsor_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_sponsor_text]' type='text' value='<?php echo $translations["event_sponsor_text"]; ?>' placeholder='Sponsor' />
<?php
}
function event_media_sponsor_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_media_sponsor_text]' type='text' value='<?php echo $translations["event_media_sponsor_text"]; ?>' placeholder='Media Sponsor' />
<?php
}
function event_settings_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_settings_text]' type='text' value='<?php echo $translations["event_settings_text"]; ?>' placeholder='Settings' />
<?php
}
function event_countdown_timer_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_countdown_timer_text]' type='text' value='<?php echo $translations["event_countdown_timer_text"]; ?>' placeholder='Enable Countdown Timer' />
<?php
}
function event_enable_registration_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_enable_registration_text]' type='text' value='<?php echo $translations["event_enable_registration_text"]; ?>' placeholder='Enable Registration Form' />
<?php
}
function event_custom_registration_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_custom_registration_text]' type='text' value='<?php echo $translations["event_custom_registration_text"]; ?>' placeholder='Custom Registration Form' />
<?php
}
function event_custom_form_shortcode_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_custom_form_shortcode_text]' type='text' value='<?php echo $translations["event_custom_form_shortcode_text"]; ?>' placeholder='Shortcode of Custom Form' />
<?php
}
function event_schedule_file_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_schedule_file_text]' type='text' value='<?php echo $translations["event_schedule_file_text"]; ?>' placeholder="Event's Schedule File" />
<?php
}
function event_logo_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_logo_text]' type='text' value='<?php echo $translations["event_logo_text"]; ?>' placeholder='Logo' />
<?php
}
function event_website_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_website_text]' type='text' value='<?php echo $translations["event_website_text"]; ?>' placeholder='Website (URL)' />
<?php
}
function event_category_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_category_text]' type='text' value='<?php echo $translations["event_category_text"]; ?>' placeholder='Category' />
<?php
}
function event_guest_name_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_guest_name_text]' type='text' value='<?php echo $translations["event_guest_name_text"]; ?>' placeholder='Full Name | Specialty' />
<?php
}
function event_example_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_example_text]' type='text' value='<?php echo $translations["event_example_text"]; ?>' placeholder='Example' />
<?php
}
function event_featured_image_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_featured_image_text]' type='text' value='<?php echo $translations["event_featured_image_text"]; ?>' placeholder='Featured Image' />
<?php
}
function event_submit_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_submit_text]' type='text' value='<?php echo $translations["event_submit_text"]; ?>' placeholder='Submit Event' />
<?php
}
function event_image_title_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_image_title_text]' type='text' value='<?php echo $translations["event_image_title_text"]; ?>' placeholder="Event's Image" />
<?php
}
function event_login_message_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_login_message_text]' type='text' value='<?php echo $translations["event_login_message_text"]; ?>' placeholder="You have to login in order to submit your event. If you don't have an account, please register on our site and visit this page again." />
<?php
}
function event_starts_in_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_starts_in_text]' type='text' value='<?php echo $translations["event_starts_in_text"]; ?>' placeholder="Event starts in" />
<?php
}
function event_starts_today_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_starts_today_text]' type='text' value='<?php echo $translations["event_starts_today_text"]; ?>' placeholder="The event starts today" />
<?php
}
function event_has_expired_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_has_expired_text]' type='text' value='<?php echo $translations["event_has_expired_text"]; ?>' placeholder="Event has expired" />
<?php
}
function event_countdown_days_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_countdown_days_text]' type='text' value='<?php echo $translations["event_countdown_days_text"]; ?>' placeholder="Days" />
<?php
}
function event_countdown_hours_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_countdown_hours_text]' type='text' value='<?php echo $translations["event_countdown_hours_text"]; ?>' placeholder="Hours" />
<?php
}
function event_countdown_min_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_countdown_min_text]' type='text' value='<?php echo $translations["event_countdown_min_text"]; ?>' placeholder="Min" />
<?php
}
function event_countdown_sec_text_render(  ) { 
	$translations = get_option( 'jt_event_translations' );
	?>
	<input name='jt_event_translations[event_countdown_sec_text]' type='text' value='<?php echo $translations["event_countdown_sec_text"]; ?>' placeholder="Sec" />
<?php
}

function day_field_render(  ) { 

	$registration = get_option( 'jt_event_registration' );
	?><label class="switch">
		<input type='checkbox' name='jt_event_registration[day_field]' <?php checked( $registration['day_field'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<?php

}

function time_field_render(  ) { 

	$registration = get_option( 'jt_event_registration' );
	?><label class="switch">
		<input type='checkbox' name='jt_event_registration[time_field]' <?php checked( $registration['time_field'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<?php

}

function email_notification_render(  ) { 

	$registration = get_option( 'jt_event_registration' );
	?><label class="switch">
		<input type='checkbox' name='jt_event_registration[email_notification]' <?php checked( $registration['email_notification'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<p><?php echo __('Enable this option if you want to receive an email when a user registers to an event.', 'jt-event-calendar'); ?></p>
	<?php

}

function recipient_email_render(  ) { 

	$registration = get_option( 'jt_event_registration' );
	?>
	<input name='jt_event_registration[recipient_email]' type='text' value='<?php echo $registration["recipient_email"]; ?>' placeholder='e.g. info@example.com' />
	<?php

}


function jt_settings_section_callback(  ) { 

	echo __( 'Basic Settings for "JT Event Calendar" plugin and "JT Events" widget', 'jt-event-calendar' );

}

function jt_eventInfo_section_callback(  ) { 

	echo __( '', 'jt-event-calendar' );

}
function jt_eventTranslations_section_callback(  ) { 

	echo __( '', 'jt-event-calendar' );

}
function jt_eventSupport_section_callback(  ) { 

	echo __( '', 'jt-event-calendar' );

}


function jt_options_page(  ) { 
	?>

		<h2>JT Event Calendar</h2>

		<div class="jtplugin-options">
			<div class="uk-grid">
				<div class="uk-width-7-10">
					<ul class="uk-tab uk-tab-left jtplugin-options-tabs" data-uk-tab="{connect:'#jtplugin-options'}">
						<li>General Options</li>
						<li>Translations</li>
						<li>Registration Form</li>
					</ul>

					<ul id="jtplugin-options" class="uk-switcher">
						<li>
							<form action='options.php' method='post'>
							<?php
								settings_fields( 'pluginPage' );
								do_settings_sections( 'pluginPage' );
								submit_button();
							?>
							</form>
						</li>
						<li>
							<form action="options.php" method="post">
							<?php
								settings_fields( 'jtEventTranslations' );
								do_settings_sections( 'jtEventTranslations' );
								submit_button();
							?>
							</form>
						</li>
						<li>
							<form action="options.php" method="post">
							<?php
								settings_fields( 'jtEventRegistration' );
								do_settings_sections( 'jtEventRegistration' );
								submit_button();
							?>
							</form>
						</li>
					</ul>
				</div>
				
				<div class="uk-width-3-10">
					<div class="jt-plugin-info">
						<?php
							settings_fields( 'jtEventInfo' );
							do_settings_sections( 'jtEventInfo' );
						?>
						<p>Thank you very much for purchasing JT Event Calendar from CodeCanyon.</p>
						<p>Currently, you are using version <strong>6.4.0</strong>. Please, <a href="https://jsquare-themes.com/demo/jt-event-calendar/changelog" target="_blank">check this page</a> to ensure that you are using the latest version with all bug fixes and new features.</p>
					</div>
					
					<div class="jt-plugin-info">
						<h2>Support</h2>
						<p>Visit the <a href="http://jsquare-themes.com/hc">Help Center</a></p>
						<p><a href="http://jsquare-themes.com/support/submit-a-ticket">Submit a ticket</a></p>
					</div>
					
					<div class="jt-plugin-info">
						<h2>More items from JSquare Themes</h2>
						<a href="https://codecanyon.net/item/jt-recipes/20034198" target="_blank" title="JT Recipes - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-recipes.png"></a>
						<a href="https://codecanyon.net/item/jt-travel-booking/19321074" target="_blank" title="JT Travel Booking - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-travel-booking.png"></a>
						<a href="https://codecanyon.net/item/jt-staff-profiles/19716313" target="_blank" title="JT Staff Profiles - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-staff-profiles.png"></a>
					</div>
				</div>
			</div>
		</div>

	<?php

}



function jt_event_calendar_options_scripts() {
   	wp_register_script( 'jtevent-uikit', plugin_dir_url( __FILE__ ) . 'settings/js/uikit.min.js', array('jquery') );
	wp_enqueue_script( 'jtevent-uikit' );
   	wp_register_script( 'jtevent-switcher', plugin_dir_url( __FILE__ ) . 'settings/js/switcher.min.js', array('jquery') );
	wp_enqueue_script( 'jtevent-switcher' );
	wp_register_script( 'jtevent-accordion', plugin_dir_url(__FILE__).'js/accordion.min.js', array('jquery') );
    wp_enqueue_script( 'jtevent-accordion' );
	
   	wp_register_style( 'jtevent-options', plugin_dir_url( __FILE__ ) . 'settings/css/plugin-options.css' );
	wp_enqueue_style( 'jtevent-options' );
    wp_register_style( 'jt-event-accordion', plugin_dir_url(__FILE__).'css/accordion.min.css' );
    wp_enqueue_style( 'jt-event-accordion' );
}
add_action( 'admin_enqueue_scripts','jt_event_calendar_options_scripts');

?>