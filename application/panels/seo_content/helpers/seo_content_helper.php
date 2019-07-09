<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('seovalidation'))
{
	function seovalidation(){
		
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		$CI->form_validation->set_rules('pagetitle', 'Page Title', 'required');
        $CI->form_validation->set_rules('metadesc', 'Meta Description', 'required');
			
        $CI->form_validation->set_rules('metakey', 'Meta Keywords', 'required');
		$CI->form_validation->set_rules('slug', 'Slug', 'required|check_unique_slug');

		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                 'pagetitle' => set_value('pagetitle'),
                     'metadesc' => set_value('metadesc'),
                     'metakey' => set_value('metakey'),
                     'slug' => set_value('slug'),
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

if ( ! function_exists('editSeoValidation')){
	function editSeoValidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		$CI->form_validation->set_rules('pagetitle', 'Page Title', 'required');
        $CI->form_validation->set_rules('metadesc', 'Meta Description', 'required');
			
        $CI->form_validation->set_rules('metakey', 'Meta Keywords', 'required');
		$CI->form_validation->set_rules('slug', 'Slug', 'required|check_unique_slug_edit');
		
	
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                 'pagetitle' => set_value('pagetitle'),
                     'metadesc' => set_value('metadesc'),
                     'metakey' => set_value('metakey'),
                     'slug' => set_value('slug'),
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