<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       rrr
 * @since      1.0.0
 *
 * @package    Rs
 * @subpackage Rs/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rs
 * @subpackage Rs/admin
 * @author     rrrrrrrrr <r@gmail.com>
 */
class Rs_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->statusarr=array('1'=>'Enable','0'=>'Disable');
		$this->states=$usa_states = array(
		    'AL'=>'Alabama',
		    'AK'=>'Alaska',
		    'AZ'=>'Arizona',
		    'AR'=>'Arkansas',
		    'CA'=>'California',
		    'CO'=>'Colorado',
		    'CT'=>'Connecticut',
		    'DE'=>'Delaware',
		    'DC'=>'District of Columbia',
		    'FL'=>'Florida',
		    'GA'=>'Georgia',
		    'HI'=>'Hawaii',
		    'ID'=>'Idaho',
		    'IL'=>'Illinois',
		    'IN'=>'Indiana',
		    'IA'=>'Iowa',
		    'KS'=>'Kansas',
		    'KY'=>'Kentucky',
		    'LA'=>'Louisiana',
		    'ME'=>'Maine',
		    'MD'=>'Maryland',
		    'MA'=>'Massachusetts',
		    'MI'=>'Michigan',
		    'MN'=>'Minnesota',
		    'MS'=>'Mississippi',
		    'MO'=>'Missouri',
		    'MT'=>'Montana',
		    'NE'=>'Nebraska',
		    'NV'=>'Nevada',
		    'NH'=>'New Hampshire',
		    'NJ'=>'New Jersey',
		    'NM'=>'New Mexico',
		    'NY'=>'New York',
		    'NC'=>'North Carolina',
		    'ND'=>'North Dakota',
		    'OH'=>'Ohio',
		    'OK'=>'Oklahoma',
		    'OR'=>'Oregon',
		    'PA'=>'Pennsylvania',
		    'RI'=>'Rhode Island',
		    'SC'=>'South Carolina',
		    'SD'=>'South Dakota',
		    'TN'=>'Tennessee',
		    'TX'=>'Texas',
		    'UT'=>'Utah',
		    'VT'=>'Vermont',
		    'VA'=>'Virginia',
		    'WA'=>'Washington',
		    'WV'=>'West Virginia',
		    'WI'=>'Wisconsin',
		    'WY'=>'Wyoming',
	);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rs-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rs-admin.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( $this->plugin_name.'-bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		 wp_enqueue_media ();
		 wp_enqueue_script('media-upload'); //Provides all the functions needed to upload, validate and give format to files.
		wp_enqueue_script('thickbox'); //Responsible for managing the modal window.
		wp_enqueue_style('thickbox'); //Provides the styles needed for this window.


	}


 	public function my_rs_menu(){
 		add_menu_page('Services', 'Services', 'manage_options', 'fiu-service', array($this, 'custom_service_func'),'',25);
 		add_menu_page('Expedite', 'Expedite', 'manage_options', 'expedite', array($this, 'custom_expedite_func'),'',25);
 		add_menu_page('Rate Sheet', 'Rate Sheet', 'manage_options', 'rate-sheet', array($this, 'custom_ratesheet_func'),'',25);
 		add_menu_page('Product addon', 'Product addon', 'manage_options', 'product-addon', array($this, 'custom_addon_func'),'',25);
 		
 	}	

 	public function my_rs_script(){
 		echo '<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>	
		 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		 	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">';?>
		 	<script type="text/javascript">
		 		 $(function() {
		 		$('#addon_service').multiselect(
					{ nonSelectedText: 'Please Select',
					enableFiltering: true,
					enableCaseInsensitiveFiltering: true
				} );

		 	});
		 	</script>
 	<?php }
 	


 /******************************************************
	// Services

********************************************************/
public function custom_service_func(){
 		
	 		$usa_states=$this->states;
	 		$this->my_rs_script();
	 		$statusarr=$this->statusarr;
	 		if(isset($_REQUEST['id']) && ($_REQUEST['id'])>0){
	 			$data=$this->delListing_service($_REQUEST['id']);
	 			if($data==1){
				 				echo '<div class="alert alert-success">
				 Successfully deleted !!
				</div>';
				 			}else{
				 			echo	'<div class="alert alert-danger">
				  Something went wrong !!
				</div>';
	 			}
	 		}
	 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='addfrm_service'){
	 			
	 			$data=$this->addListing_service($_REQUEST);
	 			
	 			if($data==1){
				 				echo '<div class="alert alert-success">
				 Successfully added !!
				</div>';
				 			}else{
				 			echo	'<div class="alert alert-danger">
				  '.$data.'
				</div>';
	 			}
	 		}
	 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='editfrm_service'){
	 			
	 			$data=$this->addListing_service($_REQUEST);
	 			if($data==1){
				 				echo '<div class="alert alert-success">
				 Successfully Updated !!
				</div>';
				 			}else{
				 			echo	'<div class="alert alert-danger">
				  Something went wrong !!
				</div>';
	 			}
	 		}
	 		/*if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='srchfrm'){
	 			
	 			$data=$this->addListing($_REQUEST);
	 			if($data==1){
				 				echo '<div class="alert alert-success">
				 Successfully Updated !!
				</div>';
				 			}else{
				 			echo	'<div class="alert alert-danger">
				  Something went wrong !!
				</div>';
	 			}
	 		}*/


	 		$results=array();
			$user_count = $this->fetch_data_settings_count_service();

			$total_users = $user_count ? count($user_count) : 0;
			$page = isset($_GET['paged']) ? $_GET['paged'] : 1;
			// how many users to show per page
			$users_per_page =10;
			// calculate the total number of pages.
			$total_pages = 1;
			$offset = $users_per_page * ($page - 1);
			$total_pages = ceil($total_users / $users_per_page);
			$results=$this->fetch_data_settings_service($users_per_page,$offset);
						

				 		//print_r($results);?>
		 	
		 	<div class="rs_container container-fluid">
				  <h2>Services</h2>
				  
				<div class="row">
				  	<div class="col-lg-12">
				  <!-- 	<form action="?page=rate-sheet" method="post" name="rs-srchfrm" id="rs-srchfrm" enctype="multipart/form-data">
				  	<input type="search" name="srch_rate">
				  	<input type="hidden" name="mode" value="srchfrm">
				  	<input type="submit" value="search">
				  	</form> -->
				   <a href="" class="btn btn-success pull-right add_btn_service"  data-toggle="modal" data-target="#addmodalform_service">Add Service</a>

				  </div>
				  <div class="col-lg-12">
				   <p>&nbsp;</p>
				  </div>
				  <div class="col-lg-12">
				  <div class="tablenav-pages pull-right">
			      <span class="displaying-num ">
			        <?php echo ($total_users>0)? $total_users.' rows ': $total_users.' row ';?>
			      </span>
			      <span class="pagination-links">
			        <?php echo $this->custom_user_pagination($total_pages,$page);?>
			      </span>

			    </div>
				  </div>
		  		</div>
		  		<div class="row">
		  			<div class="col-lg-12">         	
					  <table class="table table-bordered">
					    <thead>
					      <tr>
					        <!-- <th><input type="checkbox"  id="onlineregcheck"></th> -->
					        <th>Name</th>
					        <th>Status</th>
					        <th>Action</th>
					      </tr>
					    </thead>
					    <tbody>
					    <?php foreach ($results as $res) {  	?>
					      <tr>
					        <td id="<?php echo 'servicename-'.$res->id; ?>"><?php echo $res->name;?></td>
					        <td id="<?php echo 'servicestatus-'.$res->id; ?>" data-id="<?php echo $res->status;?>"><?php echo $statusarr[$res->status];?></td>
							<td>
					        <a href="" class="btn btn-primary edit_btn_service " id=""  data-id="<?php echo $res->id;?>" data-toggle="modal" data-target="#addmodalform_service">Edit</a>
					        <a href="?page=fiu-service&id=<?php echo $res->id;?>" class="btn btn-danger del_btn_service" id="" data-id="<?php echo $res->id;?>">Delete</a>
					    	</td>
					      </tr>
					      <?php }?>
					     
					    </tbody>
					  </table>
					</div>
		  		</div>
				  
			</div>

		<div id="addmodalform_service" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Add Service</h4>
		      </div>
		      <div class="modal-body">
		         <form action="?page=fiu-service" method="post" name="rs-frm-service" id="rs-frm-service" enctype="multipart/form-data">
		         <input type="hidden" name="mode" value="addfrm_service">
		          <input type="hidden" name="service_id" value="">
					  <div class="form-group">
					    <label for="email">Service Name:</label>
					    <input name="service_name" class="form-control" id="service_name" required="true">					    
					  </div>
					   <div class="form-group">
					    <label for="email">Status:</label>
					    <select name="service_status" class="form-control" id="service_status">
					    <option value="" selected="true">Please Select</option>
					     <?php foreach ($statusarr as $key => $value) {?>
					     <option value="<?php echo $key;?>"><?php echo $value;?></option>   		
		    			<?php }?>
		    			</select>
					  </div>
					   <div class="form-group">
					  <button type="submit" class="btn btn-success" id="submit_tbn">Submit</button>

					  </div>
					
					</form>
		      </div>
		     
		    </div>

		  </div>
		</div>

                

 	<?php }
 	function fetch_data_settings_service($row_per_page,$offset){
 		global $wpdb;
 		$results = $wpdb->get_results( "select * from ".$wpdb->prefix."services order by  id DESC limit $offset,$row_per_page");
 		return $results;
 		
 	}
 	function getAllServicebyID($id){
 		global $wpdb;
 		$results = $wpdb->get_var( "select name from ".$wpdb->prefix."services where id=$id order by  name ASC");
 		return $results;
 	}
 	function getAllServicesbyIDs($ids){

 		$ids=explode(',', $ids);
 		$servicearr=array();
 		foreach($ids as $id){
 			$servicearr[]=$this->getAllServicebyID($id);
 		}
 		$results=implode(", ",$servicearr);
 		
 		return $results;
 	}
 	function getAllServices(){
 		global $wpdb;
 		$results = $wpdb->get_results( "select * from ".$wpdb->prefix."services order by  name ASC");
 		return $results;
 	}
 	function fetch_data_settings_count_service(){
	global $wpdb;
	$results = $wpdb->get_results( "select * from ".$wpdb->prefix."services order by  id DESC ", OBJECT );

	return $results;
	}
	function addListing_service($data)
	{
		global $wpdb;
				
			$rowcount = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."services WHERE name = '".$data['service_name']."'");

    		
			
				if(isset($data['service_id']) && $data['service_id']>0){
					
					$results=$wpdb->update( 
							$wpdb->prefix."services", 
							array( 
							'name' => $data['service_name'], 
							'updated_at'=>current_time( 'mysql' ),
							'status' => $data['service_status']
							), 
							array( 'id' => $data['service_id'] ), 
							array( 
							'%s', 
							'%s', 
							'%s'
							), 
							array( '%d' ) 
						);
				}
				else{


				if($rowcount==0){	
					$results=$wpdb->insert( 
							$wpdb->prefix."services", 
							array( 
								'name' => $data['service_name'], 
								'created_at' => current_time( 'mysql' ),
								'updated_at' => current_time( 'mysql' ), 
								'status'=>'1'
							), 
							array( 
								'%s',
								'%s',  
								'%s', 
								'%s'
							) 
						);
				}else{
					return 'Already Exists!!';
				}
			}
			
				return $results;
	}


	function delListing_service($id)
	{
		global $wpdb;
		$results=$wpdb->delete( $wpdb->prefix."services", array( 'id' => $id ) );
		return $results;
	}




