<?php

class Pages_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	/*****get_page_details function gets page details from database using slug************/
	public function get_page_details($slug){
		//$PageTitle="Twelve for Twelve - About Us";
		$page_details = $this->findOneBy(array(
			"slug" => $slug
		),'webpages');
		return $page_details;
	}
	/****addpage function inserts the page credentials in database********/
	public function addpage(){
		$pagetitle=$this->input->post("pagetitle");	
		$metadesc=$this->input->post("metadesc");	
		$metakey=$this->input->post("metakey");	
		$slug=$this->input->post("slug");	
		$pagehead=$this->input->post("pagehead");	
		$pagecontent=$this->input->post("pagecontent");	
		$status="Enable";
		$sortorder="1";
		$insert=array(
			'page_title'=>$pagetitle,
			'meta_description'=>$metadesc,
			'meta_keywords'=>$metakey,
			'page_heading'=>$pagehead,
			'page_content'=>$pagecontent,
			'slug'=>$slug,
			'status' => $status,
			'sortorder'=>$sortorder,
			'date_created'=>date("Y-m-d H:i:s"),
			
		);
		$result_inserted=$this->insert($insert,'webpages');
		return $result_inserted;

	}
	/****checkuniqueslug function is used to check unique slug while inserting in database***/
	public function checkuniqueslug($slug){
		$where = "slug = '$slug'";
		$result = $this->count($where,"webpages");
		return $result;
	}
	/*****checkuniqueslugforedit function is used to check unique slug when page is updated************/
	public function checkuniqueslugforedit($slug,$page_id){
		$where = "slug = '$slug' AND Id != '$page_id'";
		$result = $this->count($where,"webpages");
		return $result;
	}
	/*****getallpages function returns all pages from database including search too**********/
	public function getallpages($offset,$limit){
		
		$params=array(
			'select'=>"*",
			'from'=> "webpages",
			"page" => $offset,
        	"limit" => $limit,
       	);
		$where = "";
		
		/*******/
		 if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$slugsearch= $this->session->userdata("slugsearch");
				
			}else{
			
				$slugsearch=$this->input->post("slugsearch");
				$newdata = array(
						'slugsearch' => $slugsearch,
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($slugsearch) && $slugsearch!=""){
				$where_search[] = "slug like '%".$slugsearch."%'";
			}
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){	
				$where =$where_search;
			}
			
		}
		else{
			$this->session->unset_userdata("slugsearch");
		}
		/********/
		echo $where;
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
			
		return $result;
		/*******/
	}
	/****updatePage is used to update the credentials of a page in database*****/
	public function updatePage($page_id){
		$CI =& get_instance();
		
		$pagetitle=$this->input->post("pagetitle");	
		$metadesc=$this->input->post("metadesc");	
		$metakey=$this->input->post("metakey");	
		$slug=$this->input->post("slug");	
		$pagehead=$this->input->post("pagehead");	
		$pagecontent=$this->input->post("pagecontent");	
		$status="Enable";
		$sortorder="1";
			$update=array(
			'page_title'=>$pagetitle,
			'meta_description'=>$metadesc,
			'meta_keywords' => $metakey,
			'slug' => $slug,
			'page_heading' => $pagehead,
			'page_content' => $pagecontent,
			'status' => $status,
			'sortorder'=>$sortorder,
			'date_updated'=>date("Y-m-d H:i:s"),
			
		);
			
		$result=$this->update($update,"Id=$page_id","webpages");
		
		return $result;
	}	
	
	/******getpagebyid function is used to get details of a page using its id*********/
	public function getpagebyid($page_id){
		
		$result = $this->findOneBy(array(
			"Id" => $page_id
		),'webpages');
		return $result;
	}
	
	/***super_admin_delete_page function is used to delete the page from database****/
	public function super_admin_delete_page(){	
		$page_id=$this->input->get("id");
		$result=$this->delete("Id=$page_id","webpages");
		return true;
	}
	
	/****getallpagecount function returns count of all the pages in database including search too*****/
	public function getallpagecount(){
		$where = "";
	
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$slugsearch= $this->session->userdata("slugsearch");
				
			}
			else{
				$slugsearch=$this->input->post("slugsearch");
				$newdata = array(
						'slugsearch' => $slugsearch,
						);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($slugsearch) && $slugsearch!=""){
				$where_search[] = "slug like '%".$slugsearch."%'";
			}
			$where_search = implode(" and ", $where_search);
			if(strlen($where_search)){
					$where =$where_search;
			}	
		}
		return $this->count($where,"webpages");
		
	}
}
?>
