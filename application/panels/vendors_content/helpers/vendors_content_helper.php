<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('vendorsvalidation'))
{
	function vendorsvalidation(){
		
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		$CI->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]');
		$CI->form_validation->set_rules('category', 'category', 'trim|required|min_length[5]');
		
		$CI->form_validation->set_rules('sub_category', 'sub_category Name', 'trim|required');
		$CI->form_validation->set_rules('short_description', 'description', 'trim|required|min_length[5]');
						
      
		if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                 'name' => set_value('name'),
	                 'category' => set_value('category'),
	             
	                 'sub_category' => set_value('sub_category'),
	                 'short_description' => set_value('short_description'),
	                 
	                 'error_message'=>validation_errors(),
                    
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

if ( ! function_exists('array_to_csv'))
{
    function array_to_csv()
    {
    	$fileName = 'mysql-export.csv';
    header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');	
		header('Content-Description: File Transfer');
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename='.$name);
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));exit;
        if ($download != "")
        {    
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
        }        

        ob_start();
		    $this->load->helper('download');
		$f = fopen('php://output', 'w');
        //$f = fopen($download, 'wb') or show_error("Can't open php://output");
        $n = 0;        
        foreach ($array as $line)
        {
            $n++;
            if ( ! fputcsv($f, $line))
            {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();

        if ($download == "")
        {
            return $str;    
        }
        else
        {    
            echo $str;
        }        
    }
}

if ( ! function_exists('query_to_csv'))
{
    function query_to_csv($query, $headers = TRUE, $download = "")
    {
        if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
        {
            show_error('invalid query');
        }
        
        $array = array();
        
        if ($headers)
        {
            $line = array();
            foreach ($query->list_fields() as $name)
            {
                $line[] = $name;
            }
            $array[] = $line;
        }
        
        foreach ($query->result_array() as $row)
        {
            $line = array();
            foreach ($row as $item)
            {
                $line[] = $item;
            }
            $array[] = $line;
        }

        echo array_to_csv($array, $download);
    }
}

/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */

if ( ! function_exists('editvendorsValidation')){
	function editvendorsValidation(){
		$CI =& get_instance();
		
		$CI->load->helper(array('form', 'url','file'));
    	$CI->load->library('form_validation');
		
		$CI->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]');
		$CI->form_validation->set_rules('category', 'category', 'trim|required');
	
		$CI->form_validation->set_rules('sub_category', 'sub_category Name', 'trim|required');
		$CI->form_validation->set_rules('short_description', 'description', 'trim|required|min_length[5]');
				
				
				if ($CI->form_validation->run() == FALSE){
                 
                 $data = array(	
	                'name' => set_value('name'),
	                 'category' => set_value('category'),
	            
	                 'sub_category' => set_value('sub_category'),
	                 'short_description' => set_value('short_description'),
	                 
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
