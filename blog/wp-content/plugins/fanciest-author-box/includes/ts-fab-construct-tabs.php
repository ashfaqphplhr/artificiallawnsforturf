<?php


/**
 * Get author image
 * Returns author image, uses Gravatar as default, can be overridden using user custom field
 *
 * @since 1.2
 */

function ts_fab_get_author_image( $author ){

	if( get_user_meta( $author->ID, 'ts_fab_photo_url', true) ) {
		$authorimg = '<img src="' . get_user_meta( $author->ID, 'ts_fab_photo_url', true) . '" width="64" alt="' . esc_attr( $author->display_name ) . '" />';
	} else {
		$authorimg = get_avatar( $author->ID, 64, '', esc_attr( $author->display_name ) );
	}
	
	return $authorimg;
	
}



/**
 * Construct bio tab
 *
 * @since 1.0
 */
function ts_fab_show_bio( $context = '', $authorid = '' ) {

	// Grab settings
	$ts_fab_settings = ts_fab_get_tabs_settings();

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}

	// Hook to allow changing of author bio
	$author = apply_filters( 'ts_fab_show_author_bio_hook', $author );
		
	// Create Fanciest Author Box output
	$ts_fab_bio = '
	<div class="ts-fab-tab" id="ts-fab-bio-' . $context . '">
		<div class="ts-fab-avatar">' . ts_fab_get_author_image( $author ) . '</div>
		<div class="ts-fab-text">
			<div class="ts-fab-header">';
			
			if( $author->user_url ) {
				$ts_fab_bio .= '<h4><a href="' . $author->user_url . '">' . $author->display_name . '</a></h4>';
			} else {
				$ts_fab_bio .= '<h4>' . $author->display_name . '</h4>';
			}
			
			if( get_user_meta( $author->ID, 'ts_fab_position', true) ) {
				$ts_fab_bio .= '<div class="ts-fab-description"><span>' . get_user_meta( $author->ID, 'ts_fab_position', true) . '</span>';
				
				if( get_user_meta( $author->ID, 'ts_fab_company', true) ) {
					if( get_user_meta( $author->ID, 'ts_fab_company_url', true) ) {
						$ts_fab_bio .= ' ' . __( 'at', 'ts-fab' ) . ' <a href="' . esc_url( get_user_meta( $author->ID, 'ts_fab_company_url', true) ) . '">';
							$ts_fab_bio .= '<span>' . get_user_meta( $author->ID, 'ts_fab_company', true) . '</span>';
						$ts_fab_bio .= '</a>';
					} else {
						$ts_fab_bio .= ' ' . __( 'at', 'ts-fab' ) . ' <span>' . get_user_meta( $author->ID, 'ts_fab_company', true) . '</span>';
					}
				}
				
				$ts_fab_bio .= '</div>';
			}
			
			$ts_fab_bio .= '</div><!-- /.ts-fab-header -->';
			$ts_fab_bio .= '<div class="ts-fab-content">' . $author->user_description . '</div>
		</div>
	</div>';

	return $ts_fab_bio;

}



/**
 * Add links to usernames, hashtags and URLs in latest tweet
 *
 * @since 1.0
 */
function ts_fab_link_twitter( $status, $target_blank = true, $max_link_length = 250 ) {
 
	$target = $target_blank ? " target=\"_blank\"" : "";

	$status = preg_replace( "/((http:\/\/|https:\/\/)[^ )\r\n]+)/e", "'<a href=\"$1\" title=\"$1\"  $target >'. ( (strlen( '$1' ) >= $max_link_length ? substr( '$1', 0, $max_link_length ) . '...' : '$1' ) ).'</a>'", $status );
	
	$status = preg_replace( "/(@([_a-z0-9\-]+))/i", "<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>", $status );
	
	$status = preg_replace( "/(#([_a-z0-9\-]+))/i", "<a href=\"http://twitter.com/search/?q=%23$2\" title=\"Search $1\" $target >$1</a>", $status);
	
	return $status;
    
}



/**
 * Construct Twitter tab
 *
 * @since 1.0
 */
function ts_fab_show_twitter( $context = '', $authorid = '' ) {

	// Grab settings
	$ts_fab_settings = ts_fab_get_tabs_settings();

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}
	
	// Check if author has entered twitter username into WordPress profile
	if( get_user_meta( $author->ID, 'ts_fab_twitter', true) ) {

		$screen_name = get_user_meta( $author->ID, 'ts_fab_twitter', true);
		
		// Check if Twitter request response is cached
		$latest_tweet = get_transient( 'ts_fab_twitter-' . $author->ID );
		
		// Get latest tweet username, if it exists, to avoid PHP notice
		if( isset( $latest_tweet->user->screen_name ) ) {
			$latest_tweet_user = $latest_tweet->user->screen_name;
		} else {
			$latest_tweet_user = false;
		}

		// If not, make a Twitter API call, cache the response
		if ( false === $latest_tweet || strtolower( get_user_meta( $author->ID, 'ts_fab_twitter', true) ) != strtolower( $latest_tweet_user ) ) {

			$api_call = 'https://api.twitter.com/1/statuses/user_timeline.json?screen_name=' . get_user_meta( $author->ID, 'ts_fab_twitter', true);

			// Unsetting the variable, if user changes Twitter username
			unset( $latest_tweet );
			
			$response = wp_remote_get( $api_call, array( 'sslverify' => false ) );
			
			if ( !is_wp_error( $response ) && isset( $response['body'] ) && !isset( $response['error'] ) ) {
				$body = $response['body'];
				
				$twitter_info = json_decode( $body );
				
				// Check if Twitter API returned an error by making sure latest tweet text exists
				if( is_array( $twitter_info ) && isset( $twitter_info[0]->text ) ) {
					$latest_tweet = $twitter_info[0];				
					$cache_int = $ts_fab_settings['twitter_cache_interval'] * 60;
					set_transient( 'ts_fab_twitter-' . $author->ID, $latest_tweet, $cache_int );
				}
			}

		}
		
		// Store information we plan to use as variables
		if( isset( $latest_tweet ) && '' != $latest_tweet ) {
			$status = $latest_tweet->text;
			$tweet_time = $latest_tweet->created_at;
			if( isset( $latest_tweet->user->description ) ) $description = $latest_tweet->user->description;
		} else {
			$status = __( '<!-- Couldn\'t fetch latest tweet -->', 'ts-fab' );
		}

		// Create Fanciest Author Box output
		$ts_fab_twitter = '
		<div class="ts-fab-tab" id="ts-fab-twitter-' . $context . '">
			<div class="ts-fab-avatar">' . ts_fab_get_author_image( $author ) . '</div>
			<div class="ts-fab-text">
				<div class="ts-fab-header">
					<h4><a href="http://twitter.com/' . $screen_name . '">@' . $screen_name . '</a></h4>';
					if( $ts_fab_settings['twitter_bio'] == 1 && isset( $description ) ) {
						$ts_fab_twitter .= '<div class="ts-fab-description">' . ts_fab_link_twitter( $description ) . '</div>';
					}
				$ts_fab_twitter .= '</div><!-- /.ts-fab-header -->';
				if( $ts_fab_settings['twitter_tweet'] == 1 ) {
					$ts_fab_twitter .= '<div class="ts-fab-content">';
						$ts_fab_twitter .= ts_fab_link_twitter( $status ); 
						if( isset( $tweet_time ) ) { $ts_fab_twitter .= '<span class="ts-fab-twitter-time"> - ' . human_time_diff( strtotime( $tweet_time ), time( 'U' ) ) . ' ago</span>'; }
					$ts_fab_twitter .= '</div>';
				}
				$show_count = $ts_fab_settings['twitter_count'] == 1 ? ' data-show-count="true" ' : ' data-show-count="false" ';
				$ts_fab_twitter .= '<div class="ts-fab-follow"><a href="https://twitter.com/' . $screen_name . '" class="twitter-follow-button"' . $show_count . 'data-lang="' . get_locale() . '">Follow @' . $screen_name . '</a></div>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>';
		
		return $ts_fab_twitter;

	}

}



/**
 * Construct Facebook tab
 *
 * @since 1.0
 */
function ts_fab_show_facebook( $context = '', $authorid = '' ) {

	// Grab settings
	$ts_fab_settings = ts_fab_get_tabs_settings();

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}
	
	// In widget, show box_count version, because of width
	$pos = strpos( $context, 'widget' );
	if( $pos !== false ) {
		$layout = 'button_count';
	} else {
		$layout = 'standard';
	}
	
	// Check if author has entered Facebook ID into WordPress profile
	if( get_user_meta( $author->ID, 'ts_fab_facebook', true) ) {

		// Create Fanciest Author Box output
		$ts_fab_facebook = '';
		
		$ts_fab_facebook .= '<div class="ts-fab-tab" id="ts-fab-facebook-' . $context . '">
			<div class="ts-fab-avatar">' . ts_fab_get_author_image( $author ) . '</div>
			<div class="ts-fab-text">';

			// Don't load Javascript SDK if not needed
			if( $ts_fab_settings['facebook_sdk'] != 1 ) {
				$ts_fab_facebook .= '
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/' . get_locale() . '/all.js#xfbml=1";
					fjs.parentNode.insertBefore(js, fjs);
					}(document, \'script\', \'facebook-jssdk\'));</script>
				';
			}

			if( get_user_meta( $author->ID, 'ts_fab_facebook_button', true) == 'like' ) { 
				$ts_fab_facebook .= '
				<div class="fb-like" data-href="http://www.facebook.com/' . get_user_meta( $author->ID, 'ts_fab_facebook', true) . '" data-send="false" data-show-faces="false" data-layout="' . $layout . '"></div>
				';
			} else {
				$ts_fab_facebook .= '
				<div class="ts-fab-header">
					<h4><a href="http://www.facebook.com/' . get_user_meta( $author->ID, 'ts_fab_facebook', true) . '">' . $author->display_name . '</a></h4>
				</div>
				<div class="fb-subscribe" data-href="http://www.facebook.com/' . get_user_meta( $author->ID, 'ts_fab_facebook', true) . '" data-show-faces="false" data-width="320" data-layout="' . $layout . '"></div>
				';
			}
			$ts_fab_facebook .= '</div>
		</div>';

		return $ts_fab_facebook;

	}

}



/**
 * Construct Google+ tab
 *
 * @since 1.0
 */
function ts_fab_show_googleplus( $context = '', $authorid = '' ) {

	// Grab settings
	$ts_fab_settings = ts_fab_get_tabs_settings();

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}

	// Check if author has entered Google+ ID into WordPress profile
	if( get_user_meta( $author->ID, 'ts_fab_googleplus', true) ) {
	
		// Create Fanciest Author Box output
		$ts_fab_googleplus = '
		<div class="ts-fab-tab" id="ts-fab-googleplus-' . $context . '">
			<div class="ts-fab-avatar">' . ts_fab_get_author_image( $author ) . '</div>
			<div class="ts-fab-text">
				<div class="ts-fab-header">
					<h4><a href="https://plus.google.com/' . get_user_meta( $author->ID, 'ts_fab_googleplus', true ) . '?rel=author">+' . $author->display_name . '</a></h4>
				</div><!-- /.ts-fab-header -->';

				$pos = strpos( $context, 'widget' );
				if( $pos !== false ) {
					$width = 170;
				} else {
					$width = 320;
				}
		
				$ts_fab_googleplus .= '
				<g:plus href="https://plus.google.com/' . get_user_meta( $author->ID, 'ts_fab_googleplus', true ) . '" width="' . $width . '" height="69" ></g:plus>
			</div>
		</div>';

		return $ts_fab_googleplus;

	}

}



/**
 * Add scripts required for Google+ add to circles button
 *
 * Called by ts_fab_construct_fab function, added to wp_print_footer_scripts if needed
 *
 * @since 1.0
 */
function ts_fab_googleplus_head() { ?>

	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>

<?php }



/**
 * Construct Google+ tab
 *
 * @since 1.3
 */
function ts_fab_show_linkedin( $context = '', $authorid = '' ) {

	// Grab settings
	$ts_fab_settings = ts_fab_get_tabs_settings();

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}

	// Check if author has entered LinkedIn username into WordPress profile
	if( get_user_meta( $author->ID, 'ts_fab_linkedin', true) ) {
	
		// Create Fanciest Author Box output
		$ts_fab_linkedin = '
		<div class="ts-fab-tab" id="ts-fab-linkedin-' . $context . '">
			<div class="ts-fab-avatar">' . ts_fab_get_author_image( $author ) . '</div>
			<div class="ts-fab-text">
				<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>';
			
				$pos = strpos( $context, 'widget' );
				if( $pos !== false ) {
					$ts_fab_linkedin .= '
					<script type="IN/MemberProfile" data-id="http://www.linkedin.com/in/' . get_user_meta( $author->ID, 'ts_fab_linkedin', true ) . '" data-format="hover" data-text="' . $author->display_name . '" data-related="false"></script>';
				} else {
					$ts_fab_linkedin .= '
					<script type="IN/MemberProfile" data-id="http://www.linkedin.com/in/' . get_user_meta( $author->ID, 'ts_fab_linkedin', true ) . '" data-format="inline" data-related="false"></script>';
				}

			$ts_fab_linkedin .= '
			</div>
		</div>';

		return $ts_fab_linkedin;

	}

}




