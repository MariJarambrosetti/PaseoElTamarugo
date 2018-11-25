<div class="jt-event-calendar">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large' ); ?>
					<?php endif; ?>
					<?php

						$option = get_option('jt_settings');
						$translate = get_option('jt_event_translations');
						$registration = get_option('jt_event_registration');
						include ( dirname( __FILE__ ) . '/../../settings/variables.php');
						include ( dirname( __FILE__ ) . '/../../settings/strings.php');

						$img1 = get_post_meta( $post_id, 'event_gallery_img1', true );
						$img2 = get_post_meta( $post_id, 'event_gallery_img2', true );
						$img3 = get_post_meta( $post_id, 'event_gallery_img3', true );
						$img4 = get_post_meta( $post_id, 'event_gallery_img4', true );
						$img5 = get_post_meta( $post_id, 'event_gallery_img5', true );
						$img6 = get_post_meta( $post_id, 'event_gallery_img6', true );
						$img7 = get_post_meta( $post_id, 'event_gallery_img7', true );
						$img8 = get_post_meta( $post_id, 'event_gallery_img8', true );

						$starts = esc_html( get_post_meta( $post_id, 'event_start_date', true ) );
						$ends = esc_html( get_post_meta( $post_id, 'event_end_date', true ) );
						$available_seats = esc_attr( get_post_meta( $post_id, 'event_available_seats', true ) );

						$special_guests = esc_attr( get_post_meta( $post_id, 'event_special_guests', true ) );
						$schedule = esc_attr( get_post_meta( $post_id, 'event_schedule', true ) );
						$schedule_file = esc_attr( get_post_meta( $post_id, 'event_schedule_file', true ) );

						$countdown = esc_attr( get_post_meta( $post_id, 'event_countdown', true ) );
						$registration_form = esc_attr( get_post_meta( $post_id, 'event_registration_form', true ) );
						$custom_registration_form = apply_filters('the_content', get_post_meta( $post_id, 'event_custom_registration_form', true ) );
	
						if ( (!empty ($img1)) || (!empty ($img2)) || (!empty ($img3)) || (!empty ($img4)) || (!empty ($img5)) || (!empty ($img6)) || (!empty ($img7)) || (!empty ($img8)) ) {
					?>
					<div class="event-gallery">
						<?php
							if (!empty ($img1)) {
						?>
						<a href="<?php echo $img1; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img1; ?>"></a>
						<?php
							}
							if (!empty ($img2)) {
						?>
						<a href="<?php echo $img2; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img2; ?>"></a>
						<?php
							}
							if (!empty ($img3)) {
						?>
						<a href="<?php echo $img3; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img3; ?>"></a>
						<?php
							}
							if (!empty ($img4)) {
						?>
						<a href="<?php echo $img4; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img4; ?>"></a>
						<?php
							}
							if (!empty ($img5)) {
						?>
						<a href="<?php echo $img5; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img5; ?>"></a>
						<?php
							}
							if (!empty ($img6)) {
						?>
						<a href="<?php echo $img6; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img6; ?>"></a>
						<?php
							}
							if (!empty ($img7)) {
						?>
						<a href="<?php echo $img7; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img7; ?>"></a>
						<?php
							}
							if (!empty ($img8)) {
						?>
						<a href="<?php echo $img8; ?>" data-uk-lightbox="{group:'event-images'}"><img src="<?php echo $img8; ?>"></a>
						<?php
							}
						?>
					</div>
					<?php
						}

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

							if ($registration_form == 'yes') {
						?>
						<div class="event-register-btn">
							<a href="#event-register-form" data-uk-modal>
								<i class="fa fa-sign-in"></i> <?php echo __($register_now_text, 'jt-event-calendar'); ?><i class="fa fa-angle-right"></i>
							</a>
							<span class="event-seats"><?php echo __($available_seats_text . ': ', 'jt-event-calendar') . $available_seats; ?></span>
						</div>
						<?php
							}
							if (!empty ($custom_registration_form)) {
						?>
						<div class="event-register-btn">
							<a href="#event-custom-register-form" data-uk-modal>
								<i class="fa fa-sign-in"></i> <?php echo __($register_now_text, 'jt-event-calendar'); ?><i class="fa fa-angle-right"></i>
							</a>
							<span class="event-seats"><?php echo __($available_seats_text . ': ', 'jt-event-calendar') . $available_seats; ?></span>
						</div>
						<?php
							}
							if (!empty ($special_guests)) {
						?>
						<div class="event-special-guests">
							<h3>
								<span><?php echo __($special_guests_text, 'jt-event-calendar'); ?></span>
							</h3>
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
						</div>
						<?php
							}
							if ( (!empty ($schedule)) || (!empty ($schedule_file)) ) {
						?>
						<div class="event-schedule">
							<h3>
								<span><?php echo __($schedule_text, 'jt-event-calendar'); ?></span>
							</h3>
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
						</div>
						<?php
							}

						$map = get_post_meta( $post_id, 'event_map', true );
						if (!empty ($map) ) {
							echo $map;
						}
					?>
				</div>
				
				<div class="col-md-8">
					<?php
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
					?>
					<?php
						$short_info = esc_html( get_post_meta( $post_id, 'event_short_info', true ) );
						if (!empty ($short_info)) {
					?>
					<p class="event-short-info">
						<?php echo $short_info; ?>
					</p>
					<?php
						}
						$location = esc_html( get_post_meta( $post_id, 'event_location', true ) );
						$free_entrance = esc_html( get_post_meta( $post_id, 'event_free_entrance', true ) );
						$time = esc_html( get_post_meta( $post_id, 'event_time', true ) );
						$link_url = esc_html( get_post_meta( $post_id, 'event_link_url', true ) );
						$link_text = esc_html( get_post_meta( $post_id, 'event_link_text', true ) );
						
						if ($free_entrance == 'yes') {
					?>
					<p class="event-free-entrance">
						<i class="fa fa-tags"></i> <?php echo __($event_free_entrance_text, 'jt-event-calendar'); ?>
					</p>
					<?php
						}
						if (!empty ($location)) {
					?>
					<p class="event-location">
						<i class="fa fa-map-marker"></i> <?php echo $location; ?>
						<span class="more-btn"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></span>
					</p>
					<?php
						}
						
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
						?>
						<p class="event-datetime">
							<?php 
								echo '<i class="fa fa-calendar"></i>' . $start_date;
								if (!empty ($ends)) {
									echo ' - ' . $end_date;
								}
								if (!empty ($time)) {
							?>
							<span class="time"><i class="fa fa-clock-o"></i><?php echo $time; ?></span>
							<?php
								}
							?>
						</p>
						<?php
							}
							$event_info = apply_filters( 'the_content', get_post_meta( $post_id, 'event_info', true ));
							if (!empty ($event_info)) {
						?>
						<div class="event-info">
							<?php echo $event_info; ?>
						</div>
						<?php
							}
							$event_ticket_price = do_shortcode( get_post_meta( $post_id, 'event_ticket_price', true ));
							if (!empty ($event_ticket_price)) {
						?>
						<div class="event-tickets">
							<h3><?php echo __($tickets_text, 'jt-event-calendar'); ?></h3>
							<?php echo $event_ticket_price; ?>
						</div>
						<?php
							}
							$event_video_url = get_post_meta( $post_id, 'event_video_url', true);
							$event_video_embed = get_post_meta( $post_id, 'event_video', true);
							if (!empty ($event_video_url)) {
						?>
						<div class="event-video">
							<h3><?php echo __($event_video, 'jt-event-calendar'); ?></h3>
							<video width="670" height="380" controls>
								<source src="<?php echo $event_video_url; ?>" type="video/mp4">
							</video>
						</div>
						<?php
							}
							else if (!empty ($event_video_embed)) {
						?>
						<div class="event-video">
							<h3><?php echo __($event_video, 'jt-event-calendar'); ?></h3>
							<?php echo $event_video_embed; ?>
						</div>
						<?php
							}
						?>
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
	</article>
</div>