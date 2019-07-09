<?php

class Categories_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function addcategory(){
		$categoryname=$this->input->post("categoryname");
		$category_short_text=$this->input->post("categoryshorttext");
		$category_long_text=$this->input->post("categorylongtext");
		$categorydescription=$this->input->post("shortdescription");
		$page_title=$this->input->post("page_title");
		$meta_keywords=$this->input->post("meta_keywords");
		$meta_description=$this->input->post("meta_description");
		$logged_in_user_id=$this->session->userdata('user_id');
		$status=$this->input->post("categorystatus");
		$slug=str_replace(" ","-",$categoryname);
		$sluglower=strtolower($slug);
		$insert_in_categories=array(
			'category_name'=>$categoryname,
			'date_created'=>date("Y-m-d H:i:s"),
			'created_by'=>$logged_in_user_id,
			'category_is_allowed'=>'0',
			'category_short_text'=>$category_short_text,
			'category_long_text'=>$category_long_text,
			'slug'=>$sluglower,
			'meta_description'=>$meta_description,
			'meta_keywords'=>$meta_keywords,
			'page_title'=>$page_title,
			'category_short_description' => $categorydescription,
			'category_is_allowed'=>"$status",
		);
		
		$result_inserted=$this->insert($insert_in_categories,'category');
		return $result_inserted;
	}//end of model function to add category record in the datebase
	
	public function addresources($last_insert_id,$result_file_names){
		
		$resource_url=$this->input->post('resourceurl');
		$logged_in_user_id=$this->session->userdata('user_id');
		//foreach ($result_file_names as $key) {
				$insert_in_resources=array(
				//'category_id'=>$last_inserted_category_id,
				'resource_type'=>$_FILES['userfile']['type'],
				'resource_path'=>upload_file_path."/categories/images/",
				//'created_by'=>$logged_in_user_id,
				//'date_'=>date("Y-m-d H:i:s"),
				'resource_name'=>$result_file_names['uploaded_file']['orig_name'],
			);
		$result=$this->update($insert_in_resources,"category_id=$last_insert_id","category");
	
	
		//$result_inserted=$this->insert($insert_in_resources,'category');
		//}
		return $result;
	}/*end of the function addresources to add resources
	 * to the category and insert the record in databse and specified folder
	 * */
	
	
	public function remove_resources($last_insert_id,$result_file_names){
		
		$resource_url=$this->input->post('resourceurl');
		$logged_in_user_id=$this->session->userdata('user_id');
		//foreach ($result_file_names as $key) {
				$insert_in_resources=array(
				//'category_id'=>$last_inserted_category_id,
				'resource_type'=>$_FILES['userfile']['type'],
				'resource_path'=>dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/",
				//'created_by'=>$logged_in_user_id,
				//'date_'=>date("Y-m-d H:i:s"),
				'resource_name'=>$result_file_names['uploaded_file']['orig_name'],
			);
		$result=$this->update($insert_in_resources,"category_id=$last_insert_id","category");
	
		$CI =& get_instance();
		$CI->session->set_flashdata('success_message', "Category image remove successfully.");
	
		//$result_inserted=$this->insert($insert_in_resources,'category');
		//}
		return $result;
	}/*end of funtion remove_resource too remove a specific resource from the databse
	 * */
	
	
	public function checkuniquecategoryname($categoryname){
		$where = "category_name = '$categoryname'";
		$result = $this->count($where,"category");
		return $result;
	}//end of function checkuniquecategoryname to check if the given name is already present in databse
	
	public function checkuniquecategorynameforedit($categoryname,$category_id){
		$where = "category_name = '$categoryname' AND category_id != '$category_id'";
		$result = $this->count($where,"category");
		return $result;
	/*****getallcategories function returns all the categories including search******/
	}//end of function checkuniquecategoryname to check if the given name is already present in databse
	
	public function getallcategories($offset,$limit){
		$user_type=$this->session->userdata('user_type');
		$params=array(
			'Select'=>"category.*",
			'from'=> "category",
			"page" => $offset,
        	"limit" => $limit
			);
		
		// if($user_type=='super_user'){
			// $where = "";
		// }
		// else{
			// $logged_in_user_id=$this->session->userdata('user_id');
			// $where="category.created_by='$logged_in_user_id'";
		// }
		$where = "";
		/*******/
		 if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$category_name_search= $this->session->userdata("category_name");;
				$status_search= $this->session->userdata("category_is_allowed");
				
			}else{
			
				$category_name_search=$this->input->post("category_name_search");
				$status_search=$this->input->post("status_search");
				
					//$ticket_id=$this->input->post("ticket_id");
				$newdata = array(
						'category_name'  => $category_name_search,
						'category_is_allowed' => $status_search,
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($category_name_search) && $category_name_search!=""){
				$where_search[] = "category_name like '%".$category_name_search."%'";
			}
			if(isset($status_search) && $status_search!=""){
				$where_search[] = "category_is_allowed = '".$status_search."'";
			}
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				//if($user_type!='super_user'){
					$where = $where_search;
				//}
				// else{
					// $where = $where_search;
				// }
			}
			
		}
		else{
			$this->session->unset_userdata("category_name");
			$this->session->unset_userdata("category_is_allowed");
			
		}
	
		/********/
		
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
		return $result;
		
		
		/*******/
		}
	
	/****getallcategoriescount function returns the count of all categories including search ******/
	public function getallcategoriescount(){
		$user_type=$this->session->userdata('user_type');
		// if($user_type=='super_user'){
// 		
			// $where="";
		// }
		// else{
			// $logged_in_user_id=$this->session->userdata('user_id');
			// $where="category.created_by='$logged_in_user_id'";
		// }
			$where="";
		
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$category_name_search= $this->session->userdata("category_name");;
				$status_search= $this->session->userdata("category_is_allowed");
				
			}else{
			
				$category_name_search=$this->input->post("category_name_search");
				$status_search=$this->input->post("status_search");
		
					//$ticket_id=$this->input->post("ticket_id");
				$newdata = array(
						'category_name'  => $category_name_search,
						'category_is_allowed' => $status_search,
						);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($category_name_search) && $category_name_search!=""){
				$where_search[] = "category_name like '%".$category_name_search."%'";
			}
			if(isset($status_search) && $status_search!=""){
				$where_search[] = "category_is_allowed = '".$status_search."'";
			}
			
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
			//if($user_type!='super_user'){
					$where = $where_search;
				//}
				// else{
					// $where = $where_search;
				// }
			}
			
		}
		
		return $this->count($where,"category");
		
	}

	public function getallcategorieshomepage(){
			$params=array(
			'Select'=>"category.*",
			'from'=> "category",
            'where'=>"category_is_allowed!='0'"
			);
		$result=$this->find($params);
		return $result;
	}//end of function getallcategorieshomepage to get all active categories fot the front end 

	public function getcountstorybycategory($categories){
		
		$index=0;
		foreach ($categories as $key){
			$category_id = $key->category_id;
			
			$params=array(
	            'select'=>"Count(story.story_id) As storycount",
	            'from'=> "story",
	            'where'=>"story.category_id='$category_id' AND story.story_is_allowed!='0'",
	            'group_by'=>"story.category_id"
        	);
        	$result=$this->find($params);
        	if(!empty($result)){
        		$categories[$index]->storycount=$result[0]->storycount;
		    }else{
		    	$categories[$index]->storycount=0;
		    }
			$index++;
        }
		return $categories;
    }//get count of category from databasse

	public function getcaregorisbyid($category_id){
		$result_category = $this->findOneBy(array(
			"category_id" => $category_id
		),'category');
			
		return $result_category;
	}//end of function getcategorybyid to get specific category by id 
	
	public function updateResourceById($category_id){
		$update=array(
			'resource_type'=>"",
			'resource_path'=>"",
			'resource_name'=>"",
			'date_update'=>date("Y-m-d H:i:s"),
		);
		$result=$this->update($update,"category_id=$category_id","category");
			$CI =& get_instance();
		$CI->session->set_flashdata('success_message', "Category image remove successfully.");
	
	
		return true;
	}//end of function updateresourcebyid to updte a specific resource by id from database
	
	public function updateCategory($category_id){
		$category_name=$this->input->post('edit_categoryname');
		$logged_in_user_id=$this->session->userdata('user_id');
		$status=$this->input->post("edit_categorystatus");
		$shortdescription=$this->input->post("shortdescription");
		$category_short_text=$this->input->post("categoryshorttext");
		$category_long_text=$this->input->post("categorylongtext");
        $page_title=$this->input->post("page_title");
		$meta_keywords=$this->input->post("meta_keywords");
		$meta_description=$this->input->post("meta_description");
		$slug=str_replace(" ","-",$category_name);
        $sluglower=strtolower($slug);

		$update=array(
			'category_name'=> $category_name,
			'category_is_allowed'=>"$status",
			'date_updated'=>date("Y-m-d H:i:s"),
			'category_short_description' => $shortdescription,
			'category_short_text'=>$category_short_text,
			'category_long_text'=>$category_long_text,
			'created_by'=>$logged_in_user_id,
            'slug'=>$sluglower,
            'meta_description'=>$meta_description,
			'meta_keywords'=>$meta_keywords,
			'page_title'=>$page_title,
		);
		$result=$this->update($update,"category_id=$category_id","category");
		$CI =& get_instance();
		$CI->session->set_flashdata('success_message', "Category has been Updated Successfully");
		
		return true;
	}//end of function updatecategory to update record in database
	
	public function getcategoryid($categoryslug){
		$result_category = $this->findOneBy(array(
			"slug" => $categoryslug
		),'category');
				//echo "<pre>";print_r($result_category);exit;
		
		return $result_category;
	}
	public function getallstorieshomepage($category_id,$fundraising_status){
        $where="story.category_id=category.category_id AND category.category_id='$category_id'
        AND story.story_is_allowed!='0' AND story.fundraising_status='$fundraising_status'";
       	$params = array(
			"select"=>"story.*, category.category_name",
			"from"=>"story, category",
			"where"=>$where,
			"order_by"=>"story.story_id desc"
		);
		$result = $this->find($params);
		//echo "<pre>";print_r($result);exit;
        return $result;
	}//end of function getallstorieshomepage to get all stories from database and show on frontend 
	
	public function getDonationSumOfStoryByCategoryid($category_id){
		//echo "<pre>";print_r($category_id);exit;
        $this->db->select_sum('donation_amount');
        $this->db->select('story.story_id, story.story_id, category.category_id, story.story_name');
        $this->db->from('donations');
        $this->db->from('story');
        $this->db->from('category');
        $this->db->where("story.category_id='$category_id' AND story.story_id=donations.story_id AND story.category_id=category.category_id AND story.story_is_allowed!='0'");
        $this->db->group_by('story.story_id');
        $query = $this->db->get();
        //echo "<pre>";print_r($query);exit;
        $result=$query->result();
       // echo "<pre>";print_r($result);exit;
        return $result;
    }//end of function getdonationSumOFStoryByCategoryid to get sum of doatnion by category from database
	
	public function getresourcesbystoryid($story_id){
		$params=array(
		'Select'=>"resources.story_id, resources.resource_name,resources.resource_id,
		resources.resource_type",
		'from'=> "resources",
		'where'=>"resources.story_id='$story_id'",
        'group_by'=>'resources.story_id'
		);
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}//end of function geresourcebystroyid to get resources by story id from database
	
	public function getstoryfromslug($slug){
        $result_story = $this->findOneBy(array(
            "slug" => $slug,
            "story_is_allowed"=>'1'
        ),'story');
        return $result_story;
    }//end of function getstoryfromslug to get specific story from its slug name from database
	
	public function getcategorynamebyid($category_id){
        $result_category = $this->findOneBy(array(
            "category_id" => $category_id
        ),'category');
        return $result_category;
    }//end of function getcategorynamebyid to get specific categoryname by categoryid from database
    
    public function getallresourcesbystoryid($story_id){
        $params=array(
            'Select'=>"resources.*",
            'from'=> "resources",
            'where'=>"resources.story_id='$story_id'",
        );
        $result=$this->find($params);
        if($result !=null){
            return $result;
        }
        else{
            return false;
        }
    }//end of function getallresourcesbystoryud to get specific resource by story id from database
    
    public function getnameofstorycreator($created_by){
        $result_category = $this->findOneBy(array(
            "user_id" => $created_by
        ),'users');
        return $result_category;
    }//end of function getnameofstorycreattor to get name of the story by created id from database
	
	 public function getdonationsumbystoryid($story_id){
        $this->db->select_sum('donations.donation_amount');
        $this->db->from('donations');
        $this->db->where("donations.story_id='$story_id'");
        $query = $this->db->get();
        $result=$query->result();
        return $result;
    }//end of function get donationsumbystoryid to get specific sotry sum by story id 
	 
	 public function getdonators($story_id){
        $params=array(
            'Select'=>"donations.first_name, donations.last_name",
            'from'=> "donations",
            'where'=>"donations.story_id='$story_id'",
            'limit'=>10,
            'group_by'=>'donations.first_name, donations.last_name'
        );
        $result=$this->find($params);
        if($result !=null){
            return $result;
        }
        else{
            return false;
        }
    }
	 
	public function gethomepagestories($categoryid,$fundraising_status){
		$result=$this->getallstorieshomepage($categoryid,$fundraising_status);
		$donations_sum=$this->getDonationSumOfStoryByCategoryid($categoryid);
		
		
		$index=0;
		foreach ($result as $key) {
            $resources = $this->getresourcesbystoryid($key->story_id);
			/*
			echo "<br>";
						echo "<br>";
						echo "<br>";
						echo "<br>";
						
						echo "<pre>";print_r($resources);exit;
						*/
			$story_donation=$this->getdonationsumbystoryid($key->story_id);
			
					//	echo "<pre>";print_r($story_donation);exit;
	        $remaning_amount_to_fund=$key->fundraising_target-$story_donation[0]->donation_amount;
   			$fundraising_target=$key->fundraising_target;
			$story_total_donation=$story_donation[0]->donation_amount;
			if($fundraising_target>0){
				$donationpercentage=$story_total_donation/$fundraising_target*100;
			}else{
				$donationpercentage=$story_total_donation/1*100;
			}
			
		
            if(!empty($donations_sum[$index])){
                $result[$index]->total_donations=$donations_sum[$index]->donation_amount;
            }
            else{
                $result[$index]->total_donations="0";
            }
			
			$result[$index]->donationpercentage = round($donationpercentage, 2);
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
//echo "<pre>";print_r($result);exit;
		if($result!=0){
			return $result;
		}else{
			return false;
		}
	}
	
}