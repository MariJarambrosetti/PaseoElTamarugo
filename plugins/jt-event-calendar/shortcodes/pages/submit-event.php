<?php

	$option = get_option( 'jt_settings' );
	$translate = get_option( 'jt_event_translations' );
	include ( plugin_dir_path( __FILE__ ) . '../../settings/variables.php');
	include ( plugin_dir_path( __FILE__ ) . '../../settings/strings.php');

	if ( isset( $_POST['submitted'] )) {

		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		
		if ( trim( $_POST['postTitle'] ) === '' ) {
			$postTitleError = 'Please enter a title.';
			$hasError = true;
		}
		
		$post_information = array(
			'post_title' => wp_strip_all_tags( $_POST['event_title'] ),
			'post_type' => 'events_list',
			'post_category' => intval($_POST['event_cat']),
			'post_status' => 'pending',
		);

		$post_id = wp_insert_post( $post_information );
		wp_set_object_terms( $post_id, intval( $_POST['event_cat'] ), 'events_categories', false );
		$attachment_id = media_handle_upload('event_img',$post_id);
		set_post_thumbnail($post_id, $attachment_id); 
		
        add_post_meta( $post_id, 'event_start_date', date_i18n("Y/m/d", strtotime($_POST['event_start_date'])) );
        add_post_meta( $post_id, 'event_end_date', date_i18n("Y/m/d", strtotime($_POST['event_end_date'])) );
	}

	$user = wp_get_current_user();
	$user_post_count = count_user_posts( $user->ID , 'profiles_list' );
	if ( is_user_logged_in() ) {
		$event_info = '';
		$info = 'event_info';
		$event_ticket_price = '';
		$ticket_price = 'event_ticket_price';
?>

	<form class="submit-event-form" method="POST">
		<ul id="event-tabs-nav" data-uk-switcher="{connect:'#event-tabs'}">
			<li><a href=""><?php echo __($event_basic_info_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($info_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($tickets_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($special_guests_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($schedule_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($sponsors_text, 'jt-event-calendar'); ?></a></li>
			<li><a href=""><?php echo __($event_media_text, 'jt-event-calendar'); ?></a></li>
		</ul>

		<ul id="event-tabs" class="uk-switcher">
			<li>
				<table>
					<tr>
						<td style="width: 150px"><?php echo __($event_category_text, 'jt-event-calendar'); ?></td>
						<td>
							<select name="event_cat">
								<?php
									$post_cats = get_terms('events_categories', array('hide_empty' => false));
									foreach ( $post_cats as $cat ) {
								?>
								<option value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
								<?php
									}
								?>
							</select>	
						</td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_title_text, 'jt-event-calendar'); ?></td>
						<td><input type="text" size="80" name="event_title" /></td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_image_title_text, 'jt-event-calendar'); ?></td>
						<td><input type="file" name="event_img" multiple="false" /></td>
					</tr>
					<tr>
						<td style="width: 100%"><?php echo __($event_short_info_text, 'jt-event-calendar'); ?></td>
						<td><textarea name="event_short_info" cols="70" rows="3"></textarea></td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_location_text, 'jt-event-calendar'); ?></td>
						<td><input type="text" size="80" name="event_location" /></td>
					</tr>
					<tr>
						<td style="width: 100%"><?php echo __($event_map_text, 'jt-event-calendar'); ?></td>
						<td><textarea name="event_map" cols="70" rows="3"></textarea></td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_starts_text, 'jt-event-calendar'); ?></td>
						<td><input type="text" size="80" name="event_start_date" /></td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_ends_text, 'jt-event-calendar'); ?></td>
						<td><input type="text" size="80" name="event_end_date" /></td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_time_text, 'jt-event-calendar'); ?></td>
						<td><input type="text" size="80" name="event_time" /></td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_link_text, 'jt-event-calendar'); ?></td>
						<td><input type="text" size="80" name="event_link_text" /></td>
					</tr>
					<tr>
						<td style="width: 150px"><?php echo __($event_link_url_text, 'jt-event-calendar'); ?></td>
						<td><input type="text" size="80" name="event_link_url" /></td>
					</tr>
				</table>
			</li>

			<li>
				<?php wp_editor( html_entity_decode(stripcslashes($event_info)), $info ); ?>
			</li>

			<li>
				<table>
					<tr>
						<td style="width: 150px"><?php echo __($event_free_entrance_text, 'jt-event-calendar'); ?></td>
						<td>
							<select name="event_free_entrance">
								<option value="no"><?php echo __($event_no_text, 'jt-event-calendar'); ?></option>
								<option value="yes"><?php echo __($event_yes_text, 'jt-event-calendar'); ?></option>
							</select>
						</td>
					</tr>
				</table>
				<hr />
				<?php wp_editor( html_entity_decode(stripcslashes($event_ticket_price)), $ticket_price ); ?>
			</li>

			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-3">
						<p>
							<strong><?php echo __($event_add_special_guests_text . ':', 'jt-event-calendar'); ?></strong>
						</p>
						<p>
							<?php echo __($event_guest_name_text, 'jt-event-calendar'); ?>
						</p>
						<p>
							<strong><?php echo __($event_example_text . ':', 'jt-event-calendar'); ?></strong>
						</p>
						<p>
							<?php echo __('John Doe | Developer', 'jt-event-calendar'); ?>
						</p>
					</div>
					<div class="uk-width-2-3">
						<textarea name="event_special_guests" cols="80" rows="20"></textarea>
					</div>
				</div>
			</li>

			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-3">
						<p>
							<strong><?php echo __($event_add_schedule_text . ':', 'jt-event-calendar'); ?></strong>
						</p>
						<p>
							<?php echo __('09:00 - 10:00 | Welcome audience.<br />10:00 - 11:00 | Introduction by the CEO of the company.<br />11:00 - 11:30 | Coffee Break.', 'jt-event-calendar'); ?>
						</p>
					</div>
					<div class="uk-width-2-3">
						<textarea name="event_schedule" cols="80" rows="20"></textarea>
					</div>
				</div>
				<p class="event-form-fields event-gallery-fields">
					<label><?php echo __($event_schedule_file_text, 'jt-event-calendar'); ?></label>
					<label for="event_schedule_file">
						<input id="event_schedule_file" type="text" size="50" name="event_schedule_file" /><input id="event_schedule_file_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
			</li>
			
			<li>
				<div class="uk-grid event-form-fields">
					<div class="uk-width-1-2">
						<p>
							<label><?php echo __($event_sponsor_text . ' #1', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img1" class="event-gallery-fields">
								<input id="event_sponsor_img1" type="text" size="50" name="event_sponsor_img1" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_sponsor_img1_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url1" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #2', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img2" class="event-gallery-fields">
								<input id="event_sponsor_img2" type="text" size="50" name="event_sponsor_img2" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_sponsor_img2_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url2" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #3', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img3" class="event-gallery-fields">
								<input id="event_sponsor_img3" type="text" size="50" name="event_sponsor_img3" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_sponsor_img3_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url3" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #4', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img4" class="event-gallery-fields">
								<input id="event_sponsor_img4" type="text" size="50" name="event_sponsor_img4" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_sponsor_img4_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url4" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #5', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img5" class="event-gallery-fields">
								<input id="event_sponsor_img5" type="text" size="50" name="event_sponsor_img5" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_sponsor_img5_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url5" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_sponsor_text . ' #6', 'jt-event-calendar'); ?></label>
							<label for="event_sponsor_img6" class="event-gallery-fields">
								<input id="event_sponsor_img6" type="text" size="50" name="event_sponsor_img6" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_sponsor_img6_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_sponsor_url6" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
					</div>
					<div class="uk-width-1-2">
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #1', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img1" class="event-gallery-fields">
								<input id="event_media_sponsor_img1" type="text" size="50" name="event_media_sponsor_img1" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>"  /><input id="event_media_sponsor_img1_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url1" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #2', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img2" class="event-gallery-fields">
								<input id="event_media_sponsor_img2" type="text" size="50" name="event_media_sponsor_img2" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>"  /><input id="event_media_sponsor_img2_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url2" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #3', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img3" class="event-gallery-fields">
								<input id="event_media_sponsor_img3" type="text" size="50" name="event_media_sponsor_img3" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>"  /><input id="event_media_sponsor_img3_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url3" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #4', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img4" class="event-gallery-fields">
								<input id="event_media_sponsor_img4" type="text" size="50" name="event_media_sponsor_img4" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_media_sponsor_img4_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url4" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #5', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img5" class="event-gallery-fields">
								<input id="event_media_sponsor_img5" type="text" size="50" name="event_media_sponsor_img5" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_media_sponsor_img5_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url5" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
						<p>
							<label><?php echo __($event_media_sponsor_text . ' #6', 'jt-event-calendar'); ?></label>
							<label for="event_media_sponsor_img6" class="event-gallery-fields">
								<input id="event_media_sponsor_img6" type="text" size="50" name="event_media_sponsor_img6" placeholder="<?php echo __($event_logo_text, 'jt-event-calendar'); ?>" /><input id="event_media_sponsor_img6_button" class="button" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
							</label>
							<input type="url" name="event_media_sponsor_url6" size="62" placeholder="<?php echo __($event_website_text, 'jt-event-calendar'); ?>" />
						</p>
					</div>
				</div>
			</li>
			<li>
				<table>
					<tr>
						<td style="width: 100%"><?php echo __($event_video_url_text, 'jt-event-calendar'); ?></td>
						<td><input type="url" size="80" name="event_video_url" /></td>
					</tr>
					<tr>
						<td style="width: 100%"><?php echo __($event_video_embed_text, 'jt-event-calendar'); ?></td>
						<td><textarea name="event_video" cols="70" rows="3"></textarea></td>
					</tr>
				</table>
				<hr />
				<h3><?php echo __($photo_gallery_text, 'jt-event-calendar'); ?></h3>
				<p>
					<label for="event_gallery_img1">
						<input id="event_gallery_img1" type="text" size="100" name="event_gallery_img1" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 1" /><input id="event_gallery_img1_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
				<p>
					<label for="event_gallery_img2">
						<input id="event_gallery_img2" type="text" size="100" name="event_gallery_img2" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 2" /><input id="event_gallery_img2_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
				<p>
					<label for="event_gallery_img3">
						<input id="event_gallery_img3" type="text" size="100" name="event_gallery_img3" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 3" /><input id="event_gallery_img3_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
				<p>
					<label for="event_gallery_img4">
						<input id="event_gallery_img4" type="text" size="100" name="event_gallery_img4" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 4" /><input id="event_gallery_img4_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
				<p>
					<label for="event_gallery_img5">
						<input id="event_gallery_img5" type="text" size="100" name="event_gallery_img5" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 5" /><input id="event_gallery_img5_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
				<p>
					<label for="event_gallery_img6">
						<input id="event_gallery_img6" type="text" size="100" name="event_gallery_img6" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 6" /><input id="event_gallery_img6_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
				<p>
					<label for="event_gallery_img7">
						<input id="event_gallery_img7" type="text" size="100" name="event_gallery_img7" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 7" /><input id="event_gallery_img7_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
				<p>
					<label for="event_gallery_img8">
						<input id="event_gallery_img8" type="text" size="100" name="event_gallery_img8" placeholder="<?php echo __($event_image_text, 'jt-event-calendar'); ?> 8" /><input id="event_gallery_img8_button" class="button-upload" type="button" value="<?php echo __($event_upload_text, 'jt-event-calendar'); ?>" />
					</label>
				</p>
			</li>
		</ul>
		
		<input type="hidden" name="submitted" id="submitted" value="true" />
		<button type="submit"><?php echo __($event_submit_text, 'jt-event-calendar') ?></button>
	</form>
<?php
	}
	else {
		echo __($event_login_message_text, 'jt-event-calendar');
	}
?>