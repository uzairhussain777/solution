<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_content extends MY_Controller {

    public function index() {
    	exit;
    }
	
	public function __construct() {
		parent::__construct();
	}
	
		public function edit_profile(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
			3=>'registered_user'
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);	
		
		$CI =& get_instance();
		$this -> load -> helper('users_content/users_content');
		$this -> load -> model('users_content/users_content_model');
		//$category_id=$this->input->get('categoryid');
		$user_id=$this->session->userdata('user_id');
		
		$result=$this->users_content_model->getuserbyid($user_id);
		if($result!=false){	
			$data['users']=$result;
			$this->load->view('profile_home_page',$data);
		}else{
			$CI->session->set_flashdata('error_message','User not found');
			header("Location:" . $this -> config -> base_url() . "home");	
		}
	}
	/*functio  to show the profile on the front end */	
	
	public function editprofile(){
		
		$CI =& get_instance();
		$this -> load -> helper('users_content/users_content');
		$this -> load -> model('users_content/users_content_model');
		
		$validation=editProfileValidation();
		if($validation){
			$user_id=$this->session->userdata('user_id');
	
			$result=$this->users_content_model->upadteprofile($user_id);
			if($result != 0){
				$CI->session->set_flashdata('success_message','Profile Updated Successfully');
				header("Location:" . $this -> config -> base_url() . "user/profile");
			}
			else{
				$CI->session->set_flashdata('error_message','User not Updated');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
		else{
			$CI->session->set_flashdata('error_message','Form Validation Error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}	
	}
	/*function edit the record of the profile */
	public function add_user(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
		$this->load->view('create_user_form');
	}
	
	public function view_user(){
		$this -> load -> model('users_content/users_content_model');
		$this->load->library("pagination");
		
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalUsers=$this->users_content_model->getalluserscountforsearch();
		
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."user/search"; 
    	}else{
    		$url= $this -> config -> base_url() ."user/view"; 
    	}
    
		$pagination_detail = $this->pagination->pagination($totalUsers, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$result=$this->users_content_model->getalluserforsearch($offset,$per_page);
		if($result!=0){
			$data['result_all_user']=$result;
			$this->load->view('view_all_user',$data);
		}else{
		//	$CI->session->set_flashdata('error_message','Record not found');
			$this->load->view('view_all_user');
		}
		
	}
	/*function to view user in the admin panel */
	
	public function create_user(){
		$CI =& get_instance();
		$this -> load -> helper('users_content/users_content');
		$this -> load -> model('users_content/users_content_model');
		
		$validate_crete_user=create_user_validation();
		if($validate_crete_user){
			$insert_record=$this->users_content_model->addUser();
			if($insert_record !=0){
				
				$CI->session->set_flashdata('success_message', "User has been added Successfully");
				header("Location:" . $this -> config -> base_url() . "user/view");
			}
			else{
				$CI->session->set_flashdata('error_message', "User has not been added Successfully");
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
		else{
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
	/*function to create new user in the admin panel*/
	
	public function edit_user_details(){
		$CI =& get_instance();
		$this -> load -> helper('users_content/users_content');
		$this -> load -> model('users_content/users_content_model');
		$user_id=$this->input->get('id');
		
		$result_by_user_id=$this->users_content_model->get_user_data_by_userid($user_id);
		
		if($result_by_user_id !=false){
			$data['result']=$result_by_user_id;
			$this->load->view('edit_user_form',$data);
		}
		else{
			$CI->session->set_flashdata('error_message', "User Record not found");
			header("Location:" . $this -> config -> base_url() . "user/view");
		}
	}
	/*function to show the view of the users profile in the admin panel */
	
	public function edituser(){
		$CI =& get_instance();
		$this -> load -> helper('users_content/users_content');
		$this -> load -> model('users_content/users_content_model');
		
		$validation=edituservalidation();
		if($validation){
			$result=$this->users_content_model->updateuser();
			if($result !=0){
				$CI->session->set_flashdata('success_message', "User has been updated Successfully");
				header("Location:" . $this -> config -> base_url() . "user/view");
			}
			else{
				$CI->session->set_flashdata('error_message', "User has not been updated");
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
		else{
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
		
		
	}
	/*function to edit the record of the profile in the databse*/
	
	public function viewloginactivities(){
		$CI =& get_instance();
		$this -> load -> helper('users_content/users_content');
		$this -> load -> model('users_content/users_content_model');
		
		
		$this->load->library("pagination");
		if($this->uri->slash_segment(3)=="search/"){
			$offset = ($this->uri->segment(4) != '' ? $this -> uri -> segment(4): 1);
		}else{
    		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		}
		$per_page = 15;
		
		$totalLoginActivities=$this->users_content_model->getallloginactivitiescountforsearch();
		
		if($this->uri->slash_segment(3)=="search/"){
			$url= $this -> config -> base_url() ."user/loginactivities/search";
		}else{
			$url= $this -> config -> base_url() ."user/loginactivities"; 
    	}
    
		$pagination_detail = $this->pagination->pagination($totalLoginActivities, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$result=$this->users_content_model->getAllLoginActivitiesforsearch($offset,$per_page);
		if($result!=false){
			$data['result']=$result;
			$this->load->view('login_activities',$data);
		}else{
			$this->load->view('login_activities');
		}
	}
	/*function to see the login activities */

}
?>
