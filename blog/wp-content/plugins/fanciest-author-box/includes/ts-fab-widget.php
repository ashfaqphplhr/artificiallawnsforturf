<?php

add_action( 'init', 'ts_fab_widget_init', 1 );
function ts_fab_widget_init() {

	register_widget('ts_fab_widget');

}



class ts_fab_widget extends WP_Widget {

	function __construct() {

		$widget_ops = array(
			'classname'		=> 'ts-fab-widget',
			'description'	=> 'Fanciest Author Box ' . __( 'widget', 'ts-fab' )
		);
		parent::__construct( 'ts-fab-widget', 'Fanciest Author Box', $widget_ops);

	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Author Spotlight', 'ts-fab' ) : $instance['title'], $instance, $this->id_base );

		$author = !empty( $instance['author'] ) ? $instance['author'] : '';

		$show_tabs = array();

		!empty( $instance['bio'] ) ? $show_tabs[] = 'bio' : '';
		!empty( $instance['twitter'] ) ? $show_tabs[] = 'twitter' : '';
		!empty( $instance['facebook'] ) ? $show_tabs[] = 'facebook' : '';
		!empty( $instance['googleplus'] ) ? $show_tabs[] = 'googleplus' : '';
		!empty( $instance['linkedin'] ) ? $show_tabs[] = 'linkedin' : '';
		!empty( $instance['latest_posts'] ) ? $show_tabs[] = 'latest_posts' : '';
		!empty( $instance['custom'] ) ? $show_tabs[] = 'custom' : '';

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		?>

		<?php
			if( $instance['float_photo'] != 1 ) echo '<div class="ts-fab-no-float">';
			// If set to show random author, get random author ID
			if( $instance['author'] == 'random' ) {
				$args = array(
					'blog_id' => $GLOBALS['blog_id']
				);
				$users = get_users( $args );
				$random_user = array_rand( $users, 1 );
				$authorobject = $users[$random_user];
				$author = $authorobject->ID;
			}
			echo ts_fab_construct_fab( 'widget-' . $this->number, $author, $show_tabs );
			if( $instance['float_photo'] != 1 ) echo '</div>';
		?>

		<?php

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$new_instance = wp_parse_args(
			(array) $new_instance, 
			array(
				'title'			=> '',
				'author'		=> '',
				'bio'			=> '',
				'twitter'		=> '',
				'facebook'		=> '',
				'googleplus'	=> '',
				'linkedin'		=> '',
				'latest_posts'	=> '',
				'custom'		=> '',
				'float_photo'	=> ''
			)
		);
		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['author'] = $new_instance['author'];

		$instance['bio']			= $new_instance['bio'] ? 1 : 0;
		$instance['twitter']		= $new_instance['twitter'] ? 1 : 0;
		$instance['facebook']		= $new_instance['facebook'] ? 1 : 0;
		$instance['googleplus']		= $new_instance['googleplus'] ? 1 : 0;
		$instance['linkedin']		= $new_instance['linkedin'] ? 1 : 0;
		$instance['latest_posts']	= $new_instance['latest_posts'] ? 1 : 0;
		$instance['custom']			= $new_instance['custom'] ? 1 : 0;
		$instance['float_photo']	= $new_instance['float_photo'] ? 1 : 0;

		return $instance;

	}