/******************************************************
	// rate sheet

********************************************************/



 	public function custom_ratesheet_func(){
 		
				 		$usa_states=$this->states;
				 		$this->my_rs_script();
				 		if(isset($_REQUEST['id']) && ($_REQUEST['id'])>0){
				 			$data=$this->delListing($_REQUEST['id']);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully deleted !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='addfrm'){
				 			
				 			$data=$this->addListing($_REQUEST);
				 			
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully added !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
				  						'.$data.'</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='editfrm'){
				 			
				 			$data=$this->addListing($_REQUEST);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully Updated !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='srchfrm'){
				 			
				 			$data=$this->addListing($_REQUEST);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully Updated !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}

				 		





				 		$results=array();
						$user_count = $this->fetch_data_settings_count();

						$total_users = $user_count ? count($user_count) : 0;
						$page = isset($_GET['paged']) ? $_GET['paged'] : 1;
						// how many users to show per page
						$users_per_page =10;
						// calculate the total number of pages.
						$total_pages = 1;
						$offset = $users_per_page * ($page - 1);
						$total_pages = ceil($total_users / $users_per_page);
						$results=$this->fetch_data_settings($users_per_page,$offset);
						$servicesarr=$this->getAllServices();

				 		//print_r($results);?>
				 	
				 	<div class="rs_container container-fluid">
						  <h2>Rate Sheet</h2>
						  
						<div class="row">
						  	<div class="col-lg-12">
						  <!-- 	<form action="?page=rate-sheet" method="post" name="rs-srchfrm" id="rs-srchfrm" enctype="multipart/form-data">
						  	<input type="search" name="srch_rate">
						  	<input type="hidden" name="mode" value="srchfrm">
						  	<input type="submit" value="search">
						  	</form> -->
						   <a href="" class="btn btn-success pull-right add_btn"  data-toggle="modal" data-target="#addmodalform">Add Rate</a>

						  </div>
						  <div class="col-lg-12">
						   <p>&nbsp;</p>
						  </div>
						  <div class="col-lg-12">
						  <div class="tablenav-pages pull-right">
					      <span class="displaying-num ">
					        <?php echo ($total_users>0)? $total_users.' rows ': $total_users.' row ';?>
					      </span>
					      <span class="pagination-links">
					        <?php echo $this->custom_user_pagination($total_pages,$page);?>
					      </span>

					    </div>
						  </div>
				  		</div>
				  		<div class="row">
				  			<div class="col-lg-12">         	
							  <table class="table table-bordered">
							    <thead>
							      <tr>
							        <!-- <th><input type="checkbox"  id="onlineregcheck"></th> -->
							        <th>Service Name</th>
							        <th>State</th>
							        <th>Price</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    <?php foreach ($results as $res) {  	?>
							      <tr>
							        <td id="<?php echo 'rsservice-'.$res->rs_id; ?>" data-id="<?php echo $res->id;?>"><?php echo $res->name;?></td>
							        <td id="<?php echo 'rsstate-'.$res->rs_id; ?>" data-state="<?php echo $res->rs_state;?>"><?php echo $usa_states[stripslashes($res->rs_state)];?></td>
							        <td id="<?php echo 'rsprice-'.$res->rs_id; ?>"><?php echo stripslashes($res->rs_price);?></td>
									<td>
							        <a href="" class="btn btn-primary edit_btn " id=""  data-id="<?php echo $res->rs_id;?>" data-toggle="modal" data-target="#addmodalform">Edit</a>
							        <a href="?page=rate-sheet&id=<?php echo $res->rs_id;?>" class="btn btn-danger del_btn" id="" data-id="<?php echo $res->rs_id;?>">Delete</a>
							    	</td>
							      </tr>
							      <?php }?>
							     
							    </tbody>
							  </table>
							</div>
				  		</div>
						  
					</div>

				<div id="addmodalform" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Add Rate</h4>
				      </div>
				      <div class="modal-body">
				         <form action="?page=rate-sheet" method="post" name="rs-frm" id="rs-frm" enctype="multipart/form-data">
				         <input type="hidden" name="mode" value="addfrm">
				          <input type="hidden" name="rs_id" value="">
							  <div class="form-group">
							
							    <label for="email">Service Name:</label>
							    <select name="rs_serviceid" class="form-control" id="rs_serviceid" required="true">
							    <option value="" selected="true">Please Select</option>
							    <?php foreach ($servicesarr as $service) {?>
							    	<option value="<?php echo $service->id;?>" ><?php echo $service->name;?></option>
							    <?php } ?>

							    </select>
							    
							  </div>
							   <div class="form-group">
							    <label for="email">State:</label>
							    <select name="rs_state" class="form-control" id="rs_state" required="true">
							    <option value="" selected="true">Please Select</option>
							     <?php foreach ($usa_states as $key => $value) {?>
							     <option value="<?php echo $key;?>"><?php echo $value .' ('.$key.')';?></option>   		
				    			<?php }?>
				    			</select>
							  </div>
							  <div class="form-group">
							    <label for="pwd">Price:</label>
							    <input type="text"  name="rs_price" id="rs_price" class="regular-text form-control" value="0.00">
							  </div>
							   <div class="form-group">
							  <button type="submit" class="btn btn-success" id="submit_tbn">Submit</button>

							  </div>
							
							</form>
				      </div>
				     
				    </div>

				  </div>
				</div>

                

 	<?php }




 	function fetch_data_settings($row_per_page,$offset){
 		global $wpdb;
 		$results = $wpdb->get_results( "select * from ".$wpdb->prefix."ratesheet rs JOIN ".$wpdb->prefix."services s ON rs.rs_serviceid=s.id order by  rs_id DESC limit $offset,$row_per_page");
 		return $results;
 		
 	}
 	function getServieByID($id){
 		global $wpdb;
 		$results = $wpdb->get_results( "select * from ".$wpdb->prefix."services where id=$id order by  name ASC");
 		return $results;
 	}
 	function fetch_data_settings_count(){
	global $wpdb;
	$results = $wpdb->get_results( "select * from ".$wpdb->prefix."ratesheet rs JOIN ".$wpdb->prefix."services s ON rs.rs_serviceid=s.id order by  rs_id DESC ", OBJECT );

	return $results;
	}
	function custom_user_pagination($total_pages,$page)
	{
		$big = 999999999; // need an unlikely integer
		$arr=array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'             => '&paged=%#%',
		'prev_text'       => __('&laquo;'),
		'next_text'       => __('&raquo;'),
		'prev_next'    => True,
		'total' => $total_pages, // the total number of pages we have
		//'add_args'=>array('event_type'=>$event_type),
		'current' => $page, // the current page
		);
		echo paginate_links($arr);
	} 
	function addListing($data)
	{
		global $wpdb;
				
			$rowcount = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."ratesheet WHERE rs_serviceid = '".$data['rs_serviceid']."' AND rs_state = '".$data['rs_state']."'");

    		
			
				if(isset($data['rs_id']) && $data['rs_id']>0){
					
					$results=$wpdb->update( 
							$wpdb->prefix."ratesheet", 
							array( 
							'rs_serviceid' => $data['rs_serviceid'], 
							'rs_state' => $data['rs_state'], 
							'rs_price'=>$data['rs_price'],
							'updated_at'=>current_time( 'mysql' )
							), 
							array( 'rs_id' => $data['rs_id'] ), 
							array( 
							'%d', 
							'%s', 
							'%d',
							'%s'
							), 
							array( '%d' ) 
						);
				}
				else{


				if($rowcount==0){	
					$results=$wpdb->insert( 
							$wpdb->prefix."ratesheet", 
							array( 
								'rs_serviceid' => $data['rs_serviceid'], 
								'rs_state' => $data['rs_state'], 
								'rs_price'=>$data['rs_price'],
								'created_at'=>current_time( 'mysql' ),
								'updated_at'=>current_time( 'mysql' )
							), 
							array( 
								'%d', 
								'%s', 
								'%d',
								'%s',
								'%s'
							) 
						);
				}else{
					return 'Already Exists!!';
				}
			}
			
				return $results;
	}


	function delListing($id)
	{
		global $wpdb;
		$results=$wpdb->delete( $wpdb->prefix."ratesheet", array( 'rs_id' => $id ) );
		return $results;
	}
	
	function pippin_get_image_id($image_url) {
		global $wpdb;
		$attachment = $wpdb->get_results("SELECT ID FROM ".$wpdb->prefix."posts WHERE guid='".$image_url."'"); 
		echo "SELECT ID FROM ".$wpdb->prefix."posts WHERE guid='".$image_url."'";
	    //return $attachment[0]->ID; 
	}


