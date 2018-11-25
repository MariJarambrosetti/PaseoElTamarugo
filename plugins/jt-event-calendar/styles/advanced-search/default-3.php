<?php
	include ( dirname( __FILE__ ) . '/../../settings/variables.php');
	$translations = get_option('jt_event_translations');

	if (!empty ($translations[search_events_text])) {
		$search_events_text = $translations[search_events_text];
	}
	else {
		$search_events_text = 'Search Events';
	}

	if (!empty ($translations[event_from_text])) {
		$event_from_text = $translations[event_from_text];
	}
	else {
		$event_from_text = 'From';
	}

	if (!empty ($translations[event_to_text])) {
		$event_to_text = $translations[event_to_text];
	}
	else {
		$event_to_text = 'To';
	}

	if (!empty ($translations[event_location_text])) {
		$event_location_text = $translations[event_location_text];
	}
	else {
		$event_location_text = 'Location';
	}

	if (!empty ($translations[event_all_locations_text])) {
		$event_all_locations_text = $translations[event_all_locations_text];
	}
	else {
		$event_all_locations_text = 'All locations';
	}

	if (!empty ($translations[event_search_text])) {
		$event_search_text = $translations[event_search_text];
	}
	else {
		$event_search_text = 'Search';
	}

	$args = array("posts_per_page" => -1, "post_type" => array('events_list'));

	$posts_array = get_posts($args);

	$dateArray = array();
	$locationArray = array();

	foreach ($posts_array as $post) {
		$post_type = get_post_type_object( get_post_type($post) );
		$event_date = esc_attr( get_post_meta( $post->ID, 'event_start_date', true ) );
		$event_location = esc_attr( get_post_meta( $post->ID, 'event_location', true ) );
		
		array_push($dateArray, date('Y-m-d', strtotime($event_date)));
		array_push($locationArray, $event_location);
	}
	$dateArray = array_unique($dateArray);
	$locationArray = array_unique($locationArray);
	sort($dateArray);
	sort($locationArray);
?>
<div class="events-advanced-search-3"> 
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="advancedSearchEvents">
		<p>
			<input type="text" name="s" placeholder="<?php echo __($search_events_text, 'jt-event-calendar'); ?>..."/>
		</p>
		
		<p class="date-from">
			<label><?php echo __($event_from_text, 'jt-event-calendar'); ?>:</label>
			<input type="date" name="eventMinDate" min="<?php echo $dateArray[0]; ?>" max="<?php echo end($dateArray); ?>">
		</p>
		
		<p class="date-to">
			<label><?php echo __($event_to_text, 'jt-event-calendar'); ?>:</label>
			<input type="date" name="eventMaxDate" min="<?php echo $dateArray[0]; ?>" max="<?php echo end($dateArray); ?>">
		</p>
		
		<p>
			<label><?php echo __($event_location_text, 'jt-event-calendar'); ?>:</label>
			<select name="eventLocation">
				<option value="all"><?php echo __($event_all_locations_text, 'jt-event-calendar'); ?></option>
				<?php
					for ($i = 0; $i < count($locationArray); $i++) {
				?>
				<option value="<?php echo $locationArray[$i]; ?>"><?php echo $locationArray[$i]; ?></option>
				<?php
					}
				?>
			</select>
		</p>
		
		
		<input type="hidden" name="post_type" value="events_list" />
		<input type="submit" alt="Search" value="<?php echo __($event_search_text, 'jt-event-calendar'); ?>" />
	</form>
 </div>