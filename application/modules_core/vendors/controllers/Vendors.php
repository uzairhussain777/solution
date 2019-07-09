<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendors extends MY_Controller {
    public function  __construct(){
   
	parent::__construct();
        $this->no_cache();
        $this->check_super_admin();
        $this->add_page_title("Admin | solution_new");
    }
    public function index(){
    	exit;
   	}
	public function view(){
		//echo "string";exit;
		$this->check_super_admin();
		$allow_usertypes = array(1 => 'super_admin');
    	$user_type=$this->check_usertype_modules_core($allow_usertypes);
		
		$this->load->view('view_vendors');
   	}
	public function search(){
		//$this->check_super_admin();
		//$allow_usertypes = array(1 => 'super_admin');
    	//$user_type=$this->check_usertype_modules_core($allow_usertypes);
    	$this->load->view('view_vendors');
   	}
	public function edit(){
		$this->check_super_admin();
		$allow_usertypes = array(1 => 'super_admin',2 => 'moderator', 3=>'creator');
    	$user_type=$this->check_usertype_modules_core($allow_usertypes);
		
		$this->load->view('edit_vendors');
   	}
	public function viewdetails(){
		//echo "string";exit;
		$this->check_super_admin();
		$allow_usertypes = array(1 => 'super_admin',2 => 'moderator', 3=>'creator');
    	$user_type=$this->check_usertype_modules_core($allow_usertypes);
    	$this->load->view('view_detail_vendors');
   	}
	
	
	
	public function add(){
		//echo "string";exit;
		$this->check_super_admin();
		$allow_usertypes = array(1 => 'super_admin');
    	$user_type=$this->check_usertype_modules_core($allow_usertypes);
		
    	$this->load->view('add_vendors');
   	}  

public function createCsv(){
	
	//echo "string";exit;
$this->load->view('generateCsv');
}	
}
