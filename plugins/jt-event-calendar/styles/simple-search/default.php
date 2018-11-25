<?php
	include ( dirname( __FILE__ ) . '/../../settings/variables.php');
	$translations = get_option('jt_event_translations');

	if (!empty ($translations[search_events_text])) {
		$search_events_text = $translations[search_events_text];
	}
	else {
		$search_events_text = 'Search Events';
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

	foreach ($posts_array as $post) {
		$post_type = get_post_type_object( get_post_type($post) );
		$event_date = esc_attr( get_post_meta( $post->ID, 'event_start_date', true ) );
		
		array_push($dateArray, date('Y-m-d', strtotime($event_date)));
	}
	$dateArray = array_unique($dateArray);
	sort($dateArray);
?>
<div class="events-simple-search"> 
    <form role="search" action="<?php echo site_url('/'); ?>" method="get" id="simpleSearchEvents">
		<p>
			<input type="text" name="s" placeholder="<?php echo __($search_events_text, 'jt-event-calendar'); ?>..."/>
		</p>
		
		<input type="hidden" name="eventLocation" value="all">
		<input type="hidden" name="eventMinDate" value="<?php echo $dateArray[0]; ?>">
		<input type="hidden" name="eventMaxDate" value="<?php echo end($dateArray); ?>">
		<input type="hidden" name="post_type" value="events_list" />
		<input type="submit" alt="Search" value="<?php echo __($event_search_text, 'jt-event-calendar'); ?>" />
	</form>
 </div>