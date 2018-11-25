<div class="schedule-slider uk-slidenav-position" data-uk-slideshow>
	<ul class="uk-slideshow">
		<?php
			if ($category == 'all') {
				$terms = get_terms( 'classes_categories', array(
					'orderby'    => 'id',
					'hide_empty' => 1
				) );
			}
			else {
				$terms = array($category);
			}

			foreach( $terms as $term ) {

				if ($category == 'all') {
					// Define the query
					$args = array(
						'posts_per_page' => -1,
						'post_type' => 'schedule',
						'classes_categories' => $term->slug,
						'orderby' => 'meta_value', 'meta_key' => 'class_starts', "order" => $order
					);
				}
				else {
					$args = array(
						'posts_per_page' => -1,
						'post_type' => 'schedule',
						'classes_categories' => $category,
						'orderby' => 'meta_value', 'meta_key' => 'class_starts', "order" => $order
					);
				}
				$posts_array = get_posts($args);
				
		?>
		<li>
			<?php
				if ($category == 'all') {
			?>
			<h3 class="cat-name"><?php echo $term->slug; ?></h3>
			<?php
					} else {
			?>
			<h3 class="cat-name"><?php echo $category; ?></h3>
			<?php
					}

					foreach($posts_array as $post) {
						$post_type = get_post_type_object( get_post_type($post) );
						$starts = get_post_meta( $post->ID, 'class_starts', true );
						$post_type = get_post_type_object( get_post_type($post) );
						$post_cats = get_the_terms( $post->ID, 'classes_categories');
			?>
			<div class="schedule-row">
				<figure>
					<?php
						if ( $options[jt_schedule_singlePage] == '1' ) {
					?>
					<a href="<?php echo get_permalink( $post->ID ); ?>"><img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt=""></a>
					<?php
						}
						else {
					?>
					<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt="">
					<?php
						}
					?>
				</figure>
				<div class="class-info">
					<?php
						if ( $options[jt_schedule_singlePage] == '1' ) {
					?>
					<p class="class-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></p>
					<?php
						}
						else {
					?>
					<p class="class-title"><?php echo $post->post_title; ?></p>
					<?php
						}

						$trainer = esc_html( get_post_meta( $post->ID, 'class_trainer', true ) );
						$room = esc_html( get_post_meta( $post->ID, 'class_room', true ) );
						$starts = esc_html( get_post_meta( $post->ID, 'class_starts', true ) );
						$duration = esc_html( get_post_meta( $post->ID, 'class_duration', true ) );

						if (!empty ($trainer)) {
					?>
					<p class="class-trainer"><?php echo $trainer; ?></p>
					<?php
						}
						if (!empty ($room)) {
					?>
					<p class="class-room"><?php echo $room; ?></p>
					<?php
						}
						if ((!empty ($starts)) || (!empty ($duration))) {
					?>
					<p class="class-hours">
						<?php
							if (!empty ($starts)) {
						?>
						<span class="start-hour"><i class="fa fa-clock-o"></i> <?php echo $starts; ?></span>
						<?php
							}
							if (!empty ($duration)) {
						?>
						<span class="duration"><i class="fa fa-hourglass-end"></i> <?php echo $duration; ?></span>
						<?php
							}
						?>
					</p>
					<?php
						}
					?>
				</div>
			</div>
			<?php
				}
			?>
		</li>
		<?php
			}
		?>
	</ul>
    <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
    <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
</div>