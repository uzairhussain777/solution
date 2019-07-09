<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class vendors_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
		
    }
	
	public function add_vendors_view(){
		    	//$this->checkAdminSession();
		
		//$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		$CI =& get_instance();
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		
		
		 $user_data = $this->session->userdata('teacher_id');
		 //echo "<pre>";print_r($user_data);exit;
		 
		$this->load->view('create_vendors_content',$data);
	}
	public function warranty_registrar_upload_csv(){
			    	//$this->checkAdminSession();
	
	//upload csv to upload folder
	/*	
	$file_name = 'vendors_'.time().rand(100,999).'.csv';
				{
					$file_data = array(
							"key"=>"uploads/campaign/".$file_name,
							//"content_type" => $_FILES['file']['type'],
							//"tmp_name" => $_FILES['file']['tmp_name']
							);	
				}	
					
					if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $file_data['key'])) {
        				echo "The file ". basename( $_FILES["userfile"]["tmp_name"]). " has been uploaded.";
    				} else {
        				echo "Sorry, there was an error uploading your file.";
    				}
			exit;		
		*/
	$delimiter = "|";  // pipe delimited 
	$newline = "\r\n";
	$enclosure = '"';
 
	$this->load->dbutil(); 
	$this->load->helper('download'); 
 
	$query = $this->db->query("SELECT * FROM vendors "); 
	
	$filename = 'data.csv'; // name of csv file to download with data
	force_download($filename, $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure)); // download file
		 
	exit;
		}
	
	public function create_csv(){
				    	$this->checkAdminSession();
		
				$this->load->view('upload_csv');exit;
		
	        }
	
	public function delete_vendors(){
		//$this->checkAdminSession();
		
		//$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		
		$CI =& get_instance();
		$this -> load -> helper('vendors_content/vendors_content');
		$this -> load -> model('vendors_content/vendors_content_model');
	
		$result=$this->vendors_content_model->admin_delete_vendors();
		if($result != 0){
			$CI->session->set_flashdata('success_message','vendors Successfully Deleted');
			header("Location:" . $this -> config -> base_url() . "vendors/view");
		}
		else{
			$CI->session->set_flashdata('error_message','Admin is not Deleted');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
	
	
	public function addnewvendors(){
		//$this->checkAdminSession();
		
		//$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		
			
	$CI =& get_instance();
		$this -> load -> helper('vendors_content/vendors_content');
		$this -> load -> model('vendors_content/vendors_content_model');
		$name=$this->input->post('name');
		$validation=vendorsvalidation();
			if($validation){		
				$result=$this->vendors_content_model->addvendors();
				if($result!=0){
					$CI->session->set_flashdata('success_message', "vendors has been added Successfully");
					header("Location:" . $this -> config -> base_url() . "vendors/view");
				}
				else{
					$CI->session->set_flashdata('error_message','vendors is not inserted');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
			else{
				$CI->session->set_flashdata('error_message','Form Validation error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
	}
	
	public function view_detail_vendors(){
		//$this->checkAdminSession();
		
	//	$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		$CI =& get_instance();
		$this -> load -> helper('vendors_content/vendors_content');
		$this -> load -> model('vendors_content/vendors_content_model');
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;	
		
		$vendors_id=$this->input->get('vendors_id');
		
		$result=$this->vendors_content_model->getvendorsbyid($vendors_id);
	//	echo "<pre>";print_r($result);exit;
		$data['result']=$result;
		$this->load->view('view_details_vendors_content',$data);
	}
	
	public function view_all_vendors(){
		//	$this->checkAdminSession();
			
	//	$access=$this->check_super_admin();
		//		$this->check_permission_access($access);
				$CI =& get_instance();
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;	
		
		
		
		$this -> load -> helper('vendors_content/vendors_content');
		$this -> load -> model('vendors_content/vendors_content_model');
		$this->load->library("pagination");

		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalvendors=$this->vendors_content_model->getallvendorscount();
		
		
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."vendors/search"; 
    	}
    	else{
    		$url= $this -> config -> base_url() ."vendors/view"; 
    	}	
		
		/*
		echo $totalvendors;
		echo "<br>";
		echo $per_page;
		echo "<br>";
		echo $offset;
		echo "<br>";
		echo $url;
		
		echo "<br>";
		*/
		
		$pagination_detail = $this->pagination->pagination($totalvendors, $per_page, $offset, $url);
		//echo "<pre>";print_r($pagination_detail);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		//print_r($data['paginglinks']);
		//echo "<br>";
		//echo "<pre>";print_r($data['pagermessage']);
		
	//	echo "<br>";
		//exit;
		
		$result=$this->vendors_content_model->getallvendors($offset,$per_page);
		
		$data['total']=$totalvendors;
		//echo "<pre>";print_r($data['total']);exit;
	
		$data['vendors']=$result;
		//echo "<pre>";print_r($data['vendors']);exit;
		$this->load->view('view_vendors_content',$data);
	}
	
	public function admin_edit_vendors(){
			   // 	$this->checkAdminSession();
	
	//$access=$this->check_super_admin();
		//		$this->check_permission_access($access);
		
		$CI =& get_instance();
		$this -> load -> helper('vendors_content/vendors_content');
		$this -> load -> model('vendors_content/vendors_content_model');
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	
		$data['success_message']= $success_message;
		$data['error_message']= $error_message;
		$data['user_add_data']=$user_add_data;
		
		 
		 $vendors_id=$this->input->get('vendors_id');
		//echo "<pre>";print_r($vendors_id);exit;
		$result=$this->vendors_content_model->getvendorsbyid($vendors_id);
		$data['result']=$result;
			$this->load->view('edit_vendors_content',$data);
	}
	
	public function admin_update_vendors(){
				    //	$this->checkAdminSession();
		
	//$access=$this->check_super_admin();
		//		$this->check_permission_access($access);
				$CI =& get_instance();
		
		$this -> load -> helper('vendors_content/vendors_content');
		$this -> load -> model('vendors_content/vendors_content_model');
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	
		$data['success_message']= $success_message;
		$data['error_message']= $error_message;
		$data['user_add_data']=$user_add_data;
		$validation=editvendorsValidation();
		if($validation){
			$vendors_id=$this->input->post('edit_id');
			
			
			//echo $vendors_id;exit;
			$result=$this->vendors_content_model->updatevendors($vendors_id);
			
			if($result!=0){
				$CI->session->set_flashdata('success_message','vendors has been Updated Successfully');
				header("Location:" . $this -> config -> base_url() . "vendors/view");
			}else{
				$CI->session->set_flashdata('error_message','vendors is not Updated');
				header("Location:" . $this->cofig->base_url()."vendors/view");
			}
		}
		else{
			$CI->session->set_flashdata('error_message','From Validation Error');exit;
			header("Location:" . $this->cofig->base_url()."vendors/view");
		}
	}
}