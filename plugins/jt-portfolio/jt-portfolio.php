<?php
/*
Plugin Name: JT Portfolio
Plugin URI: http://www.jsquare-themes.com
Description: Show your projects in a modern and responsive way
Text Domain: jt-portfolio
Version: 3.1.0
Author: JSquare Themes
Author URI: http://www.jsquare-themes.com
License: GPLv2 or later
*/

defined('ABSPATH') or die;


add_action( 'init', 'create_projects_list' );
function create_projects_list() {
    register_post_type( 'projects_list',
        array(
            'labels' => array(
                'name' => __('Projects', 'jt-portfolio'),
                'singular_name' => __('Project', 'jt-portfolio'),
                'add_new' => __('Add New', 'jt-portfolio'),
                'add_new_item' => __('Add New Project', 'jt-portfolio'),
                'edit' => __('Edit', 'jt-portfolio'),
                'edit_item' => __('Edit Project', 'jt-portfolio'),
                'new_item' => __('New Project', 'jt-portfolio'),
                'view' => __('View', 'jt-portfolio'),
                'view_item' => __('View Project', 'jt-portfolio'),
                'search_items' => __('Search Projects', 'jt-portfolio'),
                'not_found' => __('No Projects found', 'jt-portfolio'),
                'not_found_in_trash' => __('No Projects found in Trash', 'jt-portfolio'),
                'parent' => __('Parent Project', 'jt-portfolio')
            ),
 
            'public' => true,
            'menu_position' => 25,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-portfolio',
            'has_archive' => true
        )
    );

}

add_action('init', 'register_projects_category', 0);