/******************************************************
	// expedite

********************************************************/
 	public function custom_expedite_func(){
 						//print_r($_REQUEST);
				 		$usa_states=$this->states;
				 		$this->my_rs_script();
				 		if(isset($_REQUEST['id']) && ($_REQUEST['id'])>0){
				 			$data=$this->delListing_expedite($_REQUEST['id']);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully deleted !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='addfrm_expedite'){
				 			
				 			$data=$this->addListing_expedite($_REQUEST);
				 			
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully added !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  '.$data.'
							</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='editfrm_expedite'){
				 			
				 			$data=$this->addListing_expedite($_REQUEST);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully Updated !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='srchfrm'){
				 			
				 			$data=$this->addListing_expedite($_REQUEST);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully Updated !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}

				 		





				 		$results=array();
						$user_count = $this->fetch_data_settings_count_expedite();

						$total_users = $user_count ? count($user_count) : 0;
						$page = isset($_GET['paged']) ? $_GET['paged'] : 1;
						// how many users to show per page
						$users_per_page =10;
						// calculate the total number of pages.
						$total_pages = 1;
						$offset = $users_per_page * ($page - 1);
						$total_pages = ceil($total_users / $users_per_page);
						$results=$this->fetch_data_settings_expedite($users_per_page,$offset);
						$servicesarr=$this->getAllServices();

				 		//print_r($results);?>
				 	
				 	<div class="rs_container container-fluid">
						  <h2>Expedite</h2>
						  
						<div class="row">
						  	<div class="col-lg-12">
						  <!-- 	<form action="?page=rate-sheet" method="post" name="rs-srchfrm" id="rs-srchfrm" enctype="multipart/form-data">
						  	<input type="search" name="srch_rate">
						  	<input type="hidden" name="mode" value="srchfrm">
						  	<input type="submit" value="search">
						  	</form> -->
						   <a href="" class="btn btn-success pull-right add_btn_expedite"  data-toggle="modal" data-target="#addmodalform_expedite">Add Row</a>

						  </div>
						  <div class="col-lg-12">
						   <p>&nbsp;</p>
						  </div>
						  <div class="col-lg-12">
						  <div class="tablenav-pages pull-right">
					      <span class="displaying-num ">
					        <?php echo ($total_users>0)? $total_users.' rows ': $total_users.' row ';?>
					      </span>
					      <span class="pagination-links">
					        <?php echo $this->custom_user_pagination($total_pages,$page);?>
					      </span>

					    </div>
						  </div>
				  		</div>
				  		<div class="row">
				  			<div class="col-lg-12">         	
							  <table class="table table-bordered">
							    <thead>
							      <tr>
							        <!-- <th><input type="checkbox"  id="onlineregcheck"></th> -->
							        <th>Service Name</th>
							        <th>State</th>
							        <th>Time</th>
							        <th>Price</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    <?php foreach ($results as $res) {  	?>
							      <tr>
							        <td id="<?php echo 'exservice-'.$res->ex_id; ?>" data-id="<?php echo $res->id;?>"><?php echo $res->name;?></td>
							        <td id="<?php echo 'exstate-'.$res->ex_id; ?>" data-state="<?php echo $res->ex_state;?>"><?php echo $usa_states[stripslashes($res->ex_state)];?></td>
							        <td id="<?php echo 'extime-'.$res->ex_id; ?>"><?php echo stripslashes($res->ex_time);?></td>
									
							        <td id="<?php echo 'exprice-'.$res->ex_id; ?>"><?php echo stripslashes($res->ex_price);?></td>
									<td>
							        <a href="" class="btn btn-primary edit_btn_expedite " id=""  data-id="<?php echo $res->ex_id;?>" data-toggle="modal" data-target="#addmodalform_expedite">Edit</a>
							        <a href="?page=expedite&id=<?php echo $res->ex_id;?>" class="btn btn-danger del_btn_expedite" id="" data-id="<?php echo $res->ex_id;?>">Delete</a>
							    	</td>
							      </tr>
							      <?php }?>
							     
							    </tbody>
							  </table>
							</div>
				  		</div>
						  
					</div>

				<div id="addmodalform_expedite" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Add Row</h4>
				      </div>
				      <div class="modal-body">
				         <form action="?page=expedite" method="post" name="ex-frm" id="ex-frm" enctype="multipart/form-data">
				         <input type="hidden" name="mode" value="addfrm_expedite">
				          <input type="hidden" name="ex_id" value="">
							  <div class="form-group">
							    <label for="email">Service Name:</label>
							    <select name="ex_serviceid" class="form-control" id="ex_serviceid" required="true">
							    <option value="" selected="true">Please Select</option>
							     <?php foreach ($servicesarr as $service) {?>
							    	<option value="<?php echo $service->id;?>" ><?php echo $service->name;?></option>
							    <?php } ?>
							    </select>
							    
							  </div>
							   <div class="form-group">
							    <label for="email">State:</label>
							    <select name="ex_state" class="form-control" id="ex_state" required="true">
							    <option value="" selected="true">Please Select</option>
							     <?php foreach ($usa_states as $key => $value) {?>
							     <option value="<?php echo $key;?>"><?php echo $value .' ('.$key.')';?></option>   		
				    			<?php }?>
				    			</select>
							  </div>
							  <div class="form-group">
							    <label for="pwd">Time:</label>
							    <input type="text"  name="ex_time" id="ex_time" class="regular-text form-control">
							  </div>
							  <div class="form-group">
							    <label for="pwd">Price:</label>
							    <input type="text"  name="ex_price" id="ex_price" class="regular-text form-control" value="0.00">
							  </div>
							   <div class="form-group">
							  <button type="submit" class="btn btn-success" id="submit_btn_expedite">Submit</button>

							  </div>
							
							</form>
				      </div>
				     
				    </div>

				  </div>
				</div>

                

 	<?php }

 	function fetch_data_settings_expedite($row_per_page,$offset){
 		global $wpdb;
 		$results = $wpdb->get_results( "select * from ".$wpdb->prefix."expedite e  JOIN ".$wpdb->prefix."services s ON e.ex_serviceid=s.id order by  ex_id DESC limit $offset,$row_per_page");
 		return $results;
 		
 	}
 	function fetch_data_settings_count_expedite(){
	global $wpdb;
	$results = $wpdb->get_results( "select * from ".$wpdb->prefix."expedite e  JOIN ".$wpdb->prefix."services s ON e.ex_serviceid=s.id order by  ex_id DESC ", OBJECT );

	return $results;
	}


	function delListing_expedite($id)
	{
		global $wpdb;
		$results=$wpdb->delete( $wpdb->prefix."expedite", array( 'ex_id' => $id ) );
		return $results;
	}
	
	function addListing_expedite($data)
	{
		global $wpdb;
			
			$rowcount = $wpdb->get_var("SELECT COUNT(*) FROM ".$wpdb->prefix."expedite WHERE ex_serviceid = '".$data['ex_serviceid']."' AND ex_state = '".$data['ex_state']."'");

    		
			
				if(isset($data['ex_id']) && $data['ex_id']>0){
					
					$results=$wpdb->update( 
							$wpdb->prefix."expedite", 
							array( 
							'ex_serviceid' => $data['ex_serviceid'], 
							'ex_state' => $data['ex_state'], 
							'ex_time' => $data['ex_time'],
							'ex_price'=>$data['ex_price'],
							'updated_at'=>current_time( 'mysql' )
							), 
							array( 'ex_id' => $data['ex_id'] ), 
							array( 
							'%d', 
							'%s', 
							'%s', 
							'%d',
							'%s'
							), 
							array( '%d' ) 
						);
				}
				else{
					if($rowcount==0){	
					$results=$wpdb->insert( 
						$wpdb->prefix."expedite", 
						array( 
							'ex_serviceid' => $data['ex_serviceid'], 
							'ex_state' => $data['ex_state'],
							'ex_time' => $data['ex_time'],
							'ex_price'=>$data['ex_price'],
							'created_at'=>current_time( 'mysql' ),
							'updated_at'=>current_time( 'mysql' )
						), 
						array( 
							'%d', 
							'%s',
							'%s',  
							'%d',
							'%s',
							'%s'
						) 
					);
				}else{
					return 'Already Exists!!';
				}
				
				}
			
			//print_r($results);
			return $results;
	}




