<?php
/**
 * ROCKHARBOR Church functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ROCKHARBOR_Church
 */

if ( ! function_exists( 'rockharbor_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rockharbor_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ROCKHARBOR Church, use a find and replace
		 * to change 'rockharbor' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rockharbor', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'tiny', 60, 60, true );
		add_image_size( 'thumb_uncropped', 450, 9999 );
		add_image_size( 'medium_large', 1024, 1024 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'rockharbor' ),
			'header-default' => esc_html__( 'Header (default)', 'rockharbor' ),
			'header-mv' => esc_html__( 'Header MV', 'rockhabor' ),
			'header-char' => esc_html__( 'Header Char', 'rockharbor' ),
			'footer' => esc_html__( 'Footer', 'rockharbor' ),
			'campuses' => esc_html__( 'Campuses', 'rockharbor' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		/*
		add_theme_support( 'custom-background', apply_filters( 'rockharbor_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		*/

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		/*
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		*/
	}
endif;
add_action( 'after_setup_theme', 'rockharbor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rockharbor_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rockharbor_content_width', 640 );
}
add_action( 'after_setup_theme', 'rockharbor_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rockharbor_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'rockharbor' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'rockharbor' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'rockharbor_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rockharbor_scripts() {
	wp_enqueue_script( 'rockharbor-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js' );

	wp_enqueue_style( 'rockharbor-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory().'/style.css' ) );

	wp_enqueue_style( 'rockharbor-style-additional', get_template_directory_uri() . '/style-additional.css', array(), filemtime( get_stylesheet_directory().'/style-additional.css' ) );

	wp_enqueue_script( 'rockharbor-functions', get_template_directory_uri() . '/js/functions.min.js', array(), '27767446', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rockharbor_scripts' );


/**
 * Custom Taxonomies
 */
require get_template_directory() . '/inc/taxonomies.php';

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/acf.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress back-end.
 */
require get_template_directory() . '/inc/back-end.php';

/**
 * Functions which enhance the theme by hooking into WordPress front-end.
 */
require get_template_directory() . '/inc/front-end.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
