<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Left_sidebar extends MX_Controller {

    public function index() {
        
       exit;
    }
	
	
	
	public function admin(){
		
		 $group_id=$this->session->userdata('group_id');
		// $this -> load -> model('subjects_content/subjects_content_model');
		 //$permission = $this->subjects_content_model->get_menu_permissions_detail();
		
		$fullname=$this->session->userdata("username");
		$current_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//echo $current_url;exit;
		$base_url = $this->config->base_url();
		$url =  str_replace($base_url, '', $current_url);
		$result = explode("/", $url);
		$name = explode('?', $result[1]);
		$data=array(
		 "fullName"=>$fullname,
		 'type' => $result[0],
		 'name'=> $name[0] ,
		 'permission'=>'dashboard'
		 );
		 
			 //echo "<pre>";print_r($permission);exit;
		//	 $data['permission'] = $permission;
		// echo "<pre>";print_r($data['permission']);exit;
		 $this->load->view('admin_user_left_sidebar',$data);
	}
	
	
}
?>