function register_projects_category() {
    register_taxonomy(
        'projects_categories',
        'projects_list',
        array(
            'labels' => array(
                'name' => __('Project Category', 'jt-portfolio'),
                'add_new_item' => __('Add New Project Category', 'jt-portfolio'),
                'new_item_name' => __("New Project Category", 'jt-portfolio')
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}

add_action( 'admin_init', 'projects_meta' );
function projects_meta() {
    add_meta_box( 'project_meta_box',
        'Project Details',
        'display_project_meta_box',
        'projects_list', 'normal', 'high'
    );
}

include ( dirname( __FILE__ ) . '/options.php');

function get_project_page_template($single_template) {
     global $post;

     if ($post->post_type == 'projects_list') {
          $single_template = dirname( __FILE__ ) . '/single-projects_list.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'get_project_page_template' );


function jt_projects_shortcode($atts)
{
	$jtp = shortcode_atts( array(
		'title' => '',
		'cat' => '',
        'num' => '-1',
		'style' => 'default',
		'orderby' => 'ID',
		'order' => 'DESC',
		'filters' => 'no',
    ), $atts );
	
    ob_start();
	if ( $jtp['style'] == 'default') {
		include (plugin_dir_path(__FILE__) . 'shortcode/default.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'default-rounded') {
		include (plugin_dir_path(__FILE__) . 'shortcode/default-rounded.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'default-two-rounded') {
		include (plugin_dir_path(__FILE__) . 'shortcode/default-two-rounded.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'default-three-rounded') {
		include (plugin_dir_path(__FILE__) . 'shortcode/default-three-rounded.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'dynamic-grid') {
		include (plugin_dir_path(__FILE__) . 'shortcode/dynamic-grid.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'grid-2-cols') {
		include (plugin_dir_path(__FILE__) . 'shortcode/grid-2-cols.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'grid-rounded') {
		include (plugin_dir_path(__FILE__) . 'shortcode/grid-rounded.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'grid-space-rounded') {
		include (plugin_dir_path(__FILE__) . 'shortcode/grid-space-rounded.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'grid-space') {
		include (plugin_dir_path(__FILE__) . 'shortcode/grid-space.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'grid') {
		include (plugin_dir_path(__FILE__) . 'shortcode/grid.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'minimal-two') {
		include (plugin_dir_path(__FILE__) . 'shortcode/minimal-two.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'minimal') {
		include (plugin_dir_path(__FILE__) . 'shortcode/minimal.php');
		$output = ob_get_clean();
		return $output;
	}
	else if ( $jtp['style'] == 'slideset') {
		include (plugin_dir_path(__FILE__) . 'shortcode/slideset.php');
		$output = ob_get_clean();
		return $output;
	}
	
}
add_shortcode('projects', 'jt_projects_shortcode');


function display_project_meta_box( $project ) {
    $project_short_info = esc_html( get_post_meta( $project->ID, 'project_short_info', true ) );
	$info = 'project_info';
    $project_info = esc_html( get_post_meta( $project->ID, 'project_info', true ) );
    $project_client = esc_html( get_post_meta( $project->ID, 'project_client', true ) );
    $project_website = esc_html( get_post_meta( $project->ID, 'project_website', true ) );
    $project_budget = esc_html( get_post_meta( $project->ID, 'project_budget', true ) );
    $project_date = esc_html( get_post_meta( $project->ID, 'project_date', true ) );
    $project_implementation_time = esc_html( get_post_meta( $project->ID, 'project_implementation_time', true ) );
    $project_country = esc_html( get_post_meta( $project->ID, 'project_country', true ) );
    $project_filter = esc_html( get_post_meta( $project->ID, 'project_filter', true ) );
    $project_lbutton_text = esc_html( get_post_meta( $project->ID, 'project_lbutton_text', true ) );
    $project_lbutton_url = esc_html( get_post_meta( $project->ID, 'project_lbutton_url', true ) );
    $project_lbutton_icon = esc_html( get_post_meta( $project->ID, 'project_lbutton_icon', true ) );
    $project_rbutton_text = esc_html( get_post_meta( $project->ID, 'project_rbutton_text', true ) );
    $project_rbutton_url = esc_html( get_post_meta( $project->ID, 'project_rbutton_url', true ) );
    $project_rbutton_icon = esc_html( get_post_meta( $project->ID, 'project_rbutton_icon', true ) );
    $project_video_embed = esc_html( get_post_meta( $project->ID, 'project_video_embed', true ) );
    $project_video_url = esc_html( get_post_meta( $project->ID, 'project_video_url', true ) );
    $project_img1 = esc_html( get_post_meta( $project->ID, 'project_img1', true ) );
    $project_img2 = esc_html( get_post_meta( $project->ID, 'project_img2', true ) );
    $project_img3 = esc_html( get_post_meta( $project->ID, 'project_img3', true ) );
    $project_img4 = esc_html( get_post_meta( $project->ID, 'project_img4', true ) );
    $project_img5 = esc_html( get_post_meta( $project->ID, 'project_img5', true ) );
    $project_img6 = esc_html( get_post_meta( $project->ID, 'project_img6', true ) );
    ?>

	<ul id="event-tabs-nav" data-uk-switcher="{connect:'#event-tabs'}">
		<li><a href="">Basic Info</a></li>
		<li><a href="">Info</a></li>
		<li><a href="">Widget Info</a></li>
		<li><a href="">Media</a></li>
	</ul>

	<ul id="event-tabs" class="uk-switcher">
		<li>
			<table>
				<tr>
					<td style="width: 100%"><?php echo __('Short Info', 'jt-portfolio'); ?></td>
					<td><textarea name="project_short_info" cols="70" rows="3"><?php echo $project_short_info; ?></textarea></td>
				</tr>
				<tr>
					<td style="width: 100%"><?php echo __('Client', 'jt-portfolio'); ?></td>
            		<td><input type="text" size="80" name="project_client" value="<?php echo $project_client; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%"><?php echo __('Country', 'jt-portfolio'); ?></td>
            		<td><input type="text" size="80" name="project_country" value="<?php echo $project_country; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%"><?php echo __('Budget', 'jt-portfolio'); ?></td>
            		<td><input type="text" size="80" name="project_budget" value="<?php echo $project_budget; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%"><?php echo __('Date', 'jt-portfolio'); ?></td>
            		<td><input type="text" size="80" name="project_date" value="<?php echo $project_date; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%"><?php echo __('Implementation Time', 'jt-portfolio'); ?></td>
            		<td><input type="text" size="80" name="project_implementation_time" value="<?php echo $project_implementation_time; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%"><?php echo __('Website', 'jt-portfolio'); ?></td>
            		<td><input type="url" size="80" name="project_website" value="<?php echo $project_website; ?>" /></td>
				</tr>
			</table>
		</li>
		
		<li>
			<?php wp_editor( html_entity_decode(stripcslashes($project_info)), $info ); ?>
		</li>
		
		<li>
			<table>
				<tr>
					<td style="width: 150px"><?php echo __('Filter', 'jt-portfolio'); ?></td>
					<td><input type="text" size="80" name="project_filter" value="<?php echo $project_filter; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 150px"><?php echo __('Left Button Text', 'jt-portfolio'); ?></td>
					<td><input type="text" size="80" name="project_lbutton_text" value="<?php echo $project_lbutton_text; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 150px"><?php echo __('Left Button URL', 'jt-portfolio'); ?></td>
					<td><input type="text" size="80" name="project_lbutton_url" value="<?php echo $project_lbutton_url; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 150px"><?php echo __('Left Button Icon (FontAwesome)', 'jt-portfolio'); ?></td>
					<td><input type="text" size="80" name="project_lbutton_icon" value="<?php echo $project_lbutton_icon; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 150px"><?php echo __('Right Button Text', 'jt-portfolio'); ?></td>
					<td><input type="text" size="80" name="project_rbutton_text" value="<?php echo $project_rbutton_text; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 150px"><?php echo __('Right Button URL', 'jt-portfolio'); ?></td>
					<td><input type="text" size="80" name="project_rbutton_url" value="<?php echo $project_rbutton_url; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 150px"><?php echo __('Right Button Icon (FontAwesome)', 'jt-portfolio'); ?></td>
					<td><input type="text" size="80" name="project_rbutton_icon" value="<?php echo $project_rbutton_icon; ?>" /></td>
				</tr>
			</table>
		</li>
		
		<li>
			
			<table>
				<tr>
					<td style="width: 100%"><?php echo __('Video URL', 'jt-portfolio'); ?></td>
					<td><input type="url" size="80" name="project_video_url" value="<?php echo $project_video_url; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%"><?php echo __('Video (Embed Code)', 'jt-portfolio'); ?></td>
					<td><textarea name="project_video_embed" cols="70" rows="3"><?php echo $project_video_embed; ?></textarea></td>
				</tr>
			</table>
			<hr />
			<h3><?php echo __('Photo Gallery', 'jt-event-calendar'); ?></h3>
			<p>
				<label for="project_img1">
					<input id="project_img1" type="text" size="100" name="project_img1" value="<?php echo $project_img1; ?>" placeholder="Image 1" /><input id="project_img1_button" class="button" type="button" value="<?php echo __('Upload', 'jt-portfolio'); ?>" />
				</label>
			</p>
			<p>
				<label for="project_img2">
					<input id="project_img2" type="text" size="100" name="project_img2" value="<?php echo $project_img2; ?>" placeholder="Image 2" /><input id="project_img2_button" class="button" type="button" value="<?php echo __('Upload', 'jt-portfolio'); ?>" />
				</label>
			</p>
			<p>
				<label for="project_img3">
					<input id="project_img3" type="text" size="100" name="project_img3" value="<?php echo $project_img3; ?>" placeholder="Image 3" /><input id="project_img3_button" class="button" type="button" value="<?php echo __('Upload', 'jt-portfolio'); ?>" />
				</label>
			</p>
			<p>
				<label for="event_gallery_img4">
					<input id="project_img4" type="text" size="100" name="project_img4" value="<?php echo $project_img4; ?>" placeholder="Image 4" /><input id="project_img4_button" class="button" type="button" value="<?php echo __('Upload', 'jt-portfolio'); ?>" />
				</label>
			</p>
			<p>
				<label for="project_img5">
					<input id="project_img5" type="text" size="100" name="project_img5" value="<?php echo $project_img5; ?>" placeholder="Image 5" /><input id="project_img5_button" class="button" type="button" value="<?php echo __('Upload', 'jt-portfolio'); ?>" />
				</label>
			</p>
			<p>
				<label for="project_img6">
					<input id="project_img6" type="text" size="100" name="project_img6" value="<?php echo $project_img6; ?>" placeholder="Image 6" /><input id="project_img6_button" class="button" type="button" value="<?php echo __('Upload', 'jt-portfolio'); ?>" />
				</label>
			</p>
		</li>
	</ul>
    <?php
}

add_action( 'save_post', 'add_project_fields', 10, 2 );
function add_project_fields( $project_id, $project ) {
    // Check post type for project
    if ( $project->post_type == 'projects_list' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['project_short_info'] )) {
            update_post_meta( $project->ID, 'project_short_info', $_POST['project_short_info'] );
        }
        if ( isset( $_POST['project_info'] )) {
            update_post_meta( $project->ID, 'project_info', $_POST['project_info'] );
        }
        if ( isset( $_POST['project_filter'] )) {
            update_post_meta( $project->ID, 'project_filter', $_POST['project_filter'] );
        }
        if ( isset( $_POST['project_lbutton_text'] )) {
            update_post_meta( $project->ID, 'project_lbutton_text', $_POST['project_lbutton_text'] );
        }
        if ( isset( $_POST['project_lbutton_url'] )) {
            update_post_meta( $project->ID, 'project_lbutton_url', $_POST['project_lbutton_url'] );
        }
        if ( isset( $_POST['project_lbutton_icon'] )) {
            update_post_meta( $project->ID, 'project_lbutton_icon', $_POST['project_lbutton_icon'] );
        }
        if ( isset( $_POST['project_rbutton_text'] )) {
            update_post_meta( $project->ID, 'project_rbutton_text', $_POST['project_rbutton_text'] );
        }
        if ( isset( $_POST['project_rbutton_url'] )) {
            update_post_meta( $project->ID, 'project_rbutton_url', $_POST['project_rbutton_url'] );
        }
        if ( isset( $_POST['project_rbutton_icon'] )) {
            update_post_meta( $project->ID, 'project_rbutton_icon', $_POST['project_rbutton_icon'] );
        }
        if ( isset( $_POST['project_client'] )) {
            update_post_meta( $project->ID, 'project_client', $_POST['project_client'] );
        }
        if ( isset( $_POST['project_country'] )) {
            update_post_meta( $project->ID, 'project_country', $_POST['project_country'] );
        }
        if ( isset( $_POST['project_budget'] )) {
            update_post_meta( $project->ID, 'project_budget', $_POST['project_budget'] );
        }
        if ( isset( $_POST['project_date'] )) {
            update_post_meta( $project->ID, 'project_date', $_POST['project_date'] );
        }
        if ( isset( $_POST['project_implementation_time'] )) {
            update_post_meta( $project->ID, 'project_implementation_time', $_POST['project_implementation_time'] );
        }
        if ( isset( $_POST['project_website'] )) {
            update_post_meta( $project->ID, 'project_website', $_POST['project_website'] );
        }
        if ( isset( $_POST['project_video_url'] )) {
            update_post_meta( $project->ID, 'project_video_url', $_POST['project_video_url'] );
        }
        if ( isset( $_POST['project_video_embed'] )) {
            update_post_meta( $project->ID, 'project_video_embed', $_POST['project_video_embed'] );
        }
        if ( isset( $_POST['project_img1'] )) {
            update_post_meta( $project->ID, 'project_img1', $_POST['project_img1'] );
        }
        if ( isset( $_POST['project_img2'] )) {
            update_post_meta( $project->ID, 'project_img2', $_POST['project_img2'] );
        }
        if ( isset( $_POST['project_img3'] )) {
            update_post_meta( $project->ID, 'project_img3', $_POST['project_img3'] );
        }
        if ( isset( $_POST['project_img4'] )) {
            update_post_meta( $project->ID, 'project_img4', $_POST['project_img4'] );
        }
        if ( isset( $_POST['project_img5'] )) {
            update_post_meta( $project->ID, 'project_img5', $_POST['project_img5'] );
        }
        if ( isset( $_POST['project_img6'] )) {
            update_post_meta( $project->ID, 'project_img6', $_POST['project_img6'] );
        }
    }
}


// Creating the widget 
class jt_projects extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_projects', 

		// Widget name will appear in UI
		__('JT Projects Widget', 'jt-portfolio'), 

		// Widget description
		array( 'description' => __( 'Display your projects in a modern and responsive way', 'jt-portfolio' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		$number_of_projects = $instance['number_of_projects'];
		$display_filters = $instance['display_filters'];
		$order = $instance['order'];
		$orderby = $instance['orderby'];
		
		wp_register_script('uikit_js', plugins_url('/js/uikit.min.js',__FILE__ ));
		wp_enqueue_script('uikit_js');
		wp_register_script('uikit_grid_js', plugins_url('/js/grid.min.js',__FILE__ ));
		wp_enqueue_script('uikit_grid_js');
		wp_register_style( 'uikit.css', plugin_dir_url(__FILE__).'css/uikit.css' );
		wp_enqueue_style( 'uikit.css' );
		wp_register_script('jsquare_portfolio_slideset_js', plugins_url('/js/slideset.min.js',__FILE__ ));
		wp_enqueue_script('jsquare_portfolio_slideset_js');
		wp_register_style('jsquare_portfolio_slidenav_css', plugins_url('/css/slidenav.min.css',__FILE__ ));
		wp_enqueue_style('jsquare_portfolio_slidenav_css');
		
		// before and after widget arguments are defined by themes
		echo $widget_args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $widget_args['before_title'];
		
			echo $title;
		
			echo $widget_args['after_title'];
		}
		
		// Include style based on the widget's settings
		if ($style == 'project-default') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/default.php');
		}
		if ($style == 'project-default-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/default-rounded.php');
		}
		else if ($style == 'project-default-two-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/default-two-rounded.php');
		}
		else if ($style == 'project-default-three-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/default-three-rounded.php');
		}
		else if ($style == 'project-dynamic-grid') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/dynamic-grid.php');
		}
		else if ($style == 'project-grid') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/grid.php');
		}
		else if ($style == 'project-grid-2-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/grid-2-cols.php');
		}
		else if ($style == 'project-grid-4-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/grid-4-cols.php');
		}
		else if ($style == 'project-grid-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/grid-rounded.php');
		}
		else if ($style == 'project-grid-space') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/grid-space.php');
		}
		else if ($style == 'project-grid-space-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/grid-space-rounded.php');
		}
		else if ($style == 'project-minimal') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/minimal.php');
		}
		else if ($style == 'project-minimal-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/minimal-rounded.php');
		}
		else if ($style == 'project-minimal-two') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/minimal-two.php');
		}
		else if ($style == 'project-slideset') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/slideset.php');
		}
		else if ($style == 'project-grid-overlay') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/grid-overlay.php');
		}
		else if ($style == 'project-slideset-rounded-img') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/slideset-rounded-img.php');
		}
		else if ($style == 'project-sidebar-default') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/sidebar-default.php');
		}
		else if ($style == 'project-sidebar-default-2') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/sidebar-default-2.php');
		}
		else if ($style == 'project-sidebar-default-3') {
			include( plugin_dir_path( __FILE__ ) . 'styles/projects/sidebar-default-3.php');
		}
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		$number_of_projects =  isset( $instance['number_of_projects'] ) ? $instance[ 'number_of_projects' ] : ' ';
		$display_filters =  isset( $instance['display_filters'] ) ? $instance[ 'display_filters' ] : ' ';
		$order =  isset( $instance['order'] ) ? $instance[ 'order' ] : ' ';
		$orderby =  isset( $instance['orderby'] ) ? $instance[ 'orderby' ] : ' ';
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			
			<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
			
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-portfolio' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-portfolio' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="project-default" <?php echo ($style == 'project-default')?'selected':''; ?>>Default</option>
						<option value="project-default-rounded" <?php echo ($style == 'project-default-rounded')?'selected':''; ?>>Default - Rounded Buttons</option>
						<option value="project-default-two-rounded" <?php echo ($style == 'project-default-two-rounded')?'selected':''; ?>>Default 2 - Rounded Buttons</option>
						<option value="project-default-three-rounded" <?php echo ($style == 'project-default-three-rounded')?'selected':''; ?>>Default 3 - Rounded Buttons</option>
						<option value="project-dynamic-grid" <?php echo ($style == 'project-dynamic-grid')?'selected':''; ?>>Dynamic Grid</option>
						<option value="project-grid" <?php echo ($style == 'project-grid')?'selected':''; ?>>Grid</option>
						<option value="project-grid-space" <?php echo ($style == 'project-grid-space')?'selected':''; ?>>Grid with space</option>
						<option value="project-grid-overlay" <?php echo ($style == 'project-grid-overlay')?'selected':''; ?>>Grid - Overlay</option>
						<option value="project-grid-rounded" <?php echo ($style == 'project-grid-rounded')?'selected':''; ?>>Grid - Rounded Buttons</option>
						<option value="project-grid-space-rounded" <?php echo ($style == 'project-grid-space-rounded')?'selected':''; ?>>Grid - Rounded Buttons with space</option>
						<option value="project-grid-2-cols" <?php echo ($style == 'project-grid-2-cols')?'selected':''; ?>>Grid - 2 Columns</option>
						<option value="project-grid-4-cols" <?php echo ($style == 'project-grid-4-cols')?'selected':''; ?>>Grid - 4 Columns</option>
						<option value="project-minimal" <?php echo ($style == 'project-minimal')?'selected':''; ?>>Minimal</option>
						<option value="project-minimal-two" <?php echo ($style == 'project-minimal-two')?'selected':''; ?>>Minimal 2</option>
						<option value="project-slideset" <?php echo ($style == 'project-slideset')?'selected':''; ?>>Slideset</option>
						<option value="project-slideset-rounded-img" <?php echo ($style == 'project-slideset-rounded-img')?'selected':''; ?>>Slideset - Rounded Image</option>
						<option value="project-sidebar-default" <?php echo ($style == 'project-sidebar-default')?'selected':''; ?>>Sidebar - Default</option>
						<option value="project-sidebar-default-2" <?php echo ($style == 'project-sidebar-default-2')?'selected':''; ?>>Sidebar - Default 2</option>
						<option value="project-sidebar-default-3" <?php echo ($style == 'project-sidebar-default-3')?'selected':''; ?>>Sidebar - Default 3</option>
						
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'number_of_projects' ); ?>"><?php _e( 'Number of projects:', 'jt-portfolio' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'number_of_projects' ); ?>" name="<?php echo $this->get_field_name( 'number_of_projects' ); ?>" type="text" value="<?php echo esc_attr( $number_of_projects ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'display_filters' ); ?>"><?php _e( 'Display Filters:', 'jt-portfolio' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'display_filters' ); ?>" name="<?php echo $this->get_field_name( 'display_filters' ); ?>">
						<option value="no" <?php echo ($display_filters == 'no')?'selected':''; ?>>No</option>
						<option value="yes" <?php echo ($display_filters == 'yes')?'selected':''; ?>>Yes</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order by:', 'jt-portfolio' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
						<option value="ID" <?php echo ($orderby == 'ID')?'selected':''; ?>>ID</option>
						<option value="title" <?php echo ($orderby == 'title')?'selected':''; ?>>Title</option>
						<option value="name" <?php echo ($orderby == 'name')?'selected':''; ?>>Name</option>
						<option value="date" <?php echo ($orderby == 'date')?'selected':''; ?>>Date</option>
						<option value="rand" <?php echo ($orderby == 'rand')?'selected':''; ?>>Random</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:', 'jt-portfolio' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
						<option value="DESC" <?php echo ($order == 'DESC')?'selected':''; ?>>DESC</option>
						<option value="ASC" <?php echo ($order == 'ASC')?'selected':''; ?>>ASC</option>
					</select>
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
		$instance['number_of_projects'] = $new_instance['number_of_projects'];
		$instance['display_filters'] = $new_instance['display_filters'];
		$instance['order'] = $new_instance['order'];
		$instance['orderby'] = $new_instance['orderby'];
		
		return $instance;
	}

} // Class wpb_widget ends here

// Creating the widget 
class jt_portfolio extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'jt_portfolio', 

		// Widget name will appear in UI
		__('JT Portfolio', 'jt-portfolio'), 

		// Widget description
		array( 'description' => __( 'Show your projects in a modern and responsive way', 'jt-portfolio' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $widget_args, $instance ) {
		
        extract( $widget_args );
	
		$title = apply_filters( 'widget_title', $instance['title'] );
		$style = $instance['style'];
		$display_filters = $instance['display_filters'];
		
		for ($i = 1; $i <= 12; $i++) {
			${'img'.$i} = $instance[ 'img' . $i ];
			${'title'.$i} = $instance[ 'title' . $i ];
			${'short_info'.$i} = $instance[ 'short_info' . $i ];
			${'filter'.$i} = $instance[ 'filter' . $i ];
			${'lbutton_text'.$i} = $instance[ 'lbutton_text' . $i ];
			${'lbutton_icon'.$i} = $instance[ 'lbutton_icon' . $i ];
			${'lbutton_url'.$i} = $instance[ 'lbutton_url' . $i ];
			${'rbutton_text'.$i} = $instance[ 'rbutton_text' . $i ];
			${'rbutton_icon'.$i} = $instance[ 'rbutton_icon' . $i ];
			${'rbutton_url'.$i} = $instance[ 'rbutton_url' . $i ];
		}
		
		wp_register_script('uikit_js', plugins_url('/js/uikit.min.js',__FILE__ ));
		wp_enqueue_script('uikit_js');
		wp_register_script('uikit_grid_js', plugins_url('/js/grid.min.js',__FILE__ ));
		wp_enqueue_script('uikit_grid_js');
		wp_register_style('jsquare_portfolio', plugins_url('/css/style.css',__FILE__ ));
		wp_enqueue_style('jsquare_portfolio');
		wp_style_add_data( 'jsquare_portfolio', 'rtl', 'replace' );
		wp_register_style( 'uikit.css', plugin_dir_url(__FILE__).'css/uikit.css' );
		wp_enqueue_style( 'uikit.css' );
		wp_register_script('jsquare_portfolio_slideset_js', plugins_url('/js/slideset.min.js',__FILE__ ));
		wp_enqueue_script('jsquare_portfolio_slideset_js');
		wp_register_style('jsquare_portfolio_slidenav_css', plugins_url('/css/slidenav.min.css',__FILE__ ));
		wp_enqueue_style('jsquare_portfolio_slidenav_css');
		
		
		
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
		else if ($style == 'default-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default-rounded.php');
		}
		else if ($style == 'default-two-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default-two-rounded.php');
		}
		else if ($style == 'default-three-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/default-three-rounded.php');
		}
		else if ($style == 'minimal') {
			include( plugin_dir_path( __FILE__ ) . 'styles/minimal.php');
		}
		else if ($style == 'minimal-two') {
			include( plugin_dir_path( __FILE__ ) . 'styles/minimal-two.php');
		}
		else if ($style == 'grid') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid.php');
		}
		else if ($style == 'grid-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-rounded.php');
		}
		else if ($style == 'grid-space') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-space.php');
		}
		else if ($style == 'grid-space-rounded') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-space-rounded.php');
		}
		else if ($style == 'grid-2-cols') {
			include( plugin_dir_path( __FILE__ ) . 'styles/grid-2-cols.php');
		}
		else if ($style == 'dynamic-grid') {
			include( plugin_dir_path( __FILE__ ) . 'styles/dynamic-grid.php');
		}
		else if ($style == 'slideset') {
			include( plugin_dir_path( __FILE__ ) . 'styles/slideset.php');
		}
		
		echo $widget_args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance[ 'title' ] ) : ' ';
		$style =  isset( $instance['style'] ) ? $instance[ 'style' ] : ' ';
		$display_filters =  isset( $instance['display_filters'] ) ? $instance[ 'display_filters' ] : ' ';
		
		for ($i = 1; $i <= 12; $i++) {
			${'img'.$i} = isset( $instance['img' . $i] ) ? esc_attr( $instance[ 'img' . $i ] ) : ' ';
			${'title'.$i} = isset( $instance['title' . $i] ) ? esc_attr( $instance[ 'title' . $i ] ) : ' ';
			${'short_info'.$i} = isset( $instance['short_info' . $i] ) ? esc_attr( $instance[ 'short_info' . $i ] ) : ' ';
			${'filter'.$i} = isset( $instance['filter' . $i] ) ? esc_attr( $instance[ 'filter' . $i ] ) : ' ';
			${'lbutton_text'.$i} = isset( $instance['lbutton_text' . $i] ) ? esc_attr( $instance[ 'lbutton_text' . $i ] ) : ' ';
			${'lbutton_icon'.$i} = isset( $instance['lbutton_icon' . $i] ) ? esc_attr( $instance[ 'lbutton_icon' . $i ] ) : ' ';
			${'lbutton_url'.$i} = isset( $instance['lbutton_url' . $i] ) ? esc_attr( $instance[ 'lbutton_url' . $i ] ) : ' ';
			${'rbutton_text'.$i} = isset( $instance['rbutton_text' . $i] ) ? esc_attr( $instance[ 'rbutton_text' . $i ] ) : ' ';
			${'rbutton_icon'.$i} = isset( $instance['rbutton_icon' . $i] ) ? esc_attr( $instance[ 'rbutton_icon' . $i ] ) : ' ';
			${'rbutton_url'.$i} = isset( $instance['rbutton_url' . $i] ) ? esc_attr( $instance[ 'rbutton_url' . $i ] ) : ' ';
		}
		
		
		// Widget admin form
	?>
	<div class="wrap-jsquare">
	
		<div class="uk-accordion" data-uk-accordion>
			<div class="jt-menu-widget">
				<h3 class="uk-accordion-title"><i class="fa fa-gear"></i></h3>
				<h3 class="uk-accordion-title"><i class="fa fa-picture-o"></i></h3>
				<h3 class="uk-accordion-title"><i class="fa fa-font"></i></h3>
				<h3 class="uk-accordion-title"><i class="fa fa-tags"></i></h3>
				<h3 class="uk-accordion-title"><i class="fa fa-link"></i></h3>
			</div>
			<div class="uk-accordion-content">
				<h4>Widget Settings</h4>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title:', 'jt-portfolio' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'jt-portfolio' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
						<option value="default" <?php echo ($style == 'default')?'selected':''; ?>>Default</option>
						<option value="default-rounded" <?php echo ($style == 'default-rounded')?'selected':''; ?>>Default - Rounded Buttons</option>
						<option value="default-two-rounded" <?php echo ($style == 'default-two-rounded')?'selected':''; ?>>Default 2 - Rounded Buttons</option>
						<option value="default-three-rounded" <?php echo ($style == 'default-three-rounded')?'selected':''; ?>>Default 3 - Rounded Buttons</option>
						<option value="minimal" <?php echo ($style == 'minimal')?'selected':''; ?>>Minimal</option>
						<option value="minimal-two" <?php echo ($style == 'minimal-two')?'selected':''; ?>>Minimal 2</option>
						<option value="grid" <?php echo ($style == 'grid')?'selected':''; ?>>Grid</option>
						<option value="grid-rounded" <?php echo ($style == 'grid-rounded')?'selected':''; ?>>Grid - Rounded Buttons</option>
						<option value="grid-space" <?php echo ($style == 'grid-space')?'selected':''; ?>>Grid with space</option>
						<option value="grid-space-rounded" <?php echo ($style == 'grid-space-rounded')?'selected':''; ?>>Grid with space - Rounded Buttons</option>
						<option value="grid-2-cols" <?php echo ($style == 'grid-2-cols')?'selected':''; ?>>Grid 2 Columns</option>
						<option value="dynamic-grid" <?php echo ($style == 'dynamic-grid')?'selected':''; ?>>Dynamic Grid</option>
						<option value="slideset" <?php echo ($style == 'slideset')?'selected':''; ?>>Slideset</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'display_filters' ); ?>"><?php _e( 'Display Filters:', 'jt-portfolio' ); ?></label> 
					<select class="widefat" type="text" id="<?php echo $this->get_field_id( 'display_filters' ); ?>" name="<?php echo $this->get_field_name( 'display_filters' ); ?>">
						<option value="yes" <?php echo ($display_filters == 'yes')?'selected':''; ?>>Yes</option>
						<option value="no" <?php echo ($display_filters == 'no')?'selected':''; ?>>No</option>
					</select>
				</p>
			</div>
			
			<div class="uk-accordion-content">
				<h4>Project's Image URL</h4>
				<?php 
					for ($i = 1; $i <= 12; $i++) { 
				?>
				<p>
					<label for="<?php echo $this->get_field_id( 'img' . $i ); ?>"><?php _e( 'Project ' . $i ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'img' . $i ); ?>" name="<?php echo $this->get_field_name(  'img' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'img'.$i} ); ?>" />
				</p>
				<?php
					}
				?>
			</div>
			
			<div class="uk-accordion-content">
				<h4>Project's Info</h4>
				<?php 
					for ($i = 1; $i <= 12; $i++) { 
				?>
				<h5><?php _e('Project ' . $i); ?></h5>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' . $i ); ?>"><?php _e( 'Title', 'jt-portfolio' ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' . $i ); ?>" name="<?php echo $this->get_field_name( 'title' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'title'.$i} ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'short_info' . $i ); ?>"><?php _e( 'Short Info', 'jt-portfolio' ); ?></label> 
					<textarea class="widefat" rows="3" id="<?php echo $this->get_field_id( 'short_info' . $i ); ?>" name="<?php echo $this->get_field_name( 'short_info' . $i ); ?>"><?php echo esc_attr( ${'short_info'.$i} ); ?></textarea>
				</p>
				<?php
					}
				?>
			</div>
			
			<div class="uk-accordion-content">
				<h4>Project's Filters</h4>
				<?php 
					for ($i = 1; $i <= 12; $i++) { 
				?>
				<p>
					<label for="<?php echo $this->get_field_id( 'filter' . $i ); ?>"><?php _e( 'Project ' . $i ); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'filter' . $i ); ?>" name="<?php echo $this->get_field_name( 'filter' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'filter'.$i} ); ?>" />
				</p>
				<?php
					}
				?>
			</div>
			
			<div class="uk-accordion-content">
				<h4>Project's Links</h4>
				<?php 
					for ($i = 1; $i <= 12; $i++) { 
				?>
				<p>Project <?php echo $i; ?></p>
				<hr />
				
				<div class="uk-grid">
					<div class="uk-width-1-2">
						<h5>Left Button</h5>
						<p>
							<label for="<?php echo $this->get_field_id( 'lbutton_text' . $i ); ?>"><?php _e( 'Text', 'jt-portfolio' ); ?></label> 
							<input class="widefat" id="<?php echo $this->get_field_id( 'lbutton_text' . $i ); ?>" name="<?php echo $this->get_field_name( 'lbutton_text' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'lbutton_text'.$i} ); ?>" />
						</p>
						<p>
							<label for="<?php echo $this->get_field_id( 'lbutton_icon' . $i ); ?>"><?php _e( 'Icon', 'jt-portfolio' ); ?></label> 
							<input class="widefat" id="<?php echo $this->get_field_id( 'lbutton_icon' . $i ); ?>" name="<?php echo $this->get_field_name( 'lbutton_icon' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'lbutton_icon'.$i} ); ?>" />
						</p>
						<p>
							<label for="<?php echo $this->get_field_id( 'lbutton_url' . $i ); ?>"><?php _e( 'URL', 'jt-portfolio' ); ?></label> 
							<input class="widefat" id="<?php echo $this->get_field_id( 'lbutton_url' . $i ); ?>" name="<?php echo $this->get_field_name( 'lbutton_url' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'lbutton_url'.$i} ); ?>" />
						</p>
					</div>
					<div class="uk-width-1-2">
						<h5>Right Button</h5>
						<p>
							<label for="<?php echo $this->get_field_id( 'rbutton_text' . $i ); ?>"><?php _e( 'Text', 'jt-portfolio' ); ?></label> 
							<input class="widefat" id="<?php echo $this->get_field_id( 'rbutton_text' . $i ); ?>" name="<?php echo $this->get_field_name( 'rbutton_text' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'rbutton_text'.$i} ); ?>" />
						</p>
						<p>
							<label for="<?php echo $this->get_field_id( 'rbutton_icon' . $i ); ?>"><?php _e( 'Icon', 'jt-portfolio' ); ?></label> 
							<input class="widefat" id="<?php echo $this->get_field_id( 'rbutton_icon' . $i ); ?>" name="<?php echo $this->get_field_name( 'rbutton_icon' . $i ); ?>" type="text" value="<?php echo esc_attr( ${'rbutton_icon'.$i} ); ?>" />
						</p>
						<p>
							<label for="<?php echo $this->get_field_id( 'rbutton_url' . $i ); ?>"><?php _e( 'URL', 'jt-portfolio' ); ?></label> 
							<input class="widefat" id="<?php echo $this->get_field_id( 'rbutton_url' . $i ); ?>" name="<?php echo $this->get_field_name( 'rbutton_url' . $i ); ?>" type="url" value="<?php echo esc_attr( ${'rbutton_url'.$i} ); ?>" />
						</p>
					</div>
				</div>
					
				<br />
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
		$instance['display_filters'] = $new_instance['display_filters'];
		
		for ($i = 1; $i <= 12; $i++) {
			$instance['img' . $i] = strip_tags( $new_instance['img' . $i] );
			$instance['title' . $i] = strip_tags( $new_instance['title' . $i] );
			$instance['short_info' . $i] = strip_tags( $new_instance['short_info' . $i] );
			$instance['filter' . $i] = strip_tags( $new_instance['filter' . $i] );
			$instance['lbutton_text' . $i] = strip_tags( $new_instance['lbutton_text' . $i] );
			$instance['lbutton_icon' . $i] = strip_tags( $new_instance['lbutton_icon' . $i] );
			$instance['lbutton_url' . $i] = strip_tags( $new_instance['lbutton_url' . $i] );
			$instance['rbutton_text' . $i] = strip_tags( $new_instance['rbutton_text' . $i] );
			$instance['rbutton_icon' . $i] = strip_tags( $new_instance['rbutton_icon' . $i] );
			$instance['rbutton_url' . $i] = strip_tags( $new_instance['rbutton_url' . $i] );
		}
		
		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function jt_portfolio_widget() {
	register_widget( 'jt_portfolio' );
	register_widget( 'jt_projects' );
}
add_action( 'widgets_init', 'jt_portfolio_widget' );

function jt_portfolio_styles() {
	
	   wp_register_style('font-awesome', plugin_dir_url(__FILE__).'css/font-awesome.min.css');
	   wp_enqueue_style('font-awesome');
		
       wp_register_style( 'uikit.css', plugin_dir_url(__FILE__).'css/uikit.css' );
       wp_enqueue_style( 'uikit.css' );
	
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
       wp_register_script( 'accordion.css', plugin_dir_url(__FILE__).'css/accordion.min.css' );
       wp_enqueue_script( 'accordion.css' );
    }
	
    if (wp_script_is( 'uikit.js', 'enqueued' )) {
    	return;
    } else {
       wp_register_script( 'uikit.js', plugin_dir_url(__FILE__).'js/uikit.min.js');
       wp_enqueue_script( 'uikit.js' );
    }
	
    if (wp_script_is( 'accordion.js', 'enqueued' )) {
    	return;
    } else {
       wp_register_script( 'accordion.js', plugin_dir_url(__FILE__).'js/accordion.min.js' );
       wp_enqueue_script( 'accordion.js' );
    }
	
}
add_action( 'widgets_init','jt_portfolio_styles');

