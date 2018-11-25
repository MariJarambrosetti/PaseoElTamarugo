<div class="jt-event-calendar-3">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="event-featured-image">
			<figure class="uk-overlay">
				<img src="<?php the_post_thumbnail_url( 'full' ); ?>"/>
				<figcaption class="uk-overlay-background uk-overlay-panel uk-overlay-bottom">
						<?php

							$option = get_option('jt_settings');
							$translate = get_option('jt_event_translations');
							$registration = get_option('jt_event_registration');
							include ( dirname( __FILE__ ) . '/../../settings/variables.php');
							include ( dirname( __FILE__ ) . '/../../settings/strings.php');

							$sold_out = esc_html( get_post_meta( $post_id, 'event_sold_out', true ) );

							if ( is_single() ) :
								if ($sold_out == 'yes') :
									the_title( '<h1 class="event-title">', '<span class="sold-out">(' . $event_sold_out_text . ')</span></h1>' );
								else :
									the_title( '<h1 class="event-title">', '</h1>' );
								endif;
							else :
								the_title( '<h2 class="event-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							endif;

							$location = esc_attr( get_post_meta( $post_id, 'event_location', true ) );
							$free_entrance = esc_attr( get_post_meta( $post_id, 'event_free_entrance', true ) );
							$starts = esc_attr( get_post_meta( $post_id, 'event_start_date', true ) );
							$ends = esc_attr( get_post_meta( $post_id, 'event_end_date', true ) );
							$time = esc_attr( get_post_meta( $post_id, 'event_time', true ) );
							$link_url = esc_attr( get_post_meta( $post_id, 'event_link_url', true ) );
							$link_text = esc_attr( get_post_meta( $post_id, 'event_link_text', true ) );
							$available_seats = esc_attr( get_post_meta( $post_id, 'event_available_seats', true ) );

							$special_guests = esc_attr( get_post_meta( $post_id, 'event_special_guests', true ) );
							$schedule = esc_attr( get_post_meta( $post_id, 'event_schedule', true ) );
							$schedule_file = esc_attr( get_post_meta( $post_id, 'event_schedule_file', true ) );

							$countdown = esc_attr( get_post_meta( $post_id, 'event_countdown', true ) );
							$registration_form = esc_attr( get_post_meta( $post_id, 'event_registration_form', true ) );
							$custom_registration_form = apply_filters( 'the_content', get_post_meta( $post_id, 'event_custom_registration_form', true ) );

							if ( (!empty ($starts)) || (!empty ($ends)) ) {
						?>
						<p class="event-date">
							<?php
								if (!empty ($starts)) {
									if ($option[date_format] == 'dFY') {
										$start_date = date_i18n("d F Y", strtotime($starts));
										$end_date = date_i18n("d F Y", strtotime($ends));
									}
									else if ($option[date_format] == 'dF') {
										$start_date = date_i18n("d F", strtotime($starts));
										$end_date = date_i18n("d F", strtotime($ends));
									}
									else if ($option[date_format] == 'Fd') {
										$start_date = date_i18n("F d", strtotime($starts));
										$end_date = date_i18n("F d", strtotime($ends));
									}
									else if ($option[date_format] == 'dMY') {
										$start_date = date_i18n("d M Y", strtotime($starts));
										$end_date = date_i18n("d M Y", strtotime($ends));
									}
									else if ($option[date_format] == 'dM') {
										$start_date = date_i18n("d M", strtotime($starts));
										$end_date = date_i18n("d M", strtotime($ends));
									}
									else if ($option[date_format] == 'Md') {
										$start_date = date_i18n("M d", strtotime($starts));
										$end_date = date_i18n("M d", strtotime($ends));
									}
									else if ($option[date_format] == 'dmY') {
										$start_date = date_i18n("d/m/Y", strtotime($starts));
										$end_date = date_i18n("d/m/Y", strtotime($ends));
									}
									else if ($option[date_format] == 'mdY') {
										$start_date = date_i18n("m/d/Y", strtotime($starts));
										$end_date = date_i18n("m/d/Y", strtotime($ends));
									}
									
									echo '<i class="fa fa-calendar"></i>' . $start_date;
									if (!empty ($ends)) {
										echo ' - ' . $end_date;
									}
									if (!empty ($time)) {
								?>
								<span class="event-time"><i class="fa fa-clock-o"></i><?php echo $time; ?></span>
								<?php
									}
								}
							?>
						</p>
						<?php
							}
						?>
						<?php
							if ($countdown == 'yes') {
						?>
						<div class="event-countdown-timer">
							<input type="hidden" id="eventStarts" name="eventStarts" value="<?php echo $starts; ?>" />
							<input type="hidden" id="eventEnds" name="eventEnds" value="<?php echo $ends; ?>" />
							<input type="hidden" id="eventStartsIn" name="eventStartsIn" value="<?php echo $event_starts_in_text; ?>" />
							<input type="hidden" id="eventStartsToday" name="eventStartsToday" value="<?php echo $event_starts_today_text; ?>" />
							<input type="hidden" id="eventHasExpired" name="eventHasExpired" value="<?php echo $event_has_expired_text; ?>" />
							<p id="event-countdown"></p>
							<div class="countdown-col">
								<p id="event-countdown-days"></p>
								<p><?php echo __($event_countdown_days_text, 'jt-event-calendar'); ?></p>
							</div>
							<div class="countdown-col">
								<p id="event-countdown-hours"></p>
								<p><?php echo __($event_countdown_hours_text, 'jt-event-calendar'); ?></p>
							</div>
							<div class="countdown-col">
								<p id="event-countdown-min"></p>
								<p><?php echo __($event_countdown_min_text, 'jt-event-calendar'); ?></p>
							</div>
							<div class="countdown-col">
								<p id="event-countdown-sec"></p>
								<p><?php echo __($event_countdown_sec_text, 'jt-event-calendar'); ?></p>
							</div>
						</div>
						<?php
							}
						?>
				</figcaption>
			</figure>
					
			<div class="uk-grid event-info">
				<div class="uk-width-1-2">
				<?php if (!empty($location) || ($free_entrance == 'yes') || !empty($available_seats)) { ?>
					<p class="event-location-time">
						<?php
							if (!empty ($location)) {
						?>
						<span class="event-location">
							<i class="fa fa-map-marker"></i> <?php echo $location; ?>
						</span>
						<?php
							}
							if ($free_entrance == 'yes') {
						?>
						<span class="event-free-entrance">
							<i class="fa fa-tags"></i> <?php echo __($event_free_entrance_text, 'jt-event-calendar'); ?>
						</span>
						<?php
							}
							if (!empty ($available_seats)) {
						?>
						<span class="event-available-seats">
							<i class="fa fa-users"></i> <?php echo __($available_seats_text . ': ', 'jt-event-calendar') . $available_seats; ?>
						</span>
						<?php
							}
						?>
					</p>
				<?php
					}
				?>
				</div>
				<div class="uk-width-1-2">
				<?php
					if (!empty($link_url) || ($registration_form == 'yes') || (!empty ($custom_registration_form))) {
				?>
					<p class="event-link">
						<?php
							if ($registration_form == 'yes') {
						?>
						<span class="registration-btn"><a href="#event-register-form" data-uk-modal><?php echo __($register_now_text, 'jt-event-calendar'); ?></a></span>
						<?php
							}
							if (!empty ($custom_registration_form)) {
						?>
						<span class="registration-btn"><a href="#event-custom-register-form" data-uk-modal><?php echo __($register_now_text, 'jt-event-calendar'); ?></a></span>
						<?php
							}
							if (!empty ($link_url)) {
						?>
						<span class="more-btn"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></span>
						<?php
							}
						?>
					</p>
				<?php
					}
				?>
				</div>
			</div>
		</div>
		
		<div id="event-register-form" class="uk-modal">
			<div class="uk-modal-dialog">
				<form method="POST" action="<?php the_permalink(); ?>">
					<div class="submit-event-form-2">
						<h3 class="section-title">
							<span><?php echo __($register_now_text, 'jt-event-calendar'); ?></span>
							<a class="uk-modal-close uk-close"></a>
						</h3>
						<div class="uk-grid event-form-fields">
							<div class="uk-width-1-2">
								<p>
									<label><?php echo __($event_title_text, 'jt-event-calendar'); ?></label>
									<input type="text" name="event_title" value="<?php echo the_title(); ?>" readonly />
								</p>
								<p>
									<label><?php echo __($firstname_text, 'jt-event-calendar'); ?></label>
									<input type="text" name="first_name" required />
								</p>
								<p>
									<label><?php echo __($lastname_text, 'jt-event-calendar'); ?></label>
									<input type="text" name="last_name" required />
								</p>
								<p>
									<label><?php echo __($email_text, 'jt-event-calendar'); ?></label>
									<input type="email" name="email" required />
								</p>
							</div>
							<div class="uk-width-1-2">
								<p>
									<label><?php echo __($phone_number_text, 'jt-event-calendar'); ?></label>
									<input type="text" name="phone_number" required />
								</p>
								<p>
									<label><?php echo __($num_of_persons_text, 'jt-event-calendar'); ?></label>
									<input type="number" name="num_of_persons" min="0" max="<?php echo $available_seats; ?>" required />
								</p>
								<?php
									if ($registration[day_field] == 1) {
								?>
								<p>
									<label><?php echo __($day_text, 'jt-event-calendar'); ?></label>
									<input type="date" name="event_day" />
								</p>
								<?php
									}
									if ($registration[time_field] == 1) {
								?>
								<p>
									<label><?php echo __($time_text, 'jt-event-calendar'); ?></label>
									<input type="time" name="event_hour" />
								</p>
								<?php
									}
								?>
							</div>
						</div>
						<input type="hidden" name="event_id" value="<?php echo the_ID(); ?>" />
						<input type="hidden" name="event_seats" value="<?php echo $available_seats; ?>" />
						<input type="submit" name="submit" value="<?php echo __($register_text, 'jt-event-calendar'); ?>" class="button-submit" />
					</div>
				</form>
			</div>
		</div>
		
		<div id="event-custom-register-form" class="uk-modal">
			<div class="uk-modal-dialog">
				<div class="submit-event-form-2">
					<h3 class="section-title">
						<span><?php echo __($register_now_text, 'jt-event-calendar'); ?></span>
						<a class="uk-modal-close uk-close"></a>
					</h3>
					<?php echo $custom_registration_form; ?>
				</div>
			</div>
		</div>
		
		<?php
			$short_info = esc_attr( get_post_meta( $post_id, 'event_short_info', true ) );

			if (!empty ($short_info)) {
				echo '<p class="short-info">' . $short_info . '</p>';
			}
		?>
		
		<div class="event-info-section">
			<div class="uk-grid">
				<div class="uk-width-7-10">
					<div class="event-box">
						<?php
							$event_info = apply_filters( 'the_content', get_post_meta( $post_id, 'event_info', true ));
							$event_tickets = do_shortcode( get_post_meta( $post_id, 'event_ticket_price', true ));
							$img1 = get_post_meta( $post_id, 'event_gallery_img1', true );
							$img2 = get_post_meta( $post_id, 'event_gallery_img2', true );
							$img3 = get_post_meta( $post_id, 'event_gallery_img3', true );
							$img4 = get_post_meta( $post_id, 'event_gallery_img4', true );
							$img5 = get_post_meta( $post_id, 'event_gallery_img5', true );
							$img6 = get_post_meta( $post_id, 'event_gallery_img6', true );
							$img7 = get_post_meta( $post_id, 'event_gallery_img7', true );
							$img8 = get_post_meta( $post_id, 'event_gallery_img8', true );
							$event_video_url = get_post_meta( $post_id, 'event_video_url', true);
							$event_video_embed = get_post_meta( $post_id, 'event_video', true);
						?>
						<ul class="event-tabs" data-uk-switcher="{connect:'#event-info-tabs', animation: 'slide-bottom'}">
							<?php
								if (!empty ($event_info)) {
							?>
							<li><h2><a href=""><?php echo __($info_text, 'jt-event-calendar'); ?></a></h2></li>
							<?php
								}
								
								if (!empty ($event_tickets)) {
							?>
							<li class="tickets-tab"><h2><a href=""><?php echo __($tickets_text, 'jt-event-calendar'); ?></a></h2></li>
							<?php
								}

								if (!empty ($special_guests)) {
							?>
							<li><h2><a href=""><?php echo __($special_guests_text, 'jt-event-calendar'); ?></a></h2></li>
							<?php
								}

								if ( (!empty ($schedule)) || (!empty ($schedule_file)) ) {
							?>
							<li><h2><a href=""><?php echo __($schedule_text, 'jt-event-calendar'); ?></a></h2></li>
							<?php
								}

								if ( (!empty ($event_video_url)) || (!empty ($event_video)) ) {
							?>
							<li class="video-tab"><h2 class="event-video"><a href=""><?php echo __($video_text, 'jt-event-calendar'); ?></a></h2></li>
							<?php
								}

								if ( (!empty ($img1)) || (!empty ($img2)) || (!empty ($img3)) || (!empty ($img4)) || (!empty ($img5)) || (!empty ($img6)) || (!empty ($img7)) || (!empty ($img8)) ) {
							?>
							<li class="gallery-tab"><h2 class="event-gallery"><a href=""><?php echo __($gallery_text, 'jt-event-calendar'); ?></a></h2></li>
							<?php
								}
							?>
						</ul>
						
						<ul id="event-info-tabs" class="uk-switcher">
							<?php
								if (!empty ($event_info)) {
							?>
							<li>
								<?php
									echo $event_info;
								?>
							</li>
							<?php
								}
								if (!empty ($event_tickets)) {
							?>
							<li>
								<?php
									echo $event_tickets;
								?>
							</li>
							<?php
								}
								if (!empty ($special_guests)) {
							?>
							<li>
								<?php
									$guest_list = preg_split("/\r\n|\n|\r/", $special_guests);
									foreach ( $guest_list as $guest ) {
										echo '<p class="guests-row">';
											$guest_new = explode(' | ', $guest);
											echo '<span class="event-guest-name">' . $guest_new[0] . '</span>';
											echo '<span class="event-guest-info">' . $guest_new[1] . '</span>';
										echo '</p>';
									}	
								?>
							</li>
							<?php
								}
								if ( (!empty ($schedule)) || (!empty ($schedule_file)) ) {
							?>
							<li>
								<?php
									if (!empty ($schedule)) {
										$schedule_list = preg_split("/\r\n|\n|\r/", $schedule);
										foreach ( $schedule_list as $schedule_item ) {
											echo '<p class="schedule-row">';
												$schedule_new = explode(' | ', $schedule_item);
												echo '<span class="event-schedule-hour">' . $schedule_new[0] . '</span>';
												echo '<span class="event-schedule-info">' . $schedule_new[1] . '</span>';
											echo '</p>';
										}	
									}
									if (!empty ($schedule_file)) {
								?>
								<div class="schedule-file">
									<a href="<?php echo $schedule_file; ?>">
										<i class="fa fa-file-text-o"></i> <?php echo __($schedule_text, 'jt-event-calendar'); ?>
									</a>
								</div>
								<?php
									}
								?>
							</li>
							<?php
								}

								if ( (!empty ($event_video_url)) || (!empty ($event_video)) ) {
							?>
							<li>
								<?php
									if (!empty ($event_video_url)) {
								?>
								<video width="735" height="415" controls>
								  <source src="<?php echo $event_video_url; ?>" type="video/mp4">
								</video>
								<?php
									}
									else if (!empty ($event_video)) {
										echo $event_video;
									}
								?>
							</li>
							<?php			
								}

								if ( (!empty ($img1)) || (!empty ($img2)) || (!empty ($img3)) || (!empty ($img4)) || (!empty ($img5)) || (!empty ($img6)) || (!empty ($img7)) || (!empty ($img8)) ) {
							?>
							<li>
								<div class="event-gallery">
									<div class="uk-grid">
										<?php
											if (!empty ($img1)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img1; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img1 ;?>">
											</a>
										</div>
										<?php
											}
											if (!empty ($img2)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img2; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img2 ;?>">
											</a>
										</div>
										<?php
											}
											if (!empty ($img3)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img3; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img3 ;?>">
											</a>
										</div>
										<?php
											}
											if (!empty ($img4)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img4; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img4 ;?>">
											</a>
										</div>
										<?php
											}
											if (!empty ($img5)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img5; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img5 ;?>">
											</a>
										</div>
										<?php
											}
											if (!empty ($img6)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img6; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img6 ;?>">
											</a>
										</div>
										<?php
											}
											if (!empty ($img7)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img7; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img7 ;?>">
											</a>
										</div>
										<?php
											}
											if (!empty ($img8)) {
										?>
										<div class="uk-width-1-4">
											<a href="<?php echo $img8; ?>" data-uk-lightbox="{group:'event-images'}">
												<img src="<?php echo $img8 ;?>">
											</a>
										</div>
										<?php
											}
										?>
									</div>
								</div>
							</li>
							<?php
								}
							?>
						</ul>
					</div>
				</div>
				<div class="uk-width-3-10">
					<?php
						$map = get_post_meta( $post_id, 'event_map', true );

						if (!empty ($map)) {
					?>
					<div class="event-map">
						<?php
							echo $map;
						?>
					</div>
					<?php
						}
					?>
					
					<div class="more-events">
						<h2 class="more-events-title"><span><?php echo __($more_events_text, 'jt-reviews'); ?></span></h2>
						<?php
							$current_date = date("Y/m/d");
							$terms = get_the_terms( $post_id, 'events_list' );
							foreach ( $terms as $term ) {
								if ($option[display_past_events] == 0) {
									$moreEvents = array("posts_per_page" => 5, "post_type" => array('events_list'), 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date', 'meta_query' => array( array( 'meta_key' => 'event_end_date', 'value' => $current_date, 'compare' => '>=', 'type' => 'DATE') ));
								}
								else {
									$moreEvents = array("posts_per_page" => 5, "post_type" => array('events_list'), 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_key' => 'event_start_date');
								}
							}

							$events_array = get_posts($moreEvents);

							echo '<div class="uk-grid">';
							// Show these posts in a grid
							foreach($events_array as $event) {
								$post_type = get_post_type_object( get_post_type($event) );
								
								$starts = esc_attr( get_post_meta( $event->ID, 'event_start_date', true ) );
								$ends = esc_attr( get_post_meta( $event->ID, 'event_end_date', true ) );
								$location = esc_attr( get_post_meta( $event->ID, 'event_location', true ) );
								
								if ($option[date_format] == 'dFY') {
										$start_date = date("d F Y", strtotime($starts));
										$end_date = date("d F Y", strtotime($ends));
									}
									else if ($option[date_format] == 'dF') {
										$start_date = date("d F", strtotime($starts));
										$end_date = date("d F", strtotime($ends));
									}
									else if ($option[date_format] == 'Fd') {
										$start_date = date("F d", strtotime($starts));
										$end_date = date("F d", strtotime($ends));
									}
									else if ($option[date_format] == 'dMY') {
										$start_date = date("d M Y", strtotime($starts));
										$end_date = date("d M Y", strtotime($ends));
									}
									else if ($option[date_format] == 'dM') {
										$start_date = date("d M", strtotime($starts));
										$end_date = date("d M", strtotime($ends));
									}
									else if ($option[date_format] == 'Md') {
										$start_date = date("M d", strtotime($starts));
										$end_date = date("M d", strtotime($ends));
									}
									else if ($option[date_format] == 'dmY') {
										$start_date = date("d/m/Y", strtotime($starts));
										$end_date = date("d/m/Y", strtotime($ends));
									}
									else if ($option[date_format] == 'mdY') {
										$start_date = date("m/d/Y", strtotime($starts));
										$end_date = date("m/d/Y", strtotime($ends));
									}
								
								?>
						<div class="uk-width-1-3">
							<figure class="uk-overlay">
								<a href="<?php echo get_permalink( $event->ID ); ?>">
									<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($event->ID), 'thumbnail'  ); ?>" alt="">
								</a>
							</figure>
						</div>
						<div class="uk-width-2-3">
							<p><a href="<?php echo get_permalink( $event->ID ); ?>"><?php echo $event->post_title; ?></a></p>
							<p class="event-date">
								<?php 
									if (!empty ($starts)) {
										echo $start_date;
									}
									if (!empty ($ends)) {
										echo ' - ' . $end_date; 
									}
								?>
							</p>
							<p class="event-location"><?php echo $location; ?></p>
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
			
			<?php
				$sponsor_img1 = esc_attr( get_post_meta( $post_id, 'event_sponsor_img1', true ) );
				$sponsor_img2 = esc_attr( get_post_meta( $post_id, 'event_sponsor_img2', true ) );
				$sponsor_img3 = esc_attr( get_post_meta( $post_id, 'event_sponsor_img3', true ) );
				$sponsor_img4 = esc_attr( get_post_meta( $post_id, 'event_sponsor_img4', true ) );
				$sponsor_img5 = esc_attr( get_post_meta( $post_id, 'event_sponsor_img5', true ) );
				$sponsor_img6 = esc_attr( get_post_meta( $post_id, 'event_sponsor_img6', true ) );

				$media_sponsor_img1 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_img1', true ) );
				$media_sponsor_img2 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_img2', true ) );
				$media_sponsor_img3 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_img3', true ) );
				$media_sponsor_img4 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_img4', true ) );
				$media_sponsor_img5 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_img5', true ) );
				$media_sponsor_img6 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_img6', true ) );

				$sponsor_url1 = esc_attr( get_post_meta( $post_id, 'event_sponsor_url1', true ) );
				$sponsor_url2 = esc_attr( get_post_meta( $post_id, 'event_sponsor_url2', true ) );
				$sponsor_url3 = esc_attr( get_post_meta( $post_id, 'event_sponsor_url3', true ) );
				$sponsor_url4 = esc_attr( get_post_meta( $post_id, 'event_sponsor_url4', true ) );
				$sponsor_url5 = esc_attr( get_post_meta( $post_id, 'event_sponsor_url5', true ) );
				$sponsor_url6 = esc_attr( get_post_meta( $post_id, 'event_sponsor_url6', true ) );

				$media_sponsor_url1 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_url1', true ) );
				$media_sponsor_url2 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_url2', true ) );
				$media_sponsor_url3 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_url3', true ) );
				$media_sponsor_url4 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_url4', true ) );
				$media_sponsor_url5 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_url5', true ) );
				$media_sponsor_url6 = esc_attr( get_post_meta( $post_id, 'event_media_sponsor_url6', true ) );

				if ( (!empty ($sponsor_img1)) || (!empty ($sponsor_img2)) || (!empty ($sponsor_img3)) || (!empty ($sponsor_img4)) || (!empty ($sponsor_img5)) || (!empty ($sponsor_img6)) || (!empty ($media_sponsor_img1)) || (!empty ($media_sponsor_img2)) || (!empty ($media_sponsor_img3)) || (!empty ($media_sponsor_img4)) || (!empty ($media_sponsor_img5)) || (!empty ($media_sponsor_img6)) ) {
			?>
			<div class="event-sponsors">
				<?php
					if ( (!empty ($sponsor_img1)) || (!empty ($sponsor_img2)) || (!empty ($sponsor_img3)) || (!empty ($sponsor_img4)) || (!empty ($sponsor_img5)) || (!empty ($sponsor_img6)) ) {
				?>
				<h3><?php echo __($sponsors_text, 'jt-event-calendar'); ?></h3>
				<div class="uk-grid sponsors-list">
					<?php
						if (!empty ($sponsor_img1)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $sponsor_url1; ?>"><img src="<?php echo $sponsor_img1; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($sponsor_img2)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $sponsor_url2; ?>"><img src="<?php echo $sponsor_img2; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($sponsor_img3)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $sponsor_url3; ?>"><img src="<?php echo $sponsor_img3; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($sponsor_img4)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $sponsor_url4; ?>"><img src="<?php echo $sponsor_img4; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($sponsor_img5)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $sponsor_url5; ?>"><img src="<?php echo $sponsor_img5; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($sponsor_img6)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $sponsor_url6; ?>"><img src="<?php echo $sponsor_img6; ?>"></a>
					</div>
					<?php
						}
					?>
				</div>
				<?php
					}
					
					if ( (!empty ($media_sponsor_img1)) || (!empty ($media_sponsor_img2)) || (!empty ($media_sponsor_img3)) || (!empty ($media_sponsor_img4)) || (!empty ($media_sponsor_img5)) || (!empty ($media_sponsor_img6)) ) {
				?>
				<h3><?php echo __($media_sponsors_text, 'jt-event-calendar'); ?></h3>
				<div class="uk-grid sponsors-list">
					<?php
						if (!empty ($media_sponsor_img1)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $media_sponsor_url1; ?>"><img src="<?php echo $media_sponsor_img1; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($media_sponsor_img2)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $media_sponsor_url2; ?>"><img src="<?php echo $media_sponsor_img2; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($media_sponsor_img3)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $media_sponsor_url3; ?>"><img src="<?php echo $media_sponsor_img3; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($media_sponsor_img4)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $media_sponsor_url4; ?>"><img src="<?php echo $media_sponsor_img4; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($media_sponsor_img5)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $media_sponsor_url5; ?>"><img src="<?php echo $media_sponsor_img5; ?>"></a>
					</div>
					<?php
						}
						if (!empty ($media_sponsor_img6)) {
					?>
					<div class="uk-width-1-6">
						<a href="<?php echo $media_sponsor_url6; ?>"><img src="<?php echo $media_sponsor_img6; ?>"></a>
					</div>
					<?php
						}
					?>
				</div>
				<?php
					}
				?>
			</div>
			<?php
				}
			?>
	</article>
</div>