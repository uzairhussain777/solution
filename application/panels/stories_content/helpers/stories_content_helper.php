<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('storiesvalidation'))
{
	function storiesvalidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('storyname', 'Story Name ', 'required|check_unique_story_name');
		$CI->form_validation->set_rules('selectcategory', 'Select Category ', 'required');
        $CI->form_validation->set_rules('storydescription', 'Story Description ', 'required');
		$CI->form_validation->set_rules('fundraisingtarget', 'Fundraising Target ', 'required');
		$CI->form_validation->set_rules('fundraisingstatus', 'Fundraising Status ', 'required');
		$CI->form_validation->set_rules('allowedonsite', 'Allowed on site ', 'required');
		// $CI->form_validation->set_rules('storystatus', 'Story Status', 'required');
		$CI->form_validation->set_rules('page_title', 'Meta Title', 'required');
		$CI->form_validation->set_rules('meta_keywords', 'Meta Keywords ', 'required');
		$CI->form_validation->set_rules('meta_description', 'Meta Description', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'storyname' => set_value('storyname'),
	                'fundraisingtarget' => set_value('fundraisingtarget'),
	                'selectcategory' => set_value('selectcategory'),
                    'storydescription' => set_value('storydescription'),
	                'fundraisingstatus' => set_value('fundraisingstatus'),
	                'allowedonsite' => set_value('allowedonsite'),
	                'storystatus' => set_value('storystatus'),
	                'page_title' => set_value('page_title'),
				     'meta_keywords' => set_value('meta_keywords'),
				     'meta_description' => set_value('meta_description'),
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


if ( ! function_exists('editstoriesvalidation'))
{
	function editstoriesvalidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('edit_storyname', 'Story Name ', 'required|check_unique_edit_story_name');
		$CI->form_validation->set_rules('edit_selectcategory', 'Select Category ', 'required');
        $CI->form_validation->set_rules('edit_storydescription', 'Story Description', 'required');
		$CI->form_validation->set_rules('edit_fundraisingtarget', 'Fundraising Target ', 'required');
		$CI->form_validation->set_rules('edit_fundraisingstatus', 'Fundraising Status ', 'required');
		$CI->form_validation->set_rules('edit_allowedonsite', 'Allowed on site ', 'required');
		// $CI->form_validation->set_rules('edit_storystatus', 'Story Status', 'required');
		$CI->form_validation->set_rules('page_title', 'Meta Title', 'required');
		$CI->form_validation->set_rules('meta_keywords', 'Meta Keywords ', 'required');
		$CI->form_validation->set_rules('meta_description', 'Meta Description', 'required');
		if ($CI->form_validation->run() == FALSE){
                 $data = array(	
	                'edit_storyname' => set_value('edit_storyname'),
	                'edit_fundraisingtarget' => set_value('edit_fundraisingtarget'),
                     'edit_storydescription' => set_value('edit_storydescription'),
	                'edit_selectcategory' => set_value('edit_selectcategory'),
	                'edit_fundraisingstatus' => set_value('edit_fundraisingstatus'),
	                'edit_allowedonsite' => set_value('edit_allowedonsite'),
	                'edit_storystatus' => set_value('edit_storystatus'),
	                'page_title' => set_value('page_title'),
				     'meta_keywords' => set_value('meta_keywords'),
				     'meta_description' => set_value('meta_description'),
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

if ( ! function_exists('mergeArray')){
	function mergeArray($stories, $donations){
		
		// foreach ($stories as $key1 ) {
			// foreach ($donations as $key2) {
				// if($key2->story_id==$key1->story_id){
					// $result[]=						
				// }
			// }
		// }
		// echo "<pre>";
		// print_r($stories);
		// exit;
		$merged=array_merge($stories,$donations);
		return $merged;
	}
}


if ( ! function_exists('failvalidation'))
{
	function failvalidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('storyname', 'Story Name ', 'required|check_unique_story_name');
		$CI->form_validation->set_rules('selectcategory', 'Select Category ', 'required');
        $CI->form_validation->set_rules('storydescription', 'Story Description ', 'required');
		$CI->form_validation->set_rules('fundraisingtarget', 'Fundraising Target ', 'required');
		$CI->form_validation->set_rules('fundraisingstatus', 'Fundraising Status ', 'required');
		$CI->form_validation->set_rules('allowedonsite', 'Allowed on site ', 'required');
		// $CI->form_validation->set_rules('storystatus', 'Story Status', 'required');
		$CI->form_validation->set_rules('page_title', 'Meta Title', 'required');
		$CI->form_validation->set_rules('meta_keywords', 'Meta Keywords ', 'required');
		$CI->form_validation->set_rules('meta_description', 'Meta Description', 'required');
		$CI->form_validation->set_rules('file', '', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'storyname' => set_value('storyname'),
	                'fundraisingtarget' => set_value('fundraisingtarget'),
	                'selectcategory' => set_value('selectcategory'),
                    'storydescription' => set_value('storydescription'),
	                'fundraisingstatus' => set_value('fundraisingstatus'),
	                'allowedonsite' => set_value('allowedonsite'),
	                'storystatus' => set_value('storystatus'),
	                'page_title' => set_value('page_title'),
				     'meta_keywords' => set_value('meta_keywords'),
				     'meta_description' => set_value('meta_description'),
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
