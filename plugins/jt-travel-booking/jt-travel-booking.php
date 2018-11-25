<?php
/*
Plugin Name: JT Travel Booking
Plugin URI: http://www.jsquare-themes.com
Description: Booking system for travel agencies
Version: 6.0.2
Text Domain: jt-travel-booking
Author: JSquare Themes
Author URI: http://www.jsquare-themes.com
License: GPLv2 or later
*/

defined('ABSPATH') or die;

add_action( 'init', 'create_destinations_list' );
function create_destinations_list() {
	
	$option = get_option('jt_travel_booking_settings');
	include ( dirname( __FILE__ ) . '/options/variables.php');
	
	$destinations_slug = 'destinations_list';
	if (!empty ($option[destinations_slug])) {
		$destinations_slug = $option[destinations_slug];
	}
	
    register_post_type( 'destinations_list',
        array(
            'labels' => array(
                'name' => __('Destinations', 'jt-travel-booking'),
                'singular_name' => __('Destination', 'jt-travel-booking'),
                'add_new' => __('Add New', 'jt-travel-booking'),
                'add_new_item' => __('Add New Destination', 'jt-travel-booking'),
                'edit' => __('Edit', 'jt-travel-booking'),
                'edit_item' => __('Edit Destination', 'jt-travel-booking'),
                'new_item' => __('New Destination', 'jt-travel-booking'),
                'view' => __('View', 'jt-travel-booking'),
                'view_item' => __('View Destination', 'jt-travel-booking'),
                'search_items' => __('Search Destinations', 'jt-travel-booking'),
                'not_found' => __('No Destinations found', 'jt-travel-booking'),
                'not_found_in_trash' => __('No Destinations found in Trash', 'jt-travel-booking'),
                'parent' => __('Parent Destination', 'jt-travel-booking')
            ),
 
            'public' => true,
            'menu_position' => 25,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( 'destinations_categories' ),
            'menu_icon' => 'dashicons-location',
            'has_archive' => true,
			'rewrite' => array("slug" => $destinations_slug, "with_front" => false),
        )
    );

	register_post_type( 'destinations_booking',
        array(
            'labels' => array(
                'name' => __('Bookings', 'jt-travel-booking'),
                'singular_name' => __('Booking', 'jt-travel-booking'),
                'add_new' => __('Add New', 'jt-travel-booking'),
                'add_new_item' => __('Add New Booking', 'jt-travel-booking'),
                'edit' => __('Edit', 'jt-travel-booking'),
                'edit_item' => __('Edit Booking', 'jt-travel-booking'),
                'new_item' => __('New Booking', 'jt-travel-booking'),
                'view' => __('View', 'jt-travel-booking'),
                'view_item' => __('View Booking', 'jt-travel-booking'),
                'search_items' => __('Search Bookings', 'jt-travel-booking'),
                'not_found' => __('No Bookings found', 'jt-travel-booking'),
                'not_found_in_trash' => __('No Bookings found in Trash', 'jt-travel-booking'),
                'parent' => __('Parent Booking', 'jt-travel-booking')
            ),
 
            'public' => true,
			'show_in_menu' => 'edit.php?post_type=destinations_list',
            'menu_position' => null,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'has_archive' => true,
        )
    );
}

add_action('init', 'register_destinations_category', 0);

