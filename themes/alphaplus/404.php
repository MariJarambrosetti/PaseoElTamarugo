<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package A+
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<div class="container">

				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'alphaplus' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It seems that something went wrong. Please go back or visit homepage using the link below.', 'alphaplus' ); ?></p>					
						<p class="home-link"><a class="btn-homepage" href="<?php echo site_url(); ?>"><?php esc_html_e( 'Back to homepage', 'alphaplus'); ?></a></p>


					</div><!-- .page-content -->
				</section><!-- .error-404 -->
				
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();