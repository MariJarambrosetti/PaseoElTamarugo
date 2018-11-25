<?php
	$current_date = date("Y/m/d");
	$option = get_option('jt_settings');
	include ( dirname( __FILE__ ) . '/../settings/variables.php');
	
	if ($option[display_past_events] == 0) {
		$args = array("posts_per_page" => 1, "post_type" => array('events_list'), 'name' => $jtevent_item['slug'], 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'meta_query' => array( array( 'meta_key' => 'event_end_date', 'value' => $current_date, 'compare' => '>=', 'type' => 'DATE') ));
	}
	else {
		$args = array("posts_per_page" => 1, "post_type" => array('events_list'), 'name' => $jtevent_item['slug'], 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date');
	}

		$posts_array = get_posts($args);

		// Show these posts in a grid
		foreach($posts_array as $post) {
			$post_type = get_post_type_object( get_post_type($post) );
			$post_cats = get_the_terms( $post->ID, 'events_categories');
			
			$sold_out = esc_html( get_post_meta( $post->ID, 'event_sold_out', true ) );

			if (!empty ($translations[event_sold_out_text])) {
				$sold_out_text = $translations[event_sold_out_text];
			}
			else {
				$sold_out_text = 'Sold Out';
			}
			
			echo '<div class="uk-grid jt-event-calendar-default-4">';

				// Create a div that includes the content
				echo '<div class="uk-width-1-10">';

					$event_start_date = esc_attr( get_post_meta( $post->ID, 'event_start_date', true ) );
					$event_end_date = esc_attr( get_post_meta( $post->ID, 'event_end_date', true ) );
			
						$start_date_month = date_i18n("M", strtotime($event_start_date));
						$start_date_day = date_i18n("d", strtotime($event_start_date));
			
					// Show the date of the event
					if ( ( !empty ($event_start_date)) || ( !empty($event_end_date) )) {
				?>
					<p class="info">
						<span class="event-month"><?php echo $start_date_month; ?></span>
						<span class="event-day"><?php echo $start_date_day; ?></span>
					</p>
				<?php
					}

				echo '</div>';

				echo '<div class="uk-width-6-10">';

					// Show the event's title if it's not empty
					$event_location = get_post_meta( $post->ID, 'event_location', true );
			
					$event_short_info = get_post_meta( $post->ID, 'event_short_info', true );
			
					echo '<p class="title">';
					if ($option[event_page]) {
						if ($sold_out == 'yes') {
							echo '<a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a><span class="event-sold-out">(' . $sold_out_text . ')</span>';
						}
						else {
							echo '<a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>';
						}
					}
					else {
						if ($sold_out == 'yes') {
							echo $post->post_title . '<span class="event-sold-out">(' . $sold_out_text . ')</span>';
						}
						else {
							echo $post->post_title;
						}
					}
					echo '</p>';

					// Show the event's short info if it's not empty
					if ( !empty ($event_short_info) ) {
						echo '<p class="short-info">' . esc_attr( $event_short_info ) . '</p>';
					}

				echo '</div>';
			
				echo '<div class="uk-width-2-10">';
			
					// Show the location and the location if it's not empty

						if ( !empty ($event_location) ) {
							echo '<span class="event-location"><i class="fa fa-map-marker"></i>' . esc_attr( $event_location ) . '</span>';
						}
						

				echo '</div>';
			
				echo '<div class="uk-width-1-10">';

					$event_link_text = get_post_meta( $post->ID, 'event_link_text', true );
					$event_link_url = get_post_meta( $post->ID, 'event_link_url', true );
			
					// Show the link
					if ( ( !empty ($event_link_text) ) || ( !empty ($event_link_url) ) ) {
						echo '<p class="event-btn"><a href="' . esc_attr( $event_link_url ) . '">' . esc_attr( $event_link_text ) . '</a></p>';
					}
			
				echo '</div>';

			echo '</div>';
	}

?>