function register_destinations_category() {
	$option = get_option('jt_travel_booking_settings');
	include ( dirname( __FILE__ ) . '/options/variables.php');
	
	$destinations_cat_slug = 'destinations_categories';
	if (!empty ($option[destinations_cat_slug])) {
		$destinations_cat_slug = $option[destinations_cat_slug];
	}
    register_taxonomy(
        'destinations_categories',
        'destinations_list',
        array(
            'labels' => array(
                'name' => __('Destination Category', 'jt-travel-booking'),
                'add_new_item' => __('Add New Destination Category', 'jt-travel-booking'),
                'new_item_name' => __('New Destination Category', 'jt-travel-booking')
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
        	'rewrite' => array( 'slug' => $destinations_cat_slug, 'with_front' => false ),
        )
    );
}

function destinations_rewrite_rules($wp_rewrite) {
	$option = get_option('jt_travel_booking_settings');
	include ( dirname( __FILE__ ) . '/options/variables.php');

	$destinations_cat_slug = 'destinations_categories';
	if (!empty ($option[destinations_cat_slug])) {
		$destinations_cat_slug = $option[destinations_cat_slug];
	}
	
    $rewrite_rules = array();
    $terms = get_terms( array('taxonomy' => 'destinations_categories') );
	$destination_url = 'index.php?post_type=destinations_list&destinations_list=$matches[1]&name=$matches[1]';
    foreach ($terms as $term) {    
        $rewrite_rules[ $destinations_cat_slug . '/' . $term->slug . '/([^/]*)$'] = $destination_url;       
    }
    $wp_rewrite->rules = $rewrite_rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'destinations_rewrite_rules');

function destinations_new_link( $permalink, $post ) {
	$option = get_option('jt_travel_booking_settings');
	include ( dirname( __FILE__ ) . '/options/variables.php');
	
	$destinations_cat_slug = 'destinations_categories';
	if (!empty ($option[destinations_cat_slug])) {
		$destinations_cat_slug = $option[destinations_cat_slug];
	}
	
    if( $post->post_type == 'destinations_list' ) {
        $destination_terms = get_the_terms( $post, 'destinations_categories' );
        $category_slug = '';
        foreach ( $destination_terms as $term ) {
        	$category_slug = $term->slug;
        }
        $permalink = get_home_url() ."/" . $destinations_cat_slug . "/" . $category_slug . '/' . $post->post_name;
    }
    return $permalink;
}
add_filter('post_type_link','destinations_new_link',10,2);


add_action( 'admin_init', 'destinations_meta' );
function destinations_meta() {
    add_meta_box( 'destination_meta_box',
        'Destination Details',
        'display_destination_meta_box',
        'destinations_list', 'normal', 'high'
    );
    add_meta_box( 'destination_booking_meta_box',
        'Booking Details',
        'display_destination_booking_meta_box',
        'destinations_booking', 'normal', 'high'
    );
}


include ( dirname( __FILE__ ) . '/options.php');

function display_destination_meta_box( $destination ) {
	
    $destination_days = esc_html( get_post_meta( $destination->ID, 'destination_days', true ) );
    $destination_price = esc_html( get_post_meta( $destination->ID, 'destination_price', true ) );
    $destination_periods = esc_html( get_post_meta( $destination->ID, 'destination_periods', true ) );
    $destination_departures = esc_html( get_post_meta( $destination->ID, 'destination_departures', true ) );
    $destination_transportation = esc_html( get_post_meta( $destination->ID, 'destination_transportation', true ) );
    $destination_transportation_icon = esc_html( get_post_meta( $destination->ID, 'destination_transportation_icon', true ) );
	$destination_map = esc_html( get_post_meta( $destination->ID, 'destination_map', true ) );
	
	$destination_video_url = esc_html( get_post_meta( $destination->ID, 'destination_video_url', true ) );
	$destination_video_embed = esc_html( get_post_meta( $destination->ID, 'destination_video_embed', true ) );
	
	$destination_img1 = esc_html( get_post_meta( $destination->ID, 'destination_img1', true ) );
	$destination_img2 = esc_html( get_post_meta( $destination->ID, 'destination_img2', true ) );
	$destination_img3 = esc_html( get_post_meta( $destination->ID, 'destination_img3', true ) );
	$destination_img4 = esc_html( get_post_meta( $destination->ID, 'destination_img4', true ) );
	$destination_img5 = esc_html( get_post_meta( $destination->ID, 'destination_img5', true ) );
	$destination_img6 = esc_html( get_post_meta( $destination->ID, 'destination_img6', true ) );
	$destination_img7 = esc_html( get_post_meta( $destination->ID, 'destination_img7', true ) );
	$destination_img8 = esc_html( get_post_meta( $destination->ID, 'destination_img8', true ) );
	$destination_img9 = esc_html( get_post_meta( $destination->ID, 'destination_img9', true ) );
	$destination_img10 = esc_html( get_post_meta( $destination->ID, 'destination_img10', true ) );
	$destination_img11 = esc_html( get_post_meta( $destination->ID, 'destination_img11', true ) );
	$destination_img12 = esc_html( get_post_meta( $destination->ID, 'destination_img12', true ) );
	$destination_img13 = esc_html( get_post_meta( $destination->ID, 'destination_img13', true ) );
	$destination_img14 = esc_html( get_post_meta( $destination->ID, 'destination_img14', true ) );
	$destination_img15 = esc_html( get_post_meta( $destination->ID, 'destination_img15', true ) );
	$destination_img16 = esc_html( get_post_meta( $destination->ID, 'destination_img16', true ) );
	$destination_img17 = esc_html( get_post_meta( $destination->ID, 'destination_img17', true ) );
	$destination_img18 = esc_html( get_post_meta( $destination->ID, 'destination_img18', true ) );
	
	$short_info = 'destination_short_info';
    $destination_short_info = get_post_meta( $destination->ID, 'destination_short_info', true );
	
	$info = 'destination_info';
    $destination_info = get_post_meta( $destination->ID, 'destination_info', true );
	
	$daily_program = 'destination_daily_program';
    $destination_daily_program = get_post_meta( $destination->ID, 'destination_daily_program', true );
	
	$hotels = 'destination_hotels';
    $destination_hotels = get_post_meta( $destination->ID, 'destination_hotels', true );
	
	$provisions = 'destination_provisions';
    $destination_provisions = get_post_meta( $destination->ID, 'destination_provisions', true );
	
	$things_to_do = 'destination_things_to_do';
    $destination_things_to_do = get_post_meta( $destination->ID, 'destination_things_to_do', true );
	
	$booking_info = 'destination_booking_info';
    $destination_booking_info = get_post_meta( $destination->ID, 'destination_booking_info', true );
	
	$destination_booking_form = esc_html( get_post_meta( $destination->ID, 'destination_booking_form', true ) );
	$destination_custom_form = esc_html( get_post_meta( $destination->ID, 'destination_custom_form', true ) );
	
	$translate = get_option( 'jt_travel_booking_translations' );
	include ( dirname( __FILE__ ) . '/options/variables.php');
	include ( dirname( __FILE__ ) . '/options/strings.php');
	
    ?>
	<ul id="destination-tabs-nav" class="uk-tab" data-uk-switcher="{connect:'#destination-tabs'}">
		<li><a href=""><?php echo __($travel_basic_info_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_short_info_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_info_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_daily_program_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_hotels_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_provisions_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_things_to_do_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_booking_info_text, 'jt-travel-booking'); ?></a></li>
		<li><a href=""><?php echo __($travel_media_text, 'jt-travel-booking'); ?></a></li>
	</ul>

	<ul id="destination-tabs" class="uk-switcher uk-margin">
		<li>
			<p>
				<label><?php echo __($number_of_days_text, 'jt-travel-booking'); ?></label>
				<input type="text" name="destination_days" min="1" max="31" value="<?php echo $destination_days; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_price_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="destination_price" value="<?php echo $destination_price; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_periods_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="destination_periods" value="<?php echo $destination_periods; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_departures_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="destination_departures" value="<?php echo $destination_departures; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_transportation_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="destination_transportation" value="<?php echo $destination_transportation; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_transportation_icon_text . ' (FontAwesome)', 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="destination_transportation_icon" value="<?php echo $destination_transportation_icon; ?>" />
			</p>
			<p>
				<label><?php echo __('Google Map (Embed Code)', 'jt-travel-booking'); ?></label>
				<textarea rows="5" cols="70" name="destination_map"><?php echo $destination_map; ?></textarea>
			</p>
		</li>
		<li>
			<div class="destination-info-box">
				<?php wp_editor( html_entity_decode(stripcslashes($destination_short_info)), $short_info ); ?>
			</div>
		</li>
		<li>
			<div class="destination-info-box">
				<?php wp_editor( html_entity_decode(stripcslashes($destination_info)), $info ); ?>
			</div>
		</li>
		<li>
			<div class="destination-info-box">
				<?php wp_editor( html_entity_decode(stripcslashes($destination_daily_program)), $daily_program ); ?>
			</div>
		</li>
		<li>
			<div class="destination-info-box">
				<?php wp_editor( html_entity_decode(stripcslashes($destination_hotels)), $hotels ); ?>
			</div>
		</li>
		<li>
			<div class="destination-info-box">
				<?php wp_editor( html_entity_decode(stripcslashes($destination_provisions)), $provisions ); ?>
			</div>
		</li>
		<li>
			<div class="destination-info-box">
				<?php wp_editor( html_entity_decode(stripcslashes($destination_things_to_do)), $things_to_do ); ?>
			</div>
		</li>
		<li>
			<div class="destination-info-box">
				<?php wp_editor( html_entity_decode(stripcslashes($destination_booking_info)), $booking_info ); ?>
			</div>
		</li>
		<li>
			<p>
				<label><?php echo __($travel_video_text . ' URL', 'jt-travel-booking'); ?></label>
				<input type="url" size="80" name="destination_video_url" value="<?php echo $destination_video_url; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_video_text . ' (Embed Code)', 'jt-travel-booking'); ?></label>
				<textarea name="destination_video_embed" cols="70" rows="3"><?php echo $destination_video_embed; ?></textarea>
			</p>
			<hr />
			<h3><?php echo __($travel_photo_gallery_text, 'jt-travel-booking'); ?></h3>
			<p>
				<label for="destination_img1">
					<input id="destination_img1" type="text" size="100" name="destination_img1" class="travel-upload-field" value="<?php echo $destination_img1; ?>" placeholder="Image 1" /><input id="destination_img1_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img2">
					<input id="destination_img2" type="text" size="100" name="destination_img2" class="travel-upload-field" value="<?php echo $destination_img2; ?>" placeholder="Image 2" /><input id="destination_img2_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img3">
					<input id="destination_img3" type="text" size="100" name="destination_img3" class="travel-upload-field" value="<?php echo $destination_img3; ?>" placeholder="Image 3" /><input id="destination_img3_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img4">
					<input id="destination_img4" type="text" size="100" name="destination_img4" class="travel-upload-field" value="<?php echo $destination_img4; ?>" placeholder="Image 4" /><input id="destination_img4_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img5">
					<input id="destination_img5" type="text" size="100" name="destination_img5" class="travel-upload-field" value="<?php echo $destination_img5; ?>" placeholder="Image 5" /><input id="destination_img5_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img6">
					<input id="destination_img6" type="text" size="100" name="destination_img6" class="travel-upload-field" value="<?php echo $destination_img6; ?>" placeholder="Image 6" /><input id="destination_img6_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img7">
					<input id="destination_img7" type="text" size="100" name="destination_img7" class="travel-upload-field" value="<?php echo $destination_img7; ?>" placeholder="Image 7" /><input id="destination_img7_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img8">
					<input id="destination_img8" type="text" size="100" name="destination_img8" class="travel-upload-field" value="<?php echo $destination_img8; ?>" placeholder="Image 8" /><input id="destination_img8_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img9">
					<input id="destination_img9" type="text" size="100" name="destination_img9" class="travel-upload-field" value="<?php echo $destination_img9; ?>" placeholder="Image 9" /><input id="destination_img9_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img10">
					<input id="destination_img10" type="text" size="100" name="destination_img10" class="travel-upload-field" value="<?php echo $destination_img10; ?>" placeholder="Image 10" /><input id="destination_img10_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img11">
					<input id="destination_img11" type="text" size="100" name="destination_img11" class="travel-upload-field" value="<?php echo $destination_img11; ?>" placeholder="Image 11" /><input id="destination_img11_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img12">
					<input id="destination_img12" type="text" size="100" name="destination_img12" class="travel-upload-field" value="<?php echo $destination_img12; ?>" placeholder="Image 12" /><input id="destination_img12_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img13">
					<input id="destination_img13" type="text" size="100" name="destination_img13" class="travel-upload-field" value="<?php echo $destination_img13; ?>" placeholder="Image 13" /><input id="destination_img13_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img14">
					<input id="destination_img14" type="text" size="100" name="destination_img14" class="travel-upload-field" value="<?php echo $destination_img14; ?>" placeholder="Image 14" /><input id="destination_img14_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img15">
					<input id="destination_img15" type="text" size="100" name="destination_img15" class="travel-upload-field" value="<?php echo $destination_img15; ?>" placeholder="Image 15" /><input id="destination_img15_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img16">
					<input id="destination_img16" type="text" size="100" name="destination_img16" class="travel-upload-field" value="<?php echo $destination_img16; ?>" placeholder="Image 16" /><input id="destination_img16_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img17">
					<input id="destination_img17" type="text" size="100" name="destination_img17" class="travel-upload-field" value="<?php echo $destination_img17; ?>" placeholder="Image 17" /><input id="destination_img17_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
			<p>
				<label for="destination_img18">
					<input id="destination_img18" type="text" size="100" name="destination_img18" class="travel-upload-field" value="<?php echo $destination_img18; ?>" placeholder="Image 18" /><input id="destination_img18_button" class="button travel-upload-btn" type="button" value="<?php echo __($travel_upload_text, 'jt-travel-booking'); ?>" />
				</label>
			</p>
		</li>
	</ul>


	<div class="travel-form-section">
		<h3 class="section-title"><span><?php echo __('Settings', 'jt-travel-booking'); ?></span></h3>
		<div class="uk-grid travel-form-fields">
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __('Enable Booking Form', 'jt-travel-booking'); ?></label>
					<select name="destination_booking_form">
						<option value="yes" <?php selected( $destination_booking_form, 'yes' ); ?>><?php echo __('Yes', 'jt-travel-booking'); ?></option>
						<option value="no" <?php selected( $destination_booking_form, 'no' ); ?>><?php echo __('No', 'jt-travel-booking'); ?></option>
					</select>
				</p>
			</div>
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __('Custom Booking Form', 'jt-travel-booking'); ?></label>
					<input id="destination_custom_form" type="text" size="100" name="destination_custom_form" value="<?php echo $destination_custom_form; ?>" placeholder="Add here the shortcode of your form" />
				</p>
			</div>
		</div>
	</div>
    <?php
}


function display_destination_booking_meta_box( $booking ) {
	
	wp_register_style('uikit.css', plugins_url('/css/uikit.css',__FILE__ ));
	wp_enqueue_style('uikit.css');
	
	wp_register_script('uikit.js', plugins_url('/js/uikit.min.js',__FILE__ ), array('jquery'));
	wp_enqueue_script('uikit.js');
	
	wp_register_script('switcher.js', plugins_url('/js/switcher.min.js',__FILE__ ));
	wp_enqueue_script('switcher.js');
	
    $booking_destination = esc_html( get_post_meta( $booking->ID, 'destination', true ) );
    $booking_price = esc_html( get_post_meta( $booking->ID, 'price', true ) );
    $booking_firstname = esc_html( get_post_meta( $booking->ID, 'first_name', true ) );
    $booking_lastname = esc_html( get_post_meta( $booking->ID, 'last_name', true ) );
    $booking_email = esc_html( get_post_meta( $booking->ID, 'email', true ) );
    $booking_phone_number = esc_html( get_post_meta( $booking->ID, 'phone_number', true ) );
    $booking_persons = esc_html( get_post_meta( $booking->ID, 'persons', true ) );
	$booking_departure = esc_html( get_post_meta( $booking->ID, 'departure', true ) );
	$booking_comments = esc_html( get_post_meta( $booking->ID, 'additional_comments', true ) );
	
	$translate = get_option( 'jt_travel_booking_translations' );
	include ( dirname( __FILE__ ) . '/options/variables.php');
	include ( dirname( __FILE__ ) . '/options/strings.php');
    ?>
	<ul id="destination-tabs-nav" class="uk-tab" data-uk-switcher="{connect:'#destination-tabs'}">
		<li><a href=""><?php echo __($travel_info_text, 'jt-travel-booking'); ?></a></li>
	</ul>

	<ul id="destination-tabs" class="uk-switcher uk-margin">
		<li>
			<p>
				<label><?php echo __($travel_destination_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="destination" value="<?php echo $booking_destination; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_price_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="price" value="<?php echo $booking_price; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_first_name_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="first_name" value="<?php echo $booking_firstname; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_last_name_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="last_name" value="<?php echo $booking_lastname; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_email_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="email" value="<?php echo $booking_email; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_phone_number_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="phone_number" value="<?php echo $booking_phone_number; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_number_of_persons_text, 'jt-travel-booking'); ?></label>
				<input type="number" name="persons" value="<?php echo $booking_persons; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_departure_text, 'jt-travel-booking'); ?></label>
				<input type="text" size="80" name="departure" value="<?php echo $booking_departure; ?>" />
			</p>
			<p>
				<label><?php echo __($travel_comments_text, 'jt-travel-booking'); ?></label>
				<textarea cols="82" rows="8" name="additional_comments"><?php echo $booking_comments; ?></textarea>
			</p>
		</li>
	</ul>
<?php		
}

add_action( 'save_post', 'add_destination_fields', 10, 2 );
function add_destination_fields( $destination_id, $destination ) {
    // Check post type for destinations
    if ( $destination->post_type == 'destinations_list' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['destination_days'] )) {
            update_post_meta( $destination->ID, 'destination_days', $_POST['destination_days'] );
        }
        if ( isset( $_POST['destination_price'] )) {
            update_post_meta( $destination->ID, 'destination_price', $_POST['destination_price'] );
        }
        if ( isset( $_POST['destination_periods'] )) {
            update_post_meta( $destination->ID, 'destination_periods', $_POST['destination_periods'] );
        }
        if ( isset( $_POST['destination_departures'] )) {
            update_post_meta( $destination->ID, 'destination_departures', $_POST['destination_departures'] );
        }
        if ( isset( $_POST['destination_transportation'] )) {
            update_post_meta( $destination->ID, 'destination_transportation', $_POST['destination_transportation'] );
        }
        if ( isset( $_POST['destination_transportation_icon'] )) {
            update_post_meta( $destination->ID, 'destination_transportation_icon', $_POST['destination_transportation_icon'] );
        }
        if ( isset( $_POST['destination_map'] )) {
            update_post_meta( $destination->ID, 'destination_map', $_POST['destination_map'] );
        }
        if ( isset( $_POST['destination_short_info'] )) {
            update_post_meta( $destination->ID, 'destination_short_info', $_POST['destination_short_info'] );
        }
        if ( isset( $_POST['destination_info'] )) {
            update_post_meta( $destination->ID, 'destination_info', $_POST['destination_info'] );
        }
        if ( isset( $_POST['destination_daily_program'] )) {
            update_post_meta( $destination->ID, 'destination_daily_program', $_POST['destination_daily_program'] );
        }
        if ( isset( $_POST['destination_hotels'] )) {
            update_post_meta( $destination->ID, 'destination_hotels', $_POST['destination_hotels'] );
        }
        if ( isset( $_POST['destination_provisions'] )) {
            update_post_meta( $destination->ID, 'destination_provisions', $_POST['destination_provisions'] );
        }
        if ( isset( $_POST['destination_things_to_do'] )) {
            update_post_meta( $destination->ID, 'destination_things_to_do', $_POST['destination_things_to_do'] );
        }
        if ( isset( $_POST['destination_booking_info'] )) {
            update_post_meta( $destination->ID, 'destination_booking_info', $_POST['destination_booking_info'] );
        }
        if ( isset( $_POST['destination_img1'] )) {
            update_post_meta( $destination->ID, 'destination_img1', $_POST['destination_img1'] );
        }
        if ( isset( $_POST['destination_img2'] )) {
            update_post_meta( $destination->ID, 'destination_img2', $_POST['destination_img2'] );
        }
        if ( isset( $_POST['destination_img3'] )) {
            update_post_meta( $destination->ID, 'destination_img3', $_POST['destination_img3'] );
        }
        if ( isset( $_POST['destination_img4'] )) {
            update_post_meta( $destination->ID, 'destination_img4', $_POST['destination_img4'] );
        }
        if ( isset( $_POST['destination_img5'] )) {
            update_post_meta( $destination->ID, 'destination_img5', $_POST['destination_img5'] );
        }
        if ( isset( $_POST['destination_img6'] )) {
            update_post_meta( $destination->ID, 'destination_img6', $_POST['destination_img6'] );
        }
        if ( isset( $_POST['destination_img7'] )) {
            update_post_meta( $destination->ID, 'destination_img7', $_POST['destination_img7'] );
        }
        if ( isset( $_POST['destination_img8'] )) {
            update_post_meta( $destination->ID, 'destination_img8', $_POST['destination_img8'] );
        }
        if ( isset( $_POST['destination_img9'] )) {
            update_post_meta( $destination->ID, 'destination_img9', $_POST['destination_img9'] );
        }
        if ( isset( $_POST['destination_img10'] )) {
            update_post_meta( $destination->ID, 'destination_img10', $_POST['destination_img10'] );
        }
        if ( isset( $_POST['destination_img11'] )) {
            update_post_meta( $destination->ID, 'destination_img11', $_POST['destination_img11'] );
        }
        if ( isset( $_POST['destination_img12'] )) {
            update_post_meta( $destination->ID, 'destination_img12', $_POST['destination_img12'] );
        }
        if ( isset( $_POST['destination_img13'] )) {
            update_post_meta( $destination->ID, 'destination_img13', $_POST['destination_img13'] );
        }
        if ( isset( $_POST['destination_img14'] )) {
            update_post_meta( $destination->ID, 'destination_img14', $_POST['destination_img14'] );
        }
        if ( isset( $_POST['destination_img15'] )) {
            update_post_meta( $destination->ID, 'destination_img15', $_POST['destination_img15'] );
        }
        if ( isset( $_POST['destination_img16'] )) {
            update_post_meta( $destination->ID, 'destination_img16', $_POST['destination_img16'] );
        }
        if ( isset( $_POST['destination_img17'] )) {
            update_post_meta( $destination->ID, 'destination_img17', $_POST['destination_img17'] );
        }
        if ( isset( $_POST['destination_img18'] )) {
            update_post_meta( $destination->ID, 'destination_img18', $_POST['destination_img18'] );
        }
        if ( isset( $_POST['destination_video_url'] )) {
            update_post_meta( $destination->ID, 'destination_video_url', $_POST['destination_video_url'] );
        }
        if ( isset( $_POST['destination_video_embed'] )) {
            update_post_meta( $destination->ID, 'destination_video_embed', $_POST['destination_video_embed'] );
        }
        if ( isset( $_POST['destination_booking_form'] )) {
            update_post_meta( $destination->ID, 'destination_booking_form', $_POST['destination_booking_form'] );
        }
        if ( isset( $_POST['destination_custom_form'] )) {
            update_post_meta( $destination->ID, 'destination_custom_form', $_POST['destination_custom_form'] );
        }
    }
}


