<?php
	$translate = get_option( 'jt_travel_booking_translations' );
	include ( dirname( __FILE__ ) . '/../options/variables.php');
	include ( dirname( __FILE__ ) . '/../options/strings.php');

echo '<h3 class="destinations-title">' . $jt['title'] . '</h3>';
?>
<div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-2 destinations-grid-2-cols uk-grid-match" data-uk-grid>
	<?php
	
		if ($jt['cat'] == '') {
			$args = array("posts_per_page" => $jt['num'], "post_type" => array('destinations_list'), "orderby" => $jt['orderby'], "order" => $jt['order']);
		}
		else {
			$args = array("posts_per_page" => $jt['num'], "post_type" => array('destinations_list'), 'tax_query' => array(array('taxonomy' => 'destinations_categories', 'field' => 'slug', 'terms' => $jt['cat'])), "orderby" => $jt['orderby'], "order" => $jt['order']);
		}

		$posts_array = get_posts($args);

		// Show these posts in a grid
		foreach($posts_array as $post) {
			$post_type = get_post_type_object( get_post_type($post) );
				
	?>
	<div>
		<div class="uk-grid">
			<div class="uk-width-1-2">
				<figure class="uk-overlay uk-overlay-hover">
					<a href="<?php echo get_permalink( $post->ID ); ?>">
						<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt="">
					</a>
				</figure>
			</div>
			<div class="uk-width-1-2 destination-short-info">
				<h3 class="destination-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></h3>
				<?php 
					$destination_short_info = get_post_meta( $post->ID, 'destination_short_info', true );
					if (! empty ( $destination_short_info )) { ?>
					<?php echo esc_html( $destination_short_info ); ?>
				<?php } ?>
				<div class="uk-grid trip-info">
					<?php 
						$destination_price = get_post_meta( $post->ID, 'destination_price', true );
						if (! empty ( $destination_price )) { ?>
					<div class="uk-width-1-2 destination-price">
						<span><?php echo __($travel_starts_from_text, 'jt-travel-booking'); ?></span>
						<?php echo esc_html( $destination_price ); ?>
					</div>
					<?php } ?>
					<?php 
						$destination_days = get_post_meta( $post->ID, 'destination_days', true );
						if (! empty ( $destination_days )) { ?>
					<div class="uk-width-1-2 destination-days">
						<span><?php echo __($travel_days_text, 'jt-travel-booking'); ?></span>
						<?php echo esc_html( $destination_days ); ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		} 
	?>
</div>