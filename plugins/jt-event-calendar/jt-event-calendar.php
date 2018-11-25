<?php
/*
Plugin Name: JT Event Calendar
Plugin URI: http://www.jsquare-themes.com
Description: Create a modern and responsive list of events with JT Event Calendar
Text Domain: jt-event-calendar
Version: 6.4.0
Author: JSquare Themes
Author URI: http://www.jsquare-themes.com
License: GPLv2 or later
*/

defined('ABSPATH') or die;


add_action( 'init', 'create_events_list' );
function create_events_list() {
	$option = get_option('jt_settings');
	include ( dirname( __FILE__ ) . '/settings/variables.php');
	
	$events_slug = 'events_list';
	if (!empty ($option[events_slug])) {
		$events_slug = $option[events_slug];
	}
	
    register_post_type( 'events_list',
        array(
            'labels' => array(
                'name' => __('Events', 'jt-event-calendar'),
                'singular_name' => __('Event', 'jt-event-calendar'),
                'add_new' => __('Add New', 'jt-event-calendar'),
                'add_new_item' => __('Add New Event', 'jt-event-calendar'),
                'edit' => __('Edit', 'jt-event-calendar'),
                'edit_item' => __('Edit Event', 'jt-event-calendar'),
                'new_item' => __('New Event', 'jt-event-calendar'),
                'view' => __('View', 'jt-event-calendar'),
                'view_item' => __('View Event', 'jt-event-calendar'),
                'search_items' => __('Search Events', 'jt-event-calendar'),
                'not_found' => __('No Events found', 'jt-event-calendar'),
                'not_found_in_trash' => __('No Events found in Trash', 'jt-event-calendar'),
                'parent' => __('Parent Event', 'jt-event-calendar')
            ),
 
            'public' => true,
            'menu_position' => 25,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-calendar-alt',
            'has_archive' => true,
			'rewrite' => array("slug" => $events_slug, "with_front" => false),
        )
    );
	
	register_post_type( 'event_registrations',
        array(
            'labels' => array(
                'name' => __('Event Registrations', 'jt-event-calendar'),
                'singular_name' => __('Registration', 'jt-event-calendar'),
                'add_new' => __('Add New', 'jt-event-calendar'),
                'add_new_item' => __('Add New Registration', 'jt-event-calendar'),
                'edit' => __('Edit', 'jt-event-calendar'),
                'edit_item' => __('Edit Registration', 'jt-event-calendar'),
                'new_item' => __('New Registration', 'jt-event-calendar'),
                'view' => __('View', 'jt-event-calendar'),
                'view_item' => __('View Registration', 'jt-event-calendar'),
                'search_items' => __('Search Registrations', 'jt-event-calendar'),
                'not_found' => __('No Registrations found', 'jt-event-calendar'),
                'not_found_in_trash' => __('No Registrations found in Trash', 'jt-event-calendar'),
                'parent' => __('Parent Registration', 'jt-event-calendar')
            ),
 
            'public' => true,
			'show_in_menu' => 'edit.php?post_type=events_list',
            'menu_position' => null,
            'supports' => array( 'title' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-clipboard',
            'has_archive' => false,
        )
    );

}

add_action('init', 'register_events_category', 0);

function register_events_category() {
    register_taxonomy(
        'events_categories',
        'events_list',
        array(
            'labels' => array(
                'name' => __('Event Category', 'jt-event-calendar'),
                'add_new_item' => __('Add New Event Category', 'jt-event-calendar'),
                'new_item_name' => __("New Event Category", 'jt-event-calendar')
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}

add_action( 'admin_init', 'events_meta' );
function events_meta() {
    add_meta_box( 'event_meta_box',
        'Event Details',
        'display_event_meta_box',
        'events_list', 'normal', 'high'
    );
    add_meta_box( 'event_registration_meta_box',
        'Registration Details',
        'display_event_registration_meta_box',
        'event_registrations', 'normal', 'high'
    );
}

include ( dirname( __FILE__ ) . '/options.php');

function get_event_template($single_template) {
     global $post;

     if ($post->post_type == 'events_list') {
          $single_template = dirname( __FILE__ ) . '/single-events_list.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'get_event_template' );

function events_template_search($template) {    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'events_list' )   
  {
    $template =  WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) . '/search-events.php';
  }   
  return $template;   
}
add_filter('template_include', 'events_template_search', 99); 


function display_event_meta_box( $event ) {
    $event_short_info = esc_html( get_post_meta( $event->ID, 'event_short_info', true ) );
	$info = 'event_info';
    $event_info = get_post_meta( $event->ID, 'event_info', true );
    $event_location = esc_html( get_post_meta( $event->ID, 'event_location', true ) );
    $event_start_date = esc_html( get_post_meta( $event->ID, 'event_start_date', true ) );
    $event_end_date = esc_html( get_post_meta( $event->ID, 'event_end_date', true ) );
    $event_time = esc_html( get_post_meta( $event->ID, 'event_time', true ) );
	$ticket_price = 'event_ticket_price';
    $event_ticket_price = get_post_meta( $event->ID, 'event_ticket_price', true );
	
    $event_free_entrance = esc_html( get_post_meta( $event->ID, 'event_free_entrance', true ) );
    $event_sold_out = esc_html( get_post_meta( $event->ID, 'event_sold_out', true ) );
	
    $event_map = esc_html( get_post_meta( $event->ID, 'event_map', true ) );
    $event_video_url = esc_html( get_post_meta( $event->ID, 'event_video_url', true ) );
    $event_video = esc_html( get_post_meta( $event->ID, 'event_video', true ) );
    $event_link_text = esc_html( get_post_meta( $event->ID, 'event_link_text', true ) );
    $event_link_url = esc_html( get_post_meta( $event->ID, 'event_link_url', true ) );
	
    $event_gallery_img1 = esc_html( get_post_meta( $event->ID, 'event_gallery_img1', true ) );
    $event_gallery_img2 = esc_html( get_post_meta( $event->ID, 'event_gallery_img2', true ) );
    $event_gallery_img3 = esc_html( get_post_meta( $event->ID, 'event_gallery_img3', true ) );
    $event_gallery_img4 = esc_html( get_post_meta( $event->ID, 'event_gallery_img4', true ) );
    $event_gallery_img5 = esc_html( get_post_meta( $event->ID, 'event_gallery_img5', true ) );
    $event_gallery_img6 = esc_html( get_post_meta( $event->ID, 'event_gallery_img6', true ) );
    $event_gallery_img7 = esc_html( get_post_meta( $event->ID, 'event_gallery_img7', true ) );
    $event_gallery_img8 = esc_html( get_post_meta( $event->ID, 'event_gallery_img8', true ) );
	
    $event_sponsor_img1 = esc_html( get_post_meta( $event->ID, 'event_sponsor_img1', true ) );
    $event_sponsor_img2 = esc_html( get_post_meta( $event->ID, 'event_sponsor_img2', true ) );
    $event_sponsor_img3 = esc_html( get_post_meta( $event->ID, 'event_sponsor_img3', true ) );
    $event_sponsor_img4 = esc_html( get_post_meta( $event->ID, 'event_sponsor_img4', true ) );
    $event_sponsor_img5 = esc_html( get_post_meta( $event->ID, 'event_sponsor_img5', true ) );
    $event_sponsor_img6 = esc_html( get_post_meta( $event->ID, 'event_sponsor_img6', true ) );
	
    $event_sponsor_url1 = esc_html( get_post_meta( $event->ID, 'event_sponsor_url1', true ) );
    $event_sponsor_url2 = esc_html( get_post_meta( $event->ID, 'event_sponsor_url2', true ) );
    $event_sponsor_url3 = esc_html( get_post_meta( $event->ID, 'event_sponsor_url3', true ) );
    $event_sponsor_url4 = esc_html( get_post_meta( $event->ID, 'event_sponsor_url4', true ) );
    $event_sponsor_url5 = esc_html( get_post_meta( $event->ID, 'event_sponsor_url5', true ) );
    $event_sponsor_url6 = esc_html( get_post_meta( $event->ID, 'event_sponsor_url6', true ) );
	
    $event_media_sponsor_img1 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_img1', true ) );
    $event_media_sponsor_img2 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_img2', true ) );
    $event_media_sponsor_img3 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_img3', true ) );
    $event_media_sponsor_img4 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_img4', true ) );
    $event_media_sponsor_img5 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_img5', true ) );
    $event_media_sponsor_img6 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_img6', true ) );
	
    $event_media_sponsor_url1 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_url1', true ) );
    $event_media_sponsor_url2 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_url2', true ) );
    $event_media_sponsor_url3 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_url3', true ) );
    $event_media_sponsor_url4 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_url4', true ) );
    $event_media_sponsor_url5 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_url5', true ) );
    $event_media_sponsor_url6 = esc_html( get_post_meta( $event->ID, 'event_media_sponsor_url6', true ) );
	
    $event_schedule = esc_html( get_post_meta( $event->ID, 'event_schedule', true ) );
    $event_schedule_file = esc_html( get_post_meta( $event->ID, 'event_schedule_file', true ) );
    $event_special_guests = esc_html( get_post_meta( $event->ID, 'event_special_guests', true ) );
	
	$event_countdown = esc_html( get_post_meta( $event->ID, 'event_countdown', true ) );
	$event_registration_form = esc_html( get_post_meta( $event->ID, 'event_registration_form', true ) );
	$event_available_seats = esc_html( get_post_meta( $event->ID, 'event_available_seats', true ) );
	
	$event_custom_registration_form = esc_html( get_post_meta( $event->ID, 'event_custom_registration_form', true ) );
	
	$translate = get_option('jt_event_translations');
	include ( dirname( __FILE__ ) . '/settings/variables.php');
	include ( dirname( __FILE__ ) . '/settings/strings.php');
    ?>
	<div class="event-form-section">
		<h3 class="section-title"><span><?php echo __($event_basic_info_text, 'jt-event-calendar'); ?></span></h3>
		<div class="uk-grid event-form-fields">
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($event_short_info_text, 'jt-event-calendar'); ?></label>
					<textarea name="event_short_info" cols="70" rows="3"><?php echo $event_short_info; ?></textarea>
				</p>
				<p>
					<label><?php echo __($event_starts_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="event_start_date" value="<?php echo $event_start_date; ?>" />
				</p>
				<p>
					<label><?php echo __($event_ends_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="event_end_date" value="<?php echo $event_end_date; ?>" />
				</p>
				<p>
					<label><?php echo __($event_time_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="event_time" value="<?php echo $event_time; ?>" />
				</p>
			</div>
			
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($event_location_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="event_location" value="<?php echo $event_location; ?>" />
				</p>
				<p>
					<label><?php echo __($event_map_text, 'jt-event-calendar'); ?></label>
					<textarea name="event_map" cols="70" rows="3"><?php echo $event_map; ?></textarea>
				</p>
				<p>
					<label><?php echo __($event_link_text_label, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="event_link_text" value="<?php echo $event_link_text; ?>" />
				</p>
				<p>
					<label><?php echo __($event_link_url_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="event_link_url" value="<?php echo $event_link_url; ?>" />
				</p>
			</div>
		</div>
	</div>

	<div class="event-form-section">
		<ul id="event-tabs-nav" data-uk-switcher="{connect:'#event-tabs'}">
			<li><a href=""><?php echo __($info_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($tickets_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($special_guests_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($schedule_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($event_media_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($sponsors_text, 'jt-event-calendar'); ?></a></li>
		</ul>

		<ul id="event-tabs" class="uk-switcher">

			<li>
				<?php wp_editor( html_entity_decode(stripcslashes($event_info)), $info ); ?>
			</li>

			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-3">
						<p>
							<label><?php echo __($event_free_entrance_text, 'jt-event-calendar'); ?></label>
							<select name="event_free_entrance">
								<option value="no" <?php selected( $event_free_entrance, 'no' ); ?>><?php echo __($event_no_text, 'jt-event-calendar'); ?></option>
								<option value="yes" <?php selected( $event_free_entrance, 'yes' ); ?>><?php echo __($event_yes_text, 'jt-event-calendar'); ?></option>
							</select>
						</p>
					</div>
					<div class="uk-width-1-3">
						<p>
							<label><?php echo __($event_sold_out_text, 'jt-event-calendar'); ?></label>
							<select name="event_sold_out">
								<option value="no" <?php selected( $event_sold_out, 'no' ); ?>><?php echo __($event_no_text, 'jt-event-calendar'); ?></option>
								<option value="yes" <?php selected( $event_sold_out, 'yes' ); ?>><?php echo __($event_yes_text, 'jt-event-calendar'); ?></option>
							</select>
						</p>
					</div>
					<div class="uk-width-1-3">
						<p>
							<label><?php echo __($available_seats_text, 'jt-event-calendar'); ?></label>
							<input name="event_available_seats" type="number" value="<?php echo $event_available_seats; ?>" />
						</p>
					</div>
				</div>
				<?php wp_editor( html_entity_decode(stripcslashes($event_ticket_price)), $ticket_price ); ?>
			</li>

			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-3">
						<p>
							<strong><?php echo __($event_add_special_guests_text . ':', 'jt-event-calendar'); ?></strong>
						</p>
						<p>
							<?php echo __('John Doe | CEO of the Company<br />Lisa Sid | Web Developer at JT<br />Jack Smith | Journalist', 'jt-event-calendar'); ?>
						</p>
					</div>
					<div class="uk-width-2-3">
						<textarea name="event_special_guests" cols="80" rows="20"><?php echo $event_special_guests; ?></textarea>
					</div>
				</div>
			</li>

			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-3">
						<p>
							<strong><?php echo __($event_add_schedule_text . ':', 'jt-event-calendar'); ?></strong>
						</p>
						<p>
							<?php echo __('09:00 - 10:00 | Welcome audience.<br />10:00 - 11:00 | Introduction to Web Development by the CEO of the company.<br />11:00 - 11:30 | Coffee Break.', 'jt-event-calendar'); ?>
						</p>
					</div>
					<div class="uk-width-2-3">
						<textarea name="event_schedule" cols="80" rows="20"><?php echo $event_schedule; ?></textarea>
					</div>
				</div>
				<p class="event-form-fields event-gallery-fields">
					<label><?php echo __($event_schedule_file_text, 'jt-event-calendar'); ?></label>
					<label for="event_schedule_file">
						<input id="event_schedule_file" type="text" size="100" name="event_schedule_file" value="<?php echo $event_schedule_file; ?>" /><input id="event_schedule_file_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
			</li>
			
			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-2 event-gallery-fields">
						<p>
							<label><?php echo __($event_image_text . ' 1', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img1">
								<input id="event_gallery_img1" type="text" size="100" name="event_gallery_img1" value="<?php echo $event_gallery_img1; ?>" /><input id="event_gallery_img1_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
						<p>
							<label><?php echo __($event_image_text . ' 2', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img2">
								<input id="event_gallery_img2" type="text" size="100" name="event_gallery_img2" value="<?php echo $event_gallery_img2; ?>" /><input id="event_gallery_img2_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
						<p>
							<label><?php echo __($event_image_text . ' 3', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img3">
								<input id="event_gallery_img3" type="text" size="100" name="event_gallery_img3" value="<?php echo $event_gallery_img3; ?>" /><input id="event_gallery_img3_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
						<p>
							<label><?php echo __($event_image_text . ' 4', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img4">
								<input id="event_gallery_img4" type="text" size="100" name="event_gallery_img4" value="<?php echo $event_gallery_img4; ?>" /><input id="event_gallery_img4_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
						<p>
							<label><?php echo __($event_image_text . ' 5', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img5">
								<input id="event_gallery_img5" type="text" size="100" name="event_gallery_img5" value="<?php echo $event_gallery_img5; ?>" /><input id="event_gallery_img5_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
						<p>
							<label><?php echo __($event_image_text . ' 6', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img6">
								<input id="event_gallery_img6" type="text" size="100" name="event_gallery_img6" value="<?php echo $event_gallery_img6; ?>" /><input id="event_gallery_img6_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
						<p>
							<label><?php echo __($event_image_text . ' 7', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img7">
								<input id="event_gallery_img7" type="text" size="100" name="event_gallery_img7" value="<?php echo $event_gallery_img7; ?>" /><input id="event_gallery_img7_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
						<p>
							<label><?php echo __($event_image_text . ' 8', 'jt-event-calendar'); ?></label>
							<label for="event_gallery_img8">
								<input id="event_gallery_img8" type="text" size="100" name="event_gallery_img8" value="<?php echo $event_gallery_img8; ?>" /><input id="event_gallery_img8_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
						</p>
					</div>
					
					<div class="uk-width-1-2">
						<p>
							<label><?php echo __($event_video_url_text, 'jt-event-calendar'); ?></label>
							<input type="url" size="80" name="event_video_url" value="<?php echo $event_video_url; ?>" />
						</p>
						<p>
							<label><?php echo __($event_video_embed_text, 'jt-event-calendar'); ?></label>
							<textarea name="event_video" cols="70" rows="3"><?php echo $event_video; ?></textarea>
						</p>
					</div>
				</div>
			</li>
			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-2">
						<p>
							<label><?php echo __($event_sponsor_text . ' #1', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img1" class="event-gallery-fields">
								<input id="event_sponsor_img1" type="text" size="100" name="event_sponsor_img1" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_img1; ?>" /><input id="event_sponsor_img1_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url1" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>"  value="<?php echo $event_sponsor_url1; ?>">
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #2', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img2" class="event-gallery-fields">
								<input id="event_sponsor_img2" type="text" size="100" name="event_sponsor_img2" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_img2; ?>" /><input id="event_sponsor_img2_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url2" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_url2; ?>">
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #3', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img3" class="event-gallery-fields">
								<input id="event_sponsor_img3" type="text" size="100" name="event_sponsor_img3" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_img3; ?>" /><input id="event_sponsor_img3_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url3" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_url3; ?>">
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #4', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img4" class="event-gallery-fields">
								<input id="event_sponsor_img4" type="text" size="100" name="event_sponsor_img4" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_img4; ?>" /><input id="event_sponsor_img4_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url4" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_url4; ?>">
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #5', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img5" class="event-gallery-fields">
								<input id="event_sponsor_img5" type="text" size="100" name="event_sponsor_img5" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_img5; ?>" /><input id="event_sponsor_img5_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url5" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_url5; ?>">
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #6', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img6" class="event-gallery-fields">
								<input id="event_sponsor_img6" type="text" size="100" name="event_sponsor_img6" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_img6; ?>" /><input id="event_sponsor_img6_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url6" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_sponsor_url6; ?>">
						</p>
					</div>
					<div class="uk-width-1-2">
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #1', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img1" class="event-gallery-fields">
								<input id="event_media_sponsor_img1" type="text" size="100" name="event_media_sponsor_img1" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_img1; ?>" /><input id="event_media_sponsor_img1_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url1" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_url1; ?>">
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #2', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img2" class="event-gallery-fields">
								<input id="event_media_sponsor_img2" type="text" size="100" name="event_media_sponsor_img2" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_img2; ?>" /><input id="event_media_sponsor_img2_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url2" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_url2; ?>">
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #3', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img3" class="event-gallery-fields">
								<input id="event_media_sponsor_img3" type="text" size="100" name="event_media_sponsor_img3" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_img3; ?>" /><input id="event_media_sponsor_img3_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url3" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_url3; ?>">
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #4', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img4" class="event-gallery-fields">
								<input id="event_media_sponsor_img4" type="text" size="100" name="event_media_sponsor_img4" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_img4; ?>" /><input id="event_media_sponsor_img4_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url4" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_url4; ?>">
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #5', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img5" class="event-gallery-fields">
								<input id="event_media_sponsor_img5" type="text" size="100" name="event_media_sponsor_img5" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_img5; ?>" /><input id="event_media_sponsor_img5_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url5" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_url5; ?>">
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #6', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img6" class="event-gallery-fields">
								<input id="event_media_sponsor_img6" type="text" size="100" name="event_media_sponsor_img6" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_img6; ?>" /><input id="event_media_sponsor_img6_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url6" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" value="<?php echo $event_media_sponsor_url6; ?>">
						</p>
					</div>
				</div>
			</li>
		</ul>
	</div>


	<div class="event-form-section">
		<h3 class="section-title"><span><?php echo __($event_settings_text, 'jt-event-calendar'); ?></span></h3>
		<div class="uk-grid event-form-fields">
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($event_countdown_timer_text, 'jt-event-calendar'); ?></label>
					<select name="event_countdown">
						<option value="no" <?php selected( $event_countdown, 'no' ); ?>><?php echo __($event_no_text, 'jt-event-calendar'); ?></option>
						<option value="yes" <?php selected( $event_countdown, 'yes' ); ?>><?php echo __($event_yes_text, 'jt-event-calendar'); ?></option>
					</select>
				</p>
			</div>
			
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($event_enable_registration_text, 'jt-event-calendar'); ?></label>
					<select name="event_registration_form">
						<option value="no" <?php selected( $event_registration_form, 'no' ); ?>><?php echo __($event_no_text, 'jt-event-calendar'); ?></option>
						<option value="yes" <?php selected( $event_registration_form, 'yes' ); ?>><?php echo __($event_yes_text, 'jt-event-calendar'); ?></option>
					</select>
				</p>
				<p>
					<label><?php echo __($event_custom_registration_text, 'jt-event-calendar'); ?></label>
					<input type="text" name="event_custom_registration_form" placeholder="<?php echo __($event_custom_form_shortcode_text, 'jt-event-calendar'); ?>" value="<?php echo $event_custom_registration_form; ?>">
				</p>
			</div>
		</div>
	</div>
    <?php
}



function display_event_registration_meta_box( $registration ) {
	
	wp_register_style('uikit.css', plugins_url('/css/uikit.css',__FILE__ ));
	wp_enqueue_style('uikit.css');
	
    $event_firstname = esc_html( get_post_meta( $registration->ID, 'first_name', true ) );
    $event_lastname = esc_html( get_post_meta( $registration->ID, 'last_name', true ) );
    $event_email = esc_html( get_post_meta( $registration->ID, 'email', true ) );
    $event_phone_number = esc_html( get_post_meta( $registration->ID, 'phone_number', true ) );
    $event_persons = esc_html( get_post_meta( $registration->ID, 'num_of_persons', true ) );
	$event_day = esc_html( get_post_meta( $registration->ID, 'event_day', true ) );
	$event_time = esc_html( get_post_meta( $registration->ID, 'event_hour', true ) );
	
	$translate = get_option('jt_event_translations');
	include ( dirname( __FILE__ ) . '/settings/variables.php');
	include ( dirname( __FILE__ ) . '/settings/strings.php');
    ?>
	<div class="event-form-section">
		<h3 class="section-title"><span><?php echo __($info_text, 'jt-event-calendar'); ?></span></h3>
		<div class="uk-grid event-form-fields">
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($firstname_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="first_name" value="<?php echo $event_firstname; ?>" />
				</p>
				<p>
					<label><?php echo __($lastname_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="last_name" value="<?php echo $event_lastname; ?>" />
				</p>
				<p>
					<label><?php echo __($email_text, 'jt-event-calendar'); ?></label>
					<input type="email" size="80" name="email" value="<?php echo $event_email; ?>" />
				</p>
				<p>
					<label><?php echo __($phone_number_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="phone_number" value="<?php echo $event_phone_number; ?>" />
				</p>
			</div>
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($num_of_persons_text, 'jt-event-calendar'); ?></label>
					<input type="text" size="80" name="num_of_persons" value="<?php echo $event_persons; ?>" />
				</p>
				<p>
					<label><?php echo __($day_text, 'jt-event-calendar'); ?></label>
					<input type="date" name="event_day" value="<?php echo $event_day; ?>" />
				</p>
				<p>
					<label><?php echo __($time_text, 'jt-event-calendar'); ?></label>
					<input type="time" name="event_hour" value="<?php echo $event_time; ?>" />
				</p>
			</div>
		</div>
	</div>
<?php		
}

add_action( 'save_post', 'add_event_fields', 10, 2 );
function add_event_fields( $event_id, $event ) {
    // Check post type for movie reviews
    if ( $event->post_type == 'events_list' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['event_short_info'] )) {
            update_post_meta( $event->ID, 'event_short_info', $_POST['event_short_info'] );
        }
        if ( isset( $_POST['event_info'] )) {
            update_post_meta( $event->ID, 'event_info', $_POST['event_info'] );
        }
        if ( isset( $_POST['event_location'] )) {
            update_post_meta( $event->ID, 'event_location', $_POST['event_location'] );
        }
        if ( isset( $_POST['event_map'] )) {
            update_post_meta( $event->ID, 'event_map', $_POST['event_map'] );
        }
        if ( isset( $_POST['event_start_date'] )) {
            update_post_meta( $event->ID, 'event_start_date', date_i18n("Y/m/d", strtotime($_POST['event_start_date'])) );
        }
        if ( isset( $_POST['event_end_date'] )) {
            update_post_meta( $event->ID, 'event_end_date', date_i18n("Y/m/d", strtotime($_POST['event_end_date'])) );
        }
        if ( isset( $_POST['event_time'] )) {
            update_post_meta( $event->ID, 'event_time', $_POST['event_time'] );
        }
        if ( isset( $_POST['event_free_entrance'] )) {
            update_post_meta( $event->ID, 'event_free_entrance', $_POST['event_free_entrance'] );
        }
        if ( isset( $_POST['event_sold_out'] )) {
            update_post_meta( $event->ID, 'event_sold_out', $_POST['event_sold_out'] );
        }
        if ( isset( $_POST['event_ticket_price'] )) {
            update_post_meta( $event->ID, 'event_ticket_price', $_POST['event_ticket_price'] );
        }
        if ( isset( $_POST['event_video_url'] )) {
            update_post_meta( $event->ID, 'event_video_url', $_POST['event_video_url'] );
        }
        if ( isset( $_POST['event_video'] )) {
            update_post_meta( $event->ID, 'event_video', $_POST['event_video'] );
        }
        if ( isset( $_POST['event_link_text'] )) {
            update_post_meta( $event->ID, 'event_link_text', $_POST['event_link_text'] );
        }
        if ( isset( $_POST['event_link_url'] )) {
            update_post_meta( $event->ID, 'event_link_url', $_POST['event_link_url'] );
        }
        if ( isset( $_POST['event_gallery_img1'] )) {
            update_post_meta( $event->ID, 'event_gallery_img1', $_POST['event_gallery_img1'] );
        }
        if ( isset( $_POST['event_gallery_img2'] )) {
            update_post_meta( $event->ID, 'event_gallery_img2', $_POST['event_gallery_img2'] );
        }
        if ( isset( $_POST['event_gallery_img3'] )) {
            update_post_meta( $event->ID, 'event_gallery_img3', $_POST['event_gallery_img3'] );
        }
        if ( isset( $_POST['event_gallery_img4'] )) {
            update_post_meta( $event->ID, 'event_gallery_img4', $_POST['event_gallery_img4'] );
        }
        if ( isset( $_POST['event_gallery_img5'] )) {
            update_post_meta( $event->ID, 'event_gallery_img5', $_POST['event_gallery_img5'] );
        }
        if ( isset( $_POST['event_gallery_img6'] )) {
            update_post_meta( $event->ID, 'event_gallery_img6', $_POST['event_gallery_img6'] );
        }
        if ( isset( $_POST['event_gallery_img7'] )) {
            update_post_meta( $event->ID, 'event_gallery_img7', $_POST['event_gallery_img7'] );
        }
        if ( isset( $_POST['event_gallery_img8'] )) {
            update_post_meta( $event->ID, 'event_gallery_img8', $_POST['event_gallery_img8'] );
        }
        if ( isset( $_POST['event_sponsor_img1'] )) {
            update_post_meta( $event->ID, 'event_sponsor_img1', $_POST['event_sponsor_img1'] );
        }
        if ( isset( $_POST['event_sponsor_img2'] )) {
            update_post_meta( $event->ID, 'event_sponsor_img2', $_POST['event_sponsor_img2'] );
        }
        if ( isset( $_POST['event_sponsor_img3'] )) {
            update_post_meta( $event->ID, 'event_sponsor_img3', $_POST['event_sponsor_img3'] );
        }
        if ( isset( $_POST['event_sponsor_img4'] )) {
            update_post_meta( $event->ID, 'event_sponsor_img4', $_POST['event_sponsor_img4'] );
        }
        if ( isset( $_POST['event_sponsor_img5'] )) {
            update_post_meta( $event->ID, 'event_sponsor_img5', $_POST['event_sponsor_img5'] );
        }
        if ( isset( $_POST['event_sponsor_img6'] )) {
            update_post_meta( $event->ID, 'event_sponsor_img6', $_POST['event_sponsor_img6'] );
        }
        if ( isset( $_POST['event_sponsor_url1'] )) {
            update_post_meta( $event->ID, 'event_sponsor_url1', $_POST['event_sponsor_url1'] );
        }
        if ( isset( $_POST['event_sponsor_url2'] )) {
            update_post_meta( $event->ID, 'event_sponsor_url2', $_POST['event_sponsor_url2'] );
        }
        if ( isset( $_POST['event_sponsor_url3'] )) {
            update_post_meta( $event->ID, 'event_sponsor_url3', $_POST['event_sponsor_url3'] );
        }
        if ( isset( $_POST['event_sponsor_url4'] )) {
            update_post_meta( $event->ID, 'event_sponsor_url4', $_POST['event_sponsor_url4'] );
        }
        if ( isset( $_POST['event_sponsor_url5'] )) {
            update_post_meta( $event->ID, 'event_sponsor_url5', $_POST['event_sponsor_url5'] );
        }
        if ( isset( $_POST['event_sponsor_url6'] )) {
            update_post_meta( $event->ID, 'event_sponsor_url6', $_POST['event_sponsor_url6'] );
        }
        if ( isset( $_POST['event_media_sponsor_img1'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_img1', $_POST['event_media_sponsor_img1'] );
        }
        if ( isset( $_POST['event_media_sponsor_img2'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_img2', $_POST['event_media_sponsor_img2'] );
        }
        if ( isset( $_POST['event_media_sponsor_img3'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_img3', $_POST['event_media_sponsor_img3'] );
        }
        if ( isset( $_POST['event_media_sponsor_img4'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_img4', $_POST['event_media_sponsor_img4'] );
        }
        if ( isset( $_POST['event_media_sponsor_img5'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_img5', $_POST['event_media_sponsor_img5'] );
        }
        if ( isset( $_POST['event_media_sponsor_img6'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_img6', $_POST['event_media_sponsor_img6'] );
        }
        if ( isset( $_POST['event_media_sponsor_url1'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_url1', $_POST['event_media_sponsor_url1'] );
        }
        if ( isset( $_POST['event_media_sponsor_url2'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_url2', $_POST['event_media_sponsor_url2'] );
        }
        if ( isset( $_POST['event_media_sponsor_url3'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_url3', $_POST['event_media_sponsor_url3'] );
        }
        if ( isset( $_POST['event_media_sponsor_url4'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_url4', $_POST['event_media_sponsor_url4'] );
        }
        if ( isset( $_POST['event_media_sponsor_url5'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_url5', $_POST['event_media_sponsor_url5'] );
        }
        if ( isset( $_POST['event_media_sponsor_url6'] )) {
            update_post_meta( $event->ID, 'event_media_sponsor_url6', $_POST['event_media_sponsor_url6'] );
        }
        if ( isset( $_POST['event_special_guests'] )) {
            update_post_meta( $event->ID, 'event_special_guests', $_POST['event_special_guests'] );
        }
        if ( isset( $_POST['event_schedule'] )) {
            update_post_meta( $event->ID, 'event_schedule', $_POST['event_schedule'] );
        }
        if ( isset( $_POST['event_schedule_file'] )) {
            update_post_meta( $event->ID, 'event_schedule_file', $_POST['event_schedule_file'] );
        }
        if ( isset( $_POST['event_available_seats'] )) {
            update_post_meta( $event->ID, 'event_available_seats', $_POST['event_available_seats'] );
        }
        if ( isset( $_POST['event_countdown'] )) {
            update_post_meta( $event->ID, 'event_countdown', $_POST['event_countdown'] );
        }
        if ( isset( $_POST['event_registration_form'] )) {
            update_post_meta( $event->ID, 'event_registration_form', $_POST['event_registration_form'] );
        }
        if ( isset( $_POST['event_custom_registration_form'] )) {
            update_post_meta( $event->ID, 'event_custom_registration_form', $_POST['event_custom_registration_form'] );
        }
    }
}


add_action( 'save_post', 'add_registration_fields', 10, 2 );
function add_registration_fields( $registration_id, $registration ) {
    // Check post type for destinations
    if ( $registration->post_type == 'event_registrations' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['first_name'] )) {
            update_post_meta( $registration->ID, 'first_name', $_POST['first_name'] );
        }
        if ( isset( $_POST['last_name'] )) {
            update_post_meta( $registration->ID, 'last_name', $_POST['last_name'] );
        }
        if ( isset( $_POST['email'] )) {
            update_post_meta( $registration->ID, 'email', $_POST['email'] );
        }
        if ( isset( $_POST['phone_number'] )) {
            update_post_meta( $registration->ID, 'phone_number', $_POST['phone_number'] );
        }
        if ( isset( $_POST['num_of_persons'] )) {
            update_post_meta( $registration->ID, 'num_of_persons', $_POST['num_of_persons'] );
        }
        if ( isset( $_POST['event_day'] )) {
            update_post_meta( $registration->ID, 'event_day', $_POST['event_day'] );
        }
        if ( isset( $_POST['event_hour'] )) {
            update_post_meta( $registration->ID, 'event_hour', $_POST['event_hour'] );
        }
	}
}


function event_calendar_shortcode($atts)
{
	$jt = shortcode_atts( array(
		'title' => '',
		'cat' => '',
        'num' => '-1',
		'style' => 'default',
		'month' => '',
		'author' => '',
    ), $atts );
	
    ob_start();
	if ( $jt['style'] == 'default') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'default-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default-2.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'default-3') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default-3.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'default-4') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default-4.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-2.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-3-col') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-3-col.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-4-cols') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-4-cols.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-5-cols') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-5-cols.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-overlay') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-overlay.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-overlay-text-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-overlay-text-2.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-overlay-text-right') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-overlay-text-right.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-rounded-image') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-rounded-image.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'overlay-text') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/overlay-text.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'overlay-text-hover') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/overlay-text-hover.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'slideset-overlay') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/slideset-overlay.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'slideset-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/slideset-2.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'slideset-2-columns') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/slideset-2-columns.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'sidebar-rounded-image') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/sidebar-rounded-image.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list-2.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list-3') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list-3.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list-4') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list-4.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list-5') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list-5.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list-6') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list-6.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list-7') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list-7.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'small-list-8') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/small-list-8.php');
		$output = ob_get_clean();
		return $output;
	}
	
}
add_shortcode('events_list', 'event_calendar_shortcode');


function event_calendar_submission_shortcode($atts)
{
	$jtevent = shortcode_atts( array(
		'style' => 'default'
	), $atts );
	
    ob_start();
	if ( $jtevent['style'] == 'default') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/pages/submit-event.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtevent['style'] == 'default-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/pages/submit-event-2.php');
		$output = ob_get_clean();
		return $output;
	}
	
}
add_shortcode('submit_event', 'event_calendar_submission_shortcode');

function jt_event_item_shortcode($atts)
{
	$jtevent_item = shortcode_atts( array(
		'slug' => '',
		'style' => 'default',
    ), $atts );
	
    ob_start();
	if ( $jtevent_item['style'] == 'default') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/single-event/default.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtevent_item['style'] == 'default-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/single-event/default-2.php');
		$output = ob_get_clean();
		return $output;
	}
}
add_shortcode('single_event', 'jt_event_item_shortcode');

// Creating the widget 
class jt_events extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_events', 

		// Widget name will appear in UI
		__('JT Events Widget', 'jt-event-calendar'), 

		// Widget description
		array( 'description' => __( 'Display your events in a modern and responsive way', 'jt-event-calendar' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		$number_of_events = $instance['number_of_events'];
		$cat = $instance['category'];
		$date_format = $instance['date_format'];
		
		wp_register_script('jt_uikit_js', plugins_url('/js/uikit.min.js',__FILE__ ));
		wp_enqueue_script('jt_uikit_js');
		wp_register_style( 'uikit.css', plugin_dir_url(__FILE__).'css/uikit.css' );
		wp_enqueue_style( 'uikit.css' );
		wp_register_style('jt_event_calendar', plugins_url('/css/style.css',__FILE__ ));
		wp_enqueue_style('jt_event_calendar');
		wp_style_add_data( 'jt_event_calendar', 'rtl', 'replace' );
		wp_register_style( 'slidenav.css', plugin_dir_url(__FILE__).'css/slidenav.min.css' );
		wp_enqueue_style( 'slidenav.css' );
		
		// before and after widget arguments are defined by themes
		echo $widget_args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $widget_args['before_title'];
		
			echo $title;
		
			echo $widget_args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'event-default') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/default.php');
		}
		if ($style == 'event-default-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/default-2.php');
		}
		else if ($style == 'event-transparent-bg') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/transparent-bg.php');
		}
		else if ($style == 'event-grid') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid.php');
		}
		else if ($style == 'event-grid-3-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-3-cols.php');
		}
		else if ($style == 'event-grid-5-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-5-cols.php');
		}
		else if ($style == 'event-grid-overlay') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-overlay.php');
		}
		else if ($style == 'event-overlay-text') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/overlay-text.php');
		}
		else if ($style == 'event-overlay-text-hover') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/overlay-text-hover.php');
		}
		else if ($style == 'event-slideset-overlay') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/overlay-slideset.php');
		}
		else if ($style == 'event-slideset-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/slideset-2.php');
		}
		else if ($style == 'event-small-list') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list.php');
		}
		else if ($style == 'event-small-list-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-2.php');
		}
		else if ($style == 'event-small-list-3') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-3.php');
		}
		else if ($style == 'event-small-list-4') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-4.php');
		}
		else if ($style == 'event-small-list-5') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-5.php');
		}
		else if ($style == 'event-small-list-6') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-6.php');
		}
		else if ($style == 'event-grid-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-2.php');
		}
		else if ($style == 'event-default-3') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/default-3.php');
		}
		else if ($style == 'event-default-4') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/default-4.php');
		}
		else if ($style == 'event-grid-rounded-img') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-rounded-image.php');
		}
		else if ($style == 'event-sidebar-rounded-img') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/sidebar-rounded-img.php');
		}
		else if ($style == 'event-small-list-7') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-7.php');
		}
		else if ($style == 'event-small-list-8') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-8.php');
		}
		else if ($style == 'event-slideset-2-columns') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/slideset-2-columns.php');
		}
		else if ($style == 'event-grid-overlay-text-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-overlay-text-2.php');
		}
		else if ($style == 'event-grid-overlay-text-right') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-overlay-text-right.php');
		}
		else if ($style == 'event-grid-4-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/grid-4-cols.php');
		}
		else if ($style == 'event-small-list-9') {
			include( plugin_dir_path( __FILE__ ) . 'styles/events/small-list-9.php');
		}
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		$number_of_events =  isset( $instance['number_of_events'] ) ? $instance[ 'number_of_events' ] : ' ';
		$cat =  isset( $instance['category'] ) ? $instance[ 'category' ] : ' ';
		$date_format =  isset( $instance['date_format'] ) ? $instance[ 'date_format' ] : ' ';
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			
			<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-event-calendar' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-event-calendar' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="event-default" <?php echo ($style == 'event-default')?'selected':''; ?>>Default</option>
						<option value="event-default-2" <?php echo ($style == 'event-default-2')?'selected':''; ?>>Default 2</option>
						<option value="event-default-3" <?php echo ($style == 'event-default-3')?'selected':''; ?>>Default 3</option>
						<option value="event-default-4" <?php echo ($style == 'event-default-4')?'selected':''; ?>>Default 4</option>

						<option value="event-transparent-bg" <?php echo ($style == 'event-transparent-bg')?'selected':''; ?>>Transparent Background</option>
						<option value="event-grid" <?php echo ($style == 'event-grid')?'selected':''; ?>>Grid</option>
						<option value="event-grid-2" <?php echo ($style == 'event-grid-2')?'selected':''; ?>>Grid - 2</option>
						<option value="event-grid-3-cols" <?php echo ($style == 'event-grid-3-cols')?'selected':''; ?>>Grid - 3 columns</option>
						<option value="event-grid-4-cols" <?php echo ($style == 'event-grid-4-cols')?'selected':''; ?>>Grid - 4 columns</option>
						<option value="event-grid-5-cols" <?php echo ($style == 'event-grid-5-cols')?'selected':''; ?>>Grid - 5 columns</option>
						<option value="event-grid-overlay" <?php echo ($style == 'event-grid-overlay')?'selected':''; ?>>Grid - Overlay</option>
						<option value="event-overlay-text" <?php echo ($style == 'event-overlay-text')?'selected':''; ?>>Grid - Overlay Text</option>
						<option value="event-grid-overlay-text-2" <?php echo ($style == 'event-grid-overlay-text-2')?'selected':''; ?>>Grid - Overlay Text 2</option>
						<option value="event-overlay-text-hover" <?php echo ($style == 'event-overlay-text-hover')?'selected':''; ?>>Grid - Overlay Text Hover</option>
						<option value="event-grid-overlay-text-right" <?php echo ($style == 'event-grid-overlay-text-right')?'selected':''; ?>>Grid - Overlay Text Right</option>
						<option value="event-grid-rounded-img" <?php echo ($style == 'event-grid-rounded-img')?'selected':''; ?>>Grid - Rounded Image</option>
						<option value="event-slideset-overlay" <?php echo ($style == 'event-slideset-overlay')?'selected':''; ?>>Slideset - Overlay Text</option>
						<option value="event-slideset-2" <?php echo ($style == 'event-slideset-2')?'selected':''; ?>>Slideset 2</option>
						<option value="event-slideset-2-columns" <?php echo ($style == 'event-slideset-2-columns')?'selected':''; ?>>Slideset - 2 Columns</option>
						<option value="event-small-list" <?php echo ($style == 'event-small-list')?'selected':''; ?>>Small List</option>
						<option value="event-small-list-2" <?php echo ($style == 'event-small-list-2')?'selected':''; ?>>Small List 2</option>
						<option value="event-small-list-3" <?php echo ($style == 'event-small-list-3')?'selected':''; ?>>Small List 3</option>
						<option value="event-small-list-4" <?php echo ($style == 'event-small-list-4')?'selected':''; ?>>Small List 4</option>
						<option value="event-small-list-5" <?php echo ($style == 'event-small-list-5')?'selected':''; ?>>Small List 5</option>
						<option value="event-small-list-6" <?php echo ($style == 'event-small-list-6')?'selected':''; ?>>Small List 6</option>

						<option value="event-small-list-7" <?php echo ($style == 'event-small-list-7')?'selected':''; ?>>Small list 7</option>
						<option value="event-small-list-8" <?php echo ($style == 'event-small-list-8')?'selected':''; ?>>Small list 8</option>
						<option value="event-small-list-9" <?php echo ($style == 'event-small-list-9')?'selected':''; ?>>Small list 9</option>
						<option value="event-sidebar-rounded-img" <?php echo ($style == 'event-sidebar-rounded-img')?'selected':''; ?>>Sidebar - Rounded Image</option>
						
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'number_of_events' ); ?>"><?php _e( 'Number of events:', 'jt-event-calendar' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_events' ); ?>" name="<?php echo $this->get_field_name( 'number_of_events' ); ?>" type="text" value="<?php echo esc_attr( $number_of_events ); ?>" />
				</p>
				<p>
				<?php
					$terms = get_terms( 'events_categories' );
					if ( ! empty( $terms ) ) {
				?>
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'jt-event-calendar' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
						<option value="all" <?php echo ($cat == 'all')?'selected':''; ?>><?php _e('All Categories'); ?></option>
						<?php
					 		foreach ( $terms as $term ) {
						 ?>
						<option value="<?php echo $term->slug; ?>" <?php echo ($cat == $term->slug)?'selected':''; ?>><?php echo $term->name; ?></option>
						<?php
							}
						?>
				</select>
				<?php
					}
				?>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'date_format' ); ?>"><?php _e( 'Date Format:', 'jt-event-calendar' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'date_format' ); ?>" name="<?php echo $this->get_field_name( 'date_format' ); ?>">
						<option value="dFY" <?php echo ($date_format == 'dFY')?'selected':''; ?>>01 January 2017</option>
						<option value="dF" <?php echo ($date_format == 'dF')?'selected':''; ?>>01 January</option>
						<option value="Fd" <?php echo ($date_format == 'Fd')?'selected':''; ?>>January 01</option>
						<option value="dMY" <?php echo ($date_format == 'dMY')?'selected':''; ?>>01 Jan 2017</option>
						<option value="dM" <?php echo ($date_format == 'dM')?'selected':''; ?>>01 Jan</option>
						<option value="Md" <?php echo ($date_format == 'Md')?'selected':''; ?>>Jan 01</option>
						<option value="dmY" <?php echo ($date_format == 'dmY')?'selected':''; ?>>01/02/2017 (DD/MM/YYYY)</option>
						<option value="mdY" <?php echo ($date_format == 'mdY')?'selected':''; ?>>02/01/2017 (MM/DD/YYYY)</option>
					</select>
				</p>
			</div>
			
		</div>
	</div>
	<?php 
	}
	
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
    
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = $new_instance['style'];
		$instance['number_of_events'] = $new_instance['number_of_events'];
		$instance['category'] = $new_instance['category'];
		$instance['date_format'] = $new_instance['date_format'];
		
		return $instance;
	}

} // Class wpb_widget ends here



