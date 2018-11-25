<?php
	$options = get_option( 'jt_schedule_settings' );
	$translate = get_option( 'jt_schedule_translations' );
	include ( dirname( __FILE__ ) . '/../../options/variables.php');
	include ( dirname( __FILE__ ) . '/../../options/strings.php');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
	<div class="container">
		<div class="jt-schedule-2">
			<div class="uk-grid">
				<div class="uk-width-7-10">
					<figure class="uk-overlay">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail(); ?>
						<?php endif; ?>
						<figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom">
							<?php
								$short_info = esc_attr( get_post_meta( $post_id, 'class_short_info', true ) );
								the_title( '<h1 class="class-title">', '</h1>' );

								if (!empty ($short_info)) {
							?>
							<p class="short-info"><?php echo $short_info; ?></p>
							<?php
								}
							?>
						</figcaption>
					</figure>
				</div>
				<div class="uk-width-3-10">
					<?php
						$starts = esc_attr( get_post_meta( $post_id, 'class_starts', true ) );
						$duration = esc_attr( get_post_meta( $post_id, 'class_duration', true ) );
						$trainer = esc_attr( get_post_meta( $post_id, 'class_trainer', true ) );
						$room = esc_attr( get_post_meta( $post_id, 'class_room', true ) );
						$price = esc_attr( get_post_meta( $post_id, 'class_price', true ) );
						$color = esc_attr( get_post_meta( $post_id, 'class_color', true ) );
					?>
					<div class="class-basic-info">
						<?php
							if (!empty ($starts) ) {
								echo __('<p><span>' . $starts_text . ':</span>' . $starts . '</p>', 'jt-schedule');
							}
							if (!empty ($duration) ) {
								echo __('<p><span>' . $duration_text . ':</span>' . $duration . '</p>', 'jt-schedule');
							}
							if (!empty ($trainer) ) {
								echo __('<p><span>' . $instructor_text . ':</span>' . $trainer . '</p>', 'jt-schedule');
							}
							if (!empty ($room) ) {
								echo __('<p><span>' . $class_text . ':</span>' . $room . '</p>', 'jt-schedule');
							}
							if (!empty ($price) ) {
								echo __('<p><span>' . $price_text . ':</span>' . $price . '</p>', 'jt-schedule');
							}
						?>
					</div>
					<?php
						$registration_form = esc_attr( get_post_meta( $post_id, 'class_registration', true ) );
						$custom_registration_form = apply_filters('the_content', get_post_meta( $post_id, 'class_custom_registration', true ) );

						if (($registration_form != 'no') || (!empty ($custom_registration_form))) {
					?>
					<span class="sign-in-btn" data-uk-modal="{target:'#sign-up-box'}" style="background: <?php echo $color; ?>">
						<?php echo $signup_text; ?>
					</span>
					<?php
						}
					?>
				</div>
			</div>
			
			<div class="uk-grid">
				<div class="uk-width-1-2">
					<?php
						$class_info = wpautop(get_post_meta( $post_id, 'class_info', true ));
						if (!empty ($class_info)) {
					?>
					<div class="class-info">
						<?php echo $class_info; ?>
					</div>
					<?php
						}
					?>
				</div>
				<div class="uk-width-1-2">
					<?php
						$video_url = get_post_meta( $post_id, 'class_video_url', true );
						$video_embed = get_post_meta( $post_id, 'class_video_embed', true );
						if ( (!empty ($video_url)) || (!empty ($video_embed)) ) {
					?>
					<div class="class-video">
						<?php
							if (!empty ($video_url)) {
						?>
						<video width="670" height="378" controls>
							<source src="<?php echo $video_url; ?>" type="video/mp4">
						</video>
						<?php
							}
							else if (!empty ($video_embed)) {
								echo $video_embed;
							}
						?>
					</div>
					<?php
						}
						$img1 = get_post_meta( $post_id, 'class_gallery_img1', true );
						$img2 = get_post_meta( $post_id, 'class_gallery_img2', true );
						$img3 = get_post_meta( $post_id, 'class_gallery_img3', true );
						$img4 = get_post_meta( $post_id, 'class_gallery_img4', true );
						$img5 = get_post_meta( $post_id, 'class_gallery_img5', true );
						$img6 = get_post_meta( $post_id, 'class_gallery_img6', true );
						$img7 = get_post_meta( $post_id, 'class_gallery_img7', true );
						$img8 = get_post_meta( $post_id, 'class_gallery_img8', true );

						if ( (!empty ($img1)) || (!empty ($img2)) || (!empty ($img3)) || (!empty ($img4)) || (!empty ($img5)) || (!empty ($img6)) || (!empty ($img7)) || (!empty ($img8)) ) {
					?>
					<div class="class-gallery">
						<?php
							if (!empty ($img1)) {
						?>
						<a href="<?php echo $img1; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img1; ?>"></a>
						<?php
							}
							if (!empty ($img2)) {
						?>
						<a href="<?php echo $img2; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img2; ?>"></a>
						<?php
							}
							if (!empty ($img3)) {
						?>
						<a href="<?php echo $img3; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img3; ?>"></a>
						<?php
							}
							if (!empty ($img4)) {
						?>
						<a href="<?php echo $img4; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img4; ?>"></a>
						<?php
							}
							if (!empty ($img5)) {
						?>
						<a href="<?php echo $img5; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img5; ?>"></a>
						<?php
							}
							if (!empty ($img6)) {
						?>
						<a href="<?php echo $img6; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img6; ?>"></a>
						<?php
							}
							if (!empty ($img7)) {
						?>
						<a href="<?php echo $img7; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img7; ?>"></a>
						<?php
							}
							if (!empty ($img8)) {
						?>
						<a href="<?php echo $img8; ?>" data-uk-lightbox="{group:'class-images'}"><img src="<?php echo $img8; ?>"></a>
						<?php
							}
						?>
					</div>
					<?php
						}
					?>
				</div>
			</div>
			
			<div id="sign-up-box" class="uk-modal">
				<div class="uk-modal-dialog">
					<div class="uk-modal-header">
						<?php echo __(the_title() . ' - ' . $signup_text, 'jt-schedule'); ?>
						<a class="uk-modal-close uk-close"></a>
					</div>
					<?php
						if ($registration_form != 'no') {
					?>
					<form class="uk-form uk-form-stacked" method="post">
						<div class="uk-grid">
							<div class="uk-width-1-2">
								<p>
									<label class="uk-form-label"><?php echo __($firstname_text, 'jt-schedule'); ?></label>
									<input class="uk-form-controls" type="text" name="first_name" placeholder="<?php echo __($firstname_text, 'jt-schedule'); ?>" value="<?php echo esc_attr($_POST['first_name']); ?>" required>
								</p>
								<p>
									<label class="uk-form-label"><?php echo __($lastname_text, 'jt-schedule'); ?></label>
									<input class="uk-form-controls" type="text" name="last_name" placeholder="<?php echo __($lastname_text, 'jt-schedule'); ?>" value="<?php echo esc_attr($_POST['last_name']); ?>" required>
								</p>
								<p>
									<label class="uk-form-label"><?php echo __($email_text, 'jt-schedule'); ?></label>
									<input class="uk-form-controls" type="email" name="email" placeholder="<?php echo __($email_text, 'jt-schedule'); ?>" value="<?php echo esc_attr($_POST['email']); ?>" required>
								</p>
							</div>
							<div class="uk-width-1-2">
								<p>
									<label class="uk-form-label"><?php echo __($phone_text, 'jt-schedule'); ?></label>
									<input class="uk-form-controls" type="text" name="phone_number" placeholder="<?php echo __($phone_text, 'jt-schedule'); ?>" value="<?php echo esc_attr($_POST['phone_number']); ?>" required>
								</p>
								<p>
									<?php
										$terms = get_the_terms( $post_id, 'classes_categories' );
										if ( ! empty( $terms ) ) {
									?>
									<label class="uk-form-label"><?php echo __($day_text, 'jt-staff-profiles'); ?></label>
									<select class="uk-form-controls" name="day">
										<?php
											sort($terms);
											foreach ( $terms as $term ) {
										?>
										<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
										<?php
											}
										?>
									</select>
									<?php
										}
									?>
								</p>
								<input type="submit" name="submit" value="<?php echo __($submit_text, 'jt-schedule'); ?>">
							</div>
						</div>
					</form>
					<?php
						}
						else if (!empty ($custom_registration_form)) {
							echo $custom_registration_form;
						}
					?>
				</div>
			</div>
		</div>
				
		<?php
			$first_name = (isset($_POST['first_name']) ? $_POST['first_name'] : null);
			$last_name = (isset($_POST['last_name']) ? $_POST['last_name'] : null);
			$email = (isset($_POST['email']) ? $_POST['email'] : null);
			$phone_number = (isset($_POST['phone_number']) ? $_POST['phone_number'] : null);
			$day = (isset($_POST['day']) ? $_POST['day'] : null);
			$submit = (isset($_POST['submit']) ? $_POST['submit'] : null);

			$to = get_option('admin_email');
			$subject = $user_registered_text . " " . get_the_title($post_id);

			$headers[] = 'From: '. $email . "\r\n";
			$headers[] = 'Reply-To: ' . $email . "\r\n";

			$message = $class_text . ": " . get_the_title($post_id) . "\r\n\r\n" . $name_text . ": " . $first_name . " " . $last_name . "\r\n" . $email_text . ": " . $email . " \r\n" . $phone_text . ": " . $phone_number . " \r\n" . $day_text . ": " . $day . "\r\n" . $time_text . ": " . $starts; 

			if ($submit) {
				$sent = wp_mail($to, $subject, strip_tags($message), $headers);
			}   
		?>		
	</div>
</article><!-- #post-## -->