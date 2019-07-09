<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
	
	public function addcategory(){
		
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","all");
		//	$this->panels_check_permission($permission);
		}	
		
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_create_categories_form');
	}//end of the function addcategory to view form to add catefgory 
	
	public function addnewcategory(){
		
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","all");
			//$this->panels_check_permission($permission);
		}	
		
		$CI =& get_instance();
		$this -> load -> helper('categories_content/categories_content');
		$this -> load -> model('categories_content/categories_content_model');
		
		$file=$_FILES['userfile'];
		if($_FILES['userfile']['name']!=''){
		
			$file=$_FILES['userfile'];
			$this->load->library("Appuploader");
			$result_file_names=$this->appuploader->do_upload_new();
			$validation=categoriesvalidation();
			if($validation){
				$last_insert_id=$this->categories_content_model->addcategory();
				$result_insert_in_resources=$this->categories_content_model->addresources($last_insert_id,$result_file_names);
				
				if($last_insert_id!=0 && $result_insert_in_resources!=0){
					$CI->session->set_flashdata('success_message', "Category has been added Successfully");
					header("Location:" . $this -> config -> base_url() . "categories/view");
				}
				else{
				//echo "hellooo";
					$CI->session->set_flashdata('error_message','Category is not inserted');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
			else{
				//echo "3";
				$CI->session->set_flashdata('error_message','Form Validation error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
		else{
			//echo "5";
			$validation=categoriesvalidation();
			if($validation){
				
				$result=$this->categories_content_model->addcategory();
				if($result!=0){
					header("Location:" . $this -> config -> base_url() . "categories/view");
				}
				else{
					$CI->session->set_flashdata('error_message','Category is not inserted');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
			else{
				$CI->session->set_flashdata('error_message','Form Validation error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
		
	}//end of the function addnewcategory to add the new category with resources
	
	public function viewcategories(){
			
		$user_type = $this->session->userdata('user_type');
		$permission = "";
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","view");
		//	$this->panels_check_permission($permission);
			$permission=$this->check_permission_modules_core("Categories","all");
			
		}	
		
		$CI =& get_instance();
		$this -> load -> helper('categories_content/categories_content');
		$this -> load -> model('categories_content/categories_content_model');
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		
		$this->load->library("pagination");
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalCategories=$this->categories_content_model->getallcategoriescount();
		
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."categories/search"; 
    	}else{
    		$url= $this -> config -> base_url() ."categories/view"; 
    	}
    
		//$url= $this -> config -> base_url() ."categories/view"; 
		    	
		$pagination_detail = $this->pagination->pagination($totalCategories, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$result=$this->categories_content_model->getallcategories($offset,$per_page);
		$data['categories']=$result;
		$data['permission'] = $permission;
		$this->load->view($user_types.'_view_categories',$data);
		
	}//end of function to view the record of all categories with paginations

	public function homepagecategories(){
		$CI =& get_instance();
		$this -> load -> helper('categories_content/categories_content');
		$this -> load -> model('categories_content/categories_content_model');
		
		$result=$this->categories_content_model->getallcategorieshomepage();
		$result=$this->categories_content_model->getcountstorybycategory($result);
		
		$data['categories']=$result;
		$this->load->view('categories_home_page',$data);
	}//end of function homepagecategories to show the active categories on front end of the site
	
	public function editrecord(){
		
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","all");
			//$this->panels_check_permission($permission);
		}	
		
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);	
		
		$CI =& get_instance();
		$this -> load -> helper('categories_content/categories_content');
		$this -> load -> model('categories_content/categories_content_model');
		$category_id=$this->input->get('categoryid');
		
		$result=$this->categories_content_model->getcaregorisbyid($category_id);
		
		if($result!=false){
			
			$data['result']=$result;
			
			$this->load->view($user_types.'_edit_categories_form',$data);
		}else{
			$CI->session->set_flashdata('error_message','Record not found');
			header("Location:" . $this -> config -> base_url() . "categories/view");	
		}
	}//end of the function editrecord to edit the record of a specific category
	
	public function updateresource($category_id){
			
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","all");
		//	$this->panels_check_permission($permission);
		}		
		
		if(!empty($category_id)){
			$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
			);
			$user_types=$this->check_usertype_modules_core($allowed_user_types);
			$CI =& get_instance();
			
			$this -> load -> helper('categories_content/categories_content');
			$this -> load -> model('categories_content/categories_content_model');
			
			$result=$this->categories_content_model->updateResourceById($category_id);
			$data['result']=$result;
			echo json_encode($data);
			exit;
		}
	}//end of function updatresource to update a resource for a category
	
	public function editcategory(){
		
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Categories","all");
			//$this->panels_check_permission($permission);
		}	
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$CI =& get_instance();
		
		$this -> load -> helper('categories_content/categories_content');
		$this -> load -> model('categories_content/categories_content_model');
		
		if($_FILES['userfile']['name']!=''){
			$file=$_FILES['userfile'];
			$this->load->library("Appuploader");
			$result_file_names=$this->appuploader->do_upload_new();
			$validation=editCategoryValidation();
			if($validation){
				$category_id=$this->input->post('edit_category_id');
				$result=$this->categories_content_model->updateCategory($category_id);
				$result_insert_in_resources=$this->categories_content_model->addresources($category_id, $result_file_names);
				if($result!=false && $result_insert_in_resources!=0){
					header("Location:" . $this -> config -> base_url() . "categories/view");
				}else{
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}else{
				$CI->session->set_flashdata('error_message','Category is not Updated');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}else{
			$validation=editCategoryValidation();
			if($validation){
				$category_id=$this->input->post('edit_category_id');
				
				$result=$this->categories_content_model->updateCategory($category_id);
				
				if($result!=false){
					header("Location:" . $this -> config -> base_url() . "categories/view");
				}else{
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}else{
				$CI->session->set_flashdata('error_message','From Validation Error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}//end of function edit categoruyu to edit record of category with resources

	public function homepagestories(){
		$CI =& get_instance();
		$categoryslug=$this->uri->segment(2);
		$this -> load -> helper('categories_content/categories_content');
		$this -> load -> model('categories_content/categories_content_model');
		$check=$this->categories_content_model->getcategoryid($categoryslug);
		if($check!=false){
			$categoryid=$check->category_id;
			//echo "<pre>";print_r($categoryid);exit;
			$ongoing_stories=0;
			$result_ongoing_stories=$this->categories_content_model->gethomepagestories($categoryid,$ongoing_stories);
			//echo "<pre>";print_r($result_ongoing_stories);exit;
			$completed_stories=1;
			$result_completed_stories=$this->categories_content_model->gethomepagestories($categoryid,$completed_stories);
			
	        //if($result_ongoing_stories!=0){
				$data['stories']=$result_ongoing_stories;
				$data['category_slug']=$categoryslug;
				$data['category_short_text']=$check->category_short_text;
				$data['category_long_text']=$check->category_long_text;
				$data['category_name']=$check->category_name;
			//	$data['completedstories']=$result_completed_stories;
				$this->load->view('stories_home_page',$data);
		}else{
			$this->session->set_flashdata('flash_msg', "Stories Not Found.");
			header("Location:" . $this -> config -> base_url() . "categories");
		
		}
	}//end of function homepagestories to show all the active stories that are complete or not on the frontend

	public function viewstorydetails(){
        $this -> load -> model('categories_content/categories_content_model');
	    $slug=$this->uri->segment(3);

        $result=$this->categories_content_model->getstoryfromslug($slug);
       if($result!=false){
       	    $category_name=$this->categories_content_model->getcategorynamebyid($result->category_id);
	        $resources=$this->categories_content_model->getallresourcesbystoryid($result->story_id);
	        $nameofuser=$this->categories_content_model->getnameofstorycreator($result->created_by);
	        $story_donation=$this->categories_content_model->getdonationsumbystoryid($result->story_id);
	
	        $remaning_amount_to_fund=$result->fundraising_target-$story_donation[0]->donation_amount;
	        $donators=$this->categories_content_model->getdonators($result->story_id);
			
			$fundraising_target=$result->fundraising_target;
			$story_total_donation=$story_donation[0]->donation_amount;
			if($fundraising_target>0){
				$donationpercentage=$story_total_donation/$fundraising_target*100;
			}else{
				$donationpercentage=$story_total_donation/1*100;
			}
			
	        $result->category_name=$category_name->category_name;
	        $result->resources=$resources;
	        $result->nameofcreator=$nameofuser->user_name;
	        $result->remaning_amount_to_fund=$remaning_amount_to_fund;
	        $result->donators=$donators;
			$result->donation_percentage=round($donationpercentage,2);
			
	        $data['result']=$result;
	        $this->load->view('detail_story_home_page',$data);
       }else{
			$this->session->set_flashdata('flash_msg', "Story Not Found.");
			header("Location:" . $this -> config -> base_url() . "categories");
		
		}
	 }//end of function viewstorydetails to show the details of selected story and to donte on it 
}