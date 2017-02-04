<?php

/***** About Widget *****/

class lycka_lite_about_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'lycka_lite_about_widget', esc_html_x('[Lyka] About Widget', 'widget name', 'lycka-lite'),
			array('classname' => 'lycka_lite_about_widget', 'description' => esc_html__('About Widget with your image and description.', 'lycka-lite'))
		);
	}
	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters( 'widget_title', $instance['title'] );
		$imageurl = $instance['imageurl'];
		$imagealt = $instance['imagealt'];
		$imagewidth = $instance['imagewidth'];
		$imageheight = $instance['imageheight'];
		$aboutdescription = $instance['aboutdescription'];
		$feed = $instance['feed'];
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$googleplus = $instance['googleplus'];
		$linkedin = $instance['linkedin'];
		$youtube = $instance['youtube'];

		echo $before_widget; 
		?>

			<div class="about">
				<?php if($title != '') echo '<h4 class="widget-title">'.$title.'</h4>'; ?>

				<div class="about-image">
					<img src="<?php echo esc_attr($imageurl); ?>" width="<?php echo esc_attr($imagewidth); ?>" height="<?php echo esc_attr($imageheight); ?>" class="about-img" alt="<?php echo esc_attr($imagealt); ?>">
				</div>
				
				<div class="about-description">
					<p><?php echo $aboutdescription; ?></p>
					<p class="about-social">
						<?php if($feed != '') echo '<span><a href="' . esc_url($feed) . '" title="' . __( 'Feed', 'lycka-lite' ) . '" class="' . __( 'social social-feed', 'lycka-lite' ) . '" target="' . __( '_blank', 'lycka-lite' ) . '"></a></span>'; ?>
						<?php if($twitter != '') echo '<span><a href="' . esc_url($twitter) . '" title="' . __( 'Twitter', 'lycka-lite' ) . '" class="' . __( 'social social-twitter', 'lycka-lite' ) . '" target="' . __( '_blank', 'lycka-lite' ) . '"></a></span>'; ?>
						<?php if($facebook != '') echo '<span><a href="' . esc_url($facebook) . '" title="' . __( 'Facebook', 'lycka-lite' ) . '" class="' . __( 'social social-facebook', 'lycka-lite' ) . '" target="' . __( '_blank', 'lycka-lite' ) . '"></a></span>'; ?>
						<?php if($googleplus != '') echo '<span><a href="' . esc_url($googleplus) . '" title="' . __( 'Googleplus', 'lycka-lite' ) . '" class="' . __( 'social social-googleplus', 'lycka-lite' ) . '" target="' . __( '_blank', 'lycka-lite' ) . '"></a></span>'; ?>
						<?php if($linkedin != '') echo '<span><a href="' . esc_url($linkedin) . '" title="' . __( 'Linkedin', 'lycka-lite' ) . '" class="' . __( 'social social-linkedin', 'lycka-lite' ) . '" target="' . __( '_blank', 'lycka-lite' ) . '"></a></span>'; ?>
						<?php if($youtube != '') echo '<span><a href="' . esc_url($youtube) . '" title="' . __( 'Youtube', 'lycka-lite' ) . '" class="' . __( 'social social-youtube', 'lycka-lite' ) . '" target="' . __( '_blank', 'lycka-lite' ) . '"></a></span>'; ?>
					</p>
				</div>
			</div>

		<?php
		echo $after_widget;
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
						'title' => '', 
						'imageurl' => 'http://...', 
						'imagealt' => '',  
						'imagewidth' => '250', 
						'imageheight' => '200',
						'aboutdescription' => '',
						'feed' => './feed/', 
						'twitter' => '',
						'facebook' => '',
						'googleplus' => '',
						'linkedin' => '',
						'youtube' => ''
					);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title' )); ?>"><?php _e('Title:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imageurl' )); ?>"><?php _e('Image URL:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imageurl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imageurl' )); ?>" type="text" value="<?php echo esc_attr($instance['imageurl']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imagealt' )); ?>"><?php _e('Image ALT:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imagealt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imagealt' )); ?>" type="text" value="<?php echo esc_attr($instance['imagealt']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imagewidth' )); ?>"><?php _e('Image Width:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imagewidth' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imagewidth' )); ?>" type="text" value="<?php echo esc_attr($instance['imagewidth']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'imageheight' )); ?>"><?php _e('Image Height:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'imageheight' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'imageheight' )); ?>" type="text" value="<?php echo esc_attr($instance['imageheight']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'aboutdescription' )); ?>"><?php _e('About Description:','lycka-lite'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'aboutdescription' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'aboutdescription' )); ?>" rows="12" cols="20"><?php echo esc_attr($instance['aboutdescription']); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'feed' )); ?>"><?php _e('Feed:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'feed' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'feed')); ?>" type="text" value="<?php echo esc_attr($instance['feed']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php _e('Twitter:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" type="text" value="<?php echo esc_attr($instance['twitter']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php _e('Facebook:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" type="text" value="<?php echo esc_attr($instance['facebook']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'googleplus' )); ?>"><?php _e('Googleplus:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'googleplus' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'googleplus' )); ?>" type="text" value="<?php echo esc_attr($instance['googleplus']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php _e('Linkedin:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" type="text" value="<?php echo esc_attr($instance['linkedin']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php _e('Youtube:','lycka-lite'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" type="text" value="<?php echo esc_attr($instance['youtube']); ?>" />
		</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['imageurl'] = strip_tags( $new_instance['imageurl'] );
		$instance['imagealt'] = strip_tags( $new_instance['imagealt'] );
		$instance['imagewidth'] = strip_tags( $new_instance['imagewidth'] );
		$instance['imageheight'] = strip_tags( $new_instance['imageheight'] );
		$instance['aboutdescription'] = strip_tags( $new_instance['aboutdescription'] );
		$instance['feed'] = strip_tags( $new_instance['feed'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );

		return $instance;
	}
	
} // class lycka_lite_about_widget

add_action( 'widgets_init', 'create_about_widget' );

function create_about_widget(){
	return register_widget("lycka_lite_about_widget");
}