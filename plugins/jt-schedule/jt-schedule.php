<?php
/*
Plugin Name: JT Schedule
Plugin URI: http://www.jsquare-themes.com
Description: Create a modern and responsive schedule
Text Domain: jt-schedule
Version: 3.0.1
Author: JSquare Themes
Author URI: http://www.jsquare-themes.com
License: GPLv2 or later
*/

defined('ABSPATH') or die;

add_action( 'init', 'create_schedule_list' );
function create_schedule_list() {
    register_post_type( 'schedule',
        array(
            'labels' => array(
                'name' => __('Schedule', 'jt-schedule'),
                'singular_name' => __('Class', 'jt-schedule'),
                'add_new' => __('Add New', 'jt-schedule'),
                'add_new_item' => __('Add New Brand', 'jt-schedule'),
                'edit' => __('Edit', 'jt-schedule'),
                'edit_item' => __('Edit Class', 'jt-schedule'),
                'new_item' => __('New Class', 'jt-schedule'),
                'view' => __('View', 'jt-schedule'),
                'view_item' => __('View Class', 'jt-schedule'),
                'search_items' => __('Search Classes', 'jt-schedule'),
                'not_found' => __('No Classes found', 'jt-schedule'),
                'not_found_in_trash' => __('No Classes found in Trash', 'jt-schedule'),
                'parent' => __('Parent Class', 'jt-schedule')
            ),
 
            'public' => true,
            'menu_position' => 25,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-calendar',
            'has_archive' => true
        )
    );

}

add_action('init', 'register_classes_category', 0);