	function form( $instance ) {

		$tabs_settings = ts_fab_get_tabs_settings();
		
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'			=> '',
				'author'		=> '',
				'bio'			=> $tabs_settings['bio'],
				'twitter'		=> $tabs_settings['twitter'],
				'facebook'		=> $tabs_settings['facebook'],
				'googleplus'	=> $tabs_settings['googleplus'],
				'linkedin'		=> $tabs_settings['linkedin'],
				'latest_posts'	=> $tabs_settings['latest_posts'],
				'custom'		=> $tabs_settings['custom'],
				'float_photo'	=> ''
			)
		);

		$title = strip_tags( $instance['title'] );

		$author = $instance['author'];

		$bio			= $instance['bio'] ? 'checked="checked"' : '';
		$twitter		= $instance['twitter'] ? 'checked="checked"' : '';
		$facebook		= $instance['facebook'] ? 'checked="checked"' : '';
		$googleplus		= $instance['googleplus'] ? 'checked="checked"' : '';
		$linkedin		= $instance['linkedin'] ? 'checked="checked"' : '';
		$latest_posts	= $instance['latest_posts'] ? 'checked="checked"' : '';
		$custom			= $instance['custom'] ? 'checked="checked"' : '';
		$float_photo	= $instance['float_photo'] ? 'checked="checked"' : '';

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e( 'Title: ', 'ts-fab' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('author'); ?>">
			<?php _e( 'Select Author:', 'ts-fab' ); ?>
		</label>
		<select class="widefat" id="<?php echo $this->get_field_id('author'); ?>" name="<?php echo $this->get_field_name('author'); ?>">
			<?php
				$blogusers = get_users( array(
					'blog_id' => $GLOBALS['blog_id'],
					'orderby' => 'nicename'
				) );
				foreach ( $blogusers as $user ) {
					$selected = ( $instance['author'] == $user->ID ) ? 'selected="selected"' : '';
					echo '<option value="' . $user->ID . '"' . $selected . '>' . $user->display_name . '</option>';
				}
				
				$selected = ( $instance['author'] == 'random' ) ? 'selected="selected"' : '';
				echo '<option value="random"' . $selected . '>' . __( 'Random author', 'ts-fab' ) . '</option>';
			?>
		</select></p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $bio; ?> id="<?php echo $this->get_field_id('bio'); ?>" name="<?php echo $this->get_field_name('bio'); ?>" />
			<label for="<?php echo $this->get_field_id('bio'); ?>"><?php _e( 'Bio tab', 'ts-fab' ); ?></label>
			<br/>

			<input class="checkbox" type="checkbox" <?php echo $twitter; ?> id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" />
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e( 'Twitter tab', 'ts-fab' ); ?></label>
			<br/>

			<input class="checkbox" type="checkbox" <?php echo $facebook; ?> id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" />
			<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e( 'Facebook tab', 'ts-fab' ); ?></label>
			<br/>

			<input class="checkbox" type="checkbox" <?php echo $googleplus; ?> id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" />
			<label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e( 'Google+ tab', 'ts-fab' ); ?></label>
			<br/>

			<input class="checkbox" type="checkbox" <?php echo $linkedin; ?> id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" />
			<label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e( 'LinkedIn tab', 'ts-fab' ); ?></label>
			<br/>

			<input class="checkbox" type="checkbox" <?php echo $latest_posts; ?> id="<?php echo $this->get_field_id('latest_posts'); ?>" name="<?php echo $this->get_field_name('latest_posts'); ?>" />
			<label for="<?php echo $this->get_field_id('latest_posts'); ?>"><?php _e( 'Latest posts tab', 'ts-fab' ); ?></label>
			<br/>

			<input class="checkbox" type="checkbox" <?php echo $custom; ?> id="<?php echo $this->get_field_id('custom'); ?>" name="<?php echo $this->get_field_name('custom'); ?>" />
			<label for="<?php echo $this->get_field_id('custom'); ?>"><?php _e( 'Custom tab', 'ts-fab' ); ?></label>
			<br/>
			<br/>
			
			<input class="checkbox" type="checkbox" <?php echo $float_photo; ?> id="<?php echo $this->get_field_id('float_photo'); ?>" name="<?php echo $this->get_field_name('float_photo'); ?>" />
			<label for="<?php echo $this->get_field_id('float_photo'); ?>"><?php _e( 'Float photo (uncheck for narrow sidebars)', 'ts-fab' ); ?></label>
			<br/>
		</p>

	<?php }
}