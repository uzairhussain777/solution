<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('login_validation'))
{
    function login_validation(){
    	
    	$CI =& get_instance();
    	////////////////form validation ///////////////////////

    	$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('email', 'Email address','trim|required|valid_email');
		$CI->form_validation->set_rules('password', 'Password','required');
		
		
    	if ($CI->form_validation->run() == FALSE){
                 $data = array(
	                'valid' => 0,
	                'email' => set_value('email'),	
		           	'password' => set_value('password'),	
	                
	           		'error_message' => validation_errors()
    	        );
             
            	$CI->session->set_flashdata('error_message', "Field insertion error");
		    }
            else
            {
                $data = array(
                'valid' => 1,
                'success_message' => "Your enquiry sent successfully."
            );
		//	$CI->session->set_flashdata('success_message', "Your enquiry sent successfully.");
			}
	       $CI->session->set_flashdata('user_add_data', $data);
			return $data['valid'];
                //////////////////form validation end//////////////////
    }
        
}

if ( ! function_exists('forgot_form_validate'))
{
    function forgot_form_validate(){
    	
    	$CI =& get_instance();
    	////////////////form validation ///////////////////////

    	$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('forgot_email', 'Email','trim|required|valid_email');
		
		
    	if ($CI->form_validation->run() == FALSE){
                 $data = array(
	                'valid' => 0,	
		           	'forgot_email' => set_value('forgot_email'),
	           		'error_message' => validation_errors()
    	        );
             
            	$CI->session->set_flashdata('error_message', "Field insertion error");
		    }
            else
            {
                $data = array(
                'valid' => 1,
                'success_message' => "Your enquiry sent successfully."
            );
			//$CI->session->set_flashdata('success_message', "Your enquiry sent successfully.");
			}
	       $CI->session->set_flashdata('user_add_data', $data);
			return $data['valid'];
                //////////////////form validation end//////////////////
    }
        
}



if ( ! function_exists('new_password_form_validate'))
{
    function new_password_form_validate(){
    	
    	$CI =& get_instance();
    	////////////////form validation ///////////////////////

    	$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		
		$CI->form_validation->set_rules('recover_pass','New password','required|min_length[5]|max_length[20]');
		$CI->form_validation->set_rules('conf_recover_pass', 'Confirm Password','required|min_length[5]|max_length[20]|matches[recover_pass]');
		
    	if ($CI->form_validation->run() == FALSE){
                 $data = array(
	                'valid' => 0,	
		           	'recover_pass' => set_value('password'),
		           	'conf_recover_pass' => set_value('cnfpassword'),
	           		'error_message' => validation_errors()
    	        );
             
            	$CI->session->set_flashdata('error_message', "Field insertion error");
		    }
            else
            {
                $data = array(
                'valid' => 1,
                'success_message' => "Your enquiry sent successfully."
            );
		//	$CI->session->set_flashdata('success_message', "Your enquiry sent successfully.");
			}
	       $CI->session->set_flashdata('user_add_data', $data);
			return $data['valid'];
                //////////////////form validation end//////////////////
    }
        
}