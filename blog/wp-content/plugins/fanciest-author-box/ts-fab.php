<?php

/*
Plugin Name: Fanciest Author Box
Plugin URI: http://fanciestauthorbox.com
Description: The only author box plugin you'll ever need. Adds feature rich author box to your posts, can also be used as shortcode, widget or template tag. Fully customizable and translation ready. 
Version: 1.4.3
Author: ThematoSoup
Author URI: http://thematosoup.com
License: GPL2
*/


/*
 * Include files
 * Add action links in Plugins page
 * Add meta links in Plugins page
 * Helper functions for default settings
 * Add Fanciest Author Box to posts
 * Enqueue Fanciest Author Box scripts and styles
 */


// Define plugin version constant
define( 'FAB_VERSION', '1.4.3' );



if ( is_admin() ) {

	// Register plugin settings page
	require_once( dirname(__FILE__) . '/includes/ts-fab-settings.php' );
	
	// Add user settings
	require_once( dirname(__FILE__) . '/includes/ts-fab-user-settings.php' );
	
}

// Include tab constructor
require_once( dirname(__FILE__) . '/includes/ts-fab-construct-tabs.php' );

// Include widget
require_once( dirname(__FILE__) . '/includes/ts-fab-widget.php' );

// Load text domain
load_plugin_textdomain( 'ts-fab', false, 'fanciest-author-box/languages' );



/**
 * Add action links in Plugins page
 *
 * @since 1.0
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ts_fab_plugin_action_links' );
function ts_fab_plugin_action_links( $links ) {

	return array_merge(
		array(
			'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/tools.php?page=fanciest_author_box">' . __( 'Settings', 'ts-fab' ) . '</a>'
		),
		$links
	);

}



/**
 * Add meta links in Plugins page
 *
 * @since 1.0
 * @todo Figure out which links to use
 */
add_filter( 'plugin_row_meta', 'ts_fab_plugin_meta_links', 10, 2 );
function ts_fab_plugin_meta_links( $links, $file ) {

	$plugin = plugin_basename(__FILE__);
	
	// create link
	if ( $file == $plugin ) {
		return array_merge(
			$links,
			array( '<a href="http://twitter.com/thematosoup">Twitter</a>' )
		);
	}
	return $links;

}



/**
 * Helper functions to get default tabs
 *
 * @return	array
 * @since	1.4
 */
function ts_fab_default_tabs() {

	$default_tabs = array(
		'bio',
		'twitter',
		'facebook',
		'googleplus',
		'linkedin',
		'latest_posts',
		'custom'
	);
	
	return $default_tabs;

}



/**
 * Helper functions to get additional tabs
 *
 * @uses	apply_filters()
 * @return	array
 * @since	1.4
 */
function ts_fab_additional_tabs() {

	$additional_tabs = array();
	
	return apply_filters( 'ts_fab_additional_tabs_hook', $additional_tabs );

}




/**
 * Helper functions to get default option for Display Settings
 *
 * Default options are not stored in a database, these arrays are used instead, unless the option has been set
 *
 * @since 1.0
 */
function ts_fab_get_display_settings() {

	$default_display_settings = array(
		'show_in_posts'				=> 'below',
		'show_in_pages'				=> 'below',
		'show_in_feeds'				=> 'yes',
		'execution_priority'		=> 15,
		'tabs_style'				=> 'full',
		
		'inactive_tab_background'	=> '#e9e9e9',
		'inactive_tab_border'		=> '#e9e9e9',
		'inactive_tab_color'		=> '#333',
		
		'active_tab_background'		=> '#333',
		'active_tab_border'			=> '#333',
		'active_tab_color'			=> '#fff',
		
		'tab_content_background'	=> '#f9f9f9',
		'tab_content_border'		=> '#333',
		'tab_content_color'			=> '#555',
	);
	
	/* Get visible custom post types */
	$custom_post_types_display_settings = array();
	
	$args = array(
		'public'   => true,
		'_builtin' => false
	); 
	$output = 'names';
	$operator = 'and';
	$custom_post_types = get_post_types( $args, $output, $operator ); 
	
	foreach ( $custom_post_types  as $custom_post_type ) {
		$custom_post_types_display_settings['show_in_' . $custom_post_type] = ( 'below' );
	}
	
	$default_display_settings = array_merge( $default_display_settings, $custom_post_types_display_settings );


	$display_settings = wp_parse_args( get_option( 'ts_fab_display_settings' ), $default_display_settings );
	
	return $display_settings;

}



