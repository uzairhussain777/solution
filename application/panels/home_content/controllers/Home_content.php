<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_content extends MX_Controller {
	
	public function homepage(){
		$this->load->view('home_content');
	}
}