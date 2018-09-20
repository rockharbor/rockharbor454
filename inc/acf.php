<?php
// Hide for all users
//add_filter('acf/settings/show_admin', '__return_false');

////// Options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-Options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


////// ACF Custom backend CSS
function custom_acf_css() { ?>
<style type="text/css">
.no-label label {
	display: none !important;
}
</style>
<?php }
add_action('admin_head', 'custom_acf_css');


////// Google Maps
function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAGgEuoZLgUjeSvBCpDMs96irhLNu0sUpI'); //// Replace API
} add_action('acf/init', 'my_acf_init');


////// Get OEmbed Thumb
function get_video_thumbnail( $video_uri ) {
	$thumbnail_uri = '';
	// determine the type of video and the video id
	$video = parse_video_uri( $video_uri );
	// get youtube thumbnail
	if ( $video['type'] == 'youtube' )
		$thumbnail_uri = 'https://i.ytimg.com/vi/' . $video['id'] . '/maxresdefault.jpg';
	// get vimeo thumbnail
	if( $video['type'] == 'vimeo' )
		$thumbnail_uri = get_vimeo_thumbnail_uri( $video['id'] );
	// get default/placeholder thumbnail
	if( empty( $thumbnail_uri ) || is_wp_error( $thumbnail_uri ) )
		$thumbnail_uri = '';
	//return thumbnail uri
	return $thumbnail_uri;
}
function parse_video_uri( $url ) {
	$parse = parse_url( $url );
	$video_type = '';
	$video_id = '';
	
	if ( $parse['host'] == 'youtu.be' ) {
		$video_type = 'youtube';
		$video_id = ltrim( $parse['path'],'/' );
	}
	if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) {
		$video_type = 'youtube';
		parse_str( $parse['query'] );
		$video_id = $v;
		if ( !empty( $feature ) )
			$video_id = end( explode( 'v=', $parse['query'] ) );
		if ( strpos( $parse['path'], 'embed' ) == 1 )
			$video_id = end( explode( '/', $parse['path'] ) );
	}
	if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) {
		$video_type = 'vimeo';
		$video_id = ltrim( $parse['path'],'/' );
	}
	$host_names = explode(".", $parse['host'] );
	$rebuild = ( ! empty( $host_names[1] ) ? $host_names[1] : '') . '.' . ( ! empty($host_names[2] ) ? $host_names[2] : '');
	if ( ( $rebuild == 'wistia.com' ) || ( $rebuild == 'wi.st.com' ) ) {
		$video_type = 'wistia';
		if ( strpos( $parse['path'], 'medias' ) == 1 )
				$video_id = end( explode( '/', $parse['path'] ) );
	}
	if ( !empty( $video_type ) ) {
		$video_array = array(
			'type' => $video_type,
			'id' => $video_id
		);
		return $video_array;
	} else {
		return false;
	}
}
function get_vimeo_thumbnail_uri( $clip_id ) {
	$vimeo_api_uri = 'http://vimeo.com/api/v2/video/' . $clip_id . '.php';
	$vimeo_response = wp_remote_get( $vimeo_api_uri );
	if( is_wp_error( $vimeo_response ) ) {
		return $vimeo_response;
	} else {
		$vimeo_response = unserialize( $vimeo_response['body'] );
		return $vimeo_response[0]['thumbnail_large'];
	}
}
