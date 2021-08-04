<?php
/*Register Post Type Event Start*/
  
add_action('init', 'event_register_post_type');
if(!function_exists('event_register_post_type')){
	function event_register_post_type() {
	    register_post_type('event', array(
	        'labels' => array(
			    'name'               => _x( 'Events', 'post type general name' ),
		        'singular_name'      => _x( 'Event', 'post type singular name' ),
		        'add_new'            => _x('Add New Event', 'Events'),
		        'add_new_item'       => _x('Add New Event', 'Events'),
		        'edit_item'          => __( 'Edit Event' ),
		        'new_item'           => __( 'New Event' ),
		        'all_items'          => __( 'All Events' ),
		        'view_item'          => __( 'View Event' ),
		        'search_items'       => __( 'Search Event' ),
		        'not_found'          => __( 'No Event found' ),
		        'not_found_in_trash' => __( 'No Event found in the Trash' ),
		        'parent_item_colon'  => '',
		        'menu_name'          => __( 'Events' )
	        ),
	        'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array('slug' => 'event/details',),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon'     => get_template_directory_uri()."/images/event-menu-icon.png",
	        'supports' => array(
	            'title',
	            'editor',
				'author',
				'thumbnail',
				'excerpt',
				//'custom-fields',
				//'trackbacks',
				//'comments',
				'revisions',
				//'page-attributes',
				//'post-formats'
	        ),
	        'taxonomies' => array('post_tag') // this is IMPORTANT
	    ));
	}
}

/*Register Post Type Business Start*/
  
add_action('init', 'business_register_post_type');
if(!function_exists('business_register_post_type')){
	function business_register_post_type() {
	    register_post_type('business', array(
	        'labels' => array(
			    'name'               => _x( 'Business', 'post type general name' ),
		        'singular_name'      => _x( 'Business', 'post type singular name' ),
		        'add_new'            => _x('Add New Business', 'Business'),
		        'add_new_item'       => _x('Add New Business', 'Business'),
		        'edit_item'          => __( 'Edit Business' ),
		        'new_item'           => __( 'New Business' ),
		        'all_items'          => __( 'All Businesses' ),
		        'view_item'          => __( 'View Business' ),
		        'search_items'       => __( 'Search Business' ),
		        'not_found'          => __( 'No Business found' ),
		        'not_found_in_trash' => __( 'No Business found in the Trash' ),
		        'parent_item_colon'  => '',
		        'menu_name'          => __( 'Business' )
	        ),
	        'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array('slug' => 'geofence', 'with_front' => false),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon'     => get_template_directory_uri()."/images/business-menu-icon.png",
	        'supports' => array(
	            'title',
	            'editor',
				'author',
				'thumbnail',
				'excerpt',
				//'custom-fields',
				//'trackbacks',
				//'comments',
				//'revisions',
				//'page-attributes',
				//'post-formats'
	        ),
	        'taxonomies' => array('post_tag') // this is IMPORTANT
	    ));
	}
}
/*Register Post Type Coupons Start*/
  
add_action('init', 'coupons_register_post_type');
if(!function_exists('coupons_register_post_type')){
	function coupons_register_post_type() {
	    register_post_type('coupon', array(
	        'labels' => array(
			    'name'               => _x( 'Coupons', 'post type general name' ),
		        'singular_name'      => _x( 'Coupon', 'post type singular name' ),
		        'add_new'            => _x('Add New Coupons', 'Coupons'),
		        'add_new_item'       => _x('Add New Coupons', 'Coupons'),
		        'edit_item'          => __( 'Edit Coupon' ),
		        'new_item'           => __( 'New Coupon' ),
		        'all_items'          => __( 'All Coupons' ),
		        'view_item'          => __( 'View Coupons' ),
		        'search_items'       => __( 'Search Coupons' ),
		        'not_found'          => __( 'No Coupons found' ),
		        'not_found_in_trash' => __( 'No Coupons found in the Trash' ),
		        'parent_item_colon'  => '',
		        'menu_name'          => __( 'Coupons' )
	        ),
	        'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => 'coupons', 'with_front' => false ),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon'     => get_template_directory_uri()."/images/coupon-menu-icon.png",
	        'supports' => array(
	            'title',
	            //'editor',
				//'author',
				'thumbnail',
				//'excerpt',
				//'custom-fields',
				//'trackbacks',
				//'comments',
				//'revisions',
				//'page-attributes',
				//'post-formats'
	        ),
	        //'taxonomies' => array('post_tag', 'category') // this is IMPORTANT
	    ));
	}
}
/*Register Post Type Gallery Start*/
  
