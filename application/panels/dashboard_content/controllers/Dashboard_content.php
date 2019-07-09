<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
    public function index() {
    exit;
    }
	
	public function super_user(){
		$this -> load -> model('dashboard_content/dashboard_content_model');
		
		$total_users=$this->dashboard_content_model->getTotalUsers();
		$total_donations=$this->dashboard_content_model->getSumOfAllDonations();
		$total_stories=$this->dashboard_content_model->getTotalStories();
		$recent_ten_story=$this->dashboard_content_model->gettenstories();
		
		$data['total_users']=$total_users;
		$data['total_donations']=$total_donations;
		$data['total_stories']=$total_stories;
		$data['result']=$recent_ten_story;
		
		// $access=$this->check_super_admin();
		 //$this->panels_check_permission($access);
		 $this->load->view('super_user_dashboard_content',$data);
	}
	/*Rumman
	end of function super_user this is used to load the dashboard of the super user in the admin panel
	*/
	
	public function admin(){
		$this -> load -> model('dashboard_content/dashboard_content_model');
		
		$total_users=$this->dashboard_content_model->getTotalUsers();
		$total_donations=$this->dashboard_content_model->getSumOfAllDonations();
		$total_stories=$this->dashboard_content_model->getTotalStories();
		$recent_ten_story=$this->dashboard_content_model->gettenstories();
		
		$data['total_users']=$total_users;
		$data['total_donations']=$total_donations;
		$data['total_stories']=$total_stories;
		$data['result']=$recent_ten_story;
		
	//	$access=$this->check_admin();
		//$this->panels_check_permission($access);
		$this->load->view('admin_user_dashboard_content',$data);
	}
	/*Rumman
	end of function admin this is used to load the dashboard of the admin in the admin panel
	*/
}
?>
