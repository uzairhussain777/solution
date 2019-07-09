<?php

class vendors_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function addvendors(){
			
			$image = '';
		$fullname=explode(".",$_FILES['image']['name']);
		$image = 'cbms_'.time().rand(100,999).'.'.$fullname[1];
		if(!empty($_FILES['image']['name']))

			{
			try{
					$file_data = array(
							"key"=>"uploads/image/".$image,
							"content_type" => $_FILES['image']['type'],
							"tmp_name" => $_FILES['image']['tmp_name']
							);	
							
					if (move_uploaded_file($_FILES["image"]["tmp_name"], $file_data['key'])) {
        				echo "The file ". basename( $_FILES["image"]["type"]). " has been uploaded.";
    				} else {
        				echo "Sorry, there was an error uploading your file.";
    				}
					
					
					$image = "uploads/image/".$image;

				}catch(Exception $e){
					dummy_create_compaign_form_validate();
					$this->session->set_flashdata('error_message', "File Uploading Issue");
					redirect($_SERVER['HTTP_REFERER']);
					exit;
				}	
				
				

			}
			else{
				$$image='';
			}
		
				$CI =& get_instance();
				$name=$this->input->post("name");
				$code=$this->input->post("code");
				$teacher_id = $this->session->userdata('teacher_id');
				$semester=$this->input->post("semester");
				$short_description=$this->input->post("short_description");
		
		//$now = date("Y-m-d"); // or your date as well
		//echo "<pre>";print_r($teacher_id);exit;
		$insert_in_vendors=array(
			'name'=>$name,
			'code'=>$code,
		'teacher_id'=>$teacher_id,
			'semester'=>$semester,
			'short_description'=>$short_description,
			'imageUrl'=>$image
			
		);
		
