<?php

class Dashboard_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function getTotalUsers(){
		return $this->count("","users");
	}
	
	public function getSumOfAllDonations(){
		// $params=array(
			// 'Select'=>"SUM(donation_amount) as donation_amount",
			// 'from'=> "donations",
			// );
		// $result=$this->find($params);
		// print_r($result);
		// exit;
		// if($result !=null){
			// return $result;
		// }
		// else{
			// return false;
		// }	
// 			
		$this->db->select_sum('donation_amount');
		$this->db->from('donations');
		$query = $this->db->get();
		$result=$query->row();
		if($result->donation_amount == ""){
			$result->donation_amount = "0.00";
		}
		
		return $result;
	}
	
	public function getTotalStories(){
		return $this->count("","story");
		
	}
	
	public function gettenstories(){
		$params=array(
			'Select'=>"story.*, category.category_name",
			'from'=> "story, category",
			"where"=>"story.category_id=category.category_id",
			'limit'=> 10,
			'order_by'=>"story.story_id Desc"
			);
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}
	}
}?>

