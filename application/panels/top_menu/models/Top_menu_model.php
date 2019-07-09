<?php

class Top_menu_model extends MY_Model {
	public function __construct() {
		
		parent::__construct("support_seo");
	}
	public function csrfguard_generate_token($unique_form_name){
		
		if (function_exists("hash_algos") and in_array("sha512",hash_algos())){
			$token=hash("sha512",mt_rand(0,mt_getrandmax()));
		}
		else{
			$token=' ';
			for ($i=0;$i<128;++$i){
				$r=mt_rand(0,35);
				if ($r<26){
					$c=chr(ord('a')+$r);
				}
				else{
					$c=chr(ord('0')+$r-26);
				} 
				$token.=$c;
			}
		}
		$this->session->set_userdata($unique_form_name,$token);
		return $token;
	}
	
	public function get_all_categories(){
		$params = array(
				"select" => "*",
				"from" => "support_category",
				"where" => " Status = 'Enable'"
		);
		$result = $this->find($params); 
		return $result;
	}
}
?>