/**
 * Construct latest posts tab
 *
 * @since 1.0
 */
function ts_fab_show_latest_posts( $context = '', $authorid = '' ) {

	// Grab settings
	$ts_fab_settings = ts_fab_get_tabs_settings();

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}
	
	// Hook for custom post types selection
	$post_types = apply_filters( 'ts_fab_show_latest_posts_type_hook', array( 'post' ) );

	$latest_by_author = new WP_Query( array(
		'posts_per_page' => $ts_fab_settings['latest_posts_count'],
		'author' => $author->ID,
		'post_type' => $post_types
	) );

	// Create Fanciest Author Box output
	$ts_fab_latest = '
	<div class="ts-fab-tab" id="ts-fab-latest-posts-' . $context . '">
		<div class="ts-fab-avatar">' . ts_fab_get_author_image( $author ) . '</div>
		<div class="ts-fab-text">
			<div class="ts-fab-header">
				<h4>' . __( 'Latest posts by ', 'ts-fab' ) . $author->display_name . ' <span class="latest-see-all">(<a href="' . get_author_posts_url( $author->ID ) . '">' . __( 'see all', 'ts-fab' ) . '</a>)</span></h4>
			</div>
			<ul class="ts-fab-latest">';
		
			while ( $latest_by_author->have_posts() ) : $latest_by_author->the_post();
				global $post;
				$ts_fab_latest .= '
				<li>
					<a href="' . get_permalink() . '">' . get_the_title() . '</a><span> - ' .  
					date_i18n( get_option( 'date_format' ), get_the_time( 'U' ) ) . '</span> 
				</li>';
			endwhile;
			wp_reset_postdata();
	
		$ts_fab_latest .= '
		</ul></div>
	</div>';

	return $ts_fab_latest;

}



/**
 * Construct custom tab
 *
 * @since 1.2
 */
function ts_fab_show_custom( $context = '', $authorid = '' ) {

	// Grab settings
	$ts_fab_settings = ts_fab_get_tabs_settings();

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}
	
	// Set custom tab content, based on whether users can override it
	if( $ts_fab_settings['custom_tab_override'] == 1 || $ts_fab_settings['custom_tab_override'] == 'content' ) {
		if( get_user_meta( $author->ID, 'ts_fab_custom_tab_content', true) ) {
			$custom_content = get_user_meta( $author->ID, 'ts_fab_custom_tab_content', true );
		} elseif( $ts_fab_settings['custom_tab_content'] != '' ) {
			$custom_content = $ts_fab_settings['custom_tab_content'];
		}
	} elseif( $ts_fab_settings['custom_tab_content'] != '' ) {
		$custom_content = $ts_fab_settings['custom_tab_content'];
	}

	// Create Fanciest Author Box output
	$ts_fab_custom = '
	<div class="ts-fab-tab" id="ts-fab-custom-' . $context . '">
		<div class="ts-fab-avatar">' . ts_fab_get_author_image( $author ) . '</div>
		<div class="ts-fab-text">';
			if( isset( $custom_content ) ) $ts_fab_custom .= $custom_content;
		$ts_fab_custom .= '</div>
	</div>';

	return $ts_fab_custom;

}



/**
 * Construct Fanciest Author Box
 * Used as helper function, to generate Fanciest Author Box before or after posts, as shortcode, widget or template tag
 *
 * @since 1.0
 */
