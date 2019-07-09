<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manage_content extends MY_Controller {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('manage_content/Manage_content_model');
		//$this->load->model('login_content/Login_content_model');
		$this->load->helper('manage_content/Manage_content');
		$this->load->model('top_menu/Top_menu_model');
		
		
	 }
 
	public function index() {
		////$this->checkAdminSession();
		
		//$access=$this->check_super_admin();
		//echo $access;exit;
		//$this->check_permission_access($access);
		$CI =& get_instance();
		$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
		$data['token'] =$this->Top_menu_model->csrfguard_generate_token($data['unique_form_name']);
		
		$this -> load -> helper('manage_content/Manage_content');
		$this -> load -> model('manage_content/Manage_content_model');
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		
		$this -> load -> view('login_content', $data);
	}
	public function login_validate() {
		////$this->checkAdminSession();
		//$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		//echo $access;exit;
		$CI =& get_instance();
		$email= $this -> input -> post('email');
		$password = hash('sha256',$this->input->post('password'));
		$password =  hash('sha256','9f7' . $password);                   
										
		$this -> load -> helper('manage_content/Manage_content');
		$this -> load -> model('manage_content/Manage_content_model');
		
		$validate_login = login_validation();
		if ($validate_login ) {
			$data['email_result']=$this->Manage_content_model->validate_email();
			//echo "<pre>";print_r($data['email_result']);exit;
			
		$data['login_result']=$this->Manage_content_model->validate($email,$password);
		//echo "<pre>";print_r($data['login_result']);exit;
			//echo "<pre>";print_r($data['login_result']);exit;
					 if($data['login_result']!=false){
				if($data['login_result']->status=='inactive'){
					$this->session->set_flashdata('error_message', "Invalid Password, Try to Reset Password  Or Login with Facebook.");
				}
				 else if(!($data['email_result']->email==$email)){
            $this->session->set_flashdata('error_message', "Invalid email,  Login with with diff email.");
            }
				else if($data['login_result']->status=='active'){
                	$password = hash('sha256',$this->input->post('password'));
					
                    $password =  hash('sha256',$data['login_result']->salt . $password);  
				}                 
              // 	echo "<pre>";print_r($password);exit;
			if($data['login_result']->password == $password){
				//echo "string";
						//SET SESSION IF TRUE DETAILS
					session_regenerate_id();
				//echo "string";exit;	
$this->session->set_userdata(array('admin_logged_in'=>TRUE,'user_type'=>'super_admin','email'=>$this->input->post('email'),'firstname'=>$data['login_result']->first_name,'lastname'=>$data['login_result']->last_name));
						
$this->session->set_flashdata('success_message','Welcome '.$data['login_result']->first_name.$data['login_result']->last_name);
				//echo "string";exit;
					header("Location:" . $this -> config -> base_url() . "dashboard/view");
					exit ;
				
				
			}} else  {
				$status = 0;
				$CI -> session -> set_flashdata('invalid_email_pass', "Incorrect Email or Password");
				$CI -> session -> set_flashdata('error_message', "Incorrect Email or Password");
				header("Location:" . $_SERVER['HTTP_REFERER']);

			}}}
	
	/*
	public function login_validate() {
					
$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		$CI =& get_instance();		
		
		$csrf_name=$this->input->post("csrf_name");
		$csrf_token= $this->input->post("csrf_token");
		
		$csrf_check =$this->csrfguard_validate_token($csrf_name,$csrf_token);
		
		if($csrf_check==false)
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
			
		$email= $this -> input -> post('email');
		$password= $this -> input -> post('$password');
		
				
		$this -> load -> helper('manage_content/Manage_content');
		$this -> load -> model('manage_content/Manage_content_model');

		$validate_login = login_form_validate();
		if ($validate_login && $csrf_check==true) {
		$data['login_result']=$this->Manage_content_model->validate();
			
			
} 
			 if($data['login_result']->status=='active'){
                	$password = hash('sha256',$this->input->post('password'));
			
                    $password =  hash('sha256',$data['login_result']->salt . $password);                   
			 }
                    if($data['login_result']->password == $password){{
						
						
$this->session->set_userdata(array('adminname'=>$data['login_result']->first_name,'adminid'=>$data['login_result']->Id, 'admin_logged_in'=>TRUE));
$this->session->set_flashdata('success_message','Welcome '.$data['login_result']->Name);
						
$this->session->set_flashdata('success_message','Welcome '.$data['login_result']->first_name.$data['login_result']->last_name);
					header("Location:" . $this -> config -> base_url() . "dashboard/view");
					exit ;
				
				
			}} else  {
				$status = 0;
				$CI -> session -> set_flashdata('invalid_email_pass', "Incorrect Email or Password");
				$CI -> session -> set_flashdata('error_message', "Incorrect Email or Password");
				header("Location:" . $_SERVER['HTTP_REFERER']);

			}}

*/
	public function logout() {
		
		//remove PHPSESSID from browser
		// if (isset($_COOKIE[session_name()]))
			// setcookie(session_name(), "", time() - 3600, "/");
		//clear session from globals
		
		
		$this -> session -> unset_userdata('admin_logged_in');
		$this -> session -> unset_userdata('teacher_id');
		$this -> session -> unset_userdata('user_type');
		$this -> session -> unset_userdata('email');
		$this -> session -> unset_userdata('first_name');
		$this -> session -> unset_userdata('last_name');
		$this -> session -> sess_destroy();
		session_destroy();
		session_regenerate_id();
		
		header("Location:" . $this -> config -> base_url() . "manage");
		exit ;
	}

	
	public function view_forgot_password(){
		//echo "string";exit;
		//$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		$CI =& get_instance();		$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
		$this->load->model('top_menu/Top_menu_model');
		$data['token'] =$this->Top_menu_model->csrfguard_generate_token($data['unique_form_name']);
		$data['error_message']=$this->session->flashdata('error_message');
		$data['success_message']=$this->session->flashdata('success_message');
		$data['user_add_data']=$this->session->flashdata('user_add_data');
        $this->load->view('view_forgot_password_content',$data);
	}
	
	
	
	public function forgot_validate(){
	
	$access=$this->check_super_admin();
		$this->check_permission_access($access);
		$CI =& get_instance();
		$csrf_name=$this->input->post("csrf_name");
		$csrf_token= $this->input->post("csrf_token");
		
		$csrf_check =$this->csrfguard_validate_token($csrf_name,$csrf_token);
		if($csrf_check==false){
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
			header("Location:" . $this -> config -> base_url() . "manage/forgot");
			exit ;
		}
		
		
		//form validation helper
		$this->load->helper('manage_content/Manage_content');
		$validate = forgot_form_validate();
		if ($validate && $csrf_check ==true ){
			$email = $this->input->post('forgot_email');
			
			$get_user = $this->Manage_content_model->check_forgot_email($email);
			if($get_user==false){	
				$this->session->set_flashdata('error_message', "No account exists with this email.");
				header("Location:" . $this -> config -> base_url() . "manage/forgot");
				exit ;
			}
			else{
				
				if($get_user->status=='Temp'){
					$this->session->set_userdata(array('id'=>$get_user->id,'email'=>$email));
					$this->session->set_flashdata('error_message', "Your email is not confirmed yet.");
					
					
					header("Location:" . $this -> config -> base_url() . "manage/forgot");
					exit ;
				}
				elseif($get_user->status=='inactive'){
					$this->session->set_flashdata('error_message', "Account is suspended!");
					header("Location:" . $this -> config -> base_url() . "manage/forgot");
					exit ;
				}
				else{
					$ip_date =$this->Manage_content_model->get_date_ip();
			
					$token = $this->Manage_content_model->generateToken(8);
								
					
					
					$value_array = array(   
																
					
											'UserId' =>$get_user->id,
											'Token' => $token,
											'CreatedDate'=>$ip_date->cur_date,
											'status'=>'active',
											
											'CreatedIp'=>12345533123,
										);
					
					$this->Manage_content_model->replace('admin_forgotpassword',$value_array);
					
					$get_email=$this->Manage_content_model->get_one_email(1);
										
					$to_email=$email;
					$subject=$get_email->Subject;
					$sender_email = $get_email->Email;
					$from = $get_email->FromText;
					
					$password =$get_email->Password;
					
					$link = site_url('manage/forgot_confirm/'.$token);
					
					$message  = str_replace('[LINK]',$link,$get_email->Content);


					$this->load->library('Cphpmailer');
					$oMail = new Cphpmailer();
					$oMail -> Subject = stripslashes($subject);
					$oMail -> MsgHTML(mb_convert_encoding($message, "HTML-ENTITIES", "UTF-8"));
					$oMail -> CharSet = "utf-8";
					$oMail -> AddAddress($to_email, "");
					$oMail -> SetFrom($sender_email, $from);
					$oMail -> AddReplyTo($sender_email, "");
					echo "<pre>";print_r($oMail);exit;
					$oMail -> Mailer = 'sendmail';
					$email_status = $oMail -> Send();
					$this->session->set_flashdata('success_message', "Password reset instruction is sent to your email address.");
				}
			}
			header("Location:" . $this -> config -> base_url() . "manage");
			exit ;
		}
		else{
			
			header("Location:" . $this -> config -> base_url() . "manage/forgot");
			exit ;
		}
	}
	
	public function confirm_forgot_token(){
		
		//$access=$this->check_super_admin();
	//	$this->check_permission_access($access);
		$CI =& get_instance();
				$last = $this->uri->total_segments();
		$token = $this->uri->segment($last);
		
		$result =$this->Manage_content_model->validate_forgot_token($token);
		$data = array('title'=>'Reset Password','action'=>site_url('resetpassword/check/'));
				
		if($token!=''){
				
			$result =$this->Manage_content_model->validate_forgot_token($token);
			if(empty($result)){
				$this->session->set_flashdata('error_message','It looks like you have already recovered your password or link is expired.');
				header("Location: ".base_url()."manage");
				exit;
			}
			else if($result->status=='Temp'){
				$this->session->set_flashdata('error_message','Error: Your account no longer exist.');
				header("Location: ".base_url()."manage");
				exit;
			}
			else if($result->status=='inactive'){
				$this->session->set_flashdata('error_message','Account is suspended!');
				header("Location: ".base_url()."manage");
				exit;
			}
			else{
				$value = array(
										'status' => 'inactive' ,
										
										);
										
				$sentdate=strtotime($result->CreatedDate);
				$current_date=strtotime(date('Y-m-d H:i:s'));
				$diff= abs($sentdate - $current_date);
				$difference=($diff/(60*60*24));
				if($difference > 240){
					$this->Manage_content_model->modify_token_status($value,$token);
					$this->session->set_flashdata('error_message','Link In your mail is expierd,Request Again!');
					header("Location: ".base_url()."manage");
					exit;
				}
			}
		}	
		else{
			$this->session->set_flashdata('error_message','It looks like link is expired.');
			header("Location: ".base_url()."manage");
			exit;
		}
		$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
		$data['token'] =$this->Top_menu_model->csrfguard_generate_token($data['unique_form_name']);
		$data['error_message']=$this->session->flashdata('error_message');
		$data['success_message']=$this->session->flashdata('success_message');
		$data['user_add_data']=$this->session->flashdata('user_add_data');
        $data['forgot_token']=$token;
        
		$this->load->view('view_reset_password',$data);
		
	}
	
	
	
	
	public function check_reset_password(){
		
//$access=$this->check_super_admin();
		//$this->check_permission_access($access);
		$CI =& get_instance();		
		$csrf_name=$this->input->post("csrf_name");
		$csrf_token= $this->input->post("csrf_token");
		$forgot_token= $this->input->post("forgot_token");
		//$this->load->model('login_content/Login_content_model');
		
		$csrf_check =$this->csrfguard_validate_token($csrf_name,$csrf_token);
		if($csrf_check==false){
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
			redirect($_SERVER['HTTP_REFERER']);
			exit;
			
		}
		
		//form validation helper
		$validate = new_password_form_validate();
		if ($validate && $csrf_check ==true){
			
			$result =$this->Manage_content_model->validate_forgot_token($forgot_token);
			if(empty($result)){
				$this->session->set_flashdata('error_message','It looks like you have already recovered your password or link is expired.');
				header("Location: ".base_url()."manage");
				exit;
			}
			else if($result->status=='Delete'){
				$this->session->set_flashdata('error_message','Error: Your account no longer exist.');
				header("Location: ".base_url()."manage");
				exit;
			}
			elseif($result->status=='inactive'){
				$this->session->set_flashdata('error_message','Account is suspended!');
				header("Location: ".base_url()."manage");
				exit;
			}
			else{
				$sentdate=strtotime($result->CreatedDate);
				$current_date=strtotime(date('Y-m-d'));
				$diff= abs($sentdate - $current_date);
				$difference=($diff/(60*60*24));
				if($difference > 240){
					$value = array(
										'status' => 'inactive' ,
										
										);
										
					
				
					$this->Manage_content_model->modify_token_status($value,$forgot_token);
				
					$this->session->set_flashdata('error_message','Link In your Mail is expired,Request Again!');
					header("Location: ".base_url()."manage");
					exit;
				}
				else{
					$data=$this->Manage_content_model->get_token_status($forgot_token);
					if($data->status=="inactive"){
						$this->session->set_flashdata('error_message','Your token expired,Create new forgot password scenario');
						header("Location: ".base_url()."manage");
						exit;
												}
					
						
					
					$ip_date =$this->Manage_content_model->get_date_ip();
					$salt =$this->Manage_content_model->create_pwd_salt();
				
						
                	$password = hash('sha256',$this->input->post('recover_pass'));
					
                    $password =  hash('sha256','9f7' . $password);                   
                 					$value_array = array(
										'password' => $password ,
										
										);
										
					$this->Manage_content_model->confirm_user($value_array,$result->id);	
					$value = array(
										'status' => 'inactive' ,
										
										);
										
					
				
					$this->Manage_content_model->delete_token_status($value,$forgot_token);
					$this->session->set_flashdata('success_message',"You have successfully recovered your password.");
					header("Location: ".base_url()."manage");
					exit;
				}
			}
			
		}
		else{
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
			redirect($_SERVER['HTTP_REFERER']);
			exit;
		}
	}


	

}?>
