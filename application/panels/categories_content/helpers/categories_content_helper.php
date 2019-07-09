<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('categoriesvalidation'))
{
	function categoriesvalidation(){
		
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		$CI->form_validation->set_rules('categoryname', 'Category Name', 'required|check_unique_category_name');
        $CI->form_validation->set_rules('categoryshorttext', 'Category Short Text', 'required');
        $CI->form_validation->set_rules('categorylongtext', 'Category Long Text', 'required');
		$CI->form_validation->set_rules('shortdescription', 'Short Description ', 'required');
		$CI->form_validation->set_rules('page_title', 'Meta Title', 'required');
		$CI->form_validation->set_rules('meta_keywords', 'Meta Keywords ', 'required');
		$CI->form_validation->set_rules('meta_description', 'Meta Description', 'required');
		
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                 'categoryname' => set_value('categoryname'),
                     'categoryshorttext' => set_value('categoryshorttext'),
                     'categorylongtext' => set_value('categorylongtext'),
                     'shortdesciption' => set_value('shortdescription'),
				     'page_title' => set_value('page_title'),
				     'meta_keywords' => set_value('meta_keywords'),
				     'meta_description' => set_value('meta_description'),
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

if ( ! function_exists('editCategoryValidation')){
	function editCategoryValidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('edit_categoryname', 'Category Name', 'required|check_unique_category_name_for_edit');
		$CI->form_validation->set_rules('shortdescription', 'Short Description ', 'required');
		$CI->form_validation->set_rules('categoryshorttext', 'Category Short Text', 'required');
        $CI->form_validation->set_rules('categorylongtext', 'Category Long Text', 'required');
		$CI->form_validation->set_rules('page_title', 'Meta Title', 'required');
		$CI->form_validation->set_rules('meta_keywords', 'Meta Keywords ', 'required');
		$CI->form_validation->set_rules('meta_description', 'Meta Description', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'categoryname' => set_value('edit_categoryname'),
	               	 'shortdescription' => set_value('shortdescripton'),
		               'categoryshorttext' => set_value('categoryshorttext'),
                     'categorylongtext' => set_value('categorylongtext'),
             	     'page_title' => set_value('page_title'),
				     'meta_keywords' => set_value('meta_keywords'),
				     'meta_description' => set_value('meta_description'),
			
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
