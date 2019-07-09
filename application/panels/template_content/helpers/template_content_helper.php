<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('templatevalidation'))
{
	function templatevalidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('templatename', 'Template Name ', 'required|check_unique_template_name');
		$CI->form_validation->set_rules('templatesubject', 'Template Subject ', 'required');
		$CI->form_validation->set_rules('templatetype', 'Select Template Type ', 'required');
		$CI->form_validation->set_rules('templatetextbody', 'Template Text Body ', 'required');
		$CI->form_validation->set_rules('templatehtmlbody', 'Template Html Body ', 'required');
		$CI->form_validation->set_rules('fromname', 'From Name', 'required');
		$CI->form_validation->set_rules('fromemail', 'From Email', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'templatename' => set_value('templatename'),
	                'templatesubject' => set_value('templatesubject'),
	                'templatetype' => set_value('templatetype'),
	                'templatetextbody' => set_value('templatetextbody'),
	                'templatehtmlbody' => set_value('templatehtmlbody'),
	                'fromname' => set_value('fromname'),
	                'fromemail'=>set_value('fromemail'),
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


if ( ! function_exists('edittemplatevalidation'))
{
	 function edittemplatevalidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('edit_templatename', 'Template Name ', 'required|check_unique_template_name_edit');
		$CI->form_validation->set_rules('edit_templatesubject', 'Template Subject ', 'required');
		$CI->form_validation->set_rules('edit_templatetype', 'Select Temelate Type ', 'required');
		$CI->form_validation->set_rules('edit_templatetextbody', 'Template Text Body ', 'required');
		$CI->form_validation->set_rules('edit_templatehtmlbody', 'Template Html Body ', 'required');
		$CI->form_validation->set_rules('edit_fromname', 'From Name', 'required');
		$CI->form_validation->set_rules('edit_fromemail', 'From Email', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'edit_templatename' => set_value('edit_templatename'),
	                'edit_templatesubject' => set_value('edit_templatesubject'),
	                'edit_templatetype' => set_value('edit_templatetype'),
	                'edit_templatetextbody' => set_value('edit_templatetextbody'),
	                'edit_templatehtmlbody' => set_value('edit_templatehtmlbody'),
	                'edit_fromname' => set_value('edit_fromname'),
	                'edit_fromemail'=>set_value('edit_fromemail'),
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