<?php
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( is_plugin_active( 'option-tree/ot-loader.php' ) ) {
		$gym_footer_1_width = esc_attr(ot_get_option('gym-footer-1-width'));
		$gym_footer_2_width = esc_attr(ot_get_option('gym-footer-2-width'));
		$gym_footer_3_width = esc_attr(ot_get_option('gym-footer-3-width'));
		
		$copyright = esc_attr(ot_get_option('copyright'));
		$totop_button = ot_get_option('totop_button');
	}
	else {		
		$gym_footer_1_width = 'col-md-4';
		$gym_footer_2_width = 'col-md-4';
		$gym_footer_3_width = 'col-md-4';
				
		$copyright = 'Copyright 2018';
		$totop_button = 'on';
	}
?>
<div id="footer">
	<div class="container">
		<?php
			if ( (is_active_sidebar('footer-1')) || (is_active_sidebar('footer-2')) ) {
		?>
		<div class="row">
			<?php if (is_active_sidebar('footer-1')) { ?>
			<div class="<?php echo $gym_footer_1_width; ?>">
				<?php
					dynamic_sidebar('footer-1');
				?>
			</div>
			<?php } ?>
			<?php if (is_active_sidebar('footer-2')) { ?>
			<div class="<?php echo $gym_footer_2_width; ?>">
				<?php
					dynamic_sidebar('footer-2');
				?>
			</div>
			<?php } ?>
			<?php if (is_active_sidebar('footer-3')) { ?>
			<div class="<?php echo $gym_footer_3_width; ?>">
				<?php
					dynamic_sidebar('footer-3');
				?>
			</div>
			<?php } ?>
		</div>
		<?php
			}
		?>
		<div id="copyright">
			<?php
				echo '<p>' . $copyright . '</p>';
			?>
			<?php
				if ($totop_button == 'on') {
			?>
			<div id="totop-btn">
				<a href="#page" data-uk-smooth-scroll><i class="fa fa-chevron-up"></i></a>
			</div>
			<?php
				}
			?>
		</div>
	</div>
</div>