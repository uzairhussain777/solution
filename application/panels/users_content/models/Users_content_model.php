<?php
		
class Users_content_model extends MY_Model {
			public function __construct() {
				parent::__construct("app_user");
		}
		
		public function getuserbyid($user_id){
		$result_user = $this->findOneBy(array(
			"user_id" => $user_id
		),'users');
			
		return $result_user;
	}
	
	
	public function upadteProfile($user_id){
		$password=$this->input->post("password");	
		
		if(isset($password) && $password!=""){
		$hased_pass=hash("sha256",$password,False);	
		$first_name=$this->input->post("first_name");
		$last_name=$this->input->post("last_name");
		$city=$this->input->post("city");
		$country=$this->input->post("country");
		$zipcode=$this->input->post("zipcode");
		$state=$this->input->post("state");
		
		$update=array(
			'password'=>$hased_pass,
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'city'=>$city,
			'country'=>$country,
			'zipcode'=>$zipcode,
			'state'=>$state,
			'date_updated'=>date("Y-m-d H:i:s"),
			
		);		
		}
		else{
		$first_name=$this->input->post("first_name");
		$last_name=$this->input->post("last_name");
		$city=$this->input->post("city");
		$country=$this->input->post("country");
		$zipcode=$this->input->post("zipcode");
		$state=$this->input->post("state");
		$update=array(
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'city'=>$city,
			'country'=>$country,
			'zipcode'=>$zipcode,
			'state'=>$state,
			'date_updated'=>date("Y-m-d H:i:s"),
			);
		}
		$result=$this->update($update,"user_id=$user_id","users");
		return true;
	}
		
		public function addUser(){
		$email=$this->input->post("email");
		$password=$this->input->post("password");
		$username=$this->input->post("username");
		$firstname=$this->input->post("firstname");
		$lastname=$this->input->post("lastname");
		$country=$this->input->post("country");
		$city=$this->input->post("city");
		$state=$this->input->post("state");
		$zipcode=$this->input->post("zipcode");
		$usertypeid=$this->input->post("systemtype");
		$logged_in_user_id=$this->session->userdata('user_id');
		
		$hased_pass=hash("sha256",$password,False);
		
		$result_user_type = $this->findOneBy(array(
		"user_type_id" => $usertypeid
		),'user_type');
		$group_id='0';
		$insert_in_users = array(	
		'password' => $hased_pass,
		'email' => $email,
		'user_name'=>$username,
		'first_name'=>$firstname,
		'last_name'=>$lastname,
		'country'=>$country,
		'city'=>$city,
		'state'=>$state,
		'zipcode'=>$zipcode,
		'date_created'=>date("Y-m-d H:i:s"),
		'created_by'=>$logged_in_user_id,
		'user_type_id'=>$result_user_type->user_type_id,       
		 );
		
		$result_inserted=$this->insert($insert_in_users,'users');
		$CI =& get_instance();
		$CI->session->set_flashdata('success_message', "User has been Created Successfully");
			return $result_inserted;
		}
		
		public function check_unique_email($email){
			$where = "email = '$email'";
		$result = $this->count($where,"users");
		
			return $result;
		}
		
		function check_unique_user_name($user_name){
				$where = "user_name = '$user_name'";
		$result = $this->count($where,"users");
				return $result;
		}
		
		function get_all_user($offset,$limit){
			$params=array(
			'select'=>"users.*, user_type.front_name ",
			'from'=> "users, user_type",
			'where'=>"users.user_type_id = user_type.user_type_id",
			"page" => $offset,
        	"limit" => $limit
			);
			
			$result=$this->find($params);
			if($result !=null){
				return $result;
			}
			else{
				return false;
			}
			
		}
		/*******awais****/
		
