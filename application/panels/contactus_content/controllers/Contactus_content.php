<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contactus_content extends MY_Controller {
	/*****page_details function loads the view of contact us page*******/
	public function page_details(){
		//$CI =& get_instance();
			$this->load->view("contactus_view_content");
	}
	/****addmessage function sents the message and email it to the solution_new HR team****/
	public function addmessage(){
		
		$CI =& get_instance();
		$this -> load -> model('contactus_content/contactus_content_model');
		$email="awais.mangocoders@gmail.com";
		$message=$this->input->post("message");	
			
		$result=$this->contactus_content_model->addmessage();
				if($result!=0){
					/****email****/
					$settingusersession = array('useremail' => $email, );
					$CI -> session -> set_userdata($settingusersession);
				//	echo "" . $this -> session -> userdata('useremail');
					$subject = "Contact Us Message";
					//$email = $this -> input -> post('useremail');
				
					$message = "'$message'";
					$sender_email = "hashar@manogocoders.com";
					$from = "ISupportCause";
					$this -> load -> library('Cphpmailer');
				
					$oMail = new Cphpmailer();
					$oMail -> Subject = stripslashes($subject);
					$oMail -> MsgHTML(mb_convert_encoding($message, "HTML-ENTITIES", "UTF-8"));
					$oMail -> CharSet = "utf-8";
					$oMail -> AddAddress($email, "");
					$oMail -> SetFrom($sender_email, $from);
					$oMail -> AddReplyTo($sender_email, "");
					$oMail -> Mailer = 'sendmail';
					$email_status = $oMail -> Send();	
					
					$CI->session->set_flashdata('success_message', "Message has been Sent Successfully.");
					header("Location:" . $_SERVER['HTTP_REFERER']);
				
				}
				else{
					$CI->session->set_flashdata('error_message','Message is not sent.');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
	}	
}
?>