add_action( 'save_post', 'add_booking_fields', 10, 2 );
function add_booking_fields( $booking_id, $booking ) {
    // Check post type for destinations
    if ( $booking->post_type == 'destinations_booking' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['destination'] )) {
            update_post_meta( $booking->ID, 'destination', $_POST['destination'] );
        }
        if ( isset( $_POST['price'] )) {
            update_post_meta( $booking->ID, 'price', $_POST['price'] );
        }
        if ( isset( $_POST['first_name'] )) {
            update_post_meta( $booking->ID, 'first_name', $_POST['first_name'] );
        }
        if ( isset( $_POST['last_name'] )) {
            update_post_meta( $booking->ID, 'last_name', $_POST['last_name'] );
        }
        if ( isset( $_POST['email'] )) {
            update_post_meta( $booking->ID, 'email', $_POST['email'] );
        }
        if ( isset( $_POST['phone_number'] )) {
            update_post_meta( $booking->ID, 'phone_number', $_POST['phone_number'] );
        }
        if ( isset( $_POST['persons'] )) {
            update_post_meta( $booking->ID, 'persons', $_POST['persons'] );
        }
        if ( isset( $_POST['departure'] )) {
            update_post_meta( $booking->ID, 'departure', $_POST['departure'] );
        }
        if ( isset( $_POST['additional_comments'] )) {
            update_post_meta( $booking->ID, 'additional_comments', $_POST['additional_comments'] );
        }
	}
}

