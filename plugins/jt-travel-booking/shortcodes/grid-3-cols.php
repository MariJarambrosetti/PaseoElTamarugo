<?php
	$translate = get_option( 'jt_travel_booking_translations' );
	include ( dirname( __FILE__ ) . '/../options/variables.php');
	include ( dirname( __FILE__ ) . '/../options/strings.php');

echo '<h3 class="destinations-title">' . $jt['title'] . '</h3>';
echo '<div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 destinations-3-cols uk-grid-match" data-uk-grid>';

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
			
	echo '<div>
		<figure class="uk-overlay uk-overlay-hover">
			<img class="uk-overlay-scale" src="' . wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ) . '" alt="">
			<figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-ignore">
				<a class="destination-link" href="' . get_permalink( $post->ID ) . '"></a>
				<div>			
					<div class="destination-short-info">
						<h3 class="destination-title">' . $post->post_title . '</h3>
					</div>
					<div class="destination-bottom-info">';
							$destination_price = get_post_meta( $post->ID, 'destination_price', true );
							if (! empty ( $destination_price )) {
						echo '<div class="destination-price">
							<span>' . __($travel_starts_from_text, 'jt-travel-booking') . '</span>' . esc_html( $destination_price ) . '
						</div>';
						}
							$destination_days = get_post_meta( $post->ID, 'destination_days', true );
							if (! empty ( $destination_days )) {
						echo '<div class="destination-days">
							<span>' . __($travel_days_text, 'jt-travel-booking') . '</span>' . esc_html( $destination_days ) . '
						</div>';
						}
					echo '</div>
				</div>
			</figcaption>
		</figure>
	</div>';
		} 
echo '</div>';
?>