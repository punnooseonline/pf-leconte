<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * lecontecenter functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */

/**
 * lecontecenter only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'lecontecenter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own lecontecenter_setup() function to override in a child theme.
 *
 * @since lecontecenter 1.0
 */
function lecontecenter_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/lecontecenter
	 * If you're building a theme based on lecontecenter, use a find and replace
	 * to change 'lecontecenter' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lecontecenter' );

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
	 * Enable support for custom logo.
	 *
	 *  @since lecontecenter 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lecontecenter' ),
		'secondary'  => __( 'Secondary Menu', 'lecontecenter' ),
		'quick_links'  => __( 'Quick Links Menu', 'lecontecenter' ),
		'site_map'  => __( 'Site Map Menu', 'lecontecenter' ),
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

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', lecontecenter_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // lecontecenter_setup
add_action( 'after_setup_theme', 'lecontecenter_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since lecontecenter 1.0
 */
function lecontecenter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lecontecenter_content_width', 840 );
}
add_action( 'after_setup_theme', 'lecontecenter_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since lecontecenter 1.0
 */
function lecontecenter_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Site Notice', 'lecontecenter' ),
		'id'            => 'sidebar-site-notice',
		'description'   => __( 'Add widgets here to appear in your site notice area.', 'lecontecenter' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'lecontecenter' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lecontecenter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'lecontecenter' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'lecontecenter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'lecontecenter' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'lecontecenter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Section', 'lecontecenter' ),
		'id'            => 'footer_section',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'lecontecenter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
}
add_action( 'widgets_init', 'lecontecenter_widgets_init' );

if ( ! function_exists( 'lecontecenter_fonts_url' ) ) :
/**
 * Register Google fonts for lecontecenter.
 *
 * Create your own lecontecenter_fonts_url() function to override in a child theme.
 *
 * @since lecontecenter 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function lecontecenter_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'lecontecenter' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'lecontecenter' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'lecontecenter' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since lecontecenter 1.0
 */
function lecontecenter_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'lecontecenter_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since lecontecenter 1.0
 */
function lecontecenter_scripts() {
	//bootstrap css
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '20160816' );
	
	//if its coupon details page
	if('coupon' == get_post_type() &&  is_single() == true){
		//do nothing
	}
	else{
		// Add custom fonts, used in the main stylesheet.
		wp_enqueue_style( 'custom-plugin', get_template_directory_uri() . '/css/plugin.css', array(), '20160816' );
		wp_enqueue_style( 'shell-style', get_template_directory_uri() . '/css/shell.css', array(), '202007271453' );
	}	
	
	//font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '20160816' );
	
	// Theme stylesheet.
	wp_enqueue_style( 'lecontecenter-style', get_stylesheet_uri() );

	wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/custom.js', array('jquery'), '20160816', true );

	wp_localize_script('custom-scripts', 'valueObject', array( 'siteUrl' => site_url(), 'ajaxUrl' => admin_url( 'admin-ajax.php' ), 'themeUrl' => get_template_directory_uri() ) );
	

	wp_enqueue_script( 'custom-plugin', get_template_directory_uri() . '/js/plugin.js', array('jquery'), '20160816', true );	

	if(is_front_page()){
		wp_enqueue_style( 'home-page', get_template_directory_uri() . '/css/home.css', array(), '20160816' );
	}
	if(!is_front_page()){
		wp_enqueue_style( 'about-page', get_template_directory_uri() . '/css/about.css', array(), '20200420' );
		wp_enqueue_style( 'footable-css', get_template_directory_uri() . '/css/footable.core.min.css', array(), '20180619' );

		wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAJdM-CpTFkqdyupvcBKNEWYuXPsmi7EHA');
		wp_enqueue_script( 'mapping-scripts', get_template_directory_uri() . '/js/mapping.js', array('jquery'), '20200225', true );
		wp_enqueue_script( 'footable-js', get_template_directory_uri() . '/js/footable.min.js', array('jquery'), '20180619', true );

		wp_localize_script('mapping-scripts', 'valueObject', array( 'siteUrl' => site_url(), 'ajaxUrl' => admin_url( 'admin-ajax.php' ), 'themeUrl' => get_template_directory_uri() ) );
	}
	if((!is_page('event-attendees')) && (!is_page('planners')) && (!is_front_page()) && (!is_page('event-planner-guide'))){
	wp_enqueue_style( 'planner', get_template_directory_uri() . '/css/planner.css', array(), '20160816' );
	}

}

add_action( 'wp_enqueue_scripts', 'lecontecenter_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since lecontecenter 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function lecontecenter_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'lecontecenter_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since lecontecenter 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function lecontecenter_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since lecontecenter 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function lecontecenter_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'lecontecenter_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since lecontecenter 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function lecontecenter_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'lecontecenter_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since lecontecenter 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function lecontecenter_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'lecontecenter_widget_tag_cloud_args' );


require_once(get_template_directory() . '/inc/custom-post-taxonomy.php');
//require_once(get_template_directory() . '/inc/google-map-admin.php');
function pr($arr_val){
	echo '<pre>';
	if(is_array($arr_val) || is_object($arr_val)){
		print_r($arr_val);
	}
	else{
		var_dump($arr_val);
	}
	echo '</pre>';
}

///Theme Option 
add_action( 'admin_menu', 'lc_theme_option' );


function lc_theme_option() {
    add_theme_page( '  Options', 'Theme Option', 'manage_options', 'lecontecenter-theme-options', 'lc_option_check' );
}


function lc_option_check() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    echo '<div class="wrap">';
  
    require_once(get_template_directory().'/inc/theme-option.php');
    echo '</div>';
}

function archive_modify_query( $query ) {

	if ( is_post_type_archive('coupon') && $query->is_main_query()) {
        set_query_var( 'orderby', 'rand' );
    }

	if ( is_post_type_archive('faq') && $query->is_main_query()) {
        set_query_var( 'posts_per_page', '-1' );
    }	
}
add_action( "pre_get_posts", "archive_modify_query" );

function leconte_output_start_end_date($start_date, $end_date) {
	$start_datetime = strtotime($start_date); // yyyy-mm-dd
	$end_datetime	= strtotime($end_date); // yyyy-mm-dd
	$output			= '';
	
	if($start_datetime === $end_datetime) {
		// same day - April 1, 2012
		$output	= date('F j, Y', $start_datetime);	
	}
	elseif(date('Y-m', $start_datetime) === date('Y-m', $end_datetime)) {
		// same year and month - March 3 - 21, 2012
		$output	= sprintf('%s %s - %s, %s', date('F', $start_datetime), date('j', $start_datetime), date('j', $end_datetime), date('Y', $start_datetime));
	}
	elseif(date('Y', $start_datetime) === date('Y', $end_datetime)) {
		// same year - January 29 - February 2, 2012
		$output	= sprintf('%s - %s, %s', date('F j', $start_datetime), date('F j', $end_datetime), date('Y', $start_datetime));
	}
	else {
		// completely different - December 8, 2012 - Janurary 2, 2013
		$output	= sprintf('%s - %s', date('F j, Y', $start_datetime), date('F j, Y', $end_datetime));
	}
	
	return $output;
}
