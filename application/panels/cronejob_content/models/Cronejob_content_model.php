<?php

class Cronejob_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function getAllRecord(){
		$params=array(
			'Select'=>"crone_table.*, email_template.template_name",
			'from'=> "crone_table, email_template",
			'where'=>"crone_table.email_template_id=email_template.email_template_id AND status!='Cancel' AND status!='Done' AND email_template.template_type='newsletter'",
			);
		$result=$this->find($params);
		return $result;
	}
	
	public function updatestatus($id,$status){
		$update=array(
			'status'=>$status,
		);
		$result=$this->update($update,"id=$id","crone_table");
		return true;
	}
	
	public function getallregistereduserswhodonated(){
		$this->db->select('users.user_id, users.email, donations.story_id');
		$this->db->from('users, user_type, donations');
		$this->db->where("users.user_type_id=user_type.user_type_id AND user_type.system_name='registered_user' And donations.user_id=users.user_id");
		$this->db->group_by('donations.user_id, donations.story_id'); 
		$query = $this->db->get();
		$result=$query->result();
		return $result;
	}
	
	public function getsumdonations($story_id){
		// $this->db->select_sum('donations.donation_amount');
		// $this->db->where_in("user_id='$user_id'");
		// $this->db->from('donations');
		// $this->db->group_by('donations.story_id'); 
		// $query = $this->db->get();
		// $result=$query->result_array();;
		// return $result;
		$this->db->select_sum('donations.donation_amount');
		$this->db->from('donations');
		$this->db->where("donations.story_id='$story_id'");
		$query = $this->db->get();
		$result=$query->result();;
		return $result;
	}
	
	public function getstorynamebyid($story_id){
		$this->db->select('story_name, fundraising_target');
		$this->db->from('story');
		$this->db->where("story_id='$story_id'");
		$query = $this->db->get();
		$result=$query->result();;
		return $result;
	}
	
	public function getallregisteredusers(){
		$params=array(
			'select'=>"users.user_id, users.user_name, users.email, users.first_name, users.last_name",
			'from'=> "users, user_type",
			'where'=>"users.user_type_id=user_type.user_type_id And user_type.system_name='registered_user' And users.status='Enable'",
			);
		$result=$this->find($params);
			return $result;
	}

	public function getstoriesfromcrone(){
		$params=array(
			'select'=>"story.story_name, story.story_id, story.fundraising_target, story.story_short_description, email_template.email_template_id, email_template.template_name,
					email_template.template_subject, email_template.html_body, crone_table.name, donations.donation_id, donations.user_id, donations.email, donations.first_name, donations.last_name",
			'from'=> "story, email_template, crone_table, donations",
			'where'=>"crone_table.story_id=story.story_id AND crone_table.email_template_id=email_template.email_template_id AND crone_table.status!='Draft' AND donations.story_id=story.story_id",
			);
		$result=$this->find($params);
			return $result;
	}
}