// Creating the widget 
class jt_events_advanced_search extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_events_advanced_search', 

		// Widget name will appear in UI
		__('JT Events - Advanced Search', 'jt-event-calendar'), 

		// Widget description
		array( 'description' => __( 'Advanced Search Form for JT Event Calendar plugin', 'jt-event-calendar' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		
		// before and after widget arguments are defined by themes
		echo $widget_args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $widget_args['before_title'];
		
			echo $title;
		
			echo $widget_args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'search-default') {
			include( plugin_dir_path( __FILE__ ) . 'styles/advanced-search/default.php');
		}
		else if ($style == 'search-default-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/advanced-search/default-2.php');
		}
		else if ($style == 'search-default-3') {
			include( plugin_dir_path( __FILE__ ) . 'styles/advanced-search/default-3.php');
		}
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			
			<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-event-calendar' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-event-calendar' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="search-default" <?php echo ($style == 'search-default')?'selected':''; ?>>Default</option>
						<option value="search-default-2" <?php echo ($style == 'search-default-2')?'selected':''; ?>>Default 2</option>
						<option value="search-default-3" <?php echo ($style == 'search-default-3')?'selected':''; ?>>Default 3</option>
					</select>

				</p>
			</div>
			
		</div>
	</div>
	<?php 
	}
	
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
    
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = $new_instance['style'];
		
		return $instance;
	}

} // Class wpb_widget ends here



