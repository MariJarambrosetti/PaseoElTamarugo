<?php
	$current_date = date("Y/m/d");
	$option = get_option('jt_settings');
	include ( dirname( __FILE__ ) . '/../../settings/variables.php');
	
	if ($option[display_past_events] == 0) {
		if ($cat == 'all') {
			$args = array("posts_per_page" => $number_of_events, "post_type" => array('events_list'), 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'meta_query' => array( array( 'meta_key' => 'event_end_date', 'value' => $current_date, 'compare' => '>=', 'type' => 'DATE') ));
		}
		else {
			$args = array("posts_per_page" => $number_of_events, "post_type" => array('events_list'), 'order' => 'ASC', 'meta_query' => array( array( 'meta_key' => 'event_end_date', 'value' => $current_date, 'compare' => '>=', 'type' => 'DATE') ), 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'tax_query' => array(array('taxonomy' => 'events_categories', 'field' => 'slug', 'terms' => $cat)));
		}
	}
	else {
		if ($cat == 'all') {
			$args = array("posts_per_page" => $number_of_events, "post_type" => array('events_list'), 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date');
		}
		else {
			$args = array("posts_per_page" => $number_of_events, "post_type" => array('events_list'), 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'tax_query' => array(array('taxonomy' => 'events_categories', 'field' => 'slug', 'terms' => $cat)));
		}
	}

		$posts_array = get_posts($args);

		// Show these posts in a grid
		foreach($posts_array as $post) {
			$post_type = get_post_type_object( get_post_type($post) );
			$post_cats = get_the_terms( $post->ID, 'events_categories');
			
			echo '<div class="uk-grid jt-event-calendar-transparent">';

				// Create a div that includes the content
				echo '<div class="uk-width-1-10">';

					// Show the image of the event
					$event_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  );
					if ( $event_img != NULL ) {
							echo '<p class="image">';
								if ($option[event_page]) {
									echo '<a href="' . get_permalink( $post->ID ) . '">
									<img class="uk-overlay-scale" src="' . wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ) . '" alt=""></a>';
								} else {
									echo '<img class="uk-overlay-scale" src="' . wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ) . '" alt="">';
								}
							echo '</p>';
					}

				echo '</div>';

				echo '<div class="uk-width-8-10">';

					// Show event info
					$event_start_date = esc_attr( get_post_meta( $post->ID, 'event_start_date', true ) );
					$event_end_date = esc_attr( get_post_meta( $post->ID, 'event_end_date', true ) );
					$event_location = get_post_meta( $post->ID, 'event_location', true );
			
					if ($date_format == 'dFY') {
						$start_date = date_i18n("d F Y", strtotime($event_start_date));
						$end_date = date_i18n("d F Y", strtotime($event_end_date));
					}
					else if ($date_format == 'dF') {
						$start_date = date_i18n("d F", strtotime($event_start_date));
						$end_date = date_i18n("d F", strtotime($event_end_date));
					}
					else if ($date_format == 'Fd') {
						$start_date = date_i18n("F d", strtotime($event_start_date));
						$end_date = date_i18n("F d", strtotime($event_end_date));
					}
					else if ($date_format == 'dMY') {
						$start_date = date_i18n("d M Y", strtotime($event_start_date));
						$end_date = date_i18n("d M Y", strtotime($event_end_date));
					}
					else if ($date_format == 'dM') {
						$start_date = date_i18n("d M", strtotime($event_start_date));
						$end_date = date_i18n("d M", strtotime($event_end_date));
					}
					else if ($date_format == 'Md') {
						$start_date = date_i18n("M d", strtotime($event_start_date));
						$end_date = date_i18n("M d", strtotime($event_end_date));
					}
					else if ($date_format == 'dmY') {
						$start_date = date_i18n("d/m/Y", strtotime($event_start_date));
						$end_date = date_i18n("d/m/Y", strtotime($event_end_date));
					}
					else if ($date_format == 'mdY') {
						$start_date = date_i18n("m/d/Y", strtotime($event_start_date));
						$end_date = date_i18n("m/d/Y", strtotime($event_end_date));
					}
			
					if ( ( ! empty($event_start_date)) || ( ! empty($event_end_date)) || ( ! empty($event_location)) ) {
						echo '<p class="info"><i class="fa fa-calendar"></i> <span class="duration">' . $start_date;
						if ( ! empty($event_end_date)) {
							echo ' - ' . $end_date;
						}
						echo '</span>';
						if ( ! empty($event_location)) {
							echo '<span class="separator">/</span><i class="fa fa-map-marker"></i>' . esc_attr( $event_location );
						}
						
						echo '</p>';
					}

					// Show the event's title
					echo '<p class="title">';
						if ($option[event_page]) {
							echo '<a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>';
						}
						else {
							echo $post->post_title;
						}
					echo '</p>';

					// Show the event's short info if it's not empty
					$event_short_info = get_post_meta( $post->ID, 'event_short_info', true );
			
					if ( ! empty($event_short_info)) {
						echo '<p class="short-info">' . esc_attr( $event_short_info ) . '</p>';
					}

				echo '</div>';
			
				echo '<div class="uk-width-1-10">';

					// Show the link
					$event_link_text = get_post_meta( $post->ID, 'event_link_text', true );
					$event_link_url = get_post_meta( $post->ID, 'event_link_url', true );
			
					if ( ( ! empty($event_link_text)) || ( ! empty($event_link_url)) ) {
						echo '<p class="event-btn"><a href="' . esc_attr( $event_link_url ) . '">' . esc_attr( $event_link_text ) . '</a></p>';
					}
			
				echo '</div>';

			echo '</div>';
	}

?>

		