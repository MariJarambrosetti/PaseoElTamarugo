<?php
	get_header();

	$option = get_option('jt_settings');
	$translations = get_option('jt_event_translations');
	include ( dirname( __FILE__ ) . '/settings/variables.php');

	$min_date = $_GET['eventMinDate'];
	$max_date = $_GET['eventMaxDate'];
	$location = $_GET['eventLocation'];
?>
<div class="search-events-content">
	<div class="container">
		<h3 class="title"><?php echo __('Search Results for', 'jt-event-calendar'); ?> : <?php echo $s; ?> </h3>
		<div class="uk-grid jt-event-calendar-grid">
			<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 
					$post_id = get_the_ID();

					$event_start_date = esc_attr( get_post_meta( $post->ID, 'event_start_date', true ) );
					$event_end_date = esc_attr( get_post_meta( $post->ID, 'event_end_date', true ) );
					$event_location = get_post_meta( $post->ID, 'event_location', true );
					
					$start_date = date('Y-m-d', strtotime($event_start_date));
					$end_date = date('Y-m-d', strtotime($event_end_date));
					
					if ($location != 'all') {
						if (($start_date >= $min_date) && ($start_date <= $max_date) && ($event_location == $location)) {

							echo '<div class="uk-width-1-3">';

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

							// Show event info
							$event_time = get_post_meta( $post->ID, 'event_time', true );

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

							if ( ( ! empty($event_start_date)) || ( ! empty($event_end_date)) || ( ! empty($event_location) )) {
								echo '<p class="info"><i class="fa fa-calendar"></i> <span class="duration">' . $start_date;
								if ( ! empty($event_end_date)) {
									echo ' - ' . $end_date;
								}
								echo '</span>';
								if ( ! empty($event_time)) {
									echo '<span class="event-time"><i class="fa fa-clock-o"></i>' . esc_attr( $event_time ) . '</span>';
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

							// Show the link
							$event_link_text = get_post_meta( $post->ID, 'event_link_text', true );
							$event_link_url = get_post_meta( $post->ID, 'event_link_url', true );

							if ( ( ! empty($event_link_text)) || ( ! empty($event_link_url)) ) {
								echo '<p class="event-btn"><a href="' . esc_attr( $event_link_url ) . '">' . esc_attr( $event_link_text ) . '</a></p>';
							}

							echo '</div>';
						}
						else {
							if (!empty ($translations[no_events_text])) {
								$no_events_text = $translations[no_events_text];
							}
							else {
								$no_events_text = '0 events found based on your criteria. Please, try again.';
							}
							echo __('<p class="no-events-found">' . $no_events_text . '</p>', 'jt-event-calendar');
						}
					}
					else {
						if (($start_date >= $min_date) && ($start_date <= $max_date)) {

							echo '<div class="uk-width-1-3">';

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

							// Show event info
							$event_time = get_post_meta( $post->ID, 'event_time', true );

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

							if ( ( ! empty($event_start_date)) || ( ! empty($event_end_date)) || ( ! empty($event_location) )) {
								echo '<p class="info"><i class="fa fa-calendar"></i> <span class="duration">' . $start_date;
								if ( ! empty($event_end_date)) {
									echo ' - ' . $end_date;
								}
								echo '</span>';
								if ( ! empty($event_time)) {
									echo '<span class="event-time"><i class="fa fa-clock-o"></i>' . esc_attr( $event_time ) . '</span>';
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

							// Show the link
							$event_link_text = get_post_meta( $post->ID, 'event_link_text', true );
							$event_link_url = get_post_meta( $post->ID, 'event_link_url', true );

							if ( ( ! empty($event_link_text)) || ( ! empty($event_link_url)) ) {
								echo '<p class="event-btn"><a href="' . esc_attr( $event_link_url ) . '">' . esc_attr( $event_link_text ) . '</a></p>';
							}

							echo '</div>';
						}
						else {
							if (!empty ($translations[no_events_text])) {
								$no_events_text = $translations[no_events_text];
							}
							else {
								$no_events_text = '0 events found based on your criteria. Please, try again.';
							}
							echo __('<p class="no-events-found">' . $no_events_text . '</p>', 'jt-event-calendar');
						}
					}

					endwhile;
				endif;
			?>
		</div>
	</div>
</div>
<?php
	get_footer();
?>