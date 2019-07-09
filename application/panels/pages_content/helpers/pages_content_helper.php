<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('pagevalidation'))
{
	function pagevalidation(){
		
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		$CI->form_validation->set_rules('pagetitle', 'Page Title', 'required');
        $CI->form_validation->set_rules('metadesc', 'Meta Description', 'required');
			
        $CI->form_validation->set_rules('metakey', 'Meta Keywords', 'required');
		$CI->form_validation->set_rules('slug', 'Slug', 'required|check_unique_slug_page');
		$CI->form_validation->set_rules('pagehead', 'Page Heading', 'required');
		$CI->form_validation->set_rules('pagecontent', 'Page Content', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                 'pagetitle' => set_value('pagetitle'),
                     'metadesc' => set_value('metadesc'),
                     'metakey' => set_value('metakey'),
                     'slug' => set_value('slug'),
				     'pagehead' => set_value('pagehead'),
				     'pagecontent' => set_value('pagecontent'),
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

if ( ! function_exists('editPageValidation')){
	function editPageValidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		$CI->form_validation->set_rules('pagetitle', 'Page Title', 'required');
        $CI->form_validation->set_rules('metadesc', 'Meta Description', 'required');
			
        $CI->form_validation->set_rules('metakey', 'Meta Keywords', 'required');
		$CI->form_validation->set_rules('slug', 'Slug', 'required|check_unique_slug_page_edit');
		$CI->form_validation->set_rules('pagehead', 'Page Heading', 'required');
		$CI->form_validation->set_rules('pagecontent', 'Page Content', 'required');
		
	
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                 'pagetitle' => set_value('pagetitle'),
                     'metadesc' => set_value('metadesc'),
                     'metakey' => set_value('metakey'),
                     'slug' => set_value('slug'),
                     'pagehead' => set_value('pagehead'),
				     'pagecontent' => set_value('pagecontent'),
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