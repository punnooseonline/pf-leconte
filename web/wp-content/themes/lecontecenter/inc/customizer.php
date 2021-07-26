<?php
/**
 * lecontecenter Customizer functionality
 *
 * @package WordPress
 * @subpackage lecontecenter
 * @since lecontecenter 1.0
 */


/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since lecontecenter 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function lecontecenter_customize_register( $wp_customize ) {
	

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'lecontecenter_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'lecontecenter_customize_partial_blogdescription',
		) );
	}

	
}
add_action( 'customize_register', 'lecontecenter_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since lecontecenter 1.2
 * @see lecontecenter_customize_register()
 *
 * @return void
 */
function lecontecenter_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since lecontecenter 1.2
 * @see lecontecenter_customize_register()
 *
 * @return void
 */
function lecontecenter_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


add_action("wp_ajax_get_maker_category", "lc_get_maker_category");
add_action("wp_ajax_nopriv_get_maker_category", "lc_get_maker_category");

function lc_get_maker_category(){
	global $wpdb;
	if(!empty($_GET['section'])){
		$section = $_GET['section'];
		$sql = "SELECT * FROM {$wpdb->prefix}google_mappoint WHERE `section` = '".esc_sql($section)."'";
		$fetch_maps = $wpdb->get_results( $sql );		
		$maps_arr = "";
		if(!empty($fetch_maps)){
			foreach ($fetch_maps as $key => $row) {
				$maps_arr[] = array('id' => $row->ID, "latitude" => $row->latitude, "longitude" => $row->longitude, "marker_title" => $row->marker_title, "info_window_html" => $row->info_window_html, "section" => $row->section, "category" => $row->category_id, "sub_category" => $row->sub_category_id);
			}
		}
		header( 'Content-type: application/json' );
		echo json_encode($maps_arr);
	}

	exit;
}

if(!function_exists('lc_remove_menus')){
	function lc_remove_menus(){
	  
	  #remove_menu_page( 'index.php' );                  //Dashboard
	  #remove_menu_page( 'jetpack' );                    //Jetpack* 
	  remove_menu_page( 'edit.php' );                   //Posts
	  #remove_menu_page( 'upload.php' );                 //Media
	  #remove_menu_page( 'edit.php?post_type=page' );    //Pages
	  remove_menu_page( 'edit-comments.php' );          //Comments
	  #remove_menu_page( 'themes.php' );                 //Appearance
	  #remove_menu_page( 'plugins.php' );                //Plugins
	  #remove_menu_page( 'users.php' );                  //Users
	  #remove_menu_page( 'tools.php' );                  //Tools
	  #remove_menu_page( 'options-general.php' );        //Settings
	  
	}
	if(is_admin()){
		add_action( 'admin_menu', 'lc_remove_menus' );
	}
}

//clear nav id
add_filter('nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3);
function clear_nav_menu_item_id($id, $item, $args) {
    return "";
}