<?php
	while ( have_posts() ) : the_post();
		$post_id = get_the_ID();
		$options = get_option( 'jt_travel_booking_agency' );
		$translate = get_option( 'jt_travel_booking_translations' );
		include ( dirname( __FILE__ ) . '/../options/variables.php');
		include ( dirname( __FILE__ ) . '/../options/strings.php');
?>
<div class="jt-travel-booking-4">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="uk-grid destination-top-section">
			<div class="uk-width-7-10">
				<div class="destination-featured-image">
					<figure class="uk-overlay">
						<img src="<?php the_post_thumbnail_url('large'); ?>"/>
						<figcaption class="uk-overlay-background uk-overlay-panel uk-overlay-bottom">
							<?php
								if ( is_single() ) :
									the_title( '<h1 class="destination-title">', '</h1>' );
								else :
									the_title( '<h2 class="destination-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
								endif;

								$destination_short_info = esc_html( get_post_meta( $post_id, 'destination_short_info', true ) );
							?>
							<p class="summary"><?php echo $destination_short_info; ?></p>
						</figcaption>
					</figure>
				</div>
			</div>
			<div class="uk-width-3-10">
				<?php
					$destination_days = esc_html( get_post_meta( $post_id, 'destination_days', true ) );
					$destination_periods = esc_html( get_post_meta( $post_id, 'destination_periods', true ) );
					$destination_price = esc_html( get_post_meta( $post_id, 'destination_price', true ) );
					$destination_transportation_icon = esc_html( get_post_meta( $post_id, 'destination_transportation_icon', true ) );
					$destination_transportation = esc_html( get_post_meta( $post_id, 'destination_transportation', true ) );
					$destination_departure_dates = get_post_meta( $post_id, 'destination_departures', true );

					if (!empty ($destination_days)) {
				?>
				<p class="destination-days">
					<span><i class="fa fa-clock-o"></i></span> <?php echo $destination_days . ' ' .  __($travel_days_text, 'jt-travel-booking'); ?>
				</p>
				<?php
					}
					if (!empty ($destination_periods)) {
				?>
				<p class="destination-periods">
					<span><i class="fa fa-calendar"></i></span> <?php echo $destination_periods; ?>
				</p>
				<?php
					}
					if (!empty ($destination_price)) {
				?>
				<p class="destination-price">
					<span class="price-text"><?php echo __($travel_starts_from_text, 'jt-travel-booking'); ?></span>
					<?php echo $destination_price; ?>
				</p>
				<?php
					}
					if ( !empty($destination_departure_dates) ) { 
				?>
				<div class="departure-dates">
					<h4><?php echo __($travel_departures_text, 'jt-travel-booking'); ?></h4>
					<ul>
						<?php
							$departures = explode(', ', $destination_departure_dates);
							foreach ( $departures as $departure ) {
								echo '<li>' . $departure . '</li>';
							}
						?>
					</ul>
				</div>
				<?php
					}
					if ( (!empty ($destination_transportation_icon)) || (!empty ($destination_transportation)) ) {
				?>
				<p class="destination-transportation">
					<span class="transportation">
						<?php echo '<i class="' . $destination_transportation_icon . '"></i>' . $destination_transportation; ?>
					</span>
				</p>
				<?php
					}
				?>
			</div>
		</div>
		
		<div class="destination-info-section">
			<div class="uk-grid">
				<div class="uk-width-3-5">
					<div class="info-box">
						<?php
							$destination_info = wpautop(get_post_meta( $post_id, 'destination_info', true ));
							$destination_daily_program = wpautop(get_post_meta( $post_id, 'destination_daily_program', true ));
							$destination_hotels = wpautop(get_post_meta( $post_id, 'destination_hotels', true ));
							$destination_provisions = wpautop(get_post_meta( $post_id, 'destination_provisions', true ));
							$destination_things_to_do = wpautop(get_post_meta( $post_id, 'destination_things_to_do', true ));
							$destination_booking_info = wpautop(get_post_meta( $post_id, 'destination_booking_info', true ));
							$destination_video_url = get_post_meta( $post_id, 'destination_video_url', true);
							$destination_video_embed = get_post_meta( $post_id, 'destination_video_embed', true);
						?>
						<ul class="info-tabs" data-uk-switcher="{connect:'#info-tabs', animation: 'slide-bottom'}">
							<?php
								if (!empty ($destination_info)) {
							?>
							<li><h2><a href=""><?php echo __($travel_info_text, 'jt-travel-booking'); ?></a></h2></li>
							<?php
								}
								if ( !empty ($destination_daily_program) ) {
							?>
							<li class="program-tab"><h2><a href=""><?php echo __($travel_daily_program_text, 'jt-travel-booking'); ?></a></h2></li>
							<?php
								}
								if ( !empty ($destination_hotels) ) {
							?>
							<li class="hotels-tab"><h2><a href=""><?php echo __($travel_hotels_text, 'jt-travel-booking'); ?></a></h2></li>
							<?php
								}
								if ( !empty ($destination_provisions) ) {
							?>
							<li class="provisions-tab"><h2><a href=""><?php echo __($travel_provisions_text, 'jt-travel-booking'); ?></a></h2></li>
							<?php
								}
								if ( !empty ($destination_things_to_do) ) {
							?>
							<li class="activities-tab"><h2><a href=""><?php echo __($travel_things_to_do_text, 'jt-travel-booking'); ?></a></h2></li>
							<?php
								}
								if ( !empty ($destination_booking_info) ) {
							?>
							<li class="booking-info-tab"><h2><a href=""><?php echo __($travel_booking_info_text, 'jt-travel-booking'); ?></a></h2></li>
							<?php
								}
								if ( (!empty ($destination_video_url)) || (!empty ($destination_video_embed)) ) {
							?>
							<li class="video-tab"><h2><a href=""><?php echo __($travel_video_text, 'jt-travel-booking'); ?></a></h2></li>
							<?php
								}
							?>
						</ul>
						
						<ul id="info-tabs" class="uk-switcher">
							<?php
								if (!empty ($destination_info)) {
							?>
							<li>
								<?php
									echo $destination_info;
								?>
							</li>
							<?php
								}
								if (!empty ($destination_daily_program)) {
							?>
							<li>
								<?php
									echo $destination_daily_program;
								?>
							</li>
							<?php
								}
								if (!empty ($destination_hotels)) {
							?>
							<li>
								<?php
									echo $destination_hotels;
								?>
							</li>
							<?php
								}
								if (!empty ($destination_provisions)) {
							?>
							<li>
								<?php
									echo $destination_provisions;
								?>
							</li>
							<?php
								}
								if (!empty ($destination_things_to_do)) {
							?>
							<li>
								<?php
									echo $destination_things_to_do;
								?>
							</li>
							<?php
								}
								if (!empty ($destination_booking_info)) {
							?>
							<li>
								<?php
									echo $destination_booking_info;
								?>
							</li>
							<?php
								}
								if ( (!empty ($destination_video_url)) || (!empty ($destination_video_embed)) ) {
							?>
							<li>
								<?php
									if (!empty ($destination_video_url)) {
								?>
								<video width="780" height="470" controls>
								  <source src="<?php echo $destination_video_url; ?>" type="video/mp4">
								</video>
								<?php
									}
									else if (!empty ($destination_video_embed)) {
										echo $destination_video_embed;
									}
								?>
							</li>
							<?php			
								}
							?>
						</ul>
					</div>
				</div>
				<div class="uk-width-2-5">
					<?php
						$destination_booking_form = esc_html( get_post_meta( $post_id, 'destination_booking_form', true ) );
						$destination_custom_form = do_shortcode( get_post_meta( $post_id, 'destination_custom_form', true ));

						if (($destination_booking_form == 'yes') || ($destination_booking_form == '') || (!empty ($destination_custom_form))) {
					?>
					<div class="book-destination-box">
						<p><?php echo __($travel_book_now_text, 'jt-travel-booking'); ?></p>
						<a class="book-now-btn" href="#book-form-section" data-uk-modal><?php echo _e($travel_book_this_tour_text, 'jt-travel-booking'); ?></a>
					</div>
					<?php
						}
						else {
							echo $destination_custom_form;
						}

						$destination_map = get_post_meta( $post_id, 'destination_map', true ); 
	
						if (!empty ($destination_map)) {
					?>
					<div class="destination-map">
						<?php
							echo $destination_map;
						?>
					</div>
					<?php
						}
						if (!empty ($options[jt_travel_booking_agency_info]) ) {
					?>
					<div class="agency-info">
						<h3><span><?php echo $agency_info_text; ?></span></h3>
						<?php
							echo $options[jt_travel_booking_agency_info];
						?>
					</div>
					<?php
						}
					?>
				</div>
			</div>
					
			<?php
				$img1 = get_post_meta( $post_id, 'destination_img1', true );
				$img2 = get_post_meta( $post_id, 'destination_img2', true );
				$img3 = get_post_meta( $post_id, 'destination_img3', true );
				$img4 = get_post_meta( $post_id, 'destination_img4', true );
				$img5 = get_post_meta( $post_id, 'destination_img5', true );
				$img6 = get_post_meta( $post_id, 'destination_img6', true );
				$img7 = get_post_meta( $post_id, 'destination_img7', true );
				$img8 = get_post_meta( $post_id, 'destination_img8', true );
				$img9 = get_post_meta( $post_id, 'destination_img9', true );
				$img10 = get_post_meta( $post_id, 'destination_img10', true );
				$img11 = get_post_meta( $post_id, 'destination_img11', true );
				$img12 = get_post_meta( $post_id, 'destination_img12', true );
				$img13 = get_post_meta( $post_id, 'destination_img13', true );
				$img14 = get_post_meta( $post_id, 'destination_img14', true );
				$img15 = get_post_meta( $post_id, 'destination_img15', true );
				$img16 = get_post_meta( $post_id, 'destination_img16', true );
				$img17 = get_post_meta( $post_id, 'destination_img17', true );
				$img18 = get_post_meta( $post_id, 'destination_img18', true );

				if ( (!empty ($img1)) || (!empty ($img2)) || (!empty ($img3)) || (!empty ($img4)) || (!empty ($img5)) || (!empty ($img6)) || (!empty ($img7)) || (!empty ($img8)) || (!empty ($img9)) || (!empty ($img10)) || (!empty ($img11)) || (!empty ($img12)) || (!empty ($img13)) || (!empty ($img14)) || (!empty ($img15)) || (!empty ($img16)) || (!empty ($img17)) || (!empty ($img18)) ) {
			?>
			<div class="box">
				<div class="destination-gallery">
					<h4><?php echo __($travel_photo_gallery_text, 'jt-travel-booking'); ?></h4>
					<?php
						if (!empty ($img1)) {
					?>
					<a href="<?php echo $img1; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img1; ?>"></a>
					<?php
						}
						if (!empty ($img2)) {
					?>
					<a href="<?php echo $img2; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img2; ?>"></a>
					<?php
						}
						if (!empty ($img3)) {
					?>
					<a href="<?php echo $img3; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img3; ?>"></a>
					<?php
						}
						if (!empty ($img4)) {
					?>
					<a href="<?php echo $img4; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img4; ?>"></a>
					<?php
						}
						if (!empty ($img5)) {
					?>
					<a href="<?php echo $img5; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img5; ?>"></a>
					<?php
						}
						if (!empty ($img6)) {
					?>
					<a href="<?php echo $img6; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img6; ?>"></a>
					<?php
						}
						if (!empty ($img7)) {
					?>
					<a href="<?php echo $img7; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img7; ?>"></a>
					<?php
						}
						if (!empty ($img8)) {
					?>
					<a href="<?php echo $img8; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img8; ?>"></a>
					<?php
						}
						if (!empty ($img9)) {
					?>
					<a href="<?php echo $img9; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img9; ?>"></a>
					<?php
						}
						if (!empty ($img10)) {
					?>
					<a href="<?php echo $img10; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img10; ?>"></a>
					<?php
						}
						if (!empty ($img11)) {
					?>
					<a href="<?php echo $img11; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img11; ?>"></a>
					<?php
						}
						if (!empty ($img12)) {
					?>
					<a href="<?php echo $img12; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img12; ?>"></a>
					<?php
						}
						if (!empty ($img13)) {
					?>
					<a href="<?php echo $img13; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img13; ?>"></a>
					<?php
						}
						if (!empty ($img14)) {
					?>
					<a href="<?php echo $img14; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img14; ?>"></a>
					<?php
						}
						if (!empty ($img15)) {
					?>
					<a href="<?php echo $img15; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img15; ?>"></a>
					<?php
						}
						if (!empty ($img16)) {
					?>
					<a href="<?php echo $img16; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img16; ?>"></a>
					<?php
						}
						if (!empty ($img17)) {
					?>
					<a href="<?php echo $img17; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img17; ?>"></a>
					<?php
						}
						if (!empty ($img18)) {
					?>
					<a href="<?php echo $img18; ?>" data-uk-lightbox="{group:'destination-images'}"><img src="<?php echo $img18; ?>"></a>
					<?php
						}
					?>
				</div>
			</div>
			<?php
				}
			?>
						
						
			<div id="book-form-section" class="uk-modal">
				<div class="uk-modal-dialog uk-modal-dialog-blank">
					<button class="uk-modal-close uk-close" type="button"></button>
					<div class="uk-grid uk-flex-middle">
						<div class="uk-width-1-2">
							<figure class="uk-overlay">
								<img class="uk-height-viewport" src="<?php the_post_thumbnail_url('large'); ?>"/>
								<figcaption class="uk-overlay-background uk-overlay-panel uk-overlay-bottom">
									<?php
										if ( is_single() ) :
											the_title( '<h1 class="destination-title">', '</h1>' );
										else :
											the_title( '<h2 class="destination-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
										endif;

										$destination_short_info = esc_html( get_post_meta( $post_id, 'destination_short_info', true ) );
									?>
								</figcaption>
							</figure>
						</div>
						<div class="uk-width-1-2 booking-form">
							<?php echo $response; ?>
							<?php
								if (empty ($destination_custom_form)) {
							?>
							<form class="uk-form uk-form-stacked" method="post" action="<?php the_permalink(); ?>">
								<input type="hidden" name="booking_destination" value="<?php echo the_title(); ?>">
								<input type="hidden" name="booking_price" value="<?php echo $destination_price; ?>">
								<div class="uk-grid">
									<div class="uk-width-1-2">
										<p>
											<label class="uk-form-label"><?php echo __($travel_first_name_text, 'jt-travel-booking'); ?></label>
											<input class="uk-form-controls" type="text" name="booking_first_name" placeholder="<?php echo __($travel_first_name_text, 'jt-travel-booking'); ?>" value="<?php echo esc_attr($_POST['booking_first_name']); ?>" required>
										</p>
										<p>
											<label class="uk-form-label"><?php echo __($travel_last_name_text, 'jt-travel-booking'); ?></label>
											<input class="uk-form-controls" type="text" name="booking_last_name" placeholder="<?php echo __($travel_last_name_text, 'jt-travel-booking'); ?>" value="<?php echo esc_attr($_POST['booking_last_name']); ?>" required>
										</p>
										<p>
											<label class="uk-form-label"><?php echo __($travel_email_text, 'jt-travel-booking'); ?></label>
											<input class="uk-form-controls" type="email" name="booking_email" placeholder="<?php echo __($travel_email_text, 'jt-travel-booking'); ?>" value="<?php echo esc_attr($_POST['booking_email']); ?>" required>
										</p>
									</div>
									<div class="uk-width-1-2">
										<p>
											<label class="uk-form-label"><?php echo __($travel_phone_number_text, 'jt-travel-booking'); ?></label>
											<input class="uk-form-controls" type="text" name="booking_phone_number" placeholder="<?php echo __($travel_phone_number_text, 'jt-travel-booking'); ?>" value="<?php echo esc_attr($_POST['booking_phone_number']); ?>" required>
										</p>
										<p>
											<label class="uk-form-label"><?php echo __($travel_number_of_persons_text, 'jt-travel-booking'); ?></label>
											<input class="uk-form-controls" type="number" name="booking_persons" min="1" value="<?php echo esc_attr($_POST['booking_persons']); ?>" required>
										</p>
										<label class="uk-form-label"><?php echo __($travel_departure_text, 'jt-travel-booking'); ?></label>
										<select name="booking_departure" class="uk-form-controls">
											<?php
												$destination_departure_dates = get_post_meta( $post_id, 'destination_departures', true );
												$departures = explode(', ', $destination_departure_dates);
												foreach ( $departures as $departure ) {
													echo '<option value="' . $departure . '">' . $departure . '</option>';
												}
											?>
										</select>
									</div>
								</div>
								<p>
									<label class="uk-form-label"><?php echo __($travel_comments_text, 'jt-travel-booking'); ?></label>
									<textarea class="uk-form-controls" name="booking_additional_comments" rows="7" required><?php echo esc_attr($_POST['booking_additional_comments']); ?></textarea>
								</p>
								<p class="book-trip-btn">
									<input type="submit" name="booking_submit" value="<?php echo __($travel_book_now_btn_text, 'jt-travel-booking'); ?>">
								</p>
							</form>
							<?php
								}
								else {
									echo $destination_custom_form;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>

<?php
	endwhile; // End of the loop.
?>