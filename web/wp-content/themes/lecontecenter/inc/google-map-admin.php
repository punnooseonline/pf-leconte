<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

$nonce = wp_create_nonce( 'delete_map_points' );
class GoogleMap_Point_List_Table extends WP_List_Table {

  	function __construct(){
	    global $status, $page;

	    parent::__construct( array(
	      'singular'  => __( 'google_mappoint', 'mylisttable' ),     //singular name of the listed records
	      'plural'    => __( 'google_mappoints', 'mylisttable' ),   //plural name of the listed records
	      'ajax'      => false        //does this table support ajax?

	    ) );

	    add_action( 'admin_head', array( &$this, 'admin_header' ) );            

  	}

  	function get_map_points( $per_page = 5, $page_number = 1 ) {

	    global $wpdb;

	    $sql = "SELECT `ID`, `marker_title`, `section`, `latitude`, `longitude` FROM {$wpdb->prefix}google_mappoint";
	    if(!empty($_REQUEST['s'])){
	  		$sql .= " WHERE `marker_title` like '%".esc_sql($_REQUEST['s'])."%'";
	    }

	    if ( ! empty( $_REQUEST['orderby'] ) ) {
	      $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
	      $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
	    }

	    $sql .= " LIMIT $per_page";

	    $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


	    $result = $wpdb->get_results( $sql, 'ARRAY_A' );

	    return $result;
  	}

  	function delete_map_points( $id ) {
	    global $wpdb;

	    $wpdb->delete(
	      "{$wpdb->prefix}google_mappoint",
	      array( 'ID' => $id ), array( '%d' )
	    );
	}

  function record_count() {
    global $wpdb;

    $sql = "SELECT COUNT(ID) as total FROM {$wpdb->prefix}google_mappoint";
    if(!empty($_REQUEST['s'])){
  		$sql .= " WHERE `marker_title` like '%".esc_sql($_REQUEST['s'])."%'";
    }

    return $wpdb->get_var( $sql );
  }

  function no_items() {
    _e( 'No records avaliable.');
  }

