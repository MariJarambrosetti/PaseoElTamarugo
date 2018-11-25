<div class="uk-slidenav-position destinations-slideset-4-cols" data-uk-slideset="{small: 1, medium: 2, large: 4}">
	<ul class="uk-grid uk-slideset">
	<?php
		$translate = get_option( 'jt_travel_booking_translations' );
		include ( dirname( __FILE__ ) . '/../options/variables.php');
		include ( dirname( __FILE__ ) . '/../options/strings.php');

		if ($cat == 'all') {
			$args = array("posts_per_page" => $num_destinations, "post_type" => array('destinations_list'));
		}
		else {
			$args = array("posts_per_page" => $num_destinations, "post_type" => array('destinations_list'), 'tax_query' => array(array('taxonomy' => 'destinations_categories', 'field' => 'slug', 'terms' => $cat)));
		}

		$posts_array = get_posts($args);

		// Show these posts in a grid
		foreach($posts_array as $post) {
			$post_type = get_post_type_object( get_post_type($post) );
				
	?>
	<li>
		<figure class="uk-overlay uk-overlay-hover">
			<a href="<?php echo get_permalink( $post->ID ); ?>">
				<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt="">
			</a>
			<figcaption class="uk-overlay-panel uk-overlay-center uk-ignore uk-overlay-background">
		<div class="destination-short-info">
		<h3 class="destination-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></h3>
		<?php 
			$destination_short_info = esc_html( get_post_meta( $post->ID, 'destination_short_info', true ) );
			if (! empty ( $destination_short_info )) { ?>
			<span class="short-info"><?php echo substr($destination_short_info, 0, intval($chars_num)); ?></span>
		<?php } ?>
		</div>
		<div class="uk-grid">
			<?php 
				$destination_price = get_post_meta( $post->ID, 'destination_price', true );
				if (! empty ( $destination_price )) { ?>
			<div class="uk-width-1-1 destination-price">
				<span class="price-box">
				<?php echo esc_html( $destination_price ); ?>
				</span>
			</div>
			<?php } ?>
			<?php 
				$destination_days = get_post_meta( $post->ID, 'destination_days', true );
				if (! empty ( $destination_days )) { ?>
			<div class="uk-width-1-1 destination-days">
				<?php echo __($travel_days_text, 'jt-travel-booking'); ?>
				<?php echo esc_html( $destination_days ); ?>
			</div>
			<?php } ?>
		</div>
			</figcaption>
		</figure>
	</li>
	<?php
		} 
	?>
	</ul>
	<a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideset-item="previous"></a>
	<a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideset-item="next"></a>
</div>