function ts_fab_construct_fab ( 
	$context = '',
	$authorid = '',
	$show_tabs = array(
		'bio',
		'twitter',
		'facebook',
		'googleplus',
		'linkedin',
		'latest_posts',
		'custom'
	)
) {

	if( $authorid == '' ) {
		global $authordata;
		$author = $authordata;
	} else {
		$author = get_userdata( $authorid );
	}

	$options = ts_fab_get_tabs_settings();
	$display_options = ts_fab_get_display_settings();
	
	if( isset( $display_options['tabs_style'] ) && $display_options['tabs_style'] == 'icons' ) {
		$tabs_class = 'ts-fab-icons-only';
	} else {
		$tabs_class = 'ts-fab-icons-text';	
	}
	
	// Set custom tab title, based on whether users can override it
	if(  isset( $options['custom_tab_override'] ) && $options['custom_tab_override'] == 1 ) {
		if( get_user_meta( $author->ID, 'ts_fab_custom_tab_title', true) ) {
			$custom_title = get_user_meta( $author->ID, 'ts_fab_custom_tab_title', true );
		} elseif( $options['custom_tab_title'] != '' ) {
			$custom_title = $options['custom_tab_title'];
		}
	} elseif( isset( $options['custom_tab_title'] ) ) {
		$custom_title = $options['custom_tab_title'];
	}
	
	$ts_fab = '<!-- Fanciest Author Box v' . FAB_VERSION . ' -->';
	$ts_fab .= '<div id="ts-fab-' . $context . '" class="ts-fab-wrapper ' . $tabs_class . '">';

		// Do not show tabs list if there's only one tab
		if( count( $show_tabs ) > 1 ) {

			// Construct tabs list
			$ts_fab .= '<ul class="ts-fab-list">';

				foreach( $show_tabs as $show_tab ) {

					// Check if it's a default tab
					if( in_array( $show_tab, ts_fab_default_tabs() ) ) {

						switch( $show_tab ) {
	
							case 'bio':
								$ts_fab .= '<li class="ts-fab-bio-link"><a href="#ts-fab-bio-' . $context . '">' . __( 'Bio', 'ts-fab' ) . '</a></li>';
								break;
	
							case 'twitter':
								// Check if Twitter tab needs to be shown and user has entered Twitter details
								if( in_array( 'twitter', $show_tabs ) && get_user_meta( $author->ID, 'ts_fab_twitter', true) ) {
									$ts_fab .= '<li class="ts-fab-twitter-link"><a href="#ts-fab-twitter-' . $context . '">Twitter</a></li>';
								}
								break;
	
							case 'googleplus':
								// Check if Google+ tab needs to be shown and user has entered Google+ details
								if( in_array( 'googleplus', $show_tabs ) && get_user_meta( $author->ID, 'ts_fab_googleplus', true) ) {
									add_action( 'wp_print_footer_scripts', 'ts_fab_googleplus_head' );
									$ts_fab .= '<li class="ts-fab-googleplus-link"><a href="#ts-fab-googleplus-' . $context . '">Google+</a></li>';
								}
								break;
	
							case 'facebook':
								// Check if Facebook tab needs to be shown and user has entered Facebook details
								if( in_array( 'facebook', $show_tabs ) && get_user_meta( $author->ID, 'ts_fab_facebook', true) ) {
									$ts_fab .= '<li class="ts-fab-facebook-link"><a href="#ts-fab-facebook-' . $context . '">Facebook</a></li>';
								}
								break;
	
							case 'linkedin':
								// Check if LinkedIn tab needs to be shown and user has entered LinkedIn details
								if( in_array( 'linkedin', $show_tabs ) && get_user_meta( $author->ID, 'ts_fab_linkedin', true) ) {
									$ts_fab .= '<li class="ts-fab-linkedin-link"><a href="#ts-fab-linkedin-' . $context . '">LinkedIn</a></li>';
								}
								break;
	
							case 'latest_posts':
								$ts_fab .= '<li class="ts-fab-latest-posts-link"><a href="#ts-fab-latest-posts-' . $context . '">' . __( 'Latest Posts', 'ts-fab' ) . '</a></li>';
								break;
	
							case 'custom':
								if( $options['custom'] == 1 ) {
									
									if( in_array( 'custom', $show_tabs ) ) {
										if( isset( $custom_title ) ) {
											$ts_fab .= '<li class="ts-fab-custom-link"><a href="#ts-fab-custom-' . $context . '">' . strip_tags( stripslashes( $custom_title ) ) . '</a></li>';
										}
									}
								}
								break;
	
						} // end switch
					
					// else it's an additional tab
					} else {
						
						// Tabs added by themes or other plugins
						$additional_tabs = ts_fab_additional_tabs();
						// Check if there are any additional tabs
						if( !empty( $additional_tabs ) ) {
							foreach( $additional_tabs as $additional_tab_key => $additional_tab_value ) {
						
								// Check if checkbox for this tab is checked
								if( isset( $options[$additional_tab_key] ) && $show_tab == $additional_tab_key ) {

									// Check tab conditional function to determine whether tab should be shown for this user
									if( isset( $additional_tab_value['conditional_callback'] ) ) {
										// Sets a flag based on what conditional function returns
										$conditional_function_output = $additional_tab_value['conditional_callback']( $author->ID );
									} // end conditional function check
										
									// Show tab if conditional function doesn't return false
									if( isset( $conditional_function_output ) && !$conditional_function_output == false ) {
	
										$ts_fab .= '<li class="ts-fab-' . $additional_tab_key . '-link ts-fab-additional-link"><a href="#ts-fab-' . $additional_tab_key . '-' . $context . '">' . strip_tags( stripslashes( $additional_tab_value['name'] ) ) . '</a></li>';
										
									} // End conditional flag check
								
								} // end check if option is checked
								
							} // end foreach
						} // end if
						
					}

				} // end foreach
				
			$ts_fab .= '</ul>';

		} // End if only one tab check

		// Construct individual tabs
		$ts_fab .= '<div class="ts-fab-tabs">';

			foreach( $show_tabs as $show_tab ) {

				// Check if it's a default tab
				if( in_array( $show_tab, ts_fab_default_tabs() ) ) {
				
					switch( $show_tab ) {
	
						case 'bio':
							$ts_fab .= ts_fab_show_bio( $context, $author->ID );
							break;
	
						case 'twitter':
							// Check if Twitter tab needs to be shown and user has entered Twitter details
							if( get_user_meta( $author->ID, 'ts_fab_twitter', true) ) {
								$ts_fab .= ts_fab_show_twitter( $context, $author->ID );
							}
							break;
							
						case 'facebook':
							// Check if Facebook tab needs to be shown and user has entered Facebook details
							if( get_user_meta( $author->ID, 'ts_fab_facebook', true) ) {
								$ts_fab .= ts_fab_show_facebook( $context, $author->ID );
							}
							break;
	
						case 'googleplus':
							// Check if Google+ tab needs to be shown and user has entered Google+ details
							if( get_user_meta( $author->ID, 'ts_fab_googleplus', true) ) {
								$ts_fab .= ts_fab_show_googleplus( $context, $author->ID );
							}
							break;
	
						case 'linkedin':
							// Check if LinkedIn tab needs to be shown and user has entered LinkedIn details
							if( get_user_meta( $author->ID, 'ts_fab_linkedin', true) ) {
								$ts_fab .= ts_fab_show_linkedin( $context, $author->ID );
							}
							break;
	
						case 'latest_posts':
							$ts_fab .= ts_fab_show_latest_posts( $context, $author->ID );
							break;
	
						case 'custom':
							$ts_fab .= ts_fab_show_custom( $context, $author->ID );
							break;
	
					} // end switch
					
				// else, it's an additional tab
				} else {

					// Tabs added by themes or other plugins
					$additional_tabs = ts_fab_additional_tabs();
					// Check if there are any additional tabs
					if( !empty( $additional_tabs ) ) {
						foreach( $additional_tabs as $additional_tab_key => $additional_tab_value ) {
						
							if( $show_tab == $additional_tab_key ) {
							
								// Check tab conditional function to determine whether tab should be shown for this user
								if( isset( $additional_tab_value['conditional_callback'] ) ) {
									// Sets a flag based on what conditional function returns
									$conditional_function_output = $additional_tab_value['conditional_callback']( $author->ID );
								} // end conditional function check

								// Show tab if conditional function doesn't return false
								if( isset( $conditional_function_output ) && !$conditional_function_output == false ) {

									$ts_fab .= '
									<div class="ts-fab-tab ts-fab-additional-tab" id="ts-fab-' . $additional_tab_key . '-' . $context . '">';
										// Additional tab callback function
										$ts_fab .= $additional_tab_value['callback']();
									$ts_fab .= '</div>';
								
								}  // End conditional flag check
							}
							
						} // end foreach
					} // end if
				
				}

			} // end foreach

		$ts_fab .= '
		</div>
	</div>';

	return $ts_fab;

}