/**
 * Helper functions to get default option for Tabs Settings
 *
 * Default options are not stored in a database, these arrays are used instead, unless the option has been set
 *
 * @since 1.0
 */
function ts_fab_get_tabs_settings() {

	$default_tabs_settings = array(
		'bio'						=> 1,
		'twitter'					=> 1,
		'twitter_cache_interval'	=> 10,
		'twitter_bio'				=> 1,
		'twitter_tweet'				=> 1,
		'twitter_count'				=> 1,
		'facebook'					=> 1,
		'facebook_sdk'				=> 1,
		'googleplus'				=> 1,
		'linkedin'					=> 1,
		'latest_posts'				=> 1,
		'latest_posts_count'		=> 3,
		'custom'					=> 0,
		'custom_tab_override'		=> 'content',
		'tabs_settings_saved'		=> 0
	);

	// WordPress' checked function causes PHP notices when setting being checked in empty, in that case it's set to 0 value, to avoid the setting being empty and default being called
	$current_tabs_settings = get_option( 'ts_fab_tabs_settings' );
	
	// Check if settings have been saved already, this prevents getting default values when user deselects all the fields
	if( !isset( $current_tabs_settings['tabs_settings_saved'] ) ) {
	
		$tabs_settings = $default_tabs_settings;
		
	} else {
	
		foreach( array_keys( $default_tabs_settings ) as $tabs_setting ) {
			if ( !isset( $current_tabs_settings[$tabs_setting] ) ) { $current_tabs_settings[$tabs_setting] = 0; }
		}
	
		// Merge default and current settings
		$tabs_settings = wp_parse_args( $current_tabs_settings, $default_tabs_settings );
	
	}

	return $tabs_settings;

}



/**
 * Add Fanciest Author Box to post/page content
 *
 * @since 1.0
 */
$ts_fab_display_settings = ts_fab_get_display_settings();
add_filter( 'the_content', 'ts_fab_add_author_box', $ts_fab_display_settings['execution_priority'] );
function ts_fab_add_author_box( $content ) {

	global $authordata;
	global $post;
	
	// Use helper functions to get plugin settings
	$ts_fab_display_settings = ts_fab_get_display_settings();
	
	// Only show the ones that are checked (and not the ones with value = zero)
	$ts_fab_tabs_settings = array_keys( ts_fab_get_tabs_settings(), 1 );

	// Get all the tabs, uses apply_filters to allow tabs reordering
	$default_tabs = ts_fab_default_tabs(); // default tabs
	$additional_tabs = array_keys( ts_fab_additional_tabs() ); // additional tabs
	$all_tabs = apply_filters( 'ts_fab_reorder_tabs', array_merge( $default_tabs, $additional_tabs ) ); // all tabs, reordered
	
	$used_tabs = array();
	foreach( $all_tabs as $one_tab ) {
		// Check if tab option is checked
		if( in_array( $one_tab, $ts_fab_tabs_settings ) ) {
			$used_tabs[] = $one_tab;
		}		
	};
	
	if( !get_user_meta( $authordata->ID, 'ts_fab_user_hide', false ) && !get_post_meta( $post->ID, 'ts_fab_hide', false ) ) {

		// Show Fanciest Author Box in posts
		if( is_singular( 'post' ) ) {

			$show_in_posts = $ts_fab_display_settings['show_in_posts'];
			if( $show_in_posts == 'above' ) {
				$content = ts_fab_construct_fab( 'above-' . $post->ID, $authordata->ID, $used_tabs ) . $content;
			} elseif( $show_in_posts == 'below' ) {
				$content .= ts_fab_construct_fab( 'below-' . $post->ID, $authordata->ID, $used_tabs );
			} elseif( $show_in_posts == 'both' ) {
				$content = ts_fab_construct_fab( 'above-' . $post->ID, $authordata->ID,  $used_tabs ) . $content . ts_fab_construct_fab( 'below-' . $post->ID, $authordata->ID, $ts_fab_tabs_settings );
			}

		}

		// Show Fanciest Author Box in pages
		if( is_singular( 'page' ) ) {

			$show_in_pages = $ts_fab_display_settings['show_in_pages'];
			if( $show_in_pages == 'above' ) {
				$content = ts_fab_construct_fab( 'above-' . $post->ID, $authordata->ID, $used_tabs ) . $content;
			} elseif( $show_in_pages == 'below' ) {
				$content .= ts_fab_construct_fab( 'below-' . $post->ID, $authordata->ID, $used_tabs );
			} elseif( $show_in_pages == 'both' ) {
				$content = ts_fab_construct_fab( 'above-' . $post->ID, $authordata->ID, $used_tabs ) . $content . ts_fab_construct_fab( 'below-' . $post->ID, $authordata->ID, $ts_fab_tabs_settings );
			}

		}

		// Show Fanciest Author Box in custom post types
		$args = array(
			'public'   => true,
			'_builtin' => false
		); 
		$output = 'names';
		$operator = 'and';
		$custom_post_types = get_post_types( $args, $output, $operator ); 
		foreach ( $custom_post_types  as $custom_post_type ) {
			if( is_singular( $custom_post_type ) ) {
		
				$show_in_custom = $ts_fab_display_settings['show_in_' . $custom_post_type];
				if( $show_in_custom == 'above' ) {
					$content = ts_fab_construct_fab( 'above-' . $post->ID, $authordata->ID, $used_tabs ) . $content;
				} elseif( $show_in_custom == 'below' ) {
					$content .= ts_fab_construct_fab( 'below-' . $post->ID, $authordata->ID, $used_tabs );
				} elseif( $show_in_custom == 'both' ) {
					$content = ts_fab_construct_fab( 'above-' . $post->ID, $authordata->ID, $used_tabs ) . $content . ts_fab_construct_fab( 'below-' . $post->ID, $authordata->ID, $ts_fab_tabs_settings );
				}	
			
			}	
		}

	}

	// Remove filter after it has been used once, so it's not showing again in additional queries in sidebar or footer
	remove_filter( 'the_content', 'ts_fab_add_author_box' );
	
	return $content;

}



