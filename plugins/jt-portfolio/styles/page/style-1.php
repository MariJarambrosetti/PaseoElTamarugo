<div class="jt-project-page">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?>
					<?php
						$option = get_option('jt_projects_general');
						$translations = get_option('jt_projects_translations');
						include ( dirname( __FILE__ ) . '/../../settings/variables.php');
						include ( dirname( __FILE__ ) . '/../../settings/strings.php');

						$img1 = get_post_meta( $post_id, 'project_img1', true );
						$img2 = get_post_meta( $post_id, 'project_img2', true );
						$img3 = get_post_meta( $post_id, 'project_img3', true );
						$img4 = get_post_meta( $post_id, 'project_img4', true );
						$img5 = get_post_meta( $post_id, 'project_img5', true );
						$img6 = get_post_meta( $post_id, 'project_img6', true );
	
						if ( (!empty ($img1)) || (!empty ($img2)) || (!empty ($img3)) || (!empty ($img4)) || (!empty ($img5)) || (!empty ($img6)) || (!empty ($img7)) || (!empty ($img8)) ) {
					?>
					<div class="project-gallery">
						<?php
							if (!empty ($img1)) {
						?>
						<a href="<?php echo $img1; ?>" data-uk-lightbox="{group:'project-images'}"><img src="<?php echo $img1; ?>"></a>
						<?php
							}
							if (!empty ($img2)) {
						?>
						<a href="<?php echo $img2; ?>" data-uk-lightbox="{group:'project-images'}"><img src="<?php echo $img2; ?>"></a>
						<?php
							}
							if (!empty ($img3)) {
						?>
						<a href="<?php echo $img3; ?>" data-uk-lightbox="{group:'project-images'}"><img src="<?php echo $img3; ?>"></a>
						<?php
							}
							if (!empty ($img4)) {
						?>
						<a href="<?php echo $img4; ?>" data-uk-lightbox="{group:'project-images'}"><img src="<?php echo $img4; ?>"></a>
						<?php
							}
							if (!empty ($img5)) {
						?>
						<a href="<?php echo $img5; ?>" data-uk-lightbox="{group:'project-images'}"><img src="<?php echo $img5; ?>"></a>
						<?php
							}
							if (!empty ($img6)) {
						?>
						<a href="<?php echo $img6; ?>" data-uk-lightbox="{group:'project-images'}"><img src="<?php echo $img6; ?>"></a>
						<?php
							}
						?>
					</div>
					<?php
						}
						$client = get_post_meta( $post_id, 'project_client', true );
						$country = get_post_meta( $post_id, 'project_country', true );
						$date = get_post_meta( $post_id, 'project_date', true );
						$implementation_time = get_post_meta( $post_id, 'project_implementation_time', true );
						$budget = get_post_meta( $post_id, 'project_budget', true );
						$website = get_post_meta( $post_id, 'project_website', true );

						if ((!empty ($client)) || (!empty ($country)) || (!empty ($date)) || (!empty ($implementation_time)) || (!empty ($budget)) || (!empty ($website))) {
					?>
					<div class="project-basic-info">
						<?php
							if (!empty ($client)) {
						?>
						<p>
							<span><?php echo __($project_client, 'jt-portfolio'); ?>:</span> <?php echo $client; ?>
						</p>
						<?php
							}
							if (!empty ($country)) {
						?>
						<p>
							<span><?php echo __($project_country, 'jt-portfolio'); ?>:</span> <?php echo $country; ?>
						</p>
						<?php
							}
							if (!empty ($date)) {
								if ($option[project_date_format] == 'dFY') {
									$project_date = date_i18n("d F Y", strtotime($date));
								}
								else if ($option[project_date_format] == 'dF') {
									$project_date = date_i18n("d F", strtotime($date));
								}
								else if ($option[project_date_format] == 'Fd') {
									$project_date = date_i18n("F d", strtotime($date));
								}
								else if ($option[project_date_format] == 'dMY') {
									$project_date = date_i18n("d M Y", strtotime($date));
								}
								else if ($option[project_date_format] == 'dM') {
									$project_date = date_i18n("d M", strtotime($date));
								}
								else if ($option[project_date_format] == 'Md') {
									$project_date = date_i18n("M d", strtotime($date));
								}
								else if ($option[project_date_format] == 'dmY') {
									$project_date = date_i18n("d/m/Y", strtotime($date));
								}
								else if ($option[project_date_format] == 'mdY') {
									$project_date = date_i18n("m/d/Y", strtotime($date));
								}
								else if ($option[project_date_format] == 'Ymd') {
									$project_date = date_i18n("Y/m/d", strtotime($date));
								}
								else if ($option[project_date_format] == 'Ydm') {
									$project_date = date_i18n("Y/d/m", strtotime($date));
								}
						?>
						<p>
							<span><?php echo __($project_date_text, 'jt-portfolio'); ?>:</span> <?php echo $project_date; ?>
						</p>
						<?php
							}
							if (!empty ($implementation_time)) {
						?>
						<p>
							<span><?php echo __($project_implementation_time, 'jt-portfolio'); ?>:</span> <?php echo $implementation_time; ?>
						</p>
						<?php
							}
							if (!empty ($budget)) {
						?>
						<p>
							<span><?php echo __($project_budget, 'jt-portfolio'); ?>:</span> <?php echo $budget; ?>
						</p>
						<?php
							}
							if (!empty ($website)) {
						?>
						<p>
							<span><?php echo __($project_website, 'jt-portfolio'); ?>:</span> <a href="<?php echo $website; ?>"><?php echo $website; ?></a>
						</p>
						<?php
							}
						?>
					</div>
					<?php 
						}
					?>
				</div>
				
				<div class="col-md-8">
					<?php
						if ( is_single() ) :
							the_title( '<h1 class="project-title">', '</h1>' );
						else :
							the_title( '<h2 class="project-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;
					?>
					<?php
						$project_info = apply_filters( 'the_content', get_post_meta( $post_id, 'project_info', true ));
						if (!empty ($project_info)) {
					?>
					<div class="project-info">
						<?php echo $project_info; ?>
					</div>
						
					<?php
						}
							$project_video_url = get_post_meta( $post_id, 'project_video_url', true);
							$project_video_embed = get_post_meta( $post_id, 'project_video_embed', true);
							
							if (!empty ($project_video_url)) {
						?>
						<div class="project-video">
							<h3><?php echo __($project_video, 'jt-portfolio'); ?></h3>
							<video width="670" height="380" controls>
								<source src="<?php echo $project_video_url; ?>" type="video/mp4">
							</video>
						</div>
						<?php
							}
							else if (!empty ($project_video_embed)) {
						?>
						<div class="project-video">
							<h3><?php echo __($project_video, 'jt-portfolio'); ?></h3>
							<?php echo $project_video_embed; ?>
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
	</article>
</div>