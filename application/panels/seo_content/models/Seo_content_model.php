<?php

class Seo_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	/****addseo function adds the details of seo in database********/
	public function addseo(){
		$pagetitle=$this->input->post("pagetitle");	
		$metadesc=$this->input->post("metadesc");	
		$metakey=$this->input->post("metakey");	
		$slug=$this->input->post("slug");	
	
		$insert=array(
			'page_title'=>$pagetitle,
			'meta_description'=>$metadesc,
			'meta_keywords'=>$metakey,
			'slug'=>$slug,
			'date_created'=>date("Y-m-d H:i:s"),
			
		);
		$result_inserted=$this->insert($insert,'site_seo');
		return $result_inserted;

	}
	/**super_admin_delete_seo function is used to delete the seo from database ******/
	public function super_admin_delete_seo(){	
		$seo_id=$this->input->get("id");
		$result=$this->delete("seo_id=$seo_id","site_seo");
		return true;
	}
	
	/****getallseos function returns all the seos from database including search too******/
	public function getallseos($offset,$limit){
		
		$params=array(
			'select'=>"*",
			'from'=> "site_seo",
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
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
			
		return $result;
		/*******/
	}

	/*******getallseocount function returns count of all the seo in database*************/
	public function getallseocount(){
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
		return $this->count($where,"site_seo");
		
	}
	/***checkuniqueslug function checks unique slug while inserting in database***/
	public function checkuniqueslug($slug){
		$where = "slug = '$slug'";
		$result = $this->count($where,"site_seo");
		return $result;
	}
	/****checkuniqueslugforedit function checks unique slug while updating a record*******/
	public function checkuniqueslugforedit($slug,$seo_id){
		$where = "slug = '$slug' AND seo_id != '$seo_id'";
		$result = $this->count($where,"site_seo");
		return $result;
	}
	
	/****getseobyid function returns details of a seo*****/
	public function getseobyid($seo_id){
		
		$result = $this->findOneBy(array(
			"seo_id" => $seo_id
		),'site_seo');
		return $result;
	}
	
	/*****updateSeo function updates the details of seo in database*********/
	public function updateSeo($seo_id){
		$CI =& get_instance();
		$pagetitle=$this->input->post("pagetitle");	
		$metadesc=$this->input->post("metadesc");	
		$metakey=$this->input->post("metakey");	
		$slug=$this->input->post("slug");	
	
		$update=array(
			'page_title'=>$pagetitle,
			'meta_Description'=>$metadesc,
			'meta_keywords' => $metakey,
			'slug' => $slug,
	
		);	
		$result=$this->update($update,"seo_id=$seo_id","site_seo");
		
		return true;
	}	
}