function get_custom_post_type_template($single_template) {
     global $post;

     if ($post->post_type == 'destinations_list') {
          $single_template = dirname( __FILE__ ) . '/single-destinations_list.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'get_custom_post_type_template' );

function destination_facebook_opengraph() {
    global $post;

	if ($post->post_type == 'destinations_list') {
		$img_src = wp_get_attachment_url(get_post_thumbnail_id( $post->ID ), 'medium');
	}
?>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
<?php
}
add_action( 'wp_head', 'destination_facebook_opengraph', 5);

function get_destination_archive_template( $archive_template )
{	
    if( is_archive( 'destinations_list' )) {
        $archive_template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) . '/archive-destinations_list.php';
	}
 
    return $archive_template;
}
add_filter( 'template_include', 'get_destination_archive_template' );


function search_destinations($template) {    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'destinations_list' )   
  {
     $template = WP_PLUGIN_DIR .'/'. plugin_basename( dirname(__FILE__) ) .'/search-destinations.php';
  }   
  return $template;   
}
add_filter('template_include', 'search_destinations');  

function travel_booking_destinations($atts)
{
	$jt = shortcode_atts( array(
		'title' => '',
		'cat' => '',
        'num' => '-1',
		'style' => 'default',
		'orderby' => 'ID',
		'order' => 'DESC',
    ), $atts );
	
    ob_start();
	if ( $jt['style'] == 'default') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-2-cols') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-2-cols.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-3-cols') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-3-cols.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'grid-3-cols-colored') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/grid-3-cols-colored.php');
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
	else if ( $jt['style'] == 'default-slideset') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default-slideset.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'slideset-2-cols') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/slideset-2-cols.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'one-column') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/one-column.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'one-column-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/one-column-2.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jt['style'] == 'one-column-3') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/one-column-3.php');
		$output = ob_get_clean();
		return $output;
	}
	
}
add_shortcode('destinations', 'travel_booking_destinations');