// Creating the widget 
class jt_events_simple_search extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_events_simple_search', 

		// Widget name will appear in UI
		__('JT Events - Simple Search', 'jt-event-calendar'), 

		// Widget description
		array( 'description' => __( 'Simple Search Form for JT Event Calendar plugin', 'jt-event-calendar' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		
		// before and after widget arguments are defined by themes
		echo $widget_args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $widget_args['before_title'];
		
			echo $title;
		
			echo $widget_args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'default') {
			include( plugin_dir_path( __FILE__ ) . 'styles/simple-search/default.php');
		}
		else if ($style == 'default-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/simple-search/default-2.php');
		}
		else if ($style == 'default-3') {
			include( plugin_dir_path( __FILE__ ) . 'styles/simple-search/default-3.php');
		}
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			
			<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-event-calendar' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-event-calendar' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="default" <?php echo ($style == 'default')?'selected':''; ?>>Default</option>
						<option value="default-2" <?php echo ($style == 'default-2')?'selected':''; ?>>Default 2</option>
						<option value="default-3" <?php echo ($style == 'default-3')?'selected':''; ?>>Default 3</option>
					</select>

				</p>
			</div>
			
		</div>
	</div>
	<?php 
	}
	
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
    
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = $new_instance['style'];
		
		return $instance;
	}

} // Class wpb_widget ends here



