<?php
add_action( 'admin_menu', 'jt_schedule_add_admin_menu' );
add_action( 'admin_init', 'jt_schedule_settings_init' );


function jt_schedule_add_admin_menu(  ) { 

	add_submenu_page( 'edit.php?post_type=schedule', 'JT Schedule', 'Settings', 'manage_options', 'jt_schedule', 'jt_schedule_options_page' );

}


function jt_schedule_settings_init(  ) { 

	register_setting( 'scheduleDisplayPage', 'jt_schedule_settings' );
	register_setting( 'scheduleTranslationsPage', 'jt_schedule_translations' );
	register_setting( 'scheduleInfo', 'jt_schedule_info' );
	register_setting( 'scheduleSupport', 'jt_schedule_support' );

	add_settings_section(
		'jt_schedule_displayPage_section', 
		__( 'General Options', 'jt-schedule' ), 
		'jt_schedule_settings_section_callback', 
		'scheduleDisplayPage'
	);
	add_settings_section(
		'jt_schedule_translationsPage_section', 
		__( 'Translations', 'jt-schedule' ), 
		'jt_schedule_translations_section_callback', 
		'scheduleTranslationsPage'
	);
	add_settings_section(
		'jt_schedule_info_section', 
		__( 'Info', 'jt-schedule' ), 
		'jt_schedule_info_section_callback', 
		'scheduleInfo'
	);
	add_settings_section(
		'jt_schedule_support_section', 
		__( 'Support', 'jt-schedule' ), 
		'jt_schedule_support_section_callback', 
		'scheduleSupport'
	);
	
	add_settings_field( 
		'jt_schedule_singlePage', 
		__( 'Enable Single Page', 'jt-schedule' ), 
		'jt_schedule_singlePage_render', 
		'scheduleDisplayPage', 
		'jt_schedule_displayPage_section' 
	);
	add_settings_field( 
		'jt_schedule_page_style', 
		__( 'Class Page Style', 'jt-event-calendar' ), 
		'jt_schedule_page_style_render', 
		'scheduleDisplayPage', 
		'jt_schedule_displayPage_section' 
	);

	add_settings_field( 
		'jt_schedule_shortInfoText', 
		__( 'Short Info', 'jt-schedule' ), 
		'jt_schedule_shortInfoText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_startsText', 
		__( 'Starts', 'jt-schedule' ), 
		'jt_schedule_startsText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_durationText', 
		__( 'Duration', 'jt-schedule' ), 
		'jt_schedule_durationText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_instructorText', 
		__( 'Instructor', 'jt-schedule' ), 
		'jt_schedule_instructorText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_classText', 
		__( 'Class', 'jt-schedule' ), 
		'jt_schedule_classText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_priceText', 
		__( 'Price', 'jt-schedule' ), 
		'jt_schedule_priceText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_signupText', 
		__( 'Sign up', 'jt-schedule' ), 
		'jt_schedule_signupText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_colorText', 
		__( 'Color', 'jt-schedule' ), 
		'jt_schedule_colorText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_registrationFormText', 
		__( 'Enable Registration Form', 'jt-schedule' ), 
		'jt_schedule_registrationFormText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_customFormText', 
		__( 'Custom Registration Form', 'jt-schedule' ), 
		'jt_schedule_customFormText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_firstnameText', 
		__( 'First Name', 'jt-schedule' ), 
		'jt_schedule_firstnameText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_lastnameText', 
		__( 'Last Name', 'jt-schedule' ), 
		'jt_schedule_lastnameText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_emailText', 
		__( 'Email', 'jt-schedule' ), 
		'jt_schedule_emailText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_phoneText', 
		__( 'Phone Number', 'jt-schedule' ), 
		'jt_schedule_phoneText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_dayText', 
		__( 'Day', 'jt-schedule' ), 
		'jt_schedule_dayText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_submitText', 
		__( 'Submit', 'jt-schedule' ), 
		'jt_schedule_submitText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	
	add_settings_field( 
		'jt_schedule_videoText', 
		__( 'Video URL', 'jt-schedule' ), 
		'jt_schedule_videoText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_videoEmbedText', 
		__( 'Video (Embed Code)', 'jt-schedule' ), 
		'jt_schedule_videoEmbedText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_galleryText', 
		__( 'Photo Gallery', 'jt-schedule' ), 
		'jt_schedule_galleryText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_uploadText', 
		__( 'Upload', 'jt-schedule' ), 
		'jt_schedule_uploadText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_basicInfoText', 
		__( 'Basic Info', 'jt-schedule' ), 
		'jt_schedule_basicInfoText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_infoText', 
		__( 'Info', 'jt-schedule' ), 
		'jt_schedule_infoText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_mediaText', 
		__( 'Media', 'jt-schedule' ), 
		'jt_schedule_mediaText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_settingsText', 
		__( 'Settings', 'jt-schedule' ), 
		'jt_schedule_settingsText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_userRegisteredText', 
		__( 'New user registered on', 'jt-schedule' ), 
		'jt_schedule_userRegisteredText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_nameText', 
		__( 'Name', 'jt-schedule' ), 
		'jt_schedule_nameText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
	add_settings_field( 
		'jt_schedule_timeText', 
		__( 'Time', 'jt-schedule' ), 
		'jt_schedule_timeText_render', 
		'scheduleTranslationsPage', 
		'jt_schedule_translationsPage_section' 
	);
}


function jt_schedule_shortInfoText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_shortInfoText]' value='<?php echo $options['jt_schedule_shortInfoText']; ?>' placeholder="Short Info">
	<?php

}

