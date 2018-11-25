<?php
	$current_date = date("Y/m/d");
	$option = get_option('jt_settings');
	include ( dirname( __FILE__ ) . '/../settings/variables.php');

	echo '<h3 class="events-list-title">' . $jt['title'] . '</h3>';

	if ($option[display_past_events] == 0) {
		if ($jt['cat'] == '') {
			$args = array("posts_per_page" => $jt['num'], "post_type" => array('events_list'), 'author_name' => $jt['author'], 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'meta_query' => array( array( 'meta_key' => 'event_end_date', 'value' => $current_date, 'compare' => '>=', 'type' => 'DATE') ));
		}
		else {
			$args = array("posts_per_page" => $jt['num'], "post_type" => array('events_list'), 'author_name' => $jt['author'], 'order' => 'ASC', 'meta_query' => array( array( 'meta_key' => 'event_end_date', 'value' => $current_date, 'compare' => '>=', 'type' => 'DATE') ), 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'tax_query' => array(array('taxonomy' => 'events_categories', 'field' => 'slug', 'terms' => $jt['cat'])));
		}
	}
	else {
		if ($jt['cat'] == '') {
			$args = array("posts_per_page" => $jt['num'], "post_type" => array('events_list'), 'author_name' => $jt['author'], 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date');
		}
		else {
			$args = array("posts_per_page" => $jt['num'], "post_type" => array('events_list'), 'author_name' => $jt['author'], 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'tax_query' => array(array('taxonomy' => 'events_categories', 'field' => 'slug', 'terms' => $jt['cat'])));
		}
	}

		$posts_array = get_posts($args);

		// Show these posts in a grid
		foreach($posts_array as $post) {
			$post_type = get_post_type_object( get_post_type($post) );

			$sold_out = esc_html( get_post_meta( $post->ID, 'event_sold_out', true ) );

			if (!empty ($translations[event_sold_out_text])) {
				$sold_out_text = $translations[event_sold_out_text];
			}
			else {
				$sold_out_text = 'Sold Out';
			}
			
			$event_start_date = esc_attr( get_post_meta( $post->ID, 'event_start_date', true ) );
			$event_end_date = esc_attr( get_post_meta( $post->ID, 'event_end_date', true ) );
			$event_location = get_post_meta( $post->ID, 'event_location', true );
			

				$month = date("m",strtotime($event_start_date));
			
				if ($jt['month'] == '') {
					echo '<div class="uk-grid jt-events-default">';
				}
				else {
					if ($jt['month'] == $month) {
						echo '<div class="uk-grid jt-events-default">';
					}
					else {
						echo '<div class="uk-grid jt-events-default uk-hidden">';
					}
				}
					// Create a div that includes the content
					echo '<div class="uk-width-3-10">';

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
									if ($sold_out == 'yes') {
										echo '<span class="event-sold-out">' . $sold_out_text . '</span>';
									}
								echo '</p>';
						}

					echo '</div>';

					echo '<div class="uk-width-7-10">';

						// Show event info

						if ($option[date_format] == 'dFY') {
							$start_date = date_i18n("d F Y", strtotime($event_start_date));
							$end_date = date_i18n("d F Y", strtotime($event_end_date));
						}
						else if ($option[date_format] == 'dF') {
							$start_date = date_i18n("d F", strtotime($event_start_date));
							$end_date = date_i18n("d F", strtotime($event_end_date));
						}
						else if ($option[date_format] == 'Fd') {
							$start_date = date_i18n("F d", strtotime($event_start_date));
							$end_date = date_i18n("F d", strtotime($event_end_date));
						}
						else if ($option[date_format] == 'dMY') {
							$start_date = date_i18n("d M Y", strtotime($event_start_date));
							$end_date = date_i18n("d M Y", strtotime($event_end_date));
						}
						else if ($option[date_format] == 'dM') {
							$start_date = date_i18n("d M", strtotime($event_start_date));
							$end_date = date_i18n("d M", strtotime($event_end_date));
						}
						else if ($option[date_format] == 'Md') {
							$start_date = date_i18n("M d", strtotime($event_start_date));
							$end_date = date_i18n("M d", strtotime($event_end_date));
						}
						else if ($option[date_format] == 'dmY') {
							$start_date = date_i18n("d/m/Y", strtotime($event_start_date));
							$end_date = date_i18n("d/m/Y", strtotime($event_end_date));
						}
						else if ($option[date_format] == 'mdY') {
							$start_date = date_i18n("m/d/Y", strtotime($event_start_date));
							$end_date = date_i18n("m/d/Y", strtotime($event_end_date));
						}

						// Show the event's title
						echo '<p class="title">';
						if ($option[event_page]) {
							echo '<a href="' . get_permalink( $post->ID) . '">' . $post->post_title . '</a>';
						}
						else {
							echo $post->post_title;
						}
						echo '</p>';

						// Show the event's short info if it's not empty

						$event_short_info = get_post_meta( $post->ID, 'event_short_info', true );
						if ( !empty ($event_short_info) ) {
							echo '<p class="short-info">' . esc_attr( $event_short_info ) . '</p>';
						}

						if ( ( !empty ($event_date) ) || ( !empty ($event_end_date) ) || ( !empty ($event_location) ) ) {
							echo '<p class="info"><span class="duration"><i class="fa fa-calendar"></i> ' . $start_date;
							if ( !empty ($event_end_date) ) {
								echo ' - ' . $end_date;
							}
							echo '</span>';
							if ( !empty ($event_location) ) {
								echo '<span class="location"><i class="fa fa-map-marker"></i> ' . esc_attr( $event_location ) . '</span>';
							}

							echo '</p>';
						}

						$event_time = get_post_meta( $post->ID, 'event_time', true );
						if (!empty ($event_time)) {
							echo '<p class="event-time"><i class="fa fa-clock-o"></i> ' . $event_time . '</p>';
						}

					echo '</div>';

				echo '</div>';
	}

?>

		