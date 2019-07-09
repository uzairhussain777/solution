<?php

class Contactus_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	/**addmessage function inserts the message details in the database******/
	public function addmessage(){
		$username=$this->input->post("username");	
		$useremail=$this->input->post("useremail");	
		$userphone=$this->input->post("userphone");	
		$message=$this->input->post("message");	
		$insert=array(
			'username'=>$username,
			'useremail'=>$useremail,
			'userphone'=>$userphone,
			'message'=>$message,
			'date_created'=>date("Y-m-d H:i:s"),
			
		);
		$result_inserted=$this->insert($insert,'contact_us');
		
		return $result_inserted;
	}
}
?>
