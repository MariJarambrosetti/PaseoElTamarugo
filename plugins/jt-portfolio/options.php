<?php
add_action( 'admin_menu', 'jt_projects_admin_menu' );
add_action( 'admin_init', 'jt_project_settings' );


function jt_projects_admin_menu(  ) { 

	add_submenu_page( 'edit.php?post_type=projects_list', 'JT Portfolio', 'Settings', 'manage_options', 'jt_portfolio', 'jt_portfolio_options_page' );

}


function jt_project_settings(  ) { 

	register_setting( 'projectsGeneral', 'jt_projects_general' );
	register_setting( 'projectsTranslations', 'jt_projects_translations' );

	add_settings_section(
		'jt_projectsGeneral_section', 
		__( 'General Options', 'jt-portfolio' ), 
		'jt_projectsGeneral_section_callback', 
		'projectsGeneral'
	);
	
	add_settings_section(
		'jt_projectsTranslations_section', 
		__( 'Translations', 'jt-portfolio' ), 
		'jt_projectsTranslations_section_callback', 
		'projectsTranslations'
	);
	add_settings_section(
		'jt_projectsSupport_section', 
		__( 'Support', 'jt-portfolio' ), 
		'jt_projectsSupport_section_callback', 
		'projectsSupport'
	);
	add_settings_section(
		'jt_projectsInfo_section', 
		__( 'Info', 'jt-portfolio' ), 
		'jt_projectsInfo_section_callback', 
		'projectsInfo'
	);
	
	add_settings_field( 
		'project_page', 
		__( 'Enable "Project Page"', 'jt-portfolio' ), 
		'project_page_render', 
		'projectsGeneral', 
		'jt_projectsGeneral_section' 
	);
	
	add_settings_field( 
		'project_page_style', 
		__( '"Project Page" Style', 'jt-portfolio' ), 
		'project_page_style_render', 
		'projectsGeneral', 
		'jt_projectsGeneral_section' 
	);

	add_settings_field( 
		'project_date_format', 
		__( 'Date Format', 'jt-portfolio' ), 
		'project_date_format_render', 
		'projectsGeneral', 
		'jt_projectsGeneral_section' 
	);
	
	add_settings_field( 
		'project_client', 
		__( 'Client', 'jt-portfolio' ), 
		'project_client_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);
	
	add_settings_field( 
		'project_country', 
		__( 'Country', 'jt-portfolio' ), 
		'project_country_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);
	
	add_settings_field( 
		'project_budget', 
		__( 'Budget', 'jt-portfolio' ), 
		'project_budget_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);
	
	add_settings_field( 
		'project_date', 
		__( 'Date', 'jt-portfolio' ), 
		'project_date_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);
	
	add_settings_field( 
		'project_implementation_time', 
		__( 'Implementation Time', 'jt-portfolio' ), 
		'project_implementation_time_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);
	
	add_settings_field( 
		'project_website', 
		__( 'Website', 'jt-portfolio' ), 
		'project_website_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);
	
	add_settings_field( 
		'project_gallery', 
		__( 'Photo Gallery', 'jt-portfolio' ), 
		'project_gallery_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);
	
	add_settings_field( 
		'project_video', 
		__( 'Video', 'jt-portfolio' ), 
		'project_video_render', 
		'projectsTranslations', 
		'jt_projectsTranslations_section' 
	);


}


function project_page_render(  ) { 

	$options = get_option( 'jt_projects_general' );
	?><label class="switch">
		<input type='checkbox' name='jt_projects_general[project_page]' <?php checked( $options['project_page'], 1 ); ?> value='1'>
	  <div class="slider round"></div>
	</label>
	<p>By selecting this option, the plugin will create a new page for every project with the info you provided when you added the projects. Also, <strong>"JT Projects"</strong> widget will replace all project titles with a link to these pages.</p>
	<?php

}


function project_date_format_render(  ) { 

	$options = get_option( 'jt_projects_general' );
	?>
	<select name='jt_projects_general[project_date_format]'>
		<option value='dFY' <?php selected( $options['project_date_format'], 'dFY' ); ?>>01 January 2017</option>
		<option value='dF' <?php selected( $options['project_date_format'], 'dF' ); ?>>01 January</option>
		<option value='Fd' <?php selected( $options['project_date_format'], 'Fd' ); ?>>January 01</option>
		<option value='dMY' <?php selected( $options['project_date_format'], 'dMY' ); ?>>01 Jan 2017</option>
		<option value='dM' <?php selected( $options['project_date_format'], 'dM' ); ?>>01 Jan</option>
		<option value='Md' <?php selected( $options['project_date_format'], 'Md' ); ?>>Jan 01</option>
		<option value='dmY' <?php selected( $options['project_date_format'], 'dmY' ); ?>>01/02/2017 (DD/MM/YYYY)</option>
		<option value='mdY' <?php selected( $options['project_date_format'], 'mdY' ); ?>>02/01/2017 (MM/DD/YYYY)</option>
		<option value='Ymd' <?php selected( $options['project_date_format'], 'Ymd' ); ?>>2017/01/02 (YYYY/MM/DD)</option>
		<option value='Ydm' <?php selected( $options['project_date_format'], 'Ydm' ); ?>>2017/02/01 (YYYY/DD/MM)</option>
	</select>
	<p>Select the date format for the project's date.</p>

<?php

}

function project_page_style_render(  ) { 

	$options = get_option( 'jt_projects_general' );
	?>
	<select name='jt_projects_general[project_page_style]'>
		<option value='style-1' <?php selected( $options['project_page_style'], 'style-1' ); ?>>Style 1</option>
	</select>

<?php

}

function project_client_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_client]' type='text' value='<?php echo $translations["project_client"]; ?>' placeholder='Client' />

<?php

}

function project_country_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_country]' type='text' value='<?php echo $translations["project_country"]; ?>' placeholder='Country' />

<?php

}

function project_date_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_date]' type='text' value='<?php echo $translations["project_date"]; ?>' placeholder='Date' />

<?php

}

function project_budget_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_budget]' type='text' value='<?php echo $translations["project_budget"]; ?>' placeholder='Budget' />

