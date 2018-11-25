<div id="primary" class="content-area jt-travel-booking-2">
			<main id="main" class="site-main">

			<?php
				while ( have_posts() ) : the_post();
					$post_id = get_the_ID();

					$options = get_option( 'jt_travel_booking_agency' );
					$translate = get_option( 'jt_travel_booking_translations' );
					include ( dirname( __FILE__ ) . '/../options/variables.php');
					include ( dirname( __FILE__ ) . '/../options/strings.php');
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large' ); ?>
								<?php endif; ?>
								<div class="destination-price-box">
									<span><?php echo __($travel_starts_from_text, 'jt-travel-booking'); ?></span> 
									<?php
										$destination_price = esc_html( get_post_meta( $post_id, 'destination_price', true ) ); 
										echo $destination_price;
									?>
								</div>
								<?php 
									$destination_map = get_post_meta( $post_id, 'destination_map', true ); 
									echo $destination_map;
								?>
								<?php
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
							
							<div class="col-md-8">
								<div class="box">
									<header class="entry-header">
										<?php
											if ( is_single() ) :
												the_title( '<h1 class="destination-title">', '</h1>' );
											else :
												the_title( '<h2 class="destination-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
											endif;
										
											$destination_days = esc_html( get_post_meta( $post_id, 'destination_days', true ) );
											$destination_periods = esc_html( get_post_meta( $post_id, 'destination_periods', true ) );
											$destination_transportation_icon = esc_html( get_post_meta( $post_id, 'destination_transportation_icon', true ) );
											$destination_transportation = esc_html( get_post_meta( $post_id, 'destination_transportation', true ) );
										?>
										<?php
											if (!empty ($destination_days)) {
										?>
										<span><?php echo '<i class="fa fa-clock-o"></i>' . $destination_days . ' ' .  __($travel_days_text); ?></span>
										<?php
											}
											if (!empty ($destination_periods)) {
										?>
										<span><?php echo '<i class="fa fa-calendar"></i>' . $destination_periods; ?></span>
										<?php
											}
											if (!empty ($destination_transportation)) {
										?>
										<span><?php echo '<i class="' . $destination_transportation_icon . '"></i>' . $destination_transportation; ?></span>
										<?php
											}
										?>
									</header><!-- .entry-header -->
								</div>
								
								<?php
									$destination_departure_dates = get_post_meta( $post_id, 'destination_departures', true );
									if (!empty ($destination_departure_dates) ) {
								?>
								<div class="box">
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
								</div>
								<?php
									}
								?>
								
								<div class="box">
									<ul class="uk-tab" data-uk-switcher="{connect:'#destination-info-tabs'}">
										<?php
											$destination_info = wpautop(get_post_meta( $post_id, 'destination_info', true ));
											$destination_daily_program = wpautop(get_post_meta( $post_id, 'destination_daily_program', true ));
											$destination_hotels = wpautop(get_post_meta( $post_id, 'destination_hotels', true ));
											$destination_provisions = wpautop(get_post_meta( $post_id, 'destination_provisions', true ));
											$destination_things_to_do = wpautop(get_post_meta( $post_id, 'destination_things_to_do', true ));
											$destination_booking_info = wpautop(get_post_meta( $post_id, 'destination_booking_info', true ));
											$destination_video_url = get_post_meta( $post_id, 'destination_video_url', true);
											$destination_video_embed = get_post_meta( $post_id, 'destination_video_embed', true);

											if (!empty ($destination_info)) {
										?>
										<li><a href="" onclick="return false;"><?php echo __($travel_info_text, 'jt-travel-booking'); ?></a></li>
										<?php
											}
											if (!empty ($destination_daily_program)) {
										?>
										<li><a href="" onclick="return false;"><?php echo __($travel_daily_program_text, 'jt-travel-booking'); ?></a></li>
										<?php
											}
											if (!empty ($destination_hotels)) {
										?>
										<li><a href="" onclick="return false;"><?php echo __($travel_hotels_text, 'jt-travel-booking'); ?></a></li>
										<?php
											}
											if (!empty ($destination_provisions)) {
										?>
										<li><a href="" onclick="return false;"><?php echo __($travel_provisions_text, 'jt-travel-booking'); ?></a></li>
										<?php
											}
											if (!empty ($destination_things_to_do)) {
										?>
										<li><a href="" onclick="return false;"><?php echo __($travel_things_to_do_text, 'jt-travel-booking'); ?></a></li>
										<?php
											}
											if (!empty ($destination_booking_info)) {
										?>
										<li><a href="" onclick="return false;"><?php echo __($travel_booking_info_text, 'jt-travel-booking'); ?></a></li>
										<?php
											}
											if ( (!empty ($destination_video_url)) || (!empty ($destination_video_embed)) ) {
										?>
										<li><a href="" onclick="return false;"><?php echo __($travel_video_text, 'jt-travel-booking'); ?></a></li>
										<?php
											}
										?>
									</ul>

									<ul id="destination-info-tabs" class="uk-switcher uk-margin">
										<?php
											if (!empty ($destination_info)) {
										?>
										<li><?php echo $destination_info; ?></li>
										<?php
											}
											if (!empty ($destination_daily_program)) {
										?>
										<li><?php echo $destination_daily_program; ?></li>
										<?php
											}
											if (!empty ($destination_hotels)) {
										?>
										<li><?php echo $destination_hotels; ?></li>
										<?php
											}
											if (!empty ($destination_provisions)) {
										?>
										<li><?php echo $destination_provisions; ?></li>
										<?php
											}
											if (!empty ($destination_things_to_do)) {
										?>
										<li><?php echo $destination_things_to_do; ?></li>
										<?php
											}
											if (!empty ($destination_booking_info)) {
										?>
										<li><?php echo $destination_booking_info; ?></li>
										<?php
											}
											if ((!empty ($destination_video_url)) || (!empty ($destination_video_embed))) {
										?>
										<li>
										<?php
											if (!empty ($destination_video_url)) {
										?>
										<div class="event-video">
											<video width="680" height="390" controls>
											  <source src="<?php echo $destination_video_url; ?>" type="video/mp4">
											</video>
										</div>
										<?php
											}
											else if (!empty ($destination_video_embed)) {
										?>
										<div class="event-video">
											<?php echo $destination_video_embed; ?>
										</div>
										<?php
											}
										?>
										</li>
										<?php
											}
										?>
									</ul>
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
							</div>
						</div>
						
						<?php
							$destination_booking_form = esc_html( get_post_meta( $post_id, 'destination_booking_form', true ) );
							$destination_custom_form = do_shortcode( get_post_meta( $post_id, 'destination_custom_form', true ));

							if (($destination_booking_form == 'yes') || ($destination_booking_form == '') || (!empty ($destination_custom_form))) {
						?>
						<div class="row book-destination-box">
							<div class="col-md-9">
								<p><?php echo __($travel_book_now_text, 'jt-travel-booking'); ?></p>
							</div>
							<div class="col-md-3">
								<a class="book-now-btn" data-uk-toggle="{target:'#book-form-section', animation:'uk-animation-fade'}"><?php echo _e($travel_book_this_tour_text, 'jt-travel-booking'); ?></a>
							</div>
						</div>
						
						<div id="book-form-section" class="uk-hidden">
                			<?php echo $response; ?>
							<?php
								if (empty ($destination_custom_form)) {
							?>
							<form class="uk-form uk-form-stacked" method="post" action="<?php the_permalink(); ?>">
								<div class="row">
									<div class="col-md-6">
										<input type="hidden" name="booking_destination" value="<?php echo the_title(); ?>">
										<input type="hidden" name="booking_price" value="<?php echo $destination_price; ?>">
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
									<div class="col-md-6">
										<p>
											<label class="uk-form-label"><?php echo __($travel_comments_text, 'jt-travel-booking'); ?></label>
											<textarea class="uk-form-controls" name="booking_additional_comments" rows="17" required><?php echo esc_attr($_POST['booking_additional_comments']); ?></textarea>
										</p>
									</div>
								</div>
								<p class="book-trip-btn">
									<input type="submit" name="booking_submit" value="<?php echo __($travel_book_now_btn_text, 'jt-travel-booking'); ?>">
								</p>
							</form>
							<?php
								}
							?>
						</div>
						<?php
							}
						?>
						
						<!-- More Destinations -->
						<div class="more-destinations-section">
							<h4><span><?php echo __($travel_more_destinations, 'jt-travel-booking'); ?></span></h4>
						</div>
						<div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-5 destinations-5-cols uk-grid-match" data-uk-grid>
						<?php

							$args = array("posts_per_page" => 5, "post_type" => array('destinations_list'), "orderby" => "rand");

							$posts_array = get_posts($args);

							// Show these posts in a grid
							foreach($posts_array as $post) {
								$post_type = get_post_type_object( get_post_type($post) );

						?>
						<div>
							<figure class="uk-overlay uk-overlay-hover">
								<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt="">
								<figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-ignore">
									<a class="destination-link" href="<?php echo get_permalink( $post->ID ); ?>"></a>
									<div>			
										<div class="destination-short-info">
											<h3 class="destination-title"><?php echo $post->post_title; ?></h3>
										</div>
										<div class="destination-bottom-info">
											<?php 
												$destination_price = esc_html( get_post_meta( $post->ID, 'destination_price', true ) );
												if (! empty ($destination_price)) { ?>
											<div class="destination-price">
												<span><?php echo __($travel_starts_from_text, 'jt-travel-booking'); ?></span>
												<?php echo $destination_price; ?>
											</div>
											<?php } ?>
											<?php
												$destination_days = esc_html( get_post_meta( $post->ID, 'destination_days', true ) );
												if (! empty ($destination_days)) { ?>
											<div class="destination-days">
												<span><?php echo __($travel_days_text . ':', 'jt-travel-booking'); ?></span>
												<?php echo $destination_days; ?>
											</div>
											<?php } ?>
										</div>
									</div>
								</figcaption>
							</figure>
						</div>
						<?php
							} 
						?>
					</div>
					</div>
				</article><!-- #post-## -->
				
				<?php
					endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->