/******************************************************
	// product addon

********************************************************/
 	public function custom_addon_func(){
 						//print_r($_REQUEST);

				 		$usa_states=$this->states;
				 		$this->my_rs_script();
				 		if(isset($_REQUEST['id']) && ($_REQUEST['id'])>0){
				 			$data=$this->delListing_addon($_REQUEST['id']);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully deleted !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='addfrm_addon'){
				 			
				 			$data=$this->addListing_addon($_REQUEST);
				 			
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully added !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  '.$data.'
							</div>';
				 			}
				 		}
				 		if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='editfrm_addon'){
				 			
				 			$data=$this->addListing_addon($_REQUEST);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully Updated !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}
				 		/*if(isset($_REQUEST['mode']) && ($_REQUEST['mode'])=='srchfrm'){
				 			
				 			$data=$this->addListing_addon($_REQUEST);
				 			if($data==1){
							 				echo '<div class="alert alert-success">
							 Successfully Updated !!
							</div>';
							 			}else{
							 			echo	'<div class="alert alert-danger">
							  Something went wrong !!
							</div>';
				 			}
				 		}*/

				 		





				 		$results=array();
						$user_count = $this->fetch_data_settings_count_addon();

						$total_users = $user_count ? count($user_count) : 0;
						$page = isset($_GET['paged']) ? $_GET['paged'] : 1;
						// how many users to show per page
						$users_per_page =10;
						// calculate the total number of pages.
						$total_pages = 1;
						$offset = $users_per_page * ($page - 1);
						$total_pages = ceil($total_users / $users_per_page);
						$results=$this->fetch_data_settings_addon($users_per_page,$offset);
						$servicesarr=$this->getAllServices();

				 		//print_r($results);?>
				 	
				 	<div class="rs_container container-fluid">
						  <h2>addon</h2>
						  
						<div class="row">
						  	<div class="col-lg-12">
						  <!-- 	<form action="?page=rate-sheet" method="post" name="rs-srchfrm" id="rs-srchfrm" enctype="multipart/form-data">
						  	<input type="search" name="srch_rate">
						  	<input type="hidden" name="mode" value="srchfrm">
						  	<input type="submit" value="search">
						  	</form> -->
						   <a href="" class="btn btn-success pull-right add_btn_addon"  data-toggle="modal" data-target="#addmodalform_addon">Add Row</a>

						  </div>
						  <div class="col-lg-12">
						   <p>&nbsp;</p>
						  </div>
						  <div class="col-lg-12">
						  <div class="tablenav-pages pull-right">
					      <span class="displaying-num ">
					        <?php echo ($total_users>0)? $total_users.' rows ': $total_users.' row ';?>
					      </span>
					      <span class="pagination-links">
					        <?php echo $this->custom_user_pagination($total_pages,$page);?>
					      </span>

					    </div>
						  </div>
				  		</div>
				  		<div class="row">
				  			<div class="col-lg-12">         	
							  <table class="table table-bordered">
							    <thead>
							      <tr>
							        <!-- <th><input type="checkbox"  id="onlineregcheck"></th> -->
							        <th>Title</th>
							        <th>Description</th>
							        <th>Image</th>
							        <th>Services</th>
							        <th>Price</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    <?php foreach ($results as $res) {?>
							      <tr>
							        <td id="<?php echo 'addontitle-'.$res->id; ?>" data-id="<?php echo $res->id;?>"><?php echo $res->title;?></td>
							        <td id="<?php echo 'addondesc-'.$res->id; ?>"><?php echo $res->description;?></td>
							        <td id="<?php echo 'addonimg-'.$res->id; ?>"><?php if($res->image!=''){?><img width="60" height="60" src="<?php echo ($res->image);?>"/><?php } ?></td>
							        <td id="<?php echo 'addonservice-'.$res->id; ?>" data-id="<?php echo $res->service_id;?>"><?php echo $this->getAllServicesbyIDs($res->service_id);?></td>
							        <td id="<?php echo 'addonprice-'.$res->id; ?>">
							        	<input type="hidden" id="productjson" value='<?php echo $res->product_price;?>'>
							        	<?php $proprices=json_decode($res->product_price);
							        	//print_r($proprices);
							        	foreach($proprices as $pro){?>
							        		<p><?php 
							        		//print_r($pro);
							        	
											echo get_the_title($pro->productid ).' : '.$pro->price;?></p>
							        	<?php }?>
							        		
							        </td>
									<td>
								        <a href="" class="btn btn-primary edit_btn_addon " id=""  data-id="<?php echo $res->id;?>" data-toggle="modal" data-target="#addmodalform_addon">Edit</a>
								        <a href="?page=product-addon&id=<?php echo $res->id;?>" class="btn btn-danger del_btn_addon" id="" data-id="<?php echo $res->id;?>">Delete</a>
							    	</td>
							      </tr>
							      <?php }?>
							     
							    </tbody>
							  </table>
							</div>
				  		</div>
						  
					</div>

				<div id="addmodalform_addon" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Add Row</h4>
				      </div>
				      <div class="modal-body">
				         <form action="?page=product-addon" method="post" name="addon-frm" id="addon-frm" enctype="multipart/form-data">
				         <input type="hidden" name="mode" value="addfrm_addon">
				          <input type="hidden" name="addon_id" value="">
				              <div class="form-group">
							    <label for="pwd">Title:</label>
							    <input type="text"  name="addon_title" id="addon_title" required="true" class="regular-text form-control">
							  </div>
							   <div class="form-group">
							    <label for="pwd">Description:</label>

							    <?php 
							    $id='addon_desc';
						     $settings = array(
								'textarea_name' => $id, 
								'editor_class' =>'form-control',
								'media_buttons'=>true,
								//'editor_height'=>900,
								'quicktags' =>true,
								'tabindex'         => '',  
								'teeny'            => false,  // Whether to output the minimal editor configuration used in PressThis
					            'dfw'              => true,  // Whether to replace the default fullscreen editor with DFW (needs specific DOM elements and CSS)
					            'tinymce'          => true,   // Load TinyMCE, can be used to pass settings directly to TinyMCE using an array
					            'quicktags'        => true,   // Load Quicktags, can be used to pass settings directly to Quicktags using an array. Set to false to remove your editor's Visual and Text tabs.
					            'drag_drop_upload' => true  ,  // Enable Drag & Drop Upload Support (since WordPress 3.9)
								'textarea_rows'=>60
								
						     );
						     
						     wp_editor('', $id, $settings ); 

			   
								?>
							    
							  </div>
							   <div class="form-group">
							    <label for="pwd">Image:</label>
							    <input type="text"  name="addon_img" id="addon_img" readonly="true" class="regular-text form-control">
							    <input type="hidden" id="uploadimgid" value="">
							    <div id="showimg" >
							    	<img src="" width="80" height="80" style="display: none;">
							    </div>
							    <button type="button" class="btn btn-primary" id="upload-btn">Upload</button>
							  </div>
							  <div class="form-group">
							  	<label for="email">Services:</label>
							  	 <select name="addon_service[]" class="form-control" id="addon_service" required="true" multiple="multiple">
							    <?php foreach ($servicesarr as $service) {?>
							    	<option value="<?php echo $service->id;?>" ><?php echo $service->name;?></option>
							    <?php } ?>

							    </select>
							    <p>&nbsp;</p>
							  </div>
							  <div class="form-group">
							    <label for="pwd">Product prices:</label>
							    <p>&nbsp;</p>
							    <?php $product_arr=$this->getallproducts();
							    $count=0;
							    foreach($product_arr as $pro){?>

							    	<div class="">
							   		<input type="hidden" class="form-control" placeholder="" name="addon[<?php echo $count;?>][productid]" value="<?php echo $pro['id'];?>">
							   		<label for="pwd"><?php echo $pro['name'];?></label>
							    	<input type="text" required="true" class="form-control" id="pro-<?php echo $pro['id'];?>" placeholder="" name="addon[<?php echo $count;?>][price]">
								</div>
								<?php $count++;
								}?>
								
							  </div>
							   <div class="form-group">
							  <button type="submit" class="btn btn-success" id="submit_btn_addon">Submit</button>

							  </div>
							
							</form>
				      </div>
				     
				    </div>

				  </div>
				</div>

                

 	<?php }

 	function fetch_data_settings_addon($row_per_page,$offset){
 		global $wpdb;
 		$results = $wpdb->get_results( "select * from ".$wpdb->prefix."product_addon   order by  id DESC limit $offset,$row_per_page");
 		return $results;
 		
 	}
 	function fetch_data_settings_count_addon(){
	global $wpdb;
	$results = $wpdb->get_results( "select * from ".$wpdb->prefix."product_addon  order by  id DESC ", OBJECT );

	return $results;
	}


	function delListing_addon($id)
	{
		global $wpdb;
		$results=$wpdb->delete( $wpdb->prefix."product_addon", array( 'id' => $id ) );
		return $results;
	}
	
	function addListing_addon($data)
	{
		global $wpdb;
			
			
				/*print_r($data);
				die;*/
    		
			
				if(isset($data['addon_id']) && $data['addon_id']>0){
					
					$results=$wpdb->update( 
							$wpdb->prefix."product_addon", 
							array( 
							'title' => $data['addon_title'], 
							'description' => $data['addon_desc'],
							'image' => $data['addon_img'],
							'service_id'=>implode(",",$data['addon_service']),
							'product_price'=>json_encode($data['addon']),
							'updated_at'=>current_time( 'mysql' )
							), 
							array( 'id' => $data['addon_id'] ), 
							array( 
							'%s',
							'%s', 
							'%s', 
							'%s', 
							'%s',
							'%s'
							), 
							array( '%d' ) 
						);
				}
				else{
					$results=$wpdb->insert( 
						$wpdb->prefix."product_addon", 
						array( 
							'title' => $data['addon_title'], 
							'description' => $data['addon_desc'],
							'image' => $data['addon_img'],
							'service_id'=>implode(",",$data['addon_service']),
							'product_price'=>json_encode($data['addon']),
							'created_at'=>current_time( 'mysql' ),
							'updated_at'=>current_time( 'mysql' )
						), 
						array( 
							'%s', 
							'%s',
							'%s',  
							'%s',
							'%s',
							'%s',
							'%s'
						) 
					);
				
				
				}
			
			//print_r($results);
			return $results;
	}

	function getallproducts(){
		$args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'post_status'    => 'publish'
	    );

	    $loop = new WP_Query( $args );
	    $productarr=array();

	    while ( $loop->have_posts() ) : $loop->the_post();
	        global $product;
	        $productarr[]=array('id'=>get_the_ID(),'name'=>get_the_title());
	    endwhile;

	    wp_reset_query();
	    //print_r($productarr);

	    return $productarr;
	}







}
