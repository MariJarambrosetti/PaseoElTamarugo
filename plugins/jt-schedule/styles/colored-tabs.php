<div class="schedule-tabs-colored">
	<ul data-uk-switcher="{connect:'#tabs-schedule-colored', animation: 'fade'}">
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
				
				if ($category == 'all') {
			?>
			<li><a href=""><?php echo $term->slug; ?></a></li>
			<?php
				} else {
			?>
			<li><a href=""><?php echo $category; ?></a></li>
			<?php
				}
			}
		?>
	</ul>
	
	<ul id="tabs-schedule-colored" class="uk-switcher">
		<?php

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
				foreach($posts_array as $post) {
					$post_type = get_post_type_object( get_post_type($post) );
					$starts = get_post_meta( $post->ID, 'class_starts', true );
					$post_type = get_post_type_object( get_post_type($post) );
					$post_cats = get_the_terms( $post->ID, 'classes_categories');
					
					$color =  esc_html( get_post_meta( $post->ID, 'class_color', true ) );
			?>
			<div class="schedule-row">
				<div class="class-hour">
					<?php
						$starts = esc_html( get_post_meta( $post->ID, 'class_starts', true ) );
						if (!empty ($starts)) {
					?>
					<p class="start-hour" style="background: <?php echo $color; ?>"><i class="fa fa-clock-o"></i> <?php echo $starts; ?></p>
					<?php
						}
					?>
				</div>
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
						if (!empty ($duration)) {
					?>
					<p class="duration"><i class="fa fa-hourglass-end" style="color: <?php echo $color; ?>"></i> <?php echo $duration; ?></p>
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
</div>