function jt_destination_item_shortcode($atts)
{
	$destination_item = shortcode_atts( array(
		'slug' => '',
		'style' => 'default',
    ), $atts );
	
    ob_start();
	if ( $destination_item['style'] == 'default') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/single-destination/default.php');
		$output = ob_get_clean();
		return $output;
	}
}
add_shortcode('single_destination', 'jt_destination_item_shortcode');

// Creating the widget 
class jt_destinations extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_destinations', 

		// Widget name will appear in UI
		__('JT Destinations', 'jt_destinations_domain'), 

		// Widget description
		array( 'description' => __( 'Display destinations of JT Travel Booking plugin in a modern and responsive way', 'jt_destinations_domain' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		$num_destinations = $instance['num_destinations'];
		$cat = $instance['category'];
		$chars_num = $instance['chars_num'];
		
		
		// before and after widget arguments are defined by themes
		echo $widget_args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $widget_args['before_title'];
		
			echo $title;
		
			echo $widget_args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'default') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default.php');
		}
		if ($style == 'default-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default-2.php');
		}
		else if ($style == 'grid-2-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-2-cols.php');
		}
		else if ($style == 'grid-3-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-3-cols.php');
		}
		else if ($style == 'grid-3-cols-colored') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-3-cols-colored.php');
		}
		else if ($style == 'grid-4-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-4-cols.php');
		}
		else if ($style == 'grid-5-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-5-cols.php');
		}
		else if ($style == 'one-column') {
			include( plugin_dir_path( __FILE__ ) . 'styles/one-column.php');
		}
		else if ($style == 'one-column-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/one-column-2.php');
		}
		else if ($style == 'one-column-3') {
			include( plugin_dir_path( __FILE__ ) . 'styles/one-column-3.php');
		}
		else if ($style == 'slideset') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default-slideset.php');
		}
		else if ($style == 'slideset-2-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-2-cols.php');
		}
		else if ($style == 'two-columns') {
			include( plugin_dir_path( __FILE__ ) . 'styles/two-columns.php');
		}
		else if ($style == 'grid-rounded-img') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-rounded-img.php');
		}
		else if ($style == 'grid-overlay-text') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-overlay-text.php');
		}
		else if ($style == 'grid-4-columns-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-4-columns-2.php');
		}
		else if ($style == 'one-column-4') {
			include( plugin_dir_path( __FILE__ ) . 'styles/one-column-4.php');
		}
		else if ($style == 'slideset-4-columns') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-4-columns.php');
		}
		else if ($style == 'slideset-large-image') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-large-image.php');
		}
		else if ($style == 'slideset-2-columns-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-2-columns-2.php');
		}
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		$num_destinations =  isset( $instance['num_destinations'] ) ? $instance[ 'num_destinations' ] : ' ';
		$cat =  isset( $instance['category'] ) ? $instance[ 'category' ] : ' ';
		$chars_num =  isset( $instance['chars_num'] ) ? $instance[ 'chars_num' ] : ' ';
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			<div class="jt-menu-widget">
				<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			</div>
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-travel-booking' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-travel-booking' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="default" <?php echo ($style == 'default')?'selected':''; ?>>Default</option>
						<option value="default-2" <?php echo ($style == 'default-2')?'selected':''; ?>>Default 2</option>
						<option value="grid-2-cols" <?php echo ($style == 'grid-2-cols')?'selected':''; ?>>Grid - 2 Columns</option>
						<option value="grid-3-cols" <?php echo ($style == 'grid-3-cols')?'selected':''; ?>>Grid - 3 Columns</option>
						<option value="grid-3-cols-colored" <?php echo ($style == 'grid-3-cols-colored')?'selected':''; ?>>Grid - 3 Columns with Color</option>
						<option value="grid-4-cols" <?php echo ($style == 'grid-4-cols')?'selected':''; ?>>Grid - 4 Columns</option>
						<option value="grid-4-columns-2" <?php echo ($style == 'grid-4-columns-2')?'selected':''; ?>>Grid - 4 Columns 2</option>
						<option value="grid-5-cols" <?php echo ($style == 'grid-5-cols')?'selected':''; ?>>Grid - 5 Columns</option>
						<option value="grid-rounded-img" <?php echo ($style == 'grid-rounded-img')?'selected':''; ?>>Grid - Rounded Image</option>
						<option value="grid-overlay-text" <?php echo ($style == 'grid-overlay-text')?'selected':''; ?>>Grid - Overlay Text</option>
						<option value="one-column" <?php echo ($style == 'one-column')?'selected':''; ?>>One Column</option>
						<option value="one-column-2" <?php echo ($style == 'one-column-2')?'selected':''; ?>>One Column 2</option>
						<option value="one-column-3" <?php echo ($style == 'one-column-3')?'selected':''; ?>>One Column 3</option>
						<option value="one-column-4" <?php echo ($style == 'one-column-4')?'selected':''; ?>>One Column 4</option>
						<option value="slideset" <?php echo ($style == 'slideset')?'selected':''; ?>>Slideset</option>
						<option value="slideset-2-cols" <?php echo ($style == 'slideset-2-cols')?'selected':''; ?>>Slideset - 2 Columns</option>
						<option value="slideset-2-columns-2" <?php echo ($style == 'slideset-2-columns-2')?'selected':''; ?>>Slideset - 2 Columns 2</option>
						<option value="slideset-4-columns" <?php echo ($style == 'slideset-4-columns')?'selected':''; ?>>Slideset - 4 Columns</option>
						<option value="two-columns" <?php echo ($style == 'two-columns')?'selected':''; ?>>Two - Columns</option>
						<option value="slideset-large-image" <?php echo ($style == 'slideset-large-image')?'selected':''; ?>>Slideset - Large Image</option>

					</select>
				</p>
				<p>
				<?php
					$terms = get_terms( 'destinations_categories' );
					if ( ! empty( $terms ) ) {
				?>
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'jt-travel-booking' ); ?></label> 
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
					<label for="<?php echo $this->get_field_id( 'num_destinations' ); ?>"><?php _e( 'Number of Destinations:', 'jt-travel-booking' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'num_destinations' ); ?>" name="<?php echo $this->get_field_name( 'num_destinations' ); ?>" type="text" value="<?php echo esc_attr( $num_destinations ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'chars_num' ); ?>"><?php _e( 'Number of Characters:', 'jt-travel-booking' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'chars_num' ); ?>" name="<?php echo $this->get_field_name( 'chars_num' ); ?>" type="text" value="<?php echo esc_attr( $chars_num ); ?>" />
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
		$instance['num_destinations'] = $new_instance['num_destinations'];
		$instance['category'] = $new_instance['category'];
		$instance['chars_num'] = $new_instance['chars_num'];
		
		return $instance;
	}

} // Class wpb_widget ends here