		public function getalluserforsearch($offset,$limit){
			$params=array(
			'select'=>"users.*, user_type.front_name ",
			'from'=> "users, user_type",
			"page" => $offset,
        	"limit" => $limit
			);
			$where="users.user_type_id = user_type.user_type_id";
				/*******/
			if($this->uri->slash_segment(2)=="search/")
			 {
				if(!$_POST)
				{
					$user_name_search= $this->session->userdata("user_name");;
					$user_email_search= $this->session->userdata("user_email");
					$user_country_search= $this->session->userdata("user_country");
					
				}else{
					$user_name_search=$this->input->post("user_name_search");
					$user_email_search=$this->input->post("user_email_search");
					$user_country_search=$this->input->post("user_country_search");
			
					//$ticket_id=$this->input->post("ticket_id");
					$newdata = array(
						'user_name'  => $user_name_search,
						'user_email' => $user_email_search,
						'user_country' => $user_country_search,	
					);
						$this->session->set_userdata($newdata);
				
				}	
				$where_search = array();
					if(isset($user_name_search) && $user_name_search!=""){
						$where_search[] = "users.user_name like '%".$user_name_search."%'";
					}
					if(isset($user_email_search) && $user_email_search!=""){
						$where_search[] = "users.email like '%".$user_email_search."%'";
					}
					if(isset($user_country_search) && $user_country_search!=""){
						$where_search[] = "users.country like '%".$user_country_search."%'";
					}
				$where_search = implode(" and ", $where_search);
					if(strlen($where_search)){
						$where = $where." and ".$where_search;
					}	
			}
			else{
				$this->session->unset_userdata("user_name");
				$this->session->unset_userdata("user_email");
				$this->session->unset_userdata("user_country");
				
			}
		/********/
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}			
}
		/************/
		
		public function get_user_data_by_userid($user_id){
			$result_user_type = $this->findOneBy(array(
			"user_id" => $user_id
		),'users');
			
			return $result_user_type;
		}
		
		public function updateuser(){
			$password=$this->input->post("edit_password");
			$firstname=$this->input->post("edit_firstname");
			$lastname=$this->input->post("edit_lastname");
			$country=$this->input->post("edit_country");
			$city=$this->input->post("edit_city");
			$state=$this->input->post("edit_state");
			$zipcode=$this->input->post("edit_zipcode");
			$user_id=$this->input->post("user_id");
			
			$logged_in_user_id=$this->session->userdata('user_id');
			
		if($password !=""){
			$hashed_pass=hash("sha256",$password,False);
			$update_details=array(
				'password' => $hashed_pass,
				'first_name'=>$firstname,
				'last_name'=>$lastname,
				'country'=>$country,
				'city'=>$city,
				'state'=>$state,
				'zipcode'=>$zipcode,
				'created_by'=>$logged_in_user_id,
				'date_updated'=>date("Y-m-d H:i:s"),
				);
		}else{
			$update_details=array(
				'first_name'=>$firstname,
				'last_name'=>$lastname,
				'country'=>$country,
				'city'=>$city,
				'state'=>$state,
				'zipcode'=>$zipcode,
				'created_by'=>$logged_in_user_id,
				'date_updated'=>date("Y-m-d H:i:s"),
				);
		}
		
				$result=$this->update($update_details,"user_id=$user_id","users");
				return true;
			}
	public function getAllLoginActivities($offset,$limit){
		$params=array(
			'select'=>"login_activities.*",
			'from'=> "login_activities",
			"page" => $offset,
        	"limit" => $limit
			);
			
			$result=$this->find($params);
			if($result !=null){
				return $result;
			}
			else{
				return false;
			}
	}
	
	public function getAllLoginActivitiesforsearch($offset,$limit){
		// echo $offset;
		// exit;
		$params=array(
			'select'=>"*",
			'from'=> "login_activities",
			"page" => $offset,
        	"limit" => $limit
			);
			$where="";
				/*******/
			if($this->uri->slash_segment(3)=="search/")
			 {
			 	if(!$_POST)
				{
					$login_name_search= $this->session->userdata("login_name");
					$status_search= $this->session->userdata("login_status");
					
				}else{
					$login_name_search=$this->input->post("login_name_search");
					$status_search=$this->input->post("status_search");
					$newdata = array(
						'login_name'  => $login_name_search,
						'login_status' => $status_search
					);
					$this->session->set_userdata($newdata);
				
				}
				
				// print_r($this->session->all_userdata());	
				$where_search = array();
					if(isset($login_name_search) && $login_name_search!=""){
						$where_search[] = "user_name like '%".$login_name_search."%'";
					}
					if(isset($status_search) && $status_search!=""){
						$where_search[] = "login_attempt_status = '".$status_search."'";
					}
				$where_search = implode(" and ", $where_search);
					if(strlen($where_search)){
						$where = $where_search;
					}	
			}
			else{
				$this->session->unset_userdata("login_name");
				$this->session->unset_userdata("login_status");
			}
		/********/
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
		if($result !=null){
		//	print_r($result);
			return $result;
		}
		else{
			return false;
		}			
		
	}
	
	public function getalluserscount(){
		$params=array(
			'select'=>"users.*, user_type.front_name ",
			'from'=> "users, user_type",
			'where'=>"users.user_type_id = user_type.user_type_id"
			);
			
			$result=$this->find($params);
			if($result !=null){
				return count($result);
			}
			else{
				return false;
			}
			
	}
	
	/******awais***/
	public function getalluserscountforsearch(){
		$from="users, user_type";
		$where="users.user_type_id = user_type.user_type_id";
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$user_name_search= $this->session->userdata("user_name");;
				$user_email_search= $this->session->userdata("user_email");
				$user_country_search= $this->session->userdata("user_country");
				
			}else{
			
				$user_name_search=$this->input->post("user_name_search");
				$user_email_search=$this->input->post("user_email_search");
				$user_country_search=$this->input->post("user_country_search");
		
					//$ticket_id=$this->input->post("ticket_id");
				$newdata = array(
						'user_name'  => $user_name_search,
						'user_email' => $user_email_search,
						'user_country' => $user_country_search,	
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($user_name_search) && $user_name_search!=""){
				$where_search[] = "users.user_name like '%".$user_name_search."%'";
			}
			if(isset($user_email_search) && $user_email_search!=""){
				$where_search[] = "users.email like '%".$user_email_search."%'";
			}
			if(isset($user_country_search) && $user_country_search!=""){
				$where_search[] = "users.country like '%".$user_country_search."%'";
			}
			
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				$where = $where." and ".$where_search;
				
			}
		}
		
		return $this->count($where,$from);
		

	}
	/***********/
	public function getallloginactivitiescount(){
		$params=array(
			'select'=>"login_activities.*",
			'from'=> "login_activities",
			);
			
			$result=$this->find($params);
			if($result !=null){
				return count($result);
			}
			else{
				return false;
			}
	}
	
	public function getallloginactivitiescountforsearch(){
		$where="";
		if($this->uri->slash_segment(3)=="search/")
		{
			if(!$_POST)
			{
				$login_name_search= $this->session->userdata("login_name");;
				$status_search= $this->session->userdata("login_status");
				
			}else{
			
				$login_name_search=$this->input->post("login_name_search");
				$status_search=$this->input->post("status_search");
				
				$newdata = array(
						'login_name'  => $login_name_search,
						'login_status' => $status_search,
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($login_name_search) && $login_name_search!=""){
				$where_search[] = "user_name like '%".$login_name_search."%'";
			}
			if(isset($status_search) && $status_search!=""){
				$where_search[] = "login_attempt_status = '".$status_search."'";
			}
			
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				$where = $where_search;
				
			}
		}
		return $this->count($where,"login_activities");
		
	}
	
	

}//end of class