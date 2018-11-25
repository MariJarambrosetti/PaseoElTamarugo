<?php
	echo '<h3 class="project-title">' . $jtp['title'] . '</h3>';
?>
<?php
	$option = get_option('jt_projects_general');

	if ($jtp['filters'] == 'yes') {
?>
<ul id="filter-list">
    <li data-uk-filter=""><a href=""></a><?php _e('All'); ?></li>
	<?php
		$filters_array[] = NULL;

		$args = array("posts_per_page" => $jtp['num'], "post_type" => array('projects_list'));

		$posts_array = get_posts($args);
									
		foreach($posts_array as $post) {
			$post_type = get_post_type_object( get_post_type($post) );
			$project_filter = esc_attr(get_post_meta( $post->ID, 'project_filter', true ));
			
			if (! in_array($project_filter, $filters_array)) {
				array_push($filters_array, $project_filter);
			}
	?>
    	<li data-uk-filter="<?php echo $project_filter; ?>"><a href=""><?php echo $project_filter; ?></a></li>
	<?php
		}
	?>
</ul>
<?php
	}
?>

<div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-3 default uk-grid-match" data-uk-grid="{controls: '#filter-list'}">
	<?php

		if ($jtp['cat'] == '') {
			$args = array("posts_per_page" => $jtp['num'], "post_type" => array('projects_list'), "order" => $jtp['order'], "orderby" => $jtp['orderby']);
		}
		else {
			$args = array("posts_per_page" => $jtp['num'], "post_type" => array('projects_list'), "order" => $jtp['order'], "orderby" => $jtp['orderby'], 'tax_query' => array(array('taxonomy' => 'recipes_categories', 'field' => 'slug', 'terms' => $jtp['cat'])));
		}

		$posts_array = get_posts($args);

		// Show these posts in a grid
		foreach($posts_array as $post) {
			$post_type = get_post_type_object( get_post_type($post) );
			$post_cats = get_the_terms( $post->ID, 'project_categories');
			foreach ( $post_cats as $cat ) {
            	$cat_link = get_term_link( $cat, 'project_categories' );
			}		
			
			// Show project info
			$project_short_info = get_post_meta( $post->ID, 'project_short_info', true );
			$project_lbutton_text = get_post_meta( $post->ID, 'project_lbutton_text', true );
			$project_lbutton_url = get_post_meta( $post->ID, 'project_lbutton_url', true );
			$project_lbutton_icon = get_post_meta( $post->ID, 'project_lbutton_icon', true );
			$project_rbutton_text = get_post_meta( $post->ID, 'project_rbutton_text', true );
			$project_rbutton_url = get_post_meta( $post->ID, 'project_rbutton_url', true );
			$project_rbutton_icon = get_post_meta( $post->ID, 'project_rbutton_icon', true );	
	?>
	<div <?php if ($display_filters == 'yes') { ?>data-uk-filter="<?php echo $project_filter; ?>" <?php } ?>>
		<figure class="uk-overlay uk-overlay-hover">
			<?php $project_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail'  ); ?>
			<a href="<?php echo get_permalink( $post->ID); ?>"><img class="uk-overlay-scale" src="<?php echo $project_img; ?>" alt=""></a>
			<figcaption class="uk-overlay-panel uk-flex uk-flex-center uk-overlay-slide-bottom uk-overlay-background">
			<?php
				if ($option[project_page] == '1') {
			?>
				<a class="lbutton" href="<?php echo get_permalink( $post->ID); ?>">
					<?php
						if ( !empty ($project_lbutton_icon) ) {
					?>
					<i class="fa <?php echo esc_attr($project_lbutton_icon); ?>"></i>
					<?php
						}
					?>
					<?php echo esc_attr($project_lbutton_text); ?>
				</a>
			<?php
				}
				else {
					if ( (!empty ($project_lbutton_text)) || ( !empty ($project_lbutton_url)) || ( !empty ($project_lbutton_icon) ) ) {
				?>
					<a class="lbutton" href="<?php echo esc_attr($project_lbutton_url); ?>">
						<?php
							if ( !empty ($project_lbutton_icon) ) {
						?>
						<i class="fa <?php echo esc_attr($project_lbutton_icon); ?>"></i>
						<?php
							}
						?>
						<?php echo esc_attr($project_lbutton_text); ?>
					</a>
				<?php
					}
				}
				if ( (!empty ($project_rbutton_text)) || ( !empty ($project_rbutton_url)) || ( !empty ($project_rbutton_icon) ) ) {
			?>
				<a class="rbutton" href="<?php echo esc_attr($project_rbutton_url); ?>">
					<?php
						if ( !empty ($project_rbutton_icon) ) {
					?>
					<i class="fa <?php echo esc_attr($project_rbutton_icon); ?>"></i>
					<?php
						}
					?>
					<?php echo esc_attr($project_rbutton_text); ?>
				</a>
			<?php
				}
			?>
			</figcaption>
		</figure>
		<p class="project-title"><?php echo $post->post_title; ?>
		<?php
			if ( !empty ($project_short_info) ) {
		?>
			<span class="project-info"><?php echo esc_attr($project_short_info); ?></span>
		<?php
			}
		?>
		</p>
	</div>
	<?php
		} 
	?>
</div>