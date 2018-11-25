<?php
	get_header();
?>

<div class="search-destinations-content">
	<div class="container">
		<?php
			$translate = get_option( 'jt_travel_booking_translations' );
			include ( dirname( __FILE__ ) . '/options/variables.php');
			include ( dirname( __FILE__ ) . '/options/strings.php');

			$destination_price = $_GET['destination_price'];
			$destination_days = $_GET['destination_days'];
		?>
		<h3 class="title"><?php echo __($search_results_for_text, 'jt-travel-booking'); ?> : <?php echo $s; ?> </h3>
		<div class="uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 destinations-default uk-grid-match" data-uk-grid>
		<?php

			list($dest_price_min, $dest_price_max) = explode(" - ", $destination_price, 2);
			list($price_sign1, $price_min) = explode ("$", $dest_price_min, 2);
			list($price_sign2, $price_max) = explode ("$", $dest_price_max, 2);

			if ( have_posts() ) : while ( have_posts() ) : the_post(); 
				$post_id = get_the_ID();
				$days = get_post_meta($post_id, 'destination_days', true);
				$price = get_post_meta($post_id, 'destination_price', true);
				list($price_new_sign2, $price_new) = explode ("$", $price, 2);

				if (($destination_days == $days) && ($price_new <= $price_max) && ($price_min <= $price_new)) {
			?>
			<div>
				<figure class="uk-overlay uk-overlay-hover">
					<a href="<?php echo get_permalink( $post->ID ); ?>">
						<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt="">
					</a>
				</figure>

				<div class="destination-short-info">
					<h3 class="destination-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></h3>
					<?php 
						$destination_short_info = get_post_meta( $post->ID, 'destination_short_info', true );
						if (! empty ( $destination_short_info )) { 
					?>
					<?php echo esc_html( $destination_short_info ); ?>
					<?php } ?>
				</div>

				<div class="uk-grid">
					<?php 
						if (! empty ( $price )) { 
					?>
					<div class="uk-width-2-6 destination-price">
						<span><?php echo __($travel_starts_from_text, 'jt-travel-booking'); ?></span>
						<?php echo esc_html( $price ); ?>
					</div>
					<?php } ?>

					<?php 
						if (! empty ( $days )) { 
					?>
					<div class="uk-width-1-6 destination-days">
						<span><?php echo __($travel_days_text, 'jt-travel-booking'); ?></span>
						<?php echo esc_html( $days ); ?>
					</div>
					<?php } ?>

					<div class="uk-width-3-6 destination-more-info">
						<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo __($travel_more_info, 'jt-travel-booking'); ?></a>
					</div>
				</div>
			</div>
			<?php
				}
				else if (($destination_days != $days) && ($price_new <= $price_max) && ($price_min <= $price_new)) {
			?>
			<div>
				<figure class="uk-overlay uk-overlay-hover">
					<a href="<?php echo get_permalink( $post->ID ); ?>">
						<img class="uk-overlay-scale" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>" alt="">
					</a>
				</figure>

				<div class="destination-short-info">
					<h3 class="destination-title"><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></h3>
					<?php 
						$destination_short_info = get_post_meta( $post->ID, 'destination_short_info', true );
						if (! empty ( $destination_short_info )) { 
					?>
					<?php echo esc_html( $destination_short_info ); ?>
					<?php } ?>
				</div>

				<div class="uk-grid">
					<?php 
						if (! empty ( $price )) { 
					?>
					<div class="uk-width-2-6 destination-price">
						<span><?php echo __($travel_starts_from_text, 'jt-travel-booking'); ?></span>
						<?php echo esc_html( $price ); ?>
					</div>
					<?php } ?>

					<?php 
						if (! empty ( $days )) { 
					?>
					<div class="uk-width-1-6 destination-days">
						<span><?php echo __($travel_days_text, 'jt-travel-booking'); ?></span>
						<?php echo esc_html( $days ); ?>
					</div>
					<?php } ?>

					<div class="uk-width-3-6 destination-more-info">
						<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo __($travel_more_info, 'jt-travel-booking'); ?></a>
					</div>
				</div>
			</div>
			<?php
				}
				endwhile;
			endif;
		?>
		</div>
		<?php
			if (! (($destination_days == $days) && ($price_new <= $price_max) && ($price_min <= $price_new))) {
					echo __('<p class="no-destinations">' . $no_destinations_text . '</p>', 'jt-travel-booking');
			}
		?>
	</div>
</div>

<?php
	get_footer();
?>