<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php
				$option = get_option('jt_projects_general');
				$translations = get_option('jt_project_translations');
				include ( dirname( __FILE__ ) . '/settings/variables.php');

				while ( have_posts() ) : the_post();
					$post_id = get_the_ID();

					if ($option[project_page_style] == 'style-1') {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-1.php');
					}
					else if ($option[project_page_style] == 'style-2') {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-2.php');
					}
					else {
						include ( plugin_dir_path( __FILE__ ) . '/styles/page/style-1.php');
					}

				endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->
		
<?php
get_footer();