function jt_event_calendar_widget() {
	register_widget( 'jt_events' );
	register_widget( 'jt_events_advanced_search' );
	register_widget( 'jt_events_simple_search' );
}
add_action( 'widgets_init', 'jt_event_calendar_widget' );

function jt_event_calendar_styles() {
	
	wp_register_style('font-awesome', plugin_dir_url(__FILE__).'css/font-awesome.min.css');
	wp_enqueue_style('font-awesome');
	
    if (wp_style_is( 'jsquare-widget.css', 'enqueued' )) {
    	return;
    } else {
       wp_register_style( 'jsquare-widget.css', plugin_dir_url(__FILE__).'css/jsquare-widget.css' );
       wp_enqueue_style( 'jsquare-widget.css' );
    }
	
    if (wp_style_is( 'accordion.css', 'enqueued' )) {
    	return;
    } else {
       wp_register_style( 'accordion.css', plugin_dir_url(__FILE__).'css/accordion.min.css' );
       wp_enqueue_style( 'accordion.css' );
    }
	
	
    if (wp_script_is( 'uikit.js', 'enqueued' )) {
    	return;
    } else {
       wp_register_script( 'uikit.js', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery') );
       wp_enqueue_script( 'uikit.js' );
    }
	
	
    if (wp_script_is( 'accordion.js', 'enqueued' )) {
    	return;
    } else {
       wp_register_script( 'accordion.js', plugin_dir_url(__FILE__).'js/accordion.min.js', array('jquery') );
       wp_enqueue_script( 'accordion.js' );
    }
	
}
add_action( 'widgets_init','jt_event_calendar_styles');


function jt_events_styles() {
	
	   wp_register_style('uikit-slider', plugin_dir_url(__FILE__).'css/slider.min.css');
	   wp_enqueue_style('uikit-slider');
	   wp_register_style('uikit-slidenav', plugin_dir_url(__FILE__).'css/slidenav.min.css');
	   wp_enqueue_style('uikit-slidenav');
	
		wp_register_style('jt_events', plugin_dir_url(__FILE__).'css/jt-events.css');
		wp_enqueue_style('jt_events');
		wp_style_add_data( 'jt_events', 'rtl', 'replace' );
	
		wp_register_style('search-events', plugin_dir_url(__FILE__).'css/search-events.css');
		wp_enqueue_style('search-events');
		wp_style_add_data( 'search-events', 'rtl', 'replace' );
		
		wp_register_style('jt_uikit', plugin_dir_url(__FILE__).'css/uikit.css');
		wp_enqueue_style('jt_uikit');
	   wp_register_style('jt-events-bootstrap', plugin_dir_url(__FILE__).'css/bootstrap.css');
	   wp_enqueue_style('jt-events-bootstrap');
	
	   wp_register_style('jt-event-calendar', plugin_dir_url(__FILE__).'css/jt-event-calendar.css');
	   wp_enqueue_style('jt-event-calendar');
		wp_style_add_data( 'jt-event-calendar', 'rtl', 'replace' );
	
		wp_register_script('uikit_toggle_js', plugin_dir_url(__FILE__).'js/toggle.min.js');
		wp_enqueue_script('uikit_toggle_js');
		wp_register_script('uikit_switcher_js', plugin_dir_url(__FILE__).'js/switcher.min.js');
		wp_enqueue_script('uikit_switcher_js');
		wp_register_script('uikit_lightbox_js', plugin_dir_url(__FILE__).'js/lightbox.min.js');
		wp_enqueue_script('uikit_lightbox_js');
		wp_register_script('uikit_modal_js', plugin_dir_url(__FILE__).'js/modal.min.js');
		wp_enqueue_script('uikit_modal_js');
		wp_register_script('uikit_slideset_js', plugin_dir_url(__FILE__).'js/slideset.min.js');
		wp_enqueue_script('uikit_slideset_js');
	
        wp_register_script('admin-scripts-js', plugin_dir_url(__FILE__) . 'js/admin-scripts.js', array('jquery'));
        wp_enqueue_script('admin-scripts-js');
}
add_action( 'init','jt_events_styles');

add_action('admin_enqueue_scripts', 'jt_events_scripts');
 
function jt_events_scripts() {
        wp_register_script('admin-scripts-js', plugin_dir_url(__FILE__) . 'js/admin-scripts.js', array('jquery'));
        wp_enqueue_script('admin-scripts-js');
	
	   wp_register_style('jt-events-uikit', plugin_dir_url(__FILE__).'css/uikit.css');
	   wp_enqueue_style('jt-events-uikit');
	
	   wp_register_style('jt-events-admin', plugin_dir_url(__FILE__).'css/event-admin.css');
	   wp_enqueue_style('jt-events-admin');
	
       wp_register_script( 'uikit.js', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery') );
       wp_enqueue_script( 'uikit.js' );
		wp_register_script('uikit_toggle_js', plugin_dir_url(__FILE__) . 'js/toggle.min.js', array('jquery'));
		wp_enqueue_script('uikit_toggle_js');
		wp_register_script('uikit_switcher_js', plugin_dir_url(__FILE__) . 'js/switcher.min.js', array('jquery'));
		wp_enqueue_script('uikit_switcher_js');
}

?>
