<?php
/*
Plugin Name: JT Users List
Plugin URI: http://www.jsquare-themes.com
Description: Show WordPress posts in a widget with JSquare Users List Widget
Text Domain: jt-users-list
Version: 1.2.0
Author: JSquare Themes
Author URI: http://www.jsquare-themes.com
License: GPLv2 or later
*/

defined('ABSPATH') or die;

// Creating the widget 
class jsquare_users_list extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jsquare_users_list', 

		// Widget name will appear in UI
		__('JT Users List Widget', 'jt-users-list'), 

		// Widget description
		array( 'description' => __( 'Show WordPress posts in a widget with JT Users List Widget', 'jt-users-list' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		$numusers = $instance['numusers'];
		
		for ($i = 1; $i <= 20; $i++) {
			${'img'.$i} = $instance[ 'img' . $i ];
			${'name'.$i} = $instance[ 'name' . $i ];
			${'job'.$i} = $instance[ 'job' . $i ];
			${'fb'.$i} = $instance[ 'fb' . $i ];
			${'twitter'.$i} = $instance[ 'twitter' . $i ];
			${'linkedin'.$i} = $instance[ 'linkedin' . $i ];
		}
		
		// before and after widget arguments are defined by themes
		echo $widget_args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $widget_args['before_title'];
		
			echo $title;
		
			echo $widget_args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'bottom-overlay') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-bottom-overlay.php');
		}
		else if ($style == 'bottom-overlay-hover') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-bottom-overlay-hover.php');
		}
		else if ($style == 'full-overlay') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-full-overlay.php');
		}
		else if ($style == 'full-overlay-hover') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset-full-overlay-hover.php');
		}
		else if ($style == 'small-slideset') {
			include( plugin_dir_path( __FILE__ ) . 'styles/small-slideset.php');
		}
		else if ($style == 'grid') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid.php');
		}
		else if ($style == 'grid-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-2.php');
		}
		else if ($style == 'grid-2-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-2-cols.php');
		}
		else if ($style == 'overlay-name') {
			include( plugin_dir_path( __FILE__ ) . 'styles/overlay-name.php');
		}
		else if ($style == 'overlay-content') {
			include( plugin_dir_path( __FILE__ ) . 'styles/overlay-content.php');
		}
		else if ($style == 'modal') {
			include( plugin_dir_path( __FILE__ ) . 'styles/modal.php');
		}
		else if ($style == 'modal-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/modal-rounded.php');
		}
		else if ($style == 'left-right') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-left-right.php');
		}
		else if ($style == 'rounded-overlay-content') {
			include( plugin_dir_path( __FILE__ ) . 'styles/rounded-overlay-content.php');
		}
		else if ($style == 'flip-overlay-content') {
			include( plugin_dir_path( __FILE__ ) . 'styles/flip-overlay-content.php');
		}
		
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		$numusers =  isset( $instance['numusers'] ) ? $instance[ 'numusers' ] : ' ';
		
		for ($i = 1; $i <= 8; $i++) {
			${'img'.$i} = isset( $instance['img' . $i] ) ? esc_attr( $instance[ 'img' . $i ] ) : ' ';
			${'name'.$i} = isset( $instance['name' . $i] ) ? esc_attr( $instance[ 'name' . $i ] ) : ' ';
			${'job'.$i} = isset( $instance['job' . $i] ) ? esc_attr( $instance[ 'job' . $i ] ) : ' ';
			${'fb'.$i} = isset( $instance['fb' . $i] ) ? esc_attr( $instance[ 'fb' . $i ] ) : ' ';
			${'twitter'.$i} = isset( $instance['twitter' . $i] ) ? esc_attr( $instance[ 'twitter' . $i ] ) : ' ';
			${'linkedin'.$i} = isset( $instance['linkedin' . $i] ) ? esc_attr( $instance[ 'linkedin' . $i ] ) : ' ';
		}
		
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			
			<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			<h3 class="uk-accordion-title"><i class="fa fa-picture-o"></i></h3>
			<h3 class="uk-accordion-title"><i class="fa fa-user"></i></h3>
			<h3 class="uk-accordion-title"><i class="fa fa-briefcase"></i></h3>
			<h3 class="uk-accordion-title"><i class="fa fa-share-alt"></i></h3>
			
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-users-list' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-users-list' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="full-overlay" <?php echo ($style == 'full-overlay')?'selected':''; ?>>Slideset - Full overlay</option>
						<option value="full-overlay-hover" <?php echo ($style == 'full-overlay-hover')?'selected':''; ?>>Slideset - Full overlay with hover</option>
						<option value="bottom-overlay" <?php echo ($style == 'bottom-overlay')?'selected':''; ?>>Slideset - Bottom overlay</option>
						<option value="bottom-overlay-hover" <?php echo ($style == 'bottom-overlay-hover')?'selected':''; ?>>Slideset - Bottom overlay with hover</option>
						<option value="small-slideset" <?php echo ($style == 'small-slideset')?'selected':''; ?>>Small Slideset</option>
						<option value="grid" <?php echo ($style == 'grid')?'selected':''; ?>>Grid</option>
						<option value="grid-2" <?php echo ($style == 'grid-2')?'selected':''; ?>>Grid 2</option>
						<option value="grid-2-cols" <?php echo ($style == 'grid-2-cols')?'selected':''; ?>>Grid - 2 columns</option>
						<option value="left-right" <?php echo ($style == 'left-right')?'selected':''; ?>>Grid - Left-Right</option>
						<option value="modal" <?php echo ($style == 'modal')?'selected':''; ?>>Grid - Modal</option>
						<option value="modal-rounded" <?php echo ($style == 'modal-rounded')?'selected':''; ?>>Grid - Modal & rounded image</option>
						<option value="overlay-name" <?php echo ($style == 'overlay-name')?'selected':''; ?>>Grid - Overlay Name</option>
						<option value="overlay-content" <?php echo ($style == 'overlay-content')?'selected':''; ?>>Grid - Overlay Content</option>
						<option value="rounded-overlay-content" <?php echo ($style == 'rounded-overlay-content')?'selected':''; ?>>Grid - Overlay Content Rounded</option>
						<option value="flip-overlay-content" <?php echo ($style == 'flip-overlay-content')?'selected':''; ?>>Grid - Flip Overlay Content</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'numusers' ); ?>"><?php _e( 'Number of users:', 'jt-users-list' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'numusers' ); ?>" name="<?php echo $this->get_field_name( 'numusers' ); ?>">
						<option value="1" <?php echo ($numusers == '1')?'selected':''; ?>>1 user</option>
						<option value="2" <?php echo ($numusers == '2')?'selected':''; ?>>2 users</option>
						<option value="3" <?php echo ($numusers == '3')?'selected':''; ?>>3 users</option>
						<option value="4" <?php echo ($numusers == '4')?'selected':''; ?>>4 users</option>
						<option value="5" <?php echo ($numusers == '5')?'selected':''; ?>>5 users</option>
						<option value="6" <?php echo ($numusers == '6')?'selected':''; ?>>6 users</option>
						<option value="7" <?php echo ($numusers == '7')?'selected':''; ?>>7 users</option>
						<option value="8" <?php echo ($numusers == '8')?'selected':''; ?>>8 users</option>
						<option value="9" <?php echo ($numusers == '9')?'selected':''; ?>>9 users</option>
						<option value="10" <?php echo ($numusers == '10')?'selected':''; ?>>10 users</option>
						<option value="11" <?php echo ($numusers == '11')?'selected':''; ?>>11 users</option>
						<option value="12" <?php echo ($numusers == '12')?'selected':''; ?>>12 users</option>
						<option value="13" <?php echo ($numusers == '13')?'selected':''; ?>>13 users</option>
						<option value="14" <?php echo ($numusers == '14')?'selected':''; ?>>14 users</option>
						<option value="15" <?php echo ($numusers == '15')?'selected':''; ?>>15 users</option>
						<option value="16" <?php echo ($numusers == '16')?'selected':''; ?>>16 users</option>
						<option value="17" <?php echo ($numusers == '17')?'selected':''; ?>>17 users</option>
						<option value="18" <?php echo ($numusers == '18')?'selected':''; ?>>18 users</option>
						<option value="19" <?php echo ($numusers == '19')?'selected':''; ?>>19 users</option>
						<option value="20" <?php echo ($numusers == '20')?'selected':''; ?>>20 users</option>
					</select>
				</p>
			</div>
			
			<div class="uk-accordion-content">
				<h4>User's Image URLs</h4>
				<?php 
					for ($i = 1; $i <= 20; $i++) { 
				?>
					<p>
						<label for="<?php echo $this->get_field_id( 'img' . $i ); ?>"><?php _e( 'User ' . $i ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'img' . $i ); ?>" name="<?php echo $this->get_field_name(  'img' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'img'.$i} ); ?>" />
					</p>
				<?php
					}
				?>
			</div>
			
			<div class="uk-accordion-content">
				<h4>User's Name</h4>
				<?php 
					for ($i = 1; $i <= 20; $i++) { 
				?>
					<p>
						<label for="<?php echo $this->get_field_id( 'name' . $i ); ?>"><?php _e( 'User ' . $i ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'name' . $i ); ?>" name="<?php echo $this->get_field_name( 'name' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'name'.$i} ); ?>" />
					</p>
				<?php
					}
				?>
			</div>
			
			
			<div class="uk-accordion-content">
				<h4>User's Job</h4>
				<?php 
					for ($i = 1; $i <= 20; $i++) { 
				?>
					<p>
						<label for="<?php echo $this->get_field_id( 'job' . $i ); ?>"><?php _e( 'User ' . $i ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'job' . $i ); ?>" name="<?php echo $this->get_field_name( 'job' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'job'.$i} ); ?>" />
					</p>
				<?php
					}
				?>
			</div>
			
			
			<div class="uk-accordion-content">
				<h4>User's Social Profiles</h4>
				<?php 
					for ($i = 1; $i <= 20; $i++) { 
				?>
					<h5>User <?php echo $i; ?></h5>
					<p>
						<label for="<?php echo $this->get_field_id( 'fb' . $i ); ?>"><?php _e( 'Facebook Profile URL:' ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'fb' . $i ); ?>" name="<?php echo $this->get_field_name( 'fb' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'fb'.$i} ); ?>" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'twitter' . $i ); ?>"><?php _e( 'Twitter Profile URL:' ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' . $i ); ?>" name="<?php echo $this->get_field_name( 'twitter' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'twitter'.$i} ); ?>" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id( 'linkedin' . $i ); ?>"><?php _e( 'LinkedIn Profile URL:' ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' . $i ); ?>" name="<?php echo $this->get_field_name( 'linkedin' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'linkedin'.$i} ); ?>" />
					</p>
				<?php
					}
				?>
			</div>
			
		</div>
	</div>
	<?php 
	}
	
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
    
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = $new_instance['style'];
		$instance['numusers'] = $new_instance['numusers'];
		
		for ($i = 1; $i <= 20; $i++) {
			$instance['img' . $i] = strip_tags( $new_instance['img' . $i] );
			$instance['name' . $i] = strip_tags( $new_instance['name' . $i] );
			$instance['job' . $i] = strip_tags( $new_instance['job' . $i] );
			$instance['fb' . $i] = strip_tags( $new_instance['fb' . $i] );
			$instance['twitter' . $i] = strip_tags( $new_instance['twitter' . $i] );
			$instance['linkedin' . $i] = strip_tags( $new_instance['linkedin' . $i] );
		}
		
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function jsquare_users_list_widget() {
	register_widget( 'jsquare_users_list' );
}
add_action( 'widgets_init', 'jsquare_users_list_widget' );

