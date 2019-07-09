
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// require_once APPPATH.'libraries/facebook/facebook.php';
//require_once APPPATH.'libraries/Facebook/autoload.php';
class Login_content extends MY_Controller {

    public function index() {
    	//$this->checkSession();
		// echo "<pre>";
		// print_r($this->session->all_userdata());
		// exit;
		$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
		$this->load->model('top_menu/Top_menu_model');
		$data['token'] =$this->Top_menu_model->csrfguard_generate_token($data['unique_form_name']);
		$data['error_message']=$this->session->flashdata('error_message');
		$data['success_message']=$this->session->flashdata('success_message');
		$data['user_add_data']=$this->session->flashdata('user_add_data');
        $this->load->view('login_content',$data);
    }
	
	public function login_validate(){
		
		//$this->checkSession();
		
		/*if($this->session->userdata('user_logged_in') == TRUE){
			redirect(site_url('user'));
		}*/
		
		if($this->session->userdata('target_url')){
			$target_url = $this->session->userdata('target_url');
		}else{
			$target_url = "";
			
		}
		// echo $target_url;
		// exit;
		$this->load->model('login_content/Login_content_model');
		
		
		$csrf_name=$this->input->post("csrf_name");
		$csrf_token= $this->input->post("csrf_token");
		
		$this->load->model('login_content/Login_content_model');
		$csrf_check =1;
		//$this->csrfguard_validate_token($csrf_name,$csrf_token);
		if($csrf_check==false)
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
		//form validation helper
		$this->load->helper('login_content/Login_content');
		$validate = login_form_validate();
		if ($validate && $csrf_check==true){
			$data['login_result']=$this->Login_content_model->validate();
			header("Location: ".base_url()."categories");
							exit;
		//	echo "<pre>";print_r($data['login_result']);exit;
			//new code start
			 if($data['login_result']!=false){
				if($data['login_result']->status=='disable'){
					$this->session->set_flashdata('error_message', "Invalid Password, Try to Reset Password .");
				}
				else if($data['login_result']->status=='active'){
                	$password = hash('sha256',$this->input->post('password'));
                    $password =  hash('sha256',$data['login_result']->salt . $password);                   
                    if($data['login_result']->password == $password){
						//echo "string";exit;
						//SET SESSION IF TRUE DETAILS
						session_regenerate_id();
						$this->session->set_userdata(array('user_logged_in'=>TRUE,'userid'=>$data['login_result']->id,'type'=>$data['login_result']->type,'email'=>$this->input->post('email'),'first_name'=>$data['login_result']->first_name,'last_name'=>$data['login_result']->last_name,'user_fbid'=>$data['login_result']->FacebookId));
						$this->session->set_flashdata('success_message','Welcome '.$data['login_result']->first_name." ".$data['login_result']->last_name);
						
						if($target_url==''){
							header("Location: ".base_url()."categories");
							exit;
						}
						else{
							
							header("Location: ".$target_url);
							exit;
						}
					}
					else{
						$this->session->set_flashdata('error_message', "Enter correct password.");
					}
				}
				elseif($data['login_result']->status=='temp'){
					$password = hash('sha256',$this->input->post('password'));
					$password = hash('sha256',$data['login_result']->Salt . $password);
					if($data['login_result']->password == $password){
						$this->session->set_userdata(array('user_temp'=>TRUE,'userid'=>$data['login_result']->Id,'email'=>$email));
						
						$this->session->set_flashdata('error_message', "Your email is not confirmed yet.");
						$data['resend'] = 'Yes';
					}
					else{
						$this->session->set_flashdata('error_message', "Enter correct password.");
					}
				}
				else{
					$this->session->set_flashdata('error_message', "Account is suspended!");
					
				}
			}
			else{
				$this->session->set_flashdata('error_message', "No account exists with this email.");
			}	
		}
		
		header("Location: ".base_url()."categories");
		exit;
	}
	
