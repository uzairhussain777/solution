<?php

class Stories_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	
	public function getallstories($offset,$limit){
		$user_type=$this->session->userdata('user_type');
		//if($user_type=='super_user'){
			$params=array(
			'Select'=>"story.*, category.category_name",
			'from'=> "story, category",
			'where'=>"story.category_id=category.category_id",
			"page" => $offset,
        	"limit" => $limit
			);
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}
	public function getcategoryid($categoryslug){
		$result_category = $this->findOneBy(array(
			"slug" => $categoryslug
		),'category');
		return $result_category;
	}
	public function getallstorieshomepage($category_id){
        $where="story.category_id=category.category_id AND category.category_id='$category_id'
        AND story.story_is_allowed!='0'";
        $this->db->select('story.*, category.category_name');
        $this->db->from('story, category');
        $this->db->where($where);
        $query = $this->db->get();
        $result=$query->result();
        return $result;
	}
	
	public function getDonationSumOfStory(){
		$this->db->select_sum('donation_amount');
		$this->db->select('story.story_id');
		$this->db->from('donations');
		$this->db->from('story');
		$this->db->where("story.story_id=donations.story_id");
		$this->db->group_by('story.story_id'); 
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}

	public function getDonationSumOfStoryByCategoryid($category_id){
        $this->db->select_sum('donation_amount');
        $this->db->select('story.story_id, story.story_id, category.category_id, story.story_name');
        $this->db->from('donations');
        $this->db->from('story');
        $this->db->from('category');
        $this->db->where("story.category_id='$category_id' AND story.story_id=donations.story_id AND story.category_id=category.category_id AND story.story_is_allowed!='0'");
        $this->db->group_by('story.story_id');
        $query = $this->db->get();
        $result=$query->result();
        return $result;
    }
	
	public function getcategoriesidsfromstorytable(){
		$params=array(
		'Select'=>"category_id",
		'from'=> "story",
		);
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}

	public function getallcategories(){
		$params=array(
		'Select'=>"category.*",
		'from'=> "category",
		);
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}
	
	public function checkuniquestoryname($storyname){
		$where = "story_name = '$storyname'";
		$result = $this->count($where,"story");
		return $result;
	}
	
	public function addstories(){
		$storyname=$this->input->post('storyname');
		$category=$this->input->post('selectcategory');
        $storydescription=$this->input->post('storydescription');
		$fundraisingtarget=$this->input->post('fundraisingtarget');
		$fundraisingstatus=$this->input->post('fundraisingstatus');
		$allowedonsite=$this->input->post('allowedonsite');
		// $storystatus=$this->input->post('storystatus');
		$page_title=$this->input->post("page_title");
		$meta_keywords=$this->input->post("meta_keywords");
		$meta_description=$this->input->post("meta_description");
		$logged_in_user_id=$this->session->userdata('user_id');
        $slug=str_replace(" ","-",$storyname);
        $sluglower=strtolower($slug);

		$insert_in_stories=array(
			'story_name'=>$storyname,
			'category_id'=>$category,
			'story_description'=>$storydescription,
			'fundraising_target'=>$fundraisingtarget,
			'fundraising_status'=>$fundraisingstatus,
			'story_is_allowed'=>$allowedonsite,
			// 'story_is_donated'=>$storystatus,
			'created_by'=>$logged_in_user_id,
			'meta_description'=>$meta_description,
			'meta_keywords'=>$meta_keywords,
			'page_title'=>$page_title,
			'date_created'=>date("Y-m-d H:i:s"),
            'slug'=>$sluglower,
		);
		
		$result_inserted=$this->insert($insert_in_stories,'story');
		$CI =& get_instance();
		$CI->session->set_flashdata('success_message', "Story has been Created Successfully");
	
		return $result_inserted;
	}
	
	public function addresources($last_inserted_story_id, $result_file_names){
		$resource_url=$this->input->post('resourceurl');
		$logged_in_user_id=$this->session->userdata('user_id');
		foreach ($result_file_names as $key) {
				$insert_in_resources=array(
				'story_id'=>$last_inserted_story_id,
				'resource_type'=>$_FILES['userfile']['type'],
				'resource_path'=>$key->path,
				'resource_direct_url'=>$resource_url,
				'created_by'=>$logged_in_user_id,
				'date_created'=>date("Y-m-d H:i:s"),
				'resource_name'=>$key->name
			);
		$result_inserted=$this->insert($insert_in_resources,'resources');
		}
		return $result_inserted;
	}

	public function getrecordstorysbyid($story_id){
		$result_story = $this->findOneBy(array(
			"story_id" => $story_id
		),'story');
		return $result_story;
	}
	
	public function getresourcesbystoryid($story_id){
		$params=array(
		'select'=>"resources.story_id, resources.resource_name,resources.resource_id,
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
	}
	
	public function getresourcesbystoryidforview($story_id){
		$params=array(
		'select'=>"resources.story_id, resources.resource_name,resources.resource_id,
			resources.resource_type",
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
	}

	public function checkuniqueeditstoryname($story_name,$story_id){
		$where = "story_name = '$story_name' AND story_id != '$story_id'";
		$result = $this->count($where,"story");
		return $result;
	}

	public function deletResourceById($resource_id){
		$where="resource_id='$resource_id'";
		$result=$this->delete($where,"resources");
		return $result;
	}

	public function updatestoryrecord(){
		$story_name=$this->input->post('edit_storyname');
		$category_id=$this->input->post("edit_selectcategory");
        $story_description=$this->input->post("edit_storydescription");
		$logged_in_user_id=$this->session->userdata('user_id');
		$fundraisingtarget=$this->input->post("edit_fundraisingtarget");
		$fundraisingstatus=$this->input->post("edit_fundraisingstatus");
		$allowedonsite=$this->input->post("edit_allowedonsite");
		// $storystatus=$this->input->post("edit_storystatus");
		$page_title=$this->input->post("page_title");
		$meta_keywords=$this->input->post("meta_keywords");
		$meta_description=$this->input->post("meta_description");
		$story_id=$this->input->post('edit_story_id');

        $slug=str_replace(" ","-",$story_name);
        $sluglower=strtolower($slug);
		
		$update_in_stories=array(
			'story_name'=>$story_name,
			'category_id'=>$category_id,
            'story_description'=>$story_description,
			'fundraising_target'=>$fundraisingtarget,
			'fundraising_status'=>$fundraisingstatus,
			'story_is_allowed'=>$allowedonsite,
			// 'story_is_donated'=>$storystatus,
			'created_by'=>$logged_in_user_id,
			'meta_description'=>$meta_description,
			'meta_keywords'=>$meta_keywords,
			'page_title'=>$page_title,
			'date_update'=>date("Y-m-d H:i:s"),
            'slug'=>$sluglower,
		);
		$result=$this->update($update_in_stories,"story_id=$story_id","story");
		$CI =& get_instance();
		$CI->session->set_flashdata('success_message', "Story has been Updated Successfully");
	
		return true;
	}
	
	public function totalsumdonations($story_id){
		$this->db->select_sum('donations.donation_amount');
		$this->db->select('story.story_name');
		$this->db->from('donations');
		$this->db->from('story');
		$this->db->where('story.story_id=donations.story_id');
		$this->db->where("story.story_id='$story_id'");
		$this->db->group_by('story.story_id'); 
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}
	
	public function donationbyusers($story_id){
		$this->db->select('users.user_name');
		$this->db->from('donations');
		$this->db->from('users');
		$this->db->where('donations.user_id=users.user_id');
		$this->db->where("donations.story_id='$story_id'");
		$this->db->group_by('users.user_id');
		$query=$this->db->get();
		$result=$query->result();
		return $result;
		
	}
	
	public function getallstoriescount(){
		$params=array(
			'Select'=>"story.*",
			'from'=> "story",
			);
		$result=$this->find($params);
		return count($result);
	}
	/******awais*****/
	public function getallstoriescountforsearch(){
			
		$where = "";	
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$story_name_search= $this->session->userdata("story_name");;
				$status_search= $this->session->userdata("is_donated");
				$site_status_search= $this->session->userdata("story_is_allowed");
				
			}else{
			
				$story_name_search=$this->input->post("story_name_search");
				$site_status_search=$this->input->post("site_status_search");
				$status_search=$this->input->post("status_search");
		
					//$ticket_id=$this->input->post("ticket_id");
				$newdata = array(
						'story_name'  => $story_name_search,
						'story_is_allowed' => $site_status_search,
						'is_donated' => $status_search,	
				);
				$this->session->set_userdata($newdata);
			}	
			
			
			$where_search = array();
			if(isset($story_name_search) && $story_name_search!=""){
				$where_search[] = "story_name like '%".$story_name_search."%'";
			}
			if(isset($status_search) && $status_search!=""){
				$where_search[] = "story_is_donated = '".$status_search."'";
			}
			if(isset($site_status_search) && $site_status_search!=""){
				$where_search[] = "story_is_allowed like '".$site_status_search."'";
			}
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				$where = $where_search;
			}
			
		}
		
		return $this->count($where,"story");
		// exit;
		
	}
	//************/
	
		/*****awais*****/
	public function getallstoriesforsearch($offset,$limit){
		$params=array(
			'Select'=>"story.*, category.category_name",
			'from'=> "story, category",
			"page" => $offset,
        	"limit" => $limit
			);
		$where = "story.category_id=category.category_id"; 
		
		/*******/
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$story_name_search= $this->session->userdata("story_name");;
				$status_search= $this->session->userdata("is_donated");
				$site_status_search= $this->session->userdata("story_is_allowed");
				
			}else{
			
				$story_name_search=$this->input->post("story_name_search");
				$status_search=$this->input->post("status_search");
				$site_status_search=$this->input->post("site_status_search");
				
					//$ticket_id=$this->input->post("ticket_id");
				$newdata = array(
						'story_name'  => $story_name_search,
						'story_is_allowed' => $site_status_search,
						'is_donated' => $status_search,	
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($story_name_search) && $story_name_search!=""){
				$where_search[] = "story.story_name like '%".$story_name_search."%'";
			}
			if(isset($status_search) && $status_search!=""){
				$where_search[] = "story.story_is_donated = '".$status_search."'";
			}
			if(isset($site_status_search) && $site_status_search!=""){
				$where_search[] = "story.story_is_allowed like '".$site_status_search."'";
			}
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				$where = $where." and ".$where_search;
			}
			
		}
		else{
			$this->session->unset_userdata("story_name");
			$this->session->unset_userdata("is_donated");
			$this->session->unset_userdata("story_is_allowed");
			
		}
	
		/********/
		
		$params['where']=$where;
		$result=$this->find($params);
		return $result;
		
	
	}
	/*********************/
	
	public function getdistinctresourceid($story_id){
	    $query=$this->db->query("SELECT MIN(resource_id) AS resource_id, story_id
                                  FROM resources
                                  where resources.story_id='$story_id'
                                  GROUP BY story_id");
	    return $query->result();
    }

    public function getresourcesbyresourceid($resource_id){
        $params=array(
            'Select'=>"resources.*",
            'from'=> "resources",
            'where'=>"resources.resource_id='$resource_id'"
        );
        $result=$this->find($params);
        if($result !=null){
            return $result;
        }
        else{
            return false;
        }
    }

    public function getstoryfromslug($slug){
        $result_story = $this->findOneBy(array(
            "slug" => $slug
        ),'story');
        return $result_story;
    }

    public function getcategorynamebyid($category_id){
        $result_category = $this->findOneBy(array(
            "category_id" => $category_id
        ),'category');
        return $result_category;
    }

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
    }

    public function getnameofstorycreator($created_by){
        $result_category = $this->findOneBy(array(
            "user_id" => $created_by
        ),'users');
        return $result_category;
    }

    public function getdonationsumbystoryid($story_id){
        $this->db->select_sum('donations.donation_amount');
        $this->db->from('donations');
        $this->db->where("donations.story_id='$story_id'");
        $query = $this->db->get();
        $result=$query->result();
        return $result;
    }

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

}