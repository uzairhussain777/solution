<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('add_newsletter_validation')){
	function add_newsletter_validation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		if($CI->input->post("newsletterdatetime")!=null){
			$CI->form_validation->set_rules('name', 'Name', 'required|check_unique_name');
			$CI->form_validation->set_rules('selecttemplate', 'Select Template', 'required');
			$CI->form_validation->set_rules('newsletterdatetime', 'Reminder Time And Date', 'required');
			$CI->form_validation->set_rules('sendnewletter', 'Select', 'required');
			if($CI->input->post('selectgroupfornewsletter')){
				$CI->form_validation->set_rules('selectgroupfornewsletter', 'Select Group', 'required');
			}
			if($CI->input->post('selectstoriesdropbox')){
				$CI->form_validation->set_rules('selectstoriesdropbox', 'Select Story', 'required');
			}
			if ($CI->form_validation->run() == FALSE){
				$data = array(	
	                'name' => set_value('name'),
	                'selecttemplate' => set_value('selecttemplate'),
	                'newsletterdatetime' => set_value('newsletterdatetime'),
	                'sendnewletter'=>set_value('sendnewletter'),
	                'selectgroupfornewsletter'=>set_value('selectgroupfornewsletter'),
	                'selectstoriesdropbox'=>set_value('selectstoriesdropbox'),
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
		}else{
			$CI->form_validation->set_rules('name', 'name', 'required|check_unique_name');
			$CI->form_validation->set_rules('selecttemplate', 'Select Template', 'required');
			$CI->form_validation->set_rules('sendnewletter', 'Select', 'required');
			//$CI->form_validation->set_rules('selectgroupfornewsletter', 'Select Group', 'required');
			if ($CI->form_validation->run() == FALSE){
				$data = array(	
	                'name' => set_value('name'),
	                'selecttemplate' => set_value('selecttemplate'),
	                'sendnewletter'=>set_value('sendnewletter'),
	               // 'selectgroupfornewsletter'=>set_value('selectgroupfornewsletter'),
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
}



if ( ! function_exists('edit_newsletter_validation')){
	function edit_newsletter_validation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		if($CI->input->post("newsletterdatetime")!=null){
			$CI->form_validation->set_rules('name', 'Name', 'required|check_unique_name_for_edit_newsletter');
			$CI->form_validation->set_rules('selecttemplate', 'Select Template', 'required');
			$CI->form_validation->set_rules('newsletterdatetime', 'Reminder Time And Date', 'required');
			$CI->form_validation->set_rules('sendnewletter', 'Select', 'required');
			if($CI->input->post('selectgroupfornewsletter')){
				$CI->form_validation->set_rules('selectgroupfornewsletter', 'Select Group', 'required');
			}
			if($CI->input->post('selectstoriesdropbox')){
				$CI->form_validation->set_rules('selectstoriesdropbox', 'Select Story', 'required');
			}
			if ($CI->form_validation->run() == FALSE){
				$data = array(	
	                'name' => set_value('name'),
	                'selecttemplate' => set_value('selecttemplate'),
	                'newsletterdatetime' => set_value('newsletterdatetime'),
	                'sendnewletter'=>set_value('sendnewletter'),
	                'selectgroupfornewsletter'=>set_value('selectgroupfornewsletter'),
	                'selectstoriesdropbox'=>set_value('selectstoriesdropbox'),
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
		}else{
			$CI->form_validation->set_rules('name', 'name', 'required|check_unique_name_for_edit_newsletter');
			$CI->form_validation->set_rules('selecttemplate', 'Select Template', 'required');
			$CI->form_validation->set_rules('sendnewletter', 'Select', 'required');
			//$CI->form_validation->set_rules('selectgroupfornewsletter', 'Select Group', 'required');
			if ($CI->form_validation->run() == FALSE){
				$data = array(	
	                'name' => set_value('name'),
	                'selecttemplate' => set_value('selecttemplate'),
	                'sendnewletter'=>set_value('sendnewletter'),
	               // 'selectgroupfornewsletter'=>set_value('selectgroupfornewsletter'),
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
}