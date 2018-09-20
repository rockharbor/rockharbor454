<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ROCKHARBOR_Church
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rockharbor_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of current browser to body.
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';
	if($is_iphone) $classes[] = 'iphone';

	// Adds a class of no-sidebar when there is no sidebar present.
	//if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		//$classes[] = 'no-sidebar';
	//}
	
	$style = get_field('header_style');
	if ( is_front_page() || is_singular('campus') || is_page_template('templates/jesus.php') || $style == 'gradient' || $style == 'image' || $style == 'video' ) {
		$classes[] = 'dark-theme';
	}
	
	if( get_field('header_style') == 'none' || is_page_template('templates/messages.php') || is_singular('message') || is_tax() ) {
		$classes[] = 'no-page-header';
	}
	
	
	if (is_search()) { // remove dark-theme class to search results
		foreach ( $classes as $key => $value ) {
	        if ( $value == 'dark-theme' ) unset( $classes[ $key ] );
	    }
	}
	

	return $classes;
}
add_filter( 'body_class', 'rockharbor_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rockharbor_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'rockharbor_pingback_header' );


/**
 * Detect which logo to use based on body class
 */
function rockharbor_logo() {
	$classes = get_body_class();
	if (in_array('dark-theme',$classes)) { ?>
	    <img src="<?php bloginfo('template_url');?>/images/rockharbor-white-logo.svg" alt="<?php bloginfo('name');?>">
	<?php } else { ?>
	    <img src="<?php bloginfo('template_url');?>/images/rockharbor-black-logo.svg" alt="<?php bloginfo('name');?>">
	<?php }
}

/**
 * Load SVG files
 */
function svg( $url ) {
	echo file_get_contents(dirname(__DIR__) . "/images/$url.svg");
}

/**
 * Exclude Modules Pages from search
 */
add_action('pre_get_posts','exclude_posts_from_search');
function exclude_posts_from_search( $query ){
    if( $query->is_main_query() && is_search() ){
         //Exclude posts by ID
         $post_ids = array(574);
         $query->set('post__not_in', $post_ids);
    }
}


/**
 *  Only include in the podcast feed posts with podcast metadata (i.e. enclosure) set
 * This is the fix for the GUIDs changing in the migration. We'll only publish new episodes to the feed
 */
add_action( 'pre_get_posts', 'check_podcast_items_for_enclosure' );
function check_podcast_items_for_enclosure( $query ) {
	if ( $query->is_main_query() && $query->is_feed() && isset( $query->query['campuses'] ) ) {
		$query->set( 'meta_key', 'enclosure' );
	}
}