	public function logout() {
		
		//remove PHPSESSID from browser
		// if (isset($_COOKIE[session_name()]))
			// setcookie(session_name(), "", time() - 3600, "/");
		//clear session from globals
		
		
		$this -> session -> unset_userdata('user_logged_in');
		$this -> session -> unset_userdata('userid');
		$this -> session -> unset_userdata('Type');
		$this -> session -> unset_userdata('email');
		$this -> session -> unset_userdata('firstname');
		$this -> session -> unset_userdata('lastname');
		$this -> session -> unset_userdata('user_fbid');
		
// 		
// 		
		// $this -> session -> sess_destroy();

		// $array_items =array('user_logged_in'=>false,'userid'=>'','Type'=>'','email'=>'','firstname'=>'','lastname'=>'','user_fbid'=>'');
		// $this->session->unset_userdata($array_items);
// 
		// session_destroy();
		// session_regenerate_id();
		
		//header("Location:" . $this -> config -> base_url() . "home/home_page");
		exit ;
	}
	
	public function user_register_form(){
//$this->checkSession();	
		$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
		$this->load->model('top_menu/Top_menu_model');
		$data['token'] =$this->Top_menu_model->csrfguard_generate_token($data['unique_form_name']);
		$data['error_message']=$this->session->flashdata('error_message');
		$data['success_message']=$this->session->flashdata('success_message');
		$data['user_add_data']=$this->session->flashdata('user_add_data');
        $this->load->view('register_content',$data);
	}
	
	public function register_submit(){
		//$this->checkSession();	
		$this->load->model('login_content/Login_content_model');
		$csrf_name=$this->input->post("csrf_name");
		$csrf_token= $this->input->post("csrf_token");
		
		$this->load->model('login_content/Login_content_model');
		$csrf_check =1;
		//$this->csrfguard_validate_token($csrf_name,$csrf_token);
		
		if($csrf_check==false){
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
			header("Location: ".base_url()."register");
			exit;
		}
		//echo "string";exit;
		$this->load->helper('login_content/Login_content');
		$validate =1;
//		 register_form_validate();
		if ($validate && $csrf_check==true){
		//	$ip_date =$this->Login_content_model->get_date_ip();
					//echo "string";exit;

			$salt =$this->Login_content_model->create_pwd_salt();
			
			$password =  hash('sha256', $salt . ( hash('sha256',$this->input->post('signup_password'))));
			$value_array = array(   
									'first_name'=>$this->input->post("firstname"),
									'last_name'=>$this->input->post("lastname"),
									'email' =>$this->input->post("signup_email"),
									'password'=>$password,
									'confirm_password'=>$password,
									'salt'=>$salt,
									'status' =>'active',
							'phone_number'=>$this->input->post("phone_number"),
							'gender'=>$this->input->post("gender"),
									
									//'CreatedDate'=>$ip_date->cur_date,
									//'CreatedIp'=>  $ip_date->ip,
                                  //  'FacebookId'=>0,
                                   // 'ConfirmDate'=>date('Y-m-d'),
                                    //'ConfirmIp'=>$ip_date->ip
								);
			$insert_id =$this->Login_content_model->register($value_array);
			//echo "<pre>";print_r($insert_id);exit;
			$this->session->set_userdata(array('user_temp'=>TRUE,'userid'=>$insert_id,'email'=>$this->input->post("email")));
			/*
			$token = $this->Login_content_model->generateToken(8);
			$value_array = array(   
									'UserId' =>$insert_id,
									'Token' => $token,
								);
			$this->Login_content_model->replace('support_confirmation',$value_array);
			
			
			//get email data
			$get_email=$this->Login_content_model->get_one_email(1);
			$to_email=$this->input->post('email');
			$subject=$get_email->Subject;
			$from_email = $get_email->Email;
			$from_text = $get_email->FromText;
			
			$password =$get_email->Password;
			$link = site_url('register/confirm/'.$token);
			$site_settings=$this->session->userdata['site_settings'];
			$message  = str_replace('[SITE_NAME]',$site_settings['site_name'],$get_email->Content);
			$message  = str_replace('[LINK]',$link,$message);
			$message  = str_replace('[SITE_URL]',$site_settings['site_url'],$message);
			
			
			
			$this->load->library('Cphpmailer');
			$oMail = new Cphpmailer();
			$oMail -> Subject = stripslashes($subject);
			$oMail -> MsgHTML(mb_convert_encoding($message, "HTML-ENTITIES", "UTF-8"));
			$oMail -> CharSet = "utf-8";
			$oMail -> AddAddress($to_email, "");
			$oMail -> SetFrom($from_email, $from_text);
			$oMail -> AddReplyTo($from_email, "");
			$oMail -> Mailer = 'sendmail';
			//print_r($oMail);exit;
			$email_status = $oMail -> Send();*/
			
			
			// $result=$this->Login_content_model->send_mail($to_email,$from_email,$subject,$from_text,$message,$password);
			// echo $result;
			// exit;
			$this->session->set_flashdata('success_message', "Now you can login to proceed.");
			//$data = array('title'=>$this->lang->line('login_button'),'meta_key'=>$this->sitename.','.$this->lang->line('login_button'),'meta_desc'=>$this->sitename.' '.$this->lang->line('login_button'));
			//$a = $this->lang->line('resend_text').' <a class="resend" href="'.site_url('resend').'">'.$this->lang->line('resend')."</a>";
			//$this->session->set_flashdata('notification',$this->lang->line('confirm_mail_sent')." ".$a);
			//header("Location: ".base_url()."home/home_page");
			exit;
			
		}
		else{
			header("Location: ".base_url()."register");
			exit;
		}
	}
	
	
	public function confirm_register_token(){
		$this->checkSession();
		$last = $this->uri->total_segments();
		$token = $this->uri->segment($last);
		
		if($token!=''){
			$this->load->model('login_content/Login_content_model');
			$get_user =$this->Login_content_model->validate_register_token($token);
			
			if($get_user->Status=='')
				$this->session->set_flashdata('error_message', "Invalid Token.");
			else if($get_user->Status=='Enable'){
				$this->session->set_flashdata('error_message', "Your account is already confirmed. Please login to continue.");
			}
			elseif($get_user->Status=='Disable'){
				$this->session->set_flashdata('error_message', "Account is suspended!");
			}
			else{
				$ip_date =$this->Login_content_model->get_date_ip();
				$value_array = array(   
									'Status'=>'Enable',
									'ConfirmDate'=>$ip_date->cur_date,
									'ConfirmIp'=>$ip_date->ip,
								);
				$this->Login_content_model->confirm_user($value_array,$get_user->UserId);
				
				$this->session->set_flashdata('success_message', "Your email is confirmed successfully. Please login to continue.");
				
			}
			
		}
		redirect('login');
	}
	
