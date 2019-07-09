<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cronejob_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
	
	public function crone_newsletter(){

		$this -> load -> model('cronejob_content/cronejob_content_model');
		$result=$this->cronejob_content_model->getAllRecord();
	
		foreach ($result as $key => $value) {
			if($value->datetime=="0000-00-00 00:00:00"){
				$this->cronejob_content_model->updatestatus($value->id,"Draft");
			}
			else{
				$startDate=new DateTime($value->datetime);
				$diff=$startDate->diff(new DateTime);
				$months =  $diff->format('%m'); 
				$hours =  $diff->format('%h');
				$min=$diff->format('%i');
				if($months>0 || $hours>0 || $min>0){
					echo $value->group;
					exit;
					switch ($value->group) {
						case 'allusers':
							$resigtered_users=$this->load->cronejob_content_model->getallregisteredusers();
							echo "users";
							
							foreach ($resigtered_users as $key) {
								echo "<br>";
								$subject = "$value->template_subject";
								$email = $key->email;
						
								$message = str_replace("[firstname]", $key->first_name, $value->html_body);
								$message=str_replace("[lastname]", $key->last_name, $message);
								$message=str_replace("[email]", $key->email, $message);
								
								// echo "USers :".$message;
								// echo "<br>";
								
								$sender_email = "$value->from_email";
								$from = "$value->from_name";
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
							}
							break;
						
						case 'stories':
							echo "<br>";
							echo "Stories";
							$stories=$this->load->cronejob_content_model->getstoriesfromcrone();

							foreach ($stories as $key) {
								echo "<br>";
								$subject = "$value->template_subject";
								$email = $key->email;
						
								$message = str_replace("[firstname]", $key->first_name, $value->html_body);
								$message=str_replace("[lastname]", $key->last_name, $message);
								$message=str_replace("[email]", $key->email, $message);
								
								// echo "Stories :".$message;
								// echo "<br>";
								
								$sender_email = "$value->from_email";
								$from = "$value->from_name";
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
							}
							
							break;
						default:
							
							break;
					}
					$this->cronejob_content_model->updatestatus($value->id,"Done");
				}
			}
		}
	}//end of the function crone_newsletter to send the newsletter that are scheduled
	
	public function crone_storyupdates(){
		$this -> load -> model('cronejob_content/cronejob_content_model');
		$this -> load -> model('template_content/template_content_model');
		
		$resigtered_users=$this->load->cronejob_content_model->getallregistereduserswhodonated();
		$story_update_template=$this->load->template_content_model->storyupdatesemail();
		
		$index = 0;
		foreach ($resigtered_users as $key) {
			$sumdonations=$this->load->cronejob_content_model->getsumdonations($key->story_id);
			$storyname=$this->load->cronejob_content_model->getstorynamebyid($key->story_id);
			$resigtered_users[$index]->donation_amount = $sumdonations[0]->donation_amount;
			$resigtered_users[$index]->story_name = $storyname[0]->story_name;
			$resigtered_users[$index]->fundraising_target = $storyname[0]->fundraising_target;
			$index++;
			
			$subject = "$story_update_template->template_subject";
			$email = $key->email;

			$message = "Story Name : '$key->story_name' Fundraising target of story $: '$key->fundraising_target'
			Total donation to story $: '$key->donation_amount'";
			$message=str_replace('[story_name]', $key->story_name, $story_update_template->html_body);
			$message=str_replace('[fundraising_target]', $key->fundraising_target, $message);
			$message=str_replace('[donation_amount]', $key->donation_amount, $message);
			
			$sender_email = "$story_update_template->from_email";
			$from = "solution_new";
			
			echo "<br>";
			echo "Subject ".$subject;
			echo "<br>";
			echo "Sender Email ".$sender_email;
			echo "<br>";
			echo "Reciver Email ".$email;
			echo "<br>";
			echo "Message Content :".$message;
			
			
			// $this -> load -> library('Cphpmailer');
			// $oMail = new Cphpmailer();
// 
			// $oMail -> Subject = stripslashes($subject);
			// $oMail -> MsgHTML(mb_convert_encoding($message, "HTML-ENTITIES", "UTF-8"));
			// $oMail -> CharSet = "utf-8";
			// $oMail -> AddAddress($email, "");
			// $oMail -> SetFrom($sender_email, $from);
			// $oMail -> AddReplyTo($sender_email, "");
			// $oMail -> Mailer = 'sendmail';
			// $email_status = $oMail -> Send();
		}		
		exit;
	}//end of function crone_storyupdates to send the updtes of the stories to registered users
}