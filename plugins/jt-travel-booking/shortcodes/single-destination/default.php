<?php
	$translate = get_option( 'jt_travel_booking_translations' );
	include ( dirname( __FILE__ ) . '/../../options/variables.php');
	include ( dirname( __FILE__ ) . '/../../options/strings.php');

	$args = array("posts_per_page" => 1, "post_type" => array('destinations_list'), 'name' => $destination_item['slug']);

	$posts_array = get_posts($args);

	// Show these posts in a grid
	foreach($posts_array as $post) {
		$post_type = get_post_type_object( get_post_type($post) );		
?>
<div class="single-destination-default">
	<div class="uk-grid">
		<div class="uk-width-2-5">
			<figure class="uk-overlay uk-overlay-hover">
				<a class="destination-link" href="<?php echo get_permalink( $post->ID ); ?>">
					<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt="">
				</a>
			</figure>
		</div>
		<div class="uk-width-3-5">
			<h3 class="destination-title">
				<a class="destination-link" href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
			</h3>
			<?php
				$destination_short_info = get_post_meta( $post->ID, 'destination_short_info', true );
				if (! empty ( $destination_short_info )) {
			?>
			<div class="destination-short-info">
				<?php
					echo esc_html( $destination_short_info );
				?>
			</div>
			<?php
				} 
			?>
			<div class="destination-info">
				<?php 
					$destination_price = get_post_meta( $post->ID, 'destination_price', true );
					if (! empty ( $destination_price )) { 
				?>
				<div class="destination-price">
					<span><?php echo __($travel_starts_from_text, 'jt-travel-booking'); ?></span>
					<?php echo esc_html( $destination_price ); ?>
				</div>
				<?php
					}
					$destination_days = get_post_meta( $post->ID, 'destination_days', true );
					if (! empty ($destination_days)) { 
				?>
				<div class="destination-days">
					<?php echo esc_html( $destination_days ); ?>
					<span><?php echo __($travel_days_text, 'jt-travel-booking'); ?></span>
				</div>
				<?php 
					} 
				?>
			</div>
		</div>
	</div>
</div>
<?php
	} 
?>