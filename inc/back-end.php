<?php
/**
 * Clean up Wordpress Header / Remove Unnecessary tags / Remove WP Emojis
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action ('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');


/**
 * Admin Bar changes
 */
function my_admin_bar( $wp_admin_bar ) {
	global $wp_admin_bar;
    $wp_admin_bar->remove_menu('customize'); // Remove Customize
	$wp_admin_bar->remove_node( 'wp-logo' ); // Remove Logo
	$wp_admin_bar->remove_node( 'updates' ); // Remove Updates
	$wp_admin_bar->remove_node( 'comments' ); // Remove Comments
	$wp_admin_bar->remove_node( 'search' ); // Remove Search
}
add_action( 'admin_bar_menu', 'my_admin_bar', 999 );


/**
 * Remove Howdy Text
 */
add_filter('gettext', 'change_howdy', 10, 3);
function change_howdy($translated, $text, $domain) {
    if (!is_admin() || 'default' != $domain)
        return $translated;
    if (false !== strpos($translated, 'Howdy, '))
        return str_replace('Howdy, ', '', $translated);
    return $translated;
}


/**
 * Hide Field Option
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );


/**
 * Load Custom CSS
 */
function backend_css() { ?>
<style type="text/css">
#teacherdiv, #seriesdiv, #campusesdiv { display: none !important;}
</style>
<?php }
add_action('admin_head', 'backend_css');


/**
 * Extend WordPress search to include custom fields
 */
function cf_search_join( $join ) {
    global $wpdb;
    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join' );
// Modify the search query with posts_where
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }
    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );
// Prevent duplicates
function cf_search_distinct( $where ) {
    global $wpdb;
    if ( is_search() ) {
        return "DISTINCT";
    }
    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );


/**
 * Extend WordPress search to include custom fields
 */
function my_post_title_updater( $post_id ) {
    $my_post = array();
    $my_post['ID'] = $post_id;
	$slug = get_the_title($post_id);
	
	if ( get_post_type() == 'message' ) {
		$campus = get_field('campus');
		$campus = get_term( $campus, 'campuses' );
	  
		if($campus->slug == 'costa-mesa') {
			$my_post['post_name'] = $slug;
		} else {
			$my_post['post_name'] = $slug . '_' . $campus->slug;
		}
    }
    // Update the post into the database
    wp_update_post( $my_post );
  }
add_action('acf/save_post', 'my_post_title_updater', 20);


/**
 * Change Wordpress Login Logo
 */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/wp-login-logo.png);
		height:100px;
		width:320px;
		background-size: auto 100px;
		background-repeat: no-repeat;
		padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


/**
 * Custom Column
 */
function add_series_columns($columns){
    $columns['poster'] = 'Poster';
    return $columns;
}
add_filter('manage_edit-series_columns', 'add_series_columns');

function add_series_column_content($content,$column_name,$term_id){
    $term= get_term($term_id, 'series');
    switch ($column_name) {
        case 'poster':
            $seriescover = get_field('thumbnail', $term->taxonomy . '_' . $term->term_id);
            $content = '<img src="'.wp_get_attachment_image_url( $seriescover, 'tiny' ).'">';
            break;
        default:
            break;
    }
    return $content;
}
add_filter('manage_series_custom_column', 'add_series_column_content',10,3);

/**
 * Gravity Forms
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );