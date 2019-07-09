<?php

class Footer_model extends MY_Model {
	
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function get_first_five_categories(){
		$params=array(
			'Select'=>"*",
			'from'=> "category",
			'limit'=>4,
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