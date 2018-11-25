<?php
/*
Plugin Name: JT Music Charts
Plugin URI: http://www.jsquare-themes.com
Description: Create a list with top 20 songs with JT Music Charts Widget
Version: 1.0.1
Author: JSquare Themes
Author URI: http://www.jsquare-themes.com
License: GPLv2 or later
*/

defined('ABSPATH') or die;

// Creating the widget 
class jt_music_charts extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_music_charts', 

		// Widget name will appear in UI
		__('JT Music Charts Widget', 'jt_music_charts_domain'), 

		// Widget description
		array( 'description' => __( 'Create a list with top 20 songs with JT Music Charts Widget', 'jt_music_charts_domain' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		
        extract( $args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		
		for ($i = 1; $i <= 20; $i++) {
			${'title'.$i} = $instance[ 'title' . $i ];
			${'artist'.$i} = $instance[ 'artist' . $i ];
			${'url'.$i} = $instance[ 'url' . $i ];
		}
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'];
		
			echo $title;
		
			echo $args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'default') {
			include 'styles/default.php';
		}
		
		
		echo __('</div>', 'jt_music_charts_domain' );
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		
		for ($i = 1; $i <= 20; $i++) {
			${'title'.$i} = isset( $instance['title' . $i] ) ? esc_attr( $instance[ 'title' . $i ] ) : ' ';
			${'artist'.$i} = isset( $instance['artist' . $i] ) ? esc_attr( $instance[ 'artist' . $i ] ) : ' ';
			${'url'.$i} = isset( $instance['url' . $i] ) ? esc_attr( $instance[ 'url' . $i ] ) : ' ';
		}
		
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			
			<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			<h3 class="uk-accordion-title"><i class="fa fa-font"></i></h3>
			<h3 class="uk-accordion-title"><i class="fa fa-user"></i></h3>
			<h3 class="uk-accordion-title"><i class="fa fa-link"></i></h3>
			
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="default" <?php echo ($style == 'default')?'selected':''; ?>>Default</option>
					</select>
				</p>
			</div>
			
			<div class="uk-accordion-content">
				<h4>Song's Title</h4>
				<?php 
					for ($i = 1; $i <= 20; $i++) { 
				?>
					<p>
						<label for="<?php echo $this->get_field_id( 'title' . $i ); ?>"><?php _e( 'Song ' . $i ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'title' . $i ); ?>" name="<?php echo $this->get_field_name(  'title' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'title'.$i} ); ?>" />
					</p>
				<?php
					}
				?>
			</div>
			
			<div class="uk-accordion-content">
				<h4>Song's Artist</h4>
				<?php 
					for ($i = 1; $i <= 20; $i++) { 
				?>
					<p>
						<label for="<?php echo $this->get_field_id( 'artist' . $i ); ?>"><?php _e( 'Song ' . $i ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'artist' . $i ); ?>" name="<?php echo $this->get_field_name( 'artist' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'artist'.$i} ); ?>" />
					</p>
				<?php
					}
				?>
			</div>
			
			
			<div class="uk-accordion-content">
				<h4>Song's URL</h4>
				<?php 
					for ($i = 1; $i <= 20; $i++) { 
				?>
					<p>
						<label for="<?php echo $this->get_field_id( 'url' . $i ); ?>"><?php _e( 'Song ' . $i ); ?></label> 
						<input class="widefat" id="<?php echo $this->get_field_id( 'url' . $i ); ?>" name="<?php echo $this->get_field_name( 'url' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'url'.$i} ); ?>" />
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
		
		for ($i = 1; $i <= 20; $i++) {
			$instance['title' . $i] = strip_tags( $new_instance['title' . $i] );
			$instance['artist' . $i] = strip_tags( $new_instance['artist' . $i] );
			$instance['url' . $i] = strip_tags( $new_instance['url' . $i] );
		}
		
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function jt_music_charts_widget() {
	register_widget( 'jt_music_charts' );
}
add_action( 'widgets_init', 'jt_music_charts_widget' );

function jt_music_charts_styles() {
	wp_register_style('jt_music_charts_font_awesome', plugin_dir_url(__FILE__).'css/font-awesome.min.css');
	wp_enqueue_style('jt_music_charts_font_awesome');
	wp_register_style( 'jt_music_charts_widget', plugin_dir_url(__FILE__).'css/jsquare-widget.css' );
	wp_enqueue_style( 'jt_music_charts_widget' );
	wp_register_style( 'jt_music_charts_accordion', plugin_dir_url(__FILE__).'css/accordion.min.css' );
	wp_enqueue_style( 'jt_music_charts_accordion' );
	wp_register_style( 'jt_music_charts_uikit', plugin_dir_url(__FILE__).'css/uikit.css' );
	wp_enqueue_style( 'jt_music_charts_uikit' );
	wp_register_style('jt_music_charts_css', plugin_dir_url(__FILE__). 'css/style.css',__FILE__ );
	wp_enqueue_style('jt_music_charts_css');
	
	wp_register_script( 'jt_music_charts_uikit_js', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery') );
	wp_enqueue_script( 'jt_music_charts_uikit_js' );
	wp_register_script( 'jt_music_charts_accordion_js', plugin_dir_url(__FILE__).'js/accordion.min.js' );
	wp_enqueue_script( 'jt_music_charts_accordion_js' );
}
add_action( 'widgets_init','jt_music_charts_styles');


?>