add_action('init', 'gallery_register_post_type');

if(!function_exists('gallery_register_post_type')){
	function gallery_register_post_type() {
	    register_post_type('gallery', array(
	        'labels' => array(
			    'name'               => _x( 'Gallery', 'post type general name' ),
		        'singular_name'      => _x( 'Gallery', 'post type singular name' ),
		        'add_new'            => _x('Add New Gallery', 'Gallery'),
		        'add_new_item'       => _x('Add New Gallery', 'Gallery'),
		        'edit_item'          => __( 'Edit Gallery' ),
		        'new_item'           => __( 'New Gallery' ),
		        'all_items'          => __( 'All Gallery' ),
		        'view_item'          => __( 'View Gallery' ),
		        'search_items'       => __( 'Search Gallery' ),
		        'not_found'          => __( 'No Gallery found' ),
		        'not_found_in_trash' => __( 'No Gallery found in the Trash' ),
		        'parent_item_colon'  => '',
		        'menu_name'          => __( 'Gallery' )
	        ),
	        'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon'     => get_template_directory_uri()."/images/gallery-menu-icon.png",
	        'supports' => array(
	            'title',
	            //'editor',
				//'author',
				'thumbnail',
				'excerpt',
				//'custom-fields',
				//'trackbacks',
				//'comments',
				//'revisions',
				//'page-attributes',
				//'post-formats'
	        ),
	        'taxonomies' => array('gallery_category') // this is IMPORTANT
	    ));
	}
}

/*Register Gallery Taxonomy*/
add_action( 'init', 'create_lc_gallery_category', 0 );

