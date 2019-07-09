<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('create_user_validation')){
	
	 function create_user_validation(){
	 	$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('email', 'email', 'required|valid_email|check_unique_email');
     	$CI->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[15]');
		$CI->form_validation->set_rules('username', 'User Name', 'required|check_unique_user_name');
		$CI->form_validation->set_rules('firstname', 'First Name', 'required');
		$CI->form_validation->set_rules('lastname', 'last Name', 'required');
		$CI->form_validation->set_rules('country', 'Country', 'required');
		$CI->form_validation->set_rules('city', 'City', 'required');
		$CI->form_validation->set_rules('state', 'State', 'required');
		$CI->form_validation->set_rules('zipcode', 'Zip Code', 'required');
		$CI->form_validation->set_rules('systemtype', 'systemtype', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'password' => set_value('password'),
	                'email' => set_value('email'),
	                'username'=>set_value('username'),
	                'firstname'=>set_value('firstname'),
	                'lastname'=>set_value('lastname'),
	                'country'=>set_value('country'),
	                'city'=>set_value('city'),
	                'state'=>set_value('state'),
	                'zipcode'=>set_value('zipcode'),
	                'systemtype'=>set_value('systemtype'),
	                'valid'=>0,
	                'error_message' => validation_errors(),
    	        );
             	$CI->session->set_flashdata('error_message','Form Validation Failed');
		    }
            else
            {
                $data = array(
                'valid' => 1,
                'error_message' => "no validation error"
            	);
			}
			$CI->session->set_flashdata('user_add_data', $data);
			return $data['valid'];
		
	 }

	
}

if ( ! function_exists('edituservalidation')){
	
	 function edituservalidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('edit_firstname', 'First Name', 'required');
		$CI->form_validation->set_rules('edit_lastname', 'last Name', 'required');
		$CI->form_validation->set_rules('edit_country', 'Country', 'required');
		$CI->form_validation->set_rules('edit_city', 'City', 'required');
		$CI->form_validation->set_rules('edit_state', 'State', 'required');
		$CI->form_validation->set_rules('edit_zipcode', 'Zip Code', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'first_name'=>set_value('edit_firstname'),
	                'last_name'=>set_value('edit_lastname'),
	                'country'=>set_value('edit_country'),
	                'city'=>set_value('edit_city'),
	                'state'=>set_value('edit_state'),
	                'zipcode'=>set_value('edit_zipcode'),
	                'valid'=>0,
	                'error_message' => validation_errors(),
    	        );
             	$CI->session->set_flashdata('error_message','Form Validation Failed');
		    }
            else
            {
                $data = array(
                'valid' => 1,
                'error_message' => "no validation error"
            	);
			}
			$CI->session->set_flashdata('user_add_data', $data);
			return $data['valid'];
		
	}
	
}
if ( ! function_exists('editProfileValidation')){
	function editProfileValidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		$CI->form_validation->set_rules('password', 'Password ', 'min_length[8]|max_length[15]');
		$CI->form_validation->set_rules('re_password', 'Re-Password ', 'min_length[8]|max_length[15]');
		
		$CI->form_validation->set_rules('first_name', 'First Name ', 'required');
		$CI->form_validation->set_rules('last_name', 'Last Name ', 'required');
		$CI->form_validation->set_rules('country', 'Country ', 'required');
		
		$CI->form_validation->set_rules('city', 'City ', 'required');
		$CI->form_validation->set_rules('state', 'State ', 'required');
		$CI->form_validation->set_rules('zipcode', 'Zip Code ', 'required');
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'categoryname' => set_value('first_name'),
	                'last_name' => set_value('last_name'),
	                 'password' => set_value('password'),
	               're_password' => set_value('re_password'),
	               
	                'country' => set_value('country'),
	                'city' => set_value('city'),
	                'state' => set_value('state'),
	                'zipcode' => set_value('zipcode'),
	                'error_message' => validation_errors(),
	                'valid'=>0,
    	        );
             	$CI->session->set_flashdata('error_message','Form Validation Failed');
		    }
            else
            {
                $data = array(
                'valid' => 1,
                'error_message' => "no validation error"
            	);
			}
			$CI->session->set_flashdata('user_add_data', $data);
			return $data['valid'];
	}
	
}