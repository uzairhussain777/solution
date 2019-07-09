<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stories_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
	
	public function viewstories(){
		$user_type = $this->session->userdata('user_type');
		$permission = '';
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Stories","view");
			$this->panels_check_permission($permission);
			$permission=$this->check_permission_modules_core("Stories","all");
		
		}	
			
		$CI =& get_instance();
		$this -> load -> helper('stories_content/stories_content');
		$this -> load -> model('stories_content/stories_content_model');
		$this->load->library("pagination");
		
				
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalStories=$this->stories_content_model->getallstoriescountforsearch();
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."stories/search"; 
    	}else{
    		$url= $this -> config -> base_url() ."stories/view"; 
    	}
    	$pagination_detail = $this->pagination->pagination($totalStories, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$result=$this->stories_content_model->getallstoriesforsearch($offset, $per_page);	
		
		//$mergedData=mergeArray($result,$donationSum);
		
		$data['result']=$result;
		$data['permission'] = $permission;
		$this->load->view($user_types.'_view_stories',$data);
	}
	/*Rumman
    end of function viewstories to view all stories on the admin panel
    */
	public function homepagestories(){
		$CI =& get_instance();
		$categoryslug=$this->uri->segment(2);
		$this -> load -> helper('stories_content/stories_content');
		$this -> load -> model('stories_content/stories_content_model');
		$check=$this->stories_content_model->getcategoryid($categoryslug);
		$categoryid=$check->category_id;
		$result=$this->stories_content_model->getallstorieshomepage($categoryid);
		$donations_sum=$this->stories_content_model->getDonationSumOfStoryByCategoryid($categoryid);

		$index=0;
		foreach ($result as $key) {
            $resources = $this->stories_content_model->getresourcesbystoryid($key->story_id);
            if(!empty($donations_sum[$index])){
                $result[$index]->total_donations=$donations_sum[$index]->donation_amount;
            }
            else{
                $result[$index]->total_donations="0";
            }
            if ($resources[0] == null) {
                $result[$index]->resource_name = "";
                $result[$index]->resource_id = "";
                $result[$index]->resource_direct_url = "";
                $result[$index]->resource_type = "";
            } else {
                $result[$index]->resource_name = $resources[0]->resource_name;
                $result[$index]->resource_id = $resources[0]->resource_id;
                $result[$index]->resource_direct_url = $resources[0]->resource_direct_url;
                $result[$index]->resource_type = $resources[0]->resource_type;
            }
            $index++;
        }
		if($result!=0){
			$data['stories']=$result;
			$this->load->view('stories_home_page',$data);
		}else{
			$this->session->set_flashdata('story_flash', "Stories Not Found.");
			header("Location:" . $this -> config -> base_url() . "categories");
		
		}
	}
	/*Rumman
    end of function homepagestories to view active stories on the front end
    */
	
	public function addstories(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Stories","all");
			$this->panels_check_permission($permission);
		}
		
		$CI =& get_instance();
		$this -> load -> helper('stories_content/stories_content');
		$this -> load -> model('stories_content/stories_content_model');
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$data['categories']=$this->stories_content_model->getallcategories();
		$this->load->view($user_types.'_create_stories_form', $data);
	}
	/*Rumman
    end of function addstories to show the view of create stories in the admin panel
    */
	
	public function addnewstory(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Stories","all");
			$this->panels_check_permission($permission);
		}
		
		$CI =& get_instance();
		$this -> load -> helper('stories_content/stories_content');
		$this -> load -> model('stories_content/stories_content_model');
		
		$file=$_FILES['userfile'];
		if($_FILES['userfile']['name'][0]!=''){
			$file=$_FILES['userfile'];
			$this->load->library("Appuploader");
			$result_file_names=$this->appuploader->do_upload();
			if(isset($result_file_names['status'])){
				$validation=failvalidation();
				$CI->session->set_flashdata('file_size_error','File Size increased');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}else{
				$validation=storiesvalidation();
				if($validation){
					$last_insert_id=$this->stories_content_model->addstories();
					$result_insert_in_resources=$this->stories_content_model->addresources($last_insert_id, $result_file_names);
					if($last_insert_id!=0 && $result_insert_in_resources!=0){
						header("Location:" . $this -> config -> base_url() . "stories/view");
					}
					else{
						$CI->session->set_flashdata('error_message','Story is not inserted');
						header("Location:" . $_SERVER['HTTP_REFERER']);
					}
				}
				else{
					$CI->session->set_flashdata('error_message','Form Validation error');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
		}else{
			$validation=storiesvalidation();
			if($validation){
				$result=$this->stories_content_model->addstories();
				if($result!=0){
					header("Location:" . $this -> config -> base_url() . "stories/view");
				}
				else{
					$CI->session->set_flashdata('error_message','Story is not inserted');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
			else{
				$CI->session->set_flashdata('error_message','Form Validation error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
			
		}
				
	}
	/*Rumman
    end of function addnewstory to create stories in the admin panel
    */
	
	public function editstory(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Stories","all");
			$this->panels_check_permission($permission);
		}
		
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$CI =& get_instance();
		$this -> load -> helper('stories_content/stories_content');
		$this -> load -> model('stories_content/stories_content_model');
		
		$story_id=$this->input->get('storyid');
		
		$result=$this->stories_content_model->getrecordstorysbyid($story_id);
		if($result!=false){
			$data['result']=$result;
			$data['categories']=$this->stories_content_model->getallcategories();
			$data['resources']=$this->stories_content_model->getresourcesbystoryidforview($story_id);
			$this->load->view($user_types.'_edit_stories_form',$data);
		}else{
			$CI->session->set_flashdata('error_message','Story Record Not Found');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
		
	}
	/*Rumman
    end of function editstory to show view of the edit stories on the admin panel
    */
	
	public function editstoryrecord(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Stories","all");
			$this->panels_check_permission($permission);
		}
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$CI =& get_instance();
		
		$this -> load -> helper('stories_content/stories_content');
		$this -> load -> model('stories_content/stories_content_model');

		if($_FILES['userfile']['name'][0]!=''){
			$file=$_FILES['userfile'];
			$this->load->library("Appuploader");
			$result_file_names=$this->appuploader->do_upload();
			if(isset($result_file_names['status'])){
				$CI->session->set_flashdata('file_size_error','File Size increased');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}else{
				$validation=editstoriesvalidation();
				if($validation){
					$result=$this->stories_content_model->updatestoryrecord();
					$story_id=$this->input->post('edit_story_id');
					$result_insert_in_resources=$this->stories_content_model->addresources($story_id, $result_file_names);
					if($result!=false && $result_insert_in_resources!=0){
						header("Location:" . $this -> config -> base_url() . "stories/view");
					}else{
						header("Location:" . $_SERVER['HTTP_REFERER']);
					}
				}else{
					$CI->session->set_flashdata('error_message','Story is not inserted');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
			
		}else{
			$validation=editstoriesvalidation();
			if($validation){
				$result=$this->stories_content_model->updatestoryrecord();
				if($result!=false){
					header("Location:" . $this -> config -> base_url() . "stories/view");
				}else{
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}else{
				$CI->session->set_flashdata('error_message','From Validation Error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
	}
	/*Rumman
    end of function editstoryrecord edit the record of the stories and update in database
    */
	
	public function deleteresource($resource_id){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Stories","all");
			$this->panels_check_permission($permission);
		}
		
		if(!empty($resource_id)){
			$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
			);
		//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
			$CI =& get_instance();
			
			$this -> load -> helper('stories_content/stories_content');
			$this -> load -> model('stories_content/stories_content_model');
			
			$result=$this->stories_content_model->deletResourceById($resource_id);
			$data['result']=$result;
			echo json_encode($data);
		}
	}
	/*Rumman
    end of function deleteresource to delete the pictures and videos of the specific stoires
    */
	
	public function ajaxdonationreqbystoryid($story_id){
		if(!empty($story_id)){
			$this -> load -> model('stories_content/stories_content_model');
			
			$totalDonationSum=$this->stories_content_model->totalsumdonations($story_id);
			$donationsByUsers=$this->stories_content_model->donationbyusers($story_id);
			
			$data['totalDonationSum']=$totalDonationSum;
			$data['donationByUser']=$donationsByUsers;
			echo json_encode($data);
		}
	}
	/*Rumman
    end of function ajaxdonationreqbystoryid ajax req function to get the record of the total donations on a specific story
    */

	public function viewstorydetails(){
        $this -> load -> model('stories_content/stories_content_model');
	    $slug=$this->uri->segment('3');

        $result=$this->stories_content_model->getstoryfromslug($slug);
        $category_name=$this->stories_content_model->getcategorynamebyid($result->category_id);
        $resources=$this->stories_content_model->getallresourcesbystoryid($result->story_id);
        $nameofuser=$this->stories_content_model->getnameofstorycreator($result->created_by);
        $story_donation=$this->stories_content_model->getdonationsumbystoryid($result->story_id);

        $remaning_amount_to_fund=$result->fundraising_target-$story_donation[0]->donation_amount;
        $donators=$this->stories_content_model->getdonators($result->story_id);

        $result->category_name=$category_name->category_name;
        $result->resources=$resources;
        $result->nameofcreator=$nameofuser->user_name;
        $result->remaning_amount_to_fund=$remaning_amount_to_fund;
        $result->donators=$donators;
        $data['result']=$result;
        $this->load->view('detail_story_home_page',$data);
    }
    /*Rumman
    end of function viewstorydetails front end function to show the details of a selected story and to donate on it 
    */
}