function jt_schedule_startsText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_startsText]' value='<?php echo $options['jt_schedule_startsText']; ?>' placeholder="Starts">
	<?php

}

function jt_schedule_durationText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_durationText]' value='<?php echo $options['jt_schedule_durationText']; ?>' placeholder="Duration">
	<?php

}

function jt_schedule_instructorText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_instructorText]' value='<?php echo $options['jt_schedule_instructorText']; ?>' placeholder="Instructor">
	<?php

}

function jt_schedule_classText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_classText]' value='<?php echo $options['jt_schedule_classText']; ?>' placeholder="Class">
	<?php

}

function jt_schedule_priceText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_priceText]' value='<?php echo $options['jt_schedule_priceText']; ?>' placeholder="Price">
	<?php

}

function jt_schedule_signupText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_signupText]' value='<?php echo $options['jt_schedule_signupText']; ?>' placeholder="Sign up">
	<?php

}
function jt_schedule_colorText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_colorText]' value='<?php echo $options['jt_schedule_colorText']; ?>' placeholder="Color">
	<?php

}
function jt_schedule_registrationFormText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_registrationFormText]' value='<?php echo $options['jt_schedule_registrationFormText']; ?>' placeholder="Enable Registration Form">
	<?php

}
function jt_schedule_customFormText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_customFormText]' value='<?php echo $options['jt_schedule_customFormText']; ?>' placeholder="Custom Registration Form">
	<?php

}
function jt_schedule_firstnameText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_firstnameText]' value='<?php echo $options['jt_schedule_firstnameText']; ?>' placeholder="First Name">
	<?php

}
function jt_schedule_lastnameText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_lastnameText]' value='<?php echo $options['jt_schedule_lastnameText']; ?>' placeholder="Last Name">
	<?php

}
function jt_schedule_emailText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_emailText]' value='<?php echo $options['jt_schedule_emailText']; ?>' placeholder="Email">
	<?php

}
function jt_schedule_phoneText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_phoneText]' value='<?php echo $options['jt_schedule_phoneText']; ?>' placeholder="Phone Number">
	<?php

}
function jt_schedule_dayText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_dayText]' value='<?php echo $options['jt_schedule_dayText']; ?>' placeholder="Day">
	<?php

}
function jt_schedule_submitText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_submitText]' value='<?php echo $options['jt_schedule_submitText']; ?>' placeholder="Submit">
	<?php

}
function jt_schedule_videoText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_videoText]' value='<?php echo $options['jt_schedule_videoText']; ?>' placeholder="Video URL">
	<?php

}
function jt_schedule_videoEmbedText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_videoEmbedText]' value='<?php echo $options['jt_schedule_videoEmbedText']; ?>' placeholder="Video (Embed Code)">
	<?php

}
function jt_schedule_galleryText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_galleryText]' value='<?php echo $options['jt_schedule_galleryText']; ?>' placeholder="Photo Gallery">
	<?php

}
function jt_schedule_uploadText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_uploadText]' value='<?php echo $options['jt_schedule_uploadText']; ?>' placeholder="Upload">
	<?php

}
function jt_schedule_basicInfoText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_basicInfoText]' value='<?php echo $options['jt_schedule_basicInfoText']; ?>' placeholder="Basic Info">
	<?php

}
function jt_schedule_infoText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_infoText]' value='<?php echo $options['jt_schedule_infoText']; ?>' placeholder="Info">
	<?php

}
function jt_schedule_mediaText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_mediaText]' value='<?php echo $options['jt_schedule_mediaText']; ?>' placeholder="Media">
	<?php

}
function jt_schedule_settingsText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_settingsText]' value='<?php echo $options['jt_schedule_settingsText']; ?>' placeholder="Settings">
	<?php

}
function jt_schedule_userRegisteredText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_userRegisteredText]' value='<?php echo $options['jt_schedule_userRegisteredText']; ?>' placeholder="New user registered on">
	<?php

}
function jt_schedule_nameText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_nameText]' value='<?php echo $options['jt_schedule_nameText']; ?>' placeholder="Name">
	<?php

}
function jt_schedule_timeText_render(  ) { 

	$options = get_option( 'jt_schedule_translations' );
	?>
	<input type='text' name='jt_schedule_translations[jt_schedule_timeText]' value='<?php echo $options['jt_schedule_timeText']; ?>' placeholder="Time">
	<?php

}

