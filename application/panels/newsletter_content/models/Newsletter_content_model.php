<?php

class Newsletter_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function getalltemplates()	{
		$params=array(
			'Select'=>"email_template.email_template_id",
			'from'=> "email_template",
			'where'=>"email_template.template_type='newsletter'"
			);
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}
	
	public function insertincronetable(){
		$name=$this->input->post("name");
		$templateid=$this->input->post('selecttemplate');
		$status=$this->input->post('sendnewletter');
		$group=$this->input->post('selectgroupfornewsletter');
		$story_id=NULL;
		
		if($status=='Schedule'){
			$newsletterdate=$this->input->post('newsletterdatetime');
			$date=strtotime($newsletterdate);
			$converted_date=date('y-m-d h:i:s',$date);
			if($group=='stories'){
				$story_id=$this->input->post('selectstoriesdropbox');
			}
			$data=array(
				'name'=>$name,
				'email_template_id'=>$templateid,
				'datetime'=>$converted_date,
				'status'=>$status,
				'story_id'=>$story_id,
				'group'=>$group,
				'date_created'=>date("Y-m-d H:i:s"),
			);
		}else{
			if($group=='stories'){
				$story_id=$this->input->post('selectstoriesdropbox');
			}
			$data=array(
				'name'=>$name,
				'email_template_id'=>$templateid,
				'status'=>$status,
				'story_id'=>$story_id,
				'group'=>$group,
				'date_created'=>date("Y-m-d H:i:s"),
			);
		}
		$result_inserted=$this->insert($data,'crone_table');
		return $result_inserted;
	}
	
	public function getAllRecord($offset,$limit){
		$params=array(
			'Select'=>"crone_table.*, email_template.template_name",
			'from'=> "crone_table, email_template",
			'where'=>"crone_table.email_template_id=email_template.email_template_id",
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
	
	/*****getAllRecordforsearch function returns all records of newsletter including search *******/
	public function getallstories(){
		$params=array(
			'Select'=>"story.story_id, story.story_name",
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
	
	/******awais******/
	public function getAllRecordforsearch($offset,$limit){
		$params=array(
			'Select'=>"crone_table.*, email_template.template_name",
			'from' =>"crone_table, email_template",
			"page" => $offset,
        	"limit" => $limit
        	);
		//	$from="";
			$where="crone_table.email_template_id=email_template.email_template_id";
				/*******/
			if($this->uri->slash_segment(2)=="search/")
			 {
				if(!$_POST)
				{
					$news_name_search= $this->session->userdata("news_name");;
					$status_search= $this->session->userdata("status_news");
					
				}else{
					$news_name_search=$this->input->post("news_name_search");
					$status_search=$this->input->post("status_search");
					
					$newdata = array(
						'news_name'  => $news_name_search,
						'status_news' => $status_search,
					);
					$this->session->set_userdata($newdata);
				}	
				$where_search = array();
					if(isset($news_name_search) && $news_name_search!=""){
						$where_search[] = "crone_table.name like '%".$news_name_search."%'";
					}
					if(isset($status_search) && $status_search!=""){
						$where_search[] = "crone_table.status = '".$status_search."'";
					}
				$where_search = implode(" and ", $where_search);
					if(strlen($where_search)){
						$where = $where." and ".$where_search;
					}	
			}
			else{
				$this->session->unset_userdata("news_name");
				$this->session->unset_userdata("status_news");
				
			}
		/********/
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}
	
	public function checkuniqueremindername($newsletter_name){
		$where = "name = '$newsletter_name'";
		$result = $this->count($where,"crone_table");
		return $result;
	}
	
	public function getallnewslettercount(){
		$params=array(
			'Select'=>"crone_table.*, email_template.template_name",
			'from'=> "crone_table, email_template",
			'where'=>"crone_table.email_template_id=email_template.email_template_id",
			);
		$result=$this->find($params);
		if($result !=null){
			return count($result);
		}
		else{
			return false;
		}
	}
	/******getallnewslettercountforsearch functioon returns the count of all records of newsletter*******/
	public function getallnewslettercountforsearch(){
		$from="crone_table, email_template";
		$where="crone_table.email_template_id=email_template.email_template_id";
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$news_name_search= $this->session->userdata("news_name");;
				$status_search= $this->session->userdata("status_news");
						
			}else{
				$news_name_search=$this->input->post("news_name_search");
				$status_search=$this->input->post("status_search");		
				$newdata = array(
					'news_name'  => $news_name_search,
					'status_news' => $status_search,
				);
				$this->session->set_userdata($newdata);
			}	
			$where_search = array();
			if(isset($news_name_search) && $news_name_search!=""){
				$where_search[] = "crone_table.name like '%".$news_name_search."%'";
			}
			if(isset($status_search) && $status_search!=""){
				$where_search[] = "crone_table.status = '".$status_search."'";
			}
		
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				$where = $where." and ".$where_search;
				
			}
		}
		
		return $this->count($where,$from);
		
	}
	


	public function getnewsletterbyid($newsletter_id){
		$result_newsletter = $this->findOneBy(array(
			"id" => $newsletter_id
		),'crone_table');
		return $result_newsletter;
	}
	
	public function updatenewsletter($newsletterid){
		
		// $name=$this->input->post('name');
		// $newsletterdate=$this->input->post('newsletterdatetime');
		// $date=strtotime($newsletterdate);
		// $converted_date=date('y-m-d h:i:s',$date);
// 		
		// $data=array(
				// 'name'=>$name,
				// 'datetime'=>$converted_date,
				// 'status'=>"Schedule",
			// );
		$name=$this->input->post("name");
		$templateid=$this->input->post('selecttemplate');
		$status=$this->input->post('sendnewletter');
		$group=$this->input->post('selectgroupfornewsletter');
		$story_id=NULL;
		
		if($status=='Schedule'){
			$newsletterdate=$this->input->post('newsletterdatetime');
			$date=strtotime($newsletterdate);
			$converted_date=date('y-m-d h:i:s',$date);
			if($group=='stories'){
				$story_id=$this->input->post('selectstoriesdropbox');
			}
			$data=array(
				'name'=>$name,
				'email_template_id'=>$templateid,
				'datetime'=>$converted_date,
				'status'=>$status,
				'story_id'=>$story_id,
				'group'=>$group,
				'date_updated'=>date("Y-m-d H:i:s"),
			);
		}else{
			if($group=='stories'){
				$story_id=$this->input->post('selectstoriesdropbox');
			}
			$data=array(
				'name'=>$name,
				'email_template_id'=>$templateid,
				'status'=>$status,
				'story_id'=>$story_id,
				'group'=>$group,
				'date_updated'=>date("Y-m-d H:i:s"),
			);
		}
		$result=$this->update($data,"id=$newsletterid","crone_table");
		return true;
	}
	
	public function checkuniquenewslettereditname($newslettername,$newsletterid){
		$where = "name = '$newslettername' AND id != '$newsletterid'";
		$result = $this->count($where,"crone_table");
		return $result;
	}
	
	public function updatenewsletterstatus($newsletter_id){
		$data=array(
				'status'=>"Cancel",
		);
		$result=$this->update($data,"id=$newsletter_id","crone_table");
		return true;
	}
	
	public function deletenewsletter($newsletterid){
		if(isset($newsletterid)){
			$result=$this->delete("id=$newsletterid","crone_table");
			return true;
		}else{
			return false;
		}
	}
}