function jsquare_users_list_styles() {
	
	wp_register_style('jt_users_list_font_awesome', plugin_dir_url(__FILE__).'css/font-awesome.min.css');
	wp_enqueue_style('jt_users_list_font_awesome');
    wp_register_style( 'jt_users_list_widget', plugin_dir_url(__FILE__).'css/jsquare-widget.css' );
    wp_enqueue_style( 'jt_users_list_widget' );
    wp_register_style( 'jt_users_list_accordion', plugin_dir_url(__FILE__).'css/accordion.min.css' );
    wp_enqueue_style( 'jt_users_list_accordion' );
    wp_register_script( 'jt_users_list_accordion', plugin_dir_url(__FILE__).'js/accordion.min.js' );
    wp_enqueue_script( 'jt_users_list_accordion' );
	wp_register_script('jsquare_users_list_uikit', plugin_dir_url(__FILE__).'/js/uikit.min.js');
	wp_enqueue_script('jsquare_users_list_uikit');
    wp_register_script( 'jt_users_list_modal', plugin_dir_url(__FILE__).'js/modal.min.js' );
    wp_enqueue_script( 'jt_users_list_modal' );
	wp_register_style('jsquare_users_list', plugin_dir_url(__FILE__).'/css/style.css');
	wp_enqueue_style('jsquare_users_list');
	wp_style_add_data( 'jsquare_users_list', 'rtl', 'replace' );
	wp_register_style( 'jt_users_list_uikit', plugin_dir_url(__FILE__).'css/uikit.css' );
	wp_enqueue_style( 'jt_users_list_uikit' );
	wp_register_script('jsquare_users_list_slideset', plugin_dir_url(__FILE__).'/js/slideset.min.js');
	wp_enqueue_script('jsquare_users_list_slideset');
	wp_register_style('jsquare_users_list_slidenav', plugin_dir_url(__FILE__).'/css/slidenav.min.css');
	wp_enqueue_style('jsquare_users_list_slidenav');
}
add_action( 'widgets_init','jsquare_users_list_styles');


?>