/**
 * Add Fanciest Author Box to feeds
 *
 * @since 1.3
 */
add_filter( 'the_content_feed', 'ts_fab_add_author_box_feeds' );
add_filter( 'the_excerpt_rss', 'ts_fab_add_author_box_feeds' );
function ts_fab_add_author_box_feeds( $content ) {
	
	global $authordata;
	global $post;
	
	// Use helper functions to get plugin settings
	$ts_fab_display_settings = ts_fab_get_display_settings();
	
	// Only show the ones that are checked (and not the ones with value = zero)
	$ts_fab_tabs_settings = array_keys( ts_fab_get_tabs_settings(), 1 );

	$show_in_feeds = $ts_fab_display_settings['show_in_feeds'];
	
	if( $show_in_feeds == 'yes' && !get_user_meta( $authordata->ID, 'ts_fab_user_hide', false ) && !get_post_meta( $post->ID, 'ts_fab_hide', false ) ) {

		// Show Fanciest Author Box in feeds
		$content .= ts_fab_construct_fab_feeds();
	
	}
	
	return $content;
	
}


/**
 * Enqueue Fanciest Author Box scripts and styles
 *
 * @since 1.0
 */
add_action( 'wp_enqueue_scripts', 'ts_fab_add_scripts_styles' );
function ts_fab_add_scripts_styles() {

	$css_url = plugins_url( 'css/ts-fab.min.css', __FILE__ );
	wp_register_style( 'ts_fab_css', $css_url, '', FAB_VERSION );
	wp_enqueue_style( 'ts_fab_css' );

	$js_url = plugins_url( 'js/ts-fab.min.js', __FILE__ );
	wp_register_script( 'ts_fab_js', $js_url, array( 'jquery' ), FAB_VERSION );
	wp_enqueue_script( 'ts_fab_js' );
	
}



/**
 * Print CSS for color options
 *
 * @since 1.0
 */
