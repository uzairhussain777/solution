<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Controller {
	
	
	public function add(){
			
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","all");
			//$this->panels_check_permission($permission);
		}		
			
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		//$this->load->view($user_types.'_add_categories', $data);
	}//end of module core function to add record to add record in categories
	
	public function search(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","view");
			//$this->panels_check_permission($permission);
		}	
			
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
      //  $this->load->view($user_types.'_view_categories');   
    }
	
	public function edit(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","all");
			//$this->panels_check_permission($permission);
		}		
			
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		//$this->load->view($user_types.'_edit_categories', $data);
	}//end of module core function to edit record to eedit the record of categories
	
	public function view(){
			
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","view");
			//$this->panels_check_permission($permission);
		}	
			
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		//$this->load->view($user_types.'_view_categories', $data);
	}//end of function view to view all record of categories
	
	public function index($cat_sulg='',$story_slug=''){
			//echo $cat_sulg;
		//	echo $story_slug;exit;
		$success_message=$this->session->flashdata('success_message');
        $error_message=$this->session->flashdata('error_message');
        $user_add_data=$this->session->flashdata('user_add_data');
        $email_validation_fail=$this->session->flashdata('email_validation_fail');
        $email_not_found=$this->session->flashdata('email_not_found');
        $email_found_success=$this->session->flashdata('email_found_success');
        $success_conformation_code=$this->session->flashdata('success_conformation_code');
        $error_conformation_code=$this->session->flashdata('error_conformation_code');
        $invalid_email_pass=$this->session->flashdata('invalid_email_pass');
        $signup=$this->session->flashdata('signup_error');
        $success=$this->session->flashdata('success');
        $error_reset_password=$this->session->flashdata('error_reset_password');
        $Temp_user=$this->session->flashdata('Temp_user');
		$donation_validation_error=$this->session->flashdata('donation_validation_error');
		$donation_error=$this->session->flashdata('donation_error');
		$card_error=$this->session->flashdata('card_error');
		
        $data['error_message']= $error_message;
		$data['donation_error']= $donation_error;
        $data['success_message']= $success_message;
        $data['user_add_data'] = $user_add_data;
        $data['email_validation_fail'] = $email_validation_fail;
        $data['email_not_found'] = $email_not_found;
        $data['email_found_success'] = $email_found_success;
        $data['success_conformation_code'] = $success_conformation_code;
        $data['error_conformation_code'] = $error_conformation_code;
        $data['invalid_email_pass'] = $invalid_email_pass;
        $data['signup_error'] = $signup;
        $data['success'] = $success;
        $data['error_reset_password'] = $error_reset_password;
        $data['Temp_user'] = $Temp_user;
		$data['donation_validation_error'] = $donation_validation_error;
		$data['card_error'] = $card_error;
   
		if(strlen($story_slug)){
			$this->load->view('detail_story_home_page_view', $data);
		}
		elseif(strlen($cat_sulg)){
			//echo "string";exit;
			$this->load->view('stories_home_page_view', $data);
		}
		else{
			$this->load->view('categories_home_page_view', $data);
		}

    }
/*end of function index for the front view of site to show the reocrd of stories
 * categories and the detail of stories to donate on a specific story 
 * this function is used in front pages of sites and the flassh data are set 
 * for displaying messages and to open popups again in case of error 
 *  */
}