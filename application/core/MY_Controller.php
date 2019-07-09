<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
class MY_Controller extends MX_Controller {
    
  
    public function  __construct()
    {   
        parent::__construct();
    }
    public function check_usertype_modules_core($allow_usertypes){
    	//this function will use to check module cores function access permissionds
    	 
		 $user_type=$this->session->userdata('user_type');
	
		 $key = array_search($user_type, $allow_usertypes);
		 if($key!=false){
		 	return $user_type;
		 }
		 else{
		 	$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
			header("Location:".$this->config->base_url()."login_content/logout");
            exit;
		 }
		 
		
    }
	

	public function check_permission_modules_core($panel,$requested_permission){
    	//this function will use to check module cores function access permissionds
    	 
		 // get user group
		
		 $group_id=$this->session->userdata('group_id');
		 // check panel exists
		 $this -> load -> model('permissions_content/permissions_content_model');
		 $panels = $this->permissions_content_model->get_panel_id_by_name($panel);
		 if(empty($panels)){
		 	// $this->panels_check_permission(0);	
		 	return FALSE;
		 }
		
		 // check permission exits 
		 $panel_id = $panels->panel_id;
		 $panel_permission = $this->permissions_content_model->check_panel_permission($group_id,$panel_id,$requested_permission);
		
		
		 if($panel_permission){
		 	return TRUE;
		 }
		 else{
		//  	$this->panels_check_permission(0);	
		  	return FALSE;
		
		 }
		 
		
    }	
	
	
	
	
	
	public function check_group_permissions($view,$view2){
        
        
		if($this->session->userdata('permission_id')==$view || $this->session->userdata('permission_id')==$view2 ){
		return true;	
		}
		else{
			return false;
		}
    }
	
    public function check_super_admin(){
        $user_type=$this->session->userdata('user_type');
        
        if ($user_type != "super_user" ){
            return 0;
            exit;
        }
		else{
			return 1;
		}
    }
	
	public function check_admin(){
        $user_type=$this->session->userdata('user_type');
        if ($user_type != "admin" ){
            return 0;
            exit;
        }
		else{
			return 1;
		}
    }
	
    public function check_store_operator(){
        $user_type=$this->session->userdata('user_type');
        if ($user_type != "store_operator" ){
            return 0;
            exit;
        }
		else{
			return 1;
		}
    }
    public function check_technician(){
        $user_type=$this->session->userdata('user_type');
        if ($user_type != "technician" ){
            return 0;
            exit;
        }
		else{
			return 1;
		}
    }
    
      public function check_csr(){
        $user_type=$this->session->userdata('user_type');
        if ($user_type != "csr" ){
            return 0;
            exit;
        }
		else{
			return 1;
		}
    }
 
	  public function check_warranty_registrar(){
	
    	$user_type=$this->session->userdata('user_type');
    	if ($user_type != "warranty_registrar" ){
    		return 0;
    		exit;
    	}
    	else{
    		return 1;
    	}
    }
	
	 public function check_country_manager(){
	
    	$user_type=$this->session->userdata('user_type');
    	if ($user_type != "country_manager" ){
    		return 0;
    		exit;
    	}
    	else{
    		return 1;
    	}
    }
    public function checkSession(){
         $islogin=$this->session->userdata('is_logged_in');
          if(!isset($islogin) || $islogin==0){
            //redirect(base_url('localhost/page_login'));
             
            redirect('/');
        }
         
    }
    
    public function add_page_title($title){
        $page_title = array(
                'page_title' => $title
            );
            $this->session->set_userdata($page_title);
    }
	
	public function get_user_ip() {
		$ip = "";
		if (isset($_SERVER["REMOTE_ADDR"])) {
			$ip = $_SERVER["REMOTE_ADDR"];
		} else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}

		return $ip;
	}
	public function panels_check_permission($access=0){
		if($access==0){
			if($this->session->userdata('user_type')){
			
			$_error =& load_class('Exceptions', 'core');
    		$template=$_error->show_401($status_code = 401);
			exit;
			}
			else{
			$_error =& load_class('Exceptions', 'core');
    		$template=$_error->show_401($status_code = 404);
			exit;
			}
		}
		else{
			
			return 1;
		}
	}
    
    protected function no_cache(){
		header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");     
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache'); 
	}
	
}