function register_classes_category() {
    register_taxonomy(
        'classes_categories',
        'schedule',
        array(
            'labels' => array(
                'name' => __('Class Category', 'jt-schedule'),
                'add_new_item' => __('Add New Class Category', 'jt-schedule'),
                'new_item_name' => __("New Class Category", 'jt-schedule')
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}

add_action( 'admin_init', 'classes_meta' );
function classes_meta() {
    add_meta_box( 'class_meta_box',
        'Class Details',
        'display_class_meta_box',
        'schedule', 'normal', 'high'
    );
}


include ( dirname( __FILE__ ) . '/options.php');

function display_class_meta_box( $class ) {
	
	$translate = get_option( 'jt_schedule_translations' );
	include ( dirname( __FILE__ ) . '/options/variables.php');
	include ( dirname( __FILE__ ) . '/options/strings.php');
	
    $class_short_info = esc_html( get_post_meta( $class->ID, 'class_short_info', true ) );
    $class_starts = esc_html( get_post_meta( $class->ID, 'class_starts', true ) );
    $class_duration = esc_html( get_post_meta( $class->ID, 'class_duration', true ) );
    $class_trainer = esc_html( get_post_meta( $class->ID, 'class_trainer', true ) );
    $class_room = esc_html( get_post_meta( $class->ID, 'class_room', true ) );
    $class_price = esc_html( get_post_meta( $class->ID, 'class_price', true ) );
    $class_color = esc_html( get_post_meta( $class->ID, 'class_color', true ) );
	
	$info = 'class_info';
    $class_info = esc_html( get_post_meta( $class->ID, 'class_info', true ) );
	
    $class_video_url = esc_html( get_post_meta( $class->ID, 'class_video_url', true ) );
    $class_video_embed = esc_html( get_post_meta( $class->ID, 'class_video_embed', true ) );
	
    $class_gallery_img1 = esc_html( get_post_meta( $class->ID, 'class_gallery_img1', true ) );
    $class_gallery_img2 = esc_html( get_post_meta( $class->ID, 'class_gallery_img2', true ) );
    $class_gallery_img3 = esc_html( get_post_meta( $class->ID, 'class_gallery_img3', true ) );
    $class_gallery_img4 = esc_html( get_post_meta( $class->ID, 'class_gallery_img4', true ) );
    $class_gallery_img5 = esc_html( get_post_meta( $class->ID, 'class_gallery_img5', true ) );
    $class_gallery_img6 = esc_html( get_post_meta( $class->ID, 'class_gallery_img6', true ) );
    $class_gallery_img7 = esc_html( get_post_meta( $class->ID, 'class_gallery_img7', true ) );
    $class_gallery_img8 = esc_html( get_post_meta( $class->ID, 'class_gallery_img8', true ) );
	
    $class_registration = esc_html( get_post_meta( $class->ID, 'class_registration', true ) );
    $class_custom_registration = esc_html( get_post_meta( $class->ID, 'class_custom_registration', true ));
    ?>
	<div class="schedule-tabs-section">
		<ul id="schedule-tabs-nav" data-uk-switcher="{connect:'#schedule-tabs'}">
			<li><a href=""><?php echo __($basic_info_text, 'jt-schedule'); ?></a></li>
			<li><a href=""><?php echo __($info_text, 'jt-schedule'); ?></a></li>
			<li><a href=""><?php echo __($media_text, 'jt-schedule'); ?></a></li>
		</ul>

		<ul id="schedule-tabs" class="uk-switcher">
			<li>
				<div class="uk-grid">
					<div class="uk-width-1-2">
						<p>
							<label><?php echo __($short_info_text, 'jt-schedule'); ?></label>
							<textarea name="class_short_info" cols="70" rows="7"><?php echo $class_short_info; ?></textarea>
						</p>
						<p>
							<label><?php echo __($starts_text . ' (e.g. 09:00)', 'jt-schedule'); ?></label>
							<input type="text" size="5" name="class_starts" value="<?php echo $class_starts; ?>" />
						</p>
						<p>
							<label><?php echo __($duration_text . ' (e.g. 30min)', 'jt-schedule'); ?></label>
							<input type="text" size="10" name="class_duration" value="<?php echo $class_duration; ?>" />
						</p>
					</div>
					<div class="uk-width-1-2">
						<p>
							<label><?php echo __($instructor_text . ' (e.g. John Doe)', 'jt-schedule'); ?></label>
							<input type="text" size="80" name="class_trainer" value="<?php echo $class_trainer; ?>" />
						</p>
						<p>
							<label><?php echo __($class_text . ' (e.g. C3)', 'jt-schedule'); ?></label>
							<input type="text" size="80" name="class_room" value="<?php echo $class_room; ?>" />
						</p>
						<p>
							<label><?php echo __($price_text . ' (e.g. $18)', 'jt-schedule'); ?></label>
							<input type="text" size="80" name="class_price" value="<?php echo $class_price; ?>" />
						</p>
						<p>
							<label><?php echo __($color_text . '*', 'jt-schedule'); ?></label>
							<input type="color" name="class_color" value="<?php echo $class_color; ?>" />
						</p>
						<p><?php echo __('* Color is not used on all styles of JT Schedule\'s widget.', 'jt-schedule'); ?></p>
					</div>
				</div>
			</li>
			<li>
				<?php wp_editor( html_entity_decode(stripcslashes($class_info)), $info ); ?>
			</li>
			<li>
				<div class="media-fields">
					<p>
						<label><?php echo __($video_text, 'jt-schedule'); ?></label>
						<input type="url" size="80" name="class_video_url" value="<?php echo $class_video_url; ?>" />
					</p>
					<p>
						<label><?php echo __($video_embed_text, 'jt-schedule'); ?></label>
						<textarea name="class_video_embed" cols="70" rows="3"><?php echo $class_video_embed; ?></textarea>
					</p>
					<hr />
					<h3><?php echo __($gallery_text, 'jt-schedule'); ?></h3>
					<p class="gallery-img">
						<label for="class_gallery_img1">
							<input id="class_gallery_img1" type="text" size="100" name="class_gallery_img1" value="<?php echo $class_gallery_img1; ?>" placeholder="Image 1" /><input id="class_gallery_img1_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
					<p class="gallery-img">
						<label for="class_gallery_img2">
							<input id="class_gallery_img2" type="text" size="100" name="class_gallery_img2" value="<?php echo $class_gallery_img2; ?>" placeholder="Image 2" /><input id="class_gallery_img2_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
					<p class="gallery-img">
						<label for="class_gallery_img3">
							<input id="class_gallery_img3" type="text" size="100" name="class_gallery_img3" value="<?php echo $class_gallery_img3; ?>" placeholder="Image 3" /><input id="class_gallery_img3_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
					<p class="gallery-img">
						<label for="class_gallery_img4">
							<input id="class_gallery_img4" type="text" size="100" name="class_gallery_img4" value="<?php echo $class_gallery_img4; ?>" placeholder="Image 4" /><input id="class_gallery_img4_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
					<p class="gallery-img">
						<label for="class_gallery_img5">
							<input id="class_gallery_img5" type="text" size="100" name="class_gallery_img5" value="<?php echo $class_gallery_img5; ?>" placeholder="Image 5" /><input id="class_gallery_img5_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
					<p class="gallery-img">
						<label for="class_gallery_img6">
							<input id="class_gallery_img6" type="text" size="100" name="class_gallery_img6" value="<?php echo $class_gallery_img6; ?>" placeholder="Image 6" /><input id="class_gallery_img6_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
					<p class="gallery-img">
						<label for="class_gallery_img7">
							<input id="class_gallery_img7" type="text" size="100" name="class_gallery_img7" value="<?php echo $class_gallery_img7; ?>" placeholder="Image 7" /><input id="class_gallery_img7_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
					<p class="gallery-img">
						<label for="class_gallery_img8">
							<input id="class_gallery_img8" type="text" size="100" name="class_gallery_img8" value="<?php echo $class_gallery_img8; ?>" placeholder="Image 8" /><input id="class_gallery_img8_button" class="button" type="button" value="<?php echo __($upload_text, 'jt-event-calendar'); ?>" />
						</label>
					</p>
				</div>
			</li>
		</ul>
	</div>

	<div class="schedule-settings">
		<h3 class="section-title"><span><?php echo __($settings_text, 'jt-schedule'); ?></span></h3>
		<div class="uk-grid">
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($registration_form_text, 'jt-schedule'); ?></label>
					<select name="class_registration">
						<option value="yes" <?php selected( $class_registration, 'yes' ); ?>><?php echo __('Yes', 'jt-schedule'); ?></option>
						<option value="no" <?php selected( $class_registration, 'no' ); ?>><?php echo __('No', 'jt-schedule'); ?></option>
					</select>
				</p>
			</div>
			
			<div class="uk-width-1-2">
				<p>
					<label><?php echo __($custom_form_text, 'jt-schedule'); ?></label>
					<input type="text" name="class_custom_registration" placeholder="<?php echo __('Add here the shortcode of your custom form', 'jt-schedule'); ?>" value='<?php echo $class_custom_registration; ?>'>
				</p>
			</div>
		</div>
	</div>
    <?php
}

add_action( 'save_post', 'add_class_fields', 10, 2 );
function add_class_fields( $class_id, $class ) {
    // Check post type for movie reviews
    if ( $class->post_type == 'schedule' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['class_starts'] )) {
            update_post_meta( $class_id, 'class_starts', $_POST['class_starts'] );
        }
        if ( isset( $_POST['class_duration'] )) {
            update_post_meta( $class_id, 'class_duration', $_POST['class_duration'] );
        }
        if ( isset( $_POST['class_trainer'] )) {
            update_post_meta( $class_id, 'class_trainer', $_POST['class_trainer'] );
        }
        if ( isset( $_POST['class_room'] )) {
            update_post_meta( $class_id, 'class_room', $_POST['class_room'] );
        }
        if ( isset( $_POST['class_color'] )) {
            update_post_meta( $class_id, 'class_color', $_POST['class_color'] );
        }
        if ( isset( $_POST['class_info'] )) {
            update_post_meta( $class_id, 'class_info', $_POST['class_info'] );
        }
        if ( isset( $_POST['class_video_url'] )) {
            update_post_meta( $class_id, 'class_video_url', $_POST['class_video_url'] );
        }
        if ( isset( $_POST['class_video_embed'] )) {
            update_post_meta( $class_id, 'class_video_embed', $_POST['class_video_embed'] );
        }
        if ( isset( $_POST['class_gallery_img1'] )) {
            update_post_meta( $class_id, 'class_gallery_img1', $_POST['class_gallery_img1'] );
        }
        if ( isset( $_POST['class_gallery_img2'] )) {
            update_post_meta( $class_id, 'class_gallery_img2', $_POST['class_gallery_img2'] );
        }
        if ( isset( $_POST['class_gallery_img3'] )) {
            update_post_meta( $class_id, 'class_gallery_img3', $_POST['class_gallery_img3'] );
        }
        if ( isset( $_POST['class_gallery_img4'] )) {
            update_post_meta( $class_id, 'class_gallery_img4', $_POST['class_gallery_img4'] );
        }
        if ( isset( $_POST['class_gallery_img5'] )) {
            update_post_meta( $class_id, 'class_gallery_img5', $_POST['class_gallery_img5'] );
        }
        if ( isset( $_POST['class_gallery_img6'] )) {
            update_post_meta( $class_id, 'class_gallery_img6', $_POST['class_gallery_img6'] );
        }
        if ( isset( $_POST['class_gallery_img7'] )) {
            update_post_meta( $class_id, 'class_gallery_img7', $_POST['class_gallery_img7'] );
        }
        if ( isset( $_POST['class_gallery_img8'] )) {
            update_post_meta( $class_id, 'class_gallery_img8', $_POST['class_gallery_img8'] );
        }
        if ( isset( $_POST['class_registration'] )) {
            update_post_meta( $class_id, 'class_registration', $_POST['class_registration'] );
        }
        if ( isset( $_POST['class_custom_registration'] )) {
            update_post_meta( $class_id, 'class_custom_registration', $_POST['class_custom_registration'] );
        }
        if ( isset( $_POST['class_short_info'] )) {
            update_post_meta( $class_id, 'class_short_info', $_POST['class_short_info'] );
        }
        if ( isset( $_POST['class_price'] )) {
            update_post_meta( $class_id, 'class_price', $_POST['class_price'] );
        }
    }
}


function get_schedule_template($single_template) {
     global $post;

     if ($post->post_type == 'schedule') {
          $single_template = dirname( __FILE__ ) . '/single-schedule.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'get_schedule_template' );



function jt_schedule_shortcode($atts)
{
	$jtschedule = shortcode_atts( array(
		'title' => '',
		'cat' => '',
        'num' => '-1',
		'style' => 'default',
		'order' => 'DESC',
    ), $atts );
	
    ob_start();
	if ( $jtschedule['style'] == 'default') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'default-2') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/default-2.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'colored') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/colored.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'colored-tabs') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/colored-tabs.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'rounded-images') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/rounded-images.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'rounded-overlay') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/rounded-overlay.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'sidebar-slider-colored') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/sidebar-slider-colored.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'sidebar-slider') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/sidebar-slider.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtschedule['style'] == 'tabs') {
		include (plugin_dir_path(__FILE__) . 'shortcodes/tabs.php');
		$output = ob_get_clean();
		return $output;
	}
	
}
add_shortcode('schedule', 'jt_schedule_shortcode');