function jt_schedule_singlePage_render(  ) { 

	$options = get_option( 'jt_schedule_settings' );
	?>
	<input type='checkbox' name='jt_schedule_settings[jt_schedule_singlePage]' <?php checked( $options['jt_schedule_singlePage'], 1 ); ?> value='1'>
	<?php

}
function jt_schedule_page_style_render(  ) { 

	$options = get_option( 'jt_schedule_settings' );
	?>
	<select name='jt_schedule_settings[jt_schedule_page_style]'>
		<option value='style-1' <?php selected( $options['jt_schedule_page_style'], 'style-1' ); ?>>Style 1</option>
		<option value='style-2' <?php selected( $options['jt_schedule_page_style'], 'style-2' ); ?>>Style 2</option>
	</select>
<?php
}



function jt_schedule_settings_section_callback(  ) { 
	echo __( 'Basic Settings for JT Schedule plugin', 'jt-schedule' );
}
function jt_schedule_translations_section_callback(  ) { 
	echo __( '', 'jt-schedule' );
}
function jt_schedule_info_section_callback(  ) { 
	echo __( '', 'jt-schedule' );
}

function jt_schedule_support_section_callback(  ) { 
	echo __( '', 'jt-schedule' );
}



function jt_schedule_options_page(  ) { 
?>
		<h2>JT Schedule</h2>

		<div class="jtplugin-options">
			<div class="uk-grid">
				<div class="uk-width-7-10">
					<ul class="uk-tab uk-tab-left jtplugin-options-tabs" data-uk-tab="{connect:'#jtplugin-options'}">
						<li>General Options</li>
						<li>Translations</li>
					</ul>

					<ul id="jtplugin-options" class="uk-switcher">
						<li>
							<form action='options.php' method='post'>
							<?php
								settings_fields( 'scheduleDisplayPage' );
								do_settings_sections( 'scheduleDisplayPage' );
								submit_button();
							?>
							</form>
						</li>
						<li>
							<form action="options.php" method="post">
							<?php
								settings_fields( 'scheduleTranslationsPage' );
								do_settings_sections( 'scheduleTranslationsPage' );
								submit_button();
							?>
							</form>
						</li>
					</ul>
				</div>
				
				<div class="uk-width-3-10">
					<div class="jt-plugin-info">
						<?php
							settings_fields( 'scheduleInfo' );
							do_settings_sections( 'scheduleInfo' );
						?>
						<p>Thank you very much for purchasing JT Schedule from CodeCanyon.</p>
						<p>Currently, you are using version <strong>3.0.0</strong>. Please, <a href="https://jsquare-themes.com/demo/jt-schedule/changelog" target="_blank">check this page</a> to ensure that you are using the latest version with all bug fixes and new features.</p>
					</div>
					
					<div class="jt-plugin-info">
						<h2>Support</h2>
						<p>Visit the <a href="http://jsquare-themes.com/hc">Help Center</a></p>
						<p><a href="http://jsquare-themes.com/support/submit-a-ticket">Submit a ticket</a></p>
					</div>
					
					<div class="jt-plugin-info">
						<h2>More items from JSquare Themes</h2>
						<a href="https://codecanyon.net/item/jt-event-calendar/19287451" target="_blank" title="JT Event Calendar - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-event-calendar.png"></a>
						<a href="https://codecanyon.net/item/jt-travel-booking/19321074" target="_blank" title="JT Travel Booking - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-travel-booking.png"></a>
						<a href="https://codecanyon.net/item/jt-staff-profiles/19716313" target="_blank" title="JT Staff Profiles - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-staff-profiles.png"></a>
					</div>
				</div>
			</div>
		</div>
	<?php

}


function jt_schedule_options_scripts() {
   	wp_register_script( 'jt-schedule-uikit', plugin_dir_url( __FILE__ ) . 'options/js/uikit.min.js', array('jquery') );
	wp_enqueue_script( 'jt-schedule-uikit' );
   	wp_register_script( 'jt-schedule-switcher', plugin_dir_url( __FILE__ ) . 'options/js/switcher.min.js', array('jquery') );
	wp_enqueue_script( 'jt-schedule-switcher' );
	wp_register_script( 'jt-schedule-accordion', plugin_dir_url(__FILE__).'options/js/accordion.min.js', array('jquery') );
    wp_enqueue_script( 'jt-schedule-accordion' );
	
   	wp_register_style( 'jt-schedule-options', plugin_dir_url( __FILE__ ) . 'options/css/plugin-options.css' );
	wp_enqueue_style( 'jt-schedule-options' );
    wp_register_style( 'jt-schedule-accordion', plugin_dir_url(__FILE__).'options/css/accordion.min.css' );
    wp_enqueue_style( 'jt-schedule-accordion' );
}
add_action( 'admin_enqueue_scripts','jt_schedule_options_scripts');


?>