// Creating the widget 
class jt_destinations_search extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_destinations_search', 

		// Widget name will appear in UI
		__('JT Destinations - Search Widget', 'jt_destinations_search_domain'), 

		// Widget description
		array( 'description' => __( 'Give your users the option to search destinations', 'jt_destinations_search_domain' ), ) 
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
			include( plugin_dir_path( __FILE__ ) . 'styles/search/default.php');
		}
		else if ($style == 'default-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/search/default-2.php');
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
			<div class="jt-menu-widget">
				<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			</div>
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-travel-booking' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-travel-booking' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="default" <?php echo ($style == 'default')?'selected':''; ?>>Default</option>
						<option value="default-2" <?php echo ($style == 'default-2')?'selected':''; ?>>Default 2</option>
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

// Register and load the widget
function jt_destinations_widget() {
	register_widget( 'jt_destinations' );
	register_widget( 'jt_destinations_search' );
}
add_action( 'widgets_init', 'jt_destinations_widget' );

function jt_destinations_styles() {
	
	   wp_register_style('font-awesome', plugin_dir_url(__FILE__).'css/font-awesome.min.css');
	   wp_enqueue_style('font-awesome');
		
       wp_register_style( 'uikit.css', plugin_dir_url(__FILE__).'css/uikit.css' );
       wp_enqueue_style( 'uikit.css' );
	
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
       wp_register_script( 'uikit.js', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery'));
       wp_enqueue_script( 'uikit.js' );
    }
	
}
add_action( 'widgets_init','jt_destinations_styles');


