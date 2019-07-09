<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends MY_Controller {
	
	public function  __construct(){
	parent::__construct();
        $this->no_cache();
        $this->add_page_title("Login | ecommerce");
    }
	
	public function sendnewsletter(){
		$this->load->view("send_newsletters");
	}/* end of function sendnessletter this function to send the newsleters to 
	 * specific group or registered users and send the newsletter that are 
	 * scheduled to be sent with respect to the date and time 
	 * */
	
	public function send_story_updates(){
		$this->load->view("send_story_updates");
	}/* end of function send_story_updtes to send the sotry updates to the registered users
	 * and to those user who have donated on a specfic story 
	 * */
}