	public function view_forgot_password(){
		$this->checkSession();
		$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
		$this->load->model('top_menu/Top_menu_model');
		$data['token'] =$this->Top_menu_model->csrfguard_generate_token($data['unique_form_name']);
		$data['error_message']=$this->session->flashdata('error_message');
		$data['success_message']=$this->session->flashdata('success_message');
		$data['user_add_data']=$this->session->flashdata('user_add_data');
        $this->load->view('view_forgot_password_content',$data);
	}
	
	
	
	public function forgot_validate(){
		print_r($_POST);exit;
		$this->checkSession();
		
		$csrf_name=$this->input->post("csrf_name");
		$csrf_token= $this->input->post("csrf_token");
		
		$this->load->model('login_content/Login_content_model');
		$csrf_check =$this->csrfguard_validate_token($csrf_name,$csrf_token);
		
		if($csrf_check==false){
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
			header("Location:" . $this -> config -> base_url() . "login/forgot");
			exit ;
		}
		//form validation helper
		$this->load->helper('login_content/Login_content');
		$validate = forgot_form_validate();
		if ($validate && $csrf_check==true){
			$email = $this->input->post('email');
			
			$get_user = $this->Login_content_model->check_forgot_email($email);
			if($get_user==false){
				$this->session->set_flashdata('error_message', "No account exists with this email.");
				header("Location:" . $this -> config -> base_url() . "login/forgot");
				exit ;
			}
			else{
				// if($get_user->Status=='Temp'){
					// $this->session->set_userdata(array('user_temp'=>TRUE,'userid'=>$get_user->Id,'email'=>$email));
					// $this->session->set_flashdata('error_message', "Your email is not confirmed yet.");
					// //$data['resend'] = 'Yes';
					// //$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
					// //$data['token'] = $this->user_model->csrfguard_generate_token($data['unique_form_name']);
					// header("Location:" . $this -> config -> base_url() . "login");
					// exit ;
				// }
				// else
				if($get_user->Status=='Disable'){
					//$this->user_model->clean_session();
					$this->session->set_flashdata('error_message', "Account is suspended!");
					header("Location:" . $this -> config -> base_url() . "login");
					exit ;
				}
				else{
					$ip_date =$this->Login_content_model->get_date_ip();
					$token = $this->Login_content_model->generateToken(8);
					$value_array = array(   
											'UserId' =>$get_user->Id,
											'Token' => $token,
											'CreatedDate'=>$ip_date->cur_date,
											'CreatedIp'=>$ip_date->ip,
										);
					$this->Login_content_model->replace('support_forgot',$value_array);
					
					//get email data
					$get_email=$this->Login_content_model->get_one_email(2);
					$to_email=$this->input->post('email');
					$subject=$get_email->Subject;
					$sender_email = $get_email->Email;
					$from = $get_email->FromText;
					
					$password =$get_email->Password;
					$link = site_url('login/forgot_confirm/'.$token);
					$site_settings=$this->session->userdata['site_settings'];
					
					$message  = str_replace('[LINK]',$link,$get_email->Content);
					$message  = str_replace('[SITE_NAME]',$site_settings['site_name'],$message);
					$message  = str_replace('[SITE_URL]',$site_settings['site_url'],$message);
					
					
					$this->load->library('Cphpmailer');
					$oMail = new Cphpmailer();
					$oMail -> Subject = stripslashes($subject);
					$oMail -> MsgHTML(mb_convert_encoding($message, "HTML-ENTITIES", "UTF-8"));
					$oMail -> CharSet = "utf-8";
					$oMail -> AddAddress($to_email, "");
					$oMail -> SetFrom($sender_email, $from);
					$oMail -> AddReplyTo($sender_email, "");
					$oMail -> Mailer = 'sendmail';
					$email_status = $oMail -> Send();
			
					$this->session->set_flashdata('success_message', "Password reset instruction is sent to your email address.");
				}
			}
			header("Location:" . $this -> config -> base_url() . "login");
			exit ;
		}
		else{
			header("Location:" . $this -> config -> base_url() . "login/forgot");
			exit ;
		}
	}
	
	
	public function confirm_forgot_token(){
		$this->checkSession();
		$last = $this->uri->total_segments();
		$token = $this->uri->segment($last);
		
		
		//$data = array('title'=>'Reset Password','meta_key'=>$this->sitename.' ,Reset Password','meta_desc'=>$this->sitename.' Reset Password','action'=>site_url('resetpassword/check/'.$token));
		if($token!=''){
			$this->load->model('login_content/Login_content_model');
			$result =$this->Login_content_model->validate_forgot_token($token);
			
			if(empty($result)){
				$this->session->set_flashdata('error_message','It looks like you have already recovered your password or link is expired.');
				header("Location: ".base_url()."login");
				exit;
			}
			else if($result->Status=='Delete'){
				//$this->user_model->clean_session();
				$this->session->set_flashdata('error_message','Error: Your account no longer exist.');
				header("Location: ".base_url()."login");
				exit;
			}
			else if($result->Status=='Disable'){
				//$this->user_model->clean_session();
				$this->session->set_flashdata('error_message','Account is suspended!');
				header("Location: ".base_url()."login");
				exit;
			}
			else{
				$sentdate=strtotime($result->CreatedDate);
				$current_date=strtotime(date('Y-m-d H:i:s'));
				$diff= abs($sentdate - $current_date);
				$difference=($diff/(60*60*24));
				if($difference > 5){
					$this->Login_content_model->delete_forgot_code($result->Id);
					$this->session->set_flashdata('error_message','Link In your mail is expierd,Request Again!');
					header("Location: ".base_url()."login");
					exit;
				}
			}
		}	
		else{
			$this->session->set_flashdata('error_message','It looks like link is expired.');
			header("Location: ".base_url()."login");
			exit;
		}
		
		$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
		$this->load->model('top_menu/Top_menu_model');
		$data['token'] =$this->Top_menu_model->csrfguard_generate_token($data['unique_form_name']);
		$data['error_message']=$this->session->flashdata('error_message');
		$data['success_message']=$this->session->flashdata('success_message');
		$data['user_add_data']=$this->session->flashdata('user_add_data');
        $data['forgot_token']=$token;
        
		$this->load->view('view_reset_password',$data);
		
	}
	
	
	
	
	public function check_reset_password(){
		$this->checkSession();
		
		$csrf_name=$this->input->post("csrf_name");
		$csrf_token= $this->input->post("csrf_token");
		$forgot_token= $this->input->post("forgot_token");
		
		$this->load->model('login_content/Login_content_model');
		$csrf_check =$this->csrfguard_validate_token($csrf_name,$csrf_token);
		
		if($csrf_check==false){
			$this->session->set_flashdata('error_message', "Something gone wrong. Try Again.");
			redirect($_SERVER['HTTP_REFERER']);
			exit;
			
		}
		//form validation helper
		$this->load->helper('login_content/Login_content');
		$validate = new_password_form_validate();
		if ($validate && $csrf_check==true){
			$this->load->model('login_content/Login_content_model');
			$result =$this->Login_content_model->validate_forgot_token($forgot_token);
			
			if(empty($result)){
				$this->session->set_flashdata('error_message','It looks like you have already recovered your password or link is expired.');
				header("Location: ".base_url()."login");
				exit;
			}
			else if($result->Status=='Delete'){
				//$this->user_model->clean_session();
				$this->session->set_flashdata('error_message','Error: Your account no longer exist.');
				header("Location: ".base_url()."login");
				exit;
			}
			elseif($result->Status=='Disable'){
				//$this->user_model->clean_session();
				$this->session->set_flashdata('error_message','Account is suspended!');
				header("Location: ".base_url()."login");
				exit;
			}
			else{
				$sentdate=strtotime($result->CreatedDate);
				$current_date=strtotime(date('Y-m-d'));
				$diff= abs($sentdate - $current_date);
				$difference=($diff/(60*60*24));
				
				if($difference > 5){
					$this->Login_content_model->delete_forgot_code($result->Id);
					$this->session->set_flashdata('error_message','Link In your Mail is expierd,Request Again!');
					header("Location: ".base_url()."login");
					exit;
				}
				else{
					
					$ip_date =$this->Login_content_model->get_date_ip();
					$salt =$this->Login_content_model->create_pwd_salt();
					$password = hash('sha256', $salt . ( hash('sha256',$this->input->post('password')) ) );
					$value_array = array(
										'Password' => $password ,
										'Salt' => $salt ,
										);
					if($result->Type=='Facebook') $value_array['Type']='Both';
					
					
					$this->Login_content_model->confirm_user($value_array,$result->Id);					
					
					$val_array = array(
								'TableId' => $result->Id,
								'TableName' => 'password_change',
									);
					$this->Login_content_model->insert_modified($value_array);	

					$this->Login_content_model->delete_forgot_code($result->Id);
					$this->session->set_flashdata('success_message',"You have successfully recovered your password.");
					header("Location: ".base_url()."login");
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

	/*public function test(){
		$facebook = new Facebook(array(
				'appId'		=>  $this->site_setting->site_fb_appid, 
				'secret'	=>   $this->site_setting->site_fb_appkey
			));
		$user = $facebook->getUser();
		if($user){
			$data['unique_form_name'] = "CSRFGuard_".mt_rand(0,mt_getrandmax());
			$data['token'] = $this->user_model->csrfguard_generate_token($data['unique_form_name']);
			redirect('fblogin/index/?csrf_name='.$data['unique_form_name'].'&csrf_token='.$data['token']);
		}
		else{
			$params['scope'] = 	'email';
			$loginUrl = $facebook->getLoginUrl($params,site_url('fblogin/test'));
			header('Location: ' . $loginUrl);
		}
	}*/
	
	
	public function fb_response(){
		
		if($this->session->userdata('target_url')){
			$target_url_redirect = $this->session->userdata('target_url');
		}else{
			$target_url_redirect = "";
			
		}
		
		if(is_array($this->input->get()))
			extract($this->input->get());
			$target_url_fb = urldecode($target_url);
			
			if(basename($target_url_fb) == "login"){
				$target_url_fb = '';
			}
			
			
			//$this->load->library('facebook/Facebook');
			$this->load->model('login_content/Login_content_model');
			$csrf_check =$this->csrfguard_validate_token($csrf_name,$csrf_token);
			$site_settings=$this->session->userdata['site_settings'];
			
			if($csrf_check==true){
			/*	$data = array('title'=> $this->lang->line('FACEBOOK_SIGNIN'),'js_validate'=>'Yes','action'=>site_url('fblogin/redirect'),'message'=>'','tbl'=>'support_users');
			*/	
					
				$fb = new \Facebook\Facebook([
				  'app_id' => $site_settings['site_fb_appid'], 
				  'app_secret' => $site_settings['site_fb_appkey'], 
				  'default_graph_version' => 'v2.10',
				  //'default_access_token' => '{access-token}', // optional
				]);
				
				$helper = $fb->getJavaScriptHelper();
				 
				  try {
					  $access_token = $helper->getAccessToken();
				  	  $response = $fb->get('/me?fields=name,email,first_name,last_name,link', $access_token);
					  $user_profile = $response->getGraphUser();
				 
				  } catch(Facebook\Exceptions\FacebookResponseException $e) {
					  // When Graph returns an error
					 	 $this->session->set_flashdata('error_message','Facebook Graph Response Issue.'.$e->getMessage());
						if($target_url_fb!=''){
							redirect($target_url_fb);
						}else{
							header("Location: ".base_url()."login");
							exit;	
						}
						die();
					
				  } catch(Facebook\Exceptions\FacebookSDKException $e) {
					  // When validation fails or other local issues
					   $this->session->set_flashdata('error_message','Facebook SDK Response Issue.'.$e->getMessage());
						if($target_url_fb!=''){
							redirect($target_url_fb);
						}else{
							header("Location: ".base_url()."login");
							exit;	
						}
						die();
				  }
					
					if (! isset($access_token)) {
					  $this->session->set_flashdata('error_message','No OAuth data could be obtained. Please try again');
						if($target_url_fb!=''){
							redirect($target_url_fb);
						}else{
							header("Location: ".base_url()."login");
							exit;	
						}
						die();
					}


				if(isset($user_profile['email'])){
					$fb_email=$user_profile['email'];
				}else{
					$fb_email=$user_profile['id']."@isupportcause.com";
				}

				//echo $accessToken;exit;
				$fb_name=$user_profile['name'];
				$data['access_token']=$access_token;
				
				
				
				
				$check_data =$this->Login_content_model->check_user_fb_exist($data['tbl'],$fb_email);
			
				if(!empty($check_data)){
					
					if ($check_data[0]->Status=='Enable'){
						$this->Login_content_model->clean_session();
						$this->session->set_userdata(array('userid'=>$check_data[0]->Id, 'user_logged_in'=>TRUE,'Type'=>$check_data[0]->Type,'email'=>$check_data[0]->Email,'firstname'=>$check_data[0]->Name,'lastname'=>$check_data[0]->LastName,'user_fbid'=>$check_data[0]->FacebookId));
						$this->session->set_flashdata('success_message','Welcome '.$check_data[0]->Name." ".$check_data[0]->LastName);
						
						if($target_url_fb!=''){
							redirect($target_url_fb);
						}elseif($target_url_redirect!=''){
							redirect($target_url_redirect);
						}elseif ($_SERVER['HTTP_HOST']=='www.isupportcause.com' || $_SERVER['HTTP_HOST']=='www.qa.isupportcause.com' || $_SERVER['HTTP_HOST']=='localhost'){
							header("Location: ".base_url()."user");
							exit;
						}else{
							header("Location: ".base_url()."user");
							exit;
						}
						die();
					}
					else{
						$this->Login_content_model->clean_session();
						$this->session->set_flashdata('error_message','Account is suspended!');
						
						if($target_url_fb!=''){
							redirect($target_url_fb);
						}else{
							header("Location: ".base_url()."login");
							exit;	
						}
						die();
					}
				}
				else{
						
						
					$this->redirect($access_token,$target_url,$user_profile);
					die();
				}
			}
			else{
				$this->session->set_flashdata('error',$this->lang->line('Something gone wrong. Try Again.'));	
				redirect('login');
			}
	}

	private function redirect($access_token='',$target_url='',$user_profile = '')

	{
		$site_settings=$this->session->userdata['site_settings'];
		
		if($this->session->userdata('target_url')){
			$target_url_redirect = $this->session->userdata('target_url');
		}else{
			$target_url_redirect = "";
			
		}
		
		if(is_array($this->input->get()))
			extract($this->input->get());
		$target_url_fb = urldecode($target_url);
			
		if(basename($target_url_fb) == "login"){
			$target_url_fb = '';
		}


			
            
		if(empty($user_profile)){redirect('login/index');}

			$fb_first_name =$user_profile['first_name'];
			$fb_last_name =$user_profile['last_name'];
			if(isset($user_profile['email'])){
				$fb_email=$user_profile['email'];
			}else{
				$fb_email=$user_profile['id']."@isupportcause.com";
			}
		
			
			$fb_name =$user_profile['name'];
			$fb_id=$user_profile['id'];
			$fb_link =$user_profile['link'];

			if($fb_email=='' || $fb_email==NULL)
			{

				$this->session->set_flashdata('error_message','In fb account email not exist. Please try manual login');

				if($target_url_fb!=''){
					redirect($target_url_fb);
				}else{
					header("Location: ".base_url()."login");
					exit;	
				}

				die();

			}

			$data['result'] = $this->Login_content_model->check_record_exist('support_users',$fb_email);
			
			if(!empty($data['result']))

			{
				$check_data = $data['result'];
				
				if($check_data[0]->Status=='Enable')

				{

					$value_array = array(   

								'Type' => 'Both',

								'FacebookId'=> $fb_id,

								);
					$user_id = $check_data[0]->Id;
					$this->Login_content_model->update_user($value_array,"Id = '$user_id'");

				

					$this->Login_content_model->clean_session();

					session_regenerate_id();

					$_SESSION['session_id'] = session_id();

					$this->session->set_userdata(array('userid'=>$check_data[0]->Id, 'user_logged_in'=>TRUE,'email'=>$check_data[0]->Email,'firstname'=>$check_data[0]->Name,'lastname'=>$check_data[0]->LastName,'user_fbid'=>$fb_id));

					

					$this->session->set_flashdata('success_message','Welcome '.$check_data[0]->Name);

					if($target_url_fb!=''){
						redirect($target_url_fb);
					}elseif($target_url_redirect!=''){
						redirect($target_url_redirect);
					}else{
						header("Location: ".base_url()."user");
						exit;	
					}

					die();

				}

				elseif ($check_data[0]->Status=='Temp')

				{

					$value_array = array(   

								'Type' => 'Both',

								'Status' => 'Enable',

								'FacebookId' => $fb_id,

								);

					$user_id = $check_data[0]->Id;
					$this->Login_content_model->update_user($value_array,"Id = '$user_id'");

					

					$fb = 'Both';

					$this->Login_content_model->clean_session();

					session_regenerate_id();

					$_SESSION['session_id'] = session_id();

					$this->session->set_userdata(array('userid'=>$check_data[0]->Id, 'user_logged_in'=>TRUE,'email'=>$check_data[0]->Email,'firstname'=>$check_data[0]->Name,'lastname'=>$check_data[0]->LastName,'user_fbid'=>$fb_id));

					

					$this->session->set_flashdata('success_message','Welcome '.$check_data[0]->Name);

					if($target_url_fb!=''){
						redirect($target_url_fb);
					}elseif($target_url_redirect!=''){
						redirect($target_url_redirect);
					}else{
						header("Location: ".base_url()."user");
						exit;	
					}
					die();

				}

				else

				{

					$this->user_model->clean_session();

					$this->session->set_flashdata('error_message','Account is suspended!');

					if($target_url_fb!=''){
						redirect($target_url_fb);
					}else{
						header("Location: ".base_url()."login");
						exit;	
					}

					die();

				}

			}

			

			

			$this->ip_date = $this->Login_content_model->get_date_ip();

			$value_array = array(   

									'Email' =>$fb_email,

									'Name'=>$fb_first_name,

									'LastName'=>$fb_last_name,

									'FacebookId' => $fb_id,

									'Type'=>'Facebook',

									'CreatedDate'=>$this->ip_date->cur_date,

									'CreatedIp'=>24211231,

									'ConfirmDate'=>$this->ip_date->cur_date,

									'ConfirmIp'=>4123313,
                                                                        'Password' =>'22222',
                                                                        'Salt' =>'e4a'

								);

			$insert_id=$this->Login_content_model->insert_user($value_array);

			

			$this->Login_content_model->clean_session();

			$this->session->set_userdata(array('userid'=>$insert_id, 'user_logged_in'=>TRUE,'Type'=>'Facebook','email'=>$fb_email,'firstname'=>$fb_first_name,'lastname'=>$fb_last_name,'user_fbid'=>$fb_id));

			

			$this->session->set_flashdata('success_message','Welcome '.$fb_name);

			if($target_url_fb!=''){
				redirect($target_url_fb);
			}elseif($target_url_redirect!=''){
				redirect($target_url_redirect);
			}else{
				header("Location: ".base_url()."user");
				exit;	
			}
			
			die();

	}


}?>