function jt_travel_booking_styles() {
	
	   wp_register_style('jquery-ui', plugin_dir_url(__FILE__).'css/jquery-ui.css');
	   wp_enqueue_style('jquery-ui');
	
		wp_register_script('travel_booking_uikit', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery'));
		wp_enqueue_script('travel_booking_uikit');
		wp_register_script('uikit_grid_js', plugin_dir_url(__FILE__).'js/grid.min.js');
		wp_enqueue_script('uikit_grid_js');
		wp_register_script('uikit_toggle_js', plugin_dir_url(__FILE__).'js/toggle.min.js');
		wp_enqueue_script('uikit_toggle_js');
		wp_register_style( 'uikit_slider_css', plugin_dir_url(__FILE__).'css/slider.min.css' );
		wp_enqueue_style( 'uikit_slider_css' );
		wp_register_style('jt-destinations.css', plugin_dir_url(__FILE__).'css/style.css');
		wp_style_add_data( 'jt-destinations', 'rtl', 'replace' );
		wp_enqueue_style('jt-destinations.css');
		wp_register_style( 'destinations-bootstrap', plugin_dir_url(__FILE__).'css/bootstrap.css' );
		wp_enqueue_style( 'destinations-bootstrap' );
		wp_register_style( 'destinations-uikit', plugin_dir_url(__FILE__).'css/uikit.css' );
		wp_enqueue_style( 'destinations-uikit' );
	   wp_register_style('jt-travel-booking', plugin_dir_url(__FILE__).'css/jt-travel-booking.css');
	   wp_enqueue_style('jt-travel-booking');
		wp_style_add_data( 'jt-travel-booking', 'rtl', 'replace' );
		
		wp_register_script('uikit_slideset_js', plugin_dir_url(__FILE__).'js/slideset.min.js');
		wp_enqueue_script('uikit_slideset_js');
		wp_register_style( 'uikit_slidenav_css', plugin_dir_url(__FILE__).'css/slidenav.min.css' );
		wp_enqueue_style( 'uikit_slidenav_css' );
		wp_register_style( 'uikit_notify_css', plugin_dir_url(__FILE__).'css/notify.min.css' );
		wp_enqueue_style( 'uikit_notify_css' );
	
		wp_register_script('uikit_lightbox', plugin_dir_url(__FILE__).'js/lightbox.min.js');
		wp_enqueue_script('uikit_lightbox');
		wp_register_script('uikit_modal', plugin_dir_url(__FILE__).'js/modal.min.js');
		wp_enqueue_script('uikit_modal');
		wp_register_script('uikit_notify', plugin_dir_url(__FILE__).'/js/notify.min.js');
		wp_enqueue_script('uikit_notify');
	
		wp_register_script('jquery-ui', plugin_dir_url(__FILE__).'/js/jquery-ui.min.js');
		wp_enqueue_script('jquery-ui');
		wp_register_script('jt-destinations-search', plugin_dir_url(__FILE__).'/js/search-script.js');
		wp_enqueue_script('jt-destinations-search');
	
		include ( dirname( __FILE__ ) . '/css/colors.php');
	
}
add_action( 'init','jt_travel_booking_styles');


add_action('admin_enqueue_scripts', 'jt_travel_booking_scripts');
 
function jt_travel_booking_scripts() {
        wp_enqueue_media();
        wp_register_script('travel-booking-scripts-js', plugin_dir_url(__FILE__) . '/js/travel-booking-scripts.js', array('jquery'));
        wp_enqueue_script('travel-booking-scripts-js');
	
	   wp_register_style('travel-booking-uikit', plugin_dir_url(__FILE__).'css/uikit.css');
	   wp_enqueue_style('travel-booking-uikit');
	
       wp_register_script( 'travel_booking_uikit', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery') );
       wp_enqueue_script( 'travel_booking_uikit' );
		wp_register_script('uikit_toggle_js', plugin_dir_url(__FILE__) . 'js/toggle.min.js', array('jquery'));
		wp_enqueue_script('uikit_toggle_js');
		wp_register_script('uikit_switcher_js', plugin_dir_url(__FILE__) . 'js/switcher.min.js', array('jquery'));
		wp_enqueue_script('uikit_switcher_js');
}

?>
