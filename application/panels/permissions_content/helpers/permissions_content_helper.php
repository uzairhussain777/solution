<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('permissionsvalidation'))
{
	function permissions_validation(){
		
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('group_name', 'Name', 'required|check_unique_group_name');
		
		$CI->load->model('permissions_content/permissions_content_model');
      	$panels=$CI->permissions_content_model->get_all_panels();
     	foreach ($panels as $key => $value) {
        	$permission_name = "r_".$value->panel_id;
			$CI->form_validation->set_rules($permission_name, '', '');
		}
	  
		
			if ($CI->form_validation->run() == FALSE){              
                	$data = array(
	                'group_name' => set_value('group_name'),
	                'error_message' => validation_errors(),
	                'valid'=>0,
	            	);
					
					 foreach ($panels as $key => $value) {
    					$permission_name = "r_".$value->panel_id;
						$data[$permission_name] = set_value($permission_name);
					}
					
             	$CI->session->set_flashdata('error_message','Form Validation Failed');
		    }
            else{
                $data = array(
                'valid' => 1,
                'error_message' => "no validation error"
            	);
			}

		
			$CI->session->set_flashdata('user_add_data', $data);
			return $data['valid'];
	}
}

if ( ! function_exists('editGroupValidation')){
	function editGroupValidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('group_name', 'Group Name', 'required|check_unique_group_name_for_edit');
		$CI->load->model('permissions_content/permissions_content_model');
      	$panels=$CI->permissions_content_model->get_all_panels();
     	foreach ($panels as $key => $value) {
        	$permission_name = "r_".$value->panel_id;
			$CI->form_validation->set_rules($permission_name, '', '');
		}
	  
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'group_name' => set_value('group_name'),
	                'error_message' => validation_errors(),
	                'valid'=>0,
    	        );
    	        
				 foreach ($panels as $key => $value) {
    					$permission_name = "r_".$value->panel_id;
						$data[$permission_name] = set_value($permission_name);
					}
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


if ( ! function_exists('manageGroupValidation')){
	function manageGroupValidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		
		$CI->form_validation->set_rules('group_id', 'Group', 'required');
		
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'group_id' => set_value('group_id'),
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