function jt_projects_page_styles() {
	
		wp_register_style('jsquare_portfolio', plugins_url('/css/style.css',__FILE__ ));
		wp_enqueue_style('jsquare_portfolio');
		wp_style_add_data( 'jsquare_portfolio', 'rtl', 'replace' );
	
	   wp_register_style('project-page-style', plugin_dir_url(__FILE__).'css/project-page.css');
	   wp_enqueue_style('project-page-style');
		wp_style_add_data( 'project-page-style', 'rtl', 'replace' );
	
}
add_action( 'init','jt_projects_page_styles');

add_action('admin_enqueue_scripts', 'jt_portfolio_admin_scripts');
 
function jt_portfolio_admin_scripts() {
        wp_register_script('portfolio-scripts-js', plugin_dir_url(__FILE__) . 'js/portfolio-scripts.js', array('jquery'));
        wp_enqueue_script('portfolio-scripts-js');
	
	   wp_register_style('jt-portfolio-uikit', plugin_dir_url(__FILE__).'css/uikit.css');
	   wp_enqueue_style('jt-portfolio-uikit');
	
       wp_register_script( 'uikit.js', plugin_dir_url(__FILE__).'js/uikit.min.js', array('jquery') );
       wp_enqueue_script( 'uikit.js' );
		wp_register_script('uikit_toggle_js', plugin_dir_url(__FILE__) . 'js/toggle.min.js', array('jquery'));
		wp_enqueue_script('uikit_toggle_js');
		wp_register_script('uikit_switcher_js', plugin_dir_url(__FILE__) . 'js/switcher.min.js', array('jquery'));
		wp_enqueue_script('uikit_switcher_js');
}

?>