// Creating the widget 
class jt_schedule extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_schedule', 

		// Widget name will appear in UI
		__('JT Schedule', 'jt-schedule'), 

		// Widget description
		array( 'description' => __( 'Create a modern and responsive schedule', 'jt-schedule' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
					
		$options = get_option( 'jt_schedule_settings' );
		include ( dirname( __FILE__ ) . '/options/variables.php');
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		$order = $instance['order'];
		$category = $instance['category'];
		
		// before and after widget arguments are defined by themes
		echo $widget_args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $widget_args['before_title'];
		
			echo $title;
		
			echo $widget_args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'default') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default.php');
		}
		else if ($style == 'default-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default-2.php');
		}
		else if ($style == 'rounded-images') {
			include( plugin_dir_path( __FILE__ ) . 'styles/rounded-images.php');
		}
		else if ($style == 'rounded-overlay') {
			include( plugin_dir_path( __FILE__ ) . 'styles/rounded-overlay.php');
		}
		else if ($style == 'colored') {
			include( plugin_dir_path( __FILE__ ) . 'styles/colored.php');
		}
		else if ($style == 'tabs') {
			include( plugin_dir_path( __FILE__ ) . 'styles/tabs.php');
		}
		else if ($style == 'colored-tabs') {
			include( plugin_dir_path( __FILE__ ) . 'styles/colored-tabs.php');
		}
		else if ($style == 'sidebar-slider') {
			include( plugin_dir_path( __FILE__ ) . 'styles/sidebar-slider.php');
		}
		else if ($style == 'sidebar-slider-colored') {
			include( plugin_dir_path( __FILE__ ) . 'styles/sidebar-slider-colored.php');
		}
		
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		$order =  isset( $instance['order'] ) ? $instance[ 'order' ] : ' ';
		$category =  isset( $instance['category'] ) ? $instance[ 'category' ] : ' ';
		
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			<div class="jt-menu-widget">
				<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			</div>
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-schedule' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-schedule' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="default" <?php echo ($style == 'default')?'selected':''; ?>>Default</option>
						<option value="default-2" <?php echo ($style == 'default-2')?'selected':''; ?>>Default 2</option>
						<option value="rounded-images" <?php echo ($style == 'rounded-images')?'selected':''; ?>>Rounded Images</option>
						<option value="rounded-overlay" <?php echo ($style == 'rounded-overlay')?'selected':''; ?>>Rounded Images - Overlay Text</option>
						<option value="colored" <?php echo ($style == 'colored')?'selected':''; ?>>Text only schedule</option>
						<option value="tabs" <?php echo ($style == 'tabs')?'selected':''; ?>>Tabs - Default</option>
						<option value="colored-tabs" <?php echo ($style == 'colored-tabs')?'selected':''; ?>>Colored Tabs</option>
						<option value="sidebar-slider" <?php echo ($style == 'sidebar-slider')?'selected':''; ?>>Sidebar - Slider</option>
						<option value="sidebar-slider-colored" <?php echo ($style == 'sidebar-slider-colored')?'selected':''; ?>>Sidebar - Colored Slider</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:', 'jt-schedule' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
						<option value="ASC" <?php echo ($order == 'ASC')?'selected':''; ?>>ASC</option>
						<option value="DESC" <?php echo ($order == 'DESC')?'selected':''; ?>>DESC</option>
					</select>
				</p>
				<p>
				<?php
					$terms = get_terms( 'classes_categories' );
					if ( ! empty( $terms ) ) {
				?>
					<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'jt-schedule' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
						<option value="all" <?php echo ($category == 'all')?'selected':''; ?>><?php _e('All Categories'); ?></option>
						<?php
					 		foreach ( $terms as $term ) {
						 ?>
						<option value="<?php echo $term->slug; ?>" <?php echo ($category == $term->slug)?'selected':''; ?>><?php echo $term->name; ?></option>
						<?php
							}
						?>
				</select>
				<?php
					}
				?>
				</p>
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
		$instance['order'] = $new_instance['order'];
		$instance['category'] = $new_instance['category'];
		
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function jt_schedule_widget() {
	register_widget( 'jt_schedule' );
}
add_action( 'widgets_init', 'jt_schedule_widget' );