<?php

}

function project_implementation_time_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_implementation_time]' type='text' value='<?php echo $translations["project_implementation_time"]; ?>' placeholder='Implementation Time' />

<?php

}

function project_website_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_website]' type='text' value='<?php echo $translations["project_website"]; ?>' placeholder='Website' />

<?php

}

function project_gallery_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_gallery]' type='text' value='<?php echo $translations["project_gallery"]; ?>' placeholder='Photo Gallery' />

<?php

}

function project_video_render(  ) { 

	$translations = get_option( 'jt_projects_translations' );
	?>
	<input name='jt_projects_translations[project_video]' type='text' value='<?php echo $translations["project_video"]; ?>' placeholder='Video' />

<?php

}


function jt_projectsGeneral_section_callback(  ) { 

	echo __( 'Basic Settings for "JT Portfolio" plugin.', 'jt-portfolio' );

}

function jt_projectsInfo_section_callback(  ) { 

	echo __( '', 'jt-portfolio' );

}
function jt_projectsTranslations_section_callback(  ) { 

	echo __( '', 'jt-portfolio' );

}
function jt_projectsSupport_section_callback(  ) { 

	echo __( '', 'jt-portfolio' );

}


function jt_portfolio_options_page(  ) { 

	?>

		<h2>JT Portfolio</h2>

		<div class="jtplugin-options">
			<ul class="uk-tab uk-tab-left jtplugin-options-tabs" data-uk-tab="{connect:'#jtplugin-options'}">
				<li>General Options</li>
				<li>Translations</li>
				<li>Support & FAQs</li>
				<li>Info</li>
			</ul>

			<ul id="jtplugin-options" class="uk-switcher">
				<li>
					<form action='options.php' method='post'>
					<?php
						settings_fields( 'projectsGeneral' );
						do_settings_sections( 'projectsGeneral' );
						submit_button();
					?>
					</form>
				</li>
				<li>
					<form action="options.php" method="post">
					<?php
						settings_fields( 'projectsTranslations' );
						do_settings_sections( 'projectsTranslations' );
						submit_button();
					?>
					</form>
				</li>
				<li>
					<?php
						settings_fields( 'projectsSupport' );
						do_settings_sections( 'projectsSupport' );
					?>
					<p>If you have any problems with JT Portfolio, please <a href="http://jsquare-themes.com/support/submit-a-ticket/" target="_blank">submit a new ticket</a> or visit our new <a href="http://jsquare-themes.com/hc" target="_blank">Help Center</a>. Otherwise, please leave a comment on the item's page on CodeCanyon (with the account you purchased the item).</p>					
				</li>
				<li>
					<?php
						settings_fields( 'projectsInfo' );
						do_settings_sections( 'projectsInfo' );
					?>
					<p>Thank you very much for purchasing JT Portfolio from CodeCanyon.</p>
					<p>Currently, you are using version <strong>3.0.0</strong>. Please, <a href="https://codecanyon.net/item/jt-portfolio/19161287" target="_blank">check this page</a> to ensure that you are using the latest version with all bug fixes and new features.</p>
					<div class="more-jt-items">
						<h3>More items from JSquare Themes</h3>
						<a href="https://codecanyon.net/item/jt-event-calendar/19287451" target="_blank" title="JT Event Calendar - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-event-calendar.png"></a>
						<a href="https://codecanyon.net/item/jt-travel-booking/19321074" target="_blank" title="JT Travel Booking - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-travel-booking.png"></a>
						<a href="https://codecanyon.net/item/jt-staff-profiles/19716313" target="_blank" title="JT Staff Profiles - WordPress Plugin"><img src="http://jsquare-themes.com/images/thumbnails/jt-staff-profiles.png"></a>
						<a href="https://themeforest.net/item/a-multipurpose-wordpress-theme/19405408" target="_blank" title="Alphaplus - Multipurpose WordPress Theme"><img src="http://jsquare-themes.com/images/thumbnails/alphaplus.png"></a>
					</div>
				</li>
			</ul>
		</div>

	<?php

}



function jt_portfolio_options_scripts() {
   	wp_register_script( 'projects-uikit', plugin_dir_url( __FILE__ ) . 'settings/js/uikit.min.js', array('jquery') );
	wp_enqueue_script( 'projects-uikit' );
   	wp_register_script( 'projects-switcher', plugin_dir_url( __FILE__ ) . 'settings/js/switcher.min.js', array('jquery') );
	wp_enqueue_script( 'projects-switcher' );
	
   	wp_register_style( 'projects-options', plugin_dir_url( __FILE__ ) . 'settings/css/plugin-options.css' );
	wp_enqueue_style( 'projects-options' );
}
add_action( 'admin_enqueue_scripts','jt_portfolio_options_scripts');

?>