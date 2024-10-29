<?php
global $wpdb;
add_option( 'banner_show', '10' );

if(isset($_POST['add_banner'])) :
	$banner_type = $_FILES['banner']['type'];
	if($banner_type == 'image/jpeg' or $banner_type == 'image/png' or $banner_type == 'image/jpeg') :
		$filename = $_FILES['banner']['name'];
		$description = $_POST['description'];
		$movefile = move_uploaded_file($_FILES["banner"]["tmp_name"],BBS_UPLOAD_DIR."/".$_FILES["banner"]["name"]);
		if($movefile) :
			$data = array( 'image_name'=>$filename, 'visible'=>1, 'description'=>$description );
			if($wpdb->insert(BBS_IMAGES_TABLE, $data)):
				$msg = "Banner Successfully added";
			endif;
		endif;
	endif;
endif;

if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class Banner_List_Table extends WP_List_Table {
	function __construct() {
		 global $status, $page;
		 parent::__construct( array(
			'singular'=> __( 'banner', 'bbs' ),
			'plural' => __( 'banners', 'bbs' ),
			'ajax'	=> false)
		); 
	}
	
	function column_default($item, $column_name){
		$actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&banner_id=%s">Edit</a>', $_REQUEST['page'],'edit', $item->id),
            'delete' => sprintf('<a href="?page=%s&action=%s&banner_id=%s" onclick="javascript: var r=confirm(\'Are you sure you want to delete! \'); if (r==true) {return true;} else {return false;}">Delete</a>', $_REQUEST['page'], 'delete', $item->id),
        );
		switch($column_name){
			case 'col_banner_name':
				$img = "<img src='".BBS_UPLOAD_URL.$item->image_name."' height='60'>";
				return sprintf('%1$s %2$s', $img, $this->row_actions($actions));
			case 'col_banner_visible':
				$visible = ($item->visible == 0) ? "False" : "True"; 
				return print_r($visible, true);
			case 'col_banner_created':
				$timestamp = strtotime($item->created_at);
				return print_r(date("m/d/Y", $timestamp), true);
			case 'col_banner_description':
				return print_r(substr($item->description, 0, 120), true);
		}
    }
    
    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'],
            $item->id
        );
    }
	
	function get_columns() {
		return $columns= array(
			'cb'=>__( '<input type="checkbox" />', 'bbs' ),
			'col_banner_name'=>__('Banner', 'bbs'),
			'col_banner_visible'=>__('Visibile', 'bbs'),
			'col_banner_created'=>__('Created', 'bbs'),
			'col_banner_description'=>__('Description', 'bbs'),
		);
	}
	
	public function get_sortable_columns() {
		return $sortable = array(
			'col_banner_name'=>'image_name',
			'col_banner_visible'=>'visible',
			'col_banner_created'=>'created_at'
		);
	}
	
	function get_bulk_actions() {
        return $actions = array(
            'delete'    => 'Delete'
        );
    }
    
    function process_bulk_action() {
        if( 'delete'===$this->current_action() ) :			
			if($_REQUEST['banner_id']) :
				global $wpdb;
				if(is_array($_REQUEST['banner_id'])) :
					foreach($_REQUEST['banner_id'] as $banner) :
						$wpdb->query("DELETE FROM ".BBS_IMAGES_TABLE." WHERE id = ".$banner);
					endforeach;
				else :
					$wpdb->query("DELETE FROM ".BBS_IMAGES_TABLE." WHERE id=".$_REQUEST['banner_id']);
				endif;
			endif;
        endif;
    }
	
	function prepare_items() {
		global $wpdb;
		$per_page = get_option('banner_show');
		$columns  = $this->get_columns();
  		$hidden   = array();
  		$sortable = $this->get_sortable_columns();
  		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->process_bulk_action();
		$orderby = '';
		switch($_REQUEST['orderby']) {
			case 'i': $orderby .= 'image_name'; break;
			case 'v': $orderby .= 'visible'; break;
			case 'c': $orderby .= 'created_at'; break;
		}
		$orderby = (!empty($_REQUEST['orderby'])) ? $orderby : 'id';
		$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'desc';
		$data = $wpdb->get_results("SELECT * FROM ".BBS_IMAGES_TABLE." ORDER BY ".$orderby." ".$order);
		$current_page = $this->get_pagenum();
		$total_items = count($data);
		$data = array_slice($data,(($current_page-1)*$per_page),$per_page);
		$this->items = $data;
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page' => $per_page,
			'total_pages' => ceil($total_items/$per_page)
    	));
	}
}
$banner_list_table = new Banner_List_Table(); ?>

<div id="bbs_list_banner">
<div class="wrap">
<div class="bbs_32x32"></div>
<h2><?php echo __( 'Banners', 'bbs' ); ?></h2>
<input type="button" class="button add_banner_btn" value="Add Banner" /><br />
<div style="clear: both;"></div>
<form name="add_banner_form" id="add_banner_form" action="?page=B-Banner-Slider/bbanner_slider.php" method="post" enctype="multipart/form-data">
<table id="add_banner_table">
<tr><th colspan="3"><img src="<?php echo BBS_IMAGE_PATH;?>/close.png" class="close" /></th></tr>
<tr><td width="10%">Upload Banner</td><td width="1%">:</td><td width="20%"><input type="file" name="banner" /></td></tr>
<tr><td>Description</td><td>:</td><td><textarea rows="4" cols="35" name="description"></textarea></td></tr>
<tr><td></td><td></td><td align="left"><input type="submit" name="add_banner" id="add_banner" value="Add Banner" class="button-primary" style="float: left;" /><!--<div class="process_msg"><img src="<?php //echo BBS_IMAGE_PATH;?>/process.gif" width="16" height="16" /></div>--></td></tr>
</table>
</form>
<form name="" method="post" action="?page=B-Banner-Slider/bbanner_slider.php">
<?php
	$banner_list_table->prepare_items();
	$banner_list_table->display();
?>
</form>
</div>
</div>