/**
 * Construct Fanciest Author Box for feeds
 * Used as helper function, to generate simplified author box for feeds
 *
 * @since 1.3
 */
function ts_fab_construct_fab_feeds() {
	
	global $authordata;
	$author = $authordata;

	$ts_fab_feed = '<h3>' . __( 'Author information', 'ts-fab' ) . '</h3>';
	
	$ts_fab_feed .= '<div class="ts-fab-wrapper" style="overflow:hidden">';
	
		$ts_fab_feed .= '<div class="ts-fab-photo" style="float:left;width:64px">';
			$ts_fab_feed .= ts_fab_get_author_image( $author );
		$ts_fab_feed .= '</div><!-- /.ts-fab-photo -->';

		
		$ts_fab_feed .= '<div class="ts-fab-text" style="margin-left:74px">';
			$ts_fab_feed .= '<div class="ts-fab-header">';
				if( $author->user_url ) {
					$ts_fab_feed .= '<div style="font-size: 1.25em;margin-bottom:0"><strong><a href="' . $author->user_url . '">' . $author->display_name . '</a></strong></div>';
				} else {
					$ts_fab_feed .= '<div style="font-size: 1.25em;margin-bottom:0"><strong>' . $author->display_name . '</strong></div>';
				}
				
				if( get_user_meta( $author->ID, 'ts_fab_position', true) ) {
					$ts_fab_feed .= '<div class="ts-fab-description" style="margin-bottom:0.5em"><em><span>' . get_user_meta( $author->ID, 'ts_fab_position', true) . '</span>';
					
					if( get_user_meta( $author->ID, 'ts_fab_company', true) ) {
						if( get_user_meta( $author->ID, 'ts_fab_company_url', true) ) {
							$ts_fab_feed .= ' ' . __( 'at', 'ts-fab' ) . ' <a href="' . esc_url( get_user_meta( $author->ID, 'ts_fab_company_url', true) ) . '">';
								$ts_fab_feed .= '<span>' . get_user_meta( $author->ID, 'ts_fab_company', true) . '</span>';
							$ts_fab_feed .= '</a>';
						} else {
							$ts_fab_feed .= ' ' . __( 'at', 'ts-fab' ) . ' <span>' . get_user_meta( $author->ID, 'ts_fab_company', true) . '</span>';
						}
					}
					
					$ts_fab_feed .= '</em></div>';
				}
			$ts_fab_feed .= '</div><!-- /.ts-fab-header -->';
			
			$ts_fab_feed .= '<div class="ts-fab-content" style="margin-bottom:0.5em">' . $author->user_description . '</div>';
		
			$ts_fab_feed .= '<div class="ts-fab-footer">';
			// Twitter link
			if( get_user_meta( $author->ID, 'ts_fab_twitter', true) ) {
				$ts_fab_feed .= '<a style="margin-right:1.25em" href="http://twitter.com/' . get_user_meta( $author->ID, 'ts_fab_twitter', true) . '">Twitter</a>';
			}
			
			// Facebook link
			if( get_user_meta( $author->ID, 'ts_fab_facebook', true) ) {
				$ts_fab_feed .= '<a style="margin-right:1.25em" href="http://www.facebook.com/' . get_user_meta( $author->ID, 'ts_fab_facebook', true) . '">Facebook</a>';
			}
			
			// Google+ link
			if( get_user_meta( $author->ID, 'ts_fab_googleplus', true) ) {
				$ts_fab_feed .= '<a style="margin-right:1.25em" href="http://plus.google.com/' . get_user_meta( $author->ID, 'ts_fab_googleplus', true) . '">Google+</a>';
			}
			
			// LinkedIn link
			if( get_user_meta( $author->ID, 'ts_fab_linkedin', true) ) {
				$ts_fab_feed .= '<a style="margin-right:1.25em" href="http://www.linkedin.com/in/' . get_user_meta( $author->ID, 'ts_fab_linkedin', true) . '">LinkedIn</a>';
			}
			$ts_fab_feed .= '</div><!-- /.ts-fab-footer -->';
		$ts_fab_feed .= '</div><!-- /.ts-fab-text -->';

	$ts_fab_feed .= '</div><!-- /.ts-fab-wrapper -->';
	
	return $ts_fab_feed;
	
}