<?php

	if ($jtschedule['cat'] == '') {
		$terms = get_terms( 'classes_categories', array(
			'orderby'    => 'id',
			'hide_empty' => 1
		) );
	}
	else {
		$terms = array($jtschedule['cat']);
	}

?>

<div class="schedule-default-2">
	<?php

		foreach( $terms as $term ) {
 
			if ($jtschedule['cat'] == '') {
				// Define the query
				$args = array(
					'posts_per_page' => -1,
					'post_type' => 'schedule',
					'classes_categories' => $term->slug,
					"order" => $jtschedule['order']
				);
			}
			else {
				$args = array(
					'posts_per_page' => -1,
					'post_type' => 'schedule',
					'classes_categories' => $jtschedule['cat'],
					"order" => $jtschedule['order']
				);
			}
			$posts_array = get_posts($args);



		// Show these posts in a grid
?>
	<div class="uk-grid" data-uk-scrollspy="{cls:'uk-animation-slide-left', delay: 500}">
		<div class="uk-width-1-10">
			<?php
				if ($jtschedule['cat'] == '') {
			?>
			<p class="cat-name"><?php echo $term->slug; ?></p>
			<?php
				} else {
			?>
			<p class="cat-name"><?php echo $jtschedule['cat']; ?></p>
			<?php
				}
			?>
		</div>
		<div class="uk-width-9-10">
			<div class="uk-grid">
		<?php
			
			foreach($posts_array as $post) {
				$post_type = get_post_type_object( get_post_type($post) );
				$starts = get_post_meta( $post->ID, 'class_starts', true );
				$post_type = get_post_type_object( get_post_type($post) );
				$post_cats = get_the_terms( $post->ID, 'classes_categories');
			
	?>
	<div class="uk-width-1-5">
		<figure class="uk-overlay uk-overlay-hover">
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
				<figcaption class="uk-overlay-panel uk-overlay-bottom uk-overlay-background uk-ignore">
					<div>
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
						?>
						<p class="class-info">
							<span class="class-trainer">
								<?php echo esc_html( get_post_meta( $post->ID, 'class_trainer', true ) ); ?>
							</span>
							<span class="class-room">
								<?php echo esc_html( get_post_meta( $post->ID, 'class_room', true ) ); ?>
							</span>
						</p>
						<p class="class-hours">
							<span class="start-hour"><i class="fa fa-clock-o"></i> <?php echo esc_html( get_post_meta( $post->ID, 'class_starts', true ) ); ?></span>
							<span class="duration"><i class="fa fa-hourglass-end"></i> <?php echo esc_html( get_post_meta( $post->ID, 'class_duration', true ) ); ?></span>
						</p>
					</div>
				</figcaption>
		</figure>
	</div>
	<?php
			}
	?>
			</div>
		</div>
	</div>
	<?php
		}
	?>
</div>