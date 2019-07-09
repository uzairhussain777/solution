
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('login_form_validate'))
{
    function login_form_validate(){
    	
    	$CI =& get_instance();
    	////////////////form validation ///////////////////////

    	$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('email', 'Email address','trim|required|valid_email');
		$CI->form_validation->set_rules('password', 'Password','required');
		$CI->form_validation->set_rules('target_url', 'target_url','trim');
		
		
    	if ($CI->form_validation->run() == FALSE){
                 $data = array(
	                'valid' => 0,
	                'email' => set_value('email'),	
		           	'password' => set_value('password'),	
		           	'target_url' => set_value('target_url'),
	                
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

if ( ! function_exists('register_form_validate'))
{
    function register_form_validate(){
    	
    	$CI =& get_instance();
    	////////////////form validation ///////////////////////

    	$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('firstname', 'First Name','required|max_length[100]');
	    $CI->form_validation->set_rules('lastname', 'Last Name','required|max_length[100]');
	    
		$CI->form_validation->set_rules('email','Email address','trim|required|max_length[150]|valid_email|check_unique_email');
		$CI->form_validation->set_rules('pwd', 'Password','required|min_length[6]|max_length[15]');
		$CI->form_validation->set_rules('cnfpwd', 'Confirm password','required|matches[pwd]');
		
		
    	if ($CI->form_validation->run() == FALSE){
                 $data = array(
	                'valid' => 0,
	                'firstname' => set_value('firstname'),	
		           	'lastname' => set_value('lastname'),	
		           	'email' => set_value('email'),
	                'pwd' => set_value('pwd'),	
		           	'cnfpwd' => set_value('cnfpwd'),
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
		
		$CI->form_validation->set_rules('email', 'Email','trim|required|valid_email');
		
		
    	if ($CI->form_validation->run() == FALSE){
                 $data = array(
	                'valid' => 0,	
		           	'email' => set_value('email'),
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
		
		
		$CI->form_validation->set_rules('password','New password','required|min_length[5]|max_length[20]');
		$CI->form_validation->set_rules('cnfpassword', 'Confirm Password','required|matches[password]');
		
    	if ($CI->form_validation->run() == FALSE){
                 $data = array(
	                'valid' => 0,	
		           	'password' => set_value('password'),
		           	'cnfpassword' => set_value('cnfpassword'),
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