if(!function_exists('create_lc_gallery_category')){
	function create_lc_gallery_category() {
		$labels = array(
			'name'                       => _x( 'Category', 'taxonomy general name', 'textdomain' ),
			'singular_name'              => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
			'search_items'               => __( 'Search Category', 'textdomain' ),
			'popular_items'              => __( 'Popular Categories', 'textdomain' ),
			'all_items'                  => __( 'All Categories', 'textdomain' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Category', 'textdomain' ),
			'update_item'                => __( 'Update Category', 'textdomain' ),
			'add_new_item'               => __( 'Add New Category', 'textdomain' ),
			'new_item_name'              => __( 'New Category Name', 'textdomain' ),
			'separate_items_with_commas' => __( 'Separate Category with commas', 'textdomain' ),
			'add_or_remove_items'        => __( 'Add or remove Category', 'textdomain' ),
			'choose_from_most_used'      => __( 'Choose from the most used Category', 'textdomain' ),
			'not_found'                  => __( 'No Category found.', 'textdomain' ),
			'menu_name'                  => __( 'Category', 'textdomain' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'gallery_category' ),
		);

		register_taxonomy( 'gallery_category', 'book', $args );
	}
}


/*Register Post Type Team Start*/
  
add_action('init', 'team_register_post_type');
if(!function_exists('team_register_post_type')){
	function team_register_post_type() {
	    register_post_type('team', array(
	        'labels' => array(
			    'name'               => _x( 'Team', 'post type general name' ),
		        'singular_name'      => _x( 'Team', 'post type singular name' ),
		        'add_new'            => _x('Add New Team', 'Team'),
		        'add_new_item'       => _x('Add New Team', 'Team'),
		        'edit_item'          => __( 'Edit Team' ),
		        'new_item'           => __( 'New Team' ),
		        'all_items'          => __( 'All Team' ),
		        'view_item'          => __( 'View Team' ),
		        'search_items'       => __( 'Search Team' ),
		        'not_found'          => __( 'No Team found' ),
		        'not_found_in_trash' => __( 'No Team found in the Trash' ),
		        'parent_item_colon'  => '',
		        'menu_name'          => __( 'Team' )
	        ),
	        'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon'     => get_template_directory_uri()."/images/team-menu-icon.png",
	        'supports' => array(
	            'title',
	            'editor',
				//'author',
				'thumbnail',
				//'excerpt',
				//'custom-fields',
				//'trackbacks',
				//'comments',
				'revisions',
				//'page-attributes',
				//'post-formats'
	        ),
	        //'taxonomies' => array('post_tag', 'category') // this is IMPORTANT
	    ));
	}
}
/*Register Post Type FAQ Start*/
  
add_action('init', 'faq_register_post_type');
if(!function_exists('faq_register_post_type')){
	function faq_register_post_type() {
	    register_post_type('faq', array(
	        'labels' => array(
			    'name'               => _x( 'FAQ', 'post type general name' ),
		        'singular_name'      => _x( 'FAQ', 'post type singular name' ),
		        'add_new'            => _x('Add New FAQ', 'FAQ'),
		        'add_new_item'       => _x('Add New FAQ', 'FAQ'),
		        'edit_item'          => __( 'Edit FAQ' ),
		        'new_item'           => __( 'New FAQ' ),
		        'all_items'          => __( 'All FAQ' ),
		        'view_item'          => __( 'View FAQ' ),
		        'search_items'       => __( 'Search FAQ' ),
		        'not_found'          => __( 'No FAQ found' ),
		        'not_found_in_trash' => __( 'No FAQ found in the Trash' ),
		        'parent_item_colon'  => '',
		        'menu_name'          => __( 'FAQ' )
	        ),
	        'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => 'faqs', 'with_front' => false ),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon'     => get_template_directory_uri()."/images/faq-menu-icon.png",
	        'supports' => array(
	            'title',
	            'editor',
				//'author',
				//'thumbnail',
				//'excerpt',
				//'custom-fields',
				//'trackbacks',
				//'comments',
				'revisions',
				//'page-attributes',
				//'post-formats'
	        ),
	        //'taxonomies' => array('post_tag', 'category') // this is IMPORTANT
	    ));
	}
}


/*Register Post Type Testimonials Start*/
  
add_action('init', 'testimonials_register_post_type');
if(!function_exists('testimonials_register_post_type')){
	function testimonials_register_post_type() {
	    register_post_type('testimonials', array(
	        'labels' => array(
			    'name'               => _x( 'Testimonials', 'post type general name' ),
		        'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
		        'add_new'            => _x('Add New Testimonials', 'Testimonials'),
		        'add_new_item'       => _x('Add New Testimonial', 'Testimonials'),
		        'edit_item'          => __( 'Edit Testimonial' ),
		        'new_item'           => __( 'New Testimonial' ),
		        'all_items'          => __( 'All Testimonials' ),
		        'view_item'          => __( 'View Testimonials' ),
		        'search_items'       => __( 'Search Testimonials' ),
		        'not_found'          => __( 'No Testimonial found' ),
		        'not_found_in_trash' => __( 'No Testimonial found in the Trash' ),
		        'parent_item_colon'  => '',
		        'menu_name'          => __( 'Testimonials' )
	        ),
	        'public' => false,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' => array( 'slug' => 'testimonials', 'with_front' => false ),
			'capability_type' => 'post',
			'has_archive' => true, 
			'hierarchical' => false,
			'menu_position' => null,
			'menu_icon'     => get_template_directory_uri()."/images/testimonials-menu-icon.png",
	        'supports' => array(
	            'title',
	            'editor',
				//'author',
				'thumbnail',
				//'excerpt',
				//'custom-fields',
				//'trackbacks',
				//'comments',
				'revisions',
				//'page-attributes',
				//'post-formats'
	        ),
	        //'taxonomies' => array('post_tag', 'category') // this is IMPORTANT
	    ));
	}
}

