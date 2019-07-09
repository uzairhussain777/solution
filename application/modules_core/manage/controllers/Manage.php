 <?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {
    public function  __construct(){
   
		parent::__construct();
        $this->no_cache();
        //$this->check_admin();
        $this->add_page_title("Admin Login | events");
    }
    public function index(){
		// if already admin login	 then logout 
    	//$this->check_usertype_modules_core_login();
    	//echo "string";exit;
    	$this->load->view('login');
   	} 
	
	public function forgot(){
	//	echo "string";exit;
		// if already admin login	 then logout 
    	//$this->check_usertype_modules_core_login();
    	$this->load->view("forgot");
	}	
	
	
	
	public function forgot_confirm($token){
			//echo $token;exit;
		// if already admin login	 then logout 
    	//$this->check_usertype_modules_core_login();
    	$this->load->view('confirm_forgot_token',$token);
	}
}
