<?php

	// Get posts based on the widget's settings
	if ($source == "wp-posts") {
		if ($post_category == 'all') {
			$args = array("posts_per_page" => $posts_number, "orderby" => $orderby, "order" => $order);
		} else {
			$args = array("posts_per_page" => $posts_number, "category" => $post_category, "orderby" => $orderby, "order" => $order);
		}
	}
	else if ($source == "custom") {
		$args = array("posts_per_page" => $posts_number, "orderby" => $orderby, "order" => $order, "post_type" => array($include_post_types));
	}
			
?>

	<div class="uk-grid grid-large-image-2 uk-grid-match">
		<?php
			$posts_array = get_posts($args);

			// Show these posts in a grid
			foreach($posts_array as $post) {
				$post_type = get_post_type_object( get_post_type($post) );
				echo '<div class="uk-width-1-3">
						<figure class="grid-large-image-2 uk-overlay uk-overlay-hover">
							<a href="' . get_permalink( $post->ID ) . '">
								<img class="uk-overlay-scale" src="' . wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ) . '" alt="">
							</a>
							<figcaption class="uk-overlay-panel uk-overlay-bottom uk-overlay-background uk-ignore">
								<div>
									<p><a class="title" href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>';
									echo '<span class="meta-box">';
									if ($show_date == 'yes') {
										echo '<span class="date">' . mysql2date('j M Y', $post->post_date) . '</span>';
									}
									if ($show_comments == 'yes') {
										echo '<span class="comments"><i class="fa fa-comments-o"></i>' . get_comments_number($post->ID) . '</span>';
									}
								echo '</span></p>
								</div>
							</figcaption>
						</figure>';
						
						if ($show_category == 'yes') {
							if ( $source == "custom" ) {
								echo '<a class="category" href="' . get_post_type_archive_link( $include_post_types ) . '">' . $post_type->label . '</a>';
							}
							else if ($source == "wp-posts") {
								$category = get_the_category($post->ID);
								echo '<a class="category" href="' . get_category_link($category[0]) . '">' . $category[0]->cat_name . '</a>';
							}
						}
						echo '</div>';
			} 

		?>
	</div>