		$result_inserted=$this->insert($insert_in_vendors,'vendors');
		return $result_inserted;

	}
	public function upload_csv($orignal_file_name,$file_detail,$file_name=null,$file_ext=null)
{
	//echo "string";exit;
		$CI =& get_instance();
		$file_detail = json_encode($file_detail);
		$userid = $this->session->userdata("userid");
		$user_type = $this->session->userdata("user_type");
		$country_id = $this->session->userdata("country_id");
		$file_path = "r/uploads/warranty_registrar/csv/".$file_name;
		
		$data =array(
			'userid' =>$userid,
			'file_name'=>$orignal_file_name,
			'uploaded_file'=>$file_path,
			"fields"=>$file_detail,
			'status'=>"pending",
			'date_created'=>date("Y-m-d H:i:s")
			);
		$this->Insert($data,"ics_csv_uploads");
		$response['status'] = "Success";
		$CI->session->set_flashdata('success_message', "File uploaded Successfully. Now Match fields");
		return $response;
}
	
	public function gcsv(){
		$params=array(
			'select'=>"*",
			'from'=> "vendors",
			
			
       	);
		
				$result=$this->find($params);
				$result=array($result);
	//	echo "<pre>";print_r($result);exit;
		return $result;
	}
	
	 public    function csv($query, $filename = 'CSV_Report.csv')
{
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download($filename, $data);exit;

	    $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $query = $this->db->query("SELECT * FROM vendors");
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('CSV_Report.csv', $data);
}
	public function getvendors(){
		$params=array(
			'select'=>"name,status",
			'from'=> "vendors",
			
			
       	);
		
				$data=$this->find($params);
				
				return $data;
		
	}
	public function admin_delete_vendors(){	
		$vendors_id=$this->input->get("vendors_id");
			//echo "<pre>";print_r($vendors_id);exit;
				$result=$this->delete("vendors_id='$vendors_id'", 'vendors');
				return true;
	}
	
	
	public function getallvendors($offset,$limit){
		// $slugsearch=$this->input->post("slugsearch");
		// $unique_key="get_page_".$slugsearch ;
		// $result = $this->cache->memcached->get($unique_key);
		// if(!$result){
		$params=array(
			'select'=>"*",
			'from'=> "vendors",
			"page" => $offset,
        	"limit" => $limit,
       	);
		$where = "";
		
		/*******/
		 if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$slugsearch= $this->session->userdata("name_search");
				
			}else{
			
				$name_search=$this->input->post("name_search");
				$newdata = array(
						'name_search' => $name_search,
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($name_search) && $name_search!=""){
				$where_search[] = "name like '%".$name_search."%'";
			}
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){	
				$where =$where_search;
			}
		}
		else{
			$this->session->unset_userdata("name_search");
		}
		/********/
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
		//memcache
		// $this->cache->memcached->save($unique_key, $result,THIRTY_MINUTE_SECONDS);
		// }	
		//echo $result;exit;
		//echo "<pre>";print_r($result);exit;
		return $result;
		/*******/
		}
	
	
	public function getallvendorscount(){
		// $employees_name=$this->input->post("employees_name");
		// $unique_key="get_page_count_".$employees_name ;
		// $result = $this->cache->memcached->get($unique_key);
		// if(!$result){
		
		$where = "";
	
		if($this->uri->slash_segment(2)=="search/")
		{
			//echo "string";exit;
			//echo $name_search;exit;
			if(!$_POST)
			{
				$name_search= $this->session->userdata("name_search");
				
			}
			else{
				$name_search=$this->input->post("name_search");
				//echo $name_search;exit;
				$newdata = array(
						'name_search' => $name_search,
						);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($name_search) && $name_search!=""){
				$where_search[] = "name like '%".$name_search."%'";
			}
			$where_search = implode(" and ", $where_search);
			//echo "<pre>";print_r($where_search);exit;
			if(strlen($where_search)){
					$where =$where_search;
			}	
		}
		//echo $where;exit;
		$result= $this->count($where,"vendors");
		//echo $result;exit;print_r($result);exit;
		//memcache
		// $this->cache->memcached->save($unique_key, $result,THIRTY_MINUTE_SECONDS);
		// }
		return $result;
		
	}
	
	public function getallevent($offset,$limit){
		$params=array(
			'select'=>"*",
			'from'=> "vendors",
			"page" => $offset,
        	"limit" => $limit,
        	"status"=> 'active',
       	);
			
		$result=$this->find($params);
			return $result;
		/*******/
	}

	
	public function getallevenscount(){
		
		$where = "(Status='active' or Status='inactive')";
		$result= $this->count($where,"vendors");
		return $result;
		
	}

	
	
	public function getvendorsbyid($vendors_id){
		$result_vendors = $this->findOneBy(array(
			"vendors_id" => $vendors_id
		),'vendors');
		
		//echo "<pre>";print_r($result_vendors);exit;
		return $result_vendors;
	}
	
	public function get_menu_permissions_detail()
	{
			$params = array(
					"select"=>"panels.panels_name",
					"from"=>"panels"
			);
		$result_panel = $this->find($params);
		
		
		
		
			
		return $result_panel;
	}
	
	public function get_all_vendors(){
				 		 $this->load->model('content_content/content_content_model');
				$semester=$this->content_content_model->get_relevant_vendors();
		
		
	

 foreach ($semester as $key => $value) {
 			$semester=$value->semester;
 		
 	}
 
		//echo "<pre>";print_r($semester);exit;
		//$semester=$data['semester'];
		$params = array(
				"select" => "*",
				"from" => "vendors",
				"where" => " semester = $semester"
		);
		
		$result = $this->find($params); 
						//echo "<pre>";print_r($result);exit;
		
		return $result;
	}


	public function updatevendors($vendors_id){
		$CI =& get_instance();	
		$result=$this->vendors_content_model->getvendorsbyid($vendors_id);
		
		$name=$this->input->post("name");
		$code=$this->input->post("code");
		
		$semester=$this->input->post("semester");
		$short_description=$this->input->post("short_description");
		
		//echo $name;exit;
		
		
			$params=array(
			'name'=>$name,
			'code'=>$code,
			
			'semester'=>$semester,
			'short_description'=>$short_description,
			
			
		);
			$result=$this->update($params,"vendors_id='$vendors_id'","vendors");
			//echo "<pre>";print_r($result);exit;
			return $result;
	}	
}