<?php

class Permissions_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function super_admin_add_permissions(){
		$group_name=$this->input->post("group_name");
		$params=array(
			'group_name'=>$group_name,
			'date_created'=>date("Y-m-d H:i:s"),
		);
		$group_id=$this->insert($params,'group_permissions');
		
		
		$panels =  $this->get_all_panels();
		foreach ($panels as $key => $value) {
			$permission_name = "r_".$value->panel_id;
			$params=array(
				'group_id'=>$group_id,
				'panel_id'=>$value->panel_id,
				'panel_permission'=>$this->input->post($permission_name),
				'date_created'=>date("Y-m-d H:i:s"),
			);
			$this->insert($params,'group_permission_details');
		}
		$this->session->set_flashdata('success_message', "Group has been added Successfully");
		return $result_inserted;
	}
	
	
	
	public function super_user_update_group(){
		$group_name=$this->input->post('group_name');
		$group_id=$this->input->post("edit_group_id");
	
		$update=array(
			'group_name'=>$group_name,
			'date_updated'=>date("Y-m-d H:i:s"),
			
		);
		
		$result=$this->update($update,"group_id=$group_id","group_permissions");
		
		$panels =  $this->get_all_panels();
		foreach ($panels as $key => $value) {
			$permission_name = "r_".$value->panel_id;
			$params=array(
				'panel_permission'=>$this->input->post($permission_name),
				'date_updated'=>date("Y-m-d H:i:s"),
			);
			
			$count = $this->count("group_id= $group_id and panel_id = '$value->panel_id'","group_permission_details");
			if($count){
				$result=$this->update($params,"group_id= $group_id and panel_id = '$value->panel_id'","group_permission_details");
			}else{
				$params['group_id'] = $group_id;
				$params['panel_id'] = $value->panel_id;
				$this->insert($params,'group_permission_details');
			}
		}
		return true;
	}
	
	public function super_user_manage_users_update(){
		$group_id=$this->input->post("group_id");
		
		$count = $this->count("group_id = '$group_id'","group_permissions");
		if($count == 0){
			$this->session->set_flashdata('error_message','Group Validation Error');
			return FALSE;
		}
		
		
		
		$option_groups = $this->input->post('option_groups');
		
		$params = array(
					"select"=>"user_id",
					"from"=>"users",
					"where"=> "group_id = '$group_id'"	
			);
		$users = $this->find($params);
		
		foreach ($users as $key => $value) {
			$params=array(
				'group_id'=>NULL,
				'date_updated'=>date("Y-m-d H:i:s")
			);
			$this->update($params,"user_id = '$value->user_id'","users");
		}
		
		foreach ($option_groups as $key => $value) {
			$params=array(
				'group_id'=>$group_id,
				'date_updated'=>date("Y-m-d H:i:s")
			);
			$this->update($params,"user_id = '$value'","users");
		}
		
		return true;
	}
	
	public function addusers(){
		$username=$this->input->post("users");
		foreach($username as $user){		
			$update=array(
			'group_id'=>$this->input->post("groupid"),
			);
			$result=$this->update($update,"user_id=$user","users");
		}				
		$CI =& get_instance();
		$CI->session->set_flashdata('success_message', "Users has been added Successfully");
		return TRUE;
	}

	public function getpermissionid($permission_type){
		$result_id = $this->findOneBy(array(
			"permission_type" => $permission_type
		),'permissions');
			
		return $result_id;
	}
	
	public function getusersid($username){
		//$result_id = $this->findOneBy($username);
			//if($user_type=='super_user'){
		$params=array(
		'Select'=>"users.*",
		'from'=> "users",
		'where'=>"users.user_name='$username'",
		'offset'=>0,
		);
		//}
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}
	/*****getallgroupsforsearch function returns all the records  of permissions including search*******/
	public function getallgroupsforsearch($offset,$limit){
		$user_type=$this->session->userdata('user_type');
		if($user_type=='super_user'){
			$params=array(
			'Select'=>"group_permissions.*",
			'from'=> "group_permissions",
			"page" => $offset,
        	"limit" => $limit
			);
			$where="group_permissions.group_status=1";
		}
		
		 if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$permission_name_search= $this->session->userdata("permission_name");;
				
			}else{
			
				$permission_name_search=$this->input->post("permission_name_search");
				$newdata = array(
						'permission_name'  => $permission_name_search,
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($permission_name_search) && $permission_name_search!=""){
				$where_search[] = "group_name like '%".$permission_name_search."%'";
			}
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				if($user_type=='super_user'){
					$where = $where." and ".$where_search;
				}
			}
			
		}
		else{
			$this->session->unset_userdata("permission_name");
		}
	
		/********/
		
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
		return $result;
		
	}
	
	public function getallgroups($offset,$limit){
		$user_type=$this->session->userdata('user_type');
		if($user_type=='super_user'){
			$params=array(
			'Select'=>"group_permissions.*",
			'from'=> "group_permissions",
			'where'=>"group_permissions.group_status=1",
			"page" => $offset,
        	"limit" => $limit
			);
		}
		$result=$this->find($params);
		return $result;
	}
	
	public function check_unique_group_name($groupname){
		$where = "group_name = '$groupname'";
		$result = $this->count($where,"group_permissions");
		return $result;
	}
	
	public function checkuniquegroupnameforedit($groupname,$group_id){
		$where = "group_name = '$groupname' AND group_id != '$group_id'";
		$result = $this->count($where,"group_permissions");
		return $result;
	}	
	
	public function getoneuser(){
		 $user_type=$this->session->userdata('user_type');
		if($user_type=='super_user'){
			$params=array(
			'Select'=>"users.*",
			'from'=> "users",
			);
		}
	/*
		else{
				$logged_in_user_id=$this->session->userdata('user_id');
				$params=array(
				'Select'=>"category.*",
				'from'=> "category",
				'where'=>"category.created_by='$logged_in_user_id'"
				);
			}*/
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}
	public function get_all_admins(){
		$params=array(
			'select'=>"users.user_id,users.user_name,users.group_id",
			'from'=> "users,user_type",
			'where'=>"user_type.system_name = 'admin' and user_type.user_type_id = users.user_type_id"
			);
		$result=$this->find($params);
		return $result;
	}
	
	public function getallgroupscount(){
		$user_type=$this->session->userdata('user_type');
		if($user_type=='super_user'){
			$params=array(
			'Select'=>"group_permissions.*",
			'from'=> "group_permissions",
			'where'=> "group_status=1",
			);
		}
		/*
		else{
					$logged_in_user_id=$this->session->userdata('user_id');
					$params=array(
					'Select'=>"category.*",
					'from'=> "category",
					'where'=>"category.created_by='$logged_in_user_id'"
					);
				}*/
		
		$result=$this->find($params);
		if($result !=null){
			return count($result);
		}
		else{
			return false;
		}
	}
	
	public function getallgroupscountforsearch(){
		$user_type=$this->session->userdata('user_type');
		if($user_type=='super_user'){
			$where="group_status=1";
		}
		
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST){
				$permission_name_search= $this->session->userdata("permission_name");;
			}
			else{	
				$permission_name_search=$this->input->post("permission_name_search");
				$newdata = array(
						'permission_name'  => $permission_name_search,
						);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($permission_name_search) && $permission_name_search!=""){
				$where_search[] = "group_name like '%".$permission_name_search."%'";
			}
			
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				if($user_type=='super_user'){
					$where = $where." and ".$where_search;
				}
			}
			
		}
		return $this->count($where,"group_permissions");
	}

	public function getallcategorieshomepage(){
			$params=array(
			'Select'=>"category.*",
			'from'=> "category",
            'where'=>"category_is_allowed!='0'"
			);
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
		
		$result=$this->find($params);
		if($result !=null){
			return count($result);
		}
		else{
			return false;
		}
	}
	

	public function getgroupbyid($group_id){
		$result_group = $this->findOneBy(array(
			"group_id" => $group_id
		),'group_permissions');
			
		return $result_group;
	}
	
	public function get_panel_id_by_name($panel_name,$all_panel = NULL)
	{
		if($all_panel == NULL){
			$result_panel = $this->findOneBy(array(
				"panel_name" => $panel_name
			),'panels');
		}else{
			$params = array(
					"select"=>"*",
					"from"=>"panels"
			);
		$result_panel = $this->find($params);
		}
			
		return $result_panel;
	}

	public function get_menu_permissions_detail($group_id)
	{
			$params = array(
					"select"=>"panels.panel_name,group_permission_details.panel_permission",
					"from"=>"panels,group_permission_details",
					"where"=>"group_permission_details.group_id = '$group_id' And panels.panel_id = group_permission_details.panel_id"
			);
		$result_panel = $this->find($params);
		$data = array();
		if(count($result_panel)){
			foreach ($result_panel as $key => $value) {
				$data[$value->panel_name] = $value->panel_permission;
			}
		}else{
			
			$params = array(
					"select"=>"panels.panel_name",
					"from"=>"panels"
			);
			$result_panel = $this->find($params);
			
			foreach ($result_panel as $key => $value) {
				$data[$value->panel_name] = "none";
			}
			
		}
		
		
		
		
			
		return $data;
	}

	public function check_panel_permission($group_id,$panel_id,$panel_permission){
			
			
		$count = $this->count("group_id = '$group_id' and group_status != 'inactive' and group_status != 'delete'",'group_permissions');
		if($count){
			$count = $this->count("group_id = '$group_id' and panel_id = '$panel_id'",'group_permission_details');
			if($count){
				$permission_details = $this->findOneBy(array(
					"group_id" => $group_id,
					"panel_id" => $panel_id
				),'group_permission_details');
					
					
				switch ($permission_details->panel_permission) {
					case 'none':
						return FALSE;
						break;
					
					case 'view':
						if($panel_permission != 'view')
							return FALSE;
						break;
					case 'all':
						if($panel_permission == 'all' || $panel_permission == 'view'){
							return TRUE;
						}else{
							return FALSE;
						}
						break;
					
					default:
						
						break;
				}
				
				// panel_permission = '$panel_permission'
			}
		}
		return $count;
	}


	public function super_admin_delete_group(){
		
		//$group_name=$this->input->post('edit_groupname');
		$group_id=$this->input->get("id");
		//$logged_in_user_id=$this->session->userdata('user_id');
		$status=0;
		$update=array(
			'group_status'=>"delete",
			'date_created'=>date("Y-m-d H:i:s"),
		
			);
		$result=$this->update($update,"group_id=$group_id","group_permissions");
		return true;
	}

	public function get_all_panels()
	{
		$params = array(
					"select"=>"panel_id,panel_name",
					"from"=>"panels"	
			);
		return $this->find($params);
	}	
	
	public function get_group_permission_detail($group_id)
	{
		
		$params = array(
					"select"=>"*",
					"from"=>"group_permission_details",
					"where"=> "group_id = '$group_id'"	
			);
		return $this->find($params);
	}	
	
}