add_action( 'wp_head', 'ts_fab_print_color_settings' );
function ts_fab_print_color_settings() {

	$default_colors = array(
		'#e9e9e9',		// Inactive tab background
		'#e9e9e9',		// Inactive tab border
		'#333',			// Inactive tab text color
		
		'#333',			// Active tab background
		'#333',			// Active tab border
		'#fff',			// Active tab text color
		
		'#f9f9f9',		// Tab content background
		'#333',			// Tab content border
		'#555'			// Tab content text color
	);
	
	$options = ts_fab_get_display_settings();

	$current_colors = array(
		$options['inactive_tab_background'],
		$options['inactive_tab_border'],
		$options['inactive_tab_color'],
		
		$options['active_tab_background'],
		$options['active_tab_border'],
		$options['active_tab_color'],
		
		$options['tab_content_background'],
		$options['tab_content_border'],
		$options['tab_content_color'],
	);
	
	// Check if default colors should be used
	if( count( array_diff( $current_colors, $default_colors ) ) > 0 ) {
	?>
	<style>
	.ts-fab-list li a { background-color: <?php echo $options['inactive_tab_background']; ?>; border: 1px solid <?php echo $options['inactive_tab_border']; ?>; color: <?php echo $options['inactive_tab_color']; ?>; }
	.ts-fab-list li.active a { background-color: <?php echo $options['active_tab_background']; ?>; border: 1px solid <?php echo $options['active_tab_border']; ?>; color: <?php echo $options['active_tab_color']; ?>; }		
	.ts-fab-tab { background-color: <?php echo $options['tab_content_background']; ?>; border: 2px solid <?php echo $options['tab_content_border']; ?>; color: <?php echo $options['tab_content_color']; ?>; }		
	</style>
	<?php
	}
}



/**
 * Define template tag ts_fab()
 *
 * @since 1.0
 */
if( !function_exists( 'ts_fab' ) ) {
	
	function ts_fab(
		$context = 'template-tag-',
		$authorid = '',
		$tabs = ''
	) {
			
		// List of allowed tabs
		$default_tabs = ts_fab_default_tabs(); // default tabs
		$additional_tabs = array_keys( ts_fab_additional_tabs() ); // additional tabs
		$allowed_tabs = array_merge( $default_tabs, $additional_tabs ); // all tabs
	
		if( $tabs ) {
	
			$selected_tabs = explode( ',', $tabs );
	
			foreach( $selected_tabs as $selected_tab ) {
	
				// Remove space, if it exists
				$selected_tab = str_replace( ' ', '', $selected_tab );
	
				// If tab name is one of allowed tab names, add it to $show_tabs array
				if( in_array( $selected_tab, $allowed_tabs ) ) {
					$show_tabs[] = $selected_tab;
				}
			}
	
		} 
	
		// If no tabs are passed, use the ones set in Tabs Settings in plugin settings page
		if( !isset( $show_tabs ) ) $show_tabs = array_keys( ts_fab_get_tabs_settings(), 1 );
	
		$a = rand( 100, 999 );
		$b = rand( 100, 999 );
		$c = rand( 100, 999 );
	
		echo ts_fab_construct_fab( $context . $a . '-' . $b . '-' . $c, $authorid, $show_tabs );
		
	}
	
}



/**
 * Register Fanciest Author Box shortcode [ts_fab]
 *
 * @since 1.0
 */
add_shortcode( 'ts_fab', 'ts_fab_shortcode' );
function ts_fab_shortcode( $atts ) {

	extract( shortcode_atts( array(
		'authorid'		=> '',
		'tabs'			=> ''
	), $atts) );

	if( $authorid ) {
		$authorid = absint( $authorid );
	}

	// List of allowed tabs
	$default_tabs = ts_fab_default_tabs(); // default tabs
	$additional_tabs = array_keys( ts_fab_additional_tabs() ); // additional tabs
	$allowed_tabs = array_merge( $default_tabs, $additional_tabs ); // all tabs

	if( $tabs ) {

		$selected_tabs = explode( ',', $tabs );

		foreach( $selected_tabs as $selected_tab ) {

			// Remove empty spaces
			$selected_tab = str_replace( ' ', '', $selected_tab );

			// If tab name is one of allowed tab names, add it to $show_tabs array
			if( in_array( $selected_tab, $allowed_tabs ) ) {
				$show_tabs[] = $selected_tab;
			}
		}

	} 

	// If no tabs are passed, use the ones set in Tabs Settings in plugin settings page
	if( !isset( $show_tabs ) ) $show_tabs = array_keys( ts_fab_get_tabs_settings(), 1 );
	
	$a = rand( 100, 999 );
	$b = rand( 100, 999 );
	$c = rand( 100, 999 );

	return ts_fab_construct_fab( 'shortcode-' . $a . '-' . $b . '-' . $c, $authorid, $show_tabs );

}