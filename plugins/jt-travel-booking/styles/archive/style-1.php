<div class="destinations-category">
	<div class="container">
		<div class="uk-grid">
			<div class="uk-width-7-10">
				<?php the_archive_title( '<h1 class="destination-category-title">', '</h1>' ); ?>
				<?php
					$translate = get_option( 'jt_travel_booking_translations' );
					include ( dirname( __FILE__ ) . '/../../options/variables.php');
					include ( dirname( __FILE__ ) . '/../../options/strings.php');

					if(have_posts()) : while(have_posts()) : the_post();
						$post_id = get_the_ID();
				?>
					<div class="destination-row uk-grid">
						<div class="uk-width-3-10 destination-image-col">
							<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php echo get_permalink( $post_id ); ?>"><?php the_post_thumbnail(); ?></a>
							<?php endif; ?>
						</div>
						<div class="uk-width-7-10 destination-info-col">
							<h3 class="destination-title">
								<a href="<?php echo get_permalink( $post_id ); ?>">
								<?php
									the_title();
								?>
								</a>
							</h3>
							<?php
								$destination_short_info = apply_filters( 'the_content', get_post_meta ( $post_id, 'destination_short_info', true ) );
								if (!empty ($destination_short_info)) {
							?>
							<div class="destination-short-info"><?php echo $destination_short_info; ?></div>
							<?php
								}
							?>
							<?php
								$destination_days = esc_attr( get_post_meta( $post_id, 'destination_days', true ) );
								$destination_price = esc_attr( get_post_meta( $post_id, 'destination_price', true ) );
								$destination_periods = esc_attr ( get_post_meta( $post_id, 'destination_periods', true ) );

								if ( (!empty ($destination_days)) || (!empty ($destination_price)) || (!empty ($destination_periods)) ) {
							?>
							<div class="destination-basic-info">
								<?php
									if (!empty ($destination_days)) {
								?>
								<p class="destination-days"><?php echo __($destination_days . ' ' . $travel_days_text, 'jt-travel-booking'); ?></p>
								<?php
									}
									if (!empty ($destination_price)) {
								?>
								<p class="destination-price"><?php echo __($travel_starts_from_text . ' ' . $destination_price, 'jt-travel-booking'); ?></p>
								<?php
									}
									if (!empty ($destination_periods)) {
								?>
								<p class="destination-periods"><?php echo $destination_periods; ?></p>
								<?php
									}
								?>
							</div>
							<?php
								}
							?>
						</div>
					</div>
				<?php
						endwhile; 
					endif;
				?>
				<div class="pagination-numbers">
					<?php
						echo paginate_links();
					?>
				</div>
			</div>
			<div class="uk-width-3-10">
				<?php
					get_sidebar();
				?>
			</div>
		</div>
	</div>
</div>