  function admin_header() {
    $page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
    if( 'google_map_points' != $page )
    return;
    echo '<style type="text/css">';
    echo '.wp-list-table .column-id { width: 5%; }';
    echo '.wp-list-table .column-marker_title { width: 30%; }';
    echo '.wp-list-table .column-section { width: 20%; }';
    echo '.wp-list-table .column-latitude { width: 20%;}';
    echo '.wp-list-table .column-longitude { width: 20%;}';
    echo '</style>';
  }

  
  function column_default( $item, $column_name ) {
    switch( $column_name ) { 
        case 'marker_title':
        case 'section':
        case 'latitude':
        case 'longitude':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

  function get_sortable_columns() {
    $sortable_columns = array(
      'marker_title'  => array('marker_title',false),
      'section' => array('section',false),
      'latitude'   => array('latitude',false),
      'longitude'   => array('longitude',false),
    );
    return $sortable_columns;
  }

  function get_columns(){
    $columns = array(
        'cb'            => '<input type="checkbox" />',
        'marker_title'  => __( 'Title', 'mylisttable' ),
        'section'       => __( 'Section', 'mylisttable' ),
        'latitude'      => __( 'Latitude', 'mylisttable' ),
        'longitude'    => __( 'Longitude', 'mylisttable' )
    );
    return $columns;
  }

  function usort_reorder( $a, $b ) {
    // If no sort, default to title
    $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'marker_title';
    // If no order, default to asc
    $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
    // Determine sort order
    $result = strcmp( $a[$orderby], $b[$orderby] );
    // Send final sort direction to usort
    return ( $order === 'asc' ) ? $result : -$result;
  }

  function column_marker_title($item){
  	global $nonce;
    $actions = array(
              'edit'      => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
              'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce='.$nonce.'">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
          );

    return sprintf('%1$s %2$s', $item['marker_title'], $this->row_actions($actions) );
  }

  function get_bulk_actions() {
    $actions = array(
      'bulk-delete'    => 'Delete'
    );
    return $actions;
  }

  function column_cb($item) {
    return sprintf(
        '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
    );    
  }

  function prepare_items() {  	
    
    $this->_column_headers = $this->get_column_info();

    /** Process bulk action */
    $this->process_bulk_action();

    $per_page     = $this->get_items_per_page( 'google_mappoints_per_page', 5 );
    $current_page = $this->get_pagenum();
    $total_items  = self::record_count();

    $this->set_pagination_args( [
      'total_items' => $total_items, //WE have to calculate the total number of items
      'per_page'    => $per_page //WE have to determine how many items to show on a page
    ] );


    $this->items = self::get_map_points( $per_page, $current_page );	
   
  }

  function process_bulk_action() {
  	//Detect when a bulk action is being triggered...
    if ( 'delete' === $this->current_action() ) {

      // In our file that handles the request, verify the nonce.
      $nonce = esc_attr( $_REQUEST['_wpnonce'] );

      if ( ! wp_verify_nonce( $nonce, 'delete_map_points' ) ) {
        die( 'Go get a life script kiddies' );
      }
      else {
        self::delete_map_points( absint( $_GET['id'] ) );

        if (headers_sent()) {
		    die("<script>window.location.href='".admin_url('admin.php?page=google_map_points&msg=deleted')."'</script>");
		}
		else{
		    wp_redirect( esc_url(admin_url('admin.php?page=google_map_points&msg=deleted')) );
		}
        exit;
      }

    }

    // If the delete bulk action is triggered
    if ( ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'bulk-delete' )
         || ( isset( $_REQUEST['action2'] ) && $_REQUEST['action2'] == 'bulk-delete' )
    ) {

      	$delete_ids = esc_sql( $_REQUEST['bulk-delete'] );

      	// loop over the array of record IDs and delete them
      	foreach ( $delete_ids as $id ) {
        	self::delete_map_points( $id );
      	}
      	if (headers_sent()) {
		    die("<script>window.location.href='".admin_url('admin.php?page=google_map_points&msg=deleted')."'</script>");
		}
		else{
		    wp_redirect( esc_url(admin_url('admin.php?page=google_map_points&msg=deleted')) );
		}      
      exit;
    }
  }

  

} //class



function google_add_menu_items(){
  $hook = add_menu_page( 'Map Points', 'Map Points', 'activate_plugins', 'google_map_points', 'google_map_points_list_page', get_template_directory_uri()."/images/map-points-menu-icon.png", 30 );
  	
	add_submenu_page( 'google_map_points', 'Add New Map Points', 'Add New Map Points',
    'activate_plugins', 'google_map_points_add_page', 'google_map_points_add_page');

  add_action( "load-$hook", 'add_options' );
  
}


function screen_option() {

  $option = 'per_page';
  $args   = [
    'label'   => 'Map Points',
    'default' => 20,
    'option'  => 'google_mappoints_per_page'
  ];

  add_screen_option( $option, $args );

  //$this->customers_obj = new Customers_List();
}

function add_options() {
  global $myListTable;
  $option = 'per_page';
  $args = array(
         'label' => 'Map Points',
         'default' => 20,
         'option' => 'google_mappoints_per_page'
         );
  add_screen_option( $option, $args );
  $myListTable = new GoogleMap_Point_List_Table();
}
add_action( 'admin_menu', 'google_add_menu_items' );



function google_map_points_list_page(){
  global $myListTable;
  echo '<div class="wrap"><h2>Map Points <a class="page-title-action" href="'.admin_url('admin.php?page=google_map_points&action=add').'">Add New</a></h2> '; 
  if ( !empty($_REQUEST['action']) && ('edit' === $_REQUEST['action'] || 'add' === $_REQUEST['action']) ) {
  		add_edit_map_points();
  }
  else{
  	$myListTable->prepare_items(); 
	?>
  	<form method="get">
    <input type="hidden" name="page" value="google_map_points">
    <?php
    $myListTable->search_box( 'Search', 'search_id' );

  	$myListTable->display(); 
  	echo '</form></div>'; 
  }
}

function google_map_points_add_page(){
	echo '<div class="wrap"><h2>Map Points <a class="page-title-action" href="'.admin_url('admin.php?page=google_map_points&action=add').'">Add New</a></h2> '; 
  	add_edit_map_points();
  	echo '</div>'; 
  	
}

function add_edit_map_points(){
	global $wpdb;
	$nonce = wp_create_nonce( 'add_edit_map_points' );
	$action = empty($_REQUEST['$action']) ? 'add' : $_REQUEST['$action'];

	if(!empty($_REQUEST['sbmt'])){
		$msg = "fail";
		if(empty($_REQUEST['id'])){
			$insert_map = $wpdb->insert( "{$wpdb->prefix}google_mappoint", array( 'latitude' => $_REQUEST['latitude'], 'longitude' => $_REQUEST['longitude'], 'marker_title' => stripslashes($_REQUEST['marker_title']),  'info_window_html' => stripslashes($_REQUEST['info_window_html']), 'category_id' => $_REQUEST['category_id'], 'sub_category_id' => $_REQUEST['sub_category_id'], 'section' => stripslashes($_REQUEST['section'])), array( '%s', '%s', '%s', '%s', '%d', '%d', '%s' ) );
			if($insert_map){
				if (headers_sent()) {
				    die("<script>window.location.href='".esc_url(admin_url('admin.php?page=google_map_points&msg=inserted')) ."'</script>");
				}
				else{
				    wp_redirect( esc_url(admin_url('admin.php?page=google_map_points&msg=inserted')) );
				}
				
			}
		}
		else{
			$update_map = $wpdb->update( "{$wpdb->prefix}google_mappoint", array( 'latitude' => $_REQUEST['latitude'], 'longitude' => $_REQUEST['longitude'], 'marker_title' => stripslashes($_REQUEST['marker_title']),  'info_window_html' => stripslashes($_REQUEST['info_window_html']), 'category_id' => $_REQUEST['category_id'], 'sub_category_id' => $_REQUEST['sub_category_id'], 'section' => stripslashes($_REQUEST['section']) ), array( 'ID' => $_REQUEST['id'] ), array( '%s', '%s', '%s', '%s', '%d', '%d', '%s' ), array( '%d' ) );
			if (headers_sent()) {
			    die("<script>window.location.href='".admin_url('admin.php?page=google_map_points&msg=updated')."'</script>");
			}
			else{
			    wp_redirect( esc_url(admin_url('admin.php?page=google_map_points&msg=updated')) );
			}			
			exit;
		}     	
	}

	if(!empty($_REQUEST['id'])){
		$sql = "SELECT *  FROM `{$wpdb->prefix}google_mappoint`  WHERE `ID` = '".absint( $_REQUEST['id'])."'";
		$fetch_row = $wpdb->get_row( $sql );	
	}

	if(empty($fetch_row)){
		$fetch_row = new stdClass();
		$fetch_row->ID = '';
		$fetch_row->latitude = '';
		$fetch_row->longitude = '';
		$fetch_row->marker_title = '';
		$fetch_row->info_window_html = '';
		$fetch_row->category_id = '';
		$fetch_row->sub_category_id = '';
		$fetch_row->section = '';
	}
	if(!empty($msg) && $msg=="fail"){echo "<h3>Some error occurred!</h3>";}
	?>
	<form name="map_frm" method="post" id="map_frm">
		<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo $nonce;?>" />	
		<input type="hidden" id="hiddenaction" name="action" value="<?php echo $action;?>" />
		<input type="hidden" id="hiddenID" name="id" value="<?php echo $fetch_row->ID;?>" />
		<input type="hidden" id="hiddenpage" name="page" value="google_map_points" />
		<table class="form-table">
			<tr>
				<th><label for="marker_title">Marker Title</label></th>
				<td> <input name="marker_title" id="marker_title" type="text" value="<?php echo $fetch_row->marker_title;?>" class="regular-text code" required /></td>
			</tr>
			<tr>
				<th><label for="info_window_html">Info Window Html</label></th>
				<td> <input name="info_window_html" id="info_window_html" type="text" value="<?php echo $fetch_row->info_window_html;?>" class="regular-text code" required /></td>
			</tr>
			<tr>
				<th><label for="latitude">Latitude</label></th>
				<td> <input name="latitude" id="latitude" type="text" value="<?php echo $fetch_row->latitude;?>" class="regular-text code" required /></td>
			</tr>
			<tr>
				<th><label for="longitude">Longitude</label></th>
				<td> <input name="longitude" id="longitude" type="text" value="<?php echo $fetch_row->longitude;?>" class="regular-text code" required /></td>
			</tr>
			<tr>
				<th><label for="section">Section</label></th>
				<td> <input name="section" id="section" type="text" value="<?php echo $fetch_row->section;?>" class="regular-text code" required /></td>
			</tr>
			<tr>
				<th><label for="category_id">Category</label></th>
				<td>
					<select name="category_id" id="category_id" size="1" class="regular-select code"> 
						<option value="">Select</option>
						<?php
						$sql_cat = "SELECT *  FROM `{$wpdb->prefix}google_mappoint_cat` WHERE `is_sub_cat`='0' ORDER BY `name`  ASC";
						$fetch_cat = $wpdb->get_results( $sql_cat );
						if(!empty($fetch_cat)){
							foreach ($fetch_cat as $key => $value) {
								echo '<option value="'.$value->id.'" '.(($fetch_row->category_id == $value->id) ? "selected" : "") .'>'.$value->name.'</option>';
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="sub_category_id">Sub Category</label></th>
				<td> 
					<select name="sub_category_id" id="sub_category_id" size="1" class="regular-select code" style="width: 60%"> 	<option value="">Select</option>
						<?php
						$sql_subcat = "SELECT *  FROM `{$wpdb->prefix}google_mappoint_cat` WHERE `is_sub_cat`='1' ORDER BY `name`  ASC";
						$fetch_subcat = $wpdb->get_results( $sql_subcat );
						if(!empty($fetch_subcat)){
							foreach ($fetch_subcat as $key => $value) {
								echo '<option value="'.$value->id.'" '.(($fetch_row->sub_category_id == $value->id) ? "selected" : "") .'>'.$value->name.'</option>';
							}
						}
						?>
					</select>
				</td>
			</tr>
		</table>

		<p class="submit"><input type="submit" name="sbmt" id="sbmt" class="button button-primary" value="<?php if(empty($fetch_row->ID)){echo "Publish";} else{echo "Save Changes";}?>"  /></p>
	</form>
	<?php
}