function jt_schedule_styles() {
	
	   wp_register_style('font-awesome', plugin_dir_url(__FILE__).'css/font-awesome.min.css');
	   wp_enqueue_style('font-awesome');
		
       wp_register_style( 'uikit.css', plugin_dir_url(__FILE__).'css/uikit.css' );
       wp_enqueue_style( 'uikit.css' );
	
       wp_register_script( 'uikit.js', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery'));
       wp_enqueue_script( 'uikit.js' );
	
       wp_register_script( 'switcher.js', plugin_dir_url(__FILE__).'js/switcher.min.js' );
       wp_enqueue_script( 'switcher.js' );
	
    if (wp_style_is( 'jsquare-widget.css', 'enqueued' )) {
    	return;
    } else {
       wp_register_style( 'jsquare-widget.css', plugin_dir_url(__FILE__).'css/jsquare-widget.css' );
       wp_enqueue_style( 'jsquare-widget.css' );
    }
	
    if (wp_style_is( 'accordion.css', 'enqueued' )) {
    	return;
    } else {
       wp_register_style( 'accordion.css', plugin_dir_url(__FILE__).'css/accordion.min.css' );
       wp_enqueue_style( 'accordion.css' );
    }
	
    if (wp_script_is( 'accordion.js', 'enqueued' )) {
    	return;
    } else {
       wp_register_script( 'accordion.js', plugin_dir_url(__FILE__).'js/accordion.min.js' );
       wp_enqueue_script( 'accordion.js' );
    }
	
}
add_action( 'widgets_init','jt_schedule_styles');


function jt_schedule_scripts() {
		
		wp_register_style( 'uikit.css', plugin_dir_url(__FILE__).'css/uikit.css' );
		wp_enqueue_style( 'uikit.css' );
		wp_register_style( 'uikit-slideshow.css', plugin_dir_url(__FILE__).'css/slideshow.min.css' );
		wp_enqueue_style( 'uikit-slideshow.css' );
		wp_register_style( 'uikit-slidenav.css', plugin_dir_url(__FILE__).'css/slidenav.min.css' );
		wp_enqueue_style( 'uikit-slidenav.css' );
       wp_register_style( 'jt-schedule.css', plugin_dir_url(__FILE__).'css/jt-schedule.css' );
       wp_enqueue_style( 'jt-schedule.css' );
		wp_register_style('jt-schedule', plugin_dir_url(__FILE__). 'css/style.css');
		wp_enqueue_style('jt-schedule');
		wp_style_add_data( 'jt-schedule', 'rtl', 'replace' );
	
		wp_register_script('uikit_js', plugin_dir_url(__FILE__). 'js/uikit.min.js', array('jquery'));
		wp_enqueue_script('uikit_js');
		wp_register_script('uikit_grid_js', plugin_dir_url(__FILE__). 'js/grid.min.js');
		wp_enqueue_script('uikit_grid_js');
		wp_register_style( 'tooltip.css', plugin_dir_url(__FILE__).'css/tooltip.min.css' );
		wp_enqueue_style( 'tooltip.css' );
		wp_register_script( 'tooltip.js', plugin_dir_url(__FILE__).'js/tooltip.min.js' );
		wp_enqueue_script( 'tooltip.js' );
		wp_register_script( 'schedule-slider', plugin_dir_url(__FILE__).'js/slideshow.min.js' );
		wp_enqueue_script( 'schedule-slider' );
	
}
add_action( 'init','jt_schedule_scripts');


add_action('admin_enqueue_scripts', 'jt_schedule_admin_scripts');
 
function jt_schedule_admin_scripts() {
        wp_enqueue_media();
        wp_register_script('jt-admin-scripts.js', plugin_dir_url(__FILE__) . '/js/admin-scripts.js', array('jquery'));
        wp_enqueue_script('jt-admin-scripts.js');
}

?>
